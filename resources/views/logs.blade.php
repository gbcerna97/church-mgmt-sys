<!DOCTYPE html>
<html>
<head>
    <title>Logs</title>
</head>
<body>
    <h1>Logs</h1>

    @foreach ($logs as $log)
        <p>{{ $log }}</p>
    @endforeach
</body>
</html>
