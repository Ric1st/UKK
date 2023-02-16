<?php

namespace App\Http\Controllers;

use App\Models\petugas;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PetugasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $petugas = petugas::latest()->paginate(5);
        return view('admins.DataPetugas', compact('petugas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('petugas.Createpetugas');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Session::flash('id', $request->id_petugas);
        Session::flash('username', $request->username);
        Session::flash('nama', $request->nama_petugas);
        $this->validate($request,[
            'id_petugas' => 'required|numeric',
            'username' => 'required|max:25',
            'nama_petugas' => 'required|max:35',
        ],
        [
            'id_petugas.required' => 'Id Wajib Di Isi.',
            'id_petugas.numeric' => 'Id Wajib Angka.',
            'username.max' => 'Username Maksimal 25 Huruf.',
            'username.required' => 'Username Wajib Di Isi.',
            'nama_petugas.required' => 'Nama Wajib Di Isi.',
            'nama_petugas.max' => 'Nama Maksimal 35 Huruf.',
        ]);

        $data = [
            'id_petugas' => $request->id_petugas,
            'username' => $request->username,
            'password' => $request->username,
            'nama_petugas' => $request->nama_petugas,
            'type' => 3,
        ];

        petugas::create($data);

        return redirect()->route('petugas.index')->with(['success' => 'Data Berhasil Di Simpan!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = petugas::where('id_petugas', $id)->first();
        return view('petugas.ShowPetugas')->with('data', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = petugas::where('id_petugas', $id)->first();
        return view('petugas.EditPetugas')->with('data', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'username' => 'required|max:25',
            'nama_petugas' => 'required|max:35',
        ],
        [
            'username.max' => 'Username Maksimal 25 Huruf.',
            'username.required' => 'Username Wajib Di Isi.',
            'nama_petugas.required' => 'Nama Wajib Di Isi.',
            'nama_petugas.max' => 'Nama Maksimal 35 Huruf.',
        ]);

        $data = [
            'username' => $request->username,
            'nama_petugas' => $request->nama_petugas,
        ];

        petugas::where('id_petugas', $id)->update($data);

        return redirect()->route('petugas.index')->with(['success' => 'Data Berhasil Di Update!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        petugas::where('id_petugas', $id)->delete();
        return redirect()->route('petugas.index')->with(['success' => 'Data Berhasil Di Hapus!']);
    }
}
