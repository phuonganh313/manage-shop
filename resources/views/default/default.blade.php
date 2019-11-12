<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Settings</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link rel="icon" href="{!! asset('public/img/favicon.png') !!}" type="image/png">
        @yield('css')
    </head>
    <body>
        @yield('content')
        <div class="top-right links">
        <form action="{{ route('switchLang') }}" class="form-lang" method="post">
            <select name="locale" onchange='this.form.submit();'>
                <option value="en">{{ trans('label.lang.en') }}</option>
            </select>
            {{ csrf_field() }}
        </form>
        </div>
        <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jscolor/2.0.4/jscolor.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/favico.js/0.3.10/favico.min.js"></script>

        @if(config('shopify-app.esdk_enabled'))
            <script src="https://cdn.shopify.com/s/assets/external/app.js?{{ date('YmdH') }}"></script>
            <script type="text/javascript">
                ShopifyApp.init({
                    apiKey: '{{ config('shopify-app.api_key') }}',
                    shopOrigin: 'https://{{ ShopifyApp::shop()->shopify_domain }}',
                    debug: false,
                    forceRedirect: true
                });
            </script>

            @include('shopify-app::partials.flash_messages')
        @endif
        @yield('js')
    </body>
</html>
