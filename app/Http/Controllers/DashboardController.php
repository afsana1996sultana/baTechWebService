<?php

namespace App\Http\Controllers;
use App\Models\Information;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\File;
use Barryvdh\DomPDF\Facade\Pdf;
use Symfony\Component\HttpFoundation\StreamedResponse;

class DashboardController extends Controller
{
    public function index()
    {
        if(Auth::user()->user_role == 1){
            $information = Information::orderBy('id','asc')->get();
        }else{
            $information = Information::orderBy('id','asc')->get();
        }

        return view('admin.Information.index', compact('information'));
    }
}
