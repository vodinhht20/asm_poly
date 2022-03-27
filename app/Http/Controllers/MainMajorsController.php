<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MainMajors;
use App\Models\User;

class MainMajorsController extends Controller
{
    public function index(Request $request)
    {
        $searchValue = $request->has('search_value') ? $request->search_value : "";
        $main_major = MainMajors::where('name', 'like', "%$request->search_value%")->paginate(10);
        $main_major->appends($request->except('_token'));
        return view('Admin.mainmajor.view', compact('main_major','searchValue'));
    }
    public function addForm(){
        return view('Admin.mainmajor.add');
    }
    public function add(Request $request){
        $request->validate([
            'name'=>'required|unique:main_majors,name',
        ],[
            'name.required'=>'Tên Bộ Môn Không Được Để Trống',
            'name.unique'=>'Tên Bộ Môn Không Được Để Trùng Lặp',

        ]);
        $main_major= new MainMajors;
        $main_major->fill($request->all());
        $main_major->save();
        if($main_major->save()){
            return redirect()->route('bo-mon')->with('message', 'Thêm Thành Công');
        }
        else{
            return redirect()->route('bo-mon')->with('error', 'Đã Có Lỗi Xảy Ra');
        }
    }
    public function editForm($id){
        $main_major=MainMajors::find($id);
        return view('Admin.mainmajor.edit',compact('main_major'));
    }
    public function edit(Request $request,$id){
        $request->validate([
            'name'=>"required|unique:main_majors,name,$id"
        ],[
            'name.required'=>'Tên Môn Không Được Để Trống',
            'name.unique'=>'Mã Môn Không Được Để Trùng Lặp'
        ]);
        $main_major=MainMajors::find($id);
        $main_major->fill($request->all());
        $main_major->save();
        if($main_major->save()){
            return redirect()->route('bo-mon')->with('message', 'Chỉnh Sửa Thành Công');
        }
        else{
            return redirect()->back()->with('error', 'Đã Có Lỗi Xảy Ra');
        }
        
    }
    public function del($id){
        MainMajors::destroy($id);
        return redirect()->route('bo-mon')->with('message', 'Xóa Thành Công');
    }



}
