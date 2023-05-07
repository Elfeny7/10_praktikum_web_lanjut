<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use App\Models\Mahasiswa_MataKuliah;
use PDF;
use Illuminate\Support\Facades\Storage;

class MahasiswaNilaiController extends Controller
{
    public function index($Nim)
    {
        $Mahasiswa = Mahasiswa::find($Nim);
        $mahasiswa = Mahasiswa_MataKuliah::where('mahasiswa_id', $Nim)->get();
        return view('nilai.detailnilai', compact('Mahasiswa', 'mahasiswa'));
    }

    public function pdf($Nim){
        $Mahasiswa = Mahasiswa::find($Nim);
        $mahasiswa = Mahasiswa_MataKuliah::where('mahasiswa_id', $Nim)->get();
        $pdf = PDF::loadview('nilai.cetak', compact('Mahasiswa', 'mahasiswa'));
        return $pdf->stream();
    }
}
