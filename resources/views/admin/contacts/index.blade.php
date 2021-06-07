@extends('admin.layouts.layout')
@section('styles')
    @include('admin.layouts.loader.loaderCss')
@endsection

@section('page-title')
   {{__('admin.ContactUs')}}
@endsection

@section('page-links')

    <li class="breadcrumb-item active">    {{__('admin.ContactUs')}}</li>
@endsection

@section('content')
    <!-- Row start -->
    <div class="row gutters" >
        <div id="contactDiv" class="card-body ">

        </div>

    </div>
    <!-- Row end -->
    <div id="messages"></div>
@endsection

@section('js')
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

        getSection()
        //get sections
        function getSection() {
            $(' #contactDiv').append(loader)
            $.get('{{route('contacts.index')}}', function (data) {
                window.setTimeout(function() {
                    $(' .linear-background').hide(loader)
                    $('#contactDiv').html(data.html);
                }, 2000);


            });
        }

        $(document).on('click','.pagination a',function(e) {
            e.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            fetch_data(page)
        });

        function fetch_data(page)
        {
            $(' #contactDiv').append(loader)
            $(' #contacts').hide()
            $.ajax({
                url:"{{route('contacts.index')}}?page="+page,
                success:function(data)
                {
                    window.setTimeout(function() {
                        $(' .linear-background').hide(loader)
                        $('#contactDiv').html(data.html);
                    }, 2000);
                }
            });
        }

        //edit-card
        $(document).on('click', '.edit-card', function (e) {
            e.preventDefault()
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
                var url = '{{ route("contacts.destroy", ":id") }}';
                url = url.replace(':id', id);
                console.log(url);
                $(' #contactDiv').append(loader)
                $(' #contacts').hide()
                $.ajax({
                    url: url,
                    type: 'DELETE',
                    data: {id: id},
                    success: function (data) {
                        swal.close()
                        window.setTimeout(function() {
                            getSection()
                            messages.show("{{__('admin.SuccessMessage')}}", {
                                type: 'success',
                                title: '',
                                icon: '<i class="jq-icon-success"></i>',
                                delay:2000,
                            });

                        }, 2000);

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
    </script>
@endsection

