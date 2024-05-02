@extends('template.layout')

@push('style')
<style>
    .container {
        display: grid;
        grid-template-columns: 1fr;
        grid-gap: 20px;
        padding: 10px;
    }

    @media (min-width: 768px) {
        .container {
            grid-template-columns: 1fr 1fr;
        }
    }

    .menu-container,
    .order-container {
        padding: 20px;
        background-color: #f8f9fa;
        border: 1px solid #ced4da;
        border-radius: 10px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }

    .menu-container ul,
    .order-container ul {
        list-style-type: none;
        padding: 0;
        margin: 0;
    }

    .menu-container li,
    .order-container li {
        margin-bottom: 20px;
    }

    .menu-container li h3,
    .order-container h2 {
        text-transform: uppercase;
        font-weight: bold;
        font-size: 18px;
        color: white;
        background-color: #4a89dc;
        border-radius: 5px;
        padding: 10px;
        margin: 0;
    }

    .menu-item {
        display: flex;
        flex-wrap: wrap;
        justify-content: start;
        gap: 10px; /* Tambahkan sedikit jarak antara kartu */
    }

    .card {
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        transition: transform 0.3s ease-in-out;
        border-radius: 5px; /* Opsional: Tambahkan border-radius untuk estetika */
    }

    .card:hover {
        transform: scale(1.05); /* Tambahkan efek hovering */
    }


    .card img {
        width: 100%;
        height: auto;
        border-radius: 50%;
    }

    .ordered-list {
        list-style-type: none;
        display: flex;
        flex-direction: column;
    }

    .ordered-list li {
        display: flex;
        justify-content: space-between;
        align-items: center;
        background-color: #ffffff;
        border-radius: 5px;
        padding: 10px;
        margin-top: 5px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }

    .bayar button {
        width: 100%;
        padding: 10px;
        background-color: #5cb85c;
        color: white;
        border-radius: 5px;
        border: none;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .bayar button:hover {
        background-color: #4cae4c;
    }

    /* Responsive adjustments for small devices */
    @media (max-width: 767px) {
        .container {
            grid-template-columns: 1fr;
        }

        .card {
            width: 100%; /* Adjust card width for smaller screens */
        }

        .card-body {
            padding: 10px;
            text-align: center;
        }
    }
</style>
@endpush



@section('container')
    <div class="container">
        <div class="menu-container">
            <ul>
                @foreach ($jenis as $p)
                    <li>
                        <h3>{{ $p->nama_jenis }}</h3>
                        <ul class="menu-item">
                            @foreach ($p->menu as $menu)
                                <div class="card text-center" style="width: 150px;">
                                    <div class="card-body d-flex justify-content-center align-items-center" style="height: 120px;">
                                        <img src="{{ asset('storage/menu-image/' . $menu->image) }}" class="card-img-top rounded-circle" style="width: 100px; height: 100px;">
                                    </div>
                                    <div class="card-body">
                                        <li data-harga="{{ $menu->harga }}" data-id="{{ $menu->id }}">
                                            <h6>{{ $menu->nama_menu }}</h6>
                                            <p>Rp. {{ $menu->harga }}</p>
                                        </li>
                                    </div>
                                </div>
                            @endforeach
                        </ul>
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="order-container position-relative">
            <h2>Pesanan</h2>
            <ul class="ordered-list">
                <!-- Isi daftar pesanan akan muncul di sini -->
            </ul>
            <div class="total-container">
                Total: <h3 id="total">0</h3>
            </div>
            <div class="bayar">
                <button class="btn btn-primary btn-sm" id="bayarBtn">Bayar</button>
            </div>
        </div>
    </div>
@endsection


@push('script')
<script>
        $(function() {
    // Inisialisasi
    const orderedList = [];
    let total = 0;

    const sum = () => {
        return orderedList.reduce((accumulator, object) => {
            return accumulator + (object.harga * object.qty);
        }, 0);
    };

    const changeQty = (el, inc) => {
        const id = $(el).closest('li').data('id');
        const index = orderedList.findIndex(list => list.menu_id === id);
        
        orderedList[index].qty += (orderedList[index].qty === 1 && inc === -1) ? 0 : inc;

        const txt_subtotal = $(el).closest('li').find('.subtotal');
        const txt_qty = $(el).closest('li').find('.qty-item');

        txt_qty.val(orderedList[index].qty);
        txt_subtotal.text(`Sub Total : Rp. ${orderedList[index].harga * orderedList[index].qty}`);

        $('#total').html(sum());
    };

    $('.ordered-list').on('click', '.btn-dec', function() {
        changeQty(this, -1);
    });

    $('.ordered-list').on('click', '.btn-inc', function() {
        changeQty(this, 1);
    });

    $('.ordered-list').on('click', '.remove-item', function() {
        const id = $(this).closest('li').data('id');
        const index = orderedList.findIndex(list => list.menu_id === id);

        orderedList.splice(index, 1);
        $(this).closest('li').remove();

        $('#total').html(sum());
    });

    $('#bayarBtn').on('click', function() {
        $.ajax({
            url: "{{ route('transaksi.store') }}",
            method: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                "orderedList": orderedList,
                "total": sum()
            },
            success: function(data) {
                console.log(data);
                if (data.status) {
                    Swal.fire({
                        title: data.message,
                        showDenyButton: true,
                        confirmButtonText: "Cetak Nota",
                        denyButtonText: "OK",
                        showCloseButton: true
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.open("{{ url('nota') }}/" + data.notrans);
                            location.reload();
                        } else if (result.isDenied) {
                            location.reload();
                        }
                    });
                } else {
                    Swal.fire('Pemesanan Gagal!', '', 'error');
                }
            },
            error: function(error) {
                console.log(error);
                Swal.fire('Pemesanan Gagal!', '', 'error');
            }
        });
    });

    $(".menu-item .card li").click(function() {
        const menu_clicked = $(this).text();
        const data = $(this).data();
        const harga = parseFloat(data.harga);
        const id = parseInt(data.id);

        if (!orderedList.some(item => item.menu_id === id)) {
            const newItem = {
                'menu_id': id,
                'menu': menu_clicked,
                'harga': harga,
                'qty': 1
            };
            
            orderedList.push(newItem);

            let listOrder = `
                <li class="ordered-list-item new-item" data-id="${id}">
                    <h6>${menu_clicked}</h6>
                    <span class="subtotal">Sub Total : Rp. ${harga}</span>
                    <button class='remove-item'>hapus</button>
                    <button class="btn-dec"> - </button>
                    <input class="qty-item" type="number" value="1" style="width:35px" readonly/>
                    <button class="btn-inc">+</button>
                </li>`;
            
            $('.ordered-list').append(listOrder);
        } else {
            const index = orderedList.findIndex(item => item.menu_id === id);
            const qtyInput = $(`.ordered-list li[data-id="${id}"] .qty-item`);
            const subtotal = $(`.ordered-list li[data-id="${id}"] .subtotal`);

            orderedList[index].qty++;
            qtyInput.val(orderedList[index].qty);
            subtotal.text(`Sub Total : Rp. ${harga * orderedList[index].qty}`);
        }

        $('#total').html(sum());
    });
});

    </script>
@endpush