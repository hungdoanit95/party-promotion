<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class UsersExport implements FromView, ShouldAutoSize
{
    use Exportable;
    private $file_name = 'Users-Data.xlsx';
    /**
    * @return \Illuminate\Support\Collection
    */

    // public function collection()
    public function view(): View
    {
        return view('exports.users',[
            'users' => User::all()
        ]);
    }
}
