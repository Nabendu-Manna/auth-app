<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="{{ route('user.forget-password-send-email') }}" method="post">
        @csrf
        <label for="email">Email</label>
        <input type="email" name="email" id="email">
        <br>
        <button type="submit">Submit</button>
    </form>
</body>
</html>
