<?php

namespace App\Imports;

use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Modules\User\Entities\Machines;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
class MachinesImport implements ToModel, WithHeadingRow
{
  
    public function model(array $row)
    {
        return new Machines([
            'user_id' => Auth::user()->id,
            'customer_id' => $row['customer_id'],
            'name' => $row['name'],
            'status' => $row['status'] ? 1 : 0,
            'codeQR' => $this->generateUniqueCodeQR(),
            'mining_power' => $row['mining_power'],
            'total_power' => $row['total_power'],
            'observation' => $row['observation'],
        ]);
    }

    public function generateUniqueCodeQR()
    {
        do {
            $codeQR = random_int(10000000, 99999999);
        } while (Machines::where("codeQR", "=", $codeQR)->first());

        return $codeQR;
    }
}
