<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>

<h2 class="mb-4">Admin Dashboard</h2>

<div class="row">

<div class="col-md-4">
<div class="card shadow">
<div class="card-body">
<h5>Total Campaigns</h5>
<h2><?= $totalCampaigns ?></h2>
</div>
</div>
</div>

<div class="col-md-4">
<div class="card shadow">
<div class="card-body">
<h5>Total Donations</h5>
<h2><?= $totalDonations ?></h2>
</div>
</div>
</div>

<div class="col-md-4">
<div class="card shadow">
<div class="card-body">
<h5>Pending Donations</h5>
<h2><?= $pendingDonations ?></h2>
</div>
</div>
</div>

</div>

<?= $this->endSection() ?>