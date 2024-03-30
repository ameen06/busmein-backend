<x-app-layout>
@push('styles')
@endpush
<!-- actions -->
<div class="w-full flex justify-between items-center">
    <h2 class="text-lg font-semibold text-gray-800">Add Route</h2>
    <a href="{{ route('routes.index') }}" class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 focus:outline-none">
        <i class="bi bi-arrow-left"></i> Go Back
    </a>
</div>

<div class="mt-2 bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6 py-8 text-gray-900">
        <livewire:route-form />
    </div>
</div>
@push('scripts')
@endpush
</x-app-layout>