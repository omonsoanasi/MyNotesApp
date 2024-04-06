<div>
    <!-- Let all your things have their places; let each part of your business have its time. - Benjamin Franklin -->
</div>
<x-app-layout>
    <div class="note-container py-12">
        <div class="flex justify-end p-6">
            <a href="{{ route('role.create') }}">
                <button type="button"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                    Add Role
                </button>
            </a>
        </div>
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        ID
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($roles as $role)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $role->id }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $role->name }}
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex">
                                <a href="{{ route('role.edit', $role) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a> &nbsp; || &nbsp;
                                <a href="{{ route('role.add-permissions', $role) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Manage Permissions</a>
                                <form method="post" action="{{ route('role.destroy', $role) }}" onsubmit="confirm('are you sure you want to delete this role?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="font-medium text-red-600 dark:text-red-500 hover:underline ms-3">Remove</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
