<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>

<h2 class="mb-4">Donation Management</h2>

<table class="table table-bordered">

<thead class="table-dark">
<tr>
<th>Donor</th>
<th>Amount</th>
<th>Reference</th>
<th>Proof</th>
<th>Status</th>
<th>Actions</th>
</tr>
</thead>

<tbody>

<?php foreach($donations as $d): ?>

<tr>

<td><?= str_starts_with((string) $d->donor_name, '__ANON__:') ? 'Anonymous' : esc((string) $d->donor_name) ?></td>

<td>₱<?= number_format($d->amount) ?></td>

<td><?= $d->reference_number ?></td>

<td>

<?php if($d->proof): ?>

<img src="/sinag-donation/public/uploads/<?= $d->proof ?>" width="100">

<?php endif; ?>

</td>

<td><?= $d->status ?></td>

<td>

<a href="/sinag-donation/public/admin/approve/<?= $d->id ?>" class="btn btn-success btn-sm">
Approve
</a>

<a href="/sinag-donation/public/admin/reject/<?= $d->id ?>" class="btn btn-danger btn-sm">
Reject
</a>

</td>

</tr>

<?php endforeach; ?>

</tbody>

</table>

<?= $this->endSection() ?>