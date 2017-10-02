@extends('layouts.dashboard')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header"><i class="fa fa-file-text"></i> View Cases</h3>
            <ol class="breadcrumb">
                <li><i class="fa fa-home"></i><a href="{{ url('login') }}">Home</a></li>
                <li><i class="fa fa-folder-open"></i><a href="{{ url('admin/case/view') }}">Case Management</a></li>
                <li><i class="fa fa-list"></i><a href="{{ url('admin/case/view') }}">View Cases</a></li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2><i class="fa fa-table red"></i><span class="break"></span><strong>Cases</strong></h2>
                </div>
                <div class="panel-body">
                    <table class="table table-striped table-bordered bootstrap-datatable datatable">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>DOB</th>
                            <th>Age</th>
                            <th>Case Manager</th>
                            <th>Program</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($datas as $data)
                            <tr>
                                <td>{{ $data->id }}</td>
                                <td>{{ $data->first_name.' '.$data->last_name }}</td>
                                <td>
                                    <?php $date = new DateTime($data->birthday);
                                    if($date->format('m/d/Y') == "12/31/1969") {
                                        echo "N/A";
                                    } else {
                                        echo $date->format('m/d/Y');
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    $now = new DateTime();
                                    $date = new DateTime($data->birthday);
                                    if($date->format('m/d/Y') == "12/31/1969") {
                                        echo "N/A";
                                    }else {
                                        echo $date->diff($now)->y;
                                    }
                                    ?>
                                </td>
                                <td>{{ Sentinel::findById($data->cm_id)->first_name." ".Sentinel::findById($data->cm_id)->last_name }}</td>
                                <td>{{ $program_name[$data->program] }}</td>
                                <td>
                                    @if($data->status)
                                        <span class="label label-success">Active</span>
                                    @else
                                        <span class="label label-default">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    <a class="btn btn-success" href="{{ url('admin/case/'. $data->id .'/view') }}">
                                        <i class="fa fa-search-plus "></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div>
                    <div class="pull-right pagination">
                        {{ $datas->render() }}
                    </div>
                </div>
            </div>
        </div><!--/col-->

    </div><!--/row-->

@endsection