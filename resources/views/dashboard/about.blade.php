@extends('template.layout')

@push('style')

@endpush
@section('container')
<!-- Main Content -->
<div class="page-content">
    <section class="section">
        <div class="row">
            <div class="col-12 col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="text-center">About App</h4>
                    </div>
                    <div class="card-body">
                        <div class="accordion" id="accordionExample">
							<div class="accordion-item">
								<h2 class="accordion-header" id="headingOne">
									<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
									Tentang Aplikasi
									</button>
								</h2>
								<div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
									<div class="accordion-body">
									Aplikasi ini dibuat untuk mempermudah kasir dalam melakukan transaksi. Aplikasi ini mempunyai banyak fitur salah satunya yaitu: Pengelolaan Menu, Transaksi dan lain-lain.
									</div>
								</div>
								</div>
							<div class="accordion-item">
								<h2 class="accordion-header" id="headingTwo">
									<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
									Layanan Aplikasi
									</button>
								</h2>
								<div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
									<div class="accordion-body">
										Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorem reiciendis ex quibusdam odit voluptatum architecto commodi error, eligendi voluptates rerum. Unde quod sapiente consequatur animi, voluptatibus numquam quos asperiores facilis?
									</div>
								</div>
							</div>
								<div class="accordion-item">
								<h2 class="accordion-header" id="headingThree">
									<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
									Sejarah Pembuatan
									</button>
								</h2>
								<div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
									<div class="accordion-body">
										Lorem ipsum dolor sit amet consectetur adipisicing elit. A dignissimos pariatur eaque eligendi ex, adipisci impedit nihil illo voluptate. Error eum nam, quam totam laborum est animi doloremque cumque rerum?
									</div>
								</div>
							</div>
						</div>
                    </div>
                </div>
            </div>
        </div>
    </section>
	<section class="section">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Our Location</h5>
                    </div>
                    <div class="card-body">
                        <div class="googlemaps">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126748.6091242787!2d107.57311654129782!3d-6.903273917028756!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e6398252477f%3A0x146a1f93d3e815b2!2sBandung%2C%20Bandung%20City%2C%20West%20Java!5e0!3m2!1sen!2sid!4v1633023222539!5m2!1sen!2sid" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script src="assets/static/js/components/dark.js"></script>
<script src="assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    
    
    <script src="assets/compiled/js/app.js"></script>
<!-- End Main -->
@endsection

@push('script')

@endpush