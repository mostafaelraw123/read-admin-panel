<form action="{{route('settings.update',$settings->id)}}" method="post" id="settingsForm">
    @csrf
    @method('PUT')
    <input type="hidden" name="tab" value="basic">

    <div class="alert alert-primary" role="alert">
        <h6 class="text-center mb-1">{{__('admin.BasicInfo')}}</h6>
    </div>


    {{--form--}}
    <div class="row gutters">

        @foreach($languages as $index=>$language)

            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                <div class="form-group">
                    <label for="{{$language->title}}_title">{{__('admin.name')}} ({{__('admin.'.$language->title)}})  </label>
                    <input data-validation="required" type="text" class="form-control" value="{{$settings->getTranslation('title', $language->title)}}" id="{{$language->title}}_title" name="title[]" placeholder="">
                </div>
            </div>
        @endforeach



        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
            <div class="form-group">
                <label for="android_app">{{__('admin.google_play_link')}} </label>
                <input data-validation="required" type="text" class="form-control" value="{{$settings->android_app}}" id="android_app" name="android_app" placeholder="{{__('admin.google_play_link')}}">
            </div>
        </div>
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
            <div class="form-group">
                <label for="ios_app"> {{__('admin.apple_store_link')}}</label>
                <input data-validation="required" type="text" class="form-control" value="{{$settings->ios_app}}" id="ios_app" name="ios_app" placeholder="{{__('admin.apple_store_link')}}">
            </div>
        </div>


            @foreach($languages as $index=>$language)
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="form-group">
                        <label for="summernote1{{$language->title}}">{{__('admin.siteDetails')}} ({{__('admin.'.$language->title)}}) </label>
                        <textarea data-validation="required" class="summernote" name="desc[]" id="summernote1{{$language->title}}" placeholder="{{__('admin.siteDetails')}} ({{__('admin.'.$language->title)}}) ">{{$settings->getTranslation('desc', $language->title)}}</textarea>
                    </div>
                </div>
            @endforeach

        <div class="custom-btn-group">
            <button class="btn btn-success" type="submit">
                {{__('admin.save')}}
                <span class="icon-circle-with-plus" ></span>

            </button>
        </div>
    </div>
    {{--form--}}
</form>

