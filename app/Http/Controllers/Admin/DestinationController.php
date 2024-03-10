<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\DestinationDataTable;
use App\Http\Controllers\Controller;
use App\Models\Destination;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DestinationController extends Controller
{
    public function index(DestinationDataTable $dataTable){
        return $dataTable->render('admin.destinations.index');
    }

    public function create(){
        return view('admin.destinations.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'destination_type' => 'required',
            'name' => 'required',
            'name_slug' => 'required',
            'address' => 'required',
            'landmark' => 'required',
        ]);

        try {
            DB::beginTransaction();
            Destination::create([
                'type' => $request->destination_type,
                'name' => $request->name,
                'slug' => $request->name_slug,
                'address' => $request->address,
                'landmark' => $request->landmark,
                'has_return' => isset($request->has_return) ? 1 : 0,
            ]);
            DB::commit();

            return redirect()->route('destinations.index')->with(['alert' => true, 'alertColor' => 'green', 'message' => 'new destination added successfully!']);
        } catch(Exception $error) {
            DB::rollBack();
            return redirect()->back()->withInput()->with(['alert' => true, 'alertColor' => 'red', 'message' => $error->getMessage()]);
        }
    }

    public function edit(string $id)
    {
        $destination = Destination::findorfail($id);
        return view('admin.destinations.edit', ['destination' => $destination]);
    }

    public function destroy(string $id)
    {
        try {
            DB::beginTransaction();

            Destination::find($id)->delete();

            DB::commit();

            return redirect()->route('destinations.index')->with(['alert' => true, 'alertColor' => 'green', 'message' => 'destination deleted successfully!']);
        } catch(Exception $error) {
            DB::rollBack();
            return redirect()->back()->with(['alert' => true, 'alertColor' => 'red', 'message' => $error->getMessage()]);
        }
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'destination_type' => 'required',
            'name' => 'required',
            'name_slug' => 'required',
            'address' => 'required',
            'landmark' => 'required',
        ]);

        try {
            DB::beginTransaction();
            Destination::findorfail($id)->update([
                'type' => $request->destination_type,
                'name' => $request->name,
                'slug' => $request->name_slug,
                'address' => $request->address,
                'landmark' => $request->landmark,
                'has_return' => isset($request->has_return) ? 1 : 0,
            ]);
            DB::commit();

            return redirect()->route('destinations.index')->with(['alert' => true, 'alertColor' => 'green', 'message' => 'destination updated successfully!']);
        } catch(Exception $error) {
            DB::rollBack();
            return redirect()->back()->withInput()->with(['alert' => true, 'alertColor' => 'red', 'message' => $error->getMessage()]);
        }
    }
}
