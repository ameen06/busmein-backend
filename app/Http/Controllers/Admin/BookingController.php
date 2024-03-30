<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\BookingDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index(BookingDataTable $dataTable){
        return $dataTable->render('admin.bookings.index');
    }
}
