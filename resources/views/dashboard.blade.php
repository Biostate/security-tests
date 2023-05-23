<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="max-w-md mx-auto">
                    <form
                        action="{{ route('todos.store') }}"
                        method="POST"
                        class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4"
                    >
                        @csrf
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                                Başlık
                            </label>
                            <input name="title" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="title" type="text" placeholder="Başlık girin...">
                        </div>
                        <div class="mb-6">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="details">
                                Detaylar
                            </label>
                            <textarea name="description" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="details" type="text" placeholder="Detaylar girin..."></textarea>
                        </div>
                        <div class="flex items-center justify-center">
                            <button
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                                type="submit"
                            >
                                Kaydet
                            </button>
                        </div>
                    </form>
                </div>
                <div class="max-w-md mx-auto">
                    <div class="border-b border-gray-200">
                        <nav class="-mb-px flex">
                            <a class="bg-white inline-block border-l border-t border-r rounded-t py-2 px-4 text-blue-700 font-semibold" href="#">
                                Tamamlanmamışlar
                            </a>
                            <a class="bg-white inline-block py-2 px-4 text-blue-500 hover:text-blue-800 font-semibold" href="#">
                                Tamamlanmışlar
                            </a>
                        </nav>
                    </div>
                </div>

            @if($todos->count() === 0)
                    <div class="p-6 text-gray-900 text-center">
                        {{ __("You have no todo! Good job!") }}
                    </div>
                @endif
                <div class="max-w-lg mx-auto">
                    <ul class="bg-white rounded-lg divide-y divide-gray-300">
                        @foreach($todos as $todo)
                            <li class="px-6 py-4 hover:bg-gray-100 flex items-center">
                                <div class="ml-auto">
                                    <form
                                        action="{{ route('todos.update', ['todo' => $todo->id]) }}"
                                        method="POST"
                                        class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4"
                                    >
                                        @csrf
                                        <input type="hidden" name="is_completed" value="1">
                                        <button type="submit" class="inline-flex items-center justify-center p-1 rounded-lg text-blue-500 hover:bg-gray-100 hover:text-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                                <div class="ml-3">
                                    <span class="block font-medium text-sm text-gray-900">{{ $todo->title }}</span>
                                    <span class="block text-sm text-gray-500">{{ $todo->description }}</span>
                                </div>
                                <div class="ml-auto">
                                    <form
                                        action="{{ route('todos.destroy', ['todo' => $todo->id]) }}"
                                        method="POST"
                                        class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4"
                                    >
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="inline-flex items-center justify-center p-1 rounded-lg text-red-500 hover:bg-gray-100 hover:text-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
