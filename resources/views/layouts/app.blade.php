@php if(!isset($view)){ $view = '404'; } @endphp
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>{!! __($view.'.title') !== NULL ? __($view.'.title').' | '.__('global.site-name') : __('global.site-name') !!}</title>

    <!-- CSRF Stuff -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script>
        window.Laravel = {
            csrfToken: '{{ csrf_token() }}'
        }
    </script>

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
</head>

<body id="body">
    @component( 'components/header', [ 'page' => $view, ]) @endcomponent
    <div id="app">
        <main>
            @yield('content')
        </main>
    </div>
    @component('components/footer') @endcomponent

    <!--build:js js/main.min.js -->
    <script src="{{ mix('js/app.js') }}"></script>
    @yield('scripts')
</body>

</html>
