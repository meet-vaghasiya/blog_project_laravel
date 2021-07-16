<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laravel</title>
</head>
<body>

    {{ __('messages.welcome') }}
<br>
    @lang('messages.welcome')

    {{ __('messages.variable',['name'=>'meet']) }}<br>

    {{ trans_choice('messages.plurals',0) }}<br>
    {{ trans_choice('messages.plurals',1) }}<br>
   {{ trans_choice('messages.plurals',2) }}<br>
    {{ trans_choice('messages.plurals',3,['count'=>'count variavle']) }}<br>
    {{ trans_choice('messages.plurals',4) }}

{{--  from json file   --}}
<p>this is in json format</p>
{{ __('welcome-json') }}
{{ __('hello',['name'=>'meet']) }}
    
<h1>
    hello world
</h1>
    
</body>
</html>