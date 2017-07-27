@extends('layouts.master')

@section('body-class', 'layout-top-nav')

@section('body-content')
    @include('partials.header-topnav')

    <!-- Full Width Column -->
    <div class="content-wrapper">
        <div class="container">
            @section('page-header')
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    Top Navigation
                    <small>Example 2.0</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li><a href="#">Layout</a></li>
                    <li class="active">Top Navigation</li>
                </ol>
            </section>
            @show

            <!-- Main content -->
            <section class="content">
                @yield('content')
            </section>
            <!-- /.content -->
        </div>
        <!-- /.container -->
    </div>

    @include('partials.footer-topnav')
@endsection