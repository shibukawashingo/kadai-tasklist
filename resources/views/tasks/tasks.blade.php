<ul class="list-unstyled">
    @foreach ($tasks as $task)
        <li class="media mb-3">
            <img class="mr-2 rounded" src="{{ Gravatar::src($task->user->email, 50) }}" alt="">
            <div class="media-body">
                
                <div>
                    <p class="mb-0">{!! nl2br(e($task->content)) !!}</p>
                </div>
                 @if (Auth::id() == $task->user_id)
                        {!! link_to_route('tasks.edit', 'このメッセージを編集', ['id' => $task->id], ['class' => 'btn btn-light']) !!}
                        {!! Form::open(['route' => ['tasks.destroy', $task->id], 'method' => 'delete']) !!}
                            {!! Form::submit('削除', ['class' => 'btn btn-danger btn-sm']) !!}
                        {!! Form::close() !!}
                @endif
            </div>
        </li>s
    @endforeach
</ul>
{{ $tasks->links('pagination::bootstrap-4') }}