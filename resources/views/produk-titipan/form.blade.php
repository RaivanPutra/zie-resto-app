<div class="modal fade text-left" id="formProdukModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"
     aria-hidden="true">
     <div class="modal-dialog" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="myModalLabel1">Tambah Produk Titipan</h5>
                 <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                     <i data-feather="x"></i>
                 </button>
             </div>
             <div class="modal-body">
                 <section id="multiple-column-form">
                     <div class="row match-height">
                         <div class="col-12">
                             <div>
                                 <div class="card-content overflow">
                                     <div class="card-body">
                                         <form class="form" action="produk-titipan" method="post" data-parsley-validate>
                                             @csrf
                                             <div id="method"></div>
                                             <div class="row">
                                                 <div class="col-md-12 col-12">
                                                     <div class="form-group ">
                                                         <label for="nama_produk" class="form-label">Nama Produk</label>
                                                         <input type="text" name="nama_produk" id="nama_produk"
                                                             class="form-control" placeholder=" Nama Produk"
                                                             name="fname-column" data-parsley-required="true" />
                                                     </div>
                                                     <div class="form-group ">
                                                         <label for="nama_supplier" class="form-label">Nama Supplier</label>
                                                         <input type="text" name="nama_supplier" id="nama_supplier"
                                                             class="form-control" placeholder=" Nama Supplier"
                                                             name="fname-column" data-parsley-required="true" />
                                                     </div>
                                                     <div class="form-group ">
                                                         <label for="harga_beli" class="form-label">Harga Beli</label>
                                                         <input type="text" name="harga_beli" id="harga_beli"
                                                             class="form-control" placeholder=" Harga Beli"
                                                             name="fname-column" data-parsley-required="true" />
                                                     </div>
                                                     <div class="form-group ">
                                                         <label for="harga_jual" class="form-label">Harga Jual</label>
                                                         <input type="text" name="harga_jual" id="harga_jual"
                                                             class="form-control" placeholder=" Harga Jual"
                                                             name="fname-column" data-parsley-required="true" readonly/>
                                                     </div>
                                                     <div class="form-group ">
                                                         <label for="stok" class="form-label">Stok</label>
                                                         <input type="text" name="stok" id="stok"
                                                             class="form-control" placeholder=" Stok"
                                                             name="fname-column" data-parsley-required="true" />
                                                     </div>
                                                     <div class="form-group ">
                                                         <label for="keterangan" class="form-label">Keterangan</label>
                                                         <input type="text" name="keterangan" id="keterangan"
                                                             class="form-control" placeholder=" Keterangan"
                                                             name="fname-column" data-parsley-required="true" />
                                                     </div>
                                                 </div>
                                             </div>
                                             
                                             <div class="row">
                                                 <div class="modal-footer">
                                                     <div class="col-12 d-flex justify-content-end">
                                                         <button type="submit" class="btn btn-primary me-1 mb-1">
                                                             Submit
                                                         </button>
                                                         <button type="reset" class="btn btn-light-secondary me-1 mb-1">
                                                             Reset
                                                         </button>
                                                     </div>
                                                 </div>
                                             </div>
                                         </form>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </section>
             </div>
         </div>
     </div>
 </div>