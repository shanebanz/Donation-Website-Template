<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<style>
.auth-shell{
max-width:980px;
margin:0 auto 22px;
}

.auth-card{
border-radius:18px;
overflow:hidden;
box-shadow:0 18px 34px rgba(15,22,18,.14);
}

.auth-aside{
background:linear-gradient(150deg,#112018 0%,#23392e 55%,#345244 100%);
color:#f3faf5;
padding:34px 28px;
height:100%;
}

.auth-title{
font-size:2.1rem;
line-height:1.15;
margin-bottom:12px;
}

.auth-lead{
color:#d4e4d8;
margin-bottom:16px;
}

.auth-list{
margin:0;
padding-left:18px;
color:#dce9df;
}

.auth-form-panel{
background:#fff;
padding:34px 30px;
}

.auth-heading{
font-size:1.95rem;
margin-bottom:6px;
}

.auth-subheading{
color:#647162;
margin-bottom:18px;
}

.helper-link{
color:#5f7c2f;
text-decoration:none;
font-weight:600;
}

.helper-link:hover{
text-decoration:underline;
}

@media (max-width: 991px){
.auth-aside,
.auth-form-panel{
padding:26px 22px;
}

.auth-title,
.auth-heading{
font-size:1.7rem;
}
}

@media (max-width: 576px){
.auth-shell{
max-width:100%;
}

.auth-card{
border-radius:14px;
}

.auth-aside,
.auth-form-panel{
padding:20px 16px;
}

.auth-lead,
.auth-list li,
.auth-subheading{
font-size:.94rem;
}

.auth-list{
margin-top:10px;
}
}
</style>

<section class="auth-shell">
<div class="row g-0 auth-card">

<div class="col-lg-5">

<aside class="auth-aside">
<p class="mb-2 text-uppercase fw-semibold" style="letter-spacing:.5px;">Join SINAG</p>
<h2 class="auth-title">Create Your Donor Account</h2>
<p class="auth-lead">Start supporting campaigns with clear tracking and verified impact updates.</p>

<ul class="auth-list">
<li>Easy campaign discovery</li>
<li>Transparent donation process</li>
<li>Email verification for account safety</li>
</ul>
</aside>

</div>

<div class="col-lg-7">

<div class="auth-form-panel">

<h1 class="auth-heading">Create Account</h1>
<p class="auth-subheading">Register to donate, track campaigns, and receive verification updates.</p>

<form method="post" action="/sinag-donation/public/register">

<div class="mb-3">
<label class="form-label fw-semibold">Full Name</label>
<input type="text" name="name" class="form-control" required>
</div>

<div class="mb-3">
<label class="form-label fw-semibold">Email Address</label>
<input type="email" name="email" class="form-control" required>
</div>

<div class="mb-3">
<label class="form-label fw-semibold">Password</label>
<input type="password" name="password" class="form-control" required>
</div>

<button class="btn btn-primary w-100">
Register
</button>

<p class="mt-3 mb-0 text-muted">
Already have an account?
<a href="/sinag-donation/public/login" class="helper-link">Sign in</a>
</p>

</form>

</div>

</div>

</div>
</section>

<?= $this->endSection() ?>