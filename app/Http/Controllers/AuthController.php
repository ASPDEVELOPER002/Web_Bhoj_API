<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Post;

class AuthController extends Controller
{
   public function register(Request $request){

    //validator

    //$validator=validator::make.all(),[{}]
    $validator=Validator::make($request->all(),[
        'name'=>'required',
        'email'=>'required|email',
        'password'=>'required',
        'c_password'=>'required:same|password'
    ]);

    if($validator.fails()){
        $respons=[
            'status'=> false,
            'message'=>$validator->error()
        ];
        return response()->json($respons,$request.status());
    }

    $input=$request->all();
    $input['password']=bcrypt($input['password']);
    $user=User::create($input);

    $success['token']=$user->createToken('MyApp')->plainTextToken;
    $suucess['name']=$user->name;

    $respons =[
        'status'=>true,
        'data'=>$success,
        'message'=>'User Register Successfully'
    ];

    return  response()->json($respons,200);


   }

   public function version(){
    $post= Post::get();
    return response()->json([
        'message'=>'List of Posts',"token"=>"123"
    ]);

   }

   public function _postDetails(Request $request){
    //$user->createToken('MyApp')->plainTextToken;
    $user=User::create($input);
    return response()->json([
      "data"=>$request->all(),
      "token"=>"ht"
    ]);
   }

  public function signup(Request $request){

    $ValidateUser = Validator::make($request->all(),[
        'name'=>'required',
        'email'=>'required|email|unique:user,email',
        'password'=>'required',
    ]);

    if($ValidateUser->fails()){
        return response()->json([

           'status'=> false,
           'message'=>'User Valied  First',
           'errors'=>$ValidateUser->errors()->all(),
        ],401);

        // $User= User::create([
        //     'name'=>$request->user,
        //     'email'=>$request->email,
        //     'password'=>$request->password,
        // ]);

       //$userr=new Post;
       $users = DB::table('users')->get();

        return response()->json([

            'status'=> true,
            'message'=>'User Creation Successfully',
            'errors'=>$ValidateUser->error()->all(),
            'obj'=>$users
         ],200); 

    }
  }

}
