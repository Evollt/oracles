<!-- Required meta tags -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
<!-- FAVICON -->
<link rel="apple-touch-icon" sizes="180x180" href="{{ URL::asset('images/logo.png') }}">
<link rel="icon" type="image/png" sizes="32x32" href="{{ URL::asset('images/logo.png') }}">
<link rel="icon" type="image/png" sizes="16x16" href="{{ URL::asset('images/logo.png') }}">
<link rel="manifest" href="{{ URL::asset('favicon/site.webmanifest') }}">
<meta name="msapplication-TileColor" content="#2b5797">
<meta name="theme-color" content="#ffffff">
{!! SEOMeta::generate() !!}
<meta name="csrf-token" content="{{ csrf_token() }}">
<link href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet"/>
<link href="{{ mix('backend/css/app.css') }}" type="text/css" rel="stylesheet"/>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
{{-- <script src="https://kit.fontawesome.com/73fa916b72.js" crossorigin="anonymous"></script> --}}
@stack('head')
