<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class MachinesExport implements FromCollection, WithHeadings
{

    protected $machinesArray;

    function __construct($machinesArray)
    {
        $this->machinesArray = $machinesArray;
    }

    public function collection()
    {
        return collect($this->machinesArray);
    }

    public function headings(): array
    {
        return ["Nombre", "Estado", "Potencia Mineración", "Standard Hashrate", "Pool Hashrate","Última Actualización" ,"Cliente", "Usuario"];
    }
}
