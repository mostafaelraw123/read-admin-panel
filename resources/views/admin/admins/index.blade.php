@extends('admin.layouts.layout')
@section('styles')
    <!-- Data Tables -->
    <link rel="stylesheet" href="{{asset('admin')}}/vendor/datatables/dataTables.bs4.css" />
    <link rel="stylesheet" href="{{asset('admin')}}/vendor/datatables/dataTables.bs4-custom.css" />
    <link href="{{asset('admin')}}/vendor/datatables/buttons.bs.css" rel="stylesheet" />

    @include('admin.layouts.loader.loaderCss')
@endsection

@section('page-title')
    {{__('admin.admins')}}
@endsection

@section('page-links')

    <li class="breadcrumb-item active">   {{__('admin.admins')}}</li>
@endsection

@section('content')

    <div class="row gutters">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="table-container">
                <div class="t-header">
                    <button id="addButton" class="btn btn-success pull-left"> {{__('admin.Creating')}} <span class="icon-add_circle"></span>  </button>
                    <button id="checkAll" class="btn btn-info pull-left"> {{__('admin.All')}} <span class="icon-check"></span>  </button>
                    <button id="bulk_delete" class="btn btn-danger pull-left"> {{__('admin.DeletingAll')}} <span class="icon-delete"></span>  </button>
                </div>
                <div class="table-responsive">

                    <table id="basicExample" class="table custom-table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>{{__('admin.Image')}} </th>
                            <th>{{__('admin.name')}} </th>
                            <th>{{__('admin.email')}} </th>
                            <th>{{__('admin.CreatedAt')}} </th>
                            <th>{{__('admin.Controls')}} </th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    {{--Models--}}
    <div  id="admin-model" class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myExtraLargeModalLabel">{{__('admin.admins')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="form-for-addOrDelete">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary closeModal" data-dismiss="modal">{{__('admin.close')}}</button>
                    <button style="margin-right: 5px" type="submit" id="save"  form="Form" class="btn btn-primary">{{__('admin.save')}}</button>
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
        $("#basicExample").DataTable({
            dom: 'Bfrtip',
            responsive: 1,
            "processing": true,
            "lengthChange": true,
            "serverSide": true,
            "ordering": true,
            "searching": true,
            'iDisplayLength': 10,
            "ajax": "{{route('admins.index')}}",

            "columns": [
                {"data": "delete_all", orderable: false, searchable: false},
                {"data": "image", orderable: false, searchable: false},
                {"data": "name",   orderable: false,searchable: true},
                {"data": "email",   orderable: false,searchable: false},
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

        //========================================================================
        //========================================================================
        //=======================Add , edit model=================================
        //========================================================================
        $(document).on('click','#addButton',function (e) {
            e.preventDefault()
            var url = '{{route('admins.create')}}';
            $.ajax({
                url: url,
                type: 'GET',
                beforeSend: function(){
                    $('#admin-model').modal('show')
                    $('#form-for-addOrDelete').html(loader);
                },
                success: function(data){
                    window.setTimeout(function() {
                        $('#form-for-addOrDelete').html(data.html);
                        $('.dropify').dropify();
                        $('.linear-background').hide()
                        $.validate({
                        });
                    }, 2000);
                },
                error: function(jqXHR,error, errorThrown) {
                    if(jqXHR.status&&jqXHR.status==500){
                        $('#admin-model').modal("hide");
                        $('#form-for-addOrDelete').html('<h3 class="text-center">{{__('admin.You Need A permissions To Do That')}}</h3>')
                        //save
                        messages.show("{{__('admin.You Need A permissions To Do That')}}", {
                            type: 'danger',
                            title: '',
                            icon: '<i class="icon-error"></i>',
                            delay:2000,
                        });
                    }


                }
            });
        });

        $(document).on('click','.editButton',function (e) {
            e.preventDefault()
            var id = $(this).attr('id');

            var url = '{{route('admins.edit',":id")}}';
            url = url.replace(':id', id);

            $.ajax({
                url: url,
                type: 'GET',
                beforeSend: function(){
                    $('#admin-model').modal('show')
                    $('#form-for-addOrDelete').html(loader);
                },
                success: function(data){
                    window.setTimeout(function() {
                        $('#form-for-addOrDelete').html(data.html);
                        $('.dropify').dropify();
                        $('.linear-background').hide()
                        $.validate({
                        });
                    }, 2000);
                },
                error: function(data) {
                    $('#form-for-addOrDelete').html('<h3 class="text-center">{{__('admin.You Need A permissions To Do That')}}</h3>')
                    messages.show("{{__('admin.You Need A permissions To Do That')}}", {
                        type: 'danger',
                        title: '',
                        icon: '<i class="icon-error"></i>',
                        delay:2000,
                    });
                }
            });

        });

        //=========================================================
        //=========================================================
        //========================Save Data=========================
        //=========================================================
        $(document).on('submit','form#Form',function(e) {
            e.preventDefault();
            var myForm = $("#Form")[0]
            var formData = new FormData(myForm)
            var url = $('#Form').attr('action');
            $.ajax({
                url:url,
                type: 'POST',
                data: formData,
                beforeSend: function(){
                    $('#form-for-addOrDelete').append(loader)
                    $('#Form').hide()

                },
                complete: function(){


                },
                success: function (data) {

                    window.setTimeout(function() {
                        $('#admin-model').modal('hide')
                        messages.show("{{__('admin.SuccessMessage')}}", {
                            type: 'success',
                            title: '',
                            icon: '<i class="jq-icon-success"></i>',
                            delay:2000,
                        });
                        $('#basicExample').DataTable().ajax.reload();

                    }, 2000);


                },
                error: function (data) {
                    $('#form-for-addOrDelete > .linear-background').hide(loader)
                    $('#Form').show()
                    if (data.status === 500) {
                        messages.show("{{__('admin.Message_fail')}}", {
                            type: 'danger',
                            title: '{{__("admin.error")}}',
                            icon: '<i class="icon-alert-octagon"></i>',
                            delay:2000,
                        });
                    }
                    if (data.status === 422) {
                        var errors = $.parseJSON(data.responseText);
                        $.each(errors, function (key, value) {
                            if ($.isPlainObject(value)) {
                                $.each(value, function (key, value) {
                                    myToast(key, value, 'top-left', '#ff6849', 'error',4000, 2);

                                });

                            } else {

                            }
                        });
                    }
                },//end error method

                cache: false,
                contentType: false,
                processData: false
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
                var url = '{{ route("admins.destroy", ":id") }}';
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
                        url: '{{route('admins.delete.bulk')}}',
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
