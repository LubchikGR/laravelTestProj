@extends('base.blade.php')

@section('content')
    <div class="panel-body">
        @include('errors.errors')

        <form action="{{ url('edit', array('album' => $album->id)) }}" method="POST" class="form-horizontal">
            {{ csrf_field() }}

            <div class="form-group">
                <label for="name" class="col-sm-3 control-label">Назва</label>

                <div class="col-sm-6">
                    <input type="text" name="name" id="name" value="{{ $album->name }}" class="form-control">
                </div>
            </div>

            <div class="form-group">
                <label for="image" class="col-sm-3 control-label">Фото до альбому</label>

                <div class="col-sm-6">
                    <input type="file" name="image" id="image" class="form-control">
                </div>
                @if( $album->image != null)
                    <div class="image" style="background-image: url('{{ $album->image }}')"></div>
                @endif
            </div>
        </form>
    </div>
@endsection