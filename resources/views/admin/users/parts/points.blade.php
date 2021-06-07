<div class="card h-100" id="partNewDriver">
    <div class="card-header">
        <div class="card-title"> تاريخ نقاط ل ({{$user->full_name}})</div>
    </div>
    <div class="card-body">
        <div class="row gutters">
            @if (count($user->user_point_histories)>0)

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>  الجائزة / المنتج </th>
                            <th>النقاط </th>
                            <th>وقت الإضافة</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($user->user_point_histories as $row)
                            <tr>
                                <td>
                                    @if ($row->type == "adding")
                                        {!! $row->product?"<img src='".get_file($row->product->main_image)."' style='width:50px;height:50px'>":"" !!}
                                    @elseif ($row->type == "replacement")
                                        {!!  $row->prize?"<img src='".get_file($row->prize->image)."' style='width:50px;height:50px'>":"" !!}
                                    @else
                                      <span class="badge badge-success"> نقاط هدية للتسجيل الجديد</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($row->type == "replacement")
                                        -
                                    @else
                                        +
                                    @endif
                                    {{$row->points_count}}
                                </td>
                                <td>{{date('Y/m/d',strtotime($row->created_at))}}</td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            @else
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="alert alert-danger">
                        لم يٌضف نقاط الآن
                    </div>
                </div>
            @endif

            <br>
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="text-right">

                    <a class='btn btn-info  pull-left '  href="{{route('users.index')}}"><span class='icon-arrow_back'></span> عودة </a>

                </div>
            </div>
        </div>

    </div>
</div>
