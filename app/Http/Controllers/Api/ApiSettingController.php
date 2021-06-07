<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Traits\Api\HeaderLang;
use App\Models\Setting;
use Illuminate\Http\Request;

class ApiSettingController extends Controller
{

    public function app_information(Request $request){
        //check lang
        $settings = Setting::get();
        $settings->CollectionTranslate(['title','desc','about_app','terms_condition'],'ar');
        return response()->json(['data'=>$settings->first(),'message'=>'good query','status'=>200],200);
    }//end

}//end class
