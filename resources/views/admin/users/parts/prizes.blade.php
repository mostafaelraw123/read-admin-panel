<div class="card h-100" id="partNewDriver">
    <div class="card-header">
        <div class="card-title"> الطلبات المؤكدة ل ({{$user->full_name}})</div>
    </div>
    <div class="card-body">
        <div class="row gutters">
            @if (count($user->confirmed_prizes)>0)

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>صورة الجائزة</th>
                            <th>عدد النقاط </th>
                            <th>وقت الإضافة</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($user->confirmed_prizes as $row)
                            <tr>
                                <td>
                                    {!!  $row->prize?"<img src='".get_file($row->prize->image)."' style='width:50px;height:50px'>":"" !!}
                                </td>
                                <td>
                                    {{$row->prize_points_count}}
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
                        لا يوجد طلبات مؤكدة حتى الآن
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
