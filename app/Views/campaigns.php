<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<h2 class="mb-4">Active Campaigns</h2>

<div class="row">

<?php foreach($campaigns as $c): ?>

<div class="col-md-4 mb-4">

<div class="card shadow">

<?php if(!empty($c->image)): ?>

<img src="/sinag-donation/public/uploads/<?= $c->image ?>" class="card-img-top">

<?php endif; ?>

<div class="card-body">

<h5 class="card-title"><?= $c->title ?></h5>

<p class="card-text"><?= $c->description ?></p>

<p><strong>Goal:</strong> ₱<?= number_format($c->goal_amount) ?></p>

<a href="/sinag-donation/public/campaign/<?= $c->id ?>" class="btn btn-primary">
View Campaign
</a>

</div>

</div>

</div>

<?php endforeach; ?>

</div>

<?= $this->endSection() ?>