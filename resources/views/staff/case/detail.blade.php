@extends('layouts.dashboard')

@section('head')

    <link href="{{ asset('cssnew/datepicker/jquery-ui.css') }}" rel="stylesheet">
    <script src="{{ asset('cssnew/datepicker/js/jquery-3.1.1.js') }}"></script>
    <script src="{{ asset('cssnew/datepicker/jquery-ui.js') }}"></script>
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
                <li><i class="fa fa-folder-open"></i><a href="{{ url('/staff/case/view') }}">Case Management</a></li>
                <li><i class="fa fa-list"></i><a href="{{ url('/staff/case/view') }}">View Cases</a></li>
                <li><i class="fa fa-file-text"></i><a
                            href="{{ url('/staff/case/'.$data->id.'/view') }}">{{ $youth_name1 }}</a></li>
            </ol>
        </div>
    </div>
    <!-- end nav bar -->

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
                                     width='120px' height='120px'>
                            @else
                                <img class='img-profile' src='{{asset('cssnew/assets/img/avatar.png')}}'
                                     width='120px' height='120px'>
                            @endif
                        </div>
                        <h3 class="text-center"><strong>{{ $data->first_name.' '.$data->last_name }}</strong></h3>
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
                                    <div style="color: #6699CC">{{ $data->cm_name }}
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
                                    <div style="color: #6699CC" onclick="show_ssn()" id="hidden_ssn">
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
                    </div>
                    {{--Contact Information--}}
                    <div class="col-md-12"
                         style="border-top: 1px #EEEEEE solid; margin-top: 15px; padding-top: 10px">
                        <div class="col-md-10">
                            <h4><strong>Contact Information</strong></h4>
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
                                    <th style="width: 14%;">Action</th>
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
                                    <td><a class="btn btn-success" href="{{ url('staff/'. $activity->id .'/view') }}">
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
                                        <a data-toggle="tooltip" data-placement="top"
                                           title="{{$doc->description}}">{{$doc->title}}</a></td>
                                    <td>{{$doc->visible}}</td>
                                    <td>{{$doc->uploader}}</td>
                                    <td>{{date("m/d/Y H:i:s", strtotime($doc->created_at))}}</td>
                                    <td>{{date("m/d/Y H:i:s", strtotime($doc->updated_at))}}</td>
                                    @if($data->status)
                                        <td>

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
                        {!! Form::open(['url' => '/staff/case/workhistory/'.$workhistory->id.'/view']) !!}
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
                        {!! Form::open(['url' => '/staff/case/eduhistory/'.$eduhistory->id.'/view']) !!}
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
                        {!! Form::open(['url' => '/staff/case/addcontacts']) !!}
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
                        {!! Form::open(['url' => '/staff/case/contact/address/'.$address->id.'/view']) !!}
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
                        {!! Form::open(['url' => '/staff/case/contact/phone/'.$phone->id.'/view']) !!}
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
                        {!! Form::open(['url' => '/staff/case/contact/email/'.$email->id.'/view']) !!}
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

@endsection