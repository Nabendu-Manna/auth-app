<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    {{-- @dd($user) --}}
    Name {{$user->name}} <br>
    Email {{$user->email}} <br>

    <form action="{{ route('user.logout') }}" method="post">
        @csrf
        <button type="submit">Log Out</button>
    </form>
</body>
</html>
