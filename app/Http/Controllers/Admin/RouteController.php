<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\RouteDataTable;
use App\Http\Controllers\Controller;
use App\Models\Route;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RouteController extends Controller
{
    public function index(RouteDataTable $dataTable){
        return $dataTable->render('admin.routes.index');
    }

    public function create(){
        return view('admin.routes.create');
    }

    public function edit(){
        return view('admin.routes.edit');
    }

    public function destroy(string $id)
    {
        try {
            DB::beginTransaction();

            Route::find($id)->delete();

            DB::commit();

            return redirect()->route('routes.index')->with(['alert' => true, 'alertColor' => 'green', 'message' => 'route deleted successfully!']);
        } catch(Exception $error) {
            DB::rollBack();
            return redirect()->back()->with(['alert' => true, 'alertColor' => 'red', 'message' => $error->getMessage()]);
        }
    }
}
