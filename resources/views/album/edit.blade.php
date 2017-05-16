@extends('base')
@section('content')
    <div class="panel-body">
        @include('errors.errors')

        <form action="{{ route('albumEdit', array('album' => $album->id)) }}"
              method="POST" class="form-horizontal" enctype="multipart/form-data">
            {{ csrf_field() }}

            <div class="form-group">
                <label for="name" class="col-sm-3 control-label">Name</label>

                <div class="col-sm-6">
                    <input type="text" name="name" id="name" value="{{ $album->name }}" class="form-control">
                </div>
            </div>

            <div class="form-group">
                <label for="image" class="col-sm-3 control-label">Photo for album</label>

                <div class="col-sm-6">
                    <input type="file" name="file" id="image" class="form-control">
                </div>
            </div>

            <div class="form-group artist-photo" style="margin-left: 40%">
                @if( $album->image != null)
                    <div class="image" style="background-image: url('{{ $album->image }}');"></div>
                @endif
            </div>
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-default">
                        <i class="fa fa-plus"></i> Save
                    </button>
                    <a href="{{ route('albumShow', ['id' => $album->id]) }}" class="btn btn-default">
                        Show this album
                    </a>
                    <a href="{{ url('/') }}" class="btn btn-default">
                        Cancel
                    </a>
                </div>
            </div>
        </form>
    </div>
@endsection