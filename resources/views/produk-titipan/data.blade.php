<div class="page-content">
    <section class="section">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" id="table1">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Produk</th>
                                <th>Nama Supplier</th>
                                <th>Harga Beli</th>
                                <th>Harga Jual</th>
                                <th>Stok</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($PTitipan as $pt)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $pt->nama_produk }}</td>
                                <td>{{ $pt->nama_supplier }}</td>
                                <td>{{ $pt->harga_beli }}</td>
                                <td>{{ $pt->harga_jual }}</td>
                                <td class="editable-stok" data-id="{{ $pt->id }}">{{ $pt->stok }}</td>
                                <td>
                                    <form method="post" style="display: inline"
                                        action="{{ url(request()->segment(1) . '/' . $pt->id) }}">
                                        @method('DELETE')
                                        @csrf
                                        <button type="button" title="Delete" class="btn btn-danger delete-data">
                                            <i class="fas fa-trash danger"></i>
                                        </button>
                                    </form>
                                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#formProdukModal"
                                        data-mode="edit" data-id="{{ $pt->id }}" data-nama_produk="{{ $pt->nama_produk }}" data-nama_supplier="{{ $pt->nama_supplier }}" data-harga_beli="{{ $pt->harga_beli }}" data-harga_jual="{{ $pt->harga_jual }}" data-stok="{{ $pt->stok }}" data-keterangan="{{ $pt->keterangan }}">
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
</div>