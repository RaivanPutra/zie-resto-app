<?php

namespace App\Http\Controllers;

use App\Models\Stok;
use App\Http\Requests\StokRequest;
use App\Http\Requests\UpdateStokRequest;
use App\Models\Menu;

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
            Stok::create($request->all()); //query input ke table
            return redirect('stok')->with('success', 'Data jenis berhasil ditambahkan!');
        } catch (QueryException | Exception | PDOException $error) {

            // $this->failResponse($error->getMessage(), $error->getCode());
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
}