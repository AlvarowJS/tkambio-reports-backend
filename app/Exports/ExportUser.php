<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportUser implements FromCollection, WithHeadings, WithColumnWidths
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $users;

    public function __construct($users)
    {
        $this->users = $users;
    }
    
    public function collection()
    {        
        return $this->users;
    }
    public function columnWidths(): array
    {
        return [
            'A' => 5,
            'B' => 30,
            'C' => 30,
            'D' => 40,
        ];
    }

    public function headings(): array
    {
        return ["Id", "Nombre", "Fecha de nacimiento", "Fecha de creación"];
    }
    
}
