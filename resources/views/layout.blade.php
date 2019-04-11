<!doctype html>
<!--

    A GENERAL LEDGER Program
    By: Jeremy C. Southgate (jes4532@g.harvard.edu)
    Copyright © Jeremy C. Southgate. All rights reserved.

    In fulfillment of: HES CSCI E-15 Dynamic Web Applications, Project 3.
    And in partial fulfillment of: the degree of Bachelor of Liberal Arts
    in Extension Studies, Harvard University.

-->
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>

        <!-- HTML Required Elements -->
        <title>General Ledger</title>
        <meta charset="utf-8">

        <!-- Viewport -->
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Adobe Fonts -->
        <link rel="stylesheet" href="https://use.typekit.net/mpn7qcp.css">

        <!-- Page Stylesheet -->
        <link rel='stylesheet' href="{{URL::asset('./css/layout.css')}}"/>

    </head>
    <body>

        <!-- App Header/Title -->
        <header>
            <a href=''><h1>General Ledger</h1></a>
        </header>

        <!-- App Controller Content -->
        <main>
            @yield('content')
        </main>

        <!-- App Print/Results Output -->
        @yield('results')

    </body>
</html>
