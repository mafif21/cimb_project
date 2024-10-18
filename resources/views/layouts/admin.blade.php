<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? config('app.name') }}</title>
    {{ $additional ?? '' }}

    <style>
        canvas {
            border: 1px solid black;
        }
    </style>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@200;400;600;800&display=swap">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="flex-col w-full md:flex md:flex-row md:min-h-screen">
        <div @click.away="open = false"
            class="flex flex-col flex-shrink-0 w-full text-gray-700 bg-slate-50 md:w-64 lg:py-8"
            x-data="{ open: false }">
            <div class="flex flex-row items-center justify-between flex-shrink-0 px-8 py-4">
                <a href="/admin"
                    class="text-lg font-semibold tracking-widest text-gray-900 uppercase rounded-lg focus:outline-none focus:shadow-outline">Hi
                    {{ auth()->user()->name }}</a>
                <button class="rounded-lg md:hidden focus:outline-none focus:shadow-outline" @click="open = !open">
                    <svg fill="currentColor" viewBox="0 0 20 20" class="w-6 h-6">
                        <path x-show="!open" fill-rule="evenodd"
                            d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM9 15a1 1 0 011-1h6a1 1 0 110 2h-6a1 1 0 01-1-1z"
                            clip-rule="evenodd"></path>
                        <path x-show="open" fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>
            <nav :class="{ 'block': open, 'hidden': !open }"
                class="flex-grow px-4 pb-4 md:block md:pb-0 md:overflow-y-auto">
                <x-admin-nav-link :href="route('admin.index')" :active="request()->routeIs('admin.index')">
                    {{ __('Dashboard') }}
                </x-admin-nav-link>
                <x-admin-nav-link :href="route('admin.branch.index')" :active="request()->routeIs('admin.branch**')">
                    {{ __('Branch') }}
                </x-admin-nav-link>
                <x-admin-nav-link :href="route('admin.wibs.index')" :active="request()->routeIs('admin.wibs**')">
                    {{ __('WIBS') }}
                </x-admin-nav-link>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-admin-nav-link :href="route('logout')"
                        onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Logout') }}
                    </x-admin-nav-link>
                </form>

            </nav>
        </div>

        <main class="m-2 p-8 w-full">
            <x-container>
                <div class="mb-5">
                    @if (session()->has('success'))
                        <x-success-alert statusText="{{ session()->get('success') }}"></x-success-alert>
                    @endif
                    @if (session()->has('primary'))
                        <x-primary-alert statusText="{{ session()->get('primary') }}"></x-primary-alert>
                    @endif
                    @if (session()->has('danger'))
                        <x-danger-alert statusText="{{ session()->get('danger') }}"></x-danger-alert>
                    @endif
                </div>
                <div>
                    {{ $slot }}
                </div>
            </x-container>
        </main>
    </div>

    <script src="https://unpkg.com/flowbite@1.5.5/dist/flowbite.js"></script>
    <!-- <script src="{{ asset('js/app.js') }}"></script> -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/2.1.8/css/dataTables.tailwindcss.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/2.1.8/js/dataTables.tailwindcss.js">
    </script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>
    <script>
        var canvas = document.getElementById("game");
        var context = canvas.getContext("2d");

        var grid = 16;
        var count = 0;

        var snake = {
            x: 160,
            y: 160,
            dx: grid,
            dy: 0,
            cells: [],
            maxCells: 4,
        };
        var apple = {
            x: 320,
            y: 320,
        };

        function getRandomInt(min, max) {
            return Math.floor(Math.random() * (max - min)) + min;
        }

        function loop() {
            requestAnimationFrame(loop);

            if (++count < 4) {
                return;
            }

            count = 0;
            context.clearRect(0, 0, canvas.width, canvas.height);

            snake.x += snake.dx;
            snake.y += snake.dy;

            if (snake.x < 0) {
                snake.x = canvas.width - grid;
            } else if (snake.x >= canvas.width) {
                snake.x = 0;
            }

            if (snake.y < 0) {
                snake.y = canvas.height - grid;
            } else if (snake.y >= canvas.height) {
                snake.y = 0;
            }

            snake.cells.unshift({
                x: snake.x,
                y: snake.y
            });

            if (snake.cells.length > snake.maxCells) {
                snake.cells.pop();
            }

            context.fillStyle = "red";
            context.fillRect(apple.x, apple.y, grid - 1, grid - 1);
            context.fillStyle = "green";
            snake.cells.forEach(function(cell, index) {
                context.fillRect(cell.x, cell.y, grid - 1, grid - 1);

                if (cell.x === apple.x && cell.y === apple.y) {
                    snake.maxCells++;
                    apple.x = getRandomInt(0, 25) * grid;
                    apple.y = getRandomInt(0, 25) * grid;
                }

                for (var i = index + 1; i < snake.cells.length; i++) {
                    // snake occupies same space as a body part. reset game
                    if (cell.x === snake.cells[i].x && cell.y === snake.cells[i].y) {
                        snake.x = 160;
                        snake.y = 160;
                        snake.cells = [];
                        snake.maxCells = 4;
                        snake.dx = grid;
                        snake.dy = 0;

                        apple.x = getRandomInt(0, 25) * grid;
                        apple.y = getRandomInt(0, 25) * grid;
                    }
                }
            });
        }

        document.addEventListener("keydown", function(e) {
            if (e.which === 37 && snake.dx === 0) {
                snake.dx = -grid;
                snake.dy = 0;
            } else if (e.which === 38 && snake.dy === 0) {
                snake.dy = -grid;
                snake.dx = 0;
            } else if (e.which === 39 && snake.dx === 0) {
                snake.dx = grid;
                snake.dy = 0;
            } else if (e.which === 40 && snake.dy === 0) {
                snake.dy = grid;
                snake.dx = 0;
            }
        });

        requestAnimationFrame(loop);
    </script>
    {{ $scripts ?? '' }}


</body>

</html>
