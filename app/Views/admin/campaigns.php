<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<h2>Campaigns</h2>

<a href="/sinag-donation/public/admin/campaign/create" class="btn btn-primary mb-3">
Add Campaign
</a>

<table class="table table-bordered">

<tr>
<th>ID</th>
<th>Title</th>
<th>Goal</th>
</tr>

<?php foreach($campaigns as $c): ?>

<tr>

<td><?= $c->id ?></td>

<td><?= $c->title ?></td>

<td>₱<?= number_format($c->goal_amount) ?></td>

</tr>

<?php endforeach; ?>

</table>

<?= $this->endSection() ?>