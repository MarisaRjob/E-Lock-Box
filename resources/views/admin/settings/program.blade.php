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
                            <h4><strong>Program List</strong></h4>
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btn btn-primary"
                                    style="padding-left: 50px; padding-right: 50px" ; data-toggle="modal"
                                    data-target="#addprogram"> Add
                            </button>
                        </div>
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th style="width: 14%;">Program Abbreviation</th>
                                <th style="width: 14%;">Program Name</th>
                                <th style="width: 14%;">Created Time</th>
                                <th style="width: 14%;">Last Modified Time</th>
                                <th style="width: 14%;">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($program_list as $program)
                                <tr>
                                    <td>{{ $program->program_abbr }}</td>
                                    <td>{{ $program->program_name }}</td>
                                    <td>{{ date("m/d/Y H:i:s", strtotime($program->created_at)) }}</td>
                                    <td>{{ date("m/d/Y H:i:s", strtotime($program->updated_at)) }}</td>
                                    <td>
                                        <button type="button" class="btn btn-warning" data-toggle="modal"
                                                data-target="#editprogram{{ $program->id }}">
                                            <i class="fa fa-pencil-square-o" style="width: 10px"></i>
                                        </button>
                                        @if($program_check[$program->id])
                                            <button type="button" class="btn btn-danger" style="background-color: #C7C7C7; border: #C7C7C7"
                                                    data-toggle="tooltip" data-placement="top"
                                                    title="This program has already been used.">
                                                <i class="fa fa-trash-o" style="width: 10px"></i>
                                            </button>
                                        @else
                                            <button type="button" class="btn btn-danger" data-toggle="modal"
                                                    data-target="#deleteprogram{{ $program->id }}">
                                                <i class="fa fa-trash-o" style="width: 10px"></i>
                                            </button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>

        </div><!--/.col-->
    </div><!--/.row profile-->

    <!-- add program -->
    <div class="modal fade" style="margin-top:10%" id="addprogram" tabindex="-1" role="dialog"
         aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="">Add Program</h4>
                </div>
                <div class="modal-body">
                    {!! Form::open(['url' => 'admin/settings/program/add']) !!}
                    {{ csrf_field() }}
                    <div class="form-group row">
                        {{ Form::label('program_abbr', 'Abbreviation', ['class' => 'col-md-2 col-form-label control-label', 'style' => 'padding-top:7px; text-align: right']) }}
                        <div class="col-md-10">
                            {{ Form::text('program_abbr', null, ['placeholder' => 'Program Abbreviation', 'class' => 'form-control']) }}
                        </div>
                    </div>
                    <div class="form-group row">
                        {{ Form::label('program_name', 'Name', ['class' => 'col-md-2 col-form-label control-label', 'style' => 'padding-top:7px; text-align: right']) }}
                        <div class="col-md-10">
                            {{ Form::text('program_name', null, ['placeholder' => 'Program Name', 'class' => 'form-control']) }}
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
    <!-- end add program -->

    <!-- edit program -->
    @foreach($program_list as $program)
        <div class="modal fade" style="margin-top:10%" id="editprogram{{ $program->id }}" tabindex="-1" role="dialog"
             aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title" id="">Edit Program</h4>
                    </div>
                    <div class="modal-body">
                        {!! Form::open(['url' => 'admin/settings/program/'.$program->id.'/edit']) !!}
                        {{ csrf_field() }}
                        <div class="form-group row">
                            {{ Form::label('program_abbr', 'Abbreviation', ['class' => 'col-md-2 col-form-label control-label', 'style' => 'padding-top:7px; text-align: right']) }}
                            <div class="col-md-10">
                                {{ Form::text('program_abbr', $program->program_abbr, ['placeholder' => 'Program Abbreviation', 'class' => 'form-control']) }}
                            </div>
                        </div>
                        <div class="form-group row">
                            {{ Form::label('program_name', 'Name', ['class' => 'col-md-2 col-form-label control-label', 'style' => 'padding-top:7px; text-align: right']) }}
                            <div class="col-md-10">
                                {{ Form::text('program_name', $program->program_name, ['placeholder' => 'Program Name', 'class' => 'form-control']) }}
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
    <!-- delete program -->
    @foreach($program_list as $program)
        <div class="modal fade" style="margin-top:10%" id="deleteprogram{{ $program->id }}" tabindex="-1" role="dialog"
             aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title" id="">Delete Program</h4>
                    </div>
                    <div class="modal-body">
                        <div style="padding-left: 130px">
                            <p style="font-size: 20px; color: red">Are you sure to delete ?</p>
                            <p><strong>Please confirm program information:</strong></p>
                            <p><strong>Abbreviation: </strong>{{$program->program_abbr}}</p>
                            <p><strong>Name: </strong>{{$program->program_name}}</p>
                            <p><strong>Last Modify
                                    date: </strong>{{date("m/d/Y H:i:s", strtotime($program->updated_at))}}</p>
                            <p><strong>Created
                                    date: </strong>{{date("m/d/Y H:i:s", strtotime($program->created_at))}}</p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="form-group pull-right">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            <a role="button" class="btn btn-danger"
                               href={{ url('/admin/settings/program/'.$program->id.'/delete') }}>Delete</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    <!-- end delete program -->

@endsection