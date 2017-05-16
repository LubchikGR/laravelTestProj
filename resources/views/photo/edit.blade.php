@extends('base')
@section('content')
    <div class="panel-body">
        @include('errors.errors')

        <form action="{{ route('photoEdit', array('photo' => $photo->id)) }}"
              method="POST" class="form-horizontal" enctype="multipart/form-data">
            {{ csrf_field() }}

            <div class="form-group">
                <label for="name" class="col-sm-3 control-label">Назва</label>

                <div class="col-sm-6">
                    <input type="text" name="name" id="name" value="{{ $photo->name }}" class="form-control">
                </div>
            </div>

            <div class="form-group">
                <label for="album" class="col-sm-3 control-label">Album</label>

                <div class="col-sm-6">
                    <select name="album_id" id="album" class="form-control">
                        @foreach($albums as $album)
                            <option {{  $photo->album_id == $album->id ? 'selected ' : '' }} value="{{ $album->id }}">{{ $album->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="image" class="col-sm-3 control-label">Фото</label>

                <div class="col-sm-6">
                    <input type="file" name="file" id="image" class="form-control">
                </div>
            </div>

            <div class="form-group artist-photo" style="margin-left: 40%">
                @if( $photo->image != null)
                    <div class="image" style="background-image: url('{{ $photo->image }}')"></div>
                @endif
            </div>

            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-default">
                        <i class="fa fa-plus"></i> Save
                    </button>
                    <a href="{{ url('/') }}" class="btn btn-default">
                        Cancel
                    </a>
                </div>
            </div>
        </form>
    </div>
@endsection