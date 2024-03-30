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
        <h2 class="text-lg font-semibold text-gray-800">Bus Seating</h2>
    </div>

    <div class="mt-2 bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900 max-w-2xl mx-auto">
            <livewire:seat-creater />
        </div>
    </div>
</div>
@endsection

@section('scripts')
@endsection