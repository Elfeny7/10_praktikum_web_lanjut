<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MahasiswaMatakuliah extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

     

    public function run()
    {
        $nilai = [
            [
                'mahasiswa_id' => 2141720091,
                'matakuliah_id' => 1,
                'nilai' => 'A',
            ],
            [
                'mahasiswa_id' => 2141720091,
                'matakuliah_id' => 2,
                'nilai' => 'B',
            ],
            [
                'mahasiswa_id' => 2141720091,
                'matakuliah_id' => 3,
                'nilai' => 'C',
            ],
            [
                'mahasiswa_id' => 2141720091,
                'matakuliah_id' => 4,
                'nilai' => 'D',
            ],
        ];

        DB::table('mahasiswa_matakuliah')->insert($nilai);
    }
}
