@extends('layouts.dashboard')

@section('head')
    <link href="{{ asset('cssnew/datepicker/jquery-ui.css') }}" rel="stylesheet">
    <script src="{{ asset('cssnew/datepicker/js/jquery-3.1.1.js') }}"></script>
    <script src="{{ asset('cssnew/datepicker/jquery-ui.js') }}"></script>

    <script>
        var focus_id = "to";
        function edit() {
            document.getElementById("view_activity").style.display = "none";
            document.getElementById("view_activity").style.visibility = "hidden";
            document.getElementById("edit_activity").style.display = "block";
            document.getElementById("edit_activity").style.visibility = "visible";
        }
        function cancel() {
            document.getElementById("edit_activity").style.display = "none";
            document.getElementById("edit_activity").style.visibility = "hidden";
            document.getElementById("view_activity").style.display = "block";
            document.getElementById("view_activity").style.visibility = "visible";
        }
        function change_focus(id) {
            focus_id = id;
        }
        function add(elem) {
            document.getElementById(focus_id).value = elem.childNodes[3].childNodes[0].nodeValue;
//            console.log(elem.childNodes[3].childNodes[0].nodeValue);
        }

        $(document).ready(function () {
            $('#ddl').datepicker({
                minDate: new Date(),
                dateFormat: "mm/dd/yy",
                changeYear: true,
                changeMonth: true,
            });
        });

    </script>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header"><i class="fa fa-file-text"></i> Activities</h3>
            <ol class="breadcrumb">
                <li><i class="fa fa-home"></i><a href="{{ url('login') }}">Home</a></li>
                <li><i class="fa fa-folder-open"></i><a href="{{ url('staff') }}">Activities</a></li>
                <li><i class="fa fa-file-text"></i><a
                            href="{{ url('staff/'.$activity->id.'/view') }}">{{$activity->subject}}</a></li>
            </ol>
        </div>
    </div>

    {{--view activity--}}
    <div class="row inbox" id="view_activity">
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-body contacts" id="deadline">
                    <a href="#" class="btn btn-primary btn-block">Deadline</a>
                    <ul id="ddls_list">
                        @foreach($activities as $act)
                            @if(($act->assigned == Sentinel::getUser()->id) || ($act->mentioned == Sentinel::getUser()->id))
                                @if(date("m/d/Y", strtotime($act->ddl)) != "12/31/1969")
                                    <li style="height: 50px">
                                        <div>
                                            <span class="label label-success"></span><span>{{ date("m/d/Y", strtotime($act->ddl)) }}</span>
                                        </div>
                                        <div style="font-size: 12px; padding-left: 12px">
                                            Subject: {{ $act->subject }}</div>
                                    </li>
                                @endif


                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-9" id="view_form">
            <div class="panel panel-default">
                <div class="panel-body message">
                    <form class="form-horizontal" role="form">
                        <div class="form-group">
                            <label for="to" class="col-sm-1 control-label" style="text-align:right;">
                                <span><strong>To</strong></span><span style="color: red"><strong>*</strong></span>
                            </label>
                            <div class="col-sm-11">
                                <input list="recipient" name="recipient" class="form-control" id="to0"
                                       placeholder="Recipient"
                                       value="{{ Sentinel::findById($activity->assigned)->email }}"
                                       onclick="change_focus(this.id)" onfocus="this.placeholder=''"
                                       onblur="this.placeholder='Recipient'" required autocomplete="off" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="cc" class="col-sm-1 control-label" style="text-align:right;">CC</label>
                            <div class="col-sm-11">
                                <input list="mentioned" name="mentioned" class="form-control" id="cc0"
                                       placeholder="Mentioned" value="<?php if ($activity->mentioned) {
                                    echo Sentinel::findById($activity->mentioned)->email;
                                } ?>"
                                       onclick="change_focus(this.id)" onfocus="this.placeholder=''"
                                       onblur="this.placeholder='Mentioned'" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="subject" class="col-sm-1 control-label" style="text-align:right;">
                                <span><strong>Subject</strong></span><span
                                        style="color: red"><strong>*</strong></span>
                            </label>
                            <div class="col-sm-11">
                                <input name="subject" type="text" class="form-control" id="subject0"
                                       placeholder="Subject" value="{{ $activity->subject }}"
                                       onfocus="this.placeholder=''" onblur="this.placeholder='Subject'" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="subject" class="col-sm-1 control-label"
                                   style="text-align:right;">Due</label>
                            <div class="col-sm-11">
                                <input name="ddl" type="text" class="form-control" id="ddl0"
                                       placeholder="Deadline" value="<?php $date = new DateTime($activity->ddl);
                                if ($date->format('m/d/Y') != "12/31/1969") {
                                    echo $date->format('m/d/Y');
                                } else {
                                    echo "N/A";
                                }
                                ?>"
                                       onfocus="this.placeholder=''" onblur="this.placeholder='Deadline'" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="task" class="col-sm-1 control-label" style="text-align:right;">Task</label>
                            <div class="col-sm-11" style="margin-top: 6px">
                                <?php
                                if ($activity->task) {
                                    echo "<span class='label label-success'>Done</span>";
                                } else {
                                    echo "<span class='label label-warning'>To Do</span>";
                                }
                                ?>
                            </div>
                        </div>
                    </form>

                    <div class="col-sm-11 col-sm-offset-1">
                        <br/>
                        <div class="form-group">
                            <textarea name="message" maxlength="65535" class="form-control" id="message0"
                                      name="body"
                                      rows="12" placeholder="Message" style="height: 200%"
                                      onfocus="this.placeholder=''"
                                      onblur="this.placeholder='Message'"
                                      readonly>{{ $activity->message }}</textarea>
                        </div>
                        <div class="form-group pull-right">
                            <a type="button" class="btn btn-default" href="{{ url('staff') }}">Cancel</a>
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop