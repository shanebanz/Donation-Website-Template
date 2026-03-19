<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<?php
$currentPage = $currentPage ?? 1;
$totalPages  = $totalPages  ?? 1;

$formatDonorName = static function ($donorName): string {
	$name = (string) $donorName;

	if (preg_match('/^__ANON__:\s*/', $name) === 1) {
		return 'Anonymous';
	}

	return $name !== '' ? $name : 'Anonymous';
};
?>

<h2>Donations</h2>

<div class="table-responsive">
<table class="table table-bordered align-middle">

<thead>
<tr>
<th>ID</th>
<th>Campaign</th>
<th>Donor</th>
<th>Amount</th>
<th>Reference</th>
<th>Proof</th>
<th>Status</th>
</tr>
</thead>

<tbody>

<?php foreach($donations as $d): ?>

<tr>

<td><?= $d->id ?></td>

<td><?= esc($d->title) ?></td>

<td><?= esc($formatDonorName($d->donor_name)) ?></td>

<td>₱<?= number_format($d->amount) ?></td>

<td><?= esc($d->reference_number) ?></td>

<td>
<?php if(!empty($d->proof)): ?>
<button
	type="button"
	class="btn btn-outline-secondary btn-sm js-view-proof"
	data-bs-toggle="modal"
	data-bs-target="#proofModal"
	data-proof-url="/sinag-donation/public/uploads/<?= esc($d->proof) ?>"
	data-donor="<?= esc($formatDonorName($d->donor_name)) ?>"
	data-reference="<?= esc($d->reference_number) ?>"
>
View Screenshot
</button>
<?php else: ?>
<span class="text-muted">No file</span>
<?php endif; ?>
</td>

<td>

<?php if($d->status == 'pending'): ?>

<a href="/sinag-donation/public/admin/approve/<?= $d->id ?>" class="btn btn-success btn-sm">
Approve
</a>

<a href="/sinag-donation/public/admin/reject/<?= $d->id ?>" class="btn btn-danger btn-sm">
Reject
</a>

<?php else: ?>

<?= esc($d->status) ?>

<?php endif; ?>

</td>

</tr>

<?php endforeach; ?>

</tbody>

</table>
</div>

<div class="modal fade" id="proofModal" tabindex="-1" aria-labelledby="proofModalLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered modal-lg">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="proofModalLabel">Donation Proof</h5>
<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
<p class="text-muted mb-2" id="proofMeta"></p>
<img id="proofPreviewImage" src="" alt="Donation proof screenshot" class="img-fluid rounded border" loading="lazy">
</div>
</div>
</div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
	const modal = document.getElementById('proofModal');
	if (!modal) return;

	const previewImage = document.getElementById('proofPreviewImage');
	const proofMeta = document.getElementById('proofMeta');

	document.querySelectorAll('.js-view-proof').forEach(function (button) {
		button.addEventListener('click', function () {
			const proofUrl = button.getAttribute('data-proof-url') || '';
			const donor = button.getAttribute('data-donor') || 'Unknown donor';
			const reference = button.getAttribute('data-reference') || 'N/A';

			previewImage.setAttribute('src', proofUrl);
			previewImage.setAttribute('alt', 'Donation proof by ' + donor);
			proofMeta.textContent = 'Donor: ' + donor + ' | Reference: ' + reference;
		});
	});

	modal.addEventListener('hidden.bs.modal', function () {
		previewImage.setAttribute('src', '');
		proofMeta.textContent = '';
	});
});
</script>

<?php if($totalPages > 1): ?>
<nav aria-label="Donation pages">
<ul class="pagination">
<li class="page-item <?= $currentPage <= 1 ? 'disabled' : '' ?>">
<a class="page-link" href="/sinag-donation/public/admin/donations?page=<?= $currentPage - 1 ?>">&#8592; Prev</a>
</li>
<?php for($p = 1; $p <= $totalPages; $p++): ?>
<li class="page-item <?= $p === $currentPage ? 'active' : '' ?>">
<a class="page-link" href="/sinag-donation/public/admin/donations?page=<?= $p ?>"><?= $p ?></a>
</li>
<?php endfor; ?>
<li class="page-item <?= $currentPage >= $totalPages ? 'disabled' : '' ?>">
<a class="page-link" href="/sinag-donation/public/admin/donations?page=<?= $currentPage + 1 ?>">Next &#8594;</a>
</li>
</ul>
</nav>
<?php endif; ?>

<?= $this->endSection() ?>