<?php

namespace App\Http\Controllers;

use App\Models\WeeklyAllowance;
use Illuminate\Http\Request;
use App\Models\Voucher;
use App\Helpers\LogActivity;

class WeeklyAllowanceController extends Controller
{
    public function index()
    {
        $weeklyAllowances = WeeklyAllowance::all();
        return view('allowances.index', compact('weeklyAllowances'));
    }

    public function create()
    {
        return view('allowances.create');
    }


    public function show(WeeklyAllowance $weeklyAllowance)
    {
        // Eager load the 'disbursement' and 'allowance' relationships
        $weeklyAllowances = WeeklyAllowance::all();

        // Pass the loaded data to the view
        return view('allowances.show', compact('weeklyAllowance'));
    }

    public function edit(WeeklyAllowance $weeklyAllowance)
    {
        return view('allowances.edit', compact('weeklyAllowance'));
    }

    public function store(Request $request)
    {

        // Validation
        $validatedData = $request->validate([
            'allownce_to' => 'required|in:worker_allowance,Follow_up,rep',
            'name' => 'required|string',
            'allowance' => 'required|numeric',
        ]);
        $weeklyAllowance = new WeeklyAllowance($validatedData);
        $weeklyAllowance->save();

        $year = date('Y');
        $lastDisbursement = Voucher::where('voucher_number', 'like', 'CV#' . $year . '-%')
            ->orderBy('voucher_number', 'desc')
            ->first();

        $incrementNumber = 1;
        if ($lastDisbursement) {
            $lastCVNumber = $lastDisbursement->voucher_number;
            $lastIncrementNumber = intval(substr($lastCVNumber, -5));
            $incrementNumber = $lastIncrementNumber + 1;
        }

        $cvNumber = 'CV#' . $year . '-' . str_pad($incrementNumber, 5, '0', STR_PAD_LEFT);

        $voucher = new Voucher($request->all());
            
        $voucher->voucher_number = $cvNumber;
        $voucher->allowance_id = $weeklyAllowance -> id;
        $voucher->save();

        LogActivity::addToLog('Added new allowance record with ' . $cvNumber);
        LogActivity::addToLog('Added new voucher record with ' . $cvNumber);

        // Redirect to the index page or show success message
        return redirect()->route('allowances.index')->with('success', 'Weekly allowance created successfully.');
    }

    public function update(Request $request, WeeklyAllowance $weeklyAllowance)
    {
        // Validation
        $validatedData = $request->validate([
            'allownce_to' => 'required|in:worker_allowance,Follow_up,rep',
            'name' => 'required|string',
            'allowance' => 'required|numeric',
        ]);

        // Update the WeeklyAllowance instance with new data
        $weeklyAllowance->update($validatedData);

        LogActivity::addToLog('Modified allowance record with ' . $weeklyAllowance->cvNumber);

        // Redirect to the index page or show success message
        return redirect()->route('allowances.index')->with('success', 'Weekly allowance updated successfully.');
    }

    public function destroy(WeeklyAllowance $weeklyAllowance)
    {
        $cvNumber = Voucher::where('allowance_id', $weeklyAllowance 
            -> id)->pluck('voucher_number')->first();

        LogActivity::addToLog('Deleted allowance record with ' . $cvNumber);
        LogActivity::addToLog('Deleted voucher record with ' . $cvNumber);

        // Delete the WeeklyAllowance instance
        $weeklyAllowance->delete();

        // Redirect to the index page or show success message
        return redirect()->route('allowances.index')->with('success', 'Weekly allowance deleted successfully.');
    }

    
    public function search(Request $request)
    {
        $search = $request->input('search');

        $query = WeeklyAllowance::query();

        if ($search) {
            $query->where('name', 'LIKE', "%$search%");
        }

        $weeklyAllowances = $query->latest()->paginate(10);

        return view('allowances.index', compact('weeklyAllowances', 'search'))->with('i', (request()->input('page', 1) - 1) * 5);
    }


    
}
