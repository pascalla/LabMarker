<?php

namespace App\Imports;

use App\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithHeadingRow;


class UsersImport implements ToModel, WithHeading
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

    public function headings(): array
    {
        return [
            'Student Number',
            'First Name',
            'Surname',
        ];
    }

}
