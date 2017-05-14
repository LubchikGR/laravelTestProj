@extends('base')
@section('content')
    <div class="panel-body">

    @include('errors.errors')

        <form action="{{ route('albumNew') }}" method="POST" class="form-horizontal" enctype="multipart/form-data">
        {{ csrf_field() }}

            <div class="form-group">
                <label for="album-name" class="col-sm-3 control-label">Name</label>

                <div class="col-sm-6">
                    <input type="text" name="name" id="album-name" class="form-control">
                </div>
            </div>

            <div class="form-group">
                <label for="album-photo-link" class="col-sm-3 control-label">Link photo</label>

                <div class="col-sm-6">
                    <input type="text" name="photoLink" id="album-photo-link" class="form-control">
                </div>
            </div>

            <div class="form-group">
                <label for="image" class="col-sm-3 control-label">Photo file</label>

                <div class="col-sm-6">
                    <input type="file" name="file" id="image" class="form-control">
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-default">
                        <i class="fa fa-plus"></i> Save
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection