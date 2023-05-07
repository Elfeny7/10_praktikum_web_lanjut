<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Kartu Hasil Studi (KHS)</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            margin: 50px auto;
            max-width: 800px;
        }
        h1 {
            text-align: center;
            margin-bottom: 30px;
        }
        ul li {
            list-style: none;
            margin-bottom: 10px;
        }
        table {
            border-collapse: collapse;
            margin-top: 30px;
            width: 100%;
        }
        table th,
        table td {
            border: 1px solid black;
            padding: 10px;
            text-align: center;
        }
        table th {
            background-color: #dddddd;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Kartu Hasil Studi (KHS)</h1>
    <ul>
        <li><b>Nama: </b>{{ $Mahasiswa->Nama }}</li>
        <li><b>Nim: </b>{{ $Mahasiswa->Nim }}</li>
        <li><b>Kelas: </b>{{ $Mahasiswa->Kelas->nama_kelas }}</li>
    </ul>
    <table>
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
</div>
</body>
</html>
