@extends('layouts.welcome')

@section('head')


@stop

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
                    <a class="navbar-brand scroll-top logo"><b><img src="{{ url('assets/img/logo.png') }}"
                                                                    alt=""></b></a>
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
                    <h2>Reset password.</h2>
                    <p>You are resetting <em><strong style="color: #cc4646">{{$name}}</strong></em>'s password.<br>
                    Please enter your new password.</p>
                </div>
            </div>
            {!! Form::open(['url' => $url]) !!}
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
                        <span class="glyphicon glyphicon-lock"></span>
                        {{ Form::label('Password') }}
                        {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Password', 'required' => 'required']) !!}
                    </div>
                    <div class="form-group">
                        <span class="glyphicon glyphicon-lock"></span>
                        {{ Form::label('Confirm Password') }}
                        {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Password', 'required' => 'required']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::submit('Reset Password', ['class' => 'btn btn-block btn-primary']) !!}
                    </div>
                </div>
            </div>
        </div>
        <!--/.container-->
    </section>


@stop

