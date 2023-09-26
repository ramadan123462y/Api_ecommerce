<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dbugger</title>
</head>

<body>
    <table>
        <thead>
            <tr>
                <td>id</td>
                <td>name</td>
                <td>name</td>
                <td>name</td>
                <td>name</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>

                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->stock }}</td>
                    <td>{{$product->categorie->count()}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
