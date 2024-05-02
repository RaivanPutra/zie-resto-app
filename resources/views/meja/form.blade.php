 <div class="modal fade text-left" id="formMejaModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"
     aria-hidden="true">
     <div class="modal-dialog" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="myModalLabel1">Tambah Kategori</h5>
                 <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                     <i data-feather="x"></i>
                 </button>
             </div>
             <div class="modal-body">
                 <section id="multiple-column-form">
                     <div class="row match-height">
                         <div class="col-12">
                             <div>
                                 <div class="card-content">
                                     <div class="card-body">
                                         <form class="form" action="Kategori" method="post" data-parsley-validate>
                                             @csrf
                                             <div id="method"></div>
                                             <div class="row">
                                                 <div class="col-md-12 col-12">
                                                     <div class="form-group mandatory">
                                                         <label for="no_meja" class="form-label">Nomor Meja</label>
                                                         <input type="text" name="no_meja" id="no_meja"
                                                             class="form-control" placeholder="Nomor Meja"
                                                             name="fname-column" data-parsley-required="true" />
                                                     </div>
                                                     <div class="form-group mandatory">
                                                         <label for="kapasitas" class="form-label">Kapasitas Meja</label>
                                                         <input type="text" name="kapasitas" id="kapasitas"
                                                             class="form-control" placeholder="Kapasitas"
                                                             name="fname-column" data-parsley-required="true" />
                                                     </div>
                                                     <div class="form-group mandatory">
                                                         <label for="status" class="form-label">Pilih Status</label>
                                                         <select class="form-select" name="status" id="status">
                                                             <option value="" selected disabled>- Pilih Status -
                                                             </option>
                                                             <option value="Kosong">Kosong</option>
                                                             <option value="Terisi">Terisi</option>
                                                         </select>
                                                     </div>
                                                 </div>
                                             </div>
                                             <div class="row">
                                                 <div class="col-12">
                                                     <div class="form-group mandatory">
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