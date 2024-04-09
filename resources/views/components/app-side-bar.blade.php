<aside id="sidebar-multi-level-sidebar" class="fixed top-0 left-0 z-40 w-80 h-screen transition -translate-x-full lg:translate-x-0 delay-100 duration-500 ease-in-out" aria-label="Sidebar">
    <div class="h-full px-6 py-8 overflow-y-auto bg-white border-r border-gray-200">
        <div class="w-full">
            <img src="https://ik.imagekit.io/k4cixy45r/assets/busmein-logo_S4V_D21jj.png?updatedAt=1706453127454" alt="Interior Logo" class="h-8">
        </div>

        <ul class="w-full mt-12 space-y-4 font-medium">
            <li>
                <a href="{{ route('dashboard') }}" class="w-full flex items-center px-4 py-3 text-gray-900 group {{ Route::current()->getName() == 'dashboard' ? 'bg-slate-100' : 'hover:bg-gray-100' }}">
                    <svg class="w-5 h-5 transition duration-75 {{ Route::current()->getName() == 'dashboard' ? 'fill-blue-600' : 'fill-gray-500 group-hover:fill-gray-900' }}" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 21">
                        <path d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z"/>
                        <path d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z"/>
                    </svg>
                    <span class="ms-4 text-lg {{ Route::current()->getName() == 'dashboard' ? 'text-blue-600 font-bold' : '' }}">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="{{ route('media.index') }}" class="w-full flex items-center px-4 py-3 text-gray-900 group {{ Route::current()->getName() == 'media.index' ? 'bg-slate-100' : 'hover:bg-gray-100' }}">
                    <svg class="w-5 h-5 transition duration-75 {{ Route::current()->getName() == 'media.index' ? 'fill-blue-600' : 'fill-gray-500 group-hover:fill-gray-900' }}" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M19.999 4h-16c-1.103 0-2 .897-2 2v12c0 1.103.897 2 2 2h16c1.103 0 2-.897 2-2V6c0-1.103-.897-2-2-2zm-13.5 3a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3zm5.5 10h-7l4-5 1.5 2 3-4 5.5 7h-7z"></path></svg>
                    <span class="ms-4 text-lg {{ Route::current()->getName() == 'media.index' ? 'text-blue-600 font-bold' : '' }}">Media</span>
                </a>
            </li>
            <li>
                <a href="{{ route('bookings.index') }}" class="w-full flex items-center px-4 py-3 text-gray-900 group {{ Route::current()->getName() == 'bookings.index' ? 'bg-slate-100' : 'hover:bg-gray-100' }}">
                    <svg class="w-5 h-5 transition duration-75 {{ Route::current()->getName() == 'bookings.index' ? 'fill-blue-600' : 'fill-gray-500 group-hover:fill-gray-900' }}" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M21 4H2v2h2.3l3.521 9.683A2.004 2.004 0 0 0 9.7 17H18v-2H9.7l-.728-2H18c.4 0 .762-.238.919-.606l3-7A.998.998 0 0 0 21 4z"></path><circle cx="10.5" cy="19.5" r="1.5"></circle><circle cx="16.5" cy="19.5" r="1.5"></circle></svg>
                    <span class="ms-4 text-lg {{ Route::current()->getName() == 'bookings.index' ? 'text-blue-600 font-bold' : '' }}">Bookings</span>
                </a>
            </li>
            <li>
                <a href="{{ route('buses.index') }}" class="w-full flex items-center px-4 py-3 text-gray-900 group {{ request()->segment(2) == 'buses' ? 'bg-slate-100' : 'hover:bg-gray-100' }}">
                    <svg class="w-5 h-5 transition duration-75 {{ request()->segment(2) == 'buses' ? 'fill-blue-600' : 'fill-gray-500 group-hover:fill-gray-900' }}" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M21 6.021c.003-.146-.007-1.465-1.3-2.735C18.427 2.036 17.143 2 17 2H6.996c-.239 0-1.493.063-2.708 1.302C3.036 4.578 3 5.859 3 6v3H2v3h1v6c0 .734.406 1.373 1 1.721V21a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1v-1h10v1a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1v-1.277A1.99 1.99 0 0 0 21 18v-6h1V9h-1V6.021zM9 4h6v2H9V4zM6.5 18a1.5 1.5 0 1 1 .001-3.001A1.5 1.5 0 0 1 6.5 18zm4.5-5H5V8h6v5zm6.5 5a1.5 1.5 0 1 1 .001-3.001A1.5 1.5 0 0 1 17.5 18zm1.5-5h-6V8h6v5z"></path></svg>
                    <span class="ms-4 text-lg {{ request()->segment(2) == 'buses' ? 'text-blue-600 font-bold' : '' }}">Buses</span>
                </a>
            </li>
            <li>
                <a href="{{ route('routes.index') }}" class="w-full flex items-center px-4 py-3 text-gray-900 group {{ request()->segment(2) == 'routes' ? 'bg-slate-100' : 'hover:bg-gray-100' }}">
                    <svg class="w-5 h-5 transition duration-75 {{ request()->segment(2) == 'routes' ? 'fill-blue-600' : 'fill-gray-500 group-hover:fill-gray-900' }}" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="m21.447 6.105-6-3a1 1 0 0 0-.895 0L9 5.882 3.447 3.105A1 1 0 0 0 2 4v13c0 .379.214.725.553.895l6 3a1 1 0 0 0 .895 0L15 18.118l5.553 2.776a.992.992 0 0 0 .972-.043c.295-.183.475-.504.475-.851V7c0-.379-.214-.725-.553-.895zM10 7.618l4-2v10.764l-4 2V7.618zm-6-2 4 2v10.764l-4-2V5.618zm16 12.764-4-2V5.618l4 2v10.764z"></path></svg>
                    <span class="ms-4 text-lg {{ request()->segment(2) == 'routes' ? 'text-blue-600 font-bold' : '' }}">Routes</span>
                </a>
            </li>
            <li>
                <a href="{{ route('destinations.index') }}" class="w-full flex items-center px-4 py-3 text-gray-900 group {{ Route::current()->getName() == 'destinations.index' ? 'bg-slate-100' : 'hover:bg-gray-100' }}">
                    <svg class="w-5 h-5 transition duration-75 {{ Route::current()->getName() == 'destinations.index' ? 'fill-blue-600' : 'fill-gray-500 group-hover:fill-gray-900' }}" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 22s8.029-5.56 8-12c0-4.411-3.589-8-8-8S4 5.589 4 9.995C3.971 16.44 11.696 21.784 12 22zM8 9h3V6h2v3h3v2h-3v3h-2v-3H8V9z"></path></svg>
                    <span class="ms-4 text-lg {{ Route::current()->getName() == 'destinations.index' ? 'text-blue-600 font-bold' : '' }}">Places</span>
                </a>
            </li>
            <li class="hidden">
                <button type="button" class="flex items-center w-full px-4 py-3 text-base text-gray-900 transition duration-75 group hover:bg-gray-100" aria-controls="dropdown-example" data-collapse-toggle="dropdown-example">
                    <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 21">
                        <path d="M15 12a1 1 0 0 0 .962-.726l2-7A1 1 0 0 0 17 3H3.77L3.175.745A1 1 0 0 0 2.208 0H1a1 1 0 0 0 0 2h.438l.6 2.255v.019l2 7 .746 2.986A3 3 0 1 0 9 17a2.966 2.966 0 0 0-.184-1h2.368c-.118.32-.18.659-.184 1a3 3 0 1 0 3-3H6.78l-.5-2H15Z"/>
                    </svg>
                    <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">E-commerce</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                    </svg>
                </button>
                <ul id="dropdown-example" class="hidden py-2 space-y-2">
                    <li>
                        <a href="#" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100">Products</a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100">Billing</a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100">Invoice</a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</aside>