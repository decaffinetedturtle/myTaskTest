<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


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
                            <label for="title" class="block text-sm font-medium text-gray-700"
                                style="color: whitesmoke">Title:</label>
                            <input type="text"
                                class="mt-1 block w-full rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                name="title" style="color: black;" />
                        </div>
                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700"
                                style="color: whitesmoke">Description:</label>
                            <textarea class="form-control mt-1 block w-full rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                name="description" style="color: black;"></textarea>
                        </div>
                        <div>
                            <label for="priority" class="block text-sm font-medium text-gray-700"
                                style="color: whitesmoke">Priority:</label>
                            <select
                                class="form-control mt-1 block w-full rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                style="color: black;" name="priority">
                                <option value="low">Low</option>
                                <option value="medium">Medium</option>
                                <option value="high">High</option>
                            </select>
                        </div>
                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm
                            font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2
                            focus:ring-offset-2 focus:ring-indigo-500">
                            Add task</button>
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
                                    <a href="#" class="font-bold text-gray-700 task-toggle"
                                        style="cursor: pointer;">{{ $task->title }}</a>
                                    <p class="text-gray-700">{{ $task->description }}</p>


                                    <!-- Update task form -->
                                    <div class="task-form" style="display: none;">

                                        <form method="post" action="{{ route('tasks.update', $task) }}" class="mt-2">
                                            @csrf
                                            @method('PUT')
                                            <div class="my-2">
                                                <label for="title"
                                                    class="block text-sm font-medium text-gray-900">Title:</label>
                                                <input type="text" name="title" value="{{ $task->title }}"
                                                    class="mt-1 block w-full rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                                    style="color: black;" />
                                            </div>
                                            <div class="my-2">
                                                <label for="description"
                                                    class="block text-sm font-medium text-gray-900">Description:</label>
                                                <textarea name="description"
                                                    class="form-control mt-1 block w-full rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                                    style="color: black;">{{ $task->description }}</textarea>
                                            </div>
                                            <div class="my-2">
                                                <label for="priority"
                                                    class="block text-sm font-medium text-gray-900">Priority:</label>
                                                <select name="priority"
                                                    class="form-control mt-1 block w-full rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                                    style="color: black;">
                                                    <option value="low"
                                                        {{ $task->priority == 'low' ? 'selected' : '' }}>
                                                        Low</option>
                                                    <option value="medium"
                                                        {{ $task->priority == 'medium' ? 'selected' : '' }}>Medium
                                                    </option>
                                                    <option value="high"
                                                        {{ $task->priority == 'high' ? 'selected' : '' }}>High</option>
                                                </select>
                                            </div>
                                            <button type="submit"
                                                class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-black bg-blue-500 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">Update
                                                task</button>
                                        </form>
                                    </div>


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


<style>
    .task-toggle {
        position: relative;
        transition: color 0.3s ease;
    }

    .task-toggle::after {
        content: "";
        position: absolute;
        width: 0;
        height: 2px;
        bottom: 0;
        left: 0;
        background-color: blue;
        visibility: hidden;
        transition: all 0.3s ease-in-out;
    }

    .task-toggle:hover {
        color: blue;
    }

    .task-toggle:hover::after {
        visibility: visible;
        width: 100%;
    }
</style>

<script>
    $(document).ready(function() {
        $('.task-toggle').click(function(e) {
            e.preventDefault();
            $(this).siblings('.task-form').toggle();
        });
    });
</script>
