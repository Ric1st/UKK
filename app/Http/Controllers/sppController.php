<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;

use App\Models\spp;
use Illuminate\Http\Request;

class sppController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $spp = spp::latest()->paginate(5);
        return view('admins.DataSpp', compact('spp'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('spp.CreateSpp');
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
        Session::flash('nominal', $request->nominal);
        $this->validate($request, [
            'nis'     => 'required|numeric',
            'nama'     => 'required|max:25',
            'nominal'   => 'required|numeric',
        ],
        [
            'nis.required' => 'NIS Wajib Di Isi.',
            'nis.numeric' => 'NIS Wajib Angka.',
            'nama.required' => 'Nama Wajib Di Isi.',
            'nama.max' => 'Nama Maksimal 25 Huruf.',
            'nominal.required' => 'Nominal Wajib Di Isi.',
            'nominal.numeric' => 'Nominal wajib Angka.',
        ]);

        $data = [
            'nis' => $request->nis,
            'nama' => $request->nama,
            'nominal' => $request->nominal,
        ];

        spp::create($data);

        return redirect()->route('spp.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = spp::where('nis', $id)->first();
        return view('spp.ShowSpp')->with('data', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = spp::where('nis', $id)->first();
        return view('spp.EditSpp')->with('data', $data);
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
            'nama'     => 'required|max:25',
            'nominal'   => 'required|numeric',
        ],
        [
            'nama.required' => 'Nama Wajib Di Isi.',
            'nama.max' => 'Nama Maksimal 25 Huruf.',
            'nominal.required' => 'Nominal Wajib Di Isi.',
            'nominal.numeric' => 'Nominal wajib Angka.',
        ]);

        $data = [
            'nama' => $request->nama,
            'nominal' => $request->nominal,
        ];

        spp::where('nis',$id)->update($data);

        return redirect()->route('spp.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        spp::where('nis', $id)->delete();
        return redirect()->route('spp.index')->with(['success' => 'Data Berhasil DiHapus']);
    }
}
