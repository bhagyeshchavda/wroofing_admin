@extends('layouts.master')
@section('title')
    {{ 'Contractor List' }}
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
                        <h1 class="m-0 text-dark">Contractor</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/admin">Home</a></li>
                            <li class="breadcrumb-item active">Contractor</li>
                            <li class="breadcrumb-item active">Contractor list</li>
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
                            <div class="col-md-3">
                                <h3 class="card-title float-none float-sm-left mb-3">Contractor List</h3>
                            </div>
                            <div class="col-md-9">
                                <div class="box-button">
                                    <a href="" class="btn-excel-export">
                                        <i class="fas fa-file-excel"></i> Export Contractor Data
                                    </a>
                                </div>
                            </div>
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
                                            <th width="30%">Phone</th>
                                            <th width="30%">Company Name</th>
                                            <th width="30%">Address</th>
                                            <th width="30%">Zip Code</th>
                                            <th width="25%">Created At</th>
                                            {{-- <th width="10%">Action</th> --}}
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
                responsive: true,
                language: {
                    emptyTable: "No Customer Found"
                },
                ajax: {
                    url: "{{ route('admin.contractor.index') }}",
                    data: function(data) {
                        data.filterUserType = $('#selectedUserType').val();
                    }
                },
                order: [
                    [7, "desc"]
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
                        sTitle: "Contractor Name",
                        data: "name",
                        name: "name",
                        orderable: true,
                        searchable: true,
                        render: function(data, type, row, meta) {
                            var initials = row.name.split(' ').map(word => word[0].toUpperCase()).join('').slice(0, 2);
                            var str = "";
                            str += '<div class="d-flex align-items-center"><div class="avatar mr-3">'+initials+'</div><div class=""><p class="font-weight-bold mb-0">'+row.name.toUpperCase()+'</p><p class="text-muted mb-0">contractor&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p></div></div>';
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
                        sTitle: "Phone",
                        data: "contact_number",
                        name: "contact_number",
                        orderable: true,
                        searchable: true,
                        render: function(data, type, row, meta) {
                            var str = "";
                            if (row.contact_number == 'null' || row.contact_number == null) {
                                str += 'not found';
                            }else{
                                str += row.contact_number;
                            }
                            return str;
                        },
                    },
                    {
                        sTitle: "Address",
                        data: "address",
                        name: "address",
                        orderable: true,
                        searchable: true,
                        render: function(data, type, row, meta) {
                            if(data != null){
                                if(data.length > 100){
                                    var small = data.slice(0, 50);
                                    var str = '';
                                    str += '<div class="small-data">'+small+'...<a href="javascript:void(0)" class="show-more">Show more</a></div>';
                                    str += '<div style="display:none;" class="big-data">'+data+'<a href="javascript:void(0)" class="show-less">Show less</a></div>';
                                    return str;
                                } else {
                                    return data;
                                }
                            }else{
                                return 'not found';
                            }
                        },
                    },
                    {
                        sTitle: "Company Name",
                        data: "company_name",
                        name: "company_name",
                        orderable: true,
                        searchable: true,
                        render: function(data, type, row, meta) {
                            var str = "";
                            if (row.company_name == 'null' || row.company_name == null) {
                                str += 'not found';
                            }else{
                                str += row.company_name;
                            }
                            return str;
                        },
                    },
                    {
                        sTitle: "Zip Code",
                        data: "zip_code",
                        name: "zip_code",
                        orderable: true,
                        searchable: true,
                        render: function(data, type, row, meta) {
                            var str = "";
                            if (row.zip_code == 'null' || row.zip_code == null) {
                                str += 'not found';
                            }else{
                                str += row.zip_code;
                            }
                            return str;
                        },
                    },
                    {
                        sTitle: "Created At",
                        data: "display_created_at",
                        name: "created_at",
                        orderable: true,
                        searchable: true
                    },
                    // {
                    //     sTitle: "Action",
                    //     data: "action",
                    //     name: "action",
                    //     orderable: false,
                    //     searchable: false,
                    //     render: function(data, type, row, meta) {
                    //         var edit_url = '{{ route('user.edit', ':id') }}';
                    //         edit_url = edit_url.replace(':id', row.id);
                    //         var str = "";
                    //         str += '<div class="btn-group">';
                    //         if (row.status == 'Active') {
                    //             str += '<a title="Status" id="' + row.id +
                    //                 '" class="btn btn-success status_active" href="javascript:;" data-id="' +
                    //                 row.id + '"><i class="fas fa-check-circle"></i></a>';
                    //         } else {
                    //             str += '<a title="Status" id="' + row.id +
                    //                 '" class="btn btn-default status_active" href="javascript:;" data-id="' +
                    //                 row.id + '"><i class="fas fa-ban"></i></a>';
                    //         }
                    //         str += '<a title="Edit" id="' + row.id +
                    //             '" class="btn btn-warning edit_icon icon user-edit" href="' +
                    //             edit_url + '"><i class="fas fa-edit"></i></a>';
                    //         str += '<a title="Delete" id="' + row.id +
                    //             '" class="btn btn-danger delete_icon icon delete_record" data-tooltip="Delete" href="javascript:;" data-id="' +
                    //             row.id + '" data-toggle="modal" data-target="#modal-sm-' + row.id +
                    //             '"><i class="fas fa-trash"></i></a>'
                    //         str += '</div>';
                    //         return str;
                    //     }
                    // }
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
                createdRow: function(row, data, dataIndex) {
                    var avatar = $('td:eq(1) .avatar', row);
                    console.log(avatar);
                    if (dataIndex % 2 === 0) {
                        avatar.addClass('avatar-pink');
                    } else {
                        avatar.addClass('avatar-blue');
                    }
                }
            });

            // Dropdown FilterBy User Type
            $("#userdatatable_filter.dataTables_filter").append($("#selectedUserType"));
            $("#selectedUserType").change(function(event) {
                // console.log(event.target.value);
                dataTable.draw();
            });

            $('#userdatatable_wrapper tbody').on('click', '.show-more', function() {
                var $row = $(this).closest('tr');
                $row.find('.small-data').hide();
                $row.find('.big-data').show();
            });

            $('#userdatatable_wrapper tbody').on('click', '.show-less', function() {
                var $row = $(this).closest('tr');
                $row.find('.small-data').show();
                $row.find('.big-data').hide();
            }); 
            // Bind click events to custom export buttons
            $('.box-button .btn-excel-export').on('click', function(e){
                e.preventDefault();
                console.log('Excel export clicked');
                // Add your Excel export functionality here
                // Export to Excel action
                window.location.href = "{{ route('contractor.export.excel') }}";
            });
        });
    </script>
    <style>
        #userdatatable {
            max-width: 100% !important;
        }
        #userdatatable td {
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: break-spaces;
        }
        .avatar {
            width: 2.75rem;
            height: 2.75rem;
            line-height: 2.8rem;
            border-radius: 50%;
            display: inline-block;
            background: transparent;
            position: relative;
            text-align: center;
            color: #868e96;
            font-weight: 700;
            vertical-align: bottom;
            font-size: 1rem;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }
        .avatar-blue {
            background-color: #c8d9f1;
            color: #467fcf;
        }
        .avatar-pink {
            background-color: #fcd3e1;
            color: #f66d9b;
        }
        .card-header {
                display: flex;
                justify-content: space-between;
                align-items: center;
            }

            .box-button a {
                background-color: #4CAF50; /* Green background */
                color: white;             /* White text */
                border: none;             /* No border */
                padding: 10px 20px;       /* Some padding */
                margin-left: 10px;        /* Space between buttons */
                text-decoration: none;    /* Remove underline */
                display: inline-flex;     /* Align items inline */
                align-items: center;      /* Center align items */
                cursor: pointer;          /* Pointer/hand icon */
                border-radius: 4px;       /* Rounded corners */
            }

            .box-button a:hover {
                background-color: #45a049; /* Darker green on hover */
            }

            .box-button a.btn-pdf-export {
                background-color: #f44336; /* Red background */
            }

            .box-button a.btn-pdf-export:hover {
                background-color: #e53935; /* Darker red on hover */
            }

            .box-button i {
                margin-right: 5px; /* Space between icon and text */
            }
            .box-button {
                float: inline-end;
            }
    </style>
@endsection
