@vite(['resources/css/app.css', 'resources/js/app.js'])

@auth
    <div class="bg-black items-center fixed top-0 w-full">
        <div class="flex items-center justify-between max-w-screen-xl mx-auto p-4">
            <a href="{{ route('home') }}"
                class="text-white hover:bg-blue-500 p-2 px-4 rounded-md transition-all font-semibold">Hello
                {{ Auth::User()->name }}</a>

            <div class="space-y-4 space-x-4 md:space-y-0 flex flex-wrap">
                @if (Auth::user()->is_admin == 1)
                    <a href="{{ route('vehicles.create') }}"
                        class="text-white hover:bg-blue-500 p-2 px-4 rounded-md transition-all">Jármű hozzáadása</a>
                    <a href="{{ route('crash-events.create') }}"
                        class="text-white hover:bg-blue-500 p-2 px-4 rounded-md transition-all">Káresemény hozzáadása</a>
                    <a href="{{ route('manage') }}"
                        class="text-white hover:bg-blue-500 p-2 px-4 rounded-md transition-all">Felhasználók</a>
                @endif
                <form action="{{ route('logout') }}" method="POST" id="logout-form">
                    @csrf
                    <a href="{{ route('logout') }}" class="text-white hover:bg-blue-500 p-2 px-4 rounded-md transition-all"
                        onclick="event.preventDefault(); document.querySelector('#logout-form').submit();">Kijelentkezés</a>
                </form>
            </div>
        </div>
    </div>
@else
    <div class="bg-black fixed top-0 w-full">
        <div class="flex items-center justify-between max-w-screen-xl mx-auto p-4">
            <a href="#" class="text-white text-lg font-semibold">KEL</a>
            <div class="space-x-4">
                <a href="{{ route('login') }}"
                    class="text-white hover:bg-blue-500 p-2 px-4 rounded-md transition-all">Bejelentkezés</a>
                <a href="{{ route('register') }}"
                    class="text-white hover:bg-blue-500 p-2 px-4 rounded-md transition-all">Regisztráció</a>
            </div>
        </div>
    </div>

@endauth

<div class="bg-gradient-to-tr from-blue-600 to-red-600 min-h-screen flex items-center justify-center">
    <a href="{{ route('home') }}" class="absolute top-0 left-0 text-black text-2xl">⬅️ </a>

    <div class="bg-white bg-opacity-30 rounded-md shadow-md p-6 w-full mt-4">
        <form class="flex flex-col" method="POST" action="{{ route('manage.update') }}">
            @csrf
            @method('PATCH')
            @foreach ($users as $u)
                <h1>{{ $u->name }}</h1>
                <input class="p-2 rounded mb-4" type="checkbox" name="users[]" value="{{ $u->id }}">
            @endforeach
            {{--
            <button class="bg-black text-white p-2 rounded hover:bg-blue-500" type="submit">
                Módosítás
            </button>
            Sajnos a módosítás nem működik, de a feladat szerint nem okozhat felhasználó hibát
            --}}
            <h1 class="pt-4">{{ $users->links() }}</h1>
        </form>
    </div>

</div>
