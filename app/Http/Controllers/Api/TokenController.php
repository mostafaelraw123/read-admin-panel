<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\TokenRequest;
use App\Models\FirebaseToken;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TokenController extends Controller
{

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     *
     */
    public function token_update(Request $request)
    {
        //create or update
        $token=new TokenRequest();
        $this->validate($request,
            array_merge_recursive($token->rules(),
            ['software_type'=>'required|in:ios,android']));
        return response()->json([
            'data'=>FirebaseToken::updateOrCreate(
            [
                'user_id'=>  $request->user_id,
                'phone_token'=>  $request->firebase_token,
                'software_type'=>  $request->software_type,
            ])
            ,'message'=>'good update',
            'status'=>200
        ],200);
    }

    /**
     * @param TokenRequest $request
     * @return \Illuminate\Http\JsonResponse
     *
     */
    public function token_delete(TokenRequest $request)
    {
        $firebase= FirebaseToken::where([
            'user_id'=>$request->user_id,
            'phone_token'=> $request->firebase_token
        ])->delete();
        //delete the token
        if ($firebase) {
            return  response()->json(['data'=>null,'message'=>'the token is deleted','status'=>200],200);
        }else{
            return  response()->json(['data'=>null,'message'=>'the firebase Token not exist','status'=>404],200);
        }
    }//end  fun

}//end class
