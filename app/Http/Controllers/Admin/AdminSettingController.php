<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\Upload_Files;
use App\Models\Language;
use App\Models\Setting;
use Illuminate\Http\Request;

class AdminSettingController extends Controller
{
    use Upload_Files;

    public function __construct()
    {
        /* $this->middleware([('permission:settings index,admin')])->only(['index']);*/
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.settings.settings');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        /*if (!checkAdminHavePermission('settings edit'))
      {
          return response()->json(1,500);
      }*/
        if ($request->ajax()){
            //show tab based of request
            $returnHTML = view("admin.settings.parts.{$request->tab}")
                ->with([
                    'name' =>$request->tab ,
                    'settings' => \setting(),
                    'languages'=>Language::get()
                ])
                ->render();
            return response()->json(array('success' => true, 'html'=>$returnHTML , 'tab'=>$request->tab));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Setting $setting)
    {
//        dd($request->all());
        $languages = Language::get();

        //if tab is contact us , social section and logo section

        if (in_array($request->tab,['ContactInfo','social','logo'])) {
            $data = $request->except('tab');
        }

        //if tab is location section

        if ($request->tab == 'location') {
            $address1 = [];
           // $address2 = [];

            $data['latitude']=$request->latitude;
            $data['longitude']=$request->longitude;
            foreach ($languages as $index=>$language){
                $address1[$language->title] = $request->address1[$index];
             //   $address2[$language->title] = $request->address2[$index];
            }
            $data['address1'] = $address1;
          //  $data['address2'] = $address1;
        }

        //if tab is basic section

        if ($request->tab == 'basic') {
            $title = [];
            $desc = [];

            $data['android_app']=$request->android_app;
            $data['ios_app']=$request->ios_app;
            foreach ($languages as $index=>$language){
                $title[$language->title] = $request->title[$index];
                $desc[$language->title] = $request->desc[$index];
            }
            $data['title'] = $title;
            $data['desc'] = $desc;
        }

        //if tab is terms_condition section

        if ($request->tab == 'terms') {
            $terms_condition = [];
            $about_app = [];
            $privacy_policy = [];

            foreach ($languages as $index=>$language){
                $terms_condition[$language->title] = $request->terms_condition[$index];
                $about_app[$language->title] = $request->about_app[$index];
                $privacy_policy[$language->title] = $request->privacy_policy[$index];
            }
            $data['terms_condition'] = $terms_condition;
            $data['about_app'] = $about_app;
            $data['privacy_policy'] = $privacy_policy;
        }

        //upload images

        if ($request->hasFile('header_logo'))
           $data['header_logo']= $request->hasFile('header_logo')
               ?$this->uploadFiles('settings',$request->header_logo,$setting->header_logo)
               :$setting->header_logo;

        if ($request->hasFile('footer_logo'))
            $data['footer_logo']= $request->hasFile('footer_logo')
                ?$this->uploadFiles('settings',$request->footer_logo,$setting->footer_logo)
                :$setting->footer_logo;

        Setting::updateOrCreate(['id' => 1],$data);
        return response()->json(1,200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
