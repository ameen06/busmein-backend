<x-app-layout>
@push('styles')
@yield('styles')
@endpush
<div class="w-full">
    <h1 class="text-2xl text-gray-900 font-bold">Bus: <span class="text-blue-700 font-black">@yield('bus_name')</span></h1>

    <!-- info -->
    <div class="w-full mt-8">
        @yield('info')
    </div>


    <div class="w-full mt-8 bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="border-b border-gray-200">
            <ul class="flex flex-wrap -mb-px text-sm font-medium text-center text-gray-500">
                <li class="me-2">
                    <a href="{{ route('buses.show', $bus->id) }}" class="inline-flex items-center justify-center p-4 border-b-2 rounded-t-lg group {{ Route::current()->getName() == 'buses.show' ? 'text-blue-600 border-blue-600' : 'hover:text-gray-600 border-transparent hover:border-gray-300' }}">
                        <svg class="w-5 h-5 me-2 {{ Route::current()->getName() == 'buses.show' ? 'fill-blue-600' : 'fill-gray-400 group-hover:fill-gray-500' }}" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M13 2.051V11h8.949c-.47-4.717-4.232-8.479-8.949-8.949zm4.969 17.953c2.189-1.637 3.694-4.14 3.98-7.004h-8.183l4.203 7.004z"></path><path d="M11 12V2.051C5.954 2.555 2 6.824 2 12c0 5.514 4.486 10 10 10a9.93 9.93 0 0 0 4.255-.964s-5.253-8.915-5.254-9.031A.02.02 0 0 0 11 12z"></path></svg>
                        Stats
                    </a>
                </li>
                <li class="me-2">
                    <a href="{{ route('buses.edit', $bus->id) }}" class="inline-flex items-center justify-center p-4 border-b-2 rounded-t-lg group {{ Route::current()->getName() == 'buses.edit' ? 'text-blue-600 border-blue-600' : 'hover:text-gray-600 border-transparent hover:border-gray-300' }}">
                        <svg class="w-5 h-5 me-2 {{ Route::current()->getName() == 'buses.edit' ? 'fill-blue-600' : 'fill-gray-400 group-hover:fill-gray-500' }}" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="m21.743 12.331-9-10c-.379-.422-1.107-.422-1.486 0l-9 10a.998.998 0 0 0-.17 1.076c.16.361.518.593.913.593h2v7a1 1 0 0 0 1 1h3a1 1 0 0 0 1-1v-4h4v4a1 1 0 0 0 1 1h3a1 1 0 0 0 1-1v-7h2a.998.998 0 0 0 .743-1.669z"></path></svg>
                        General
                    </a>
                </li>
                <li class="me-2">
                    <a href="{{ route('buses.seating.edit', $bus->id) }}" class="inline-flex items-center justify-center p-4 border-b-2 rounded-t-lg group {{ Route::current()->getName() == 'buses.seating.edit' ? 'text-blue-600 border-blue-600' : 'hover:text-gray-600 border-transparent hover:border-gray-300' }}">
                        <svg class="h-5 me-2 {{ Route::current()->getName() == 'buses.seating.edit' ? 'text-blue-600' : 'text-gray-400 group-hover:text-gray-500' }}" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 28 28">
                            <g fill="none" fill-rule="evenodd">
                              <path d="M0 0h28v27H0z"/>
                              <path d="M4 10V4a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v6a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V12a2 2 0 0 1 2-2z" fill="currentColor"/>
                              <path d="M22 2a2 2 0 0 1 2 2v6c1.105 0 2 .895 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V12a2 2 0 0 1 2-2V4a2 2 0 0 1 2-2h16zM6 11H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h20a1 1 0 0 0 1-1V12a1 1 0 0 0-1-1h-2v7.925a2.4 2.4 0 0 1-1.83 2.332 25.521 25.521 0 0 1-6.087.743 27.03 27.03 0 0 1-6.236-.75A2.4 2.4 0 0 1 6 18.914V11zm16-8H6a1 1 0 0 0-1 1v6h1a1 1 0 0 1 1 1v7.914a1.4 1.4 0 0 0 1.078 1.362 26.03 26.03 0 0 0 6.005.724c1.953 0 3.903-.238 5.85-.715A1.4 1.4 0 0 0 21 18.925V11a1 1 0 0 1 1-1h1V4a1 1 0 0 0-1-1z" class="fill-white" fill-rule="nonzero"/>
                            </g>
                        </svg>
                        Seating
                    </a>
                </li>
                <li class="me-2">
                    <a href="{{ route('buses.services.index', $bus->id) }}" class="inline-flex items-center justify-center p-4 border-b-2 rounded-t-lg group {{ Str::startsWith(Route::current()->getName(), 'buses.services.') ? 'text-blue-600 border-blue-600' : 'hover:text-gray-600 border-transparent hover:border-gray-300' }}">
                        <svg class="w-5 h-5 me-2 {{ Str::startsWith(Route::current()->getName(), 'buses.services.') ? 'fill-blue-600' : 'fill-gray-400 group-hover:fill-gray-500' }}" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M4 13h6a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1zm-1 7a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-4a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1v4zm10 0a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-7a1 1 0 0 0-1-1h-6a1 1 0 0 0-1 1v7zm1-10h6a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1h-6a1 1 0 0 0-1 1v5a1 1 0 0 0 1 1z"></path></svg>
                        Daily Services
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <!-- content -->
    <div class="mt-6">
        @yield('content')
    </div>
</div>
@push('scripts')
@yield('scripts')
@endpush
</x-app-layout>