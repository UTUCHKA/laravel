<div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach($errors -> all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif               

                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('notFound'))
                        <div class="alert alert-danger">
                            {{ session('notFound') }}
                        </div>
                    @endif

        </div>
    </div>