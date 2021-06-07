<form action="{{route('settings.update',$settings->id)}}" method="post" id="settingsForm">
    @csrf
    @method('PUT')
    <input type="hidden" name="tab" value="logo">
    <div class="alert alert-primary" role="alert">
        <h6 class="text-center mb-1">{{__('admin.location')}}</h6>
    </div>


    {{--form--}}
    <div class="row gutters">

        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
            <div class="form-group">
                <label for="address1">{{__('admin.logo')}} ({{__('admin.basic')}})</label>
                <input data-validation="required" type="file" data-default-file="{{get_file($settings->header_logo)}}" class="form-control dropify" id="header_logo" name="header_logo" placeholder="">
            </div>
        </div>

        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
            <div class="form-group">
                <label for="address1">{{__('admin.logo')}} ({{__('admin.additional')}}) </label>
                <input data-validation="required" type="file" data-default-file="{{get_file($settings->footer_logo)}}" class="form-control dropify" id="footer_logo" name="footer_logo" placeholder=" ">
            </div>
        </div>

        <div class="custom-btn-group">
            <button class="btn btn-success" type="submit">
                {{__('admin.save')}}
                <span class="icon-circle-with-plus" ></span>

            </button>
        </div>

    </div>
    {{--form--}}
</form>

