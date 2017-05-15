@extends('base')
@section('content')
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-6">
                        <a href="{{ route('albumNew') }}" class="btn btn-default">
                            <i class="fa fa-plus"></i> Добавити альбом
                        </a>
                    </div>
                </div>
            </div>

            <div class="panel-body" style="margin-top: 30px;">
                <table class="table table-striped task-table">
                    <thead>
                    <th>Albums</th>
                    <th>Count photo</th>
                    <th>Album photo</th>
                    <th>Actions</th>
                    </thead>

                    <tbody>
                    @foreach ($albums as $item)
                        <tr>
                            <td class="table-text">
                                <div>{{ $item->name }}</div>
                            </td>

                            <td class="table-text">
                                <div>{{ $item->photoCounter }}</div>
                            </td>

                            <td class="artist-photo">
                                <div class="image" style="background-image: url('{{ $item->image }}')"></div>
                            </td>

                            <td class="artist-photo">
                                <a href="{{ route('photoNew') }}" class="btn btn-default">
                                    Add photo
                                </a>
                                <a href="{{ route('albumShow', ['id' => $item->id]) }}" class="btn btn-default">
                                    Show album
                                </a>
                                <a href="{{ route('albumEdit', ['id' => $item->id]) }}" class="btn btn-default">
                                   Edit album
                                </a>
                                <a href="{{ route('albumDelete', ['id' => $item->id]) }}" class="btn btn-default">
                                    Delete album
                                </a>
                            </td>
                        </tr>
                    @endforeach

                    <tfoot>
                    <th>Albums</th>
                    <th>Count photo</th>
                    <th>Album photo</th>
                    <th>Actions</th>
                    </tfoot>
                    </tbody>
                </table>
            </div>
        </div>
@endsection