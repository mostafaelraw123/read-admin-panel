<form action="{{route('settings.update',$settings->id)}}" method="post" id="settingsForm">
    @csrf
    @method('PUT')
    <input type="hidden" name="tab" value="location">

    <div class="alert alert-primary" role="alert">
        <h6 class="text-center mb-1">{{__('admin.location')}}</h6>
    </div>


    {{--form--}}
    <div class="row gutters">

        @foreach($languages as $index=>$language)

            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="form-group">
                    <label for="address1{{$language->title}}">{{__('admin.title')}} ({{__('admin.'.$language->title)}}) </label>
                    <input data-validation="required" type="text"  value="{{$settings->getTranslation('address1', $language->title)}}" class="form-control address" id="address1{{$language->title}}" name="address1[]" placeholder="{{__('admin.title')}}">
                </div>
            </div>


{{--            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">--}}
{{--                <div class="form-group">--}}
{{--                    <label for="address2{{$language->title}}">{{__('admin.title')}}  ({{__('admin.additional')}} - {{__('admin.'.$language->title)}}) </label>--}}
{{--                    <input data-validation="required" type="text"  value="{{$settings->getTranslation('address2', $language->title)}}" class="form-control address" id="address2{{$language->title}}" name="address2[]" placeholder="{{__('admin.title')}}">--}}
{{--                </div>--}}
{{--            </div>--}}

        @endforeach

        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="form-group">
            <div  id='map_canvas' style="width: 100%; height: 300px;"></div>
            </div>
        </div>

        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
            <div class="form-group">
                <input  data-validation="required" readonly  value="{{$settings->latitude}}" class="form-control" type="text" name="latitude" id="lat" >
            </div>
        </div>
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
            <div class="form-group">
                <input data-validation="required" readonly class="form-control" value="{{$settings->longitude}}" type="text" name="longitude" id="long" >
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

