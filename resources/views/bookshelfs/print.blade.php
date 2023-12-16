<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>

<table class='table table-bordered'>
    <thead>
    <tr>
        <th>Kode</th>>
        <th>Nama</th>
    </tr>
    </thead>
    <tbody>
    @foreach($bookshelfs as $book)
        <tr>
            <td>{{ $book->code }}</td>
            <td>{{ $book->name }}</td>d>
        </tr>
    @endforeach
    </tbody>
</table>

</body>
