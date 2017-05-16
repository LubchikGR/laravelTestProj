@extends('base')
@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="form-group">
                <div class="col-sm-offset-1 col-sm-3">
                    Count photo: {{ $album->photoCounter }}
                </div>
                <div class="col-sm-offset-1 col-sm-3">
                    Album name: {{ $album->name }}
                </div>
                <div class="col-sm-offset-1 col-sm-3">
                    <a href="{{ url('/') }}" class="btn btn-default">
                        Return back
                    </a>
                </div>
            </div>
        </div>

        <div class="panel-body" style="margin-top: 30px;">
            <table class="table table-striped task-table">
                <thead>
                <th>Id</th>
                <th>Name</th>
                <th>Photo</th>
                <th>Actions</th>
                </thead>

                <tbody>
                @foreach ($photos as $item)
                    <tr>
                        <td>
                            <div>{{ $item->id }}</div>
                        </td>
                        <td class="table-text">
                            <div>{{ $item->name }}</div>
                        </td>

                        <td class="artist-photo">
                            <div class="image" style="background-image: url('{{ $item->image }}')"></div>
                        </td>

                        <td class="artist-photo">
                            <a href="{{ route('photoShow', ['id' => $item->id]) }}" class="btn btn-default">
                                View photo
                            </a>
                            <a href="{{ route('photoEdit', ['id' => $item->id]) }}" class="btn btn-default">
                                Edit photo
                            </a>
                            <a href="{{ route('photoDelete', ['id' => $item->id]) }}" class="btn btn-default">
                                Delete photo
                            </a>
                        </td>
                    </tr>
                @endforeach

                <tfoot>
                <th>Id</th>
                <th>Name</th>
                <th>Photo</th>
                <th>Actions</th>
                </tfoot>
                </tbody>
            </table>
        </div>
    </div>
@endsection