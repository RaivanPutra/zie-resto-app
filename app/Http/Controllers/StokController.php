<?php

namespace App\Http\Controllers;

use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\Stok;
use App\Http\Requests\StokRequest;
use App\Models\Menu;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\StokExport;
use App\Imports\StokImport;

class StokController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['menu'] = Menu::All();
        $data['stok'] = Stok::with('menu')->get();

        return view('stok.index', ['title' => 'Stok'])->with($data);
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
    public function store(StokRequest $request)
    {
        try {
            $menu_id = $request->input('menu_id');
            $jumlah = $request->input('jumlah');
            
            // Cek apakah stok untuk menu tersebut sudah ada
            $existingStok = Stok::where('menu_id', $menu_id)->first();

            if ($existingStok) {
                // Jika sudah ada, update jumlah stok
                $existingStok->update(['jumlah' => $existingStok->jumlah + $jumlah]);
            } else {
                // Jika belum ada, buat entri stok baru
                Stok::create(['menu_id' => $menu_id, 'jumlah' => $jumlah]);
            }

            return redirect('stok')->with('success', 'Data stok berhasil ditambahkan!');
        } catch (QueryException | ModelNotFoundException | \Exception $error) {
            return 'haha error' . $error->getMessage() . $error->getCode();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Stok $stok)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Stok $stok)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StokRequest $request, $id)
    {
        try {
            // Validasi data yang dikirimkan
            $validatedData = $request->validated();
    
            // Update data stok
            Stok::find($id)->update($validatedData);
    
            return redirect('stok')->with('success', 'Update data berhasil!');
        } catch (\Exception $error) {
            // Tangani kesalahan jika terjadi
            return 'haha error' . $error->getMessage() . $error->getCode();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Stok::find($id)->delete();
        return redirect('stok')->with('success','Data Stok Berhasil di Delete');
    }

    public function exportData()
    {
        $date = date('Y-m-d');

        return Excel::download(new StokExport, $date. '_stok.xlsx');
    }

    public function importData()
    {
        try {
            Excel::import(new StokImport, request()->file('import'));
        
            return redirect('stok')->with('success', 'Import Data berhasil!');
        } catch (\Exception $e) {
            // Tangani kesalahan jika terjadi
            return redirect('stok')->with('error', 'Terjadi kesalahan saat mengimpor data: ' . $e->getMessage());
        }
    }
}