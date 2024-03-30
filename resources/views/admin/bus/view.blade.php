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
        <h2 class="text-lg font-semibold text-gray-800">Bus Statistics</h2>
    </div>

    <div class="mt-2 bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
            <div class="w-full grid grid-cols-2 md:grid-cols-4 gap-4">
                <div class="w-full p-4 bg-emerald-200 rounded-lg text-gray-900 border-2 border-emerald-300">
                    <h3 class="text-lg font-semibold">Total Trips</h3>
    
                    <p class="mt-6 text-2xl md:text-3xl font-bold">0</p>
                </div>

                <div class="w-full p-4 bg-violet-200 rounded-lg text-gray-900 border-2 border-violet-300">
                    <h3 class="text-lg font-semibold">Total Travellers</h3>
    
                    <p class="mt-6 text-2xl md:text-3xl font-bold">0</p>
                </div>
    
                <div class="w-full p-4 bg-blue-200 rounded-lg text-gray-900 border-2 border-blue-300">
                    <h3 class="text-lg font-semibold">Total Revenue</h3>
    
                    <p class="mt-6 text-2xl md:text-3xl font-bold">0.00</p>
                </div>
    
                <div class="w-full p-4 bg-fuchsia-200 rounded-lg text-gray-900 border-2 border-fuchsia-300">
                    <h3 class="text-lg font-semibold">Total Profit</h3>
    
                    <p class="mt-6 text-2xl md:text-3xl font-bold">0.00</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
@endsection