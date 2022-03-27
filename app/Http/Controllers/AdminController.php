<?php

namespace App\Http\Controllers;

use App\Models\Campus;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class AdminController extends Controller
{
    public function index(){
        $user=User::role('giao_vu')->get();
        $user->load('user_campus');
        return view('Admin.EducationalAffairs.view',compact('user'));
    }
    
    public function disable($id){
        $User=User::find($id);
        $User->removeRole('giao_vu');
        return redirect()->route('giao-vu')->with('message','Chỉnh Sửa Thành Công');
    }
    public function addForm(){
        
     
            $campus=Campus::get();
            return view('Admin.EducationalAffairs.add',compact('campus'));
        
    }
    public function add(Request $request){
        $request->validate(
            [ 'name'=>'required'],
            ['name.required'=>'Tên Không Được Để Trống']
        );
        
        $count=count(User::where('email',$request->name."@fpt.edu.vn")->get());
        if($count==0){
            $user=new User;
            $user->name=$request->name;
            $user->email=$request->name."@fpt.edu.vn";
            $user->campus_id=$request->campus_id;
            $user->save();
            $user->assignRole('Giao_vu');
            return redirect()->route('giao-vu')->with('message','Thêm Giáo Vụ Thành Công');
        }
        else{
            $user=User::where('email',$request->name."@fpt.edu.vn")->first();
            if($user->campus_id!=$request->campus_id && $user->hasRole('giao_vu') ){
                return redirect()->back()->with('error','Cán Bộ '.$user->name.' Đang Công Tác Ở Cơ Sở Khác' );
            }
            $user->campus_id=$request->campus_id;
            $user->save();
            $user->assignRole('Giao_vu');
            return redirect()->route('giao-vu')->with('message','Thêm Giáo Vụ Thành Công');
        }
       
    }
    public function editForm($id){
        $user=User::find($id);
        $campus=Campus::get();
        return view('Admin.EducationalAffairs.edit',compact('user','id','campus'));

    }
    public function edit(Request $request,$id){
        $request->validate([
            'email'=>'required'
        ],[
            'email.required'=>'Email Không Được Để Trống'
        ]);
        $user=User::find($id);

        $user->email=$request->email;
        $user->campus_id=$request->campus_id;
        $user->save();
        return redirect()->route('giao-vu')->with('message','Chỉnh Sửa Thông Tin Giáo Vụ Thành Công');
    }
}
