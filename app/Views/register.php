<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="row justify-content-center">

<div class="col-md-5">

<div class="card p-4">

<h3 class="text-center mb-4">Create Account</h3>

<form method="post" action="/sinag-donation/public/register">

<div class="mb-3">
<label>Username</label>
<input type="text" name="username" class="form-control" required>
</div>

<div class="mb-3">
<label>Email</label>
<input type="email" name="email" class="form-control" required>
</div>

<div class="mb-3">
<label>Password</label>
<input type="password" name="password" class="form-control" required>
</div>

<button class="btn btn-primary w-100">
Register
</button>

</form>

</div>

</div>

</div>

<?= $this->endSection() ?>