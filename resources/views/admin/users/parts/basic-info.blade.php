<div class="card h-100" id="partNewDriver">
    <div class="card-header">
        <div class="card-title text-center badge badge-primary" style="font-weight: bold" >بيانات  ({{$user->full_name}})</div>
    </div>
    <div class="card-body">
        <div class="row gutters">
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="form-group">
                    <span style="font-weight: bold;font-size: larger" >الاسم   :    </span>
                    <span class="spanView">{{$user->full_name}}</span>
                </div>
                <div class="form-group">
                    <span  style="font-weight: bold;font-size: larger">رقم الجوال   :    </span>
                    <span class="spanView">{{$user->phone}}({{$user->phone_code}})</span>
                </div>

                <div class="form-group">
                    <span  style="font-weight: bold;font-size: larger">رقم البطاقة   :    </span>
                    <span class="spanView">{{$user->national_ID}}</span>
                </div>


                <div class="form-group">
                    <span  style="font-weight: bold;font-size: larger">كل النقاط    :    </span>
                    <span class="spanView">{{$user->total_points_balance}}</span>
                </div>

                <div class="form-group">
                    <span  style="font-weight: bold;font-size: larger"> النقاط  الحالية  :    </span>
                    <span class="spanView">{{$user->current_points_balance}}</span>
                </div>

                <div class="form-group">
                    <span  style="font-weight: bold;font-size: larger"> النقاط  المستبدلة  :    </span>
                    <span class="spanView">{{$user->exchange_points_balance}}</span>
                </div>



            </div>

            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">

                <div class="form-group">
                    <span  style="font-weight: bold;font-size: larger">العنوان   :    </span>
                    <span class="spanView">{{$user->address}}</span>
                </div>

                <div class="form-group">
                    <span  style="font-weight: bold;font-size: larger">المحافظة   :    </span>
                    <span class="spanView">{{$user->governorate?$user->governorate->governorate_name_ar:""}}</span>
                </div>

                <div class="form-group">
                    <span  style="font-weight: bold;font-size: larger">المدينة   :    </span>
                    <span class="spanView">{{$user->city?$user->city->city_name_ar:""}}</span>
                </div>

                <div class="form-group">
                    <span  style="font-weight: bold;font-size: larger"> الحالة الحالية  :    </span>
                    <span class="spanView">{{$user->is_login=="connected"?"متصل":"غير متصل"}}</span>
                </div>

                <div class="form-group">
                    <span  style="font-weight: bold;font-size: larger"> حالة الحساب   :    </span>
                    <span class="spanView">{{$user->is_block=="blocked"?"موقوف":"نشط"}}</span>
                </div>

               <div class="form-group">
                    <span  style="font-weight: bold;font-size: larger"> عدد طلبات صرف الجوائز (المؤكدة) :    </span>
                    <span class="spanView">{{count($user->confirmed_prizes)}}</span>
                </div>

            </div>
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="text-right">

                    <a class='btn btn-info  pull-left '  href="{{route('users.index')}}"><span class='icon-arrow_back'></span> عودة </a>

                </div>
            </div>
        </div>
    </div>
</div>
