<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $siswa = siswa::latest()->paginate(5);
        return view('admins.DataSiswa', compact('siswa'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('siswa.SiswaCreate');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        Session::flash('nis', $request->nis);
        Session::flash('nama', $request->nama);
        Session::flash('kelas', $request->kelas);
        Session::flash('alamat', $request->alamat);
        Session::flash('telp', $request->telp);
        $this->validate($request, [
            'nisn'     => 'required|max:10',
            'nis'     => 'required|max:8',
            'nama'     => 'required|max:35',
            'kelas'   => 'required|numeric|max:11',
            'alamat'   => 'required',
            'telp'   => 'required|numeric|max:13',
            'id_spp' => 'required|numeric|max:11'
        ],
        [
            'nisn.required' => 'NISN Wajib Di Isi.',
            'nisn.max' => 'NISN Maksimal 10 Angka.',
            'nis.required' => 'NIS Wajib Di Isi.',
            'nis.max' => 'NIS Maksimal 8 Angka.',
            'nama.required' => 'Nama Wajib Di Isi.',
            'nama.max' => 'Nama Maksimal 35 Huruf.',
            'kelas.required' => 'Kelas Wajib Di Isi.',
            'kelas.max' => 'Kelas Maksimal 11 Angka.',
            'kelas.numeric' => 'Kelas Wajib Angka.',
            'alamat.required' => 'Alamat wajib Di Isi.',
            'telp.required' => 'telp Wajib Di Isi.',
            'telp.numeric' => 'Telp Wajib Angka.',
            'telp.max' => 'Telp Maksimal 13 Angka.',
        ]);

        $data = [
            'nisn' => $request->nisn,
            'nis' => $request->nis,
            'nama' => $request->nama,
            'kelas' => $request->kelas,
            'alamat' => $request->alamat,
            'telp' => $request->telp,
        ];

        $user =[
            'username' => $request->nis,
            'password' => bcrypt($request->nis),
            'nama' => $request->nama,
            'type' => 2,
        ];

        siswa::create($data);
        User::create($user);

        return redirect()->route('siswa.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = siswa::where('nis', $id)->first();
        return view('siswa.ShowSiswa')->with('data', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = siswa::where('nis', $id)->first();
        return view('siswa.EditSiswa')->with('data', $data);
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
        $this->validate($request, [
            'nama'     => 'required|max:35',
            'kelas'   => 'required|numeric|max:11',
            'alamat'   => 'required',
            'telp'   => 'required|numeric|max:13',
        ],
        [
            'nama.required' => 'Nama Wajib Di Isi.',
            'nama.max' => 'Nama Maksimal 35 Huruf.',
            'kelas.required' => 'Kelas Wajib Di Isi.',
            'kelas.max' => 'Kelas Maksimal 11 Angka.',
            'kelas.numeric' => 'Kelas Wajib Angka.',
            'alamat.required' => 'Alamat wajib Di Isi.',
            'telp.required' => 'telp Wajib Di Isi.',
            'telp.numeric' => 'Telp Wajib Angka.',
            'telp.max' => 'Telp Maksimal 13 Angka.',
        ]);

        $data = [
            'nama' => $request->nama,
            'kelas' => $request->kelas,
            'alamat' => $request->alamat,
            'telp' => $request->telp,
        ];

        $user =[
            'nama' => $request->nama,
            'type' => 2,
        ];

        siswa::where('nis', $id)->update($data);
        User::where('username', $id)->update($user);

        return redirect()->route('siswa.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        siswa::where('nis', $id)->delete();
        user::where('username', $id)->delete();
        return redirect()->route('siswa.index')->with(['success' => 'Data Berhasil DiHapus']);
    }
}
