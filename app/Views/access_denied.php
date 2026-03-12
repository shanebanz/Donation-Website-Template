<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="text-center mt-5">

<h2>Access Denied</h2>

<p>You must be logged in as an admin to view this page.</p>

<a href="/sinag-donation/public/login" class="btn btn-primary">
Login
</a>

</div>

<?= $this->endSection() ?>