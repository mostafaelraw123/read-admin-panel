<form action="{{route('settings.update',$settings->id)}}" method="post" id="settingsForm">
    @csrf
    @method('PUT')
    <div class="alert alert-primary" role="alert">
        <h6 class="text-center mb-1">{{__('admin.SocialMediaInfo')}}</h6>
    </div>

    <input type="hidden" name="tab" value="social">

    {{--form--}}
    <div class="row gutters">

        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
            <div class="form-group">
                <label for="facebook">
                    <span class="icon-facebook"></span>
                    {{__('admin.facebook_link')}}
                </label>
                <input data-validation="required" type="text" value="{{$settings->facebook}}" class="form-control" id="facebook" name="facebook" placeholder=" {{__('admin.facebook_link')}}">
            </div>
        </div>
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
            <div class="form-group">
                <label for="twitter">
                    <span class="icon-twitter"></span>
                    {{__('admin.twitter_link')}}
                </label>
                <input data-validation="required" type="text" class="form-control" value="{{$settings->twitter}}" id="twitter" name="twitter" placeholder=" {{__('admin.twitter_link')}}">
            </div>
        </div>

        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
            <div class="form-group">
                <label for="instagram">
                    <span class="icon-instagram"></span>
                    {{__('admin.instagram_link')}}
                </label>
                <input data-validation="required" type="text" class="form-control" value="{{$settings->instagram}}" id="instagram" name="instagram" placeholder="   {{__('admin.instagram_link')}}">
            </div>
        </div>

        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
            <div class="form-group">
                <label for="linkedin">
                    <span class="icon-linkedin"></span>
                    {{__('admin.linkedin_link')}}
                </label>
                <input data-validation="required" type="text" class="form-control" value="{{$settings->linkedin}}" id="linkedin" name="linkedin" placeholder="  {{__('admin.linkedin_link')}}">
            </div>
        </div>

        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
            <div class="form-group">
                <label for="telegram">
                    <span class="icon-link"></span>
                    {{__('admin.telegram_link')}}
                </label>
                <input data-validation="required" type="text" class="form-control" value="{{$settings->telegram}}"  id="telegram" name="telegram" placeholder=" {{__('admin.telegram_link')}}">
            </div>
        </div>

        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
            <div class="form-group">
                <label for="youtube">
                    <span class="icon-youtube"></span>
                    {{__('admin.youtube_link')}}
                </label>
                <input data-validation="required" type="text" class="form-control" id="youtube" value="{{$settings->youtube}}"  name="youtube" placeholder=" {{__('admin.youtube_link')}}">
            </div>
        </div>

        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
            <div class="form-group">
                <label for="google_plus">
                    <span class="icon-google"></span>
                    {{__('admin.google_plus_link')}}
                </label>
                <input data-validation="required" type="text" class="form-control" id="google_plus" value="{{$settings->google_plus}}" name="google_plus" placeholder=" {{__('admin.google_plus_link')}}">
            </div>
        </div>


        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
            <div class="form-group">
                <label for="snapchat_ghost">
                    <span class="icon-link"></span>
                    {{__('admin.snapchat_ghost_link')}}
                </label>
                <input data-validation="required" type="text" class="form-control" id="snapchat_ghost" value="{{$settings->snapchat_ghost}}"  name="snapchat_ghost" placeholder="   {{__('admin.snapchat_ghost_link')}}">
            </div>
        </div>

        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
            <div class="form-group">
                <label for="whatsapp">
                    <span class="icon-link"></span>
                    {{__('admin.whatsapp_link')}}
                </label>
                <input data-validation="required" type="text" class="form-control" id="whatsapp"  value="{{$settings->whatsapp}}"  name="whatsapp" placeholder="{{__('admin.whatsapp_link')}}">
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

