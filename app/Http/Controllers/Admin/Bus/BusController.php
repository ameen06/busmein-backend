<?php

namespace App\Http\Controllers\Admin\Bus;

use App\DataTables\BusDataTable;
use App\Http\Controllers\Controller;
use App\Models\Bus;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BusController extends Controller
{
    public function index(BusDataTable $dataTable){
        return $dataTable->render('admin.bus.index');
    }

    public function show(Bus $bus){
        return view('admin.bus.view', ['bus' => $bus]);
    }

    public function edit(Bus $bus){
        return view('admin.bus.general.edit', ['bus' => $bus]);
    }

    public function update(Request $request, string $bus){
        $request->validate([
            'name' => 'required',
            'subtext' => 'required',
            'rating' => 'required|decimal:1,1',
            'badge' => 'required',
        ]);

        try {
            DB::beginTransaction();
            Bus::where('id', $bus)->update([
                'bus_name' => $request->name,
                'subtext' => $request->subtext,
                'rating' => $request->rating,
                'badge' => $request->badge,
            ]);
            DB::commit();

            return redirect()->route('buses.edit', $bus)->with(['alert' => true, 'alertColor' => 'green', 'message' => 'bus updated successfully!']);
        } catch(Exception $error) {
            DB::rollBack();
            return redirect()->back()->withInput()->with(['alert' => true, 'alertColor' => 'red', 'message' => $error->getMessage()]);
        }
    }

    public function create(){
        return view('admin.bus.general.create');
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required',
            'subtext' => 'required',
            'rating' => 'required|decimal:1,1',
            'badge' => 'required',
        ]);

        try {
            DB::beginTransaction();
            Bus::create([
                'bus_name' => $request->name,
                'subtext' => $request->subtext,
                'rating' => $request->rating,
                'badge' => $request->badge,
            ]);
            DB::commit();

            return redirect()->route('buses.index')->with(['alert' => true, 'alertColor' => 'green', 'message' => 'new bus added successfully!']);
        } catch(Exception $error) {
            DB::rollBack();
            return redirect()->back()->withInput()->with(['alert' => true, 'alertColor' => 'red', 'message' => $error->getMessage()]);
        }
    }
}
