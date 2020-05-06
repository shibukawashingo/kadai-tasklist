@extends('layouts.app')

@section('content')

<!-- ここにページ毎のコンテンツを書く -->
@extends('layouts.app')

@section('content')

    <h1タスク一覧</h1>

    @if (count($Tasks) > 0)
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>id</th>
                    <th>タスク</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($Tasks as $Task)
                <tr>
                    <td>{{ $Task->id }}</td>
                    <td>{{ $Task->content }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
      {!! link_to_route('tasks.create', '新規タスクの投稿', [], ['class' => 'btn btn-primary']) !!}


@endsection
@endsection