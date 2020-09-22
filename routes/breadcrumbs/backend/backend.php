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

// Potency
Breadcrumbs::for('admin.desa.potency.index', function ($trail, $desa) {
    $trail->parent('admin.dashboard');
    $trail->push('Potency', route('admin.desa.potency.index', $desa));
});

Breadcrumbs::for('admin.desa.potency.create', function ($trail, $desa) {
    $trail->parent('admin.desa.potency.index', $desa);
    $trail->push('Tambah', route('admin.desa.potency.create', $desa));
});

Breadcrumbs::for('admin.desa.potency.show', function ($trail, $potency) {
    $trail->parent('admin.desa.potency.index', $potency->desa->id);
    $trail->push('Tambah', route('admin.desa.potency.show', $potency));
});

Breadcrumbs::for('admin.desa.potency.edit', function ($trail, $potency) {
    $trail->parent('admin.desa.potency.index', $potency->desa->id);
    $trail->push('Edit', route('admin.desa.potency.edit', $potency));
});