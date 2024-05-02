 <section class="section">
     <div class="">
         <div class="card-body">
             <div class="table-responsive">
                 <table class="table" id="table1">
                     <thead>
                         <tr>
                             <th>No</th>
                             <th>Nama Kategori</th>
                             <th>Action</th>
                         </tr>
                     </thead>
                     <tbody>
                         @foreach ($kategori as $k)
                         <tr>
                             <td>{{ $i = !isset($i) ? ($i = 1) : ++$i }}</td>
                             <td>{{ $k->nama_kategori }}</td>
                             <td>
                                 <form method="post" style="display: inline"
                                     action="{{ url(request()->segment(1) . '/' . $k->id) }}">
                                     @method('DELETE')
                                     @csrf
                                     <button type="button" title="Delete" class="btn btn-danger delete-data">
                                         <i class="fas fa-trash danger"></i>
                                     </button>
                                 </form>
                                 <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#formKategoriModal"
                                     data-mode="edit" data-id="{{ $k->id }}" data-nama_kategori="{{ $k->nama_kategori }}">
                                     <i class="fas fa-edit"></i>
                                 </button>
                             </td>

                         </tr>
                         @endforeach
                     </tbody>
                 </table>
             </div>
         </div>
     </div>
 </section>