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

@stop

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header"><i class="fa fa-gears"></i>Settings</h3>
            <ol class="breadcrumb">
                <li><i class="fa fa-home"></i><a href="{{ url('login') }}">Home</a></li>
                <li><i class="fa fa-gears"></i>Settings</li>
                <li><i class="fa fa-list-alt"></i>Document Type</li>
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
                            <h4><strong>Document Type</strong></h4>
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btn btn-primary"
                                    style="padding-left: 50px; padding-right: 50px" ; data-toggle="modal"
                                    data-target="#addtype"> Add
                            </button>
                        </div>
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th style="width: 14%;">Type Abbreviation</th>
                                <th style="width: 14%;">Type Name</th>
                                <th style="width: 14%;">Created Time</th>
                                <th style="width: 14%;">Last Modified Time</th>
                                <th style="width: 14%;">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($doc_type_list as $doc)
                                <tr>
                                    <td>{{ $doc->document_abbr }}</td>
                                    <td>{{ $doc->document_type }}</td>
                                    <td>{{ date("m/d/Y H:i:s", strtotime($doc->created_at)) }}</td>
                                    <td>{{ date("m/d/Y H:i:s", strtotime($doc->updated_at)) }}</td>
                                    <td>
                                        <button type="button" class="btn btn-warning" data-toggle="modal"
                                                data-target="#edittype{{ $doc->id }}">
                                            <i class="fa fa-pencil-square-o" style="width: 10px"></i>
                                        </button>
                                        @if($doc_check[$doc->id])
                                            <button type="button" class="btn btn-danger" style="background-color: #C7C7C7; border: #C7C7C7"
                                                    data-toggle="tooltip" data-placement="top"
                                                    title="This type has already been used.">
                                                <i class="fa fa-trash-o" style="width: 10px"></i>
                                            </button>
                                        @else
                                            <button type="button" class="btn btn-danger" data-toggle="modal"
                                                    data-target="#deletetype{{ $doc->id }}">
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

        </div>
    </div>

    <!-- add type -->
    <div class="modal fade" style="margin-top:10%" id="addtype" tabindex="-1" role="dialog"
         aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="">Add Document Type</h4>
                </div>
                <div class="modal-body">
                    {!! Form::open(['url' => 'admin/settings/doctype/add']) !!}
                    {{ csrf_field() }}
                    <div class="form-group row">
                        {{ Form::label('document_abbr', 'Abbreviation', ['class' => 'col-md-2 col-form-label control-label', 'style' => 'padding-top:7px; text-align: right']) }}
                        <div class="col-md-10">
                            {{ Form::text('document_abbr', null, ['placeholder' => 'Document Type Abbreviation', 'class' => 'form-control']) }}
                        </div>
                    </div>
                    <div class="form-group row">
                        {{ Form::label('document_type', 'Name', ['class' => 'col-md-2 col-form-label control-label', 'style' => 'padding-top:7px; text-align: right']) }}
                        <div class="col-md-10">
                            {{ Form::text('document_type', null, ['placeholder' => 'Document Type Name', 'class' => 'form-control']) }}
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

    <!-- edit type -->
    @foreach($doc_type_list as $doc)
        <div class="modal fade" style="margin-top:10%" id="edittype{{ $doc->id }}" tabindex="-1" role="dialog"
             aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title" id="">Edit Document Type</h4>
                    </div>
                    <div class="modal-body">
                        {!! Form::open(['url' => 'admin/settings/doctype/'.$doc->id.'/edit']) !!}
                        {{ csrf_field() }}
                        <div class="form-group row">
                            {{ Form::label('document_abbr', 'Abbreviation', ['class' => 'col-md-2 col-form-label control-label', 'style' => 'padding-top:7px; text-align: right']) }}
                            <div class="col-md-10">
                                {{ Form::text('document_abbr', $doc->document_abbr, ['placeholder' => 'Document Type Abbreviation', 'class' => 'form-control']) }}
                            </div>
                        </div>
                        <div class="form-group row">
                            {{ Form::label('document_type', 'Name', ['class' => 'col-md-2 col-form-label control-label', 'style' => 'padding-top:7px; text-align: right']) }}
                            <div class="col-md-10">
                                {{ Form::text('document_type', $doc->document_type, ['placeholder' => 'Document Type Name', 'class' => 'form-control']) }}
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
    <!-- end edit type -->

    <!-- delete type -->
    @foreach($doc_type_list as $doc)
        <div class="modal fade" style="margin-top:10%" id="deletetype{{ $doc->id }}" tabindex="-1" role="dialog"
             aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title" id="">Delete Document Type</h4>
                    </div>
                    <div class="modal-body">
                        <div style="padding-left: 130px">
                            <p style="font-size: 20px; color: red">Are you sure to delete ?</p>
                            <p><strong>Please confirm program information:</strong></p>
                            <p><strong>Abbreviation: </strong>{{$doc->document_abbr}}</p>
                            <p><strong>Name: </strong>{{$doc->document_type}}</p>
                            <p><strong>Last Modify
                                    date: </strong>{{date("m/d/Y H:i:s", strtotime($doc->updated_at))}}</p>
                            <p><strong>Created
                                    date: </strong>{{date("m/d/Y H:i:s", strtotime($doc->created_at))}}</p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="form-group pull-right">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            <a role="button" class="btn btn-danger"
                               href={{ url('/admin/settings/doctype/'.$doc->id.'/delete') }}>Delete</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    <!-- end delete type -->

@endsection