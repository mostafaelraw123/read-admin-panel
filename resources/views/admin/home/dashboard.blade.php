@extends('admin.layouts.layout')
@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />

@endsection

@section('page-title')
{{__('admin.dashboard')}}
@endsection

@section('page-links')
@endsection

@section('content')

@endsection

@section('js')
    <script src="{{asset('admin')}}/vendor/datatables/dataTables.min.js"></script>
    <script src="{{asset('admin')}}/vendor/datatables/dataTables.bootstrap.min.js"></script>

    <!-- Custom Data tables -->
    {{--   <script src="{{asset('admin')}}/vendor/datatables/custom/custom-datatables.js"></script>--}}
    <script src="{{asset('admin')}}/vendor/datatables/custom/fixedHeader.js"></script>
    <script src="{{asset('admin')}}/vendor/bs-select/bs-select.min.js"></script>

    <script src="https://washsquadsa.com/admin/plugins/calendar/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js" integrity="sha256-4iQZ6BVL4qNKlQ27TExEhBN1HFPvAvAMbFavKKosSWQ=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/locale/ar.min.js" integrity="sha512-gVMzWflhCRdT4UPPUzNR9gCPtBZuc77GZxVx2CqSZyv0kEPIISiZEU0hk6Sb/LLSO87j4qXH/m9Iz373K+mufw==" crossorigin="anonymous"></script>

    <script>



    {{---------------------------------------------------------------}}
    {{---------------------------------------------------------------}}
    {{-----------------------  Callender -------------------------------}}
    {{---------------------------------------------------------------}}
    {{---------------------------------------------------------------}}
{{--    <script>--}}
{{--        $('#calendar').fullCalendar({--}}
{{--            defaultView: 'month',--}}
{{--            header: {--}}
{{--                left: 'prev,next today',--}}
{{--                center: 'title',--}}
{{--                right: 'month,agendaWeek,agendaDay'--}}
{{--            },--}}
{{--            isRTL:true,--}}
{{--            locale: 'ar',--}}
{{--            lang: 'ar',--}}
{{--            editable: false,--}}
{{--            disableDragging: true,--}}
{{--            eventLimit: true, // allow "more" link when too many events--}}
{{--            selectable: true,--}}
{{--            events:'{{route('admin.calender')}}',--}}
{{--            eventRender: function( event, element, view ) {--}}
{{--                var  sup =  element.find('.fc-title')--}}
{{--                var  con = sup.closest('span');--}}
{{--                sup.html('<h3 style="color: #000000">' + event.title+'  : عدد الطلبات '+'</h3>' );--}}
{{--            }--}}
{{--        });//calender object--}}



    </script>
@endsection
