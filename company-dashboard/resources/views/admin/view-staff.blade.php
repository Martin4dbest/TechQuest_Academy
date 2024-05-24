@extends('/admin.layouts.master')
@section('title', 'Staff Information')


@section('content')
<div id="content">

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">{{ Auth::user()->name }}</h1>
    <p class="mb-4"><i>Your Profile Information</i> <a href="{{ url('/admin/edit-profile/'.$user->id) }}" class="text-danger float-right">Edit</a>.</p>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary d-inline">{{ Auth::user()->name }} <b class="text-danger"><i>role: <span>{{ $user->role }}</span></i></b></h6>
            <h6 class="float-right d-inline"><b><a href="{{ url('/admin/staffs') }}" class="text-danger">{{ __('<-- Back') }}</a></b></h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <tr>
                            <th>Name</th>
                            <td>{{ $user->name }}</td>
                        </tr>
                        <tr>
                            <th>Position</th>
                            <td>{{ $user->position }}</td>
                        </tr>
                        <tr>
                            <th>Office</th>
                            <td>{{ $user->office }}</td>
                        </tr>
                        <tr>
                            <th>Age</th>
                            <td>{{ $user->age }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{ $user->email }}</td>
                        </tr>
                        <tr>
                            <th>Start Date</th>
                            <td>{{ $user->startdate }}</td>
                        </tr>
                        <tr>
                            <th>Salary</th>
                            <td>{{ $user->salary }}</td>
                        </tr>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
@endsection
