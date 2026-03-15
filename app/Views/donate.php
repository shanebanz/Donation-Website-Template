<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<?php
$safeProgress = max(0, min(100, (int) round($progress)));
?>

<style>
.donate-wrap{
display:grid;
grid-template-columns:1fr 1.25fr;
gap:24px;
align-items:start;
}

.donate-side,
.donate-form-card{
background:#fff;
border-radius:16px;
box-shadow:0 12px 24px rgba(16,24,19,.08);
overflow:hidden;
}

.donate-cover,
.donate-cover-placeholder{
width:100%;
height:250px;
object-fit:cover;
}

.donate-cover-placeholder{
background:linear-gradient(135deg,#dce7d8 0%,#cfdcc9 100%);
}

.donate-side-body,
.donate-form-body{
padding:20px;
}

.donate-kicker{
font-size:.82rem;
font-weight:700;
letter-spacing:.5px;
text-transform:uppercase;
color:#5f7c2f;
margin-bottom:6px;
}

.donate-title{
font-size:1.35rem;
line-height:1.35;
margin-bottom:10px;
}

.mini-stats{
display:grid;
grid-template-columns:repeat(2,minmax(0,1fr));
gap:10px;
margin:12px 0;
}

.mini-stat{
border:1px solid #e2e8de;
background:#fafcf9;
border-radius:12px;
padding:10px;
}

.mini-label{
font-size:.76rem;
text-transform:uppercase;
letter-spacing:.4px;
color:#667264;
margin-bottom:2px;
}

.mini-value{
font-weight:700;
font-size:1.05rem;
}

.trust-list{
margin:12px 0 0;
padding-left:18px;
color:#586657;
}

.donate-form-card h2{
font-size:1.7rem;
margin-bottom:6px;
}

.form-note{
color:#647262;
margin-bottom:14px;
}

.form-label{
font-weight:600;
}

.form-control{
padding:.7rem .8rem;
border-radius:10px;
}

@media (max-width: 992px){
.donate-wrap{
grid-template-columns:1fr;
}
}

@media (max-width: 576px){
.donate-side-body,
.donate-form-body{
padding:16px;
}

.donate-cover,
.donate-cover-placeholder{
height:190px;
}

.mini-stats{
grid-template-columns:1fr;
}

.trust-list li,
.form-note{
font-size:.93rem;
}
}
</style>

<div class="donate-wrap">

<aside class="donate-side">

<?php if(!empty($campaign->image)): ?>
<img src="/sinag-donation/public/uploads/<?= $campaign->image ?>" class="donate-cover" alt="<?= esc($campaign->title) ?>">
<?php else: ?>
<div class="donate-cover-placeholder"></div>
<?php endif; ?>

<div class="donate-side-body">
<p class="donate-kicker mb-0">You Are Supporting</p>
<h3 class="donate-title"><?= $campaign->title ?></h3>

<p><?= $campaign->description ?></p>

<div class="mini-stats">
<div class="mini-stat">
<div class="mini-label">Goal</div>
<div class="mini-value">₱<?= number_format($campaign->goal_amount) ?></div>
</div>
<div class="mini-stat">
<div class="mini-label">Raised</div>
<div class="mini-value">₱<?= number_format($campaign->current_amount) ?></div>
</div>
</div>

<div class="progress mb-3">
<div class="progress-bar bg-success" style="width: <?= $safeProgress ?>%">
<?= $safeProgress ?>%
</div>
</div>

<ul class="trust-list">
<li>Donation verification is reviewed by admin.</li>
<li>Reference number helps us confirm your transfer.</li>
<li>Updates are reflected after approval.</li>
</ul>
</div>

</aside>

<section class="donate-form-card">
<div class="donate-form-body">

<h2>Donate to <?= $campaign->title ?></h2>
<p class="form-note">Complete the form below to submit your donation proof.</p>

<form method="post" action="/sinag-donation/public/donate/save" enctype="multipart/form-data">

<input type="hidden" name="campaign_id" value="<?= $campaign->id ?>">

<div class="mb-3">
<label class="form-label">Donor Name</label>
<input type="text" name="donor_name" class="form-control" required>
</div>

<div class="mb-3">
<label class="form-label">Amount</label>
<input type="number" name="amount" min="1" class="form-control" required>
</div>

<div class="mb-3">
<label class="form-label">Reference Number (GCash / Google Pay)</label>
<input type="text" name="reference" class="form-control" required>
</div>

<div class="mb-3">
<label class="form-label">Upload Payment Screenshot</label>
<input type="file" name="proof" class="form-control" required>
</div>

<button class="btn btn-success px-4">
Submit Donation
</button>

</form>

</div>
</section>

</div>

<?= $this->endSection() ?>