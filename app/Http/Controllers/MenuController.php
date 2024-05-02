<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Http\Requests\MenuRequest;
use App\Models\Jenis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Exception;
use PDOException;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\MenuExport;
use App\Imports\MenuImport;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            // Mengambil data menu dengan jenis
            $data['menu'] = Menu::with(['jenis'])->orderBy('created_at', 'DESC')->get();
            $data['jenis'] = Jenis::all();
            // dd($data['menu']); // Jika Anda ingin memeriksa data yang diambil
            return view('menu.index', ['title' => 'Menu'])->with($data);
        } catch (QueryException | Exception | PDOException $error) {
            // Menangani error
            return 'Error: ' . $error->getMessage() . ' Code: ' . $error->getCode();
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
        // mengambil file gambar dari form modal
        $image= $request->file('image');
        // buat nama file
        $filename = time().'.'.$image->getClientOriginalName();
        // buat alamat folder untuk penyimpanan file
        $path = 'menu-image/'. $filename;
        // menyimpan file 'gambar' ke dalam storage
        Storage::disk('public')->put($path, file_get_contents($image));
        
        // memasukan semua file dari request form modal kedalam variable data
        $data['jenis_id'] = $request->jenis_id; 
        $data['nama_menu'] = $request->nama_menu; 
        $data['harga'] = $request->harga; 
        $data['image'] = $filename; 
        $data['deskripsi'] = $request->deskripsi; 
        
        // jalankan perintah create data
        Menu::create($data);
        return redirect('menu')->with('success', 'Data menu berhasil ditambahkan.');
    } 

    /**
     * Update the specified resource in storage.
     */
    public function update(MenuRequest $request, $id)
    {
    try {
        $validatedData = $request->validated();

        $menu = Menu::find($id);

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($menu->image);

            $image = $request->file('image');

            $filename = time() . '.' . $image->getClientOriginalName();

            $path = 'menu-image/' . $filename;

            Storage::disk('public')->put($path, file_get_contents($image));

            $validatedData['image'] = $filename;
        }

            $menu->update($validatedData);

        return redirect('menu')->with('success', 'Update data berhasil!');
        } catch (\Exception $error) {
        return 'haha error' . $error->getMessage() . $error->getCode();
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Menu $menu)
    {
        if ($menu->image) {
            Storage::disk('public')->delete('menu-image/' . $menu->image);
            $menu->delete();
            return redirect('menu')->with('success', 'Data berhasil dihapus!');
        } else {
            $menu->delete();
            return redirect('menu')->with('success', 'Data berhasil dihapus!');
        }

    }

    public function exportData()
    {
        $date = date('Y-m-d');

        return Excel::download(new MenuExport, $date. '_menu.xlsx');
    }

    public function importData()
    {
        try {
            Excel::import(new MenuImport, request()->file('import'));
        
            return redirect('menu')->with('success', 'Import Data berhasil!');
        } catch (\Exception $e) {
            // Tangani kesalahan jika terjadi
            return redirect('menu')->with('error', 'Terjadi kesalahan saat mengimpor data: ' . $e->getMessage());
        }
    }
}