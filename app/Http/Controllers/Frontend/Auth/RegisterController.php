<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Controller;
use App\Helpers\Auth\SocialiteHelper;
use App\Http\Requests\RegisterRequest;
use App\Events\Frontend\Auth\UserRegistered;
use App\Repositories\Backend\Auth\DesaRepository;
use App\Repositories\Backend\Auth\KecamatanRepository;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Repositories\Frontend\Auth\UserRepository;
use Illuminate\Http\Request;

/**
 * Class RegisterController.
 */
class RegisterController extends Controller
{
    use RegistersUsers;

    /**
     * @var UserRepository
     */
    protected $userRepository;

    /**
     * RegisterController constructor.
     *
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Where to redirect users after login.
     *
     * @return string
     */
    public function redirectPath()
    {
        return route(home_route());
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        abort_unless(config('access.registration'), 404);
        $rdesa = app(DesaRepository::class);
        $rkec = app(KecamatanRepository::class);
        $ddesa = $rdesa->get();
        $desas = $rkec->get()->mapWithKeys(function($d) use ($ddesa){
            $dt = $ddesa->where('kec_id', $d->id)->pluck('nama', 'id')->toArray();
            return ['Kec.'.$d->nama => $dt];
        })->toArray();
        return view('frontend.auth.register')
            ->withDesas($desas)
            ->withSocialiteLinks((new SocialiteHelper)->getSocialLinks());
    }

    /**
     * @param RegisterRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Throwable
     */
    public function register(Request $request)
    {
        $data = $request->validate([
            'first_name'           => ['required', 'string'],
            'last_name'            => ['required', 'string'],
            'email'                => 'required|string|email|unique:users',
            'password'             => ['required', 'string', 'min:6', 'confirmed'],
            'desa'                 => ['required'],
            'g-recaptcha-response' => ['required_if:captcha_status,true', 'captcha'],
        ]);

        abort_unless(config('access.registration'), 404);

        $user = $this->userRepository->create($request->only('first_name', 'last_name', 'email', 'password'));
        $user->desa_id = $data['desa'];
        $user->save();
        // If the user must confirm their email or their account requires approval,
        // create the account but don't log them in.
        if (config('access.users.confirm_email') || config('access.users.requires_approval')) {
            event(new UserRegistered($user));

            return redirect(route('frontend.auth.login'))->withFlashSuccess(
                config('access.users.requires_approval') ?
                    // __('exceptions.frontend.auth.confirmation.created_pending') :
                    "Your account was successfully created and is pending approval. Please contact Admin to activate" :
                    __('exceptions.frontend.auth.confirmation.created_confirm')
            );
        }

        auth()->login($user);

        event(new UserRegistered($user));

        return redirect($this->redirectPath());
    }
}
