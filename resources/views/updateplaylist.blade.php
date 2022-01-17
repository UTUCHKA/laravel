<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Редактирование альбома') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 pt-4">
        <img style="width: 500px; object-fit: cover;" src="{{ $data->img ?? 'https://tipsmake.com/data1/thumbs/how-to-extract-img-files-in-windows-10-thumb-bzxI4IDgg.jpg' }}" alt="preview">
    </div>

<form action="{{ route('updatesubmit', $data->id) }}" class="max-w-7xl mx-auto sm:px-6 lg:px-8" method="POST" enctype="multipart/form-data">
        @csrf
            <div class="form-group mt-5">
                <label for="img">Выберите изображение для обложки</label>
                <input class="form-control" type="text" name="img" id="img" value="{{ $data->img ?? old('img') ?? '' }}">
            </div>

        <div class="form-group mt-2">
            <label for="artist">Введите исполнителя</label>
            <input class="form-control" type="text" name="artist" placeholder="Исполнитель" id="artist" value="{{ $data->artist ?? old('artist') ?? '' }}">
        </div>

        <div class="form-group mt-2">
            <label for="album">Введите название альбома</label>
            <input class="form-control" type="text" name="album" placeholder="Название альбома" id="album" value="{{ $data->album ?? old('album') ?? '' }}">
        </div>
        <div class="form-group mt-2">
            <label for="info">Введите информацию об альбоме</label>
            <textarea class="form-control" rows="6" name="info" id="info" placeholder="введите информацию">{{ $data->info ?? old('info') ?? '' }}</textarea>
        </div>
        <button type="submit" class="btn btn-success mt-2">Сохранить</button>
    </form>
</x-app-layout>