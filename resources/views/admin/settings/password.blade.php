@extends('layouts.dashboard')

@section('head')

    <link href="{{ asset('cssnew/datepicker/jquery-ui.css') }}" rel="stylesheet">
    <script src="{{ asset('cssnew/datepicker/js/jquery-3.1.1.js') }}"></script>
    <script src="{{ asset('cssnew/datepicker/jquery-ui.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('[data-toggle="tooltip"]').tooltip({});
            $('#pwd2').keyup(function () {
                if(document.getElementById('pwd2').value != document.getElementById('pwd1').value) {
                    $('#cpwd').fadeIn();
                } else {
                    document.getElementById('pwd2').setAttribute("style", "border: 1px solid #D4D4D4");
                    $('#cpwd').fadeOut();
                }
            });
        });
        function check_input(form) {
            if ((form.pwd1.value != form.pwd2.value)) {
                document.getElementById('pwd2').setAttribute("style", "border: 1px solid red");
                return false;
            } else {
                return true;
            }
        }
        function format_phone(phone) {
            var re = /^[(]?(\d{3})[)]?[-/.]?(\d{3})[-/.]?(\d{4})$/;
            var newstr = phone.replace(re, '$1-$2-$3');
            document.getElementById('phone').value = newstr;
        }

    </script>
@stop


@section('content')

    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header"><i class="fa fa-gears"></i>Settings</h3>
            <ol class="breadcrumb">
                <li><i class="fa fa-home"></i><a href="{{ url('login') }}">Home</a></li>
                <li><i class="fa fa-gears"></i>Settings</li>
                <li><i class="fa fa-list-alt"></i>Change Password</li>
            </ol>
        </div>
    </div>
    @if (session()->has('flash_message'))
        <div class="alert alert-success col-md-12">
            <p>{{ session()->get('flash_message') }}</p>
        </div>
    @elseif($errors->any())
        <div class="alert alert-danger col-md-12">
            <p>{{ $errors->first() }}</p>
        </div>
    @endif
    <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2><i class="fa fa-gear blue"></i><strong>Reset Password</strong></h2>
            </div>
            <div class="panel-body">
                {!! Form::open(['url' => 'admin/settings/password/reset', 'onsubmit' => 'return check_input(this)']) !!}
                <div class="form-group row">
                    {!! Form::label('email', 'Email', ['class' => 'col-md-2 col-form-label control-label', 'style' => 'padding-top:7px; text-align:right']) !!}
                    <div class="col-md-10">
{{--                        {!! Form::email('email', null, ['id' => 'email', 'placeholder' => 'Email', 'required' => 'required', 'class' => 'form-control', 'autocomplete' =>'off']) !!}--}}
                        <input list="users" name="user" class="form-control" id="user"
                               placeholder="Email" required>
                        <datalist id="users">
                            @foreach($admins as $admin)
                                <option value="{{ Sentinel::findById($admin->user_id)->email}}">{{ Sentinel::findById($admin->user_id)->first_name." ".Sentinel::findById($admin->user_id)->last_name }}</option>
                            @endforeach
                            @foreach($managers as $manager)
                                <option value="{{ Sentinel::findById($manager->user_id)->email}}">{{ Sentinel::findById($manager->user_id)->first_name." ".Sentinel::findById($manager->user_id)->last_name }}</option>
                            @endforeach
                            @foreach($staffs as $staff)
                                <option value="{{ Sentinel::findById($staff->user_id)->email}}">{{ Sentinel::findById($staff->user_id)->first_name." ".Sentinel::findById($staff->user_id)->last_name }}</option>
                            @endforeach
                            @foreach($youths as $youth)
                                <option value="{{ Sentinel::findById($youth->user_id)->email}}">{{ Sentinel::findById($youth->user_id)->first_name." ".Sentinel::findById($youth->user_id)->last_name }}</option>
                            @endforeach
                        </datalist>
                    </div>
                </div>
                <div class="form-group row">
                    {!! Form::label('password1', 'New Password', ['class' => 'col-md-2 col-form-label control-label', 'style' => 'padding-top:7px; text-align:right']) !!}
                    <div class="col-md-10">
                        {!! Form::password('password1', ['id' => 'pwd1', 'placeholder' => 'New password', 'class' => 'form-control', 'autocomplete' => 'off', 'required' => 'required']) !!}
                    </div>
                </div>
                <div class="form-group row">
                    {!! Form::label('password2', 'Confirm Password', ['class' => 'col-md-2 col-form-label control-label', 'style' => 'padding-top:7px; text-align:right']) !!}
                    <div class="col-md-10">
                        {!! Form::password('password2', ['id' => 'pwd2', 'placeholder' => 'New password', 'class' => 'form-control', 'autocomplete' => 'off', 'required' => 'required']) !!}
                    </div>
                    <div id="cpwd" style="display: none; color: red; margin-bottom: -10px;" class="col-md-4 col-md-offset-2">
                        Password not same.
                    </div>
                </div>
                <div class="form-group pull-right">
                    {!! Form::submit('Reset', ['class' => 'btn btn-primary']) !!}
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>


@stop