 <section class="section">
     <div class="">
         <div class="card-body">
             <div class="table-responsive">
                 <table class="table" id="table1">
                     <thead>
                         <tr>
                             <th>No</th>
                             <th>Nama Member</th>
                             <th>Email</th>
                             <th>No Telpon</th>
                             <th>Alamat</th>
                             <th>Action</th>
                         </tr>
                     </thead>
                     <tbody>
                         @foreach ($member as $m)
                         <tr>
                             <td>{{ $i = !isset($i) ? ($i = 1) : ++$i }}</td>
                             <td>{{ $m->nama }}</td>
                             <td>{{ $m->email }}</td>
                             <td>{{ $m->no_tlp }}</td>
                             <td>{{ $m->alamat }}</td>
                             <td>
                                 <form method="post" style="display: inline"
                                     action="{{ url(request()->segment(1) . '/' . $m->id) }}">
                                     @method('DELETE')
                                     @csrf
                                     <button type="button" title="Delete" class="btn btn-danger delete-data">
                                         <i class="fas fa-trash danger"></i>
                                     </button>
                                 </form>
                                 <button class="btn btn-success" data-bs-toggle="modal"
                                     data-bs-target="#formModalMember" data-mode="edit" data-id="{{ $m->id }}"
                                     data-nama="{{ $m->nama }}" data-email="{{ $m->email }}"
                                     data-no_tlp="{{ $m->no_tlp }}" data-alamat="{{ $m->alamat }}">
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