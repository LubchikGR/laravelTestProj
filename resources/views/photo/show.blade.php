@extends('base')
@section('content')
    <div class="panel panel-default">
        <div class="panel-body" style="margin-top: 30px;">
            <table class="table table-striped task-table">
                <thead>
                <th>Photo name</th>
                <th>Photo image</th>
                <th>Photo created</th>
                <th>Album name</th>
                <th>Actions</th>
                </thead>
                <tbody>
                    <tr>
                        <td class="table-text">
                            <div>{{ $photo->name }}</div>
                        </td>

                        <td class="artist-photo">
                            <div class="image" style="background-image: url('{{ $photo->image }}')"></div>
                        </td>

                        <td class="table-text">
                            <div>{{ $photo->created_at }}</div>
                        </td>

                        <td class="table-text">
                            <div>{{ \fileSaver\Entity\Album::find($photo->album_id)->name }}</div>
                        </td>

                        <td class="artist-photo">
                            <a href="{{ route('albumShow', ['id' => $photo->id]) }}" class="btn btn-default">
                                Show album
                            </a>
                            <a href="{{ route('photoEdit', ['id' => $item->id]) }}" class="btn btn-default">
                                Edit photo
                            </a>
                            <a href="{{ route('photoDelete', ['id' => $photo->id]) }}" class="btn btn-default">
                                Delete Photo
                            </a>
                        </td>
                    </tr>
                <tfoot>
                <th>Photo name</th>
                <th>Photo image</th>
                <th>Photo created</th>
                <th>Album name</th>
                <th>Actions</th>
                </tfoot>
                </tbody>
            </table>
        </div>
    </div>
@endsection