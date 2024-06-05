@extends('layouts.master')
@section('title')
    {{ 'Dashboard' }}
@endsection
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Dashboard</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-success">
                            <div class="inner">
                                @if (isset($userData['userCount']))
                                    <h3>{{ $userData['userCount'] }}</h3>
                                @else
                                    <h3>0</h3>
                                @endif
                                <p>Customers</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-ios-people-outline"></i>
                            </div>
                            <a href="{{ route('admin.customer.index') }}" class="small-box-footer"> All Customers <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-warning">
                            <div class="inner">
                                @if (isset($userData['contractorCount']))
                                    <h3>{{ $userData['contractorCount'] }}</h3>
                                @else
                                    <h3>0</h3>
                                @endif
                                <p>Contractors</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-android-people"></i>
                            </div>
                            <a href="{{ route('admin.contractor.index') }}" class="small-box-footer">
                                All Contractors <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-danger">
                            <div class="inner">
                                @if (isset($userData['contactCount']))
                                    <h3>{{ $userData['contactCount'] }}</h3>
                                @else
                                    <h3>0</h3>
                                @endif
                                <p>Contact Inquiries</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-email"></i>
                            </div>
                            <a href="{{ route('admin.contacts') }}" class="small-box-footer">
                                All Contacts <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                    <!-- ./col -->
                </div>
                <!-- /.row -->
                <!-- Main row -->
                <div class="row">

                </div>
                <!-- /.row (main row) -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
