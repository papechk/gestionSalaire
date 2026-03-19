<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion Salaire</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:700,600" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{asset('css/auth.css')}}">
</head>
<body>

<form method="post" action="{{route('handleLogin')}}">

    @csrf
    @method('POST')

    <div class="box">
        <h1>Dashboard</h1>
        @if(Session::get('error_msg'))
            <div class="error" style="font-size: 12px; color: red;">{{ session('error_msg') }}</div>
        @endif

        <input type="email" name="email" class="email" />

        <input type="password" name="password" class="email" />

        <div class="btn-container">
            <button type="submit"> Login</button>
        </div>

        <!-- End Btn -->
        <!-- End Btn2 -->
    </div>
    <!-- End Box -->
</form>
</body>
</html>
