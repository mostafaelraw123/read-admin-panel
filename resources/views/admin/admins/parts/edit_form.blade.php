<form action="{{route('admins.update',$admin->id)}}" method="post" id="Form">
    @csrf
    @method('PUT')
    <div class="alert alert-primary" role="alert">
        <h6 class="text-center mb-1">{{__('admin.Updating')}} ({{$admin->name}}) </h6>
    </div>


    {{--form--}}
    <div class="row gutters">

        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
            <div class="form-group">
                <label for="name">{{__('admin.name')}}  </label>
                <input data-validation="required" type="text" class="form-control" id="name" name="name" value="{{$admin->name}}" placeholder="{{__('admin.name')}} ">
            </div>
        </div>
        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
            <div class="form-group">
                <label for="email">{{__('admin.email')}}  </label>
                <input data-validation="required" type="text" class="form-control" id="email"  value="{{$admin->email}}" name="email" placeholder="{{__('admin.email')}} ">
            </div>
        </div>
        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
            <div class="form-group">
                <label for="email2">{{__('admin.password')}}</label>
                <input  type="password" class="form-control" id="password" name="password" placeholder="{{__('admin.password')}}">
            </div>
        </div>

        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="form-group">
                <label for="address1">{{__('admin.Image')}} </label>
                <input  type="file" data-default-file="{{get_file($admin->image)}}" class="form-control dropify" id="image" name="image" >
            </div>
        </div>


    </div>
    {{--form--}}
</form>


