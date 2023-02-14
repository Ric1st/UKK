<?php

namespace App\Http\Controllers;

use App\Models\spp;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BayarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('bayar.HomeSiswa');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(spp $data)
    {
        // dd($data);
        $spp = spp::where(Auth::user()->nis)->first();
        if( $spp){
            return redirect()->route('bayar.index')->with(['success' => 'Anda Sudah Membayar!']);
        }
        else{
            return view('bayar.BayarSpp');
        }
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

        return redirect()->route('bayar.index')->with(['success' => 'Pembayaran Sukses!']);
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
        return view('bayar.ShowBayar')->with('data', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
