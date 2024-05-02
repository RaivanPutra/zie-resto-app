 <section class="section">
     <div class="">
         <div class="card-body">
             <div class="table-responsive">
                 <table class="table" id="table1">
                     <thead>
                         <tr>
                             <th>No</th>
                             <th>Jenis</th>
                             <th>Nama Menu</th>
                             <th>Harga</th>
                             <th>Image</th>
                             <th>Deskripsi</th>
                             <th>Action</th>
                         </tr>
                     </thead>
                     <tbody>
                         @foreach ($menu as $m)
                         <tr>
                             <td>{{ $i = !isset($i) ? ($i = 1) : ++$i }}</td>
                             <td>{{ $m->jenis->nama_jenis }}</td>
                             <td>{{ $m->nama_menu }}</td>
                             <td>{{ $m->harga }}</td>
                             <td><img width="100px" src="{{ asset('storage/menu-image/' . $m->image) }}" alt=""></td>
                             <td>{{ $m->deskripsi }}</td>
                             <td>
                                 <form method="post" style="display: inline"
                                     action="{{ url(request()->segment(1) . '/' . $m->id) }}">
                                     @method('DELETE')
                                     @csrf
                                     <button type="button" title="Delete" class="btn btn-danger delete-data mb-2">
                                         <i class="fas fa-trash danger"></i>
                                     </button>
                                 </form>
                                 <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#formMenuModal"
                                     data-mode="edit" data-id="{{ $m->id }}" data-nama_jenis="{{ $m->nama_jenis }}" data-nama_menu="{{ $m->nama_menu }}" data-jenis_id="{{ $m->jenis_id }}" data-harga="{{ $m->harga }}" data-image="{{ $m->image }}" data-deskripsi="{{ $m->deskripsi }}">
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