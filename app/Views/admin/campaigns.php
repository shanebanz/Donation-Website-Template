<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<?php
$currentPage = $currentPage ?? 1;
$totalPages  = $totalPages  ?? 1;
?>

<h2>Admin Campaign Manager</h2>

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

<td><?= esc($c->title) ?></td>

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

<?php if($totalPages > 1): ?>
<nav aria-label="Campaign pages">
<ul class="pagination">
<li class="page-item <?= $currentPage <= 1 ? 'disabled' : '' ?>">
<a class="page-link" href="/sinag-donation/public/admin/campaigns?page=<?= $currentPage - 1 ?>">&#8592; Prev</a>
</li>
<?php for($p = 1; $p <= $totalPages; $p++): ?>
<li class="page-item <?= $p === $currentPage ? 'active' : '' ?>">
<a class="page-link" href="/sinag-donation/public/admin/campaigns?page=<?= $p ?>"><?= $p ?></a>
</li>
<?php endfor; ?>
<li class="page-item <?= $currentPage >= $totalPages ? 'disabled' : '' ?>">
<a class="page-link" href="/sinag-donation/public/admin/campaigns?page=<?= $currentPage + 1 ?>">Next &#8594;</a>
</li>
</ul>
</nav>
<?php endif; ?>

<?= $this->endSection() ?>