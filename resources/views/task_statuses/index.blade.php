@auth
    <p><a href="/task_statuses/create">CREATE</a></p>
@endauth
    <h1>Статусы</h1>
    <ul>
    @foreach ($taskStatuses as $status)
        <li>
            {{$status->name}} 
            @auth
                <a href="{{route('task_statuses.edit', $status)}}">[edit]</a>
            @endauth
        </li>
    @endforeach
    </ul>