<form wire:submit="{{$edit_route ? 'updateRoute' : 'createRoute'}}" class="max-w-xl mx-auto space-y-4 py-8">
    <div class="w-full">
        <label for="title" class="block mb-2 text-sm font-medium text-gray-900">Route title</label>
        <input type="text" id="title" wire:model.blur="title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-300 focus:border-blue-500 focus:ring-4 focus:outline-none block w-full p-2.5" placeholder="Route title" required />
        @error('title') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>
    <div class="w-full">
        <label for="starting_point" class="block mb-2 text-sm font-medium text-gray-900">Starting From</label>
        <select id="starting_point" wire:model="starting_point" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-300 focus:border-blue-500 focus:ring-4 focus:outline-none block w-full p-2.5" required>
            <option value="">Select Starting Point</option>
            @foreach ($boarding_points as $point)
            <option value="{{ $point->id }}">{{ $point->name }}</option>
            @endforeach
        </select>
        @error('starting_point') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>

    {{-- starting stops --}}
    <div class="w-full">
        <p class="block mt-8 mb-2 text-sm font-medium text-gray-900">Stops in between</p>
        <div class="w-full mb-8 px-4 py-2 border border-gray-300 rounded-md">
            <table class="w-full">
                <thead class="border-b border-gray-300">
                    <tr>
                        <th class="py-2 w-[50%]">Place</th>
                        <th class="py-2 pl-2">Time (minutes)</th>
                        <th class="py-2 pl-2"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($route_stops as $index => $stop)  
                    <tr>
                        <td class="py-2">
                            <select wire:model="route_stops.{{$index}}.stop_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-300 focus:border-blue-500 focus:ring-4 focus:outline-none block w-full p-2.5" required>
                                <option value="">Select Stop</option>
                                @foreach ($all_points as $point)
                                <option value="{{ $point->id }}">{{ $point->name }}</option>
                                @endforeach
                            </select>
                            @error('route_stops.{{$index}}.stop') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                        </td>
                        <td class="py-2 pl-2">
                            <input type="number" min="1" wire:model="route_stops.{{$index}}.time" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-300 focus:border-blue-500 focus:ring-4 focus:outline-none block w-full p-2.5" placeholder="Time" required />
                            @error('route_stops.{{$index}}.time') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                        </td>
                        <td class="py-2 pl-2">
                            <button type="button" wire:click.prevent="removeRouteStop({{$index}})" class="text-white bg-red-600 hover:bg-red-800 focus:outline-none font-medium rounded-lg text-sm w-full sm:w-auto px-4 py-2.5 text-center">X</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <button type="button" wire:click.prevent="addRouteStop" class="mt-2 text-white bg-gray-500 hover:bg-gray-700 focus:outline-none font-medium rounded-lg text-sm w-full sm:w-auto px-4 py-1 text-center">Add Stop</button>
        </div>
    </div>

    {{-- ending stops --}}

    <div class="w-full">
        <label for="ending_point" class="block mb-2 text-sm font-medium text-gray-900">Ending At</label>
        <select id="ending_point" wire:model="ending_point" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-300 focus:border-blue-500 focus:ring-4 focus:outline-none block w-full p-2.5" required>
            <option value="">Select Ending Point</option>
            @foreach ($dropping_points as $point)
            <option value="{{ $point->id }}">{{ $point->name }}</option>
            @endforeach
        </select>
        @error('ending_point') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>
    <div class="w-full">
        <label for="total_time" class="block mb-2 text-sm font-medium text-gray-900">Total Time (in Minutes)</label>
        <input type="number" min="1" id="total_time" wire:model="total_time" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-300 focus:border-blue-500 focus:ring-4 focus:outline-none block w-full p-2.5" placeholder="Total Time" required />
        @error('total_time') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>
    <div class="w-full">
        <label for="total_distance" class="block mb-2 text-sm font-medium text-gray-900">Total Distance (in Kilometers)</label>
        <input type="number" min="1" id="total_distance" wire:model="total_distance" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-300 focus:border-blue-500 focus:ring-4 focus:outline-none block w-full p-2.5" placeholder="Toute Distance" required />
        @error('total_distance') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>

    <button type="submit" class="mt-6 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">{{ $edit_route ? 'Update' : 'Add'}} Route</button>
</form>
