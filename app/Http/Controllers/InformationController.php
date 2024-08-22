<?php

namespace App\Http\Controllers;

use App\Models\Information;
use App\Models\Informationbackup;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\InformationImport;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class InformationController extends Controller
{
    public function index()
    {
        $startIndex = 0;
        $information = Information::orderBy('id', 'desc')->get();
        return view('admin.Information.index', compact('information','startIndex'));
    }

    public function import(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|file|mimes:xlsx,csv',
        ]);

        try {
            Excel::import(new InformationImport, $request->file('file'));
            return redirect()->back()->with('success', 'Information Imported Successfully');
        } catch (ValidationException $e) {
            return redirect()->back()->with('error', 'There Are Some Errors, Please Check');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function information_Print(Request $request)
    {
        $ids = $request->ids;
        $status = 1;
        $informations = Information::whereIn('id', $ids)->get();
        $request->session()->put('informations', $informations);
        foreach ($informations as $information) {
            $backup = new InformationBackup();
            $backup->fill($information->toArray());
            $backup->save();
        }
        Information::whereIn('id', $ids)->delete();

        return response()->json([
            'status' => 'success',
            'message' => "Information has been printed successfully.",
            'informations' => $informations,
            'redirect_url' => route('information.multiple.informationprint.page'),
        ]);
    }


    public function multiple_information_print_page(Request $request)
    {
        $informations = $request->session()->get('informations');
        $request->session()->forget('informations');

        if ($informations) {
            return view('admin.Information.multiple_information_print', compact('informations'));
        } else {
            return redirect()->back()->with('error', 'Information are Printed');
        }
    }

    public function delete(Request $request)
    {
        $ids = $request->ids;
        if (!empty($ids)) {
            Information::whereIn('id', $ids)->delete();
            return response()->json(['message' => 'Selected information cleared successfully.']);
        }
        return response()->json(['message' => 'No information data selected.'], 400);
    }


    public function deleteAll(Request $request)
    {
        Information::truncate();
        return response()->json(['success' => 'All data deleted successfully.']);
    }
}
