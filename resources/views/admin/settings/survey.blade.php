@extends('layouts.dashboard')

@section('head')

    <link href="{{ asset('cssnew/datepicker/jquery-ui.css') }}" rel="stylesheet">
    <script src="{{ asset('cssnew/datepicker/js/jquery-3.1.1.js') }}"></script>
    <script src="{{ asset('cssnew/datepicker/jquery-ui.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>

@endsection

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header"><i class="fa fa-gears"></i>Settings</h3>
            <ol class="breadcrumb">
                <li><i class="fa fa-home"></i><a href="{{ url('login') }}">Home</a></li>
                <li><i class="fa fa-gears"></i>Settings</li>
                <li><i class="fa fa-list-alt"></i>Program List</li>
                <?php if ($user = Sentinel::check()) {
                    $admin = Sentinel::findRoleByName('Admins');
                    $manager = Sentinel::findRoleByName('Managers');
                    $staff = Sentinel::findRoleByName('Staff');
                    $youth = Sentinel::findRoleByName('Youths');
                } ?>
            </ol>
        </div>
    </div>

    <div class="row profile">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    {{--Notes --}}
                    <div class="col-md-12"
                         style="border-top: 1px #EEEEEE solid; margin-top: 15px; padding-top: 10px">
                        <div class="col-md-10">
                            <h4><strong>Survey</strong></h4>
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btn btn-primary"
                                    style="padding-left: 50px; padding-right: 50px" ; data-toggle="modal"
                                    data-target="#addsurvey"> Add
                            </button>
                        </div>
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th style="width: 20%;">Link</th>
                                <th style="width: 20%;">Description</th>
                                <th style="width: 20%">Program</th>
                                <th style="width: 20%;">Last Modified Time</th>
                                <th style="width: 20%">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($surveys as $survey)
                                <tr>
                                    <td style="max-width: 100px; text-overflow: ellipsis; overflow: hidden; white-space: nowrap">{{ $survey->link }}</td>
                                    <td style="max-width: 20%">{{ $survey->description }}</td>
                                    <td style="max-width: 20%">{{ @($program_name[$survey->program]) ?: "Program has been deleted."}}</td>
                                    <td style="max-width: 20%">{{ date("m/d/Y H:i:s", strtotime($survey->updated_at)) }}</td>
                                    <td style="max-width: 20%">
                                        <button type="button" class="btn btn-warning" data-toggle="modal"
                                                data-target="#editsurvey{{ $survey->id }}">
                                            <i class="fa fa-pencil-square-o" style="width: 10px"></i>
                                        </button>
                                        <button type="button" class="btn btn-danger" data-toggle="modal"
                                                data-target="#deletesurvey{{ $survey->id }}">
                                            <i class="fa fa-trash-o" style="width: 10px"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>

        </div>
    </div>

    <!-- add type -->
    <div class="modal fade" style="margin-top:10%" id="addsurvey" tabindex="-1" role="dialog"
         aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="">Add survey</h4>
                </div>
                <div class="modal-body">
                    {!! Form::open(['url' => 'admin/settings/survey/add']) !!}
                    {{ csrf_field() }}
                    <div class="form-group row">
                        {{ Form::label('link', 'Link', ['class' => 'col-md-2 col-form-label control-label', 'style' => 'padding-top:7px; text-align: right']) }}
                        <div class="col-md-10">
                            {{ Form::text('link', null, ['placeholder' => 'Survey link', 'class' => 'form-control']) }}
                        </div>
                    </div>
                    <div class="form-group row">
                        {{ Form::label('description', 'Description', ['class' => 'col-md-2 col-form-label control-label', 'style' => 'padding-top:7px; text-align: right']) }}
                        <div class="col-md-10">
                            {{ Form::text('description', null, ['placeholder' => 'Description', 'class' => 'form-control']) }}
                        </div>
                    </div>
                    <div class="form-group row">
                        {!! Form::label('program', 'Program', ['class' => 'col-md-2 col-form-label control-label', 'style' => 'padding-top:7px; text-align:right']) !!}
                        <div class="col-md-10">
                            {!! Form::select('program', $program_name, null, ['class' => 'form-control']) !!}
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
    <!-- end add type -->

    <!-- delete survey -->
    @foreach($surveys as $survey)
        <div class="modal fade" style="margin-top:10%" id="deletesurvey{{ $survey->id }}" tabindex="-1" role="dialog"
             aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title" id="">Delete Survey</h4>
                    </div>
                    <div class="modal-body">
                        <div style="padding-left: 130px">
                            <p style="font-size: 20px; color: red">Are you sure to delete ?</p>
                            <p><strong>Please confirm survey information:</strong></p>
                            <p><strong>Description: </strong>{{$survey->description}}</p>
                            <p><strong>Last Modify
                                    date: </strong>{{date("m/d/Y H:i:s", strtotime($survey->updated_at))}}</p>
                            <p><strong>Created
                                    date: </strong>{{date("m/d/Y H:i:s", strtotime($survey->created_at))}}</p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="form-group pull-right">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            <a role="button" class="btn btn-danger"
                               href={{ url('/admin/settings/survey/'.$survey->id.'/delete') }}>Delete</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    <!-- end delete survey -->

    <!-- edit survey -->
    @foreach($surveys as $survey)
        <div class="modal fade" style="margin-top:10%" id="editsurvey{{ $survey->id }}" tabindex="-1" role="dialog"
             aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title" id="">Edit Survey</h4>
                    </div>
                    <div class="modal-body">
                        {!! Form::open(['url' => 'admin/settings/survey/'.$survey->id.'/edit']) !!}
                        {{ csrf_field() }}
                        <div class="form-group row">
                            {{ Form::label('link', 'Link', ['class' => 'col-md-2 col-form-label control-label', 'style' => 'padding-top:7px; text-align: right']) }}
                            <div class="col-md-10">
                                {{ Form::text('link', $survey->link, ['placeholder' => 'Survey link', 'class' => 'form-control']) }}
                            </div>
                        </div>
                        <div class="form-group row">
                            {{ Form::label('description', 'Description', ['class' => 'col-md-2 col-form-label control-label', 'style' => 'padding-top:7px; text-align: right']) }}
                            <div class="col-md-10">
                                {{ Form::text('description', $survey->description, ['placeholder' => 'Description', 'class' => 'form-control']) }}
                            </div>
                        </div>
                        <div class="form-group row">
                            {!! Form::label('program', 'Program', ['class' => 'col-md-2 col-form-label control-label', 'style' => 'padding-top:7px; text-align:right']) !!}
                            <div class="col-md-10">
                                {!! Form::select('program', $program_name, $survey->program, ['class' => 'form-control']) !!}
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
    <!-- end edit program -->

@endsection