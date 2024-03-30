<x-app-layout>
@section('styles')
@endsection

<div class="w-full">
    <!-- title -->
    <div class="w-full flex justify-between items-center">
        <h2 class="text-lg font-semibold text-gray-800">Add New Bus</h2>
    </div>

    <div class="mt-2 bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
            @if ($errors->any())
            <x-form-errors :errors="$errors" />
            @endif

            <form action="{{ route('buses.store') }}" method="POST" class="w-full max-w-lg mx-auto space-y-4">
                @csrf
                <div class="w-full">
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Bus name</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-300 focus:border-blue-500 focus:ring-4 focus:outline-none block w-full p-2.5" placeholder="Bus Name" required />
                </div>
                <div class="w-full">
                    <label for="subtext" class="block mb-2 text-sm font-medium text-gray-900">Bus Sub Title</label>
                    <input type="text" id="subtext" name="subtext" value="{{ old('subtext') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-300 focus:border-blue-500 focus:ring-4 focus:outline-none block w-full p-2.5" placeholder="Bus Sub Title" required />
                </div>
                <div class="w-full">
                    <label for="rating" class="block mb-2 text-sm font-medium text-gray-900">Default Bus Rating</label>
                    <input type="text" id="rating" name="rating" value="{{ old('rating') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-300 focus:border-blue-500 focus:ring-4 focus:outline-none block w-full p-2.5" placeholder="Bus Rating" required />
                </div>
                <div class="w-full">
                    <label for="badge" class="block mb-2 text-sm font-medium text-gray-900">Bus Badge</label>
                    <select type="text" id="badge" name="badge" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-300 focus:border-blue-500 focus:ring-4 focus:outline-none block w-full p-2.5" required>
                        <option>Choose Badge</option>
                        <option value="fastest" {{ old('badge') == 'fastest' ? 'selected' : '' }}>Fastest</option>
                        <option value="cheapest" {{ old('badge') == 'cheapest' ? 'selected' : '' }}>Cheapest</option>
                        <option value="moderate" {{ old('badge') == 'moderate' ? 'selected' : '' }}>Moderate</option>
                    </select>
                </div>

                <button type="submit" class="mt-6 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Add New Bus</button>
            </form>
        </div>
    </div>
</div>

@section('scripts')
@endsection
</x-app-layout>