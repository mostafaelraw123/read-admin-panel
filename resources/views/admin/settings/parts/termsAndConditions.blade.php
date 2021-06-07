<form action="{{route('settings.update',$settings->id)}}" method="post" id="settingsForm">
    @csrf
    @method('PUT')
    <input type="hidden" name="tab" value="terms">

    <div class="alert alert-primary" role="alert">
        <h6 class="text-center mb-1">{{__('admin.TermsAndCondition')}} </h6>
    </div>


    {{--form--}}
    <div class="row gutters">

        @foreach($languages as $index=>$language)
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="form-group">
                    <label for="{{$language->title}}_terms_condition">{{__('admin.TermsAndCondition')}}   ({{__('admin.'.$language->title)}})</label>
                    <textarea data-validation="required" class="summernote" name="terms_condition[]" id="{{$language->title}}_terms_condition" placeholder="{{__('admin.TermsAndCondition')}}   ({{__('admin.'.$language->title)}})">{{$settings->getTranslation('terms_condition', $language->title)}}</textarea>
                </div>
            </div>
        @endforeach


        @foreach($languages as $index=>$language)
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="form-group">
                    <label for="{{$language->title}}_about_app">{{__('admin.about_app')}}   ({{__('admin.'.$language->title)}})</label>
                    <textarea data-validation="required" class="summernote" name="about_app[]" id="{{$language->title}}_about_app" placeholder="{{__('admin.about_app')}}   ({{__('admin.'.$language->title)}})">{{$settings->getTranslation('about_app', $language->title)}}</textarea>
                </div>
            </div>
        @endforeach

        @foreach($languages as $index=>$language)
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="form-group">
                    <label for="{{$language->title}}_privacy_policy">{{__('admin.privacy_policy')}}   ({{__('admin.'.$language->title)}})</label>
                    <textarea data-validation="required" class="summernote" name="privacy_policy[]" id="{{$language->title}}_privacy_policy" placeholder="{{__('admin.privacy_policy')}}   ({{__('admin.'.$language->title)}})">{{$settings->getTranslation('privacy_policy', $language->title)}}</textarea>
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

