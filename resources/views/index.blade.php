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
        <div class="flex flex-col bg-white bg-opacity-30 rounded-md shadow-md p-6">
            <h1 class="text-2xl font-bold mb-4">KEL - Üdv a káresemény-lekérdező alkalmazásban. </h1>
            <h2 class="font-bold mb-4"> Az oldal lényege, hogy egyszerűen ellenőrizhesse a tulajdonában lévő
                gépjármű
                kártörténetét. </h2>

            @auth
                <form class="flex" method="GET" action="{{ route('search') }}">

                    <input class="w-full p-2 rounded-l-md " type="text" name="search"
                        placeholder="Keressen egy rendszámra"/>
                    <button class="bg-black text-white p-2 rounded-r-md hover:bg-blue-500" type="submit">
                        Keresés
                    </button>
                </form>

                @if (Session::has('noVehicle'))
                    <div class="bg-red-200 rounded-lg font-bold text-center p-2 mb-2">Nincs ilyen ármű nyilvántartva!
                    </div>
                @endif
                @if (Session::has('notPremium'))
                <div class="bg-red-200 rounded-lg font-bold text-center p-2 mb-2">Csak prémium felhasználóknak elérhető
                    funkció!
                </div>
            @endif
                @if (Session::has('vehicle_added'))
                    <div class="bg-green-200 rounded-lg font-bold text-center p-2 mb-2">Jármű sikeresen hozzáadva</div>
                @endif

                @if (Session::has('vehicle_edited'))
                    <div class="bg-green-200 rounded-lg font-bold text-center p-2 mb-2">Jármű adatai sikeresen
                        szerkesztve</div>
                @endif

                @if (Session::has('notAdmin'))
                    <div class="bg-red-200 rounded-lg font-bold text-center p-2 mb-2">Csak adminisztrátoroknak elérhető
                        funkció!</div>
                @endif
                @if (Session::has('vehicleNotInCrash'))
                    <div class="bg-red-200 rounded-lg font-bold text-center p-2 mb-2">Ehhez a gépjárműhöz nem tartozik
                        káresemény!
                        funkció!</div>
                @endif
                @if (Session::has('deletedCE'))
                    <div class="bg-green-200 rounded-lg font-bold text-center p-2 mb-2">Káresemény sikeresen törölve!
                    </div>
                @endif
                @if (Session::has('crashEventEdited'))
                    <div class="bg-green-200 rounded-lg font-bold text-center p-2 mb-2">Káresemény sikeresen
                        szerkesztve!</div>
                @endif
                @if (Session::has('crashEventAdded'))
                    <div class="bg-green-200 rounded-lg font-bold text-center p-2 mb-2">Káresemény sikeresen hozzáadva!
                    </div>
                @endif
            @else
                <form class="flex" action="{{ redirect()->route('home') }}">

                    <input class="w-full p-2 rounded-l-md " type="text" name="search"
                        placeholder="Keressen egy rendszámra" />
                    <button class="bg-black text-white p-2 rounded-r-md hover:bg-blue-500">
                        Keresés
                    </button>
                </form>
            @endauth
        </div>
    </div>
