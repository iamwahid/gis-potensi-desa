<?php

Breadcrumbs::for('admin.dashboard', function ($trail) {
    $trail->push(__('strings.backend.dashboard.title'), route('admin.dashboard'));
});

require __DIR__.'/auth.php';
require __DIR__.'/log-viewer.php';

// Desa
Breadcrumbs::for('admin.desa.index', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Desa', route('admin.desa.index'));
});

Breadcrumbs::for('admin.desa.create', function ($trail) {
    $trail->parent('admin.desa.index');
    $trail->push('Tambah', route('admin.desa.create'));
});

Breadcrumbs::for('admin.desa.show', function ($trail, $desa) {
    $trail->parent('admin.desa.index');
    $trail->push('Tambah', route('admin.desa.show', $desa));
});

Breadcrumbs::for('admin.desa.edit', function ($trail, $desa) {
    $trail->parent('admin.desa.index');
    $trail->push('Edit', route('admin.desa.edit', $desa));
});

// Kecamatan
Breadcrumbs::for('admin.kecamatan.index', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Kecamatan', route('admin.kecamatan.index'));
});

Breadcrumbs::for('admin.kecamatan.create', function ($trail) {
    $trail->parent('admin.kecamatan.index');
    $trail->push('Tambah', route('admin.kecamatan.create'));
});

Breadcrumbs::for('admin.kecamatan.show', function ($trail, $kecamatan) {
    $trail->parent('admin.kecamatan.index');
    $trail->push('Tambah', route('admin.kecamatan.show', $kecamatan));
});

Breadcrumbs::for('admin.kecamatan.edit', function ($trail, $kecamatan) {
    $trail->parent('admin.kecamatan.index');
    $trail->push('Edit', route('admin.kecamatan.edit', $kecamatan));
});

// Produk
Breadcrumbs::for('admin.desa.produk.index', function ($trail, $desa) {
    $trail->parent('admin.dashboard');
    $trail->push('Produk', route('admin.desa.produk.index', $desa));
});

Breadcrumbs::for('admin.desa.produk.create', function ($trail, $desa) {
    $trail->parent('admin.desa.produk.index', $desa);
    $trail->push('Tambah', route('admin.desa.produk.create', $desa));
});

Breadcrumbs::for('admin.desa.produk.show', function ($trail, $produk) {
    $trail->parent('admin.desa.produk.index', $produk->desa->id);
    $trail->push('Tambah', route('admin.desa.produk.show', $produk));
});

Breadcrumbs::for('admin.desa.produk.edit', function ($trail, $produk) {
    $trail->parent('admin.desa.produk.index', $produk->desa->id);
    $trail->push('Edit', route('admin.desa.produk.edit', $produk));
});

// Wisata
Breadcrumbs::for('admin.wisata.index', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Wisata', route('admin.wisata.index'));
});

Breadcrumbs::for('admin.wisata.create', function ($trail) {
    $trail->parent('admin.wisata.index');
    $trail->push('Tambah', route('admin.wisata.create'));
});

Breadcrumbs::for('admin.wisata.show', function ($trail, $wisata) {
    $trail->parent('admin.wisata.index');
    $trail->push('Tambah', route('admin.wisata.show', $wisata));
});

Breadcrumbs::for('admin.wisata.edit', function ($trail, $wisata) {
    $trail->parent('admin.wisata.index');
    $trail->push('Edit', route('admin.wisata.edit', $wisata));
});