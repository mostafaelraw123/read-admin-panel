<?php

namespace App\Http\Controllers\Admin;

use App\Http\Traits\CheckPermission;
use App\Http\Traits\Upload_Files;
use App\Models\Admin;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;


class AdminUserController extends Controller
{

    use Upload_Files,CheckPermission;


    public function __construct()
    {

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $user_type = $request->get('user_type')?$request->get('user_type'):'all';
        if ($request->ajax()) {
//            $get_user_type =in_array($request->user_type,['all'])||$request->user_type==null?'client':$request->user_type;
            $users = User::ValidateUser($request->user_type)->latest()->get();


            return DataTables::of($users)
                ->editColumn('logo', function ($user) {
                    return ' <img src="'.get_file($user->logo).'" class=" w-50 rounded" style="height:50px;width:50px"
                             onclick="window.open(this.src)">';
                })
                ->editColumn('created_at', function ($user) {
                    return date('Y/m/d',strtotime($user->created_at));
                })

                ->editColumn('is_block', function ($user) {
                    $re_block = '';
                    if ($user->is_block == 'not_blocked') {
                        $re_block = '<span class="badge badge-success">مفعل</span>';
                    }else{
                        $re_block = '<span class="badge badge-danger">موقوف</span>';

                    }
                    return $re_block;
                })
                ->editColumn('user_type', function ($user) {
                    $re_write_ = '';
                    if ($user->user_type == 'client') {
                        $re_write_ = '<span class="badge badge-success">عميل</span>';
                    }
                    if ($user->user_type == 'moatmer') {
                        $re_write_ = '<span class="badge badge-danger">معتمر</span>';

                    }
                    return $re_write_;
                })
                ->editColumn('created_at', function ($user) {
                    return date('Y/m/d',strtotime($user->created_at));
                })
                ->addColumn('delete_all', function ($user) {
                    return "<input style='width: 19px;' type='checkbox' class='form-control delete-all' name='delete_all' id='" . $user->id . "'>";
                })
                ->addColumn('actions', function ($user) {
                    return "<a  class='btn btn-primary' href='".route('users.show',$user->id)."'> <span class='icon-eye'></span></a>
                    <button  style='display:none' class='btn  btn-info editButton' attr-type='" . $user->user_type . "' id='" . $user->id . "'> <span class='icon-edit'></span></button>
                            <button  class='btn btn-info status' id='" . $user->id . "'> <span class='icon-block'></span></button>
                   <button class='btn btn-danger  delete' id='" . $user->id . "'><span class='icon-delete'></span> </button>";
                })->rawColumns(['actions','logo','delete_all','user_type','is_block'])->make(true);
        }
        return view('admin.users.index',compact('user_type'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        $user = User::findOrFail($id);
        if ($request->ajax()){
            $view = "admin.users.parts.{$request->viewSection}";
            $returnHTML = view($view)
                ->with([
                    'user' =>$user,
                    'ratings'=>$user->ratings
                ])
                ->render();
            return response()->json(array('success' => true,'profileForm'=>$returnHTML));
        }

        $colors = [ '#C0C0C0','#808080','#FFA07A','#E9967A','blue','green','red',
            '#999999','#454545','#D3D3D3','#380000','#E80000','#009966','#009933',
            '#330099','#660099','#D3D3D3','#990066','#9900FF','#990000','#999900',
            '#FF33FF','#FFFF00','#FF3333','#FF3333','#FFFF99','#990000','#FF99CC',
            '#990000','#663366','#663399','#669966','#669999','#6666FF','#66FFFF'
        ];
        return view('admin.users.show',compact('user','colors'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request , $id)
    {


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return response()->json(User::destroy($id),200);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */

    public function delete_all(Request $request)
    {

        User::destroy($request->id);
        return response()->json(1,200);
    }


    public function changeBlock($id)
    {
        $row = User::findOrFail($id);
        $status = $row->is_block == 'blocked'?'not_blocked':'blocked';
        $row->update(['is_block' => $status]);
        return response()->json(1,200);
    }



}//end
