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

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            // Mengambil data menu dengan jenis
            $data['menu'] = Menu::with('jenis')->orderBy('created_at', 'DESC')->get();
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
        $data['stok'] = $request->stok; 
        $data['image'] = $filename; 
        $data['deskripsi'] = $request->deskripsi; 
        
        // jalankan perintah create data
        Menu::create($data);
        return redirect('menu')->with('success', 'Data menu berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Menu $menu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Menu $menu)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MenuRequest $request, Menu $menu)
    {
        //
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
}