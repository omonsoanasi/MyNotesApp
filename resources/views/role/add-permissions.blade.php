<x-app-layout>
    <div class="note-container py-12">
        <button type="button"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
            Edit {{ $role->name }}
        </button>
    </div>


    <form action="{{ route('role.give-permissions', $role) }}" method="POST" class="max-w-md mx-auto">
        @csrf
        @method('PUT')
        <div class="relative z-0 w-full mb-5 group">
            @foreach($permissions as $permission)
                <div class="flex items-center mb-4">
                    <input id="checkbox" type="checkbox" name="permission[]" value="{{ $permission->name }}" {{ in_array($permission->id, $rolePermissions) ? 'checked':'' }} class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="checkbox-2" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ $permission->name }}</label>
                </div>
            @endforeach
        </div>
        <button type="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            Submit
        </button>
    </form>


</x-app-layout>
