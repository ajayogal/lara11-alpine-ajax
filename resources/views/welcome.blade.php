<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Apline Ajax Demo</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased dark:bg-black dark:text-white/50">
        <div class="bg-gray-50 text-black/50 dark:bg-black dark:text-white/50">
            <div class="relative min-h-screen flex flex-col items-center justify-center selection:bg-[#FF2D20] selection:text-white">
                <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">
                    <header class="grid grid-cols-2 items-center gap-2 py-10 lg:grid-cols-3">

                        @if (Route::has('login'))
                            <nav class="-mx-3 flex flex-1 justify-end">
                                @auth
                                    <a
                                        href="{{ url('/dashboard') }}"
                                        class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                                    >
                                        Dashboard
                                    </a>
                                @else
                                    <a
                                        href="{{ route('login') }}"
                                        class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                                    >
                                        Log in
                                    </a>

                                    @if (Route::has('register'))
                                        <a
                                            href="{{ route('register') }}"
                                            class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                                        >
                                            Register
                                        </a>
                                    @endif
                                @endauth
                            </nav>
                        @endif
                    </header>

                    <main class="mt-6">
                        <div class="relative isolate overflow-hidden bg-white py-16 sm:py-24 lg:py-32">
                            <div class="mx-auto max-w-7xl px-6 lg:px-8">
                                <div class="mx-auto grid max-w-2xl grid-cols-1 gap-x-8 gap-y-16 lg:max-w-none lg:grid-cols-2">
                                    <div class="max-w-xl lg:max-w-lg">
                                        <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Create Todo</h2>
                                        <form
                                            action="/todo"
                                            method="post"
                                            x-init
                                            x-ajax
                                            x-target="mytodos"
                                            @ajax:success="console.log('Ajax complete!');  todo_title.value = ''"
                                        >
                                            @csrf
                                            <div class="mt-6 flex max-w-md gap-x-4">
                                                <label for="titleid" class="sr-only">Create Todo</label>
                                                <input
                                                    id="todo_title"
                                                    name="todo_title"
                                                    type="text"
                                                    value=""
                                                    required
                                                    class="min-w-0 flex-auto rounded-md border-0 bg-white/5 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-black/10 focus:ring-2 focus:ring-inset focus:ring-indigo-500 sm:text-sm sm:leading-6"
                                                    placeholder="Enter Todo"
                                                    x-autofocus
                                                />
                                                <button type="submit" class="flex-none rounded-md bg-indigo-500 px-3.5 py-2.5 text-sm font-semibold text-gray-100 shadow-sm hover:bg-indigo-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">Add</button>
                                            </div>
                                        </form>
                                    </div>
                                    <dl class="grid grid-cols-1 gap-x-8 gap-y-10  lg:pt-2">
                                        <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Todos</h2>
                                        <ul id="mytodos" role="list" class="divide-y divide-gray-100">
                                            @foreach ($todos as $todo)
                                                <li class="flex justify-between gap-x-2 py-2 sm:grid-cols-2">
                                                    <div class="text-sm font-semibold leading-6 text-gray-900">{{ $todo->title }}</div>
                                                    <div class="mt-1 text-xs leading-5 text-gray-500 ">
                                                        <form
                                                            action="/todo/{{ $todo->id }}"
                                                            method="post"
                                                            x-init
                                                            x-target="mytodos"
                                                            @ajax:before="confirm('Are you sure?') || $event.preventDefault()"
                                                        >
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="flex-none rounded-md bg-indigo-500 px-1.5 py-1 text-xs font-semibold text-white shadow-sm hover:bg-indigo-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">Delete</button>
                                                        </form>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </dl>
                                </div>
                            </div>
                        </div>
                    </main>

                    <footer class="py-16 text-center text-sm text-black dark:text-white/70">
                        Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
                    </footer>
                </div>
            </div>
        </div>
    </body>
</html>
