<x-app-layout>
@push('styles')
<link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/filepond/4.30.4/filepond.min.css" integrity="sha512-GZs7OYouCNZCZFJ46MulDG9BOd9MjYuJv06Be1vVVQv8EdFP76llX+SUoEK2fJvFiKVO34UKBZ2ckU0psBaXeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush
<div class="w-full">
    <!-- actions -->
    <div class="w-full flex justify-between items-center">
        <h1 class="text-2xl text-gray-900 font-bold">Media Library</h1>

        <button data-modal-show="addMediaModal" class="openModalBtn text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 focus:outline-none">
            <i class="bi bi-plus"></i> Create
        </button>
        <span class="text-red-500 hidden border border-gray-300 shadow-gray-900 text-orange-500"></span><!-- do not remove this -->
    </div>

    <div class="mt-6 bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <span class="sr-only max-w-12"></span>
        <div class="p-6 text-gray-900 table-responsive">
            {{ $dataTable->table() }}
        </div>
    </div>

    <!-- Create modal -->
    <div id="addMediaModal" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full bg-gray-700 bg-opacity-40">
        <div class="relative p-4 w-full max-w-2xl max-h-full mx-auto">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                    <h3 class="text-xl font-semibold text-gray-900">
                        Add Media
                    </h3>
                    <button type="button" class="closeModalBtn text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-hide="addMediaModal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form action="{{ route('media.store') }}" method="POST" class="w-full">
                    @csrf
                    <div class="p-4 md:p-5 space-y-4">
                        <div class="w-full">
                            <input type="file" class="media-pond min-h-24" name="filepond"/>
                        </div>
                        <div class="mb-0">
                            <label for="title" class="block mb-2 text-sm font-medium text-gray-900">Title</label>
                            <input type="text" id="title" name="title" value="{{ old('title') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-300 focus:border-blue-500 focus:ring-2 focus:outline-none block w-full p-2.5" placeholder="Title / Alt Text" required>
                        </div> 
                    </div>
                    <!-- Modal footer -->
                    <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b">
                        <button type="submit" id="addMediaSubmitBtn" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center disabled:bg-blue-400">Add Media</button>
                        <button data-modal-hide="addMediaModal" type="button" class="closeModalBtn ms-3 text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Create modal -->
    <div id="editMediaModal" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full bg-gray-700 bg-opacity-40">
        <div class="relative p-4 w-full max-w-2xl max-h-full mx-auto">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                    <h3 class="text-xl font-semibold text-gray-900">
                        Edit Media
                    </h3>
                    <button type="button" class="closeModalBtn text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-hide="editMediaModal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form action="{{ route('media.update', 0) }}" method="POST" class="w-full">
                    @csrf
                    @method('PUT')
                    <div class="p-4 md:p-5 space-y-4">
                        <div class="w-full">
                            <input type="file" class="media-pond min-h-24" name="filepond"/>
                            <input type="hidden" name="media" id="media"/>
                        </div>
                        <div class="mb-0">
                            <label for="title" class="block mb-2 text-sm font-medium text-gray-900">Title</label>
                            <input type="text" id="title" name="title" value="{{ old('title') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-300 focus:border-blue-500 focus:ring-2 focus:outline-none block w-full p-2.5" placeholder="Title / Alt Text" required>
                        </div> 
                    </div>
                    <!-- Modal footer -->
                    <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b">
                        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Update Media</button>
                        <button data-modal-hide="editMediaModal" type="button" class="closeModalBtn ms-3 text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@push('scripts')
{{ $dataTable->scripts() }}
<!-- include FilePond plugins -->
<script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
<script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.js"></script>

<!-- include FilePond library -->
<script src="https://unpkg.com/filepond/dist/filepond.min.js"></script>
<script src="https://unpkg.com/jquery-filepond/filepond.jquery.js"></script>

<script>
$.fn.filepond.registerPlugin(FilePondPluginImagePreview);
$.fn.filepond.registerPlugin(FilePondPluginFileValidateType);

$('.media-pond').filepond({
    name: "filepond",
    allowMultiple: false,
    acceptedFileTypes: ['image/*'],
    server: {
        url: '{{route('media.upload.temp')}}',
        process: {
            url: '',
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            withCredentials: false,
            ondata: (formData) => {
                formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
                return formData;
            },
            onerror: (response) => {
                response = JSON.parse(response)
                alert('error when uploading file ' + response.message);
            }
        },
    },
    onprocessfiles: () => {
        $('#addMediaSubmitBtn').attr('disabled', false);
    },
    onremovefile: () => {
        $('#addMediaSubmitBtn').attr('disabled', true);
    },
});

$(document).ready(function(){
    $('#addMediaSubmitBtn').attr('disabled', true);
})

function dropActions(dropdownId){
    $(".actionsDropdownContent[data-dropdownid='" + dropdownId + "']").toggle();
}

// edit quotation
function editMedia(id){
    const title = $(`.editMediaBtn[data-id="${id}"]`).data('title');

    // show modal
    $('#editMediaModal').removeClass('hidden');
    $('#editMediaModal').show();

    // set input values
    $('#editMediaModal input#title').val(title);
    $('#editMediaModal input#media').val(id);
}
</script>
@endpush
</x-app-layout>