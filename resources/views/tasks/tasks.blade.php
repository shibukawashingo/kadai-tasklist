<ul class="list-unstyled">
    @foreach ($microposts as $micropost)
        <li class="media mb-3">
            <img class="mr-2 rounded" src="{{ Gravatar::src($micropost->user->email, 50) }}" alt="">
            <div class="media-body">
                <div>
                    {!! link_to_route('users.show', $task->user->name, ['id' => $task->user->id]) !!} <span class="text-muted">posted at {{ $task->created_at }}</span>
                </div>
                <div>
                    <p class="mb-0">{!! nl2br(e($task->content)) !!}</p>
                </div>
                 @if (Auth::id() == $task->user_id)
                        {!! Form::open(['route' => ['tasks.edit', $task->id], 'method' => 'edit']) !!}
                            {!! Form::submit('編集', ['class' => 'btn btn-info btn-sm']) !!}
                        {!! Form::close() !!}
                        {!! Form::open(['route' => ['tasks.destroy', $task->id], 'method' => 'delete']) !!}
                            {!! Form::submit('削除', ['class' => 'btn btn-danger btn-sm']) !!}
                        {!! Form::close() !!}
                @endif
            </div>
        </li>s
    @endforeach
</ul>
{{ $microposts->links('pagination::bootstrap-4') }}