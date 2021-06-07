<form action="{{route('users.store')}}" method="post" id="Form">
    @csrf
    <div class="alert alert-primary" role="alert">
        <h6 class="text-center mb-1">إضافة عميل جديد</h6>
    </div>
    <input type="hidden" name="user_type" value="client">

    {{--form--}}
    <div class="row gutters">

        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
            <div class="form-group">
                <label for="name">الإسم  </label>
                <input data-validation="required" type="text" class="form-control" id="name" name="name" placeholder="الاسم ">
            </div>
        </div>
        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12" style="display: none">
            <div class="form-group">
                <label for="phone_code">اختر كود الدولة </label>

                <select  data-validation="required" name="phone_code" class="form-control selectpicker my-select" data-live-search="true">
                    @foreach($countries as $country)
                        <option {{$loop->first?'selected':''}} value="+966">{{$country->nicename}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
            <div class="form-group">
                <label for="email">رقم الجوال </label>
                <input data-validation="required" type="text" class="form-control" id="phone" name="phone" placeholder="رقم الجوال ">
            </div>
        </div>

        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
            <div class="form-group">
                <label for="email">البريد الإلكترونى </label>
                <input type="email" class="form-control" id="email" name="email" placeholder="البريد الإلكترونى ">
            </div>
        </div>
        <input data-validation="required" type="hidden" class="form-control" value="{{bcrypt(123456)}}" id="password" name="password" placeholder="كلمة المرور">


        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="form-group">
                <label for="address1">الصورة </label>
                <input  type="file" data-default-file="" class="form-control dropify" id="logo" name="logo" >
            </div>
        </div>

        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12" style="display: none">
            <div class="form-group">
                <div  id='map_canvas' style="width: 100%; height: 300px;"></div>
            </div>
        </div>

        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12" style="display: none">
            <div class="form-group">
                <input  data-validation="required" disabled  value="24.774265" class="form-control" type="text" name="latitude" id="lat" >
            </div>
        </div>
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12" style="display: none">
            <div class="form-group">
                <input data-validation="required" disabled class="form-control" value="46.738586" type="text" name="longitude" id="long" >
            </div>
        </div>

    </div>
    {{--form--}}
</form>


