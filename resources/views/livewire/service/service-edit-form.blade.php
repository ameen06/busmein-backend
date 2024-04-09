<form class="max-w-xl mx-auto space-y-4 py-8">
    @error('error') <div class="w-full flex items-center px-6 py-3 mb-4 text-base text-red-800 border border-red-300 rounded-lg bg-red-400">{{ $message }}</div> @enderror
    <div class="w-full">
        <label for="title" class="block mb-2 text-sm font-medium text-gray-900">Service title</label>
        <input type="text" id="title" wire:model.blur="title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-300 focus:border-blue-500 focus:ring-4 focus:outline-none block w-full p-2.5" placeholder="Service title" required />
        @error('title') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>
    <div class="w-full">
        <label for="day" class="block mb-2 text-sm font-medium text-gray-900">Day</label>
        <select id="day" wire:model="day" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-300 focus:border-blue-500 focus:ring-4 focus:outline-none block w-full p-2.5" required>
            <option>Select Day</option>
            <option value="0">Monday</option>
            <option value="1">Tuesday</option>
            <option value="2">Wednesday</option>
            <option value="3">Thursday</option>
            <option value="4">Friday</option>
            <option value="5">Saturday</option>
            <option value="6">Sunday</option>
        </select>
        @error('day') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>
    <div class="w-full">
        <label for="start_time" class="block mb-2 text-sm font-medium text-gray-900">Start Time</label>
        <input type="time" id="start_time" wire:model.blur="start_time" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-300 focus:border-blue-500 focus:ring-4 focus:outline-none block w-full p-2.5" placeholder="Start Time" required />
        @error('start_time') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>
    <div class="w-full">
        <label for="route" class="block mb-2 text-sm font-medium text-gray-900">Routes</label>
        <select id="route" wire:model.live="route" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-300 focus:border-blue-500 focus:ring-4 focus:outline-none block w-full p-2.5" required>
            <option>Select Route</option>
            @foreach($routes as $route)
            <option value="{{ $route->id }}">{{ $route->title }}</option>
            @endforeach
        </select>
        @error('route') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>

    {{-- starting stops --}}
    @if (count($route_prices) > 0)  
    <div class="w-full">
        <p class="block mt-8 mb-2 text-sm font-medium text-gray-900">Stops in between</p>
        <div class="w-full mb-8 px-4 py-2 border border-gray-300 rounded-md">
            <table class="w-full">
                <thead class="border-b border-gray-300">
                    <tr>
                        <th class="py-2 w-[50%]">Stop</th>
                        <th class="py-2 pl-2">Price</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($route_prices as $index => $stop)  
                    <tr wire:key="{{$index}}">
                        <td class="py-2">
                            <select id="route" wire:model="route_prices.{{$index}}.stop_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-300 focus:border-blue-500 focus:ring-4 focus:outline-none block w-full p-2.5" required disabled>
                                <option value="{{$stop['stop_id']}}">{{$stop['stop_name']}}</option>
                            </select>
                            @error('route_prices.{{$index}}.stop_id') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                        </td>
                        <td class="py-2 pl-2">
                            <input type="number" wire:model="route_prices.{{$index}}.price" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-300 focus:border-blue-500 focus:ring-4 focus:outline-none block w-full p-2.5" placeholder="Time" required />
                            @error('route_prices.{{$index}}.price') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif

    <button type="submit" class="mt-6 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center" wire:click="updateService">Update Service</button>
</form>