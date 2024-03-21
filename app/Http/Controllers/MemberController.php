<?php

namespace App\Http\Controllers;

use Exception;
use PDOException;
use App\Models\Member;
use App\Http\Requests\MemberRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\MemberExport;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['member'] = Member::all();
        return view('member.index', ['title' => 'Member'])->with($data);
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
    public function store(MemberRequest $request)
    {
        try {
            $data = Member::create($request->all());
            return redirect('member')->with('success','Data Member Berhasil Ditambahkan');
        } catch (\Exception $error) {
            // Tangani kesalahan jika terjadi
            return 'haha error' . $error->getMessage() . $error->getCode();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Member $member)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Member $member)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MemberRequest $request, $id)
    {
        try {
            // Validasi data yang dikirimkan
            $validatedData = $request->validated();
    
            // Update data member
            Member::find($id)->update($validatedData);
    
            return redirect('member')->with('success', 'Update data berhasil!');
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
        Member::find($id)->delete();
        return redirect('member')->with('success', 'Data berhasil dihapus!');

    }

    public function exportData()
    {
        $date = date('Y-m-d');

        return Excel::download(new MemberExport, $date. '_member.xlsx');
    }
}