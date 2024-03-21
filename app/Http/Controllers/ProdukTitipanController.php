<?php

namespace App\Http\Controllers;

use App\Models\ProdukTitipan;
use App\Http\Requests\ProdukTitipanRequest;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ProdukExport;
use App\Imports\ProdukImport;

class ProdukTitipanController extends Controller
{ 
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $data['PTitipan'] = ProdukTitipan::get();
            return view('produk-titipan.index', ['title' => 'Produk Titipan'])->with($data);
        } catch (QueryException | Exception | PDOException $error) {
            return 'Error: ' . $error->getMessage() . ' Code: ' . $error->getCode();
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    /**
 * Store a newly created resource in storage.
 */
    public function store(ProdukTitipanRequest $request)
    {
        try {
            // Mengambil data dari request
            $inputData = $request->all();

            // Menghitung harga jual dengan keuntungan 70% dan pembulatan ke kelipatan 500
            $hargaBeli = $inputData['harga_beli'];
            $keuntungan = $hargaBeli * 0.7;
            $hargaJual = round((($hargaBeli + $keuntungan) / 500)) * 500;

            // Tambahkan harga jual ke dalam input data sebelum disimpan
            $inputData['harga_jual'] = $hargaJual;

            // Simpan data produk titipan
            ProdukTitipan::create($inputData);

            return redirect('titipan')->with('success', 'Data produk berhasil ditambahkan!');
        } catch (\Exception $error) {
            // Tangani kesalahan jika terjadi
            return 'Error: ' . $error->getMessage() . ' Code: ' . $error->getCode();
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(ProdukTitipan $produkTitipan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProdukTitipan $produkTitipan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProdukTitipanRequest $request, ProdukTitipan $produkTitipan, $id)
    {
        try {
            // Validasi data yang dikirimkan
            $validatedData = $request->validated();
    
            // Update data produk titipan
            ProdukTitipan::find($id)->update($validatedData);
    
            return redirect('titipan')->with('success', 'Update data berhasil!');
        } catch (\Exception $error) {
            // Tangani kesalahan jika terjadi
            return 'haha error' . $error->getMessage() . $error->getCode();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProdukTitipan $produkTitipan, $id)
    {
        try {
            $produkTitipan->find($id)->delete();
            return redirect('titipan')->with('success', 'Data berhasil dihapus!');
        } catch (QueryException | Exception | PDOException  $error) {
            $this->failResponse($error->getMessage() . $error->getCode());
        }
    }

    public function exportData()
    {
        $date = date('Y-m-d');

        return Excel::download(new ProdukExport, $date. '_paket.xlsx');
    }

    public function importData()
{
    try {
        Excel::import(new ProdukImport, request()->file('import'));

        return redirect('titipan')->with('success', 'Import Data berhasil!');
    } catch (\Exception $e) {
        // Tangani kesalahan jika terjadi
        return redirect('titipan')->with('error', 'Terjadi kesalahan saat mengimpor data: ' . $e->getMessage());
    }
}
}
