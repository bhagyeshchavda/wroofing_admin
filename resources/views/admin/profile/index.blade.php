@extends('layouts.master')
@section('title') {{$pageDetails['title']}} @endsection
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Profile</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">User Profile</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div id="success" class="alert alert-success" style="display:none;"> <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Admin Information is successfully updated.</div>
                <div id="error" class="alert alert-danger" style="display:none;"> <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Admin Information is not updated.</div>
                <div id="success-pwd" class="alert alert-success" style="display:none;"> <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Password is successfully updated.</div>
                <div id="error-pwd" class="alert alert-danger" style="display:none;"> <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>All fields are required.</div>

                <div class="row">
                    <div class="col-md-3">

                        <!-- Profile Image -->
                        <div class="card card-primary card-outline">
                            <div class="card-body box-profile">
                                <h3 class="profile-username text-center admin_name"><strong>{{ Auth::user()->name }}</strong></h3>
                                <p class="text-muted text-center">{{ Auth::user()->email }}</p>

                                <form action="{{ route('updateavatar') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">

                                        <div class="custom-file">
                                            {{-- @dd(Auth::user()->profile_picture); --}}
                                            @if (Auth::user()->profile_image != '')
                                            <!-- START EDIT PAGE -->
                                            <div class="form-image text-center previewing">
                                                @if (Auth::user()->profile_image != null)
                                                    <a href="javascript:void(0)" class="image-clear"><i
                                                            class="fa fa-times-circle fa-2x"></i>
                                                    </a>
                                                @endif
                        
                                                @if (Auth::user()->profile_image != null)
                                                    <input type="hidden" name="profile_picture" class="input-path"
                                                        value="{{ Auth::user()->profile_image }}">
                                                @else
                                                    <input type="hidden" name="profile_picture" class="input-path" value="">
                                                @endif
                                                <div class="dropify-preview image-hidden"
                                                    @if (Auth::user()->profile_image != null) @if (Auth::user()->profile_image) style="display: block" @endif
                                                    @endif
                                                    >
                                                    <span class="dropify-render">
                                                        @if (Auth::user()->profile_image != null)
                                                            <img src="{{ Auth::user()->profile_image != '' ? asset(Auth::user()->profile_image) : asset('/admin-panel/img/avatar5.png') }}" alt="profile">
                                                        @endif
                                                    </span>
                                                    <div class="dropify-infos">
                                                        <div class="dropify-infos-inner">
                                                            <p class="dropify-filename"><span class="dropify-filename-inner"></span></p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="icon-choose"><i class="fas fa-cloud-upload-alt fa-5x"></i>
                                                    <p>Click here to select file</p>
                                                </div>
                                            </div>
                                            <!-- END EDIT PAGE -->
                                        @else
                                            <div class="form-image text-center previewing">
                                                <a href="javascript:void(0)" class="image-clear" style="display: none"><i
                                                        class="fa fa-times-circle fa-2x"></i>
                                                </a>
                                                <input type="hidden" name="profile_picture" class="input-path" value="">
                                                <div class="dropify-preview image-hidden">
                                                    <span class="dropify-render">
                                                    </span>
                                                    <div class="dropify-infos">
                                                        <div class="dropify-infos-inner">
                                                            <p class="dropify-filename"><span class="dropify-filename-inner"></span></p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="icon-choose"><i class="fas fa-cloud-upload-alt fa-5x"></i>
                                                    <p>Click here to select file</p>
                                                </div>
                                            </div>
                                        @endif
                                        </div>


                                        {{-- <input type="file" class="form-control-file" name="profile_picture"
                                            id="avatarFile" aria-describedby="fileHelp" required> --}}
                                    </div>
                                    <button type="submit" class="btn btn-primary w-100">Submit</button>
                                </form>


                             



                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->


                    </div>
                    <!-- /.col -->
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-header p-2">
                                <ul class="nav nav-pills">
                                    <li class="nav-item"><a class="nav-link active" href="#personal_info"
                                            data-toggle="tab">Personal Information</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#change_password"
                                            data-toggle="tab">Change Password</a></li>
                                </ul>
                            </div><!-- /.card-header -->
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="active tab-pane" id="personal_info">
                                        <form class="form-horizontal" method="POST" action="{{ route('adminUpdateInfo') }}"
                                            id="AdminInfoForm">
                                            @csrf
                                            <div class="form-group row">
                                                <label for="name" class="col-sm-2 col-form-label">First Name</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="name"
                                                        placeholder="First Name" value="{{ Auth::user()->name }}" name="name">

                                                    <span class="text-danger error-text name_error"></span>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="inputEmail"
                                                        placeholder="Email" value="{{ Auth::user()->email }}"
                                                        name="email">
                                                    <span class="text-danger error-text email_error"></span>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-10">
                                                    <button type="submit" class="btn btn-danger">Save Changes</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- /.tab-pane -->
                                    <div class="tab-pane" id="change_password">
                                        <form class="form-horizontal" action="{{ route('adminChangePassword') }}"
                                            method="POST" id="changePasswordAdminForm">
                                            @csrf
                                            <div class="form-group row">
                                                <label for="inputPass" class="col-sm-4 col-form-label">Old Password</label>
                                                <div class="col-sm-8">
                                                    <input type="password" class="form-control" id="inputPass"
                                                        placeholder="Enter current password" name="oldpassword">
                                                    <span class="text-danger error-text oldpassword_error"></span>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputName2" class="col-sm-4 col-form-label">New
                                                    Password</label>
                                                <div class="col-sm-8">
                                                    <input type="password" class="form-control" id="newpassword"
                                                        placeholder="Enter new password" name="newpassword">
                                                    <span class="text-danger error-text newpassword_error"></span>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputName2" class="col-sm-4 col-form-label">Confirm New
                                                    Password</label>
                                                <div class="col-sm-8">
                                                    <input type="password" class="form-control" id="cnewpassword"
                                                        placeholder="ReEnter new password" name="cnewpassword">
                                                    <span class="text-danger error-text cnewpassword_error"></span>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-10">
                                                    <button type="submit" class="btn btn-danger">Update Password</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <!-- /.tab-content -->
                            </div><!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>


    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(function() {
            /* UPDATE ADMIN PERSONAL INFO */
            $('#AdminInfoForm').on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    url: $(this).attr('action'),
                    method: $(this).attr('method'),
                    data: new FormData(this),
                    processData: false,
                    dataType: 'json',
                    contentType: false,
                    beforeSend: function() {
                        $(document).find('span.error-text').text('');
                    },
                    success: function(data) {
                        if (data.status == 0) {
                            $.each(data.error, function(prefix, val) {
                                $('span.' + prefix + '_error').text(val[0]);
                            });
                        } else {
                            $('.admin_name').each(function() {
                                $(this).html($('#AdminInfoForm').find($(
                                    'input[name="name"]')).val());
                            });
                           
                        }
                        if(data.status == 1) {
                            $("#success").show();
                            setTimeout(function() { $("#success").hide(); }, 5000);
                        }
                        else{
                            $("#error").show();
                            setTimeout(function() { $("#error").hide(); }, 5000);
                        }
                    }
                });
            });
            $('#changePasswordAdminForm').on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    url: $(this).attr('action'),
                    method: $(this).attr('method'),
                    data: new FormData(this),
                    processData: false,
                    dataType: 'json',
                    contentType: false,
                    beforeSend: function() {
                        $(document).find('span.error-text').text('');
                    },
                    success: function(data) {
                        if (data.status == 0) {
                            $.each(data.error, function(prefix, val) {
                                $('span.' + prefix + '_error').text(val[0]);
                            });
                        } else {
                            $('#changePasswordAdminForm')[0].reset();
                           
                        }
                        if(data.status == 1) {
                            $("#success-pwd").show();
                            setTimeout(function() { $("#success-pwd").hide(); }, 5000);
                        }
                        else{
                            $("#error-pwd").show();
                            setTimeout(function() { $("#error-pwd").hide(); }, 5000);
                        }
                    }
                });
            });

        });
    </script>
@endsection