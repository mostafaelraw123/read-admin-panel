@extends('admin.layouts.layout')
@section('styles')

@endsection

@section('page-title')
    {{__('admin.NotificationDetails')}}
@endsection

@section('page-links')
    <li class="breadcrumb-item ">
        <a href="{{route('notifications.index')}}"> {{__('admin.Notification')}}</a>
    </li>
    <li class="breadcrumb-item active">  {{__('admin.NotificationDetails')}}</li>
@endsection

@section('content')

    <div class="row gutters">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
           <div class="alert alert-info">
               <h5 class="text-center"> {{__('admin.NotificationDetails')}}</h5>
               <a  class="btn-warning btn" style="margin-right: 10px; font-weight: bold; color: white" href="{{route('notifications.index')}}"> {{__('admin.back')}} </a>
           </div>
            <div class="blog">
                <img class="blog-img" height="140px" src="{{asset('admin/img/notification-success.svg')}}" alt="Card image cap">
                <div class="blog-body">
                    <h2 class="blog-title">{{$notification->user->name}} -( {{$notification->user->email}}) </h2>
                    <h6 class="blog-date">
                        <span class="category">{{$notification->title}}</span>
                        <span class="divider">/</span>
                        <span class="date">{{$notification->created_at->diffForHumans()}}</span>
                    </h6>
                    <div class="blog-description">
                        <p>{{$notification->desc}}</p>
                    </div>


                </div>
            </div>
        </div>
    </div>

    <div id="messages"></div>
@endsection

@section('js')



@endsection
