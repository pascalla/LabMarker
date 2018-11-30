<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

use App\User;

class UsersTemplateExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return User::where('id', 0)->get(array('identifier', 'firstname', 'surname'));
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
