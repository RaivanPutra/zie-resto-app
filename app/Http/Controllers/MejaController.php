<?php

namespace App\Http\Controllers;

use Exception;
use PDOException;
use App\Models\Meja;
use App\Http\Requests\MejaRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\MejaExport;
use App\Imports\MejaImport;


class MejaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            // Retrieve data meja with eager loading for categories
            $meja = Meja::get();
            return view('meja.index', ['title' => 'Meja', 'meja' => $meja]);
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
    public function store(MejaRequest $request)
    {
        try {
            Meja::create($request->all()); //query input ke table
            return redirect('meja')->with('success', 'Data meja berhasil ditambahkan!');
        } catch (QueryException | Exception | PDOException $error) {

            // $this->failResponse($error->getMessage(), $error->getCode());
            return 'haha error' . $error->getMessage() . $error->getCode();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Meja $meja)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Meja $meja)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MejaRequest $request, $id)
    {
        try {
            Meja::find($id)->update($request->all());
    
            return redirect('meja')->with('success', 'Update data berhasil!');
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
            Meja::find($id)->delete();
            return redirect('meja')->with('success', 'Data berhasil dihapus!');
        } catch (QueryException | Exception | PDOException  $error) {
            $this->failResponse($error->getMessage() . $error->getCode());
        }
    }

    public function exportData()
    {
        $date = date('Y-m-d');

        return Excel::download(new MejaExport, $date. '_meja.xlsx');
    }

    public function importData()
    {
        try {
            Excel::import(new MejaImport, request()->file('import'));
        
            return redirect('meja')->with('success', 'Import Data berhasil!');
        } catch (\Exception $e) {
            // Tangani kesalahan jika terjadi
            return redirect('meja')->with('error', 'Terjadi kesalahan saat mengimpor data: ' . $e->getMessage());
        }
    }
}
