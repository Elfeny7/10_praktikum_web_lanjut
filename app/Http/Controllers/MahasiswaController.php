<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use App\Models\Kelas;
use Illuminate\Support\Facades\Storage;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    // public function index()
    // {
    //     $mahasiswa = Mahasiswa::paginate(5);
    //     $posts = Mahasiswa::orderBy('Nim', 'desc');
    //     return view('mahasiswa.index', compact('mahasiswa'));
    // }

    public function index(Request $request)
    {
        $mahasiswa = Mahasiswa::where([
            ['Nama', '!=', Null],
            [function ($query) use ($request) {
                if (($search = $request->search)) {
                    $query->orWhere('Nama', 'LIKE', '%' . $search . '%')
                    ->get();
                }
            }]
        ])->paginate(5);
        $posts = Mahasiswa::orderBy('Nim', 'desc');
        return view('mahasiswa.index', compact('mahasiswa'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kelas = Kelas::all();
        return view('mahasiswa.create', ['kelas' => $kelas]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'Nim' => 'required',
            'Nama' => 'required',
            'Kelas' => 'required',
            'Jurusan' => 'required',
            'No_Handphone' => 'required',
            'Email' => 'required',
            'TanggalLahir' => 'required',
        ]);

        // Mahasiswa::create($request->all());

        if ($request->file('image')) {
            $image_name = $request->file('image')->store('images', 'public');
        }

        $mahasiswa = new Mahasiswa;
        $mahasiswa->Nim=$request->get('Nim');
        $mahasiswa->Nama=$request->get('Nama');
        $mahasiswa->Image=$image_name;
        $mahasiswa->Jurusan=$request->get('Jurusan');
        $mahasiswa->No_Handphone=$request->get('No_Handphone');
        $mahasiswa->Email=$request->get('Email');
        $mahasiswa->TanggalLahir=$request->get('TanggalLahir');

        $kelas = new Kelas;
        $kelas->id = $request->get('Kelas');

        $mahasiswa->kelas()->associate($kelas);
        $mahasiswa->save();

        return redirect()->route('mahasiswa.index')
            ->with('success', 'Mahasiswa Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($Nim)
    {
        $Mahasiswa = Mahasiswa::find($Nim);
        return view('mahasiswa.detail', compact('Mahasiswa'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($Nim)
    {
        $Mahasiswa = Mahasiswa::find($Nim);
        $kelas = Kelas::all();
        return view('mahasiswa.edit', compact('Mahasiswa'), ['kelas' => $kelas]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $Nim)
    {
        $request->validate([
            'Nim' => 'required',
            'Nama' => 'required',
            'Kelas' => 'required',
            'Jurusan' => 'required',
            'No_Handphone' => 'required',
            'Email' => 'required',
            'TanggalLahir' => 'required',
        ]);
        // Mahasiswa::find($Nim)->update($request->all());
        

        $mahasiswa = Mahasiswa::with('kelas')->where('nim', $Nim)->first();

        if($mahasiswa->Image && file_exists(storage_path('app/public/' . $mahasiswa->Image))){
            Storage::delete('public/' . $mahasiswa->Image);
        }
        $image_name = $request->file('image')->store('images', 'public');
        $mahasiswa->Image = $image_name;

        $mahasiswa->Nim=$request->get('Nim');
        $mahasiswa->Nama=$request->get('Nama');
        $mahasiswa->Jurusan=$request->get('Jurusan');
        $mahasiswa->No_Handphone=$request->get('No_Handphone');
        $mahasiswa->Email=$request->get('Email');
        $mahasiswa->TanggalLahir=$request->get('TanggalLahir');

        $kelas = new Kelas;
        $kelas->id = $request->get('Kelas');

        $mahasiswa->kelas()->associate($kelas);
        $mahasiswa->save();

        return redirect()->route('mahasiswa.index')
            ->with('success', 'Mahasiswa Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($Nim)
    {
        Mahasiswa::find($Nim)->delete();
        return redirect()->route('mahasiswa.index')
            ->with('success', 'Mahasiswa Berhasil Dihapus');
    }
}
