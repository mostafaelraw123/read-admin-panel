@extends('admin.layouts.layout')
@section('styles')
    <!-- Data Tables -->
    <link rel="stylesheet" href="{{asset('admin')}}/vendor/datatables/dataTables.bs4.css" />
    <link rel="stylesheet" href="{{asset('admin')}}/vendor/datatables/dataTables.bs4-custom.css" />
    <link href="{{asset('admin')}}/vendor/datatables/buttons.bs.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('admin')}}/vendor/bs-select/bs-select.css" />

    @include('admin.layouts.loader.loaderCss')
@endsection

@section('page-title')
   {{__('admin.Notification')}}
@endsection

@section('page-links')
    <li class="breadcrumb-item active ">
        {{__('admin.Notification')}}
    </li>

@endsection

@section('content')

    <div class="row gutters">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="table-container">
                <div class="t-header">
                    <button id="checkAll" class="btn btn-info pull-left"> {{__('admin.All')}} <span class="icon-check"></span>  </button>
                    <button id="bulk_delete" class="btn btn-danger pull-left"> {{__('admin.DeletingAll')}} <span class="icon-delete"></span>  </button>
                </div>
                <div class="table-responsive">

                    <table id="basicExample" class="table custom-table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>{{__('admin.Image')}}</th>
                            <th>{{__('admin.name')}}</th>
                            <th>{{__('admin.email')}}</th>
                            <th>{{__('admin.NotificationType')}}</th>
                            <th>{{__('admin.NotificationTitle')}} </th>
                            <th> {{__('admin.NotificationStatus')}}</th>
                            <th>{{__('admin.Controls')}}</th>
                            <th>{{__('admin.CreatedAt')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div id="messages"></div>
@endsection

@section('js')

    <!-- Data Tables -->
    <script src="{{asset('admin')}}/vendor/datatables/dataTables.min.js"></script>
    <script src="{{asset('admin')}}/vendor/datatables/dataTables.bootstrap.min.js"></script>

    <!-- Custom Data tables -->
    {{--   <script src="{{asset('admin')}}/vendor/datatables/custom/custom-datatables.js"></script>--}}
    <script src="{{asset('admin')}}/vendor/datatables/custom/fixedHeader.js"></script>
    <script src="{{asset('admin')}}/vendor/bs-select/bs-select.min.js"></script>

    <!-- Download / CSV / Copy / Print -->
    {{--    <script src="{{asset('admin')}}/vendor/datatables/buttons.min.js"></script>
        <script src="{{asset('admin')}}/vendor/datatables/jszip.min.js"></script>
        <script src="{{asset('admin')}}/vendor/datatables/pdfmake.min.js"></script>
        <script src="{{asset('admin')}}/vendor/datatables/vfs_fonts.js"></script>
        <script src="{{asset('admin')}}/vendor/datatables/html5.min.js"></script>
        <script src="{{asset('admin')}}/vendor/datatables/buttons.print.min.js"></script>--}}
    <script>
        //loader in js
        var loader = ` <div class="linear-background">
                            <div class="inter-crop"></div>
                            <div class="inter-right--top"></div>
                            <div class="inter-right--bottom"></div>
                        </div>
        `;
        var messages = $('#messages').notify({
            type: 'messages',
            removeIcon: '<i class="icon-close"></i>'
        });
        //========================================================================
        //========================================================================
        //========================================================================
        //========================================================================
        //datatable
        var table =$("#basicExample").DataTable({
            dom: 'Bfrtip',
            responsive: 1,
            "processing": true,
            "lengthChange": true,
            "serverSide": true,
            "ordering": true,
            "searching": true,
            'iDisplayLength': 30,
            "ajax": "{{route('notifications.index')}}",

            "columns": [
                {"data": "delete_all", orderable: false, searchable: false},
                {"data": "logo", orderable: false, searchable: false},
                {"data": "name",   orderable: false,searchable: true},
                {"data": "email",   orderable: false,searchable: false},
                {"data": "type",   orderable: false,searchable: false},
                {"data": "title",   orderable: false,searchable: false},
                {"data": "is_read",   orderable: false,searchable: false},
                {"data": "created_at", searchable: false},
                {"data": "actions", orderable: false, searchable: false}
            ],
            "language": {
                "sProcessing":   "{{trans('admin.sProcessing')}}",
                "sLengthMenu":   "{{trans('admin.sLengthMenu')}}",
                "sZeroRecords":  "{{trans('admin.sZeroRecords')}}",
                "sInfo":         "{{trans('admin.sInfo')}}",
                "sInfoEmpty":    "{{trans('admin.sInfoEmpty')}}",
                "sInfoFiltered": "{{trans('admin.sInfoFiltered')}}",
                "sInfoPostFix":  "",
                "sSearch":       "{{trans('admin.sSearch')}}:",
                "sUrl":          "",
                "oPaginate": {
                    "sFirst":    "{{trans('admin.sFirst')}}",
                    "sPrevious": "{{trans('admin.sPrevious')}}",
                    "sNext":     "{{trans('admin.sNext')}}",
                    "sLast":     "{{trans('admin.sLast')}}"
                }
            },
            order: [
                [2, "desc"]
            ],
        })
        //===================================================================
        $(document).on('click', '.makeRead', function () {
            var id = $(this).attr('id');
            swal({
                title: "{{__('admin.Are You Sure')}}",
                text: "{{__('admin.NotificationIsReading')}}",
                type: "info",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "{{__('admin.accept')}}",
                cancelButtonText: "{{__('admin.cancel')}}",
                okButtonText: "{{__('admin.accept')}}",
                closeOnConfirm: false
            }, function () {
                var url = '{{ route("makeRead", ":id") }}';
                url = url.replace(':id', id);
                console.log(url);
                $.ajax({
                    url: url,
                    type: 'get',
                    data: {id: id},
                    success: function (data) {
                        swal.close()

                        messages.show("{{__('admin.SuccessMessage')}}", {
                            type: 'success',
                            title: '',
                            icon: '<i class="jq-icon-success"></i>',
                            delay:2000,
                        });

                        $('#basicExample').DataTable().ajax.reload();

                    },error: function(data) {
                        swal.close()
                        messages.show("{{__('admin.You Need A permissions To Do That')}}", {
                            type: 'danger',
                            title: '',
                            icon: '<i class="icon-error"></i>',
                            delay:2000,
                        });
                    }

                });
            });
        });
        //========================================================================
        //========================================================================
        //============================Delete======================================
        //========================================================================
        //delete one row
        $(document).on('click', '.delete', function () {
            var id = $(this).attr('id');
            swal({
                title: "{{__('admin.Are You Sure')}}",
                text: "{{__('admin.You Can not to rollback')}}",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "{{__('admin.accept')}}",
                cancelButtonText: "{{__('admin.cancel')}}",
                okButtonText: "{{__('admin.accept')}}",
                closeOnConfirm: false
            }, function () {
                var url = '{{ route("notifications.destroy", ":id") }}';
                url = url.replace(':id', id);
                console.log(url);
                $.ajax({
                    url: url,
                    type: 'DELETE',
                    data: {id: id},
                    success: function (data) {
                        swal.close()
                        messages.show("{{__('admin.SuccessMessage')}}", {
                            type: 'success',
                            title: '',
                            icon: '<i class="jq-icon-success"></i>',
                            delay:2000,
                        });
                        $('#basicExample').DataTable().ajax.reload();
                    },error: function(data) {
                        swal.close()
                        messages.show("{{__('admin.You Need A permissions To Do That')}}", {
                            type: 'danger',
                            title: '',
                            icon: '<i class="icon-error"></i>',
                            delay:2000,
                        });
                    }

                });
            });
        });
        //delete multi rows
        $(document).on('click', '#checkAll', function () {
            var check=true;
            $('.delete-all:checked').each(function () {
                check=false;
            });

            $('.delete-all').prop('checked', check);
        });

        $(document).on('click', '#bulk_delete', function () {
            var id = [];
            $('.delete-all:checked').each(function () {
                id.push($(this).attr('id'));
            });
            if (id.length > 0) {
                swal({
                    title: "{{__('admin.Are You Sure')}}",
                    text: "{{__('admin.You Can not to rollback')}}",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "{{__('admin.accept')}}",
                    cancelButtonText: "{{__('admin.cancel')}}",
                    okButtonText: "{{__('admin.accept')}}",
                    closeOnConfirm: false
                }, function () {
                    $.ajax({
                        url: '{{route('notifications.delete.bulk')}}',
                        type: 'DELETE',
                        data: {id: id},
                        success: function (data) {
                            swal.close()
                            messages.show("{{__('admin.SuccessMessage')}}", {
                                type: 'success',
                                title: '',
                                icon: '<i class="jq-icon-success"></i>',
                                delay:2000,
                            });
                            $('#basicExample').DataTable().ajax.reload();
                            if (data.error.length > 0) {
                                myToast('{{__('admin.Operation Failed')}}', data.error, 'buttom-left', '#ff6849', 'error', 3500, 6);
                            } else {
                                myToast('{{__('admin.SuccessMessage')}}', data.success, 'buttom-left', '#ff6849', 'success', 3500, 6);
                            }
                        },error: function(data) {
                            swal.close()
                            messages.show("{{__('admin.You Need A permissions To Do That')}}", {
                                type: 'warning',
                                title: '',
                                icon: '<i class="icon-error"></i>',
                                delay:2000,
                            });
                        }
                    });
                });
            } else {
                swal({
                    title: "{{__('admin.Operation Failed')}}",
                    text: "{{__('admin.PleaseSelectYouWantFirst')}}.",
                    type: "error",
                    confirmButtonText: "{{__('admin.accept')}}"
                });
            }
        });

    </script>
@endsection
