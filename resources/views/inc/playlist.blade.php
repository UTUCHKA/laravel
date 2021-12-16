<div class="col">
            <div class="card shadow-sm">
                <a href="{{ route('showplaylist',  $data->id) }}"><img class="bd-placeholder-img card-img-top" src="{{ $data->img ?? '' }}" alt="picture" width="100%" height="225" focusable="false"></a>

                <div class="card-body">
                    <p class="card-text">{{ $data->album ?? '' }}</p>
                    <p class="card-text">{{ $data->artist ?? '' }}</p>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="btn-group">
                            <a href="{{ route('showplaylist',  $data->id) }}"><button type="button"  class="btn btn-sm btn-outline-secondary">View</button></a>
                            <a href="{{ route('updateplaylist',  $data->id) }}"><button type="button" class="btn btn-sm btn-outline-secondary">Edit</button></a>
                            <a href="{{ route('deleteplaylist',  $data->id) }}"><button type="button" class="btn btn-sm btn-warning btn-outline-secondary">Delete</button></a>
                        </div>
                        <small class="text-muted">{{ $data->updated_at ?? '' }}</small>
                    </div>
                </div>
            </div>
        </div>