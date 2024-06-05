@extends('layouts.master')
@section('title') {{$postList['title']}} @endsection
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
</style>
    @include('layouts.admin.functions')
    @include('layouts.admin.flash-message')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">{{$postList['title']}}</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{env('APP_URL')}}/admin">Dashboard</a></li>
                            @if($postList['page_id'] == NUll)
                            <li class="breadcrumb-item active">{{$postList['title']}}</li>
                            @endif
                            @if($postList['folderBreadcrumb'] != NUll)
                            <li class="breadcrumb-item active"><a href="{{ route('admin.media.index') }}">{{$postList['title']}}</a></li>
                                @php 
                                    echo $postList['folderBreadcrumb'];
                                @endphp 
                            @endif
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-12">
                     <!-- START EDITOR -->
                     @component('components.medialist', ['entities' => $postList])
                     @endcomponent
                     <!-- END EDITOR -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
@endsection
