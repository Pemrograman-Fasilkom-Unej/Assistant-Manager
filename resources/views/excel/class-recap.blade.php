<table>
    <thead>
    <tr>
        <th>#</th>
        <th>NIM</th>
        <th>Nama</th>
        @foreach($class->tasks as $task)
            <th>{{ $task->title }}</th>
        @endforeach
        <th>Nilai Akhir</th>
    </tr>
    </thead>
    <tbody>
    @foreach($class->students as $index => $student)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $student->nim }}</td>
            <td>{{ $student->student->name }}</td>
            @foreach($class->tasks as $task)
                @php($score = $task->submissions->where('nim', $student->nim)->first())
                <td>{{ !is_null($score) ? $score->score : 0 }}</td>
            @endforeach
            <td></td>
        </tr>
    @endforeach
    </tbody>
</table>