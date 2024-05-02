<?php

namespace App\Http\Controllers;

use Exception;
use PDOException;
use App\Models\Kategori;
use App\Http\Requests\KategoriRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\KategoriExport;
use App\Imports\KategoriImport;


class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            // Retrieve data kategori with eager loading for categories
            $data['kategori'] = Kategori::get();
            return view('kategori.index', ['title' => 'kategori'])->with($data);
        } catch (QueryException | Exception | PDOException $error) {
            // Handle the error gracefully
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
    public function store(KategoriRequest $request)
    {
        try {
            Kategori::create($request->all()); //query input ke table
            return redirect('kategori')->with('success', 'Data kategori berhasil ditambahkan!');
        } catch (QueryException | Exception | PDOException $error) {

            // $this->failResponse($error->getMessage(), $error->getCode());
            return 'haha error' . $error->getMessage() . $error->getCode();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Kategori $kategori)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kategori $kategori)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(KategoriRequest $request, $id)
    {
        try {
            // Validasi data yang dikirimkan
            $validatedData = $request->validated();
    
            // Update data kategori
            Kategori::find($id)->update($validatedData);
    
            return redirect('kategori')->with('success', 'Update data berhasil!');
        } catch (\Exception $error) {
            // Tangani kesalahan jika terjadi
            return 'haha error' . $error->getMessage() . $error->getCode();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            Kategori::find($id)->delete();
            return redirect('kategori')->with('success', 'Data berhasil dihapus!');
        } catch (QueryException | Exception | PDOException  $error) {
            return 'Error: ' . $error->getMessage() . ' Code: ' . $error->getCode();
        }
    }

    public function exportData()
    {
        $date = date('Y-m-d');

        return Excel::download(new KategoriExport, $date. '_Kategori.xlsx');
    }

    public function importData()
    {
        try {
            Excel::import(new KategoriImport, request()->file('import'));
        
            return redirect('kategori')->with('success', 'Import Data berhasil!');
        } catch (\Exception $e) {
            // Tangani kesalahan jika terjadi
            return redirect('kategori')->with('error', 'Terjadi kesalahan saat mengimpor data: ' . $e->getMessage());
        }
    }
}
