@if (count($rows)>0)
    @foreach($rows as $row)
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mt-3 alert alert-success">
            <span> اسم المندوب :  {{$row->user->name}} </span>  &nbsp; &nbsp; / &nbsp; &nbsp;
            <span>  اسم الصيدلية أو مخزن الأدوية : {{$row->client->title}} </span>&nbsp; &nbsp; / &nbsp; &nbsp;
            <span>الموعد :  {{$row->created_at->diffForHumans()}}</span>&nbsp; &nbsp; / &nbsp; &nbsp;
            <span>الملاحظة :  {{$row->notes?$row->notes:'لا يوجد ملاحظة'}}</span>
        </div>
    @endforeach
    @else

    <div style=" margin:0 auto;" class=" mt-3 align-items-center justify-content-center ">
        <img class="text-center" src="{{asset('seo (1).png')}}" >
        <h4 class="text-center">لا يوجد بيانات للعرض</h4>
    </div>
@endif
