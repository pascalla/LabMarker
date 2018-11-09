<?php

namespace App\Imports;

use App\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;


class UsersImport implements ToModel
{
    use Importable;

    public function model(array $row)
    {
        return new User([
            'identifier' => $row[0],
            'firstname' => $row[1],
            'surname' => $row[2],
        ]);
    }

}
