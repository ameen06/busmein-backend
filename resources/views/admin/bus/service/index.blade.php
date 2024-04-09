@extends('layouts.bus')
@section('styles')
@endsection

@section('bus_name')
{{ $bus->bus_name }}
@endsection

@section('content')
<div class="w-full">
    <!-- title -->
    <div class="w-full flex justify-between items-center">
        <h2 class="text-lg font-semibold text-gray-800">Services</h2>

        <a href="{{ route('buses.services.create', $bus->id) }}" class="openModalBtn text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 focus:outline-none">
            <i class="bi bi-plus"></i> Add New Service
        </a>
    </div>

    <div class="mt-2 bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
            {{ $dataTable->table() }}
        </div>
    </div>
</div>
@endsection

@section('scripts')
{{ $dataTable->scripts() }}
@endsection