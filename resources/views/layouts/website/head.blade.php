<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>{{ isset($meta_title) ? $meta_title : 'MENU' }}</title>
{{--  <title>Snack Box Merchant</title>  --}}
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

<link rel="stylesheet" href="{{ asset('template/base-website/assets/css/style.css') }}">

<link rel="shortcut icon" href="{{asset('assets/pipper/logo-circle.png')}}" />

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<link rel="stylesheet" href="{{asset('asset/css/style.css')}}">


<meta name="csrf-token" content="{{ csrf_token() }}">

@yield('head')
