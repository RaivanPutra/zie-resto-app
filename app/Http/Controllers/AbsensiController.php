<?php

namespace App\Http\Controllers;

use Exception;
use PDOException;
use App\Models\Absensi;
use App\Http\Requests\AbsensiRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AbsensiExport;

class AbsensiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            // query utnuk mengambil data absensi
            $absensi = Absensi::get();
            return view('absensi.index', ['title' => 'Absensi Kerja', 'absensi' => $absensi]);
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
    public function store(AbsensiRequest $request)
    {
        try {
            Absensi::create($request->all()); // query input ke table
            return redirect('absensi')->with('success', 'Data absensi berhasil ditambahkan!');
        } catch (QueryException | Exception | PDOException $error) {

            // $this->failResponse($error->getMessage(), $error->getCode());
            return 'haha error' . $error->getMessage() . $error->getCode();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Absensi $absensi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Absensi $absensi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AbsensiRequest $request, $id)
    {
        try {
            // Validasi data yang dikirimkan
            $validatedData = $request->validated();
    
            // Update data absensi
            Absensi::find($id)->update($validatedData);
    
            return redirect('absensi')->with('success', 'Update data berhasil!');
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
            Absensi::find($id)->delete();
            return redirect('absensi')->with('success', 'Data berhasil dihapus!');
        } catch (QueryException | Exception | PDOException  $error) {
            return 'haha error' . $error->getMessage() . $error->getCode();
        }
    }

    public function exportData()
    {
        $date = date('Y-m-d');

        return Excel::download(new AbsensiExport, $date. '_absensi.xlsx');
    }
}
