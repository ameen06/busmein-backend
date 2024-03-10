<x-app-layout>
@push('styles')
@endpush
<!-- actions -->
<div class="w-full flex justify-between items-center">
    <h2 class="text-lg font-semibold text-gray-800">Edit Destination</h2>
    <a href="{{ route('destinations.index') }}" class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 focus:outline-none">
        <i class="bi bi-arrow-left"></i> Go Back
    </a>
</div>

<div class="mt-2 bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6 py-8 text-gray-900">
        @if ($errors->any())
        <x-form-errors :errors="$errors" />
        @endif

        <form action="{{ route('destinations.update', $destination->id) }}" method="POST" class="max-w-xl mx-auto">
            @csrf
            @method('PUT')

            <div class="w-full mb-0 flex gap-4">
                <div class="w-full flex items-center px-4 border border-gray-200 rounded">
                    <input id="destination-type-1" {{ $destination->type == 'Boarding Point' ? 'checked' : '' }} type="radio" value="Boarding Point" name="destination_type" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2">
                    <label for="destination-type-1" class="w-full py-3 ml-2 text-sm font-medium text-gray-900">Boarding Point</label>
                </div>
                <div class="w-full flex items-center px-4 border border-gray-200 rounded">
                    <input id="destination-type-2" type="radio" {{ $destination->type == 'Dropping Point' ? 'checked' : '' }} value="Dropping Point" name="destination_type" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2">
                    <label for="destination-type-2" class="w-full py-3 ml-2 text-sm font-medium text-gray-900">Dropping Point</label>
                </div>
                <div class="w-full flex items-center px-4 border border-gray-200 rounded">
                    <input id="destination-type-3" type="radio" {{ $destination->type == 'Both' ? 'checked' : '' }} value="Both" name="destination_type" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2">
                    <label for="destination-type-3" class="w-full py-3 ml-2 text-sm font-medium text-gray-900">Both</label>
                </div>
            </div>
            <div class="mt-6">
                <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Destination</label>
                <input type="text" id="name" name="name" value="{{ old('name', $destination->name) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-300 focus:border-blue-500 focus:ring-2 focus:outline-none block w-full p-2.5" placeholder="Destination Name" required>
            </div> 
            <div class="mt-6">
                <label for="name_slug" class="block mb-2 text-sm font-medium text-gray-900">Name Slug</label>
                <input type="text" id="name_slug" name="name_slug" value="{{ old('name_slug', $destination->slug) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-300 focus:border-blue-500 focus:ring-2 focus:outline-none block w-full p-2.5" readonly placeholder="Name Slug" required>
            </div> 
            <div class="mt-6">
                <label for="address" class="block mb-2 text-sm font-medium text-gray-900">Address</label>
                <input type="text" id="address" name="address" value="{{ old('address', $destination->address) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-300 focus:border-blue-500 focus:ring-2 focus:outline-none block w-full p-2.5" placeholder="Address" required>
            </div> 
            <div class="mt-6">
                <label for="landmark" class="block mb-2 text-sm font-medium text-gray-900">Landmark</label>
                <input type="text" id="landmark" name="landmark" value="{{ old('landmark', $destination->landmark) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-300 focus:border-blue-100 block focus:ring-2 focus:outline-none w-full p-2.5" placeholder="Landmark" required>
            </div>
            <div class="mt-6 flex items-center gap-2">
                <input type="checkbox" id="has_return" {{ $destination->has_return == 1 ? 'checked' : '' }} name="has_return" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                <label for="has_return" class="block text-sm font-medium text-gray-900">Has Return</label>
            </div>
            
            <button type="submit" class="mt-6 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Update Destination</button>
        </form>
    </div>
</div>
@push('scripts')
<script>
    $(document).ready(function(){
        $('#name').on('change', function(){
            const name = $(this).val()

            $.ajax({
                url: "{{ route('get-string-slug') }}",
                type: "GET",
                dataType: "json",
                data: {
                    string: name
                },
                success: function(response) {
                    $("#name_slug").val(response);
                    if(response !== ""){
                        $("#name_slug").attr('disabled', false)
                    }
                },
            });
        });
    });
</script>
@endpush
</x-app-layout>