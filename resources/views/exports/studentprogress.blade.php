<table>
    <thead>
      <tr>
        <th>Student Number</th>
        <th>First Name</th>
        <th>Surname</th>
        @foreach($tasks as $task)
          <th>{{ $task->name }}</th>
        @endforeach
      </tr>
    </thead>
    <tbody>
      @foreach($studentProgress as $progress)
          <tr>
              <td>{{ $progress->identifier }}</td>
              <td>{{ $progress->firstname }}</td>
              <td>{{ $progress->surname }}</td>
              @foreach($tasks as $task)
                <td>{{ $progress->{$task->name} }}</td>
              @endforeach
          </tr>
      @endforeach
    </tbody>
</table>
