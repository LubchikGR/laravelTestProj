@extends('base.blade.php')
@section('content')

    @if (count($album) > 0)
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-6">
                        <a href="{{ route('newAlbum') }}" class="btn btn-default">
                            <i class="fa fa-plus"></i> Добавити альбом
                        </a>
                    </div>
                </div>
            </div>

            <div class="panel-body">
                <table class="table table-striped task-table">
                    <thead>
                    <th>Альбом - {{ $album->name }}</th>
                    <th>{{ $album->image }}</th>
                    <th>&nbsp;</th>
                    </thead>

                    <!-- Тело таблицы -->
                    <tbody>
                    @foreach ($album as $item)
                        <tr>
                            <!-- Имя задачи -->
                            <td class="table-text">
                                <div>{{ $item->name }}</div>
                            </td>

                            <td class="table-text">
                                <div>{{ $item->image }}</div>
                            </td>

                            <td>
                                <!-- TODO: Кнопка Удалить -->
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
@endsection