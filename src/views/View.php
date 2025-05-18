<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1">
    <title>MVC Template</title>

    <link rel="stylesheet" href="/styles/Style.css">
</head>
<body>
    <header>
        <h1>MVC Template</h1>
        <a href="/"><b>Home page</b></a>
        <a href="/template"><b>Template page</b></a>            
    </header>
    <main>
        <!-- Your page's view content will be injected here -->
        <?= $content;?>
    </main>
    <footer>
        <a href="https://github.com/Gersigno/MVC-Template/tree/main">Source code</a>
        <a href="https://github.com/Gersigno">Made by Gersigno</a>
        <a href="https://github.com/Gersigno/MVC-Template/issues">Issue</a>
    </footer>
</body>
</html>