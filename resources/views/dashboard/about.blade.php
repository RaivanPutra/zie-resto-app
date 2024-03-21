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
</div>

<script src="assets/static/js/components/dark.js"></script>
<script src="assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    
    
    <script src="assets/compiled/js/app.js"></script>
<!-- End Main -->
@endsection

@push('script')

@endpush