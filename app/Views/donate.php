<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<h2 class="mb-3">Donate to <?= $campaign->title ?></h2>

<div class="card">
<div class="card-body">

<p><?= $campaign->description ?></p>

<p><strong>Goal:</strong> ₱<?= number_format($campaign->goal_amount) ?></p>
<p><strong>Raised:</strong> ₱<?= number_format($campaign->current_amount) ?></p>

<div class="progress mb-3">
<div class="progress-bar bg-success" style="width: <?= $progress ?>%">
<?= round($progress) ?>%
</div>
</div>

<form method="post" action="/sinag-donation/public/donate/save" enctype="multipart/form-data">

<input type="hidden" name="campaign_id" value="<?= $campaign->id ?>">

<div class="mb-3">
<label>Donor Name</label>
<input type="text" name="donor_name" class="form-control" required>
</div>

<div class="mb-3">
<label>Amount</label>
<input type="number" name="amount" class="form-control" required>
</div>

<div class="mb-3">
<label>Reference Number (GCash / Google Pay)</label>
<input type="text" name="reference" class="form-control" required>
</div>

<div class="mb-3">
<label>Upload Payment Screenshot</label>
<input type="file" name="proof" class="form-control" required>
</div>

<button class="btn btn-success">
Submit Donation
</button>

</form>

</div>
</div>

<?= $this->endSection() ?>