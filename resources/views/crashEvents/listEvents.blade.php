@vite(['resources/css/app.css', 'resources/js/app.js'])

@auth
    <div class="bg-black items-center fixed top-0 w-full">
        <a href="{{ url()->previous() }}" class="absolute top-0 left-0 text-black text-2xl p-4">⬅️ </a>
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

    <form action="{{ route('crash-events.destroy', $crashEvent) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="text-2xl p-4">🚮</button>
    </form>

    <div class="flex flex-col bg-white bg-opacity-30 items-center rounded-md shadow-md p-6 mt-16">
        @auth
            <a class="hover:underline mb-2 text-xl font-bold"
                href="{{ route('crash-events.edit', $crashEvent) }}">Káresemény módosítása</a>

            @foreach ($vehicles as $v)
                <div class="my-4 border-t border-black w-full"></div>
                <a class="hover:underline mb-2 font-bold"
                    href="{{ route('vehicles.edit', $v) }}">{{ $v->license_plate }}</a>
                @if (!($v->image_file_name === null))
                    <img class="rounded w-100 h-72 object-cover mb-4 shadow-md"
                        src="{{ Storage::url('images/' . $v->image_file_name) }}">
                @else
                    🚫📷
                @endif
            @endforeach
        @endauth
    </div>
</div>
