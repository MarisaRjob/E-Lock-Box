@extends('layouts.dashboard')

@section('head')

    <link href="{{ asset('cssnew/datepicker/jquery-ui.css') }}" rel="stylesheet">
    <script src="{{ asset('cssnew/datepicker/js/jquery-3.1.1.js') }}"></script>
    <script src="{{ asset('cssnew/datepicker/jquery-ui.js') }}"></script>
    <script src="{{ asset('cssnew/assets/js/pages/form-wizard.js') }}"></script>
    <script src="{{ asset('cssnew/assets/plugins/wizard/jquery.bootstrap.wizard.min.js') }}"></script>
    <script>
      $(document).ready(function() {
        $('[data-toggle="tooltip"]').tooltip();
        $('#ddl').datepicker({
          minDate: new Date(),
          dateFormat: 'mm/dd/yy',
          changeYear: true,
          changeMonth: true,
        });
      });
      function test(obj) {
        if (obj.value.toLowerCase() == document.getElementById('youth_name1').innerHTML) {
          document.getElementById('delCase').disabled = false;
        } else {
          document.getElementById('delCase').disabled = true;
        }
      }
      function upload_avatar() {
        document.getElementById('avatar_upload').click();
      }
    </script>

    <script type="text/javascript">
      // When the document is ready
      $(document).ready(function() {

        $('#example1').datepicker({
          minDate: '-75Y',
          yearRange: "c-75:c+0",
          dateFormat: 'mm/dd/yy',
          maxDate: new Date(),
          changeYear: true,
          changeMonth: true,
        });
        $('#start_date1').datepicker({
          minDate: '-75Y',
          yearRange: "c-75:c+0",
          dateFormat: 'mm/dd/yy',
          changeYear: true,
          changeMonth: true,
        });
        $('#end_date1').datepicker({
          minDate: '-75Y',
          yearRange: "c-75:c+0",
          dateFormat: 'mm/dd/yy',
          changeYear: true,
          changeMonth: true,
        });
        $('#start_date2').datepicker({
          minDate: '-75Y',
          yearRange: "c-75:c+0",
          dateFormat: 'mm/dd/yy',
          changeYear: true,
          changeMonth: true,
        });
        $('#end_date2').datepicker({
          minDate: '-75Y',
          yearRange: "c-75:c+0",
          dateFormat: 'mm/dd/yy',
          changeYear: true,
          changeMonth: true,
        });
        $('#start_date_edu1').datepicker({
          minDate: '-75Y',
          yearRange: "c-75:c+0",
          dateFormat: 'mm/dd/yy',
          changeYear: true,
          changeMonth: true,
        });
        $('#end_date_edu1').datepicker({
          minDate: '-75Y',
          yearRange: "c-75:c+0",
          dateFormat: 'mm/dd/yy',
          changeYear: true,
          changeMonth: true,
        });
        $('#start_date_edu2').datepicker({
          minDate: '-75Y',
          yearRange: "c-75:c+0",
          dateFormat: 'mm/dd/yy',
          changeYear: true,
          changeMonth: true,
        });
        $('#end_date_edu2').datepicker({
          minDate: '-75Y',
          yearRange: "c-75:c+0",
          dateFormat: 'mm/dd/yy',
          changeYear: true,
          changeMonth: true,
        });
        $('#birthday_edit').datepicker({
          maxDate: new Date(),
          dateFormat: 'mm/dd/yy',
          minDate: '-75Y',
          yearRange: "c-75:c+0",
          changeYear: true,
          changeMonth: true,
        });
        $('#ssn').blur(function() {
          if ((document.getElementById('ssn').value.length != 0) &&
              (document.getElementById('ssn').value.length != 11)) {
            $('#cssn').fadeIn();
          } else {
            $('#cssn').fadeOut();
          }
        });
        $('#pwd2').keyup(function() {
          if (document.getElementById('pwd2').value != document.getElementById('pwd1').value) {
            $('#cpwd').fadeIn();
          } else {
            $('#cpwd').fadeOut();
          }
        });
      });
      function format_ssn(ssn) {
        var re = /^(\d{3})[-]?(\d{2})[-]?(\d{4})$/;
        var newstr = ssn.replace(re, '$1-$2-$3');
        document.getElementById('ssn').value = newstr;
      }
      function check_input(form) {
        if ((form.ssn.value.length != 0) && (form.ssn.value.length != 11)) {
          return false;
        } else {
          return true;
        }
      }
      function check_input_pwd(form) {
        if ((form.pwd1.value != form.pwd2.value)) {
          document.getElementById('pwd2').setAttribute('style', 'border: 1px solid red');
          return false;
        } else {
          return true;
        }
      }
    </script>
@stop

@section('content')
    <!-- preloaded info -->
    <?php $youth_name1 = $data->first_name . ' ' . $data->last_name ?>
    <?php if ($user = Sentinel::check()) {
        $admin = Sentinel::findRoleByName('Admins');
        $manager = Sentinel::findRoleByName('Managers');
        $staff = Sentinel::findRoleByName('Staff');
        $youth = Sentinel::findRoleByName('Youths');
    } ?>
    <div id="youth_name1" style="display: none; visibility: hidden;">{{strtolower($youth_name1)}}</div>
    <!-- end preloaded info -->

    <!-- nav bar -->
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header"><i class="fa fa-file-text"></i>Profile</h3>
            <ol class="breadcrumb">
                <li><i class="fa fa-home"></i><a href="{{ url('login') }}">Home</a></li>
                <li><i class="fa fa-folder-open"></i><a href="{{ url('/admin/case/view') }}">Case Management</a></li>
                <li><i class="fa fa-list"></i><a href="{{ url('/admin/case/view') }}">View Cases</a></li>
                <li><i class="fa fa-file-text"></i><a
                            href="{{ url('/admin/case/'.$data->id.'/view') }}">{{ $youth_name1 }}</a></li>
            </ol>
        </div>
    </div>
    <!-- end nav bar -->
    @if (session()->has('flash_message'))
        <div class="alert alert-success col-md-12">
            <p>{{ session()->get('flash_message') }}</p>
        </div>
    @elseif($errors->any())
        <div class="alert alert-danger col-md-12">
            <p>{{ $errors->first() }}</p>
        </div>
    @endif
    <!-- all shown information -->
    <div class="row profile">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    {{--Avatar--}}
                    <div class="col-md-4" style="margin-top: 40px">
                        <div class="text-center">
                            @if($avatar)
                                <img class='img-profile' src='{{asset($avatar->path.'/'.$avatar->filename)}}'
                                     width='120px' height='120px' style='cursor: pointer' data-toggle='modal'
                                     data-target='#uploadAvatar'>
                            @else
                                <img class='img-profile' src='{{asset('cssnew/assets/img/avatar.png')}}'
                                     style='cursor: pointer' data-toggle='modal' data-target='#uploadAvatar'
                                     width='120px' height='120px'>
                            @endif
                        </div>
                        <h3 class="text-center"><strong>{{ $data->first_name.' '.$data->last_name }}</strong></h3>
                        @if($caseUser == null)
                            <button type="button" class="btn btn-block btn-success center-block" style="width: 45%"
                                    data-toggle="modal" data-target="#createAccount">
                                Create Account
                            </button>
                        @endif
                    </div>
                    {{--General Information--}}
                    <div class="col-md-8" style="margin-top: 20px">
                        <h4><strong>General Information</strong></h4>
                        <div class="col-md-4">
                            <ul class="profile-details">
                                <li>
                                    <div style="color: #4C4F53"><i class="fa fa-building-o"
                                                                   style="color: #4C4F53"></i><strong>
                                            Email</strong>
                                    </div>
                                    <div style="color: #6699CC">
                                        @if($data->email)
                                            {{ $data->email }}
                                        @else
                                            N/A
                                        @endif
                                    </div>
                                </li>
                                <li>
                                    <div style="color: #4C4F53"><i class="fa fa-calendar"
                                                                   style="color: #4C4F53"></i><strong>
                                            Birthday</strong>
                                    </div>
                                    <div style="color: #6699CC">
                                        {{--@if($data->birthday)--}}
                                        {{--{{ date('m/d/Y', strtotime($data->birthday)) }}--}}
                                        {{--@else--}}
                                        {{--N/A--}}
                                        {{--@endif--}}
                                        <?php $date = new DateTime($data->birthday);
                                        if ($date->format('m/d/Y') == "12/31/1969") {
                                            echo "N/A";
                                        } else {
                                            echo $date->format('m/d/Y');
                                        }
                                        ?>
                                    </div>
                                </li>
                                <li>
                                    <div style="color: #4C4F53"><i class="fa fa-building-o"
                                                                   style="color: #4C4F53"></i><strong>
                                            Status</strong>
                                    </div>
                                    @if($data->status)
                                        <div style="color: #6699CC">Active</div>
                                    @else
                                        <div style="color: #6699CC">Inactive</div>
                                    @endif
                                    {{--<div style="color: #4C4F53"><i class="fa fa-building-o"--}}
                                    {{--style="color: #4C4F53"></i><strong>--}}
                                    {{--Webpage</strong>--}}
                                    {{--</div>--}}
                                    {{--<div style="color: #6699CC">--}}
                                    {{--@if($data->webpage)--}}
                                    {{--{{ $data->webpage }}--}}
                                    {{--@else--}}
                                    {{--N/A--}}
                                    {{--@endif--}}
                                    {{--</div>--}}
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-4">
                            <ul class="profile-details">
                                <li>
                                    <div style="color: #4C4F53"><i class="fa fa-building-o"
                                                                   style="color: #4C4F53"></i><strong>
                                            Program</strong>
                                    </div>
                                    <div style="color: #6699CC">
                                        @if($data->program)
                                            {{ $program_name[$data->program] }}
                                        @else
                                            N/A
                                        @endif
                                    </div>
                                </li>
                                <li>
                                    <div style="color: #4C4F53"><i class="fa fa-building-o"
                                                                   style="color: #4C4F53"></i><strong>
                                            Gender</strong>
                                    </div>
                                    <div style="color: #6699CC">
                                        @if($data->gender)
                                            {{ $data->gender }}
                                        @else
                                            N/A
                                        @endif
                                    </div>
                                </li>
                                <li>
                                    <div style="color: #4C4F53"><i class="fa fa-building-o"
                                                                   style="color: #4C4F53"></i><strong> ILP</strong>
                                    </div>
                                    @if($data->ILP == 1)
                                        <div style="color: #6699CC">Yes</div>
                                    @elseif($data->ILP == 0)
                                        <div style="color: #6699CC">No</div>
                                    @endif
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-4">
                            <ul class="profile-details">
                                <li>
                                    <div style="color: #4C4F53"><i class="fa fa-building-o"
                                                                   style="color: #4C4F53"></i><strong>
                                            Manager</strong>
                                    </div>
                                    <div style="color: #6699CC">{{ Sentinel::findById($data->cm_id)->first_name." ".Sentinel::findById($data->cm_id)->last_name }}
                                    </div>
                                </li>
                                <li>
                                    <div style="color: #4C4F53"><i class="fa fa-building-o"
                                                                   style="color: #4C4F53"></i><strong>
                                            Ethnicity</strong></div>
                                    <div style="color: #6699CC">
                                        @if($data->ethnicity)
                                            {{ $data->ethnicity }}
                                        @else
                                            N/A
                                        @endif
                                    </div>
                                </li>
                                <li>
                                    <div style="color: #4C4F53"><i class="fa fa-building-o"
                                                                   style="color: #4C4F53"></i><strong> SSN </strong></div>
                                    <div style="color: #6699CC" onclick="show_ssn();" id="hidden_ssn">
                                        @if($data->ssn)
                                            <?php
                                            //                                            $ssn_array = str_split($data->ssn);
                                            //                                            echo "***-**-".$ssn_array[7].$ssn_array[8].$ssn_array[9].$ssn_array[10]
                                            preg_match('/.*(\d{4})/', $data->ssn, $results);
                                            echo "***-**-" . $results[1];
                                            ?>
                                        @else
                                            N/A
                                        @endif
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-12" style="margin-top: 13px">
                            <div class="row">
                                <div class="col-md-4">
                                    @if($data->status)
                                        <button id="case_edit" type="button" class="btn btn-block btn-primary"
                                                data-toggle="modal" data-target="#editProfile">
                                            Edit
                                        </button>
                                    @else
                                        <button id="case_edit_disabled" type="button"
                                                class="btn btn-block btn-primary"
                                                data-toggle="tooltip" data-placement="top"
                                                title="Need to activate this case first.">
                                            Edit
                                        </button>
                                    @endif
                                </div>
                                @if($data->status)
                                    <div class="col-md-4">
                                        <a href="{{ url('admin/case/'. $data->id.'/inactive') }}"
                                           class="btn btn-block btn-warning"
                                           role="button" id="case_inactive">Inactivate</a>
                                    </div>
                                @else
                                    <div class="col-md-4">
                                        <a href="{{ url('admin/case/'. $data->id.'/active') }}"
                                           class="btn btn-block btn-success"
                                           role="button" id="case_inactive">Activate</a>
                                    </div>
                                @endif
                                <div class="col-md-4">
                                    <button type="button" class="btn btn-block btn-danger"
                                            data-toggle="modal" data-target="#deleteCase">
                                        Delete
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{--Contact Information--}}
                    <div class="col-md-12"
                         style="border-top: 1px #EEEEEE solid; margin-top: 15px; padding-top: 10px">
                        <div class="col-md-10">
                            <h4><strong>Contact Information</strong></h4>
                        </div>
                        <div class="col-md-2">
                            @if($data->status)
                                <button type="button" class="btn btn-primary"
                                        style="padding-left: 50px; padding-right: 50px" data-toggle="modal"
                                        data-target="#addcontactinfo"> Add
                                </button>
                            @endif
                        </div>
                        <!-- address -->
                        <div class="col-md-12" style="">
                            {{--<div class="col-md-10">--}}
                            <h5><strong>Address</strong></h5>
                            {{--</div>--}}
                            {{--<div class="col-md-2">--}}
                            {{--@if($data->status)--}}
                            {{--<button type="button" class="btn btn-primary"--}}
                            {{--style="padding-left: 50px; padding-right: 50px" data-toggle="modal"--}}
                            {{--data-target="#addaddress"> Add--}}
                            {{--</button>--}}
                            {{--@endif--}}
                            {{--</div>--}}
                            <table class="table table-striped" style="margin-left: 15px">
                                <thead>
                                <tr>
                                    <th style="width: 28%;">Address</th>
                                    <th style="width: 14%;">City</th>
                                    <th style="width: 14%;">State</th>
                                    <th style="width: 14%;">ZipCode</th>
                                    <th style="width: 14%;">Status</th>
                                    @if($data->status)
                                        <th style="width: 14%;">Action</th>
                                    @endif
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($case_address as $address)
                                    <tr>
                                        <td>{{$address->address}}</td>
                                        <td>{{$address->city}}</td>
                                        <td>{{$address->state}}</td>
                                        <td>{{$address->zipcode}}</td>
                                        <td>{{$address->status}}</td>
                                        @if($data->status)
                                            <td>
                                                <button type="button" class="btn btn-success" data-toggle="modal"
                                                        data-target="#viewaddress{{$address->id}}">
                                                    <i class="fa fa-search-plus" style="width: 10px"></i>
                                                </button>
                                                <button type="button" class="btn btn-warning" data-toggle="modal"
                                                        data-target="#editaddress{{$address->id}}">
                                                    <i class="fa fa-pencil-square-o" style="width: 10px"></i>
                                                </button>
                                                <button type="button" class="btn btn-danger" data-toggle="modal"
                                                        data-target="#deleteaddress{{$address->id}}">
                                                    <i class="fa fa-trash-o" style="width: 10px"></i>
                                                </button>
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- phone -->
                        <div class="col-md-12" style="">
                            {{--<div class="col-md-10">--}}
                            <h5><strong>Phone</strong></h5>
                            {{--</div>--}}
                            {{--<div class="col-md-2">--}}
                            {{--@if($data->status)--}}
                            {{--<button type="button" class="btn btn-primary"--}}
                            {{--style="padding-left: 50px; padding-right: 50px" data-toggle="modal"--}}
                            {{--data-target="#addphone"> Add--}}
                            {{--</button>--}}
                            {{--@endif--}}
                            {{--</div>--}}
                            <table class="table table-striped" style="margin-left: 15px">
                                <thead>
                                <tr>
                                    <th style="width: 14%;">Type</th>
                                    <th style="width: 28%;">Number</th>
                                    <th style="width: 42%;">Status</th>
                                    @if($data->status)
                                        <th style="width: 14%;">Action</th>
                                    @endif
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($case_phone as $phone)
                                    <tr>
                                        <td>{{$phone->type}}</td>
                                        <td>{{$phone->number}}</td>
                                        <td>{{$phone->status}}</td>
                                        @if($data->status)
                                            <td>
                                                <button type="button" class="btn btn-success" data-toggle="modal"
                                                        data-target="#viewphone{{$phone->id}}">
                                                    <i class="fa fa-search-plus" style="width: 10px"></i>
                                                </button>
                                                <button type="button" class="btn btn-warning" data-toggle="modal"
                                                        data-target="#editphone{{$phone->id}}">
                                                    <i class="fa fa-pencil-square-o" style="width: 10px"></i>
                                                </button>
                                                <button type="button" class="btn btn-danger" data-toggle="modal"
                                                        data-target="#deletephone{{$phone->id}}">
                                                    <i class="fa fa-trash-o" style="width: 10px"></i>
                                                </button>
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- email -->
                        <div class="col-md-12" style="">
                            {{--<div class="col-md-10">--}}
                            <h5><strong>Email</strong></h5>
                            {{--</div>--}}
                            {{--<div class="col-md-2">--}}
                            {{--@if($data->status)--}}
                            {{--<button type="button" class="btn btn-primary"--}}
                            {{--style="padding-left: 50px; padding-right: 50px" data-toggle="modal"--}}
                            {{--data-target="#addemail"> Add--}}
                            {{--</button>--}}
                            {{--@endif--}}
                            {{--</div>--}}
                            <table class="table table-striped" style="margin-left: 15px">
                                <thead>
                                <tr>
                                    <th style="width: 42%;">Email</th>
                                    <th style="width: 42%;">Status</th>
                                    @if($data->status)
                                    <th style="width: 14%;">Action</th>
                                        @endif
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($case_email as $email)
                                    <tr>
                                        <td>{{$email->email}}</td>
                                        <td>{{$email->status}}</td>
                                        @if($data->status)
                                            <td>
                                                <button type="button" class="btn btn-success" data-toggle="modal"
                                                        data-target="#viewemail{{$email->id}}">
                                                    <i class="fa fa-search-plus" style="width: 10px"></i>
                                                </button>
                                                <button type="button" class="btn btn-warning" data-toggle="modal"
                                                        data-target="#editemail{{$email->id}}">
                                                    <i class="fa fa-pencil-square-o" style="width: 10px"></i>
                                                </button>
                                                <button type="button" class="btn btn-danger" data-toggle="modal"
                                                        data-target="#deleteemail{{$email->id}}">
                                                    <i class="fa fa-trash-o" style="width: 10px"></i>
                                                </button>
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    {{--Activities --}}
                    <div class="col-md-12"
                         style="border-top: 1px #EEEEEE solid; margin-top: 15px; padding-top: 10px">
                        <div class="col-md-10">
                            <h4><strong>Case Related Activities</strong></h4>
                        </div>
                        <div class="col-md-2">
                            @if($data->status)
                                <button type="button" class="btn btn-primary"
                                        style="padding-left: 50px; padding-right: 50px" data-toggle="modal"
                                        data-target="#addactivity"> Add
                                </button>
                            @endif
                        </div>
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th style="width: 12.5%;">Subject</th>
                                <th style="width: 7.5%;">Task</th>
                                <th style="width: 12.5%;">Due Date</th>
                                <th style="width: 12.5%;">Assigned To</th>
                                <th style="width: 12.5%;">Created By</th>
                                <th style="width: 12.5%;">Mentioned To</th>
                                <th style="width: 20%;">Last Modified Date</th>
                                <th style="width: 10%;">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($activities as $activity)
                                <tr>
                                    <td>{{ $activity->subject }}</td>
                                    @if($activity->task)
                                        <td><span class="label label-success">Done</span></td>
                                    @else
                                        <td><span class="label label-warning">To Do</span></td>
                                    @endif
                                    @if($activity->ddl == "1969-12-31 00:00:00")
                                        <td>N/A</td>
                                    @else
                                    <td>
                                        {{date("m/d/Y", strtotime($activity->ddl))}}
                                    </td>
                                    @endif
                                    <td>{{Sentinel::findById($activity->assigned)->first_name." ".Sentinel::findById($activity->assigned)->last_name}}</td>
                                    <td>{{Sentinel::findById($activity->creator)->first_name." ".Sentinel::findById($activity->creator)->last_name}}</td>
                                    @if($activity->mentioned)
                                    <td>{{Sentinel::findById($activity->mentioned)->first_name." ".Sentinel::findById($activity->mentioned)->last_name}}</td>
                                    @else
                                        <td></td>
                                    @endif
                                    <td>{{ date("m/d/Y H:i:s", strtotime($activity->updated_at)) }}</td>
                                    <td><a class="btn btn-success" href="{{ url('admin/'. $activity->id .'/view') }}">
                                            <i class="fa fa-search-plus "></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{--Additional Contacts--}}
                    <div class="col-md-12"
                         style="border-top: 1px #EEEEEE solid; margin-top: 15px; padding-top: 10px">
                        <div class="col-md-10">
                            <h4><strong>Additional Contacts</strong></h4>
                        </div>
                        <div class="col-md-2">
                            @if($data->status)
                                <button type="button" class="btn btn-primary"
                                        style="padding-left: 50px; padding-right: 50px" data-toggle="modal"
                                        data-target="#addcontact"> Add
                                </button>
                            @endif
                        </div>
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th style="width: 14%;">Name</th>
                                <th style="width: 14%;">Relationship</th>
                                <th style="width: 14%;">Phone</th>
                                <th style="width: 14%;">Email</th>
                                <th style="width: 14%;">Address</th>
                                <th style="width: 14%;">Status</th>
                                @if($data->status)
                                    <th style="width: 14%;">Action</th>
                                @endif
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($addcontacts as $addcontact)
                                <tr>
                                    <td>{{$addcontact->name}}</td>
                                    <td>{{$addcontact->relationship}}</td>
                                    <td>{{$addcontact->phone}}</td>
                                    <td>{{$addcontact->email}}</td>
                                    <td>{{$addcontact->address}}</td>
                                    <td>{{$addcontact->status}}</td>
                                    @if($data->status)
                                        <td>
                                            <button type="button" class="btn btn-success" data-toggle="modal"
                                                    data-target="#viewaddcontact{{$addcontact->id}}">
                                                <i class="fa fa-search-plus" style="width: 10px"></i>
                                            </button>
                                            <button type="button" class="btn btn-warning" data-toggle="modal"
                                                    data-target="#editaddcontact{{$addcontact->id}}">
                                                <i class="fa fa-pencil-square-o" style="width: 10px"></i>
                                            </button>
                                            <button type="button" class="btn btn-danger" data-toggle="modal"
                                                    data-target="#deleteaddcontact{{$addcontact->id}}">
                                                <i class="fa fa-trash-o" style="width: 10px"></i>
                                            </button>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{--Education History--}}
                    <div class="col-md-12"
                         style="border-top: 1px #EEEEEE solid; margin-top: 15px; padding-top: 10px">
                        <div class="col-md-10">
                            <h4><strong>Education History</strong></h4>
                        </div>
                        <div class="col-md-2">
                            @if($data->status)
                                <button type="button" class="btn btn-primary"
                                        style="padding-left: 50px; padding-right: 50px" data-toggle="modal"
                                        data-target="#addeduhistory"> Add
                                </button>
                            @endif
                        </div>
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th style="width: 14%;">Start Date</th>
                                <th style="width: 14%;">End Date</th>
                                <th style="width: 14%;">School</th>
                                <th style="width: 14%;">Level</th>
                                <th style="width: 14%;">Address</th>
                                <th style="width: 14%;">Status</th>
                                @if($data->status)
                                    <th style="width: 14%;">Action</th>
                                @endif
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($eduhistorys as $eduhistory)
                                <tr>
                                    <td>{{$eduhistory->start_date}}</td>
                                    <td>{{$eduhistory->end_date}}</td>
                                    <td>{{$eduhistory->school}}</td>
                                    <td>{{$eduhistory->level}}</td>
                                    <td>{{$eduhistory->address}}</td>
                                    <td>{{$eduhistory->status}}</td>
                                    @if($data->status)
                                        <td>
                                            <button type="button" class="btn btn-success" data-toggle="modal"
                                                    data-target="#vieweduhistory{{$eduhistory->id}}">
                                                <i class="fa fa-search-plus" style="width: 10px"></i>
                                            </button>
                                            <button type="button" class="btn btn-warning" data-toggle="modal"
                                                    data-target="#editeduhistory{{$eduhistory->id}}">
                                                <i class="fa fa-pencil-square-o" style="width: 10px"></i>
                                            </button>
                                            <button type="button" class="btn btn-danger" data-toggle="modal"
                                                    data-target="#deleteeduhistory{{$eduhistory->id}}">
                                                <i class="fa fa-trash-o" style="width: 10px"></i>
                                            </button>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{--Work History--}}
                    <div class="col-md-12"
                         style="border-top: 1px #EEEEEE solid; margin-top: 15px; padding-top: 10px">
                        <div class="col-md-10">
                            <h4><strong>Work History</strong></h4>
                        </div>
                        <div class="col-md-2">
                            @if($data->status)
                                <button type="button" class="btn btn-primary"
                                        style="padding-left: 50px; padding-right: 50px"
                                        data-toggle="modal" data-target="#addworkhistory">
                                    Add
                                </button>
                            @endif
                        </div>
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th style="width: 14%;">Start Date</th>
                                <th style="width: 14%;">End Date</th>
                                <th style="width: 14%;">Company</th>
                                <th style="width: 14%;">Industry</th>
                                <th style="width: 14%;">Address</th>
                                <th style="width: 14%;">Status</th>
                                @if($data->status)
                                    <th style="width: 14%;">Action</th>
                                @endif
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($workhistorys as $workhistory)
                                <tr>
                                    <td>{{$workhistory->start_date}}</td>
                                    <td>{{$workhistory->end_date}}</td>
                                    <td>{{$workhistory->company}}</td>
                                    <td>{{$workhistory->industry}}</td>
                                    <td>{{$workhistory->address}}</td>
                                    <td>{{$workhistory->status}}</td>
                                    @if($data->status)
                                        <td>
                                            <button type="button" class="btn btn-success" data-toggle="modal"
                                                    data-target="#viewworkhistory{{$workhistory->id}}">
                                                <i class="fa fa-search-plus" style="width: 10px"></i>
                                            </button>
                                            <button type="button" class="btn btn-warning" data-toggle="modal"
                                                    data-target="#editworkhistory{{$workhistory->id}}">
                                                <i class="fa fa-pencil-square-o" style="width: 10px"></i>
                                            </button>
                                            <button type="button" class="btn btn-danger" data-toggle="modal"
                                                    data-target="#deleteworkhistory{{$workhistory->id}}">
                                                <i class="fa fa-trash-o" style="width: 10px"></i>
                                            </button>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{--Vital Documents--}}
                    <div class="col-md-12"
                         style="border-top: 1px #EEEEEE solid; margin-top: 15px; padding-top: 10px">
                        <div class="col-md-10">
                            <h4><strong>Vital Documents</strong></h4>
                        </div>
                        <div class="col-md-2">
                            @if($data->status)
                                <button type="button" class="btn btn-primary"
                                        style="padding-left: 50px; padding-right: 50px"
                                        data-toggle="modal" data-target="#uploaddocument">
                                    Add
                                </button>
                            @endif
                        </div>
                        <table class="table table-striped">
                            <thead>
                            <tr style="text-align: left">
                                <th style="width: 6%;">Type</th>
                                <th style="width: 11%;">Title</th>
                                <th style="width: 11%">Visibility</th>
                                <th style="width: 11%;">Uploaded By</th>
                                <th style="width: 22%;">Upload Date</th>
                                <th style="width: 22%;">Last Modified Date</th>
                                @if($data->status)
                                    <th style="width: 16%;">Action</th>
                                @endif
                            </tr>

                            </thead>
                            <tbody>
                            @foreach($docs as $doc)
                                <tr>
                                    <td>{{ $doc_type_abbr[$doc->type] }}</td>
                                    <td>
                                        <a href="{{asset($doc->path.'/'.$doc->filename)}}"
                                           target="_blank" data-toggle="tooltip" data-placement="top"
                                           title="{{$doc->description}}">{{$doc->title}}</a>
                                    </td>
                                    <td>{{$doc->visible}}</td>
                                    <td>{{$doc->uploader}}</td>
                                    <td>{{date("m/d/Y H:i:s", strtotime($doc->created_at))}}</td>
                                    <td>{{date("m/d/Y H:i:s", strtotime($doc->updated_at))}}</td>
                                    @if($data->status)
                                        <td>
                                            <a class="btn btn-success"
                                               href="{{asset($doc->path.'/'.$doc->filename)}}"
                                               target="_blank">
                                                <i class="fa fa-file-pdf-o" style="width: 10px"></i>
                                            </a>
                                            <button type="button" class="btn btn-warning" data-toggle="modal"
                                                    data-target="#{{$doc->id}}">
                                                <i class="fa fa-pencil-square-o" style="width: 10px"></i>
                                            </button>
                                            <button type="button" class="btn btn-danger" data-toggle="modal"
                                                    data-target="#del{{$doc->id}}">
                                                <i class="fa fa-trash-o" style="width: 10px"></i>
                                            </button>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>

        </div><!--/.col-->
    </div>
    <!-- end all shown information -->

    <!-- create user from case  popup window-->
    <div class="modal fade" style="margin-top:10%" id="createAccount" tabindex="-1" role="dialog"
         aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Create Youth Account</h4>
                </div>
                <div class="modal-body">
                    {!! Form::open(['route' => ['admin.case.create.account', $data->id], 'onsubmit' => 'return check_input_pwd(this)']) !!}
                    @if (session()->has('flash_message'))
                        <div class="form-group">
                            <p>{{ session()->get('flash_message') }}</p>
                        </div>
                    @endif
                    {{--improve performance--}}
                    {{--we should detect whether email and pwd are valid while inputing, rather than after submit--}}
                    <div class="form-group row">
                        {{--                        {!! Form::label('email', 'Email*', ['class' => 'col-md-2 col-form-label control-label', 'style' => 'padding-top:7px; text-align: right']) !!}--}}
                        <label class="col-md-2 col-form-label control-label" style="padding-top:7px; text-align:right;">
                            <span><strong>Email</strong></span><span style="color: red"><strong>*</strong></span>
                        </label>
                        <div class="col-md-10">
                            {!! Form::text('email', $data->email, ['placeholder' => 'Email', 'required' => 'required', 'class' => 'form-control', 'disabled']) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        {{--                        {!! Form::label('password', 'Password*', ['class' => 'col-md-2 col-form-label', 'style' => 'padding-top:7px; text-align: right']) !!}--}}
                        <label class="col-md-2 col-form-label control-label" style="padding-top:7px; text-align:right">
                            <span><strong>Password</strong></span><span style="color: red"><strong>*</strong></span>
                        </label>
                        <div class="col-md-10">
                            {!! Form::password('password', ['id' => 'pwd1', 'placeholder' => 'Password', 'required' => 'required', 'class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        {{--                        {!! Form::label('password', 'Password*', ['class' => 'col-md-2 col-form-label', 'style' => 'padding-top:7px; text-align: right']) !!}--}}
                        <label class="col-md-2 col-form-label control-label" style="padding-top:7px; text-align:right">
                            <span><strong>Password</strong></span><span style="color: red"><strong>*</strong></span>
                        </label>
                        <div class="col-md-10">
                            {!! Form::password('password_confirmation', ['id' => 'pwd2', 'placeholder' => 'Confirm password', 'required' => 'required', 'class' => 'form-control']) !!}
                        </div>
                        <div id="cpwd" style="display: none; color: red; margin-bottom: -10px;"
                             class="col-md-4 col-md-offset-2">
                            Password not same.
                        </div>
                    </div>


                </div>
                <div class="modal-footer">
                    <div class="form-group">
                        {!! Form::button('Cancel', ['class' => 'btn btn-default', 'data-dismiss' => 'modal']) !!}
                        {!! Form::submit('Create and Activate', ['class' => 'btn btn-primary']) !!}
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    <!-- end create account -->

    <!-- delete case -->
    <div class="modal fade" style="margin-top:10%" id="deleteCase" tabindex="-1" role="dialog"
         aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Are you ABSOLUTELY sure?</h4>
                </div>
                <div style="background-color: #F8EEC7; padding-top: 10px; padding-bottom: 10px; padding-left: 15px">
                    Unexpected bad things will happen if you don’t read this!
                </div>
                <div class="modal-body">
                    This action <strong>CANNOT</strong> be undone.<br>
                    This will permanently delete <strong style="color: #FF2121"><em>{{ $youth_name1 }}</em></strong>'s
                    case, case profile, history and documents.<br>
                    We <strong>STRONGLY SUGGEST</strong> you to <strong>inactivate</strong> instead.<br><br>
                    <strong>Please input Youth name of this case:</strong><br>
                    Notice: Either uppercase or lowercase is accepted.
                    {!! Form::open(['url' => 'admin/case/'.$data->id.'/delete']) !!}
                    <div class="form-group row" style="margin-top: 10px; padding-left: 15px; padding-right: 15px;">
                        {{ Form::text('youth_name', null, ['placeholder' => 'Firstname Lastname', 'class' => 'form-control', 'style' => 'margin-bottom: 15px', 'onchange' => 'test(this)', 'onkeyup' => 'test(this)', 'onmousemove' => 'test(this)',  'onmousedown' => 'test(this)','autocomplete' => 'off']) }}

                        {{ Form::submit('I understand the consequences, delete this case', ['id' => 'delCase', 'class' => 'btn btn-danger pull-right', 'disabled']) }}
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
    <!-- end delete case -->

    <!-- upload doc-->
    <div class="modal fade" style="margin-top:10%" id="uploaddocument" tabindex="-1" role="dialog"
         aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Upload Documents</h4>
                </div>
                <div class="modal-body">
                    {!! Form::open(['url' => '/admin/case/upload', 'files' => 'true']) !!}
                    {{ csrf_field() }}
                    <div class="form-group" style="display: none; visibility: hidden">
                        {!! Form::text('id', $data->id) !!}
                    </div>
                    <div class="form-group row">
                        {{ Form::label('title', 'Title', ['class' => 'col-md-3 col-form-label control-label', 'style' => 'padding-top:7px; text-align: right']) }}
                        <div class="col-md-9">
                            {{ Form::text('title', null, ['placeholder' => 'Document title', 'class' => 'form-control']) }}
                        </div>
                    </div>
                    <div class="form-group row">
                        {{ Form::label('type', 'Type', ['class' => 'col-md-3 col-form-label control-label', 'style' => 'padding-top:7px; text-align: right']) }}
                        <div class="col-md-9">
                            {{ Form::select('type', $doc_type_name, null, ['class' => 'form-control']) }}
                        </div>
                    </div>
                    <div class="form-group row">
                        {{ Form::label('description', 'Description', ['class' => 'col-md-3 col-form-label control-label', 'style' => 'padding-top:7px; text-align: right']) }}
                        <div class="col-md-9">
                            {{ Form::textarea('description', null, ['placeholder' => 'Document description', 'class' => 'form-control']) }}
                        </div>
                    </div>
                    <div class="form-group row">
                        {{ Form::label('visible', 'Visible', ['class' => 'col-md-3 col-form-label control-label', 'style' => 'padding-top:7px; text-align: right']) }}
                        <div class="col-md-9">
                            {{ Form::select('visible', ['visible' => 'visible', 'invisible' => 'invisible'], null, ['class' => 'form-control']) }}
                        </div>
                    </div>
                    <div class="form-group row">
                        {{ Form::label('xxx', 'Uploaded By', ['class' => 'col-md-3 col-form-label control-label', 'style' => 'padding-top:7px; text-align: right']) }}
                        <div class="col-md-9">
                            {{ Form::text('xxx', $user->first_name.' '.$user->last_name, ['placeholder' => 'Uploaded By...', 'class' => 'form-control', 'disabled']) }}
                        </div>
                    </div>
                    <div class="form-group row" style="display: none; visibility: hidden">
                        {{ Form::label('uploader', 'Uploaded By', ['class' => 'col-md-3 col-form-label control-label', 'style' => 'padding-top:7px; text-align: right']) }}
                        <div class="col-md-9">
                            {{ Form::text('uploader', $user->first_name.' '.$user->last_name, ['placeholder' => 'Uploaded By...', 'class' => 'form-control']) }}
                        </div>
                    </div>
                    <div class="form-group row">
                        {{ Form::label('doc', 'Document', ['class' => 'col-md-3 col-form-label control-label', 'style' => 'padding-top:7px; text-align: right']) }}
                        <div class="col-md-9">
                            {{ Form::file('image', ['required']) }}
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <div class="form-group pull-right">
                        {{ Form::submit('Upload File', ['class' => 'btn btn-primary']) }}
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end upload doc-->

    <!-- edit doc-->
    @foreach($docs as $doc)
        <div class="modal fade" style="margin-top:10%" id="{{$doc->id}}" tabindex="-1" role="dialog"
             aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel">Edit Documents</h4>
                    </div>
                    <div class="modal-body">
                        {!! Form::open(['url' => '/admin/case/doc/'.$doc->id.'/edit', 'files' => 'true']) !!}
                        {{ csrf_field() }}
                        <div class="form-group" style="display: none; visibility: hidden">
                            {!! Form::text('id', $data->id) !!}
                        </div>
                        <div class="form-group" style="display: none; visibility: hidden">
                            {!! Form::text('doc_id', $doc->id) !!}
                        </div>
                        <div class="form-group row">
                            {{ Form::label('title', 'Title', ['class' => 'col-md-3 col-form-label control-label', 'style' => 'padding-top:7px; text-align: right']) }}
                            <div class="col-md-9">
                                {{ Form::text('title', $doc->title, ['placeholder' => 'Document title', 'class' => 'form-control']) }}
                            </div>
                        </div>
                        <div class="form-group row">
                            {{ Form::label('type', 'Type', ['class' => 'col-md-3 col-form-label control-label', 'style' => 'padding-top:7px; text-align: right']) }}
                            <div class="col-md-9">
                                {{ Form::select('type', $doc_type_name, $doc->type, ['class' => 'form-control']) }}
                            </div>
                        </div>
                        <div class="form-group row">
                            {{ Form::label('description', 'Description', ['class' => 'col-md-3 col-form-label control-label', 'style' => 'padding-top:7px; text-align: right']) }}
                            <div class="col-md-9">
                                {{ Form::textarea('description', $doc->description, ['placeholder' => 'Input document description', 'class' => 'form-control']) }}
                            </div>
                        </div>
                        <div class="form-group row">
                            {{ Form::label('visible', 'Visible', ['class' => 'col-md-3 col-form-label control-label', 'style' => 'padding-top:7px; text-align: right']) }}
                            <div class="col-md-9">
                                {{ Form::select('visible', ['visible' => 'visible', 'invisible' => 'invisible'], $doc->visible, ['class' => 'form-control']) }}
                            </div>
                        </div>
                        <div class="form-group row">
                            {{ Form::label('xxx', 'Uploaded By', ['class' => 'col-md-3 col-form-label control-label', 'style' => 'padding-top:7px; text-align: right']) }}
                            <div class="col-md-9">
                                {{ Form::text('xxx', $user->first_name.' '.$user->last_name, ['placeholder' => 'Uploaded By...', 'class' => 'form-control', 'disabled']) }}
                            </div>
                        </div>
                        <div class="form-group row" style="display: none; visibility: hidden">
                            {{ Form::label('uploader', 'Uploaded By', ['class' => 'col-md-3 col-form-label control-label', 'style' => 'padding-top:7px; text-align: right']) }}
                            <div class="col-md-9">
                                {{ Form::text('uploader', $user->first_name.' '.$user->last_name, ['placeholder' => 'Uploaded By...', 'class' => 'form-control']) }}
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="form-group pull-right">
                            {{ Form::submit('Save', ['class' => 'btn btn-primary']) }}
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    <!-- end edit doc-->

    <!-- delete doc -->
    @foreach($docs as $doc)
        <div class="modal fade" style="margin-top:10%" id="del{{$doc->id}}" tabindex="-1" role="dialog"
             aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel">Delete Documents</h4>
                    </div>
                    <div class="modal-body">
                        <div style="padding-left: 130px">
                            <p style="font-size: 20px; color: red">Are you sure to delete {{$doc->title}}?</p>
                            <p><strong>Document information:</strong></p>
                            <p><strong>Title: </strong>{{$doc->title}}</p>
                            <p><strong>Type: </strong>{{$doc->type}}</p>
                            <p><strong>Uploaded By: </strong>{{$doc->uploader}}</p>
                            <p><strong>Last Modified
                                    Date: </strong>{{date("m/d/Y H:i:s", strtotime($doc->updated_at))}}
                            </p>
                            <p><strong>Upload Date: </strong>{{date("m/d/Y H:i:s", strtotime($doc->created_at))}}
                            </p>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <a role="button" class="btn btn-danger"
                           href={{ url('/admin/case/doc/'.$doc->id.'/delete') }}>Delete</a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    <!-- end delete doc-->

    <!-- add work history -->
    <div class="modal fade" style="margin-top:10%" id="addworkhistory" tabindex="-1" role="dialog"
         aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Work History</h4>
                </div>
                <div class="modal-body">
                    {!! Form::open(['url' => '/admin/case/workhistory']) !!}
                    {{ csrf_field() }}
                    <div class="form-group" style="display: none; visibility: hidden">
                        {!! Form::text('id', $data->id) !!}
                    </div>
                    <div class="form-group row">
                        {{ Form::label('start_date', 'Start Date', ['class' => 'col-md-2 col-form-label control-label', 'style' => 'padding-top:7px; text-align: right']) }}
                        <div class="col-md-10">
                            {{ Form::text('start_date', null, ['id' => 'start_date1', 'placeholder' => 'Start date', 'class' => 'form-control']) }}
                        </div>
                    </div>
                    <div class="form-group row">
                        {{ Form::label('end_date', 'End Date', ['class' => 'col-md-2 col-form-label control-label', 'style' => 'padding-top:7px; text-align: right']) }}
                        <div class="col-md-10">
                            {{ Form::text('end_date', null, ['id' => 'end_date1', 'placeholder' => 'End date', 'class' => 'form-control']) }}
                        </div>
                    </div>
                    <div class="form-group row">
                        {{ Form::label('industry', 'Industry', ['class' => 'col-md-2 col-form-label control-label', 'style' => 'padding-top:7px; text-align: right']) }}
                        <div class="col-md-10">
                            {{ Form::text('industry', null, ['placeholder' => 'Industry name', 'class' => 'form-control']) }}
                        </div>
                    </div>
                    <div class="form-group row">
                        {{ Form::label('company', 'Company', ['class' => 'col-md-2 col-form-label control-label', 'style' => 'padding-top:7px; text-align: right']) }}
                        <div class="col-md-10">
                            {{ Form::text('company', null, ['placeholder' => 'Company name', 'class' => 'form-control']) }}
                        </div>
                    </div>
                    <div class="form-group row">
                        {{ Form::label('companyaddress', 'Address', ['class' => 'col-md-2 col-form-label control-label', 'style' => 'padding-top:7px; text-align: right']) }}
                        <div class="col-md-10">
                            {{ Form::text('companyaddress', null, ['placeholder' => 'Company address', 'class' => 'form-control']) }}
                        </div>
                    </div>
                    <div class="form-group row">
                        {{ Form::label('stauts', 'Status', ['class' => 'col-md-2 col-form-label control-label', 'style' => 'padding-top:7px; text-align: right']) }}
                        <div class="col-md-10">
                            {{ Form::select('status', ['current' => 'Current', 'past' => 'Past'], null, ['placeholder' => 'Choose status', 'class' => 'form-control']) }}
                        </div>
                    </div>


                </div>
                <div class="modal-footer">
                    <div class="form-group pull-right">
                        {{ Form::submit('Add', ['class' => 'btn btn-primary']) }}
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end add work history -->

    <!-- edit work history-->
    @foreach($workhistorys as $workhistory)
        <div class="modal fade" style="margin-top:10%" id="editworkhistory{{$workhistory->id}}" tabindex="-1"
             role="dialog"
             aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel">Edit Work History</h4>
                    </div>
                    <div class="modal-body">
                        {!! Form::open(['url' => '/admin/case/workhistory/'.$workhistory->id.'/edit']) !!}
                        {{ csrf_field() }}
                        <div class="form-group" style="display: none; visibility: hidden">
                            {!! Form::text('id', $data->id) !!}
                        </div>
                        <div class="form-group row">
                            {{ Form::label('start_date', 'Start Date', ['class' => 'col-md-2 col-form-label control-label', 'style' => 'padding-top:7px; text-align: right']) }}
                            <div class="col-md-10">
                                {{ Form::text('start_date', $workhistory->start_date, ['id' => 'start_date2', 'placeholder' => 'Start date', 'class' => 'form-control']) }}
                            </div>
                        </div>
                        <div class="form-group row">
                            {{ Form::label('end_date', 'End Date', ['class' => 'col-md-2 col-form-label control-label', 'style' => 'padding-top:7px; text-align: right']) }}
                            <div class="col-md-10">
                                {{ Form::text('end_date', $workhistory->end_date, ['id' => 'end_date2', 'placeholder' => 'End date', 'class' => 'form-control']) }}
                            </div>
                        </div>
                        <div class="form-group row">
                            {{ Form::label('industry', 'Industry', ['class' => 'col-md-2 col-form-label control-label', 'style' => 'padding-top:7px; text-align: right']) }}
                            <div class="col-md-10">
                                {{ Form::text('industry', $workhistory->industry, ['placeholder' => 'Industry name', 'class' => 'form-control']) }}
                            </div>
                        </div>
                        <div class="form-group row">
                            {{ Form::label('company', 'Company', ['class' => 'col-md-2 col-form-label control-label', 'style' => 'padding-top:7px; text-align: right']) }}
                            <div class="col-md-10">
                                {{ Form::text('company', $workhistory->company, ['placeholder' => 'Company name', 'class' => 'form-control']) }}
                            </div>
                        </div>
                        <div class="form-group row">
                            {{ Form::label('companyaddress', 'Address', ['class' => 'col-md-2 col-form-label control-label', 'style' => 'padding-top:7px; text-align: right']) }}
                            <div class="col-md-10">
                                {{ Form::text('companyaddress', $workhistory->address, ['placeholder' => 'Company address', 'class' => 'form-control']) }}
                            </div>
                        </div>
                        <div class="form-group row">
                            {{ Form::label('status', 'Status', ['class' => 'col-md-2 col-form-label control-label', 'style' => 'padding-top:7px; text-align: right']) }}
                            <div class="col-md-10">
                                {{ Form::select('status', ['current' => 'Current', 'past' => 'Past'], $workhistory->status, ['placeholder' => 'Choose status', 'class' => 'form-control']) }}
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="form-group pull-right">
                            {{ Form::submit('Save', ['class' => 'btn btn-primary']) }}
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    <!-- end edit work history-->

    <!-- view work history-->
    @foreach($workhistorys as $workhistory)
        <div class="modal fade" style="margin-top:10%" id="viewworkhistory{{$workhistory->id}}" tabindex="-1"
             role="dialog"
             aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel">Work History</h4>
                    </div>
                    <div class="modal-body">
                        {!! Form::open(['url' => '/admin/case/workhistory/'.$workhistory->id.'/edit']) !!}
                        {{ csrf_field() }}
                        <div class="form-group" style="display: none; visibility: hidden">
                            {!! Form::text('id', $data->id) !!}
                        </div>
                        <div class="form-group row">
                            {{ Form::label('start_date', 'Start Date', ['class' => 'col-md-2 col-form-label control-label', 'style' => 'padding-top:7px; text-align: right']) }}
                            <div class="col-md-10">
                                {{ Form::text('start_date', $workhistory->start_date, ['id' => 'start_date2', 'class' => 'form-control', 'disabled']) }}
                            </div>
                        </div>
                        <div class="form-group row">
                            {{ Form::label('end_date', 'End Date', ['class' => 'col-md-2 col-form-label control-label', 'style' => 'padding-top:7px; text-align: right']) }}
                            <div class="col-md-10">
                                {{ Form::text('end_date', $workhistory->end_date, ['id' => 'end_date2', 'class' => 'form-control', 'disabled']) }}
                            </div>
                        </div>
                        <div class="form-group row">
                            {{ Form::label('industry', 'Industry', ['class' => 'col-md-2 col-form-label control-label', 'style' => 'padding-top:7px; text-align: right']) }}
                            <div class="col-md-10">
                                {{ Form::text('industry', $workhistory->industry, ['class' => 'form-control', 'disabled']) }}
                            </div>
                        </div>
                        <div class="form-group row">
                            {{ Form::label('company', 'Company', ['class' => 'col-md-2 col-form-label control-label', 'style' => 'padding-top:7px; text-align: right']) }}
                            <div class="col-md-10">
                                {{ Form::text('company', $workhistory->company, ['class' => 'form-control', 'disabled']) }}
                            </div>
                        </div>
                        <div class="form-group row">
                            {{ Form::label('companyaddress', 'Address', ['class' => 'col-md-2 col-form-label control-label', 'style' => 'padding-top:7px; text-align: right']) }}
                            <div class="col-md-10">
                                {{ Form::text('companyaddress', $workhistory->address, ['class' => 'form-control', 'disabled']) }}
                            </div>
                        </div>
                        <div class="form-group row">
                            {{ Form::label('status', 'Status', ['class' => 'col-md-2 col-form-label control-label', 'style' => 'padding-top:7px; text-align: right']) }}
                            <div class="col-md-10">
                                {{ Form::text('status', $workhistory->status, ['class' => 'form-control', 'disabled']) }}
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="form-group pull-right">
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Exit</button>
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    <!-- end view work history-->

    <!-- delete work history -->
    @foreach($workhistorys as $workhistory)
        <div class="modal fade" style="margin-top:10%" id="deleteworkhistory{{$workhistory->id}}" tabindex="-1"
             role="dialog"
             aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel">Delete Work History</h4>
                    </div>
                    <div class="modal-body">
                        <div style="padding-left: 130px">
                            <p style="font-size: 20px; color: red">Are you sure to delete ?</p>
                            <p><strong>Please confirm work history:</strong></p>
                            <p><strong>Start date: </strong>{{$workhistory->start_date}}</p>
                            <p><strong>End date: </strong>{{$workhistory->end_date}}</p>
                            <p><strong>Company: </strong>{{$workhistory->company}}</p>
                            <p><strong>Industry: </strong>{{$workhistory->industry}}</p>
                            <p><strong>Last Modify
                                    date: </strong>{{date("m/d/Y H:i:s", strtotime($workhistory->updated_at))}}</p>
                            <p><strong>Created
                                    date: </strong>{{date("m/d/Y H:i:s", strtotime($workhistory->created_at))}}</p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <a role="button" class="btn btn-danger"
                           href={{ url('/admin/case/workhistory/'.$workhistory->id.'/delete') }}>Delete</a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    <!-- end delete work history-->

    <!-- add edu history -->
    <div class="modal fade" style="margin-top:10%" id="addeduhistory" tabindex="-1" role="dialog"
         aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Education History</h4>
                </div>
                <div class="modal-body">
                    {!! Form::open(['url' => '/admin/case/eduhistory']) !!}
                    {{ csrf_field() }}
                    <div class="form-group" style="display: none; visibility: hidden">
                        {!! Form::text('id', $data->id) !!}
                    </div>
                    <div class="form-group row">
                        {{ Form::label('start_date', 'Start Date', ['class' => 'col-md-2 col-form-label control-label', 'style' => 'padding-top:7px; text-align: right']) }}
                        <div class="col-md-10">
                            {{ Form::text('start_date', null, ['id' => 'start_date_edu1', 'placeholder' => 'Start date', 'class' => 'form-control']) }}
                        </div>
                    </div>
                    <div class="form-group row">
                        {{ Form::label('end_date', 'End Date', ['class' => 'col-md-2 col-form-label control-label', 'style' => 'padding-top:7px; text-align: right']) }}
                        <div class="col-md-10">
                            {{ Form::text('end_date', null, ['id' => 'end_date_edu1', 'placeholder' => 'End date', 'class' => 'form-control']) }}
                        </div>
                    </div>
                    <div class="form-group row">
                        {{ Form::label('school', 'School', ['class' => 'col-md-2 col-form-label control-label', 'style' => 'padding-top:7px; text-align: right']) }}
                        <div class="col-md-10">
                            {{ Form::text('school', null, ['placeholder' => 'School name', 'class' => 'form-control']) }}
                        </div>
                    </div>
                    <div class="form-group row">
                        {{ Form::label('level', 'Level', ['class' => 'col-md-2 col-form-label control-label', 'style' => 'padding-top:7px; text-align: right']) }}
                        <div class="col-md-10">
                            {{ Form::text('level', null, ['placeholder' => 'Level', 'class' => 'form-control']) }}
                        </div>
                    </div>
                    <div class="form-group row">
                        {{ Form::label('schooladdress', 'Address', ['class' => 'col-md-2 col-form-label control-label', 'style' => 'padding-top:7px; text-align: right']) }}
                        <div class="col-md-10">
                            {{ Form::text('schooladdress', null, ['placeholder' => 'School address', 'class' => 'form-control']) }}
                        </div>
                    </div>
                    <div class="form-group row">
                        {{ Form::label('stauts', 'Status', ['class' => 'col-md-2 col-form-label control-label', 'style' => 'padding-top:7px; text-align: right']) }}
                        <div class="col-md-10">
                            {{ Form::select('status', ['current' => 'Current', 'past' => 'Past'], null, ['placeholder' => 'Choose status', 'class' => 'form-control']) }}
                        </div>
                    </div>


                </div>
                <div class="modal-footer">
                    <div class="form-group pull-right">
                        {{ Form::submit('Add', ['class' => 'btn btn-primary']) }}
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end add edu history -->

    <!-- edit edu history-->
    @foreach($eduhistorys as $eduhistory)
        <div class="modal fade" style="margin-top:10%" id="editeduhistory{{$eduhistory->id}}" tabindex="-1"
             role="dialog"
             aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel">Edit Education History</h4>
                    </div>
                    <div class="modal-body">
                        {!! Form::open(['url' => '/admin/case/eduhistory/'.$eduhistory->id.'/edit']) !!}
                        {{ csrf_field() }}
                        <div class="form-group" style="display: none; visibility: hidden">
                            {!! Form::text('id', $data->id) !!}
                        </div>
                        <div class="form-group row">
                            {{ Form::label('start_date', 'Start Date', ['class' => 'col-md-2 col-form-label control-label', 'style' => 'padding-top:7px; text-align: right']) }}
                            <div class="col-md-10">
                                {{ Form::text('start_date', $eduhistory->start_date, ['id' => 'start_date_edu2', 'placeholder' => 'Start date', 'class' => 'form-control']) }}
                            </div>
                        </div>
                        <div class="form-group row">
                            {{ Form::label('end_date', 'End Date', ['class' => 'col-md-2 col-form-label control-label', 'style' => 'padding-top:7px; text-align: right']) }}
                            <div class="col-md-10">
                                {{ Form::text('end_date', $eduhistory->end_date, ['id' => 'end_date_edu2', 'placeholder' => 'End date', 'class' => 'form-control']) }}
                            </div>
                        </div>
                        <div class="form-group row">
                            {{ Form::label('school', 'School', ['class' => 'col-md-2 col-form-label control-label', 'style' => 'padding-top:7px; text-align: right']) }}
                            <div class="col-md-10">
                                {{ Form::text('school', $eduhistory->school, ['placeholder' => 'School name', 'class' => 'form-control']) }}
                            </div>
                        </div>
                        <div class="form-group row">
                            {{ Form::label('level', 'Level', ['class' => 'col-md-2 col-form-label control-label', 'style' => 'padding-top:7px; text-align: right']) }}
                            <div class="col-md-10">
                                {{ Form::text('level', $eduhistory->level, ['placeholder' => 'Level', 'class' => 'form-control']) }}
                            </div>
                        </div>
                        <div class="form-group row">
                            {{ Form::label('schooladdress', 'Address', ['class' => 'col-md-2 col-form-label control-label', 'style' => 'padding-top:7px; text-align: right']) }}
                            <div class="col-md-10">
                                {{ Form::text('schooladdress', $eduhistory->address, ['placeholder' => 'School address', 'class' => 'form-control']) }}
                            </div>
                        </div>
                        <div class="form-group row">
                            {{ Form::label('status', 'Status', ['class' => 'col-md-2 col-form-label control-label', 'style' => 'padding-top:7px; text-align: right']) }}
                            <div class="col-md-10">
                                {{ Form::select('status', ['current' => 'Current', 'past' => 'Past'], $eduhistory->status, ['placeholder' => 'Choose status', 'class' => 'form-control']) }}
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="form-group pull-right">
                            {{ Form::submit('Save', ['class' => 'btn btn-primary']) }}
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    <!-- end edit edu history-->

    <!-- view edu history-->
    @foreach($eduhistorys as $eduhistory)
        <div class="modal fade" style="margin-top:10%" id="vieweduhistory{{$eduhistory->id}}" tabindex="-1"
             role="dialog"
             aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel">Education History</h4>
                    </div>
                    <div class="modal-body">
                        {!! Form::open(['url' => '/admin/case/eduhistory/'.$eduhistory->id.'/edit']) !!}
                        {{ csrf_field() }}
                        <div class="form-group" style="display: none; visibility: hidden">
                            {!! Form::text('id', $data->id) !!}
                        </div>
                        <div class="form-group row">
                            {{ Form::label('start_date', 'Start Date', ['class' => 'col-md-2 col-form-label control-label', 'style' => 'padding-top:7px; text-align: right']) }}
                            <div class="col-md-10">
                                {{ Form::text('start_date', $eduhistory->start_date, ['id' => 'start_date_edu2', 'class' => 'form-control', 'disabled']) }}
                            </div>
                        </div>
                        <div class="form-group row">
                            {{ Form::label('end_date', 'End Date', ['class' => 'col-md-2 col-form-label control-label', 'style' => 'padding-top:7px; text-align: right']) }}
                            <div class="col-md-10">
                                {{ Form::text('end_date', $eduhistory->end_date, ['id' => 'end_date_edu2', 'class' => 'form-control', 'disabled']) }}
                            </div>
                        </div>
                        <div class="form-group row">
                            {{ Form::label('school', 'School', ['class' => 'col-md-2 col-form-label control-label', 'style' => 'padding-top:7px; text-align: right']) }}
                            <div class="col-md-10">
                                {{ Form::text('school', $eduhistory->school, ['class' => 'form-control', 'disabled']) }}
                            </div>
                        </div>
                        <div class="form-group row">
                            {{ Form::label('level', 'Level', ['class' => 'col-md-2 col-form-label control-label', 'style' => 'padding-top:7px; text-align: right']) }}
                            <div class="col-md-10">
                                {{ Form::text('level', $eduhistory->level, ['class' => 'form-control', 'disabled']) }}
                            </div>
                        </div>
                        <div class="form-group row">
                            {{ Form::label('schooladdress', 'Address', ['class' => 'col-md-2 col-form-label control-label', 'style' => 'padding-top:7px; text-align: right']) }}
                            <div class="col-md-10">
                                {{ Form::text('schooladdress', $eduhistory->address, ['class' => 'form-control', 'disabled']) }}
                            </div>
                        </div>
                        <div class="form-group row">
                            {{ Form::label('status', 'Status', ['class' => 'col-md-2 col-form-label control-label', 'style' => 'padding-top:7px; text-align: right']) }}
                            <div class="col-md-10">
                                {{ Form::text('status', $eduhistory->status, ['class' => 'form-control', 'disabled']) }}
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="form-group pull-right">
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Exit</button>
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    <!-- end view edu history-->

    <!-- delete edu history -->
    @foreach($eduhistorys as $eduhistory)
        <div class="modal fade" style="margin-top:10%" id="deleteeduhistory{{$eduhistory->id}}" tabindex="-1"
             role="dialog"
             aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel">Delete Education History</h4>
                    </div>
                    <div class="modal-body">
                        <div style="padding-left: 130px">
                            <p style="font-size: 20px; color: red">Are you sure to delete ?</p>
                            <p><strong>Please confirm education history:</strong></p>
                            <p><strong>Start date: </strong>{{$eduhistory->start_date}}</p>
                            <p><strong>End date: </strong>{{$eduhistory->end_date}}</p>
                            <p><strong>School: </strong>{{$eduhistory->school}}</p>
                            <p><strong>Level: </strong>{{$eduhistory->level}}</p>
                            <p><strong>Last Modify
                                    date: </strong>{{date("m/d/Y H:i:s", strtotime($eduhistory->updated_at))}}</p>
                            <p><strong>Created
                                    date: </strong>{{date("m/d/Y H:i:s", strtotime($eduhistory->created_at))}}</p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <a role="button" class="btn btn-danger"
                           href={{ url('/admin/case/eduhistory/'.$eduhistory->id.'/delete') }}>Delete</a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    <!-- end delete edu history-->

    <!-- add additional contact -->
    <div class="modal fade" style="margin-top:10%" id="addcontact" tabindex="-1" role="dialog"
         aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="">Additional Contacts</h4>
                </div>
                <div class="modal-body">
                    {!! Form::open(['url' => '/admin/case/addcontacts']) !!}
                    {{ csrf_field() }}
                    <div class="form-group" style="display: none; visibility: hidden">
                        {!! Form::text('id', $data->id) !!}
                    </div>
                    <div class="form-group row">
                        {{ Form::label('name', 'Name', ['class' => 'col-md-2 col-form-label control-label', 'style' => 'padding-top:7px; text-align: right']) }}
                        <div class="col-md-10">
                            {{ Form::text('name', null, ['placeholder' => 'Firstname Lastname', 'class' => 'form-control']) }}
                        </div>
                    </div>
                    <div class="form-group row">
                        {{ Form::label('relationship', 'Relationship', ['class' => 'col-md-2 col-form-label control-label', 'style' => 'padding-top:7px; text-align: right']) }}
                        <div class="col-md-10">
                            {{ Form::text('relationship', null, ['placeholder' => 'Relationship', 'class' => 'form-control']) }}
                        </div>
                    </div>
                    <div class="form-group row">
                        {{ Form::label('phone', 'Phone', ['class' => 'col-md-2 col-form-label control-label', 'style' => 'padding-top:7px; text-align: right']) }}
                        <div class="col-md-10">
                            {{ Form::text('phone', null, ['placeholder' => '123-456-7890', 'class' => 'form-control']) }}
                        </div>
                    </div>
                    <div class="form-group row">
                        {{ Form::label('email', 'Email', ['class' => 'col-md-2 col-form-label control-label', 'style' => 'padding-top:7px; text-align: right']) }}
                        <div class="col-md-10">
                            {{ Form::email('email', null, ['placeholder' => 'email@email.com', 'class' => 'form-control']) }}
                        </div>
                    </div>
                    <div class="form-group row">
                        {{ Form::label('address', 'Address', ['class' => 'col-md-2 col-form-label control-label', 'style' => 'padding-top:7px; text-align: right']) }}
                        <div class="col-md-10">
                            {{ Form::text('address', null, ['placeholder' => 'Address', 'class' => 'form-control']) }}
                        </div>
                    </div>
                    <div class="form-group row">
                        {{ Form::label('stauts', 'Status', ['class' => 'col-md-2 col-form-label control-label', 'style' => 'padding-top:7px; text-align: right']) }}
                        <div class="col-md-10">
                            {{ Form::text('status', null, ['placeholder' => 'Status', 'class' => 'form-control']) }}
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="form-group pull-right">
                        {{ Form::submit('Add', ['class' => 'btn btn-primary']) }}
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end add additional contact-->

    <!-- view additional contact-->
    @foreach($addcontacts as $addcontact)
        <div class="modal fade" style="margin-top:10%" id="viewaddcontact{{$addcontact->id}}" tabindex="-1"
             role="dialog"
             aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title" id="">Additional Contact</h4>
                    </div>
                    <div class="modal-body">
                        {!! Form::open(['url' => '/admin/case/addcontacts']) !!}
                        {{ csrf_field() }}
                        <div class="form-group" style="display: none; visibility: hidden">
                            {!! Form::text('id', $data->id) !!}
                        </div>

                        <div class="form-group row">
                            {{ Form::label('name', 'Name', ['class' => 'col-md-2 col-form-label control-label', 'style' => 'padding-top:7px; text-align: right']) }}
                            <div class="col-md-10">
                                {{ Form::text('name', $addcontact->name, ['class' => 'form-control', 'disabled']) }}
                            </div>
                        </div>
                        <div class="form-group row">
                            {{ Form::label('relationship', 'Relationship', ['class' => 'col-md-2 col-form-label control-label', 'style' => 'padding-top:7px; text-align: right']) }}
                            <div class="col-md-10">
                                {{ Form::text('relationship', $addcontact->relationship, ['class' => 'form-control', 'disabled']) }}
                            </div>
                        </div>
                        <div class="form-group row">
                            {{ Form::label('phone', 'Phone', ['class' => 'col-md-2 col-form-label control-label', 'style' => 'padding-top:7px; text-align: right']) }}
                            <div class="col-md-10">
                                {{ Form::text('phone', $addcontact->phone, ['class' => 'form-control', 'disabled']) }}
                            </div>
                        </div>
                        <div class="form-group row">
                            {{ Form::label('email', 'Email', ['class' => 'col-md-2 col-form-label control-label', 'style' => 'padding-top:7px; text-align: right']) }}
                            <div class="col-md-10">
                                {{ Form::text('email', $addcontact->email, ['class' => 'form-control', 'disabled']) }}
                            </div>
                        </div>
                        <div class="form-group row">
                            {{ Form::label('address', 'Address', ['class' => 'col-md-2 col-form-label control-label', 'style' => 'padding-top:7px; text-align: right']) }}
                            <div class="col-md-10">
                                {{ Form::text('address', $addcontact->address, ['class' => 'form-control', 'disabled']) }}
                            </div>
                        </div>
                        <div class="form-group row">
                            {{ Form::label('stauts', 'Status', ['class' => 'col-md-2 col-form-label control-label', 'style' => 'padding-top:7px; text-align: right']) }}
                            <div class="col-md-10">
                                {{ Form::text('status', $addcontact->status, ['class' => 'form-control', 'disabled']) }}
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="form-group pull-right">
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Exit</button>
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    <!-- end view additional contact-->

    <!-- edit additional contact-->
    @foreach($addcontacts as $addcontact)
        <div class="modal fade" style="margin-top:10%" id="editaddcontact{{$addcontact->id}}" tabindex="-1"
             role="dialog"
             aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title" id="">Edit Additional Contact</h4>
                    </div>
                    <div class="modal-body">
                        {!! Form::open(['url' => '/admin/case/addcontacts/'.$addcontact->id.'/edit']) !!}
                        {{ csrf_field() }}
                        <div class="form-group" style="display: none; visibility: hidden">
                            {!! Form::text('id', $data->id) !!}
                        </div>
                        <div class="form-group row">
                            {{ Form::label('name', 'Name', ['class' => 'col-md-2 col-form-label control-label', 'style' => 'padding-top:7px; text-align: right']) }}
                            <div class="col-md-10">
                                {{ Form::text('name', $addcontact->name, ['placeholder' => 'Firstname Lastname', 'class' => 'form-control']) }}
                            </div>
                        </div>
                        <div class="form-group row">
                            {{ Form::label('relationship', 'Relationship', ['class' => 'col-md-2 col-form-label control-label', 'style' => 'padding-top:7px; text-align: right']) }}
                            <div class="col-md-10">
                                {{ Form::text('relationship', $addcontact->relationship, ['placeholder' => 'Relationship', 'class' => 'form-control']) }}
                            </div>
                        </div>
                        <div class="form-group row">
                            {{ Form::label('phone', 'Phone', ['class' => 'col-md-2 col-form-label control-label', 'style' => 'padding-top:7px; text-align: right']) }}
                            <div class="col-md-10">
                                {{ Form::text('phone', $addcontact->phone, ['placeholder' => '+1 213 XXXXXXX', 'class' => 'form-control']) }}
                            </div>
                        </div>
                        <div class="form-group row">
                            {{ Form::label('email', 'Email', ['class' => 'col-md-2 col-form-label control-label', 'style' => 'padding-top:7px; text-align: right']) }}
                            <div class="col-md-10">
                                {{ Form::text('email', $addcontact->email, ['placeholder' => 'xxxx@gmail.com', 'class' => 'form-control']) }}
                            </div>
                        </div>
                        <div class="form-group row">
                            {{ Form::label('address', 'Address', ['class' => 'col-md-2 col-form-label control-label', 'style' => 'padding-top:7px; text-align: right']) }}
                            <div class="col-md-10">
                                {{ Form::text('address', $addcontact->address, ['placeholder' => 'Resident address', 'class' => 'form-control']) }}
                            </div>
                        </div>
                        <div class="form-group row">
                            {{ Form::label('stauts', 'Status', ['class' => 'col-md-2 col-form-label control-label', 'style' => 'padding-top:7px; text-align: right']) }}
                            <div class="col-md-10">
                                {{ Form::text('status', $addcontact->status, ['placeholder' => 'Choose status', 'class' => 'form-control']) }}
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="form-group pull-right">
                            {{ Form::submit('Save', ['class' => 'btn btn-primary']) }}
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    <!-- end edit additional contact-->

    <!-- delete additional contact -->
    @foreach($addcontacts as $addcontact)
        <div class="modal fade" style="margin-top:10%" id="deleteaddcontact{{$addcontact->id}}" tabindex="-1"
             role="dialog"
             aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel">Delete Additional Contact</h4>
                    </div>
                    <div class="modal-body">
                        <div style="padding-left: 130px">
                            <p style="font-size: 20px; color: red">Are you sure to delete ?</p>
                            <p><strong>Please confirm additonal contact:</strong></p>
                            <p><strong>Name: </strong>{{$addcontact->name}}</p>
                            <p><strong>Relationship: </strong>{{$addcontact->relationship}}</p>
                            <p><strong>Phone: </strong>{{$addcontact->phone}}</p>
                            <p><strong>Email: </strong>{{$addcontact->email}}</p>
                            <p><strong>Address: </strong>{{$addcontact->address}}</p>
                            <p><strong>Status: </strong>{{$addcontact->status}}</p>
                            <p><strong>Last Modify
                                    date: </strong>{{date("m/d/Y H:i:s", strtotime($addcontact->updated_at))}}</p>
                            <p><strong>Created
                                    date: </strong>{{date("m/d/Y H:i:s", strtotime($addcontact->created_at))}}</p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <a role="button" class="btn btn-danger"
                           href={{ url('/admin/case/addcontacts/'.$addcontact->id.'/delete') }}>Delete</a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    <!-- end delete additional contact-->

    <!-- edit general information -->
    <div class="modal fade" style="margin-top:10%" id="editProfile" tabindex="-1"
         role="dialog"
         aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Edit General Information</h4>
                </div>
                <div class="modal-body">
                    {!! Form::open(['url' => 'admin/case/'.$data->id.'/edit', 'onsubmit' => 'return check_input(this)']) !!}
                    <div class="form-group" style="display: none; visibility: hidden">
                        {!! Form::text('id', $data->id) !!}
                    </div>
                    <div class="form-group row">
                        {{ Form::label('email', 'Email', ['class' => 'col-md-3 col-form-label control-label', 'style' => 'padding-top:7px; text-align: right']) }}
                        {{--{!! Form::label('Email') !!}--}}
                        <div class="col-md-9">
                            <input type="text" class="form-control" value="{{ $data->email }}" disabled>
                            {{--<span href="#" class="help-block">Want to change email ?</span>--}}
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3 col-form-label control-label" style="padding-top:7px; text-align:right">
                            <span><strong>First Name </strong></span><span style="color: red"><strong>*</strong></span>
                        </div>
                        {{--{!! Form::label('First Name*') !!}--}}
                        <div class="col-md-9">
                            {!! Form::text('first_name', $data->first_name, ['placeholder' => 'First name', 'required' => 'required', 'class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3 col-form-label control-label" style="padding-top:7px; text-align:right">
                            <span><strong>Last Name </strong></span><span style="color: red"><strong>*</strong></span>
                        </div>
                        {{--{!! Form::label('Last Name*') !!}--}}
                        <div class="col-md-9">
                            {!! Form::text('last_name', $data->last_name, ['placeholder' => 'Last name', 'required' => 'required', 'class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        {{ Form::label('dateofbirth', 'Date of Birth', ['class' => 'col-md-3 col-form-label control-label', 'style' => 'padding-top:7px; text-align: right']) }}
                        {{--{!! Form::label('Date of Birth') !!}--}}
                        <div class="col-md-9">
                            {!! Form::text('birthday', date('m/d/Y', strtotime($data->birthday)), ['id' => 'birthday_edit', 'placeholder' => 'mm/dd/yyyy', 'class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        {{ Form::label('gender', 'Gender', ['class' => 'col-md-3 col-form-label control-label', 'style' => 'padding-top:7px; text-align: right']) }}
                        {{--{!! Form::label('Gender') !!}--}}
                        <div class="col-md-9">
                            {!! Form::select('gender', ['Male' => 'Male', 'Female' => 'Female', 'N/A' => 'Decline to State'], $data->gender, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    {{--<div class="form-group row">--}}
                    {{--{{ Form::label('webpage', 'Web Page', ['class' => 'col-md-3 col-form-label control-label', 'style' => 'padding-top:7px; text-align: right']) }}--}}
                    {{--{!! Form::label('Web Page') !!}--}}
                    {{--<div class="col-md-9">--}}
                    {{--{!! Form::text('webpage', $data->webpage, ['Placeholder' => 'Web Page', 'class' => 'form-control']) !!}--}}
                    {{--</div>--}}
                    {{--</div>--}}
                    <div class="form-group row">
                        {{ Form::label('ssn', 'SSN', ['class' => 'col-md-3 col-form-label control-label', 'style' => 'padding-top:7px; text-align: right']) }}
                        {{--{!! Form::label('SSN') !!}--}}
                        <div class="col-md-9">
                            {!! Form::text('ssn', $data->ssn, ['id' => 'ssn', 'Placeholder' => 'AAA-GG-SSSS', 'class' => 'form-control', 'onkeyup' => 'format_ssn(this.value)', 'autocomplete' => 'off']) !!}
                        </div>
                        <div id="cssn" style="display: none; color: red; margin-bottom: -20px;"
                             class="col-md-9 col-md-offset-3">
                            <p>SSN should have 9 digits, format is AAA-GG-SSSS.</p>
                        </div>
                    </div>
                    <div class="form-group row">
                        {{ Form::label('ilp', 'ILP', ['class' => 'col-md-3 col-form-label control-label', 'style' => 'padding-top:7px; text-align: right']) }}
                        {{--{!! Form::label('ILP') !!}--}}
                        <div class="col-md-9">
                            {!! Form::select('ilp', ['1' => 'Yes', '0' => 'No'], null, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        {{ Form::label('ethnicity', 'Ethnicity', ['class' => 'col-md-3 col-form-label control-label', 'style' => 'padding-top:7px; text-align: right']) }}
                        {{--{!! Form::label('Ethnicity') !!}--}}
                        <div class="col-md-9">
                            {!! Form::select('ethnicity', ['Asian' => 'Asian', 'African American' => 'African American', 'Caucasian' => 'Caucasian', 'Latino' => 'Latino', 'Multiracial' => 'Multiracial', 'Native American' => 'Native American'], $data->ethnicity, ['placeholder' => 'Choose your ethnicity...', 'class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        {{ Form::label('program', 'Program', ['class' => 'col-md-3 col-form-label control-label', 'style' => 'padding-top:7px; text-align: right']) }}
                        {{--{!! Form::label('Program') !!}--}}
                        <div class="col-md-9">
                            {!! Form::select('program', $program_name, $data->program, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        {{ Form::label('manager', 'Manager', ['class' => 'col-md-3 col-form-label control-label', 'style' => 'padding-top:7px; text-align: right']) }}
                        {{--{!! Form::label('Case Manager') !!}--}}
                        <div class="col-md-9">
                            {!! Form::select('cm_name', $all_list, $data->cm_id, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="form-group pull-right">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        {{ Form::submit('Save', ['class' => 'btn btn-primary']) }}
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end edit general information -->


    <!-- add contact information -->
    <div class="modal fade" style="margin-top:10%" id="addcontactinfo" tabindex="-1" role="dialog"
         aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="">Contact Information</h4>
                </div>
                <div class="modal-body">
                    {!! Form::open(['url' => '/admin/case/addcontactinfo']) !!}
                    {{ csrf_field() }}
                    <div class="form-group" style="display: none; visibility: hidden">
                        {!! Form::text('id', $data->id) !!}
                    </div>
                    <h4>Address</h4>
                    <div class="form-group row">
                        {{ Form::label('address', 'Address', ['class' => 'col-md-2 col-form-label control-label', 'style' => 'padding-top:7px; text-align: right']) }}
                        <div class="col-md-10">
                            {{ Form::text('address', null, ['placeholder' => 'Address', 'class' => 'form-control']) }}
                        </div>
                    </div>
                    <div class="form-group row">
                        {{ Form::label('city', 'City', ['class' => 'col-md-2 col-form-label control-label', 'style' => 'padding-top:7px; text-align: right']) }}
                        <div class="col-md-10">
                            {{ Form::text('city', null, ['placeholder' => 'City', 'class' => 'form-control']) }}
                        </div>
                    </div>
                    <div class="form-group row">
                        {{ Form::label('state', 'State', ['class' => 'col-md-2 col-form-label control-label', 'style' => 'padding-top:7px; text-align: right']) }}
                        <div class="col-md-10">
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
                'WY' => 'WY'], null, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        {{ Form::label('zipcode', 'Zip', ['class' => 'col-md-2 col-form-label control-label', 'style' => 'padding-top:7px; text-align: right']) }}
                        <div class="col-md-10">
                            {{ Form::text('zipcode', null, ['placeholder' => '90000', 'class' => 'form-control']) }}
                        </div>
                    </div>
                    <div class="form-group row">
                        {{ Form::label('address_status', 'Status', ['class' => 'col-md-2 col-form-label control-label', 'style' => 'padding-top:7px; text-align: right']) }}
                        <div class="col-md-10">
                            {{ Form::text('address_status', null, ['placeholder' => 'Status', 'class' => 'form-control']) }}
                        </div>
                    </div>
                    <hr>
                    <h4>Phone</h4>
                    <div class="form-group row">
                        {{ Form::label('phone', 'Phone', ['class' => 'col-md-2 col-form-label control-label', 'style' => 'padding-top:7px; text-align: right']) }}
                        <div class="col-md-10">
                            {{ Form::text('number', null, ['placeholder' => '123-456-7890', 'class' => 'form-control']) }}
                        </div>
                    </div>
                    <div class="form-group row">
                        {{ Form::label('type', 'Type', ['class' => 'col-md-2 col-form-label control-label', 'style' => 'padding-top:7px; text-align: right']) }}
                        <div class="col-md-10">
                            {{ Form::text('type', null, ['placeholder' => 'Type', 'class' => 'form-control']) }}
                        </div>
                    </div>
                    <div class="form-group row">
                        {{ Form::label('phone_status', 'Status', ['class' => 'col-md-2 col-form-label control-label', 'style' => 'padding-top:7px; text-align: right']) }}
                        <div class="col-md-10">
                            {{ Form::text('phone_status', null, ['placeholder' => 'Status', 'class' => 'form-control']) }}
                        </div>
                    </div>
                    <hr>
                    <h4>Email</h4>
                    <div class="form-group row">
                        {{ Form::label('email', 'Email', ['class' => 'col-md-2 col-form-label control-label', 'style' => 'padding-top:7px; text-align: right']) }}
                        <div class="col-md-10">
                            {{ Form::email('email', null, ['placeholder' => 'email@email.com', 'class' => 'form-control']) }}
                        </div>
                    </div>
                    <div class="form-group row">
                        {{ Form::label('email_status', 'Status', ['class' => 'col-md-2 col-form-label control-label', 'style' => 'padding-top:7px; text-align: right']) }}
                        <div class="col-md-10">
                            {{ Form::text('email_status', null, ['placeholder' => 'Status', 'class' => 'form-control']) }}
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="form-group pull-right">
                        {{ Form::submit('Save', ['class' => 'btn btn-primary']) }}
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end new add contact information -->

    {{--<!-- add contact information -->--}}
    {{--<div class="modal fade" style="margin-top:10%" id="addcontactinfo" tabindex="-1" role="dialog"--}}
    {{--aria-labelledby="myModalLabel" aria-hidden="true">--}}
    {{--<div class="modal-dialog" role="document">--}}
    {{--<div class="modal-content">--}}
    {{--<div class="modal-header">--}}
    {{--<button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
    {{--<span aria-hidden="true">&times;</span>--}}
    {{--</button>--}}
    {{--<h4 class="modal-title" id="">Contact Information</h4>--}}
    {{--</div>--}}
    {{--<div class="modal-body">--}}
    {{--<div class="panel panel-default">--}}
    {{--<ul class="nav tab-menu nav-tabs" id="myTab">--}}
    {{--<li class="active"><a href="#contact_address">Address</a></li>--}}
    {{--<li><a href="#contact_phone">Phone</a></li>--}}
    {{--<li><a href="#contact_email">Email</a></li>--}}
    {{--</ul>--}}
    {{--<div class="panel-body">--}}
    {{--<div id="myTabContent" class="tab-content">--}}
    {{--<div class="tab-pane active" id="contact_address">--}}
    {{--{!! Form::open(['url' => '/admin/case/addaddress']) !!}--}}
    {{--{{ csrf_field() }}--}}
    {{--<div class="form-group" style="display: none; visibility: hidden">--}}
    {{--{!! Form::text('id', $data->id) !!}--}}
    {{--</div>--}}
    {{--<div class="form-group row">--}}
    {{--{{ Form::label('address', 'Address', ['class' => 'col-md-2 col-form-label control-label', 'style' => 'padding-top:7px; text-align: right']) }}--}}
    {{--<div class="col-md-10">--}}
    {{--{{ Form::text('address', null, ['placeholder' => 'Address', 'class' => 'form-control']) }}--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--<div class="form-group row">--}}
    {{--{{ Form::label('city', 'City', ['class' => 'col-md-2 col-form-label control-label', 'style' => 'padding-top:7px; text-align: right']) }}--}}
    {{--<div class="col-md-10">--}}
    {{--{{ Form::text('city', null, ['placeholder' => 'City', 'class' => 'form-control']) }}--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--<div class="form-group row">--}}
    {{--{{ Form::label('state', 'State', ['class' => 'col-md-2 col-form-label control-label', 'style' => 'padding-top:7px; text-align: right']) }}--}}
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
    {{--'WY' => 'WY'], null, ['class' => 'form-control']) !!}--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--<div class="form-group row">--}}
    {{--{{ Form::label('zipcode', 'Zip', ['class' => 'col-md-2 col-form-label control-label', 'style' => 'padding-top:7px; text-align: right']) }}--}}
    {{--<div class="col-md-10">--}}
    {{--{{ Form::text('zipcode', null, ['placeholder' => '90000', 'class' => 'form-control']) }}--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--<div class="form-group row">--}}
    {{--{{ Form::label('status', 'Status', ['class' => 'col-md-2 col-form-label control-label', 'style' => 'padding-top:7px; text-align: right']) }}--}}
    {{--<div class="col-md-10">--}}
    {{--{{ Form::text('status', null, ['placeholder' => 'Status', 'class' => 'form-control']) }}--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--<div class="form-group pull-right">--}}
    {{--{{ Form::submit('Save', ['class' => 'btn btn-primary']) }}--}}
    {{--{{ Form::close() }}--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--<div class="tab-pane" id="contact_phone">--}}
    {{--{!! Form::open(['url' => '/admin/case/addphone']) !!}--}}
    {{--{{ csrf_field() }}--}}
    {{--<div class="form-group" style="display: none; visibility: hidden">--}}
    {{--{!! Form::text('id', $data->id) !!}--}}
    {{--</div>--}}
    {{--<div class="form-group row">--}}
    {{--{{ Form::label('phone', 'Phone', ['class' => 'col-md-2 col-form-label control-label', 'style' => 'padding-top:7px; text-align: right']) }}--}}
    {{--<div class="col-md-10">--}}
    {{--{{ Form::text('number', null, ['placeholder' => '123-456-7890', 'class' => 'form-control']) }}--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--<div class="form-group row">--}}
    {{--{{ Form::label('type', 'Type', ['class' => 'col-md-2 col-form-label control-label', 'style' => 'padding-top:7px; text-align: right']) }}--}}
    {{--<div class="col-md-10">--}}
    {{--{{ Form::text('type', null, ['placeholder' => 'Type', 'class' => 'form-control']) }}--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--<div class="form-group row">--}}
    {{--{{ Form::label('status', 'Status', ['class' => 'col-md-2 col-form-label control-label', 'style' => 'padding-top:7px; text-align: right']) }}--}}
    {{--<div class="col-md-10">--}}
    {{--{{ Form::text('status', null, ['placeholder' => 'Status', 'class' => 'form-control']) }}--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--<div class="form-group pull-right">--}}
    {{--{{ Form::submit('Save', ['class' => 'btn btn-primary']) }}--}}
    {{--{{ Form::close() }}--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--<div class="tab-pane" id="contact_email">--}}
    {{--{!! Form::open(['url' => '/admin/case/addemail']) !!}--}}
    {{--{{ csrf_field() }}--}}
    {{--<div class="form-group" style="display: none; visibility: hidden">--}}
    {{--{!! Form::text('id', $data->id) !!}--}}
    {{--</div>--}}
    {{--<div class="form-group row">--}}
    {{--{{ Form::label('email', 'Email', ['class' => 'col-md-2 col-form-label control-label', 'style' => 'padding-top:7px; text-align: right']) }}--}}
    {{--<div class="col-md-10">--}}
    {{--{{ Form::email('email', null, ['placeholder' => 'email@email.com', 'class' => 'form-control']) }}--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--<div class="form-group row">--}}
    {{--{{ Form::label('status', 'Status', ['class' => 'col-md-2 col-form-label control-label', 'style' => 'padding-top:7px; text-align: right']) }}--}}
    {{--<div class="col-md-10">--}}
    {{--{{ Form::text('status', null, ['placeholder' => 'Status', 'class' => 'form-control']) }}--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--<div class="form-group pull-right">--}}
    {{--{{ Form::submit('Save', ['class' => 'btn btn-primary']) }}--}}
    {{--{{ Form::close() }}--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--<!-- end new add contact information -->--}}

    <!-- old add contact information -->
    {{--<!-- address -->--}}
    {{--<div class="modal fade" style="margin-top:10%" id="addaddress" tabindex="-1" role="dialog"--}}
    {{--aria-labelledby="myModalLabel" aria-hidden="true">--}}
    {{--<div class="modal-dialog" role="document">--}}
    {{--<div class="modal-content">--}}
    {{--<div class="modal-header">--}}
    {{--<button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
    {{--<span aria-hidden="true">&times;</span>--}}
    {{--</button>--}}
    {{--<h4 class="modal-title" id="">Add Address</h4>--}}
    {{--</div>--}}
    {{--<div class="modal-body">--}}
    {{--{!! Form::open(['url' => '/admin/case/addaddress']) !!}--}}
    {{--{{ csrf_field() }}--}}
    {{--<div class="form-group" style="display: none; visibility: hidden">--}}
    {{--{!! Form::text('id', $data->id) !!}--}}
    {{--</div>--}}
    {{--<div class="form-group row">--}}
    {{--{{ Form::label('address', 'Address', ['class' => 'col-md-2 col-form-label control-label', 'style' => 'padding-top:7px; text-align: right']) }}--}}
    {{--<div class="col-md-10">--}}
    {{--{{ Form::text('address', null, ['placeholder' => 'Address', 'class' => 'form-control']) }}--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--<div class="form-group row">--}}
    {{--{{ Form::label('city', 'City', ['class' => 'col-md-2 col-form-label control-label', 'style' => 'padding-top:7px; text-align: right']) }}--}}
    {{--<div class="col-md-10">--}}
    {{--{{ Form::text('city', null, ['placeholder' => 'Relationship', 'class' => 'form-control']) }}--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--<div class="form-group row">--}}
    {{--{{ Form::label('state', 'State', ['class' => 'col-md-2 col-form-label control-label', 'style' => 'padding-top:7px; text-align: right']) }}--}}
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
    {{--'WY' => 'WY'], null, ['placeholder' => 'Choose state code...','class' => 'form-control']) !!}--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--<div class="form-group row">--}}
    {{--{{ Form::label('zipcode', 'Zip', ['class' => 'col-md-2 col-form-label control-label', 'style' => 'padding-top:7px; text-align: right']) }}--}}
    {{--<div class="col-md-10">--}}
    {{--{{ Form::text('zipcode', null, ['placeholder' => '90000', 'class' => 'form-control']) }}--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--<div class="form-group row">--}}
    {{--{{ Form::label('status', 'Status', ['class' => 'col-md-2 col-form-label control-label', 'style' => 'padding-top:7px; text-align: right']) }}--}}
    {{--<div class="col-md-10">--}}
    {{--{{ Form::text('status', null, ['placeholder' => 'Input status', 'class' => 'form-control']) }}--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--<div class="modal-footer">--}}
    {{--<div class="form-group pull-right">--}}
    {{--{{ Form::submit('Add', ['class' => 'btn btn-primary']) }}--}}
    {{--{{ Form::close() }}--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--<!-- phone -->--}}
    {{--<div class="modal fade" style="margin-top:10%" id="addphone" tabindex="-1" role="dialog"--}}
    {{--aria-labelledby="myModalLabel" aria-hidden="true">--}}
    {{--<div class="modal-dialog" role="document">--}}
    {{--<div class="modal-content">--}}
    {{--<div class="modal-header">--}}
    {{--<button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
    {{--<span aria-hidden="true">&times;</span>--}}
    {{--</button>--}}
    {{--<h4 class="modal-title" id="">Add Phone</h4>--}}
    {{--</div>--}}
    {{--<div class="modal-body">--}}
    {{--{!! Form::open(['url' => '/admin/case/addphone']) !!}--}}
    {{--{{ csrf_field() }}--}}
    {{--<div class="form-group" style="display: none; visibility: hidden">--}}
    {{--{!! Form::text('id', $data->id) !!}--}}
    {{--</div>--}}
    {{--<div class="form-group row">--}}
    {{--{{ Form::label('number', 'Number', ['class' => 'col-md-2 col-form-label control-label', 'style' => 'padding-top:7px; text-align: right']) }}--}}
    {{--<div class="col-md-10">--}}
    {{--{{ Form::text('number', null, ['placeholder' => 'Phone Number', 'class' => 'form-control']) }}--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--<div class="form-group row">--}}
    {{--{{ Form::label('type', 'Type', ['class' => 'col-md-2 col-form-label control-label', 'style' => 'padding-top:7px; text-align: right']) }}--}}
    {{--<div class="col-md-10">--}}
    {{--{{ Form::text('type', null, ['placeholder' => 'Type', 'class' => 'form-control']) }}--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--<div class="form-group row">--}}
    {{--{{ Form::label('status', 'Status', ['class' => 'col-md-2 col-form-label control-label', 'style' => 'padding-top:7px; text-align: right']) }}--}}
    {{--<div class="col-md-10">--}}
    {{--{{ Form::text('status', null, ['placeholder' => 'Input status', 'class' => 'form-control']) }}--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--<div class="modal-footer">--}}
    {{--<div class="form-group pull-right">--}}
    {{--{{ Form::submit('Add', ['class' => 'btn btn-primary']) }}--}}
    {{--{{ Form::close() }}--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--<!-- email -->--}}
    {{--<div class="modal fade" style="margin-top:10%" id="addemail" tabindex="-1" role="dialog"--}}
    {{--aria-labelledby="myModalLabel" aria-hidden="true">--}}
    {{--<div class="modal-dialog" role="document">--}}
    {{--<div class="modal-content">--}}
    {{--<div class="modal-header">--}}
    {{--<button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
    {{--<span aria-hidden="true">&times;</span>--}}
    {{--</button>--}}
    {{--<h4 class="modal-title" id="">Add Email</h4>--}}
    {{--</div>--}}
    {{--<div class="modal-body">--}}
    {{--{!! Form::open(['url' => '/admin/case/addemail']) !!}--}}
    {{--{{ csrf_field() }}--}}
    {{--<div class="form-group" style="display: none; visibility: hidden">--}}
    {{--{!! Form::text('id', $data->id) !!}--}}
    {{--</div>--}}
    {{--<div class="form-group row">--}}
    {{--{{ Form::label('email', 'Email', ['class' => 'col-md-2 col-form-label control-label', 'style' => 'padding-top:7px; text-align: right']) }}--}}
    {{--<div class="col-md-10">--}}
    {{--{{ Form::text('email', null, ['placeholder' => 'Email', 'class' => 'form-control']) }}--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--<div class="form-group row">--}}
    {{--{{ Form::label('status', 'Status', ['class' => 'col-md-2 col-form-label control-label', 'style' => 'padding-top:7px; text-align: right']) }}--}}
    {{--<div class="col-md-10">--}}
    {{--{{ Form::text('status', null, ['placeholder' => 'Input status', 'class' => 'form-control']) }}--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--<div class="modal-footer">--}}
    {{--<div class="form-group pull-right">--}}
    {{--{{ Form::submit('Add', ['class' => 'btn btn-primary']) }}--}}
    {{--{{ Form::close() }}--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    <!-- end old add contact information-->

    <!-- edit contact information -->
    <!-- address -->
    @foreach($case_address as $address)
        <div class="modal fade" style="margin-top:10%" id="editaddress{{$address->id}}" tabindex="-1" role="dialog"
             aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title" id="">Edit Address</h4>
                    </div>
                    <div class="modal-body">
                        {!! Form::open(['url' => '/admin/case/contact/address/'.$address->id.'/edit']) !!}
                        {{ csrf_field() }}
                        <div class="form-group" style="display: none; visibility: hidden">
                            {!! Form::text('id', $data->id) !!}
                        </div>
                        <div class="form-group row">
                            {{ Form::label('address', 'Address', ['class' => 'col-md-2 col-form-label control-label', 'style' => 'padding-top:7px; text-align: right']) }}
                            <div class="col-md-10">
                                {{ Form::text('address', $address->address, ['placeholder' => 'Address', 'class' => 'form-control']) }}
                            </div>
                        </div>
                        <div class="form-group row">
                            {{ Form::label('city', 'City', ['class' => 'col-md-2 col-form-label control-label', 'style' => 'padding-top:7px; text-align: right']) }}
                            <div class="col-md-10">
                                {{ Form::text('city', $address->city, ['placeholder' => 'Relationship', 'class' => 'form-control']) }}
                            </div>
                        </div>
                        <div class="form-group row">
                            {{ Form::label('state', 'State', ['class' => 'col-md-2 col-form-label control-label', 'style' => 'padding-top:7px; text-align: right']) }}
                            <div class="col-md-10">
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
                    'WY' => 'WY'], $address->state, ['placeholder' => 'Choose state code...','class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="form-group row">
                            {{ Form::label('zipcode', 'Zip', ['class' => 'col-md-2 col-form-label control-label', 'style' => 'padding-top:7px; text-align: right']) }}
                            <div class="col-md-10">
                                {{ Form::text('zipcode', $address->zipcode, ['placeholder' => '90000', 'class' => 'form-control']) }}
                            </div>
                        </div>
                        <div class="form-group row">
                            {{ Form::label('status', 'Status', ['class' => 'col-md-2 col-form-label control-label', 'style' => 'padding-top:7px; text-align: right']) }}
                            <div class="col-md-10">
                                {{ Form::text('status', $address->status, ['placeholder' => 'Input status', 'class' => 'form-control']) }}
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="form-group pull-right">
                            {{ Form::submit('Save', ['class' => 'btn btn-primary']) }}
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    <!-- phone -->
    @foreach($case_phone as $phone)
        <div class="modal fade" style="margin-top:10%" id="editphone{{$phone->id}}" tabindex="-1" role="dialog"
             aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title" id="">Edit Phone</h4>
                    </div>
                    <div class="modal-body">
                        {!! Form::open(['url' => '/admin/case/contact/phone/'.$phone->id.'/edit']) !!}
                        {{ csrf_field() }}
                        <div class="form-group" style="display: none; visibility: hidden">
                            {!! Form::text('id', $data->id) !!}
                        </div>
                        <div class="form-group row">
                            {{ Form::label('phone', 'Phone', ['class' => 'col-md-2 col-form-label control-label', 'style' => 'padding-top:7px; text-align: right']) }}
                            <div class="col-md-10">
                                {{ Form::text('number', $phone->number, ['placeholder' => 'Phone Number', 'class' => 'form-control']) }}
                            </div>
                        </div>
                        <div class="form-group row">
                            {{ Form::label('type', 'Type', ['class' => 'col-md-2 col-form-label control-label', 'style' => 'padding-top:7px; text-align: right']) }}
                            <div class="col-md-10">
                                {{ Form::text('type', $phone->type, ['placeholder' => 'Type', 'class' => 'form-control']) }}
                            </div>
                        </div>
                        <div class="form-group row">
                            {{ Form::label('status', 'Status', ['class' => 'col-md-2 col-form-label control-label', 'style' => 'padding-top:7px; text-align: right']) }}
                            <div class="col-md-10">
                                {{ Form::text('status', $phone->status, ['placeholder' => 'Input status', 'class' => 'form-control']) }}
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="form-group pull-right">
                            {{ Form::submit('Save', ['class' => 'btn btn-primary']) }}
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    <!-- email -->
    @foreach($case_email as $email)
        <div class="modal fade" style="margin-top:10%" id="editemail{{$email->id}}" tabindex="-1" role="dialog"
             aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title" id="">Edit Email</h4>
                    </div>
                    <div class="modal-body">
                        {!! Form::open(['url' => '/admin/case/contact/email/'.$email->id.'/edit']) !!}
                        {{ csrf_field() }}
                        <div class="form-group row">
                            {{ Form::label('email', 'Email', ['class' => 'col-md-2 col-form-label control-label', 'style' => 'padding-top:7px; text-align: right']) }}
                            <div class="col-md-10">
                                {{ Form::text('email', $email->email, ['placeholder' => 'Email', 'class' => 'form-control']) }}
                            </div>
                        </div>
                        <div class="form-group row">
                            {{ Form::label('status', 'Status', ['class' => 'col-md-2 col-form-label control-label', 'style' => 'padding-top:7px; text-align: right']) }}
                            <div class="col-md-10">
                                {{ Form::text('status', $email->status, ['placeholder' => 'Input status', 'class' => 'form-control']) }}
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="form-group pull-right">
                            {{ Form::submit('Save', ['class' => 'btn btn-primary']) }}
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    <!-- end edit contact information -->

    <!-- view contact information -->
    <!-- address -->
    @foreach($case_address as $address)
        <div class="modal fade" style="margin-top:10%" id="viewaddress{{$address->id}}" tabindex="-1" role="dialog"
             aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title" id="">Address</h4>
                    </div>
                    <div class="modal-body">
                        {!! Form::open(['url' => '/admin/case/contact/address/'.$address->id.'/edit']) !!}
                        {{ csrf_field() }}
                        <div class="form-group row">
                            {{ Form::label('address', 'Address', ['class' => 'col-md-2 col-form-label control-label', 'style' => 'padding-top:7px; text-align: right']) }}
                            <div class="col-md-10">
                                {{ Form::text('address', $address->address, ['class' => 'form-control', 'disabled']) }}
                            </div>
                        </div>
                        <div class="form-group row">
                            {{ Form::label('city', 'City', ['class' => 'col-md-2 col-form-label control-label', 'style' => 'padding-top:7px; text-align: right']) }}
                            <div class="col-md-10">
                                {{ Form::text('city', $address->city, ['class' => 'form-control', 'disabled']) }}
                            </div>
                        </div>
                        <div class="form-group row">
                            {{ Form::label('state', 'State', ['class' => 'col-md-2 col-form-label control-label', 'style' => 'padding-top:7px; text-align: right']) }}
                            <div class="col-md-10">
                                {!! Form::text('state', $address->state, ['class' => 'form-control', 'disabled']) !!}
                            </div>
                        </div>
                        <div class="form-group row">
                            {{ Form::label('zipcode', 'Zip', ['class' => 'col-md-2 col-form-label control-label', 'style' => 'padding-top:7px; text-align: right']) }}
                            <div class="col-md-10">
                                {{ Form::text('zipcode', $address->zipcode, ['class' => 'form-control', 'disabled']) }}
                            </div>
                        </div>
                        <div class="form-group row">
                            {{ Form::label('status', 'Status', ['class' => 'col-md-2 col-form-label control-label', 'style' => 'padding-top:7px; text-align: right']) }}
                            <div class="col-md-10">
                                {{ Form::text('status', $address->status, ['class' => 'form-control', 'disabled']) }}
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="form-group pull-right">
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Exit</button>
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    <!-- phone -->
    @foreach($case_phone as $phone)
        <div class="modal fade" style="margin-top:10%" id="viewphone{{$phone->id}}" tabindex="-1" role="dialog"
             aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title" id="">Phone</h4>
                    </div>
                    <div class="modal-body">
                        {!! Form::open(['url' => '/admin/case/contact/phone/'.$phone->id.'/edit']) !!}
                        {{ csrf_field() }}
                        <div class="form-group row">
                            {{ Form::label('phone', 'Phone', ['class' => 'col-md-2 col-form-label control-label', 'style' => 'padding-top:7px; text-align: right']) }}
                            <div class="col-md-10">
                                {{ Form::text('number', $phone->number, ['class' => 'form-control', 'disabled']) }}
                            </div>
                        </div>
                        <div class="form-group row">
                            {{ Form::label('type', 'Type', ['class' => 'col-md-2 col-form-label control-label', 'style' => 'padding-top:7px; text-align: right']) }}
                            <div class="col-md-10">
                                {{ Form::text('type', $phone->type, ['class' => 'form-control', 'disabled']) }}
                            </div>
                        </div>
                        <div class="form-group row">
                            {{ Form::label('status', 'Status', ['class' => 'col-md-2 col-form-label control-label', 'style' => 'padding-top:7px; text-align: right']) }}
                            <div class="col-md-10">
                                {{ Form::text('status', $phone->status, ['class' => 'form-control', 'disabled']) }}
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="form-group pull-right">
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Exit</button>
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    <!-- email -->
    @foreach($case_email as $email)
        <div class="modal fade" style="margin-top:10%" id="viewemail{{$email->id}}" tabindex="-1" role="dialog"
             aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title" id="">Email</h4>
                    </div>
                    <div class="modal-body">
                        {!! Form::open(['url' => '/admin/case/contact/email/'.$email->id.'/edit']) !!}
                        {{ csrf_field() }}
                        <div class="form-group row">
                            {{ Form::label('email', 'Email', ['class' => 'col-md-2 col-form-label control-label', 'style' => 'padding-top:7px; text-align: right']) }}
                            <div class="col-md-10">
                                {{ Form::text('email', $email->email, ['class' => 'form-control', 'disabled']) }}
                            </div>
                        </div>
                        <div class="form-group row">
                            {{ Form::label('status', 'Status', ['class' => 'col-md-2 col-form-label control-label', 'style' => 'padding-top:7px; text-align: right']) }}
                            <div class="col-md-10">
                                {{ Form::text('status', $email->status, ['class' => 'form-control', 'disabled']) }}
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="form-group pull-right">
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Exit</button>
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    <!-- end view contact information -->

    <!-- delete contact information -->
    <!-- address -->
    @foreach($case_address as $address)
        <div class="modal fade" style="margin-top:10%" id="deleteaddress{{$address->id}}" tabindex="-1"
             role="dialog"
             aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel">Delete Address</h4>
                    </div>
                    <div class="modal-body">
                        <div style="padding-left: 130px">
                            <p style="font-size: 20px; color: red">Are you sure to delete ?</p>
                            <p><strong>Please confirm address information:</strong></p>
                            <p><strong>Address: </strong>{{$address->address}}</p>
                            <p><strong>City: </strong>{{$address->city}}</p>
                            <p><strong>State: </strong>{{$address->state}}</p>
                            <p><strong>ZipCode: </strong>{{$address->zipcode}}</p>
                            <p><strong>Status: </strong>{{$address->status}}</p>
                            <p><strong>Last Modify
                                    date: </strong>{{date("m/d/Y H:i:s", strtotime($address->updated_at))}}</p>
                            <p><strong>Created
                                    date: </strong>{{date("m/d/Y H:i:s", strtotime($address->created_at))}}</p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <a role="button" class="btn btn-danger"
                           href={{ url('/admin/case/contact/address/'.$address->id.'/delete') }}>Delete</a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    <!-- phone -->
    @foreach($case_phone as $phone)
        <div class="modal fade" style="margin-top:10%" id="deletephone{{$phone->id}}" tabindex="-1"
             role="dialog"
             aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel">Delete Phone</h4>
                    </div>
                    <div class="modal-body">
                        <div style="padding-left: 130px">
                            <p style="font-size: 20px; color: red">Are you sure to delete ?</p>
                            <p><strong>Please confirm phone information:</strong></p>
                            <p><strong>Type: </strong>{{$phone->type}}</p>
                            <p><strong>Phone: </strong>{{$phone->number}}</p>
                            <p><strong>Status: </strong>{{$phone->status}}</p>
                            <p><strong>Last Modify
                                    date: </strong>{{date("m/d/Y H:i:s", strtotime($phone->updated_at))}}</p>
                            <p><strong>Created
                                    date: </strong>{{date("m/d/Y H:i:s", strtotime($phone->created_at))}}</p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <a role="button" class="btn btn-danger"
                           href={{ url('/admin/case/contact/phone/'.$phone->id.'/delete') }}>Delete</a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    <!- email -->
    @foreach($case_email as $email)
        <div class="modal fade" style="margin-top:10%" id="deleteemail{{$email->id}}" tabindex="-1"
             role="dialog"
             aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel">Delete Email</h4>
                    </div>
                    <div class="modal-body">
                        <div style="padding-left: 130px">
                            <p style="font-size: 20px; color: red">Are you sure to delete ?</p>
                            <p><strong>Please confirm email information:</strong></p>
                            <p><strong>Email: </strong>{{$email->email}}</p>
                            <p><strong>Status: </strong>{{$email->status}}</p>
                            <p><strong>Last Modify
                                    date: </strong>{{date("m/d/Y H:i:s", strtotime($email->updated_at))}}</p>
                            <p><strong>Created
                                    date: </strong>{{date("m/d/Y H:i:s", strtotime($email->created_at))}}</p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <a role="button" class="btn btn-danger"
                           href={{ url('/admin/case/contact/email/'.$email->id.'/delete') }}>Delete</a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    <!-- end delete contact information -->

    <!-- add case related activity -->
    <div class="modal fade" style="margin-top:10%" id="addactivity" tabindex="-1" role="dialog"
         aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="">Case Related Activity</h4>
                </div>
                <div class="modal-body">
                    {!! Form::open(['url' => '/admin/case/addactivity']) !!}
                    {{ csrf_field() }}
                    <div class="form-group row">
                        <div class="col-md-2 col-form-label control-label" style="padding-top:7px; text-align:right">
                            <span><strong>To </strong></span><span style="color: red"><strong>*</strong></span>
                        </div>
                        {{--<label for="to" class="col-sm-1 control-label">To:*</label>--}}
                        <div class="col-sm-10">
                            <input list="recipient" name="recipient" class="form-control" id="to"
                                   placeholder="Recipient"
                                   onclick="change_focus(this.id);" onfocus="this.placeholder='';"
                                   onblur="this.placeholder='Recipient';" required autocomplete="off">
                            <datalist id="recipient">
                                @foreach($admins as $admin)
                                    <option value="{{ Sentinel::findById($admin->user_id)->email}}">{{ Sentinel::findById($admin->user_id)->first_name." ".Sentinel::findById($admin->user_id)->last_name }}</option>
                                @endforeach
                                @foreach($managers as $manager)
                                    <option value="{{ Sentinel::findById($manager->user_id)->email}}">{{ Sentinel::findById($manager->user_id)->first_name." ".Sentinel::findById($manager->user_id)->last_name }}</option>
                                @endforeach
                                @foreach($staffs as $staff)
                                    <option value="{{ Sentinel::findById($staff->user_id)->email}}">{{ Sentinel::findById($staff->user_id)->first_name." ".Sentinel::findById($staff->user_id)->last_name }}</option>
                                @endforeach
                            </datalist>
                        </div>
                    </div>
                    <div class="form-group row">
                        {{ Form::label('cc', 'CC', ['class' => 'col-md-2 col-form-label control-label', 'style' => 'padding-top:7px; text-align: right']) }}
                        {{--<label for="cc" class="col-sm-2 control-label">CC</label>--}}
                        <div class="col-sm-10">
                            <input list="mentioned" name="mentioned" class="form-control" id="cc"
                                   placeholder="Mentioned"
                                   onclick="change_focus(this.id);" onfocus="this.placeholder='';"
                                   onblur="this.placeholder='Mentioned';">
                            <datalist id="mentioned">
                                @foreach($admins as $admin)
                                    <option value="{{ Sentinel::findById($admin->user_id)->email}}">{{ Sentinel::findById($admin->user_id)->first_name." ".Sentinel::findById($admin->user_id)->last_name }}</option>
                                @endforeach
                                @foreach($managers as $manager)
                                    <option value="{{ Sentinel::findById($manager->user_id)->email}}">{{ Sentinel::findById($manager->user_id)->first_name." ".Sentinel::findById($manager->user_id)->last_name }}</option>
                                @endforeach
                                @foreach($staffs as $staff)
                                    <option value="{{ Sentinel::findById($staff->user_id)->email}}">{{ Sentinel::findById($staff->user_id)->first_name." ".Sentinel::findById($staff->user_id)->last_name }}</option>
                                @endforeach
                            </datalist>
                        </div>
                    </div>

                    <div class="form-group row">
                        {{--<label for="subject" class="col-sm-1 control-label">Subject*</label>--}}
                        <div class="col-md-2 col-form-label control-label" style="padding-top:7px; text-align:right">
                            <span><strong>Subject </strong></span><span style="color: red"><strong>*</strong></span>
                        </div>
                        <div class="col-sm-10">
                            <input name="subject" type="text" class="form-control" id="subject"
                                   placeholder="Subject" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        {{ Form::label('ddl', 'Due', ['class' => 'col-md-2 col-form-label control-label', 'style' => 'padding-top:7px; text-align: right']) }}
                        {{--<label for="ddl" class="col-sm-2 control-label">Due</label>--}}
                        <div class="col-sm-10">
                            <input name="ddl" type="text" class="form-control" id="ddl"
                                   placeholder="Deadline">
                        </div>
                    </div>
                    <div class="form-group row" style="visibility: hidden; display: none">
                        <label for="case_related" class="col-sm-2 control-label">Case</label>
                        <div class="col-sm-10">
                            <input name="case_related" type="text" class="form-control" id="case_related"
                                   value="{{$data->email}}" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        {{--<div class="col-sm-10 col-sm-offset-1">--}}
                        <div class="col-sm-10 col-sm-offset-2">
                            <textarea name="message" maxlength="65535" class="form-control" id="message" name="body"
                                      rows="12"
                                      placeholder="Message" style="height: 200%"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="form-group pull-right">
                        {{ Form::submit('Add', ['class' => 'btn btn-primary']) }}
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end add case related activity-->

    <!-- upload avatar-->
    <div class="modal fade" style="margin-top:10%" id="uploadAvatar" tabindex="-1" role="dialog"
         aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Upload Avatar</h4>
                </div>
                <div class="modal-body">
                    {!! Form::open(['url' => '/admin/case/upload/avatar', 'files' => 'true']) !!}
                    {{ csrf_field() }}
                    <div class="form-group" style="display: none; visibility: hidden">
                        {!! Form::text('id', $data->id) !!}
                    </div>
                    <div class="form-group row">
                        {{ Form::label('avatar', 'Avatar', ['class' => 'col-md-2 col-form-label control-label', 'style' => 'padding-top:7px; text-align: right']) }}
                        <div class="col-md-10">
                            {{ Form::file('avatar', ['required']) }}
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <div class="form-group pull-right">
                        {{ Form::submit('Upload File', ['class' => 'btn btn-primary']) }}
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end upload avatar-->

@endsection