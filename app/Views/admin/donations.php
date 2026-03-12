<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<h2>Donations</h2>

<table class="table table-bordered">

<thead>
<tr>
<th>ID</th>
<th>Campaign</th>
<th>Donor</th>
<th>Amount</th>
<th>Reference</th>
<th>Status</th>
</tr>
</thead>

<tbody>

<?php foreach($donations as $d): ?>

<tr>

<td><?= $d->id ?></td>

<td><?= $d->title ?></td>

<td><?= $d->donor_name ?></td>

<td>₱<?= number_format($d->amount) ?></td>

<td><?= $d->reference_number ?></td>

<td>

<?php if($d->status == 'pending'): ?>

<a href="/sinag-donation/public/admin/approve/<?= $d->id ?>" class="btn btn-success btn-sm">
Approve
</a>

<a href="/sinag-donation/public/admin/reject/<?= $d->id ?>" class="btn btn-danger btn-sm">
Reject
</a>

<?php else: ?>

<?= $d->status ?>

<?php endif; ?>

</td>

</tr>

<?php endforeach; ?>

</tbody>

</table>

<?= $this->endSection() ?>