<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<style>
.hiw-hero{
background:linear-gradient(135deg,#0e1712 0%,#1d2a22 65%,#2c3d31 100%);
border-radius:20px;
padding:30px;
color:#f7fbf6;
box-shadow:0 18px 32px rgba(14,23,18,.24);
margin-bottom:24px;
}

.hiw-subtitle{
max-width:760px;
color:#d7e5d6;
margin-top:10px;
}

.flow-grid{
display:grid;
grid-template-columns:repeat(4,minmax(0,1fr));
gap:14px;
margin-bottom:28px;
}

.flow-card{
background:#fff;
border-radius:14px;
padding:16px;
box-shadow:0 10px 24px rgba(16,24,19,.08);
border:1px solid #e1e8dd;
}

.flow-step{
display:inline-flex;
align-items:center;
justify-content:center;
width:34px;
height:34px;
border-radius:999px;
font-weight:700;
font-size:.9rem;
background:#5f7c2f;
color:#fff;
margin-bottom:10px;
}

.flow-title{
font-size:1.03rem;
font-weight:700;
margin-bottom:6px;
}

.flow-text{
font-size:.92rem;
color:#586657;
margin-bottom:0;
}

.section-title{
font-size:1.65rem;
margin-bottom:12px;
}

.note-box{
background:#f6f9f4;
border:1px solid #dbe6d3;
border-left:5px solid #5f7c2f;
border-radius:12px;
padding:12px 14px;
margin-bottom:24px;
color:#49574a;
}

.accordion-button{
font-weight:600;
}

.accordion-body{
font-size:.96rem;
line-height:1.62;
}

.accordion-button:not(.collapsed){
background:#edf3e9;
color:#2c4131;
}

.ops-list{
margin:0;
padding-left:20px;
}

@media (max-width: 992px){
.flow-grid{
grid-template-columns:repeat(2,minmax(0,1fr));
}
}

@media (max-width: 576px){
.hiw-hero{
padding:22px;
border-radius:16px;
}

.section-title{
font-size:1.32rem;
}

.flow-title{
font-size:1rem;
}

.flow-text,
.note-box,
.ops-list li{
font-size:.95rem;
}

.flow-card{
padding:14px;
}

.accordion-button{
padding:.8rem .9rem;
}

.accordion-body{
padding:.85rem .9rem;
}

.flow-grid{
grid-template-columns:1fr;
}
}
</style>

<section class="hiw-hero">
<p class="mb-1 text-uppercase fw-semibold" style="letter-spacing:.5px;">Sinag Donation Guide</p>
<h1 class="mb-0">How It Works</h1>
<p class="hiw-subtitle">SINAG Donation helps donors support verified campaigns transparently. Every donation entry is reviewed by admin before it is counted in campaign progress.</p>
</section>

<h2 class="section-title">Donation Flow</h2>

<div class="flow-grid">
<article class="flow-card">
<span class="flow-step">1</span>
<h3 class="flow-title">Choose a Campaign</h3>
<p class="flow-text">Browse campaign cards and open the campaign details page to review goal, raised amount, and deadline.</p>
</article>

<article class="flow-card">
<span class="flow-step">2</span>
<h3 class="flow-title">Submit Donation Proof</h3>
<p class="flow-text">On the donate form, enter donor details, amount, reference number, and upload your payment screenshot.</p>
</article>

<article class="flow-card">
<span class="flow-step">3</span>
<h3 class="flow-title">Admin Verification</h3>
<p class="flow-text">Your donation starts as pending. Admin reviews your proof and either approves or rejects the record.</p>
</article>

<article class="flow-card">
<span class="flow-step">4</span>
<h3 class="flow-title">Campaign Totals Update</h3>
<p class="flow-text">Once approved, the donation is counted toward campaign progress and reflected in raised totals.</p>
</article>
</div>

<div class="note-box">
<strong>Transparency Note:</strong> Pending and rejected entries are not treated as successful funding. Only approved donations move campaign progress forward.
<br>
If your donation is still not counted after review, please email <a href="mailto:sinagdonation_help@gmail.com">sinagdonation_help@gmail.com</a> with your donor name, amount, and reference number.
</div>

<h2 class="section-title">FAQ</h2>

<div class="accordion" id="faqAccordion">
<div class="accordion-item">
<h2 class="accordion-header" id="faqOne">
<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faqOneBody" aria-expanded="true" aria-controls="faqOneBody">
How do you verify donations?
</button>
</h2>
<div id="faqOneBody" class="accordion-collapse collapse show" aria-labelledby="faqOne" data-bs-parent="#faqAccordion">
<div class="accordion-body">
Donations are saved as pending first. Admin checks the uploaded screenshot and reference number in the admin donations panel, then marks each record as approved or rejected.
</div>
</div>
</div>

<div class="accordion-item">
<h2 class="accordion-header" id="faqTwo">
<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqTwoBody" aria-expanded="false" aria-controls="faqTwoBody">
When is my donation counted in campaign progress?
</button>
</h2>
<div id="faqTwoBody" class="accordion-collapse collapse" aria-labelledby="faqTwo" data-bs-parent="#faqAccordion">
<div class="accordion-body">
Your donation is counted only after approval. The system updates campaign totals from approved records, so progress reflects verified contributions.
</div>
</div>
</div>

<div class="accordion-item">
<h2 class="accordion-header" id="faqThree">
<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqThreeBody" aria-expanded="false" aria-controls="faqThreeBody">
Why can total donations and raised campaign amount look different?
</button>
</h2>
<div id="faqThreeBody" class="accordion-collapse collapse" aria-labelledby="faqThree" data-bs-parent="#faqAccordion">
<div class="accordion-body">
Admin dashboard totals can include all donation records by status, while campaign raised progress is based on approved donations only. This protects transparency in campaign funding.
</div>
</div>
</div>

<div class="accordion-item">
<h2 class="accordion-header" id="faqFour">
<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqFourBody" aria-expanded="false" aria-controls="faqFourBody">
What happens if a donation is rejected?
</button>
</h2>
<div id="faqFourBody" class="accordion-collapse collapse" aria-labelledby="faqFour" data-bs-parent="#faqAccordion">
<div class="accordion-body">
Rejected donations are not added to campaign totals. Donors can submit a corrected donation with complete proof and accurate reference details.
If you believe your donation should be counted, contact <a href="mailto:sinagdonation_help@gmail.com">sinagdonation_help@gmail.com</a> and include your proof screenshot and reference number.
</div>
</div>
</div>

<div class="accordion-item">
<h2 class="accordion-header" id="faqFive">
<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqFiveBody" aria-expanded="false" aria-controls="faqFiveBody">
How can I make my donation verification faster?
</button>
</h2>
<div id="faqFiveBody" class="accordion-collapse collapse" aria-labelledby="faqFive" data-bs-parent="#faqAccordion">
<div class="accordion-body">
Use the correct donation amount, include a clear screenshot, and provide an exact reference number from your payment app. Clear details help admins verify quickly.
</div>
</div>
</div>
</div>

<section class="mt-4">
<h2 class="section-title mb-2">Operational Summary</h2>
<ul class="ops-list">
<li>Donation submission creates a pending record with donor info, amount, reference number, and uploaded proof.</li>
<li>Admin approval marks the record approved and updates campaign collected amount.</li>
<li>Campaign progress shown to users is derived from verified donation outcomes.</li>
</ul>
</section>

<?= $this->endSection() ?>
