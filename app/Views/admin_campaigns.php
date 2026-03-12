<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-4">

<h2>Admin Campaign Manager</h2>

<a href="/sinag-donation/public/logout" class="btn btn-danger">
Logout
</a>

</div>

<a href="/sinag-donation/public/admin/campaign/create" class="btn btn-success mb-3">
Create Campaign
</a>

<table class="table table-bordered table-striped">

<thead class="table-dark">

<tr>
<th>ID</th>
<th>Title</th>
<th>Goal</th>
<th>Actions</th>
</tr>

</thead>

<tbody>

<?php foreach($campaigns as $c): ?>

<tr>

<td><?= $c->id ?></td>

<td><?= $c->title ?></td>

<td>₱<?= number_format($c->goal_amount) ?></td>

<td>

<a href="/sinag-donation/public/campaign/<?= $c->id ?>" class="btn btn-primary btn-sm">
View
</a>

<a href="/sinag-donation/public/admin/campaign/edit/<?= $c->id ?>" class="btn btn-warning btn-sm">
Edit
</a>

<a href="/sinag-donation/public/admin/campaign/delete/<?= $c->id ?>" class="btn btn-danger btn-sm">
Delete
</a>

</td>

</tr>

<?php endforeach; ?>

</tbody>

</table>

<?= $this->endSection() ?>