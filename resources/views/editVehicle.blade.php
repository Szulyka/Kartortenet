@vite(['resources/css/app.css', 'resources/js/app.js'])

<div class="bg-gradient-to-tr from-blue-600 to-red-600 min-h-screen p-6">
    
        <a href="{{ url()->previous() }}" class="absolute top-0 left-0 text-black text-2xl p-4">⬅️ </a>
        
    <div class="flex items-center justify-center p-6 ">
        <div class="bg-white bg-opacity-30 rounded-md shadow-md p-6 w-full">
           
           
            <h1 class="text-2xl font-bold mb-4">Módosítsa járművének adatait:</h1>

            <form class="flex flex-col" method="POST" action="{{route('vehicles.update', $vehicle)}}" enctype="multipart/form-data">
                @csrf 
                @method('PATCH')

                @error('brand')
                <div class="font-medium">Hiba: {{$message}}</div>
                @enderror
                <input class="w-full p-2 rounded mb-4" type="text" name="brand" placeholder="Márka" value="{{old('brand', $vehicle -> brand)}}"/>
                @error('type')
                <div class="font-medium">Hiba: {{$message}}</div>
                @enderror
                <input class="w-full p-2 rounded mb-4" type="text" name="type" placeholder="Típus" value="{{old('type', $vehicle -> type)}}"/>
                @error('year')
                <div class="font-medium">Hiba: {{$message}}</div>
                @enderror
                <input class="w-full p-2 rounded mb-4" type="text" name="year" placeholder="Évjárat" value="{{old('year', $vehicle -> year)}}"/>
                <input class="w-full rounded mb-4" type="file" name="image_file_name" />
        
                <button class="bg-black text-white p-2 rounded hover:bg-blue-500" type="submit">
                    Szerkesztés
                </button>
            </form>
    </div>
</div>