<x-app-layout>
    <div class="note-container py-12">
        <button type="button"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
            Edit User {{ $user->name }}
        </button>
    </div>


    <form action="{{ route('user.update', $user) }}" method="POST" class="max-w-md mx-auto">
        @csrf
        @method('PUT')
        <div class="relative z-0 w-full mb-5 group">
            <input type="text" name="name" id="floating_name" value="{{ $user->name }}"
                   class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                   placeholder="user name" required/>
        </div>
        <div class="relative z-0 w-full mb-5 group">
            <input type="email" name="email" id="floating_name" value="{{ $user->email }}"
                   class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                   placeholder="user email" required/>
        </div>
        <div class="relative z-0 w-full mb-5 group">
            <input type="password" name="password" id="floating_name"
                   class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                   placeholder="user password"/>
        </div>

        <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select role</label>
        <select id="role" name="roles[]" multiple
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 p-2">

            @foreach($roles as $role)
                <option
                    value="{{ $role->name }}"
                    {{ in_array($role->name, $userRoles) ? 'selected':'' }}
                >
                    {{ $role->name }}
                </option>
            @endforeach

        </select>

        <button type="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            Submit
        </button>
    </form>


</x-app-layout>
