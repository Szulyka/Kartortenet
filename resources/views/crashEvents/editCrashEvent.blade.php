@vite(['resources/css/app.css', 'resources/js/app.js'])

<div class="bg-gradient-to-tr from-blue-600 to-red-600 min-h-screen p-6">
    
    <a href="{{ url()->previous() }}" class="absolute top-0 left-0 text-black text-2xl p-4">⬅️ </a>
        
   
    <div class="flex items-center justify-center p-6 ">
        <div class="bg-white bg-opacity-30 rounded-md shadow-md p-6 w-full">
           
           
            <h1 class="text-2xl font-bold mb-4">Szerkessze káreseményt:</h1>

            <form class="flex flex-col" method="POST" action="{{route('crash-events.update', $crashEvent)}}" enctype="multipart/form-data">
                @csrf 
                @method('PATCH')
                @error('place')
                <div class="font-medium">Hiba: {{$message}}</div>
                @enderror

                <div class="relative">
                <input class="w-full p-2 rounded mb-4" type="text" name="place" placeholder="Helyszín" value="{{old('place', $crashEvent->place)}}"/>
                </div>
                @error('date')
                <div class="font-medium">Hiba: {{$message}}</div>
                @enderror
                <input class="w-full p-2 rounded mb-4" type="date" name="date" placeholder="Dátum" value="{{old('date', $crashEvent->date)}}"/>
                @error('description')
                <div class="font-medium">Hiba: {{$message}}</div>
                @enderror
                <input class="w-full p-2 rounded mb-4" type="text" name="description" placeholder="Leírás (opcionális)" value="{{old('description', $crashEvent->description)}}"/>
                
                
                @error('cars')
                <div class="font-medium">Hiba: {{$message}}</div>
                @enderror
                @foreach ($vehicles as $v)
                    {{$v->license_plate}}
                                                                    {{-- @checked(old('cars', $v->id)) --}}
                    <input class="p-2 rounded mb-4" type="checkbox" name="cars[]" value="{{$v->id}}"> 
                @endforeach

                <button class="bg-black text-white p-2 rounded hover:bg-blue-500" type="submit">
                    Szerkesztés
                </button>
            </form>
    </div>
</div>
</div>