<?php

namespace App\Http\Controllers;

use App\Models\CountingService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Giver;
use App\Models\Fund;
use App\Models\ChurchInfo;
use App\Models\CashCount;
use App\Helpers\LogActivity;
use DataTables;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;


class CountingServiceController extends Controller
{
    public function create()
    {
        return view('finance.counting_services.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'type_service' => 'required',
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
        ]);

        CountingService::create($request->all());

        LogActivity::addToLog('Created counting service for ' . $request->date);

        return redirect()->route('finance.counting_services.index')
            ->with('success', 'Counting service created successfully.');
    }

    public function index(Request $request)
    {
        $countingServices = CountingService::orderBy('created_at', 'desc')->get();
            $search = $request->input('search');
        
        $countingServices = CountingService::when($search, function ($query, $search) {
            return $query->where('type_service', 'LIKE', '%' . $search . '%')
                        ->orWhere('date', 'LIKE', '%' . $search . '%')
                        ->orWhere('time', 'LIKE', '%' . $search . '%');
        })
        ->orderBy('created_at', 'desc')
        ->get();
        
        return view('finance.counting_services.index', compact('countingServices', 'search'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function edit(CountingService $countingService)
    {
        return view('finance.counting_services.edit', compact('countingService'));
    }

    public function update(Request $request, CountingService $countingService)
    {
        $request->validate([
            'type_service' => 'required',
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
        ]);

        $countingService->update($request->all());

        LogActivity::addToLog('Modified counting service for ' . $request->date);

        return redirect()->route('finance.counting_services.index')
            ->with('success', 'Counting service updated successfully.');
    }

    public function destroy(CountingService $countingService)
    {
        $countingService->delete();

        LogActivity::addToLog('Deleted counting service for ' . $countingService->date);
        
        return redirect()->route('finance.counting_services.index')
            ->with('success', 'Counting service deleted successfully.');
    }

    public function show(CountingService $countingService)
    {
        $givers = Giver::where('date', $countingService->date)
            ->paginate(10);
        $get_id = $countingService->id;    
        
        return view('finance.counting_services.show', compact('countingService', 'givers', 'get_id'));
    }
    
    public function goBack(CountingService $countingService)
    {

        return redirect()->route('finance.counting_services.show', ['countingService' => $countingService]);
    }

    
    public function print(CountingService $id)
    {
        $date = $id->date;
        $formattedDate = Carbon::parse($date)->format('F j, Y'); // Convert date to formatted string
        
        $givers = Giver::where('counting_services_id', $id->id)
            ->get();
        
        return view('finance.giver.print', compact('givers', 'formattedDate'));
    }



}
