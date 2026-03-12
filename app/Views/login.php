<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="row justify-content-center">

<div class="col-md-5">

<div class="card shadow">

<div class="card-body">

<h3 class="text-center mb-4">SinagDonation Login</h3>

<form method="post" action="/sinag-donation/public/login">

<div class="mb-3">
<label class="form-label">Username</label>
<input type="text" name="username" class="form-control" required>
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