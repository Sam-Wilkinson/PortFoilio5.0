<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <title>W3.CSS Template</title>  
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <style>
            body, h1,h2,h3,h4,h5,h6 {font-family: "Montserrat", sans-serif}
            .w3-row-padding img {margin-bottom: 12px}
            /* Set the width of the sidebar to 120px */
            .w3-sidebar {width: 120px;background: #222;}
            /* Add a left margin to the "page content" that matches the width of the sidebar (120px) */
            #main {margin-left: 120px}
            /* Remove margins from "page content" on small screens */
            @media only screen and (max-width: 600px) {#main {margin-left: 0}}
        </style>
    </head>
<body class="w3-black">
<div>

  @include('layout.SideBar')

  @yield('content')

  @include('layout.Footer')

</div>

</body>
</html>