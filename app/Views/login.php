<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="row justify-content-center">

<div class="col-md-5">

<div class="card shadow">

<div class="card-body">

<h3 class="text-center mb-4">SinagDonation Login</h3>

<?php if(session()->getFlashdata('msg')): ?>
<div class="alert alert-success">
<?= session()->getFlashdata('msg') ?>
</div>
<?php endif; ?>

<?php if(session()->getFlashdata('error')): ?>
<div class="alert alert-danger">
<?= session()->getFlashdata('error') ?>
</div>
<?php endif; ?>

<form method="post" action="/sinag-donation/public/login">

<div class="mb-3">
<label class="form-label">Email or Username</label>
<input type="text" name="login" class="form-control" required>
</div>

<div class="mb-3">
<label class="form-label">Password</label>
<input type="password" name="password" class="form-control" required>
</div>

<div class="d-grid">
<button class="btn btn-primary">Login</button>
</div>

</form>

</div>

</div>

</div>

</div>

<?= $this->endSection() ?>