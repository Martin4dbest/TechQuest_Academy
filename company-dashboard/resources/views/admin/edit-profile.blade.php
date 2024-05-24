@extends('/admin.layouts.master')
@section('title', 'Edit Staff Information')


@section('content')
<div id="content">

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">{{ Auth::user()->name }}</h1>
    <p class="mb-4"><i>Your Profile Information</i> <a href="#" class="text-danger float-right">Edit</a>.</p>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary d-inline">{{ Auth::user()->name }} <b class="text-danger"><i>role: <span>{{ $user->role }}</span></i></b></h6>
            <h6 class="float-right d-inline"><b><a href="{{ url('/admin/staffs') }}" class="text-danger">{{ __('<-- Back') }}</a></b></h6>
        </div>
        <div class="card-body">
            <div class="container">
            @if(session()->has('success'))
                <p class="bg-success text-light p-3 w-100">
                    {{ session()->get('success') }}
                </p>
            @endif

            @if ($errors->any())
                <ul>
                    @foreach ($errors->all() as $error)
                        <li class="text-danger w-100"><b>{{ $error }}</b></li>
                    @endforeach
                </ul>
            @endif
                <form action="{{ route('admin.update-profile', $user->id) }}" method="post">
                @csrf
                @method('PUT')
                    <div class="row">
                        <div class="col-12 form-group">
                            <label for="name">{{ __('Name') }}</label>
                            <input type="text" name="name" class="form-control" id="name" value="{{ $user->name }}">
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="position">{{ __('Position') }}</label>
                            <input type="text" name="position" class="form-control" id="position" value="{{ $user->position }}">
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="office">{{ __('Office') }}</label>
                            <input type="text" name="office" class="form-control" id="office" value="{{ $user->office }}">
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="age">{{ __('Age') }}</label>
                            <input type="number" name="age" class="form-control" id="age" value="{{ $user->age }}">
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="role">{{ __('Role') }}</label>
                            <select name="role" id="role" value="{{ $user->role }}" class="form-control">
                                <option value="">Select role</option>
                                <option value="user">user</option>
                                <option value="admin">admin</option>
                            </select>
                            <!-- <input type="text" name="role" class="form-control" disabled id="role" > -->
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="startdate">{{ __('Start Date') }}</label>
                            <input type="date" name="startdate" class="form-control" id="startdate" value="{{ $user->startdate }}">
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="salary">{{ __('Salary') }}</label>
                            <input type="number" name="salary" class="form-control" id="salary" value="{{ $user->salary }}">
                        </div>
                        <div class="col-12 form-group">
                            <label for="email">{{ __('Email Address') }}</label>
                            <input type="email" name="email" class="form-control" id="email" value="{{ $user->email }}">
                        </div>
                        <div class="col-12 form-group">
                            <label for="password">{{ __('Password') }}</label>
                            <input type="password" name="password" disabled class="form-control" id="password" value="{{ $user->password }}">
                        </div>
                        <div>
                            <button type="submit" class="btn btn-danger">Update Profile</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
@endsection
