<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="post" action="{{ route('tasks.store') }}" class="space-y-4">
                        @csrf
                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700">Title:</label>
                            <input type="text"
                                class="mt-1 block w-full rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                name="title" style="color: black;" />
                        </div>
                        <div>
                            <label for="description"
                                class="block text-sm font-medium text-gray-700">Description:</label>
                            <textarea class="form-control mt-1 block w-full rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                name="description" style="color: black;"></textarea>
                        </div>
                        <div>
                            <label for="priority" class="block text-sm font-medium text-gray-700">Priority:</label>
                            <select
                                class="form-control mt-1 block w-full rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                style="color: black;" name="priority">
                                <option value="low">Low</option>
                                <option value="medium">Medium</option>
                                <option value="high">High</option>
                            </select>
                        </div>
                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Add
                            task</button>
                    </form>

                    <div class="mt-4">
                        @if ($tasks)
                            @foreach ($tasks as $task)
                                @php
                                    $color = 'white';
                                    if ($task->priority === 'low') {
                                        $color = 'bg-green-100';
                                    }
                                    if ($task->priority === 'medium') {
                                        $color = 'bg-yellow-100';
                                    }
                                    if ($task->priority === 'high') {
                                        $color = 'bg-red-100';
                                    }
                                @endphp


                                <div class="p-6 rounded-md mt-4 {{ $color }}">
                                    <h2 class="font-bold text-gray-700">{{ $task->title }}</h2>
                                    <p class="text-gray-700">{{ $task->description }}</p>

                                    <!-- Update task form -->
                                    <form method="post" action="{{ route('tasks.update', $task) }}" class="mt-2">
                                        @csrf
                                        @method('PUT')
                                        <!-- Include inputs for title, description, and priority here... -->
                                        <button type="submit"
                                            class="text-sm bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded">Update
                                            task</button>
                                    </form>

                                    <!-- Delete task form -->
                                    <form method="post" action="{{ route('tasks.destroy', $task) }}" class="mt-2">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="text-sm bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded">Delete
                                            task</button>
                                    </form>
                                </div>
                            @endforeach
                        @else
                            <p>No tasks found.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
