<?php


namespace App\Exports;

use App\Models\Parties;
use App\Models\Plan;
use App\Models\Reasons;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class PartyExport implements FromView, ShouldAutoSize
{
    use Exportable;
    private $file_name = 'Parties-Data.xlsx';
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        $parties = Parties::all();
        return view('exports.parties',[
            'parties' => $parties,
        ]);
    }
}
