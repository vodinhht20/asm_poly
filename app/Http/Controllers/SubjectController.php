<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subject;
use App\Models\Majors;

class SubjectController extends Controller
{
    public function index(Request $request){
       
        $searchValue = $request->has('search_value') ? $request->search_value : "";
        $subject = Subject::where('name','like', "%$request->search_value%")->paginate(10);
        $subject->appends($request->except('_token'));

        $major=Majors::get();
        return view('Admin.subject.view',compact('subject','major', 'searchValue'));
        
    }
    
    public function editForm($id){
        $subject=Subject::find($id);
        $major=Majors::get();
        return view('Admin.subject.edit',compact('subject','major'));
    }
    public function edit(Request $request,$id){
        $request->validate([
            'name'=>'required',
            'code'=>"required|unique:subjects,code,$id"
        ],[
            'name.required'=>'Tên Môn Không Được Để Trống',
            'code.required'=>'Mã Môn Không Được Để Trống',
            'code.unique'=>'Mã Môn Không Được Để Trùng Lặp'
        ]);
        $subject=Subject::find($id);
        $subject->fill($request->all());
        $subject->save();
        if($subject->save()){
            return redirect()->route('mon-hoc')->with('message', 'Chỉnh Sửa Thành Công');
        }
        else{
            return redirect()->back()->with('error', 'Đã Có Lỗi Xảy Ra');
        }
        
    }
    public function addForm(){
        $major=Majors::get();
        return view('Admin.subject.add',compact('major'));
    }
    public function add(Request $request){
        $request->validate([
            'name'=>'required',
            'code'=>'required|unique:subjects,code',
        ],[
            'name.required'=>'Tên Môn Không Được Để Trống',
            'code.required'=>'Mã Môn Không Được Để Trống',
            'code.unique'=>'Mã Môn Không Được Để Trùng Lặp'
        ]);
        $subject= new Subject;
        $subject->fill($request->all());
        $subject->save();
        if($subject->save()){
            return redirect()->route('mon-hoc')->with('message', 'Thêm Thành Công');
        }
        else{
            return redirect()->route('mon-hoc')->with('error', 'Đã Có Lỗi Xảy Ra');
        }
    }
    public function del($id){
        Subject::destroy($id);
        return redirect()->route('mon-hoc')->with('message', 'Xóa Thành Công');
    }
    public function searchKey(Request $request){
        $subject=Subject::where('name','like','%'.$request->key.'%')->get();
        $subject->load('major_obj');
        return response() -> json( $subject);

    }
    public function ExcelAddForm(){
        return view('Admin.subject.exceladd');
    }
    public function ExcelAdd(Request $request){
            
    }

}
