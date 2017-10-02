<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>e-Lockbox</title>
    <!-- Fav and touch icons -->
    <link rel="shortcut icon" href="{{ asset('cssnew/assets/ico/favicon.ico') }}" type="image/x-icon"/>

    <!-- Css files -->
    <link href="{{ asset('cssnew/assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('cssnew/assets/css/jquery.mmenu.css') }}" rel="stylesheet">
    <link href="{{ asset('cssnew/assets/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('cssnew/assets/css/climacons-font.css') }}" rel="stylesheet">
    <link href="{{ asset('cssnew/assets/plugins/xcharts/css/xcharts.min.css') }}" rel=" stylesheet">
    <link href="{{ asset('cssnew/assets/plugins/fullcalendar/css/fullcalendar.css') }}" rel="stylesheet">
    <link href="{{ asset('cssnew/assets/plugins/morris/css/morris.css') }}" rel="stylesheet">
    <link href="{{ asset('cssnew/assets/plugins/jquery-ui/css/jquery-ui-1.10.4.min.css') }}" rel="stylesheet">
    <link href="{{ asset('cssnew/assets/plugins/jvectormap/css/jquery-jvectormap-1.2.2.css') }}" rel="stylesheet">
    <link href="{{ asset('cssnew/assets/css/style.min.css') }}" rel="stylesheet">
    <link href="{{ asset('cssnew/assets/css/add-ons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('cssnew/assets/plugins/dropzone/css/dropzone.css') }}" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <style>
        .frame {
            padding: 5%;
        }

        .frame2 {
            padding-left: 0%;
            padding-right: 0%;
        }

        .profile {
            margin-top: 45px;
            height: 100%;
            width: 100%;
            background-color: white;

        }

        body {
            background: white;
        }

        .hidden {
            display: none;
        }

        .green {
            color: green;
        }

        .red {
            color: red;
        }
        footer {
            margin: 0 auto !important;
        }
        .glyphicon.glyphicon-envelope {
            font-size: 20px;
        }
        .survey_div {
            width: 100%;
            text-align: center;
        }
        a.inset{border-style: groove; padding: 10px; color: royalblue; max-width: 100%;}
        .thead_inverse {
            background-color: rgb(89, 89, 89);
            color: white;
        }
    </style>
    <script>
        $(document).ready(function () {
            $("#button_addinfo").click(function () {
                $(".add_info").toggleClass("hidden");
                $("#button_addinfo").toggleClass("green");
                $("#button_addinfo").toggleClass("fa-plus-circle");
                $("#button_addinfo").toggleClass("fa-minus-circle");
                $("#button_addinfo").toggleClass("red");

            });
            $("#button_geninfo").click(function () {
                $(".gen_info").toggleClass("hidden");
                $("#button_geninfo").toggleClass("green");
                $("#button_geninfo").toggleClass("fa-plus-circle");
                $("#button_geninfo").toggleClass("fa-minus-circle");
                $("#button_geninfo").toggleClass("red");

            });
             $("#button_survey").click(function () {
                $("#survey_div").toggleClass("hidden");
                $("#button_survey").toggleClass("green");
                $("#button_survey").toggleClass("fa-plus-circle");
                $("#button_survey").toggleClass("fa-minus-circle");
                $("#button_survey").toggleClass("red");

            });
             $("#button_docs").click(function () {
                $("#docs_div").toggleClass("hidden");
                $("#button_docs").toggleClass("green");
                $("#button_docs").toggleClass("fa-plus-circle");
                $("#button_docs").toggleClass("fa-minus-circle");
                $("#button_docs").toggleClass("red");

            });
        });
    </script>

</head>
<body>
<div class="navbar" role="navigation" style="padding-left: 10px; padding-right:10px;">
        <div class="container-fluid">
            <ul class="nav navbar-nav navbar-left" style="padding: 0px; margin: 0px; margin-left: -25px">
                <li class="visible-sm visible-md visible-lg"><a href="{{url('/')}}"><img  style="width: 250px;"
                                                                              src="{{ asset('cssnew/assets/img/newlogo.png') }}" height="104px"></a>
                </li>
                <li class="visible-xs"><a href="{{url('/')}}"><img  style="width: 60px;"
                                                                              src="{{ asset('cssnew/assets/img/logo_m.png') }}"></a>
                </li>
                <li class="visible-lg" style= "text-align:center; color: rgb(21,20,200); margin-left: 230px; font-size: 22px">
                    <b>Welcome back, {{sentinel::getUser()-> first_name}}! <i class="fa fa-smile-o fa-large" aria-hidden="true"></i></b>
                </li>
            </ul>
            <!-- <ul class="nav navbar-nav navbar-left">
                <li class="visible-xs visible-sm visible-md visible-lg">
                    <a class = "link_home" href="{{url('/')}}" alt = "homepage"><i class="fa fa-home fa-2x" aria-hidden="true"></i></a><a class = "link_home" href="{{url('/')}}" alt = "homepage"><i class="fa fa-cube fa-2x"></i> <b>e-lockbox</b></a>
                </li>
            </ul> -->
            <div class="copyrights">
                Collect from
                <a href="http://greenbay.usc.edu/csci577/fall2016/projects/team10">Team10</a>
            </div>
            <!-- <ul class="nav navbar-nav navbar-middle">
                <li class="visible-sm visible-md visible-lg" style= "text-align:center; color: rgb(21,20,200);">
                    <b>Welcome back, {{sentinel::getUser()-> first_name}}! <i class="fa fa-smile-o fa-large" aria-hidden="true"></i></b>
                </li>
             </ul> -->
            <ul class="nav navbar-nav navbar-right">
                <li class="">
                    <a id="cur_email" href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <?php
                        if ($avatar) {
                            if ($_SERVER['SERVER_NAME'] == "localhost") {
                                echo "<img class='user-avatar' src='http://" . $_SERVER['SERVER_NAME'] . "/elockbox/public/" . $avatar->path . "/" . $avatar->filename . "'>";
                            } else {
                                echo "<img class='user-avatar' src='http://" . $_SERVER['SERVER_NAME'] . "/" . $avatar->path . "/" . $avatar->filename . "'>";
                            }
                        } else {
                            echo "<img class='user-avatar' src='" . asset('cssnew/assets/img/avatar.png') . "'>";
                        }
                        ?>
                    </a>
                </li>
                <li class="visible-sm visible-md visible-lg">
                    <a>{{sentinel::getUser()->email}}</a>
                </li>
                <li>
                    <a href="mailto:{{$cm_email}}?Subject=I%20need%20help%20from%20you,%20{{$data->cm_name}}!" target="_bottom" data-toggle="tooltip" data-placement="bottom"
                                                   title="Contact your case manager?"><i class="fa fa-envelope-o"></i></a>
                </li>
                <li><a href="{{ url('/logout') }}" target="_top" data-toggle="tooltip" data-placement="bottom"
                                                   title="Exit e-lockbox?"><i class="fa fa-power-off"></i></a></li>
            </ul>
        </div>
    </div>
<br/>
<div class="row profile">
    <div class="frame">
        <h3><strong>Surveys</strong> <i id="button_survey" class="fa fa-plus-circle green"
                                                   aria-hidden="true"></i></h3>
         <div class="frame2 hidden" id = "survey_div">
            @if($surveys->first())
            <div class = "col-xs-12 table-responsive">
            <table id = "survey_table" class="table table-hover table-condensed">
                <thead>
                    <th class="col-xs-6">Description</th>
                    <th class="col-md-6">Link</th>
                </thead>
                <tbody>
                    @foreach($surveys as $survey)
                    <tr class="info">
                        <td>{{$survey->description}}</td><td><a href = "{{$survey->link}}" target="_blank">{{$survey->link}}</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <!-- <div class = "survey_div">
                <a href = "{{$survey->link}}" target = "_blank" class = "inset" data-toggle="tooltip" data-placement="bottom"                                           title="{{$survey->description}}">Please fill our Survey!
                </a>
            </div> -->
            </div>
            @else
            <p class="text-warning" style ="margin-left: 8px">There is no survey available currently!</p>
            @endif
         </div>
        <h3><strong>General Information</strong> <i id="button_geninfo" class="fa fa-minus-circle red"
                                                    aria-hidden="true"></i></h3>
        <div class="frame2 gen_info">
            <div class="col-md-4 col-sm-4 col-xs-12">
                <ul class="profile-details">
                    <li>
                        <div style="color: #4C4F53"><i class="fa fa-envelope"
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

            <div class="col-md-4 col-sm-4 col-xs-12">
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

            <div class="col-md-4 col-sm-4 col-xs-12 ">
                <ul class="profile-details">
                    <li>
                        <div style="color: #4C4F53"><i class="fa fa-user"
                                                       style="color: #4C4F53"></i><strong>
                                Manager</strong>
                        </div>
                        <div style="color: #6699CC">{{ $data->cm_name }} ({{$cm_email}})
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
                                                       style="color: #4C4F53"></i><strong> Social
                                Security
                                Number</strong></div>
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

        <!-- display the vital document -->
        <h3><strong>Vital Documents</strong> <i id="button_docs" class="fa fa-minus-circle red"
                                                   aria-hidden="true"></i></h3>
        <div class="frame2" id = "docs_div">
            @if($docs->first() != null)
            <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                <tr style="text-align: left" class = "thead_inverse">
                    <th style="width: 25%;">Type</th>
                    <th style="width: 25%;">Title</th>
                    <th style="width: 25%;">Uploaded By</th>
                    <th style="width: 25%;">Last Modified Date</th>
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
                        <td>{{$doc->uploader}}
                        </td>
                        <td>{{date("m/d/Y", strtotime($doc->updated_at))}}</td>
                    </tr>

                @endforeach
                </tbody>
            </table>
            </div>
            @else 
            <p style = "margin-left: 8px" class="text-warning">You currently do not have any document uploaded!</p>
            @endif
        </div>


        <h3><strong>Additional Information</strong> <i id="button_addinfo" class="fa fa-plus-circle green"
                                                       aria-hidden="true"></i></h3>
        {{--Contact Information--}}
        <div class="col-md-12 add_info hidden">
            <div class="col-md-12">
                <div class="col-md-12 col-xs-12" style="padding: 0px; margin: 0px;">
                    <h4><strong>Contact Information</strong></h4>
                </div>
                <!-- address -->
                <div class="col-md-12">
                    <h5><strong>Address</strong></h5>
                    @if($case_address->first() != null)
                        <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr class = "thead_inverse">
                                <th class="col-md-2">Address</th>
                                <th class="col-md-2">City</th>
                                <th class="col-md-2">State</th>
                                <th class="col-md-2">ZipCode</th>
                                <th class="col-md-2">Status</th>
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
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                        <p class="text-warning">You have no content!</p>
                    @endif
                </div>

                <!-- phone -->
                <div class="col-md-12" style="">
                    <h5><strong>Phone</strong></h5>
                    @if($case_phone->first() != null)
                        <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr class = "thead_inverse">
                                <th class="col-md-4">Type</th>
                                <th class="col-md-4">Number</th>
                                <th class="col-md-4">Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($case_phone as $phone)
                                <tr>
                                    <td>{{$phone->type}}</td>
                                    <td>{{$phone->number}}</td>
                                    <td>{{$phone->status}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        </div>
                    @else
                        <p class="text-warning">You have no content!</p>
                    @endif
                </div>

                <!-- email -->
                <div class="col-md-12" style="">
                    <h5><strong>Email</strong></h5>
                    @if($case_email->first() != null)
                        <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr class = "thead_inverse">
                                <th class="col-md-6">Email</th>
                                <th class="col-md-6">Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($case_email as $email)
                                <tr>
                                    <td>{{$email->email}}</td>
                                    <td>{{$email->status}}</td>
                                    @if($data->status)
                                    @endif
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        </div>
                    @else
                        <p class="text-warning">You have no content!</p>
                    @endif
                </div>
            </div>
            {{--Additional Contacts--}}
            <div class="col-md-12">
                <div class="col-md-12" style="padding: 0px; margin: 0px;">
                    <h4><strong>Additional Contacts</strong></h4>
                </div>
                @if($addcontacts->first() != null)
                 <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr class = "thead_inverse">
                            <th class="col-md-2">Name</th>
                            <th class="col-md-2">Relationship</th>
                            <th class="col-md-2">Phone</th>
                            <th class="col-md-2">Email</th>
                            <th class="col-md-2">Address</th>
                            <th class="col-md-2">Status</th>
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
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                    <p class="text-warning">You have no content!</p>
                @endif
            </div>
            {{--Education History--}}
            <div class="col-md-12">
                <div class="col-md-12" style="padding: 0px; margin: 0px;">
                    <h4><strong>Education History</strong></h4>
                </div>
                @if($eduhistorys->first() != null)
                 <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr class = "thead_inverse">
                            <th class="col-md-2">Start Date</th>
                            <th class="col-md-2">End Date</th>
                            <th class="col-md-2">School</th>
                            <th class="col-md-2">Level</th>
                            <th class="col-md-2">Address</th>
                            <th class="col-md-2">Status</th>
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
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                    <p class="text-warning">You have no content!</p>
                @endif
            </div>

            {{--Work History--}}
            <div class="col-md-12">
                <div class="col-md-12" style="padding: 0px; margin: 0px;">
                    <h4><strong>Work History</strong></h4>
                </div>
                @if($workhistorys->first() != null)
                 <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="thead-inverse">
                        <tr class = "thead_inverse">
                            <th class="col-md-2">Start Date</th>
                            <th class="col-md-2">End Date</th>
                            <th class="col-md-2">Company</th>
                            <th class="col-md-2">Industry</th>
                            <th class="col-md-2">Address</th>
                            <th class="col-md-2">Status</th>
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
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                    <p class="text-warning">You have no content!</p>
                @endif
            </div>
        </div>

    </div>

</div>
</body>