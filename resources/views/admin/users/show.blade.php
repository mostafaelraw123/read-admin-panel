@extends('admin.layouts.layout')
@section('styles')
    <!-- Data Tables -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Data Tables -->
    <style>
        .spanView{
            font-weight: bold;
            color: #0d7523;
            font-size: larger;
        }

    </style>
    @include('admin.layouts.loader.loaderCss')
@endsection

@section('page-title')
   بروفايل الصنايعى
@endsection

@section('page-links')
    <li class="breadcrumb-item ">
        <a href="{{route('users.index')}}">
            الصنايعية
        </a>
    </li>
    <li class="breadcrumb-item active">عرض</li>
@endsection

@section('content')

    <!-- Row start -->
    <div class="row gutters">
        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
            <div class="card h-100">
                <div class="card-body">
                    <div class="account-settings">
                        <div class="user-profile">
                            <div class="user-avatar">
                                <img src="{{get_file($user->logo)}}" alt="Wafi Admin" />
                            </div>
                            <h5 class="user-name">{{$user->full_name}}</h5>
                            <h6 class="user-email">({{$user->phone_code}}){{$user->phone}}</h6>


                        </div>
                        <div class="setting-links">
                            <a href="#" class="linkDetails" att_id="basic-info">
                                <i class="icon-info"></i>
                                المعلومات الأساسية
                            </a>


                            <a href="#" class="linkDetails" att_id="points">
                                <i class="icon-dots-three-horizontal"></i>
                                تاريخ النقاط
                            </a>


                            <a href="#" class="linkDetails" att_id="prizes">
                                <i class="icon-award"></i>
                                الجوائز التى تم تأكيدها
                            </a>



                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-9 col-lg-9 col-md-9 col-sm-12 col-12" id="profile-div">

        </div>
    </div>
    <!-- Row end -->
    {{--Models--}}
    <div id="messages"></div>
@endsection

@section('js')
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAeyMUJgKAhnNXbILHONb1um72CNzELFRY&libraries=places"></script>

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
        //============================change status===============================
        //========================================================================
        // =======================================================================
        getSection(true)
        function getSection(check = true , link = 'basic-info') {
            if (check == true) {
                $('#partNewDriver').hide()
                $('#profile-div').append(loader)
            }
            $.get('{{route('users.show',$user->id)}}'+'?viewSection='+link, function (data) {
                window.setTimeout(function() {
                    $(' .linear-background').hide(loader)
                    $('#profile-div').html(data.profileForm);

                }, 2000);


            });
        }//end

        $(document).on('click','.linkDetails',function (e) {
            e.preventDefault();
            var link = $(this).attr('att_id');
            getSection(true,link)

        })//end class



    </script>
@endsection
