<?php

namespace App\Http\Controllers\Admin\Bus;

use App\Http\Controllers\Controller;
use App\Models\Bus;
use Illuminate\Http\Request;

class SeatingController extends Controller
{
    public function edit(Bus $bus){
        return view('admin.bus.seating.edit', ['bus' => $bus]);
    }

    public function update(Request $request, Bus $bus){
        return $request->all();
    }
}
