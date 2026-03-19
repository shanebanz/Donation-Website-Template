<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<?php
$safeProgress = max(0, min(100, (int) round($progress)));
$paymentQrImage = $paymentQrImage ?? '';
$paymentAccountName = $paymentAccountName ?? 'SINAG Donation';
$paymentAccountNumber = $paymentAccountNumber ?? '';
$paymentMethods = $paymentMethods ?? ['GCash'];
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

.payment-destination{
border:1px solid #dbe5d7;
border-radius:12px;
padding:14px;
background:#f8fbf6;
margin-bottom:14px;
}

.payment-grid{
display:grid;
grid-template-columns:120px 1fr;
gap:12px;
align-items:center;
}

.payment-qr{
width:120px;
height:120px;
object-fit:cover;
border-radius:10px;
border:1px solid #d6e0d1;
background:#fff;
}

.payment-title{
font-size:.86rem;
font-weight:700;
letter-spacing:.45px;
text-transform:uppercase;
color:#5f7c2f;
margin-bottom:6px;
}

.payment-meta{
font-size:.92rem;
color:#435340;
margin-bottom:2px;
}

.payment-help{
font-size:.86rem;
color:#627060;
margin:8px 0 0;
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

.payment-grid{
grid-template-columns:1fr;
}

.payment-qr{
width:100%;
max-width:180px;
height:180px;
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

<div class="payment-destination">
<div class="payment-title">Where To Send Your Donation</div>
<div class="payment-grid">
<?php if(!empty($paymentQrImage)): ?>
<img src="<?= esc($paymentQrImage) ?>" alt="Donation QR" class="payment-qr">
<?php endif; ?>
<div>
<div class="payment-meta"><strong>Account Name:</strong> <?= esc($paymentAccountName) ?></div>
<?php if(!empty($paymentAccountNumber)): ?>
<div class="payment-meta"><strong>Account Number:</strong> <?= esc($paymentAccountNumber) ?></div>
<?php endif; ?>
<div class="payment-meta"><strong>Supported:</strong> <?= esc(implode(', ', $paymentMethods)) ?></div>
<p class="payment-help">Scan the QR using GCash or Google Pay, send your amount, then submit the reference number and screenshot below.</p>
</div>
</div>
</div>

<form method="post" action="/sinag-donation/public/donate/save" enctype="multipart/form-data">

<input type="hidden" name="campaign_id" value="<?= $campaign->id ?>">

<div class="mb-3">
<label class="form-label">Donor Name</label>
<input type="text" name="donor_name" id="donor_name" class="form-control" value="<?= esc((string) (session()->get('name') ?? '')) ?>" required>
<div class="form-check mt-2">
<input class="form-check-input" type="checkbox" id="is_anonymous" name="is_anonymous" value="1">
<label class="form-check-label" for="is_anonymous">Donate anonymously</label>
</div>
</div>

<div class="mb-3">
<label class="form-label">Amount</label>
<input type="number" name="amount" min="1" class="form-control" required>
</div>

<div class="mb-3">
<label class="form-label">Payment Method</label>
<select name="payment_method" class="form-control" required>
<?php foreach($paymentMethods as $method): ?>
<option value="<?= esc($method) ?>"><?= esc($method) ?></option>
<?php endforeach; ?>
</select>
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

<script>
(() => {
	const donorInput = document.getElementById('donor_name');
	const anonymousToggle = document.getElementById('is_anonymous');
	if (!donorInput || !anonymousToggle) {
		return;
	}

	const initialValue = donorInput.value;

	const syncAnonymousState = () => {
		if (anonymousToggle.checked) {
			donorInput.dataset.previousValue = donorInput.value;
			donorInput.value = 'Anonymous';
			donorInput.readOnly = true;
			donorInput.required = false;
		} else {
			donorInput.readOnly = false;
			donorInput.required = true;
			donorInput.value = donorInput.dataset.previousValue || initialValue || '';
		}
	};

	anonymousToggle.addEventListener('change', syncAnonymousState);
})();
</script>

</div>
</section>

</div>

<?= $this->endSection() ?>