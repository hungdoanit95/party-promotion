<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\UsersImport;
use App\Exports\UsersExport;
use App\Imports\StoresImport;
use App\Exports\StoresExport;
use App\Imports\PlansImport;
use App\Exports\PlansExport;
use App\Imports\PartyImport;
use App\Exports\PartyExport;


class ImportController extends Controller
{
    public function userImportExport()
    {
       return view('user-import');
    }
    public function userImport(Request $request) 
    {
        Excel::import(new UsersImport, $request->file('file')->store('temp'));
        return back()->withStatus('Import Successfully');
    }
    public function userExport() 
    {
        return Excel::download(new UsersExport, 'users-collection.xlsx');
    }


    public function storeImportExport()
    {
       return view('store-import');
    }
    public function storeImport(Request $request) 
    {
        Excel::import(new StoresImport, $request->file('file')->store('temp'));
        return back()->withStatus('Import Successfully');
    }
    public function storeExport(Request $request) 
    {   
        $key_search = isset($request->key_search) ? $request->key_search : '';
        return Excel::download(new StoresExport($key_search), 'store-collection.xlsx');
    }

    


    public function partyImportExport()
    {
       return view('party-import');
    }
    public function partyImport(Request $request) 
    {
        Excel::import(new PartyImport, $request->file('file')->store('temp'));
        return back()->withStatus('Import Successfully');
    }
    public function partyExport(Request $request) 
    {   
        $key_search = isset($request->key_search) ? $request->key_search : '';
        return Excel::download(new PartyExport($key_search), 'party-collection.xlsx');
    }

    
    public function planImportExport()
    {
       return view('plan-import');
    }
    public function planImport(Request $request) 
    {
        Excel::import(new PlansImport, $request->file('file')->store('temp'));
        return back()->withStatus('Import Successfully');
    }
    public function planExport() 
    {
        Excel::download(new PlansExport, 'plan-collection.xlsx');
        return back()->withStatus('Export Successfully');
    }

}
