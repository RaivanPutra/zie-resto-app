<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Http\Requests\TransaksiRequest;
use App\Models\Jenis;
use App\Models\Transaksi;
use App\Models\DetailTransaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Exception;
use PDOException;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            // Mengambil data menu dengan jenis dan menu
            $data['jenis'] = Jenis::with(['menu'])->orderBy('created_at', 'DESC')->get();
            // dd($data['jenis']); // Jika Anda ingin memeriksa data yang diambil
            return view('pemesanan.index', ['title' => 'Pemesanan'])->with($data);
        } catch (QueryException | Exception | PDOException $error) {
            // Menangani error
            return 'Error: ' . $error->getMessage() . ' Code: ' . $error->getCode();
        };
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TransaksiRequest $request)
    {
        try {
            DB::beginTransaction();

            $last_id = Transaksi::where('tanggal', date('Y-m-d'))->orderBy('created_at', 'DESC')->select('id')->first();

            $notrans = $last_id == null ? date('Y-m-d').'0001' : date('Y-m-d').sprintf('%04d', substr($last_id->id, 8) + 1);

            $insertTransaksi = Transaksi::create([
                'id' => $notrans,
                'tanggal' => date('Y-m-d'),
                'total_harga' => $request->total,
                'metode_pembayaran' => 'cash',
                'keterangan' => ''
            ]);
            if (!$insertTransaksi->exists) return 'error';

            // input detail transaksi
            foreach ($request->orderedList as $detail) {
                $insertDetailTransaksi = DetailTransaksi::create([
                    'id_transaksi' => $notrans,
                    'menu_id' => $detail['menu_id'],
                    'jumlah' => $detail['qty'],
                    'subtotal' => $detail['harga'] * $detail['qty']
                ]);
            }
            DB::commit();
            return response()->json(['status' => true, 'message' => 'Pemesanan Berhasil!', 'notrans' => $notrans]);
            
        } catch (QueryException | Exception | PDOException $error) {
            DB::rollback();
            return response()->json(['status' => false, 'message' => 'Pemesanan Gagal!']);
        }
    }

    public function faktur($nofaktur)
    {
        try {
            $data['transaksi'] = Transaksi::where('id', $nofaktur)->with(['detailTransaksi' => function ($query) {
                $query->with('menu');
            }])->first();
            return view('cetak.faktur')->with($data);
        } catch (QueryException | Exception | PDOException $error) {
            return response()->json(['status' => false, 'message' => 'Pemesanan Gagal!']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaksi $transaksi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaksi $transaksi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTransaksiRequest $request, Transaksi $transaksi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaksi $transaksi)
    {
        //
    }
}
