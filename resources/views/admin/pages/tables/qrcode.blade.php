<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>QrCode</title>
</head>
<body>
<div style="text-align: center" class="visible-print text-center">
    {!! QrCode::size(300)->generate($url); !!}
</div>
</body>
</html>


