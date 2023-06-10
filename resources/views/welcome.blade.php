<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta http-equiv="x-ua-compatible" content="ie=edge"/>
    <title>Material Design for Bootstrap</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css"/>
    <!-- Google Fonts Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap"/>
    <!-- MDB -->
    <link rel="stylesheet" href="{{asset('css/mdb.min.css')}}"/>
    <!-- Custom styles -->
    <link rel="stylesheet" href="{{asset('css/style.css')}}"/>
</head>
<body>
<!--Main Navigation-->
<header>
    @include('layouts.jumbotron')
</header>
@include('layouts.intro')
@include('components.category')

@include('layouts.new_product')

<!-- Features -->
@include('components.feature')
<!-- Features -->

@include('layouts.recommended_product')

<!-- Footer -->
@include('layouts.footer')
<!-- Footer -->

<!-- MDB -->
<script type="text/javascript" src="{{asset('js/mdb.min.js')}}"></script>
</body>
</html>