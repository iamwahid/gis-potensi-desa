<?php

namespace App\Models;

use App\Models\Auth\User;
use Illuminate\Database\Eloquent\Model;

class Desa extends Model
{
    protected $fillable = [
        'nama',
        'kec_id',
        'penduduk_total',
        'map_lat',
        'map_long',
        'map_bound_coordinates',
        'penduduk_pria',
        'penduduk_wanita',
        'penduduk_produktif',
        'penduduk_work_formal',
        'penduduk_work_informal',
        'penduduk_work_none',
        'penduduk_sector_agriculture',
        'penduduk_sector_mining',
        'penduduk_sector_industry',
        'penduduk_sector_construction',
        'penduduk_sector_trade',
        'penduduk_sector_service',
        'penduduk_sector_transportation',
        'penduduk_sector_tni_polri',
        'penduduk_sector_asn',
        'penduduk_edu_none',
        'penduduk_edu_sd',
        'penduduk_edu_smp',
        'penduduk_edu_sma',
        'penduduk_edu_s1',
        'penduduk_edu_s2',
        'penduduk_edu_s3',
        'penduduk_religion_islam',
        'penduduk_religion_protestan',
        'penduduk_religion_katolik',
        'penduduk_religion_hindu',
        'penduduk_religion_buddha',
        'penduduk_religion_lain',
        'penduduk_dis_blind',
        'penduduk_dis_deaf',
        'penduduk_dis_mute',
        'penduduk_dis_body',
        'penduduk_dis_mental',
        'penduduk_persen_kecamatan',
        'penduduk_padat_km2',
        'rts_raskin',
        'rts_jamkesmas',
        'rts_pkh',
        'rts_blsm',
        'letak_tinggi_kantor_desa',
        'luas_wilayah',
        'luas_persen_kecamatan',
        'verified',
        'verified_by',
    ];

    protected $appends = [
        'mapcontent'
	];

    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class, 'kec_id');
    }

    public function potencies()
    {
        return $this->hasMany(Potency::class, 'desa_id')->orderBy('verified');
    }

    public function verifier()
    {
        return $this->hasOne(User::class, 'id', 'verified_by');
    }

    public function getActionButtonsAttribute()
    {
        $show = route('admin.desa.show', $this->id);
        $edit = route('admin.desa.edit', $this->id);
        $delete = route('admin.desa.destroy', $this->id);
        $potency = route('admin.desa.potency.index', $this->id);
        $unverified = $this->unverified_potency_count;
        $html = 
<<<HTML
        <div class="btn-group">
        <a href="$show" class="btn btn-success">Lihat</a>
        <a href="$edit" class="btn btn-primary">Edit</a>
        <a href="$potency" class="btn btn-primary">Potensi Desa $unverified</a>
        </div>
HTML;
        return $html;
    }

    public function getMapcontentAttribute()
    {   
        $props = [
            'Desa/Kelurahan' =>  $this->nama,
            'Kecamatan' => $this->kecamatan->nama,
            'Kabupaten' => $this->kecamatan->kabupaten,
            'Jumlah Total Penduduk' => $this->penduduk_total.' Jiwa',
        ];
        $links = [
            route('admin.desa.show', $this->id) => 'Lihat Detail',
        ];
        $content = view('components.map.popup-large', compact(['props', 'links']))->render();
        return $content;
    }

    public function getAttrsAttribute()
    {
        return array_only($this->toArray(), [
            'nama',
            'penduduk_total',
            'penduduk_pria',
            'penduduk_wanita',
            'penduduk_produktif',
            'penduduk_work_formal',
            'penduduk_work_informal',
            'penduduk_work_none',
            'penduduk_sector_agriculture',
            'penduduk_sector_mining',
            'penduduk_sector_industry',
            'penduduk_sector_construction',
            'penduduk_sector_trade',
            'penduduk_sector_service',
            'penduduk_sector_transportation',
            'penduduk_edu_none',
            'penduduk_edu_sd',
            'penduduk_edu_smp',
            'penduduk_edu_sma',
            'penduduk_edu_s1',
            'penduduk_edu_s2',
            'penduduk_edu_s3',
            'penduduk_religion_islam',
            'penduduk_religion_protestan',
            'penduduk_religion_katolik',
            'penduduk_religion_hindu',
            'penduduk_religion_buddha',
            'penduduk_religion_lain',
            'penduduk_dis_blind',
            'penduduk_dis_deaf',
            'penduduk_dis_mute',
            'penduduk_dis_body',
            'penduduk_dis_mental',
            'penduduk_persen_kecamatan',
            'penduduk_padat_km2',
            'rts_raskin',
            'rts_jamkesmas',
            'rts_pkh',
            'rts_blsm',
            'letak_tinggi_kantor_desa',
            'luas_wilayah',
            'luas_persen_kecamatan',
        ]);
    }

    public function getJumlahPendudukAttribute()
    {
        return array_only($this->toArray(), [
            'penduduk_total',
            'penduduk_pria',
            'penduduk_wanita',
            'penduduk_produktif',
            'penduduk_persen_kecamatan',
            'penduduk_padat_km2',
        ]);
    }

    public function getPekerjaanPendudukAttribute()
    {
        return array_only($this->toArray(), [
            'penduduk_work_formal',
            'penduduk_work_informal',
            'penduduk_work_none',
            'penduduk_sector_agriculture',
            'penduduk_sector_mining',
            'penduduk_sector_industry',
            'penduduk_sector_construction',
            'penduduk_sector_trade',
            'penduduk_sector_service',
            'penduduk_sector_transportation',
            'penduduk_sector_tni_polri',
            'penduduk_sector_asn',
        ]);
    }

    public function getPendidikanPendudukAttribute()
    {
        return array_only($this->toArray(), [
            'penduduk_edu_none',
            'penduduk_edu_sd',
            'penduduk_edu_smp',
            'penduduk_edu_sma',
            'penduduk_edu_s1',
            'penduduk_edu_s2',
            'penduduk_edu_s3',
        ]);
    }

    public function getDisPendudukAttribute()
    {
        return array_only($this->toArray(), [
            'penduduk_dis_blind',
            'penduduk_dis_deaf',
            'penduduk_dis_mute',
            'penduduk_dis_body',
            'penduduk_dis_mental',
        ]);
    }

    public function getAgamaPendudukAttribute()
    {
        return array_only($this->toArray(), [
            'penduduk_religion_islam',
            'penduduk_religion_protestan',
            'penduduk_religion_katolik',
            'penduduk_religion_hindu',
            'penduduk_religion_buddha',
            'penduduk_religion_lain',
        ]);
    }

    public function getRtsPendudukAttribute()
    {
        return array_only($this->toArray(), [
            'rts_raskin',
            'rts_jamkesmas',
            'rts_pkh',
            'rts_blsm',
        ]);
    }

    public function getInfoDesaAttribute()
    {
        return array_only($this->toArray(), [
            'nama',
            'letak_tinggi_kantor_desa',
            'luas_wilayah',
            'luas_persen_kecamatan',
        ]);
    }

    public function getVerifiedLabelAttribute()
    {
        $verified = $this->verified ? 'verified' : 'unverified';
        $badge = $this->verified ? 'badge-success' : 'badge-danger';
        $verify = route('admin.desa.verify', $this->id);
        $disabled = auth()->user()->hasRole([config('access.users.verifier_role'), config('access.users.admin_role')]) ? '' : 'style="pointer-events: none"';
        $html = 
<<<HTML
        <a class="badge badge-sm $badge" $disabled href="$verify">$verified</a>
HTML;
        return $html;
    }

    public function getUnverifiedsAttribute()
    {
        $count = $this->potencies->where('verified', false)->count();
        return $count;
    }

    public function getUnverifiedPotencyCountAttribute()
    {
        $count = $this->unverifieds;
        $html = 
<<<HTML
        <span class="badge badge-sm badge-danger">$count</span>
HTML;
        return $count > 0 ? $html : '';
    }

    public function getVerifierNameAttribute()
    {
        return $this->verifier ? $this->verifier->name : null;
    }

    public function scopeNama($query, $nama = '')
    {
        return $query->where('nama', 'like', '%'.$nama.'%');
    }

    public function scopeId($query, $id)
    {
        if (!$id) return $query;
        return $query->where('id', $id);
    }

    public function scopeKecamatan($query, $kec_id = null)
    {
        if (!$kec_id) return $query;
        return $query->where('kec_id', $kec_id);
    }
}