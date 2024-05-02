<div class="modal fade text-left" id="formAbsensiModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"
     aria-hidden="true">
     <div class="modal-dialog" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="myModalLabel1">Tambah Data Absensi</h5>
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
                                         <form class="form" action="absensi-kerja" method="post" data-parsley-validate>
                                             @csrf
                                             <div id="method"></div>
                                             <div class="row">
                                                 <div class="col-md-12 col-12">
                                                     <div class="form-group ">
                                                         <label for="namaKaryawan" class="form-label">Nama Karyawan</label>
                                                         <input type="text" name="namaKaryawan" id="namaKaryawan"
                                                             class="form-control" placeholder=" Nama Karyawan"
                                                             name="fname-column" data-parsley-required="true" />
                                                     </div>
                                                     <div class="form-group ">
                                                         <label for="tanggalMasuk" class="form-label">Tanggal Masuk</label>
                                                         <input type="date" name="tanggalMasuk" id="tanggalMasuk" class="form-control flatpickr-time-picker-24h" placeholder="Select time..">
                                                     </div>
                                                     <div class="form-group ">
                                                         <label for="waktuMasuk" class="form-label">Waktu Masuk</label>
                                                         <input type="time" name="waktuMasuk" id="waktuMasuk" class="form-control flatpickr-time-picker-24h" placeholder="Select time..">
                                                     </div>
                                                     <div class="form-group mandatory">
                                                         <label for="status" class="form-label">Pilih Status</label>
                                                         <select class="form-select" name="status" id="status">
                                                             <option value="" selected disabled>- Pilih Status -
                                                             </option>
                                                             <option value="masuk">Masuk</option>
                                                             <option value="cuti">Cuti</option>
                                                             <option value="sakit">Sakit</option>
                                                         </select>
                                                     </div>
                                                     <div class="form-group ">
                                                         <label for="waktuKeluar" class="form-label">Waktu Selesai Kerja</label>
                                                         <input type="time" name="waktuKeluar" id="waktuKeluar" class="form-control flatpickr-time-picker-24h" placeholder="Select time..">
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