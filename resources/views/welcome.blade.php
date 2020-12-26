<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{asset('css/app.css')}}" rel="stylesheet">
    <title>پنل مدیریت</title>
</head>
<body>
<div id="app">
    <admin-panel></admin-panel>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="{{asset('js/app.js')}}"></script>
</body>
</html>
