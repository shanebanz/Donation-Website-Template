<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<h2>Create Campaign</h2>

<form method="post" action="/sinag-donation/public/admin/campaign/store" enctype="multipart/form-data">

<div class="mb-3">

<label>Campaign Title</label>

<input type="text" name="title" class="form-control">

</div>

<div class="mb-3">

<label>Description</label>

<textarea name="description" class="form-control"></textarea>

</div>

<div class="mb-3">

<label>Goal Amount</label>

<input type="number" name="goal_amount" class="form-control">

</div>

<div class="mb-3">

<label>Campaign Image</label>

<input type="file" name="image" class="form-control">

</div>

<button class="btn btn-success">
Create Campaign
</button>

</form>

<?= $this->endSection() ?>