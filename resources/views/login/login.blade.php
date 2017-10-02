@extends('layouts.welcome')
@section('content')
    <header class="header">
        <div class="container">
            <nav class="navbar navbar-inverse" role="navigation">
                <div class="navbar-header">
                    <button type="button" id="nav-toggle" class="navbar-toggle" data-toggle="collapse"
                            data-target="#main-nav">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand scroll-top logo"><b><img class="hidden-xs" src="{{ url('assets/img/newlogo.png') }}"
                                                                    alt="" height="104px"></b></a>
                </div>
                <!--/.navbar-header-->
                <div id="main-nav" class="collapse navbar-collapse">
                    <ul class="nav navbar-nav" id="mainNav">
                        <li><a href="{{ url('/') }}" class="scroll-link"><span class="glyphicon glyphicon-home"></span>&nbsp;Home</a>
                        </li>
                    </ul>
                </div>
                <!--/.navbar-collapse-->
            </nav>
            <!--/.navbar-->
        </div>
        <!--/.container-->
    </header>

    <section id="login" class="page-section secPad">
        <div class="container">
            <div class="row">
                <div class="heading text-center">
                    <!-- Heading -->
                    <br><br>
                    <h2>Welcome to e-Lockbox!</h2>
                    <p>Please enter your email and password.</p>
                </div>
            </div>

            {!! Form::open(['route' => 'generate']) !!}
            <div class="col-sm-4 col-sm-offset-4 center-block">
                @if (session()->has('flash_message'))
                    <div class="form-group">
                        <p>{{ session()->get('flash_message') }}</p>
                    </div>
                @endif
                @if (session()->has('error_message'))
                    <div class="form-group alert alert-danger">
                        <p>{{ session()->get('error_message') }}</p>
                    </div>
                @endif
            </div>

            <div class="row">
                <div class="col-sm-4 col-sm-offset-4 center-block">
                    <div class="form-group">
                        <span class="glyphicon glyphicon-user"></span>
                        {{ Form::label('Username') }}
                        {!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'email@example.com', 'required' => 'required']) !!}
                    </div>
                    <div class="form-group">
                        <span class="glyphicon glyphicon-lock"></span>
                        {{ Form::label('Password') }}
                        {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Password', 'required' => 'required']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::submit('Log in', ['class' => 'btn btn-block btn-primary']) !!}
                        <span class="form-group"><a href="{{ url("/reset") }}">Forgot your password?</a></span>
                    </div>
                </div>
            </div>
        </div>
        <!--/.container-->
    </section>
    <!-- Address and Info -->

    <!--/.page-section-->
    <footer style="position: relative; right: 0; bottom: 0; left: 0; background-color: #E4E4E4">
        <section class="copyright">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 text-center">
                        Copyright 2016 Living Advantage, Inc. All Rights Reserved.
                    </div>
                </div>
                <!-- / .row -->
            </div>
        </section>
    </footer>


    {{--{!! Form::open(['route' => 'generate']) !!}--}}
    {{--@if (session()->has('flash_message'))--}}
    {{--<div class="form-group">--}}
    {{--<p>{{ session()->get('flash_message') }}</p>--}}
    {{--</div>--}}
    {{--@endif--}}
    {{--@if (session()->has('error_message'))--}}
    {{--<div class="form-group">--}}
    {{--<p>{{ session()->get('error_message') }}</p>--}}
    {{--</div>--}}
    {{--@endif--}}
    {{--<div class="form-group">--}}
    {{--{!! Form::text('email', null, ['placeholder' => 'Email', 'required' => 'required']) !!}--}}
    {{--</div>--}}
    {{--<div class="form-group">--}}
    {{--{!! Form::password('password', ['placeholder' => 'Password', 'required' => 'required']) !!}--}}
    {{--</div>--}}
    {{--<div class="form-group">--}}
    {{--{!! Form::submit('Log in') !!}--}}
    {{--</div>--}}
    {{--{!! Form::close() !!}--}}

@endsection