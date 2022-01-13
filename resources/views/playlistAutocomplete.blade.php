<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Автозаполнение') }}
        </h2>
    </x-slot>

    <form action="{{ route('playlistAutocompleteSubmit') }}" class="max-w-7xl mx-auto sm:px-6 lg:px-8" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group mt-4">
            <label for="artist">Введите исполнителя</label>
            <input class="form-control" type="text" name="artist" placeholder="Исполнитель" id="artist"
                   >
        </div>

        <div class="form-group mt-2">
            <label for="album">Введите название альбома</label>
            <input class="form-control" type="text" name="album" placeholder="Название альбома" id="album"
                   >
        </div>
        <button type="submit" class="btn btn-success mt-2">Сохранить</button>
    </form>
</x-app-layout>