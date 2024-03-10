<x-app-layout>
@push('styles')
@endpush
<div class="w-full">
    <!-- actions -->
    <div class="w-full flex justify-between items-center">
        <h1 class="text-2xl text-gray-900 font-bold">Destinations</h1>

        <a href="{{ route('destinations.create') }}" class="openModalBtn text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 focus:outline-none">
            <i class="bi bi-plus"></i> Create
        </a>
    </div>

    <div class="mt-6 bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <span class="sr-only max-w-12"></span>
        <div class="p-6 text-gray-900 table-responsive">
            {{ $dataTable->table() }}
        </div>
    </div>
</div>
@push('scripts')
{{ $dataTable->scripts() }}
<script>
function dropActions(dropdownId){
    $(".actionsDropdownContent[data-dropdownid='" + dropdownId + "']").toggle();
}
</script>
@endpush
</x-app-layout>