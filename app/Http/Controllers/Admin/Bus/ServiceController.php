<?php

namespace App\Http\Controllers\Admin\Bus;

use App\DataTables\ServiceDataTable;
use App\Http\Controllers\Controller;
use App\Models\Bus;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index(ServiceDataTable $dataTable, Bus $bus){
        return $dataTable->render('admin.bus.service.index', ['bus' => $bus]);
    }

    public function create(Bus $bus){
        return view('admin.bus.service.create', ['bus' => $bus]);
    }

    public function edit(string $bus, string $service){
        $bus = Bus::find($bus);
        $service = Service::with(['route', 'bus'])->where('id', $service)->first();
        return view('admin.bus.service.edit', ['bus' => $bus, 'service' => $service]);
    }
}
