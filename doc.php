<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="favicon.png" type="image/png">
    <title>Документация</title>
</head>
<body>

<h2>Подключение css, js, favicon:</h2>
Пути до скриптов прописывать в ~app/assets/Asset.php
Папка для храниния ресурсов  ~app/assets

Вызов функций в местах подключения скриптов
<p>css:</p>
&lt;php? \Component\AssetsBasic::getCss() ?&gt;
<p>js:</p>
&lt;php? \Component\AssetsBasic::getJs() ?&gt;
<p>favicon:</p>
&lt;php? \Component\AssetsBasic::getFavicon() ?&gt;

<hr>
</body>
</html>