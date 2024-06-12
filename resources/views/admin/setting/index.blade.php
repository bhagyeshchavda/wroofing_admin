@extends('layouts.master')
@section('title') {{'General Setting'}} @endsection
@section('content')
<div id="admin-overlay">
    <div class="cv-spinner">
        <span class="spinner"></span>
    </div>
</div>
<style>
    #admin-overlay {
        position: fixed;
        top: 0;
        z-index: 99999;
        width: 100%;
        height: 100%;
        display: none;
        background: rgba(0,0,0,.5);
    }
    #admin-overlay .cv-spinner {
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    #admin-overlay .cv-spinner .spinner {
        width: 40px;
        height: 40px;
        border: 4px #ddd solid;
        border-top: 4px #186bc3 solid;
        border-radius: 50%;
        animation: sp-anime .8s infinite linear;
    }
    @keyframes sp-anime {
        100% {
            transform: rotate(360deg);
        }
    }
    .nav-tabs.flex-column {
        border-top: 1px solid #dee2e6;
        border-radius: .25rem;
    }
</style>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Settings</h1>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
                        <li class="breadcrumb-item active">General Settings</li>
                    </ol>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
            <!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
    </div>
    <section class="content">
        <div class="container">
            <form class="form" id="updatesave" method="post" action="#" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <div id="success-msg" class="alert alert-success" style="display:none;">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">�</button>
                                </div>
                                <h3 class="card-title">
                                    <i class="fas fa-edit"></i>
                                    General settings
                                </h3>
                                <div class="btn-group float-sm-right">
                                    <button type="submit" class="btn btn-success px-4"><i class="fa fa-edit"></i> Save Setting</button>
                                    <button type="button" class="btn btn-warning cancel-button px-3"><i class="fa fa-refresh"></i> Reset
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-5 col-sm-3">
                                        <div class="nav flex-column nav-tabs h-100" id="vert-tabs-tab" role="tablist" aria-orientation="vertical">
                                            <a class="nav-link active" id="vert-tabs-front-tab" data-toggle="pill" href="#vert-tabs-front" role="tab" aria-controls="vert-tabs-front" aria-selected="false">Front setting</a>
                                            <a class="nav-link" id="vert-tabs-admin-tab" data-toggle="pill" href="#vert-tabs-admin" role="tab" aria-controls="vert-tabs-admin" aria-selected="false">Admin setting</a>
                                        </div>
                                    </div>
                                    <div class="col-7 col-sm-9">
                                        <div class="tab-content" id="vert-tabs-tabContent">
                                            <div class="tab-pane text-left fade active show" id="vert-tabs-front" role="tabpanel" aria-labelledby="vert-tabs-general-tab">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="form-group row">  
                                                            <div class="col-sm-6 col-md-6">
                                                                <label class="col-form-label">Front Favicon</label>
                                                                <div class="form-image text-center @if(isset($data['gs_front_ficon']) && $data['gs_front_ficon'] != '') previewing  @endif">
                                                                    <a href="javascript:void(0)" class="image-clear" style="display: none"><i
                                                                            class="fa fa-times-circle fa-2x"></i>
                                                                    </a>
                                                                    @if(!empty(isset($data['gs_front_ficon'])) && $data['gs_front_ficon'] != '')
                                                                        <a href="javascript:void(0)" class="image-clear">
                                                                            <i class="fa fa-times-circle fa-2x"></i>
                                                                        </a>
                                                                        <input type="hidden" name="gs_front_ficon" class="input-path" value="{{$data['gs_front_ficon']}}"/>      
                                                                    @else
                                                                        <input type="hidden" name="gs_front_ficon" class="input-path" value=""/>      
                                                                    @endif
                                                                    <div class="dropify-preview image-hidden" @if ($data) @if(isset($data['gs_front_ficon']) && $data['gs_front_ficon'] != '') style="display: block" @endif @endif>
                                                                        <span class="dropify-render">
                                                                            @if (isset($data['gs_front_ficon']))
                                                                                @if ($data['gs_front_ficon'])
                                                                                    <img src="{{ asset($data['gs_front_ficon']) }}" alt="fevicon"/>
                                                                                @endif
                                                                            @endif
                                                                        </span>
                                                                        <div class="dropify-infos">
                                                                            <div class="dropify-infos-inner">
                                                                                <p class="dropify-filename"><span class="dropify-filename-inner"></span></p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="icon-choose">
                                                                        <i class="fas fa-cloud-upload-alt fa-5x"></i>
                                                                        <p>Click here to select file</p>
                                                                    </div>
                                                                    <span class="text-danger error-text old_favicon_error"></span>
                                                                </div>
                                                            </div>  
                                                            
                                                            <div class="col-sm-6 col-md-6">
                                                                <label class="col-form-label">Front Header Logo</label>
                                                                <div class="form-image text-center  @if(isset($data['gs_front_logo']) && $data['gs_front_logo'] != '') previewing @endif">
                                                                    <a href="javascript:void(0)" class="image-clear" style="display: none"><i
                                                                            class="fa fa-times-circle fa-2x"></i>
                                                                    </a>
                                                                    @if(!empty($data) && isset($data['gs_front_logo']) && $data['gs_front_logo'] != '')
                                                                        <a href="javascript:void(0)" class="image-clear">
                                                                            <i class="fa fa-times-circle fa-2x"></i>
                                                                        </a>
                                                                        <input type="hidden" name="gs_front_logo" class="input-path" value="{{$data['gs_front_logo']}}"/>      
                                                                    @else
                                                                        <input type="hidden" name="gs_front_logo" class="input-path" value=""/>      
                                                                    @endif
                                                                    <div class="dropify-preview image-hidden" @if ($data) @if(isset($data['gs_front_logo']) && $data['gs_front_logo'] != '') style="display: block" @endif @endif>
                                                                        <span class="dropify-render">
                                                                            @if (isset($data['gs_front_logo']))
                                                                                @if ($data['gs_front_logo'])
                                                                                    <img src="{{ asset($data['gs_front_logo']) }}" alt="admin-logo"/>
                                                                                @endif
                                                                            @endif
                                                                        </span>
                                                                        <div class="dropify-infos">
                                                                            <div class="dropify-infos-inner">
                                                                                <p class="dropify-filename"><span class="dropify-filename-inner"></span></p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="icon-choose">
                                                                        <i class="fas fa-cloud-upload-alt fa-5x"></i>
                                                                        <p>Click here to select file</p>
                                                                    </div>
                                                                    <span class="text-danger error-text old_favicon_error"></span>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-12 col-md-12">
                                                                <label class="col-form-label">Enter Email Header Logo</label>
                                                                <div class="form-image text-center @if(isset($data['gs_front_logo']) && $data['gs_front_logo'] != '') previewing @endif">
                                                                    <a href="javascript:void(0)" class="image-clear" style="display: none"><i
                                                                            class="fa fa-times-circle fa-2x"></i>
                                                                    </a>
                                                                    @if(!empty($data) && isset($data['gs_email_logo']) && $data['gs_email_logo'] != '')
                                                                        <a href="javascript:void(0)" class="image-clear">
                                                                            <i class="fa fa-times-circle fa-2x"></i>
                                                                        </a>
                                                                        <input type="hidden" name="gs_email_logo" class="input-path" value="{{$data['gs_email_logo']}}"/>      
                                                                    @else
                                                                        <input type="hidden" name="gs_email_logo" class="input-path" value=""/>      
                                                                    @endif
                                                                    <div class="dropify-preview image-hidden" @if ($data) @if(isset($data['gs_front_logo']) && $data['gs_front_logo'] != '') style="display: block" @endif @endif>
                                                                        <span class="dropify-render">
                                                                            @if (isset($data['gs_email_logo']))
                                                                                @if ($data['gs_email_logo'])
                                                                                    <img src="{{ asset($data['gs_email_logo']) }}" alt="admin-logo"/>
                                                                                @endif
                                                                            @endif
                                                                        </span>
                                                                        <div class="dropify-infos">
                                                                            <div class="dropify-infos-inner">
                                                                                <p class="dropify-filename"><span class="dropify-filename-inner"></span></p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="icon-choose">
                                                                        <i class="fas fa-cloud-upload-alt fa-5x"></i>
                                                                        <p>Click here to select file</p>
                                                                    </div>
                                                                    <span class="text-danger error-text old_favicon_error"></span>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-4 col-md-4">
                                                                <label class="col-form-label">Enter Header Email</label>
                                                                @if(isset($data['front_email']) && $data['front_email'] != '')
                                                                    <input class="form-control form-control-solid" value="{{$data['front_email']}}" type="text" name="front_email" placeholder="Enter Email Address" />
                                                                @else
                                                                    <input class="form-control form-control-solid" type="text" name="front_email" placeholder="Enter Email Address" />
                                                                @endif
                                                            </div>
                                                            <div class="col-sm-4 col-md-4">
                                                                <label class="col-form-label">Enter Header Phone</label>
                                                                @if(isset($data['front_phone']) && $data['front_phone'] != '')
                                                                    <input class="form-control form-control-solid" value="{{$data['front_phone']}}" type="text" name="front_phone" placeholder="Enter Phone" />
                                                                @else
                                                                    <input class="form-control form-control-solid" type="text" name="front_phone" placeholder="Enter Phone" />
                                                                @endif
                                                            </div>
                                                            <div class="col-sm-4 col-md-4">
                                                                <label class="col-form-label">Enter Header Website</label>
                                                                @if(isset($data['front_website']) && $data['front_website'] != '')
                                                                    <input class="form-control form-control-solid" value="{{$data['front_website']}}" type="text" name="front_website" placeholder="Enter Website" />
                                                                @else
                                                                    <input class="form-control form-control-solid" type="text" name="front_website" placeholder="Enter Website" />
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>	 
                                            </div>
                                        
                                            <div class="tab-pane text-left fade" id="vert-tabs-admin" role="tabpanel" aria-labelledby="vert-tabs-general-tab">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="form-group row">  
                                                            <div class="col-sm-4 col-md-4">
                                                                <label class="col-form-label">Favicon</label>
                                                                <div class="form-image text-center previewing">
                                                                    <a href="javascript:void(0)" class="image-clear" style="display: none"><i
                                                                            class="fa fa-times-circle fa-2x"></i>
                                                                    </a>
                                                                    @if(!empty(isset($data['gs_ficon'])))
                                                                        <a href="javascript:void(0)" class="image-clear">
                                                                            <i class="fa fa-times-circle fa-2x"></i>
                                                                        </a>
                                                                        <input type="hidden" name="gs_ficon" class="input-path" value="{{$data['gs_ficon']}}"/>      
                                                                    @else
                                                                        <input type="hidden" name="gs_ficon" class="input-path" value=""/>      
                                                                    @endif
                                                                    <div class="dropify-preview image-hidden" @if ($data) @if($data['gs_ficon']) style="display: block" @endif @endif>
                                                                        <span class="dropify-render">
                                                                            @if (isset($data['gs_ficon']))
                                                                                @if ($data['gs_ficon'])
                                                                                    <img src="{{ asset($data['gs_ficon']) }}" alt="fevicon"/>
                                                                                @endif
                                                                            @endif
                                                                        </span>
                                                                        <div class="dropify-infos">
                                                                            <div class="dropify-infos-inner">
                                                                                <p class="dropify-filename"><span class="dropify-filename-inner"></span></p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="icon-choose">
                                                                        <i class="fas fa-cloud-upload-alt fa-5x"></i>
                                                                        <p>Click here to select file</p>
                                                                    </div>
                                                                    <span class="text-danger error-text old_favicon_error"></span>
                                                                </div>
                                                            </div>  
                                                            <div class="col-sm-4 col-md-4">
                                                                <label class="col-form-label">Sidebar Icon</label>
                                                                <div class="form-image text-center previewing">
                                                                    <a href="javascript:void(0)" class="image-clear" style="display: none"><i
                                                                            class="fa fa-times-circle fa-2x"></i>
                                                                    </a>
                                                                    @if(!empty($data) && isset($data['gs_sidebaricon']))
                                                                        <a href="javascript:void(0)" class="image-clear">
                                                                            <i class="fa fa-times-circle fa-2x"></i>
                                                                        </a>
                                                                        <input type="hidden" name="gs_sidebaricon" class="input-path" value="{{$data['gs_sidebaricon']}}"/>      
                                                                    @else
                                                                        <input type="hidden" name="gs_sidebaricon" class="input-path" value=""/>      
                                                                    @endif
                                                                    <div class="dropify-preview image-hidden" @if ($data) @if(isset($data['gs_sidebaricon'])) style="display: block" @endif @endif>
                                                                        <span class="dropify-render">
                                                                            @if (isset($data['gs_sidebaricon']))
                                                                                @if ($data['gs_sidebaricon'])
                                                                                    <img src="{{ asset($data['gs_sidebaricon']) }}" alt="sidebar-icon"/>
                                                                                @endif
                                                                            @endif
                                                                        </span>
                                                                        <div class="dropify-infos">
                                                                            <div class="dropify-infos-inner">
                                                                                <p class="dropify-filename"><span class="dropify-filename-inner"></span></p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="icon-choose">
                                                                        <i class="fas fa-cloud-upload-alt fa-5x"></i>
                                                                        <p>Click here to select file</p>
                                                                    </div>
                                                                    <span class="text-danger error-text old_favicon_error"></span>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-4 col-md-4">
                                                                <label class="col-form-label">Admin Logo</label>
                                                                <div class="form-image text-center previewing">
                                                                    <a href="javascript:void(0)" class="image-clear" style="display: none"><i
                                                                            class="fa fa-times-circle fa-2x"></i>
                                                                    </a>
                                                                    @if(!empty($data) && isset($data['gs_adminlogo']))
                                                                        <a href="javascript:void(0)" class="image-clear">
                                                                            <i class="fa fa-times-circle fa-2x"></i>
                                                                        </a>
                                                                        <input type="hidden" name="gs_adminlogo" class="input-path" value="{{$data['gs_adminlogo']}}"/>      
                                                                    @else
                                                                        <input type="hidden" name="gs_adminlogo" class="input-path" value=""/>      
                                                                    @endif
                                                                    <div class="dropify-preview image-hidden" @if ($data) @if(isset($data['gs_adminlogo'])) style="display: block" @endif @endif>
                                                                        <span class="dropify-render">
                                                                            @if (isset($data['gs_adminlogo']))
                                                                                @if ($data['gs_adminlogo'])
                                                                                    <img src="{{ asset($data['gs_adminlogo']) }}" alt="admin-logo"/>
                                                                                @endif
                                                                            @endif
                                                                        </span>
                                                                        <div class="dropify-infos">
                                                                            <div class="dropify-infos-inner">
                                                                                <p class="dropify-filename"><span class="dropify-filename-inner"></span></p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="icon-choose">
                                                                        <i class="fas fa-cloud-upload-alt fa-5x"></i>
                                                                        <p>Click here to select file</p>
                                                                    </div>
                                                                    <span class="text-danger error-text old_favicon_error"></span>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-12 col-md-12">
                                                                <label class="col-form-label">Title prifix name</label>
                                                                @if(isset($data['gs_sitetitle']))
                                                                    <input class="form-control form-control-solid" value="{{$data['gs_sitetitle']}}" type="text" name="gs_sitetitle" placeholder="Enter Admin Side Title" />
                                                                @else
                                                                    <input class="form-control form-control-solid" type="text" name="gs_sitetitle" placeholder="Enter Admin Side Title" />
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>	 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <style>
        #updatesave .nav-tabs.flex-column .nav-link.active {
            background: #007bff;
            color: #fff;
            text-transform: capitalize;
        }
        #updatesave .nav-tabs.flex-column .nav-link{
            text-transform: capitalize;
        }
    </style>
    <script>
        function toggle_global_loading(status, timeout = 300) {
            if (status) {
                $("#admin-overlay").fadeIn(300);
            } else {
                setTimeout(function () {
                    $("#admin-overlay").fadeOut(300);
                }, timeout);
        }
        }
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(function () {
            /* UPDATE ADMIN PERSONAL INFO */
            $('#updatesave').on('submit', function (e) {
                e.preventDefault();
                toggle_global_loading(true);
                var formData = $(this).serialize();
                $.ajax({
                    type: 'POST',
                    url: "{{ route('settings-update')  }}",
                    dataType: 'json',
                    data: {
                        'formData': formData,
                        "_token": "{{ csrf_token() }}",
                    }
                }).done(function (data) {
                    if (data.status == 0) {
                        $.each(data.error, function (prefix, val) {
                            $('span.' + prefix + '_error').text(val[0]);
                        });
                    }
                    if (data.status == 1) {
                        toggle_global_loading(false);
                        $("#success").show();
                        $('#success-msg').text(data.msg).show();
                        setTimeout(function () {
                            $("#success-msg").hide();
                        }, 5000);
                    }
                    return false;
                }).fail(function (data) {
                    $("#error-msg").text(data.msg).show();
                    setTimeout(function () {
                        $("#error-msg").hide();
                    }, 5000);
                    return false;
                });
            });
        });
    </script>
</div>
@endsection