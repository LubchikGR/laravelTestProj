@extends('base')
@section('content')
    <div class="panel-body">
        @include('errors.errors')

        <form action="{{ route('photoNew') }}" method="POST" class="form-horizontal" enctype="multipart/form-data">
            {{ csrf_field() }}

            <div class="form-group">
                <label for="name" class="col-sm-3 control-label">Name photo</label>

                <div class="col-sm-6">
                    <input type="text" name="name" id="name" class="form-control">
                </div>
            </div>

            <div class="form-group">
                <label for="album" class="col-sm-3 control-label">Album</label>

                <div class="col-sm-6">
                    <select name="album_id" id="album" class="form-control">
                        @foreach($albums as $album)
                            <option value="{{ $album->id }}">{{ $album->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="image" class="col-sm-3 control-label">Photo</label>

                <div class="col-sm-6">
                    <input type="file" name="image" id="image" class="form-control">
                </div>
            </div>
        </form>
    </div>
@endsection