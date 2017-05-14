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
                    <th>Альбоми</th>
                    </thead>

                    <!-- Тело таблицы -->
                    <tbody>
                    @foreach ($albums as $item)
                        <tr>
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
@endsection