<div class="w-full grid md:grid-cols-2 gap-6">
    <div class="w-full space-y-4">
        <div class="w-full">
            <label for="total_seats" class="block mb-2 text-sm font-medium text-gray-900">Total Seats</label>
            <input type="text" id="total_seats" value="{{ $bus->total_seats }}" wire:model.live="total_seats" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-300 focus:border-blue-500 focus:ring-4 focus:outline-none block w-full p-2.5" placeholder="Total Seats" required />
        </div>
        <div class="w-full">
            <label for="total_left" class="block mb-2 text-sm font-medium text-gray-900">Seats In Left</label>
            <input type="text" id="total_left" wire:model.live="total_left" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-300 focus:border-blue-500 focus:ring-4 focus:outline-none block w-full p-2.5" placeholder="Seats In Left" required />
        </div>
        <div class="w-full">
            <label for="total_right" class="block mb-2 text-sm font-medium text-gray-900">Seats In Right</label>
            <input type="text" id="total_right" wire:model.live="total_right" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-300 focus:border-blue-500 focus:ring-4 focus:outline-none block w-full p-2.5" placeholder="Seats In Right" required />
        </div>
    </div>

    <div class="w-full mt-6 md:mt-0 max-w-xs mx-auto bg-white pb-4 border border-gray-400 rounded-lg shadow-sm">
        <div class="w-full p-3 border-b border-gray-300">
          <svg class="h-6 fill-none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
          <path fill-rule="evenodd" clip-rule="evenodd" d="M10.5 18.9863C15.238 18.7269 19 14.8028 19 10C19 8.87127 18.7922 7.79107 18.4128 6.79556L12.8825 9.1657C12.959 9.43056 13 9.71049 13 10C13 11.4865 11.9189 12.7205 10.5 12.9585V18.9863ZM10.5 19.9877C15.7906 19.7272 20 15.3552 20 10C20 4.47715 15.5228 0 10 0C4.47715 0 0 4.47715 0 10C0 15.3552 4.20944 19.7272 9.5 19.9877V20H10H10.5V19.9877ZM9.5 18.9863C4.76201 18.7269 1 14.8028 1 10C1 8.87132 1.20777 7.79116 1.58714 6.79569L7.11749 9.16584C7.04099 9.43066 7 9.71054 7 10C7 11.4865 8.08114 12.7205 9.5 12.9585V18.9863ZM18.0049 5.88239L12.4472 8.26429C11.9035 7.49917 11.0101 7 10 7C8.98988 7 8.09637 7.49923 7.55272 8.26441L1.99498 5.88252C3.48947 2.98287 6.51317 1 10 1C13.4868 1 16.5104 2.98281 18.0049 5.88239ZM10 11C10.5523 11 11 10.5523 11 10C11 9.44772 10.5523 9 10 9C9.44772 9 9 9.44772 9 10C9 10.5523 9.44772 11 10 11Z" fill="#3E3E52"/>
          </svg>
        </div>

        <!-- seats -->
        <div class="w-full mt-4 px-6 py-4 space-y-2">
            <div class="w-fit grid grid-cols-2 gap-x-6 gap-y-4 mx-auto">
                @foreach ($seats as $sides)
                    @foreach ($sides as $side)
                        <div class="w-full">
                            <div class="w-full flex gap-2">
                                @foreach ($side as $seat)
                                    <div class="w-8 h-8 text-sm font-bold flex items-center justify-center bg-gray-300 border-2 border-gray-400 text-gray-900">{{$seat}}</div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                @endforeach
            </div>
        </div>
      </div>
</div>
