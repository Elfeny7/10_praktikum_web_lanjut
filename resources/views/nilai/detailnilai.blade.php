@extends('mahasiswa.layout')

@section('content')
<div class="container mt-5">
    <h1>Kartu Hasil Studi (KHS)</h1>
    <ul class="list-group list-group-flush">
        <li class="list-group-item"><b>Nama: </b>{{$Mahasiswa->Nama}}</li>
        <li class="list-group-item"><b>Nim: </b>{{$Mahasiswa->Nim}}</li>
        <li class="list-group-item"><b>Kelas: </b>{{$Mahasiswa->Kelas->nama_kelas}}</li>
    </ul>
    <table class="table table-bordered">
        <tr>
            <th>Mata Kuliah</th>
            <th>SKS</th>
            <th>Semester</th>
            <th>Nilai</th>
        </tr>
        @foreach ($mahasiswa as $mahasiswa)
        <tr>
            <td>{{ $mahasiswa->MataKuliah->nama_matkul }}</td>
            <td>{{ $mahasiswa->MataKuliah->sks }}</td>
            <td>{{ $mahasiswa->MataKuliah->semester }}</td>
            <td>{{ $mahasiswa->nilai }}</td>
        </tr>
        @endforeach
    </table>
    <a class="btn btn-success mt-3" href="{{ route('mahasiswa.index') }}">Kembali</a>
</div>
@endsection