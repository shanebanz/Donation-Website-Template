<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="card shadow p-4">

<h3><?= $campaign->title ?></h3>

<p><?= $campaign->description ?></p>

<hr>

<h5>Goal: ₱<?= number_format($campaign->goal_amount) ?></h5>

<div class="progress mb-3">

<div class="progress-bar bg-success" style="width:<?= $progress ?>%">

<?= $progress ?>%

</div>

</div>

<form method="post" action="/sinag-donation/public/donate/submit">

<input type="hidden" name="campaign_id" value="<?= $campaign->id ?>">

<div class="mb-3">

<label>Name</label>

<input type="text" name="donor_name" class="form-control" required>

</div>

<div class="mb-3">

<label>Amount</label>

<input type="number" name="amount" class="form-control" required>

</div>

<div class="mb-3">

<label>GCash Reference Number</label>

<input type="text" name="reference_number" class="form-control">

</div>

<button class="btn btn-success">
Donate Now
</button>

</form>

</div>

<?= $this->endSection() ?>