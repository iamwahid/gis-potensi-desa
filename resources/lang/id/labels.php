<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Labels Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used in labels throughout the system.
    | Regardless where it is placed, a label can be listed here so it is easily
    | found in a intuitive way.
    |
    */

    'general' => [
        'all'     => 'Semua',
        'yes'     => 'Ya',
        'no'      => 'Tidak',
        'custom'  => 'Kustom',
        'actions' => 'Tindakan',
        'active'  => 'Aktif',
        'buttons' => [
            'save'   => 'Simpan',
            'update' => 'Perbarui',
        ],
        'hide'              => 'Sembunyi',
        'inactive'          => 'Non-aktif',
        'none'              => 'Tidak ada',
        'show'              => 'Tunjukkan',
        'toggle_navigation' => 'Alihkan Navigasi',
    ],

    'backend' => [
        'access' => [
            'roles' => [
                'create'     => 'Buat Peran',
                'edit'       => 'Edit Peran',
                'management' => 'Manajemen Peran',

                'table' => [
                    'number_of_users' => 'Jumlah Pengguna',
                    'permissions'     => 'Izin',
                    'role'            => 'Peran',
                    'sort'            => 'Sortir',
                    'total'           => 'total peran|total peran',
                ],
            ],

            'users' => [
                'active'              => 'Pengguna Aktif',
                'all_permissions'     => 'Semua Izin',
                'change_password'     => 'Ubah Sandi',
                'change_password_for' => 'Ubah Sandi untuk :user',
                'create'              => 'Buat Pengguna',
                'deactivated'         => 'Pengguna Dinonaktifkan',
                'deleted'             => 'Pengguna Dihapus',
                'edit'                => 'Edit Pengguna',
                'management'          => 'Manajemen Pengguna',
                'no_permissions'      => 'Tidak Ada Izin',
                'no_roles'            => 'Tidak Ada Peran untuk Ditetapkan.',
                'permissions'         => 'Izin',

                'table' => [
                    'confirmed'      => 'Dikonfirmasi',
                    'created'        => 'Dibuat',
                    'email'          => 'E-mail',
                    'id'             => 'ID',
                    'last_updated'   => 'Terakhir Diperbarui',
                    'name'           => 'Nama',
                    'no_deactivated' => 'Tidak Ada Pengguna Dinonaktifkan',
                    'no_deleted'     => 'Tidak Ada Pengguna Dihapus',
                    'roles'          => 'Peran',
                    'social' => 'Social',
                    'total'          => 'total pengguna|total pengguna',
                ],

                'tabs' => [
                    'titles' => [
                        'overview' => 'Ikhtisar',
                        'history'  => 'Riwayat',
                    ],

                    'content' => [
                        'overview' => [
                            'avatar'       => 'Avatar',
                            'confirmed'    => 'Dikonfirmasi',
                            'created_at'   => 'Dibuat Pada',
                            'deleted_at'   => 'Dihapus Pada',
                            'email'        => 'E-mail',
                            'last_login_at' => 'Last Login At',
                            'last_login_ip' => 'Last Login IP',
                            'last_updated' => 'Terakhir Diperbarui',
                            'name'         => 'Nama',
                            'status'       => 'Status',
                            'timezone'     => 'Timezone',
                        ],
                    ],
                ],

                'view' => 'Lihat Pengguna',
            ],
        ],
    ],

    'frontend' => [

        'auth' => [
            'login_box_title'    => 'Login',
            'login_button'       => 'Login',
            'login_with'         => 'Login dengan :social_media',
            'register_box_title' => 'Daftar',
            'register_button'    => 'Daftar',
            'remember_me'        => 'Ingat Saya',
        ],

        'contact' => [
            'box_title' => 'Contact Us',
            'button' => 'Send Information',
        ],

        'passwords' => [
            'forgot_password'                 => 'Lupa Sandi Anda?',
            'reset_password_box_title'        => 'Reset Sandi',
            'reset_password_button'           => 'Reset Sandi',
            'send_password_reset_link_button' => 'Kirim Tautan Reset Sandi',
        ],

        'user' => [
            'passwords' => [
                'change' => 'Ubah Sandi',
            ],

            'profile' => [
                'avatar'             => 'Avatar',
                'created_at'         => 'Dibuat Pada',
                'edit_information'   => 'Edit Informasi',
                'email'              => 'E-mail',
                'last_updated'       => 'Terakhir diperbarui',
                'name'               => 'Nama',
                'update_information' => 'Perbarui Informasi',
            ],
        ],

    ],

    'desa' => [
        'table' => [
            'nama' => 'Desa/Kelurahan',
            'kec_id' => 'Kecamatan ID',
            'penduduk_total' => 'Penduduk Desa Total',
            'map_lat' => 'Latitude Peta',
            'map_long' => 'Logitude Peta',
            'map_bound_coordinates' => 'Batas Koordinat Peta',
            'penduduk_pria' => 'Penduduk Pria',
            'penduduk_wanita' => 'Penduduk Wanita',
            'penduduk_produktif' => 'Penduduk Usia (15-64) Produktif',
            'penduduk_work_formal' => 'Penduduk Bekerja Formal',
            'penduduk_work_informal' => 'Penduduk Bekerja Informal',
            'penduduk_work_none' => 'Penduduk Pengangguran',
            'penduduk_sector_agriculture' => 'Bidang Pertanian',
            'penduduk_sector_mining' => 'Bidang Pertambangan dan Penggalian',
            'penduduk_sector_industry' => 'Bidang Industri Pengolahan',
            'penduduk_sector_construction' => 'Bidang Konstruksi',
            'penduduk_sector_trade' => 'Bidang Perdagangan',
            'penduduk_sector_service' => 'Bidang Jasa',
            'penduduk_sector_transportation' => 'Bidang Transportasi',
            'penduduk_edu_none' => 'Jumlah tidak Sekolah',
            'penduduk_edu_sd' => 'Jumlah Lulusan SD',
            'penduduk_edu_smp' => 'Jumlah Lulusan SMP Sederajat',
            'penduduk_edu_sma' => 'Jumlah Lulusan SMA Sederajat',
            'penduduk_edu_s1' => 'Jumlah Lulusan S1',
            'penduduk_edu_s2' => 'Jumlah Lulusan S2',
            'penduduk_edu_s3' => 'Jumlah Lulusan S3',
            'penduduk_religion_islam' => 'Jumlah Penduduk Islam',
            'penduduk_religion_protestan' => 'Jumlah Penduduk Protestan',
            'penduduk_religion_katolik' => 'Jumlah Penduduk Katolik',
            'penduduk_religion_hindu' => 'Jumlah Penduduk Hindu',
            'penduduk_religion_buddha' => 'Jumlah Penduduk Buddha',
            'penduduk_religion_lain' => 'Jumlah Penduduk Agama Lain',
            'penduduk_dis_blind' => 'Jumlah Tuna Netra',
            'penduduk_dis_deaf' => 'Jumlah Tuna Rungu',
            'penduduk_dis_mute' => 'Jumlah Tuna Wicara',
            'penduduk_dis_body' => 'Jumlah Tuna Daksa',
            'penduduk_dis_mental' => 'Jumlah Tuna Grahita',
            'penduduk_persen_kecamatan' => 'Persentase Penduduk terhadap Kecamatan',
            'penduduk_padat_km2' => 'Kepadatan Penduduk Per km2',
            'rts_raskin' => 'RTS RASKIN',
            'rts_jamkesmas' => 'RTS JAMKESMAS',
            'rts_pkh' => 'RTS PKH',
            'rts_blsm' => 'RTS BLSM',
            'letak_tinggi_kantor_desa' => 'Letak Tinggi Kantor Desa (mdpl)',
            'luas_wilayah' => 'Luas Wilayah Desa (km2)',
            'luas_persen_kecamatan' => 'Persentase Luas Desa terhadap Kecamatan (km2)',
        ]
    ]
];
