@extends('layouts.master')
@section('title')
    {{ 'Admin List' }}
@endsection
@section('content')
    @include('layouts.admin.functions')
    @include('layouts.admin.flash-message')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Admin</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/admin">Home</a></li>
                            <li class="breadcrumb-item active">Admin</li>
                            <li class="breadcrumb-item active">Admin list</li>
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
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <h3 class="card-title float-none float-sm-left mb-3">Admin List</h3>
                            <a href="{{ route('user.create') }}">
                                <div class="btn btn-primary float-sm-right">
                                    <i class="fas fa-user fa-lg mr-2"></i>
                                    Add Admin
                                </div>
                            </a>
                        </div>

                        <div class="card-body">
                                    
                                    @if ($errors->has('role'))
                                        <div class="invalid-feedback">
                                            <i class="fa fa-times-circle-o"></i> {{ $errors->first('role') }}
                                        </div>
                                    @endif
                            <div class="table-overflow">
                                <table id="userdatatable"
                                    class="table table-bordered table-striped display responsive nowrap">
                                    <thead>
                                        <tr>
                                            <th width="5%">#</th>
                                            <th width="30%">Name</th>
                                            <th width="30%">Email</th>
                                            <th width="30%">User Type</th>
                                            <th width="25%">Created At</th>
                                            <th width="10%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
    <script>
        $(function() {
            var dataTable = $('#userdatatable').DataTable({
                processing: true,
                lengthChange: true,
                searching: true,
                ordering: true,
                serverSide: true,
                info: true,
                responsive: false,
                language: {
                    emptyTable: "No Admin Found"
                },
                ajax: {
                    url: "{{ route('user.index') }}",
                    data: function(data) {
                        data.filterUserType = $('#selectedUserType').val();
                    }
                },
                order: [
                    [1, "asc"]
                ],
                columns: [{
                        sTitle: "#",
                        data: "id",
                        name: "id",
                        orderable: false,
                        render: function(data, type, row, meta) {
                            var pageinfo = dataTable.page.info();
                            var currentpage = (pageinfo.page) * pageinfo.length;
                            var display_number = (meta.row + 1) + currentpage;
                            return display_number;
                        }
                    },
                    {
                        sTitle: "Name",
                        data: "name",
                        name: "name",
                        orderable: true,
                        searchable: true,
                        render: function(data, type, row, meta) {

                            var str = "";
                            str += '<div class="">';
                            str += '<div class="mr-2 float-left">';
                            if (row.profile_image) {
                                // var imgPath =
                                //     '{{ route('adminimage.displayUserImage', ['foldername' => 'user_images', 'filename' => ':profile_picture']) }}';
                                imgPath = row.profile_image;
                                str +=
                                    '<img class="user-image" width="42" height="42" id="imageview" src="{{asset("/")}}'+imgPath+'" alt="user-logo" >';
                            } else {
                                str +=
                                    '<img class="user-image" width="42" height="42" src="{{asset("/account.png")}}"  alt="user-logo">';
                            }
                            str += '</div>';

                            str += '<div class="float-left">';
                            str += '<div class="">';
                            str += '<span class="mr-2 text-bold">' + row.name + '</span>';
                            str += '</div>';
                            str += '<div class="text-muted text-sm">' + row.role + '</div>';
                            str += '</div>';
                            str += '</div>';
                            return str;
                        }
                    },
                    {
                        sTitle: "Email",
                        data: "email",
                        name: "email",
                        orderable: true,
                        searchable: true
                    },
                    {
                        sTitle: "User Type",
                        data: "role",
                        name: "role",
                        orderable: true,
                        searchable: true,
                    },
                    {
                        sTitle: "Created At",
                        data: "display_created_at",
                        name: "created_at",
                        orderable: true,
                        searchable: true
                    },
                    {
                        sTitle: "Action",
                        data: "action",
                        name: "action",
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row, meta) {
                            var edit_url = '{{ route('user.edit', ':id') }}';
                            edit_url = edit_url.replace(':id', row.id);
                            var str = "";
                            str += '<div class="btn-group">';
                            if (row.status == 'Active') {
                                str += '<a title="Status" id="' + row.id +
                                    '" class="btn btn-success status_active" href="javascript:;" data-id="' +
                                    row.id + '"><i class="fas fa-check-circle"></i></a>';
                            } else {
                                str += '<a title="Status" id="' + row.id +
                                    '" class="btn btn-default status_active" href="javascript:;" data-id="' +
                                    row.id + '"><i class="fas fa-ban"></i></a>';
                            }
                            str += '<a title="Edit" id="' + row.id +
                                '" class="btn btn-warning edit_icon icon user-edit" href="' +
                                edit_url + '"><i class="fas fa-edit"></i></a>';
                            str += '<a title="Delete" id="' + row.id +
                                '" class="btn btn-danger delete_icon icon delete_record" data-tooltip="Delete" href="javascript:;" data-id="' +
                                row.id + '" data-toggle="modal" data-target="#modal-sm-' + row.id +
                                '"><i class="fas fa-trash"></i></a>'
                            str += '</div>';
                            return str;
                        }
                    }
                ],
                fnRowCallback: function(nRow, aData, iDisplayIndex) {
                    return nRow;
                },
                fnDrawCallback: function(oSettings) {
                    // Delete Record
                    $('.status_active').on('click', function(e) {
                        let statusId = $(this).attr("data-id");
                        let url = "user/active-deactive";
                        self.confirmStatus(statusId, url, dataTable);
                    });
                    $('.delete_record').on('click', function(e) {
                        let delId = $(this).attr("data-id");
                        let url = "user/" + delId;
                        self.confirmDelete(delId, url, dataTable);
                    });
                },
                fnInitComplete: function(oSettings, json) {},
                createdRow: function(row, data, dataIndex) {}
            });

            // Dropdown FilterBy User Type
            $("#userdatatable_filter.dataTables_filter").append($("#selectedUserType"));
            $("#selectedUserType").change(function(event) {
                // console.log(event.target.value);
                dataTable.draw();
            });

        });
    </script>
@endsection
