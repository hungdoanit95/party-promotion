<?php

namespace App\Exports;

use App\Models\PlanParty;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class PlanPartyExport implements FromView, ShouldAutoSize
{
    use Exportable;
    private $file_name = 'Plan-Party-Data.xlsx';
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        $plan_parties = PlanParty::leftjoin('parties','parties.id','plan_party.party_id')
        ->leftjoin('users','users.id','plan_party.user_id')
        ->get();

        return view('exports.plan-party',[
            'plan_parties' => $plan_parties,
        ]);
    }
}
