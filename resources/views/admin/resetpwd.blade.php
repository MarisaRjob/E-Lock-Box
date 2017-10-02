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
    <section class="page-section secPad">
        <div class="container">
            <div class="row">
                <div class="heading text-center">
                    <!-- Heading -->
                    <br><br>
                    <h2>Welcome to E-Lockbox!</h2>
                    <p>Please enter your email to reset your password.</p>
                </div>
            </div>
            {!! Form::open(['url' => 'reset']) !!}
            <div class="col-sm-4 col-sm-offset-4 center-block">
                @if (session()->has('flash_message'))
                    <div class="alert alert-danger">
                        <p>{{ session()->get('flash_message') }}</p>
                    </div>
                @endif
            </div>
            <div class="row">
                <div class="col-sm-4 col-sm-offset-4 center-block">
                    <div class="form-group">
                        {!! Form::label('Input your email to receive a link to reset password') !!}
                        {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Email', 'required' => 'required']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::submit('Request', ['class' => 'btn btn-block btn-primary']) !!}
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </section>

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

@endsection
