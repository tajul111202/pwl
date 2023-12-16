<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>

<table class='table table-bordered'>
    <thead>
    <tr>
        <th>Judul</th>
        <th>Penulis</th>
        <th>Tahun Terbit</th>
        <th>Penerbit</th>
        <th>Kota Terbit</th>
        <th>Sampul</th>
        <th>Rak</th>
    </tr>
    </thead>
    <tbody>
    @foreach($books as $book)
        <tr>
            <td>{{ $book->title }}</td>
            <td>{{ $book->author }}</td>
            <td>{{ $book->year }}</td>
            <td>{{ $book->publisher }}</td>
            <td>{{ $book->city }}</td>
            <td><img src="{{$book->cover}}" width="100" height="auto" alt=""></td>
            <td>{{ $book->Bookshelfs->name }}</td>
        </tr>
    @endforeach
    </tbody>
</table>

</body>
