<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    

@php
    $str =' string';
    $snull = null;
    $arr = [1,2,3,4,5];
    $unles = false
@endphp

@if ($str)
    {{ $str }} is true for if condition
    <br>
@endif

@unless ($unles)
    {{ $unles }} excuate when it's false
@endunless


@for ($i = 0; $i < count($arr); $i++)
<br>    {{ $i }}==>{{ $arr[$i] }} 
@endfor

@foreach ($arr as$key=> $a)
    <br> {{ $key }}===>{{ $a }}
@endforeach

</body>
</html>