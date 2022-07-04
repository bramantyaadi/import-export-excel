<?php

namespace App\Imports;

use App\Models\Siswa;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;

class UsersImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return Siswa|null
     */
    public function model(array $row)
    {
        return new Siswa([
           'nama'     => $row[0],
           'alamat'    => $row[1], 
           'kelas'     => $row[2],
           'absen'    => $row[3],
        ]);
    }
}