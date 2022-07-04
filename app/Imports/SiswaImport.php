<?php

namespace App\Imports;

use App\Models\Siswa;
use Maatwebsite\Excel\Concerns\ToModel;

class SiswaImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Siswa([
            'nama' => $row[0],
            'email' => $row[1],
            'no_hp' => $row[2],
            'kelas' => $row[3],
            'alamat' => $row[4],
            'koor_long' => $row[5],
            'koor_lat' => $row[6],
            'create' => $row[7],
            'update' => $row[8],
        ]);
    }
}
