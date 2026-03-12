<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<h1><?= $campaign->title ?></h1>

<p class="text-muted">Deadline: <?= $campaign->deadline ?></p>

<div class="card mt-3">
<div class="card-body">

<?php if($campaign->image): ?>

<img src="/sinag-donation/public/uploads/<?= $campaign->image ?>" class="img-fluid mb-3">

<?php endif; ?>

<p><?= $campaign->description ?></p>

<h5>Goal: ₱<?= number_format($campaign->goal_amount) ?></h5>

<h5>Raised: ₱<?= number_format($total) ?></h5>

<div class="mt-3">

<div class="progress">

<div class="progress-bar bg-success"
role="progressbar"
style="width: <?= $progress ?>%">

<?= $progress ?>%

</div>

</div>

</div>

<br>

<a href="/sinag-donation/public/donate/<?= $campaign->id ?>" class="btn btn-success">
Donate
</a>

<button class="btn btn-warning">
Pledge to Help
</button>

</div>
</div>

<?= $this->endSection() ?>