<p><a href="/task_statuses/create">CREATE</a></p>
    <h1>Статусы</h1>
    <ul>
    @foreach ($taskStatuses as $status)
        <li>
            {{$status->name}} <a href="{{route('task_statuses.edit', $status)}}">[edit]</a>
        </li>
    @endforeach
    </ul>