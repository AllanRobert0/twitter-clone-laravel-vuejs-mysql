<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Twitter Clone Feed</title>
    </head>
    <body>
        <div id="app">
            <div class="container">
                <feed></feed>
            </div>
        </div>        
    </body>    
    <script src="{{ asset('js/app.js') }}"></script>
</html>
