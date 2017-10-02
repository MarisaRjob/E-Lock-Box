@extends('layouts.dashboard')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header"><i class="fa fa-file-text"></i> View Users</h3>
            <ol class="breadcrumb">
                <li><i class="fa fa-home"></i><a href="{{ url('login') }}">Home</a></li>
                <li><i class="fa fa-user"></i><a href="{{ url('admin/user/view') }}">User Management</a></li>
                <li><i class="fa fa-list"></i><a href="{{ url('admin/user/view') }}">View Users</a></li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2><i class="fa fa-table red"></i><span class="break"></span><strong>Users</strong></h2>
                </div>
                <div class="panel-body">
                    <table class="table table-striped table-bordered bootstrap-datatable datatable">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone Number</th>
                            <th>Level</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($datas as $data)
                            <tr>
                                <td>{{$data['fn'].' '.$data['ln']}}</td>
                                <td>{{$data['em']}}</td>
                                <td>{{$data['ph']}}</td>
                                <td>{{$data['ro']}}</td>
                                <td>{{$data['ac']}}</td>
                                <td>
                                    <a class="btn btn-success" href="{{ url('admin/user/'. $data['id'] .'/view') }}">
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
                        {{ $datas->setPath('view')->render() }}
                    </div>
                </div>

            </div>
        </div>

    </div>

    @endsection