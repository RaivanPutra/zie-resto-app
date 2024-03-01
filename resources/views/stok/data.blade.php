 <section class="section">
     <div class="card">
         <div class="card-body">
             <div class="table-responsive">
                 <table class="table" id="table1">
                     <thead>
                         <tr>
                             <th>No</th>
                             <th>Nama Jenis</th>
                             <th>Jumlah</th>
                             <th>Action</th>
                         </tr>
                     </thead>
                     <tbody>
                         @foreach ($stok as $s)
                         <tr>
                             <td>{{ $i = !isset($i) ? ($i = 1) : ++$i }}</td>
                             <td>{{ $s->menu->nama_menu }}</td>
                             <td>{{ $s->jumlah }}</td>
                             <td>
                                 <form method="post" style="display: inline"
                                     action="{{ url(request()->segment(1) . '/' . $s->id) }}">
                                     @method('DELETE')
                                     @csrf
                                     <button type="button" title="Delete" class="btn btn-danger delete-data">
                                         <i class="fas fa-trash danger"></i>
                                     </button>
                                 </form>
                                 <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#formModalStok"
                                     data-mode="edit" data-id="{{ $s->id }}" data-nama_menu="{{ $s->nama_menu }}"
                                     data-jumlah="{{ $s->jumlah }}">
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