<?php

namespace App\Http\Controllers\Admin\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\MajorsHeadTeacher;
use Illuminate\Http\Request;
use App\Mail\HeadTeacherNotice;
use App\Mail\StudentGotApproveNotice;
use App\Mail\StudentGotReject;
use App\Mail\ProductGotDeleted;
use App\Models\Campus;
use App\Models\ProductGallery;
use App\Models\Product;
use App\Models\Member;
use App\Models\Subject;
use App\Models\Semester;
use App\Models\Majors;
use Illuminate\Support\Facades\Mail;
use App\Models\User;

class TeacherPreviewController extends Controller
{
    public function preview(Request $request){
        $searchValue = $request->has('search_value') ? $request->search_value : "";

        $email=Auth::user()->email;
        $email2= preg_replace("/@fpt.edu.vn/", "",$email);
        $product=Product::where('teacher',$email2 )->whereIn('status',[ 2, 3])->where('name','like', "%$request->search_value%")->paginate(10);

        

        $product->appends($request->except('_token'));
        return view('Admin.teacher.preview',compact('product'));
    }
    public function ajaxpreview(Request $request){
        $product=Product::find($request->preview_id);
       

        $semester=Semester::where('id',$product->semester)->first();
        $member=Member::where('product_id',$product->id)->get();
        $gallery=ProductGallery::where('product_id',$product->id)->get();
        
        return response()->json([
           'product'=> $product,
            'gallery'=> $gallery,
            'member'=>$member,
            'semester'=>$semester
        ] 
        );
    }
    public function accept($id){
        $product=Product::find($id);
        $subject = Subject::where('code',$product->code_subject)->first();   // Lấy ra môn học để lấy ra trưởng bộ môn
	//dd($product->create_by_obj->campus_id);
        //$majors = Majors::find($subject->major_id);
	
        $majorsHeadTeacher = MajorsHeadTeacher::where('major_id',$subject->major_id)->where('campus_id', $product->create_by_obj->campus_id)->first();
        $headTeacher = User::where('id',$majorsHeadTeacher->teacher)->where('campus_id',$product->create_by_obj->campus_id)->first();

        $teacherApprove =  User::find(Auth::id())->name;// lấy thông tin giáo viên bộ môn phê duyệt
	//dd($product->create_by_obj->campus_id, $majorsHeadTeacher->teacher);
        $mailable = new HeadTeacherNotice($headTeacher->name,$product->name,$teacherApprove,$subject->code,$subject->name); // gửi mail thông báo cho truong bo mon
        Mail::to($headTeacher->email)->send($mailable);
        $product->status=4;
        $product->save();
        return back();
    }
    public function rejectModal(Request $request){
        $product=Product::find($request->preview_id);
        return response()->json($product);
    }
    public function reject(Request $request){
        
        $product=Product::find($request->id);
        $student=User::where('id',$product->create_by)->first();
        $subject=Subject::where('code',$product->code_subject)->first();
        $reason=$request->reason;
        $product->reject_reason = $reason;
        $product->save();
        $mailable = new StudentGotReject($product->name,$student->name,$subject->code,$subject->name,$reason,$product->token); // gửi mail thông báo cho sinh viên
        Mail::to($student->email)->send($mailable);
        $product->status=2;
        $product->save();
        return response()->json(['product'=>$product],200);
        
    }
   
    
    public function FinalPreview(Request $request){
        $searchValue = $request->has('search_value') ? $request->search_value : "";
        $currentUserMajors = MajorsHeadTeacher::where('teacher', Auth::id())
                                            ->where('campus_id', Auth::user()->campus_id)->pluck('major_id')->toArray();
        $subjectInMajors = Subject::whereIn('major_id', $currentUserMajors)->pluck('code')->toArray();
        // dd($subjectInMajors);
        $products = Product::where('status', 4)
                            ->whereIn('code_subject', $subjectInMajors)
                            ->where('campus_id', Auth::user()->campus_id)
                            ->where('name','like', "%$request->search_value%")
                            ->paginate(10);
        $products->appends($request->except('_token'));
        $majorhead=MajorsHeadTeacher::get();
        $majorhead->load('major_obj');
        return view('Admin.teacher.finalpreview',compact('products','majorhead'));
    }
    public function Finalaccept($id){
        $product=Product::find($id);
        $product->load('create_by_obj');
        $subject = Subject::where('code',$product->code_subject)->first();   // Lấy ra môn học để lấy ra trưởng bộ môn
        $majors = Majors::find($subject->major_id); //Bộ Môn
        $majorsHeadTeacher = MajorsHeadTeacher::where('major_id',$subject->major_id)->where('campus_id', $product->create_by_obj->campus_id)->first(); // id của trưởng bộ môn
        $headTeacher = User::where('id',$majorsHeadTeacher->teacher)->where('campus_id',$product->create_by_obj->campus_id)->first(); //Lọc ra trưởng bộ môn cùng cơ sở với người làm sản phẩm
        $student=User::where('id',$product->create_by)->first();

        $mailable = new StudentGotApproveNotice($headTeacher->name,$product->name,$student->name,$subject->code,$subject->name,$product->token); // gửi mail thông báo cho truong bo mon
        Mail::to($student->email)->send($mailable);
        $product->status=5;
        $str = $product->url_video;
        $regex = '/.*[^-\w]([-\w]{25,})[^-\w]?.*/';
        preg_match($regex, $str, $matches, PREG_OFFSET_CAPTURE, 0);
        $contents = "https://drive.google.com/file/d/".$matches[1][0]."/preview";
        $product->url_video = $contents;
        $product->save();
        return back();
       
    }
    
  
    public function demo(Request $request) {
        
        $product=Product::find($request->id);

        $str = $product->url_video;
        $regex = '/.*[^-\w]([-\w]{25,})[^-\w]?.*/';
        preg_match($regex, $str, $matches, PREG_OFFSET_CAPTURE, 0);
        $contents = "https://drive.google.com/file/d/".$matches[1][0]."/preview";
        $major=Majors::get();
        $product->load('product_gallery','member_obj','semester_obj','subject_obj');
        return view('Admin.teacher.demo',compact('product','major','contents'));
    }
    public function del($id){
        $product=Product::find($id);
        $student=User::where('id',$product->create_by)->first();
        $subject=Subject::where('code',$product->code_subject)->first();
        $mailable = new ProductGotDeleted($product->name,$student->name,$subject->code,$subject->name); // gửi mail thông báo cho sinh viên
        Mail::to($student->email)->send($mailable);
        $product->delete();
        return redirect()->route('preview');
    }
    

  
}
