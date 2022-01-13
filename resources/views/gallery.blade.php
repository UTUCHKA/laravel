<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Галерея') }}
        </h2>
    </x-slot>

    <div class="album py-5 bg-secondary">
        <div class="container">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                <div class="col">
                                <div class="card shadow-sm">
                                    <a href="{{ route('playlistcreate') }}"><svg class="bd-placeholder-img card-img-top" width="100%" height="376" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#FFA500"></rect><text x="47%" y="50%" fill="black" dy=".3em" font-size="60" font-weight="bold" >+</text></svg></a>
                                </div>
                </div>
            </div>
        </div>
    </div>

    <div class="album py-5 bg-light">
        <div class="container">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
            @foreach ($playlists as $data)
                @include('inc.playlist')
            @endforeach
            </div>
        </div>
    </div>
    {{ $playlists->links() }}
</x-app-layout>
