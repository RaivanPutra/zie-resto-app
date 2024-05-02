 <section class="section">
     <div class="">
         <div class="card-body">
             <div class="table-responsive">
                 <table class="table" id="table1">
                     <thead>
                         <tr>
                             <th>No</th>
                             <th>Nomor meja</th>
                             <th>Kapasitas Meja</th>
                             <th>Status</th>
                             <th>Action</th>
                         </tr>
                     </thead>
                     <tbody>
                         @foreach ($meja as $m)
                         <tr>
                             <td>{{ $i = !isset($i) ? ($i = 1) : ++$i }}</td>
                             <td>{{ $m->no_meja }}</td>
                             <td>{{ $m->kapasitas }}</td>
                             <td>{{ $m->status }}</td>
                             <td>
                                 <form method="post" style="display: inline"
                                     action="{{ url(request()->segment(1) . '/' . $m->id) }}">
                                     @method('DELETE')
                                     @csrf
                                     <button type="button" title="Delete" class="btn btn-danger delete-data">
                                         <i class="fas fa-trash danger"></i>
                                     </button>
                                 </form>
                                 <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#formmejaModal"
                                     data-mode="edit" data-id="{{ $m->id }}" data-no_meja="{{ $m->no_meja }}" data-kapasitas="{{ $m->kapasitas }}" data-status="{{ $m->status }}">
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