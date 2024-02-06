@if(Session::has('alert'))
<!-- alert -->
<div class="w-full flex items-center px-6 py-4 mb-4 text-base text-{{$alertColor}}-800 border border-{{$alertColor}}-300 rounded-lg bg-{{$alertColor}}-100" role="alert" id="alert">
    <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
    </svg>
    <span class="sr-only">Info</span>
    <div class="flex-grow w-full">
        {{ $message }}
    </div>
    <div class="hidden text-green-800 border-green-300 bg-green-100"></div>
    <div class="hidden text-blue-800 border-blue-300 bg-blue-100"></div>
    <div class="hidden text-red-800 border-red-300 bg-red-100"></div>
    <button class="ml-4" id="close-alert-btn">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" class="fill-gray-700"><path d="m16.192 6.344-4.243 4.242-4.242-4.242-1.414 1.414L10.535 12l-4.242 4.242 1.414 1.414 4.242-4.242 4.243 4.242 1.414-1.414L13.364 12l4.242-4.242z"></path></svg>
    </button>

    <script>
        $(document).ready(function(){
            setTimeout(function(){
                $('#alert').addClass('hidden');
            }, 7000);

            $('#close-alert-btn').on('click', function(){
                $('#alert').addClass('hidden');
            });
        });
    </script>
</div>
@endif