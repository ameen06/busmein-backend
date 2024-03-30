<div id="actionsDropdownContainer">
    <button id="actionsDropdownBtn" onclick="{{ 'dropActions('. $query->id .')' }}" class="actionsDropdownBtn" type="button">
        Actions
        <i class="bi bi-chevron-right text-xs ml-2"></i>
    </button>
    
    <!-- Dropdown menu -->
    <div id="actionsDropdownContent" data-dropdownId="{{ $query->id }}" class="actionsDropdownContent" style="inset: 0px auto auto 0px; transform: translate3d(105px, -35px, 0px);">
        <div class="px-4 py-2 text-gray-900 border-b border-gray-400">
            <p class="text-sm font-bold truncate">Actions</p>
        </div>
        <ul class="text-sm text-gray-700 divide-y divide-gray-200">
            <li class="overflow-hidden">
                <a href="{{ route('routes.edit', $query->id) }}" class="block px-4 py-2 hover:bg-gray-100">Edit</a>
            </li>
            <li class="overflow-hidden">
                <form method="POST" action="{{ route('routes.destroy', $query->id) }}" class="w-full inline-flex">
                    @csrf
                    @method('DELETE')
                    <a href="{{ route('routes.destroy', $query->id) }}" onclick="event.preventDefault();if(window.confirm('Are you sure')){this.closest('form').submit()};" class="w-full px-4 py-2 hover:bg-gray-100 text-red-500">
                        Delete
                    </a>
                </form>
            </li>
        </ul>
    </div>
</div>