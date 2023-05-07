<!doctype html>
<html data-theme="light" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }}</title>
    <!-- Scripts -->
    @vite('resources/js/app.js')
    <!-- Styles -->
    @vite('resources/css/app.css')
</head>
<body>
    {{-- Vueコンポーネントを使用する場合 --}}
    {{-- <div id="app"></div>--}}
    <div>
        <h1>CSVアップロード機能</h1>
    </div>
    <div>
        <form action="{{route('csv.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="file" name="csv.file">
            <button type="submit">登録</button>
        </form>
    </div>
</body>
</html>
