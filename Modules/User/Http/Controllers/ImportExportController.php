<?php

namespace Modules\User\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use App\Imports\MachinesImport;
use Maatwebsite\Excel\Facades\Excel;

class ImportExportController extends Controller
{

    public function index()
    {
        return view('user::importCsv.index');
    }

    public function importcsv(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:csv,xlsx'
        ]);

        $import = new MachinesImport;
        $file = $request->file('file');

        Excel::import($import, $file);

        return redirect()->to('/user/machines/import-csv')->with('message', 'El archivo ha sido importado correctamente');
    }
}
