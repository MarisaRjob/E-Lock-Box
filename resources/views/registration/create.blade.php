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
            $('#phone').blur(function () {
                if((document.getElementById('phone').value.length != 0) && (document.getElementById('phone').value.length != 12)) {
                    $('#cphone').fadeIn();
                } else {
                    document.getElementById('phone').setAttribute("style", "border: 1px solid #D4D4D4");
                    $('#cphone').fadeOut();
                }
            });
        });
        function check_input(form) {
            if ((form.pwd1.value != form.pwd2.value)) {
                document.getElementById('pwd2').setAttribute("style", "border: 1px solid red");
                return false;
            } else if((form.phone.value.length != 0) && (form.phone.value.length != 12)) {
                document.getElementById('phone').setAttribute("style", "border: 1px solid red");
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
            <h3 class="page-header"><i class="fa fa-plus-circle"></i> Create User</h3>
            <ol class="breadcrumb">
                <li><i class="fa fa-home"></i><a href="{{ url('login') }}">Home</a></li>
                <li><i class="fa fa-user"></i><a href="{{ url('admin/user/view') }}">User Management</a></li>
                <li><i class="fa fa-plus-circle"></i><a href="{{ url('create') }}">Create User</a></li>
            </ol>
        </div>
    </div>
    {!! Form::open(['route' => 'admin.user.store', 'onsubmit' => 'return check_input(this)']) !!}
    @if (session()->has('flash_message'))
        <div class="alert alert-success col-md-9 col-md-offset-1">
            <p>{{ session()->get('flash_message') }}</p>
        </div>
    @elseif($errors->any())
        <div class="alert alert-danger col-md-9 col-md-offset-1">
            <p>{{ $errors->first() }}</p>
        </div>
    @endif
    {{--improve performance--}}
    {{--we should detect whether email and pwd are valid while inputing, rather than after submit--}}

    {{--<div class="col-md-10 col-md-offset-1" style="background-color: #FFFFFF">--}}
        {{--<div class="col-md-10">--}}
            {{--<br><br>--}}
    <div class="col-md-9 col-md-offset-1">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2><i class="fa fa-plus-circle blue"></i><strong>Create User</strong></h2>
            </div>
            <div class="panel-body" style="padding-right: 30px;">
                <div class="form-group row">
{{--                    {!! Form::label('email', 'Email*', ['class' => 'col-md-2 col-form-label control-label', 'style' => 'padding-top:7px; text-align:right']) !!}--}}
                    <label class="col-md-2 col-form-label control-label" style="padding-top:7px; text-align:right">
                        <span><strong>Email </strong></span><span style="color: red"><strong>*</strong></span>
                    </label>
                    <div class="col-md-10">
                        {!! Form::email('email', null, ['id'=>'email', 'placeholder' => 'email@email.com', 'required' => 'required', 'class' => 'form-control', 'style' => 'padding-right:-7px;', 'autocomplete' => 'off']) !!}
                        @if($errors->has('email'))
                            <script>
                                document.getElementById('email').setAttribute("style", "border: 1px solid red");
                            </script>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
{{--                    {!! Form::label('password', 'Password*', ['class' => 'col-md-2 col-form-label control-label', 'style' => 'padding-top:7px; text-align:right']) !!}--}}
                    <label class="col-md-2 col-form-label control-label" style="padding-top:7px; text-align:right">
                        <span><strong>Password </strong></span><span style="color: red"><strong>*</strong></span>
                    </label>
                    <div class="col-md-10">
                        {!! Form::password('password', ['id' => 'pwd1', 'placeholder' => 'Password', 'required' => 'required', 'class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="form-group row">
{{--                    {!! Form::label('password', 'Password*', ['class' => 'col-md-2 col-form-label control-label', 'style' => 'padding-top:7px; text-align:right']) !!}--}}
                    <label class="col-md-2 col-form-label control-label" style="padding-top:7px; text-align:right">
                        <span><strong>Password </strong></span><span style="color: red"><strong>*</strong></span>
                    </label>
                    <div class="col-md-10">
                        {!! Form::password('password_confirmation', ['id' => 'pwd2', 'placeholder' => 'Confirm password', 'required' => 'required', 'class' => 'form-control']) !!}
                    </div>
                    <div id="cpwd" style="display: none; color: red; margin-bottom: -10px;" class="col-md-4 col-md-offset-2">
                        Password not same.
                    </div>
                </div>
                <div class="form-group row">
{{--                    {!! Form::label('first_name','First Name*', ['class' => 'col-md-2 col-form-label control-label', 'style' => 'padding-top:7px; text-align:right']) !!}--}}
                    <label class="col-md-2 col-form-label control-label" style="padding-top:7px; text-align:right">
                        <span><strong>First Name </strong></span><span style="color: red"><strong>*</strong></span>
                    </label>
                    <div class="col-md-4">
                        {!! Form::text('first_name', null, ['placeholder' => 'First name', 'required' => 'required', 'class' => 'col-md-4 form-control']) !!}
                    </div>
{{--                    {!! Form::label('last_name', 'Last Name*', ['class' => 'col-md-2 col-form-label control-label', 'style' => 'padding-top:7px; text-align:right']) !!}--}}
                    <label class="col-md-2 col-form-label control-label" style="padding-top:7px; text-align:right">
                        <span><strong>Last Name </strong></span><span style="color: red"><strong>*</strong></span>
                    </label>
                    <div class="col-md-4">
                        {!! Form::text('last_name', null, ['placeholder' => 'Last name', 'required' => 'required', 'class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="form-group row">
                    {!! Form::label('phone_number', 'Phone', ['class' => 'col-md-2 col-form-label control-label', 'style' => 'padding-top:7px; text-align:right']) !!}
                    <div class="col-md-10">
                        {!! Form::text('phone_number', null, ['id' => 'phone', 'placeholder' => '123-456-7890', 'class' => 'form-control', 'onkeyup' => 'format_phone(this.value)', 'autocomplete' => 'off']) !!}
                    </div>
                    <div id="cphone" style="display: none; color: red; margin-bottom: -20px" class="col-md-10 col-md-offset-2">
                        <p>Phone should have 10 digits, format is XXX-XXX-XXXX.</p>
                    </div>
                </div>
                <div class="form-group row">
                    {!! Form::label('address1', 'Address1', ['class' => 'col-md-2 col-form-label control-label', 'style' => 'padding-top:7px; text-align:right']) !!}
                    <div class="col-md-10">
                        {!! Form::text('address1', null, ['placeholder' => 'Address 1', 'class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="form-group row">
                    {!! Form::label('address2', 'Address2', ['class' => 'col-md-2 col-form-label control-label', 'style' => 'padding-top:7px; text-align:right']) !!}
                    <div class="col-md-10">
                        {!! Form::text('address2', null, ['placeholder' => 'Address 2', 'class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="form-group row">
                    {!! Form::label('city', 'City', ['class' => 'col-md-2 col-form-label control-label', 'style' => 'padding-top:7px; text-align:right']) !!}
                    <div class="col-md-3">
                        {!! Form::text('city', null, ['placeholder' => 'City', 'class' => 'form-control']) !!}
                    </div>

                    {!! Form::label('state', 'State', ['class' => 'col-md-1 col-form-label control-label', 'style' => 'padding-top:7px; text-align:right']) !!}
                    <div class="col-md-2">
                        {!! Form::select('state', ['N/A'=>'--',
                        'AL' => 'AL', 'AK' => 'AK', 'AZ' => 'AZ', 'AR' => 'AR', 'CA' => 'CA',
                        'CO' => 'CO', 'CT' => 'CT', 'DE' => 'DE', 'DC' => 'DC', 'FL' => 'FL',
                        'GA' => 'GA', 'HI' => 'HI', 'ID' => 'ID', 'IL' => 'IL', 'IN' => 'IN',
                        'IA' => 'IA', 'KS' => 'KS', 'KY' => 'KY', 'LA' => 'LA', 'ME' => 'ME',
                        'MD' => 'MD', 'MA' => 'MA', 'MI' => 'MI', 'MN' => 'MN', 'MS' => 'MS',
                        'MO' => 'MO', 'MT' => 'MT', 'NE' => 'NE', 'NV' => 'NV', 'NH' => 'NH',
                        'NJ' => 'NJ', 'NM' => 'NM', 'NY' => 'NY', 'NC' => 'NC', 'ND' => 'ND',
                        'OH' => 'OH', 'OK' => 'OK', 'OR' => 'OR', 'PA' => 'PA', 'RI' => 'RI',
                        'SC' => 'SC', 'SD' => 'SD', 'TN' => 'TN', 'TX' => 'TX', 'UT' => 'UT',
                        'VT' => 'VT', 'VA' => 'VA', 'WA' => 'WA', 'WV' => 'WV', 'WI' => 'WI',
                        'WY' => 'WY'], 'N/A', ['class' => 'form-control']) !!}
                    </div>

                    {!! Form::label('zip', 'ZIP', ['class' => 'col-md-1 col-form-label control-label', 'style' => 'padding-top:7px; text-align:right']) !!}
                    <div class="col-md-3">
                        {!! Form::text('zip', null, ['placeholder' => '90000', 'class' => 'form-control']) !!}
                    </div>
                </div>
                {{--<div class="form-group row">--}}
                    {{--{!! Form::label('state', 'State', ['class' => 'col-md-2 col-form-label control-label', 'style' => 'padding-top:7px; text-align:right']) !!}--}}
                    {{--<div class="col-md-10">--}}
                        {{--{!! Form::select('state', ['N/A'=>'--',--}}
                        {{--'AL' => 'AL', 'AK' => 'AK', 'AZ' => 'AZ', 'AR' => 'AR', 'CA' => 'CA',--}}
                        {{--'CO' => 'CO', 'CT' => 'CT', 'DE' => 'DE', 'DC' => 'DC', 'FL' => 'FL',--}}
                        {{--'GA' => 'GA', 'HI' => 'HI', 'ID' => 'ID', 'IL' => 'IL', 'IN' => 'IN',--}}
                        {{--'IA' => 'IA', 'KS' => 'KS', 'KY' => 'KY', 'LA' => 'LA', 'ME' => 'ME',--}}
                        {{--'MD' => 'MD', 'MA' => 'MA', 'MI' => 'MI', 'MN' => 'MN', 'MS' => 'MS',--}}
                        {{--'MO' => 'MO', 'MT' => 'MT', 'NE' => 'NE', 'NV' => 'NV', 'NH' => 'NH',--}}
                        {{--'NJ' => 'NJ', 'NM' => 'NM', 'NY' => 'NY', 'NC' => 'NC', 'ND' => 'ND',--}}
                        {{--'OH' => 'OH', 'OK' => 'OK', 'OR' => 'OR', 'PA' => 'PA', 'RI' => 'RI',--}}
                        {{--'SC' => 'SC', 'SD' => 'SD', 'TN' => 'TN', 'TX' => 'TX', 'UT' => 'UT',--}}
                        {{--'VT' => 'VT', 'VA' => 'VA', 'WA' => 'WA', 'WV' => 'WV', 'WI' => 'WI',--}}
                        {{--'WY' => 'WY'], 'N/A', ['class' => 'form-control']) !!}--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="form-group row">--}}
                    {{--{!! Form::label('zip', 'ZIP', ['class' => 'col-md-2 col-form-label control-label', 'style' => 'padding-top:7px; text-align:right']) !!}--}}
                    {{--<div class="col-md-10">--}}
                        {{--{!! Form::text('zip', null, ['placeholder' => '90000', 'class' => 'form-control']) !!}--}}
                    {{--</div>--}}
                {{--</div>--}}
                <div class="form-group row">
{{--                    {!! Form::label('role', 'Level*', ['class' => 'col-md-2 col-form-label control-label', 'style' => 'padding-top:7px; text-align:right']) !!}--}}
                    <label class="col-md-2 col-form-label control-label" style="padding-top:7px; text-align:right">
                        <span><strong>Level </strong></span><span style="color: red"><strong>*</strong></span>
                    </label>
                    <div class="col-md-10">
                        {!! Form::select('role', ['Admins' => 'Admin', 'Managers' => 'Case Manager', 'Staff' => 'Staff'], null, ['class' => 'form-control', 'required' => 'required']) !!}
                    </div>
                </div>
                <div class="form-group pull-right">
                    <a type="button" class="btn btn-default" href="{{ url('admin/user/view') }}">Cancel</a>
                    {!! Form::submit('Create and Activate Account', ['class' => 'btn btn-primary', 'id' => 'submit']) !!}
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection