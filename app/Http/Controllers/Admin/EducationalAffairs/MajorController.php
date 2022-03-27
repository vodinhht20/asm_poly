<?php

namespace App\Http\Controllers\Admin\EducationalAffairs;

use App\Http\Controllers\Controller;
use App\Models\Campus;
use Illuminate\Http\Request;
use App\Models\Majors;
use App\Models\User;
use App\Models\MajorsHeadTeacher;
use Google\Service\Classroom\Teacher;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use App\Models\MainMajors;


class MajorController extends Controller
{
    public function index(Request $request)
    {
        $searchValue = $request->has('search_value') ? $request->search_value : "";
        $major = Majors::where('name', 'like', "%$request->search_value%")->paginate(10);
        $major->load('head_teachers');
        $auth = Auth::user();

        $major->appends($request->except('_token'));

        $teacher = MajorsHeadTeacher::get();
        $user = User::get();
        return view('Admin.major.view', compact('major', 'teacher', 'user', 'auth'));
    }
    public function editForm($id)
    {
        $auth = Auth::user();
        $auth_campus = Auth::user()->campus_id;
        $major = Majors::find($id);
        $teachers = MajorsHeadTeacher::where('major_id', $id)->where('campus_id', $auth_campus)->first();
        if ($teachers == "") {
            $teacher = "";
        } else {
            $user = User::find($teachers->teacher);
            $email = $user->email;
            $teacher = preg_replace("/@fpt.edu.vn/", "", $email);
        }

        return view('Admin.major.edit', compact('major', 'teacher', 'auth'));
    }
    public function edit(Request $request, $id)
    {

        $auth_campus = Auth::user()->campus_id;
        $teacher = $request->teacher;
        $user_count = count(User::where('email', "$teacher@fpt.edu.vn")->get());
        if ($user_count == 0) {
            $user = new User();
            $user->name = $teacher;
            $user->email = $teacher . "@fpt.edu.vn";
            $user->campus_id = $auth_campus;
            $user->save();
        } else {
            $user = User::where('email', "$teacher@fpt.edu.vn")->first();
            if($user->campus_id!=$auth_campus){
                return redirect()->back()->with('error', 'Cán Bộ '.$user->name.' Hiện Đang Công Tác Ở Cơ Sở Khác');
            }
        }
        $count = count(MajorsHeadTeacher::where('major_id', $id)->where('campus_id', $auth_campus)->get());
        if ($count == 0) {
            $model = new MajorsHeadTeacher();
            $model->major_id = $id;
            $model->campus_id = $auth_campus;
            $model->teacher = $user->id;
            $model->save();
            $user->assignRole('major_head_teacher');
            return redirect(route('chuyen-nganh'))->with('message', 'Chỉnh Sửa Bộ Môn Thành Công');
        } else {
            $head_teacher = MajorsHeadTeacher::where('major_id', $id)->where('campus_id', $auth_campus)->first();
            $user1 = User::find($head_teacher->teacher);
            $majorcount = count(MajorsHeadTeacher::where('teacher', $user1->id)->get());
            if ($majorcount == 1) {
                $user1->removeRole('major_head_teacher');
                $head_teacher->teacher = $user->id;
                $head_teacher->save();
                if ($head_teacher->save()) {
                    $user->assignRole('major_head_teacher');
                    return redirect(route('chuyen-nganh'))->with('message', 'Chỉnh Sửa Bộ Môn Thành Công');
                } else {
                    return redirect(route('chuyen-nganh'))->with('error', 'Đã Có Lỗi Xảy Ra');
                }
            } else {
                $head_teacher->teacher = $user->id;
                $head_teacher->save();
                $user->assignRole('major_head_teacher');
                return redirect(route('chuyen-nganh'))->with('message', 'Chỉnh Sửa Bộ Môn Thành Công');
            }
        }
    }
    public function AdminEditForm($id)
    {   
        $main_major=MainMajors::get();
        $auth = Auth::user();
        $major = Majors::find($id);
        $campus = Campus::where('id', '>', 1)->get();
        $major->load('head_teachers');
        $head_teachers = MajorsHeadTeacher::where('major_id', $id)->orderBy('campus_id')->get();
        $count = count($head_teachers);
        if ($count == 0) {
            $teacher = "";
        } else {
            for ($i = 0; $i < count($head_teachers); $i++) {
                if ($head_teachers[$i]->teacher != null) {
                    $user = User::find($head_teachers[$i]->teacher);
                    $email = $user->email;
                    $teacher[$i] = preg_replace("/@fpt.edu.vn/", "", $email);
                } else {
                    $teacher[$i] = "";
                }
            }
        }
        return view('Admin.major.edit', compact('major', 'head_teachers', 'teacher', 'auth', 'campus','main_major'));
    }
    public function AdminEdit(Request $request, $id)
    {

        $request->validate([
            'name' => 'required',
            'code' => 'required',
        ], [
            'name.required' => 'Tên Bộ Môn Không Được Để Trống',
            'code.required' => 'Mã Bộ Môn Không Được Để Trống',
        ]);

        // xóa hết bản ghi liên quan đến major
        $lstMajors = MajorsHeadTeacher::where('major_id', $id)->get();
        foreach ($lstMajors as $mj) {
            $count = count(MajorsHeadTeacher::where('teacher', $mj->teacher)->get());
            if ($count == 1) {
                $user = User::find($mj->teacher);
                $user->removeRole('major_head_teacher');
                $user->assignRole('teacher');
            }


            $mj->delete();
        }

        $errorMsg = "";
        foreach ($request->teacher as $campusId => $teacherAccount) {
            if (empty($teacherAccount)) {
                continue;
            }

            // check xem có teacher hay chưa
            $teacher = User::where('email', $teacherAccount . '@fpt.edu.vn')->first();
            if (!$teacher) {
                $teacher = new User();
                $teacher->email = $teacherAccount . '@fpt.edu.vn';
                $teacher->name = $teacherAccount;
                $teacher->campus_id = $campusId;
                $teacher->save();
            }
            if ($teacher->campus_id != $campusId) {
                $cam = Campus::find($campusId);
                $errorMsg .= $teacher->name . " đang công tác tại "
                    . $teacher->user_campus->name
                    . " không thể bổ nhiệm cho cơ sở " . $cam->name . "|";
                continue;
            }
            $teacher->assignRole('major_head_teacher');
            // có teacher rồi thì add bản ghi mới vào bảng majors_head_teacher
            $mhtModel = new MajorsHeadTeacher();
            $mhtModel->major_id = $id;
            $mhtModel->campus_id = $campusId;
            $mhtModel->teacher = $teacher->id;
            $mhtModel->save();
        }
        $major=Majors::find($id);
        $major->fill($request->all());
        $major->save();
        return redirect()->route('chuyen-nganh')->with('message', 'Cập Nhật Bộ Môn Thành Công')
            ->with('fail_message', trim($errorMsg, "|"));
    }
    public function addForm()
    {   
        $main_major=MainMajors::get();
        $campus = Campus::where('id', '>', 1)->get();
        return view('Admin.major.add', compact('campus','main_major'));
    }
    public function add(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'code' => 'required',
        ], [
            'name.required' => 'Tên Bộ Môn Không Được Để Trống',
            'code.required' => 'Mã Bộ Môn Không Được Để Trống',
        ]);
        $major = new Majors();
        $major->fill($request->all());

        $major->save();
        $errorMsg = "";
        foreach ($request->teacher as $campusId => $teacherAccount) {
            if (empty($teacherAccount)) {
                continue;
            }

            // check xem có teacher hay chưa
            $teacher = User::where('email', $teacherAccount . '@fpt.edu.vn')->first();
            if (!$teacher) {
                $teacher = new User();
                $teacher->email = $teacherAccount . '@fpt.edu.vn';
                $teacher->name = $teacherAccount;
                $teacher->campus_id = $campusId;
                $teacher->save();
            }
            if ($teacher->campus_id != $campusId) {
                $cam = Campus::find($campusId);
                $errorMsg .= $teacher->name . " đang công tác tại "
                    . $teacher->user_campus->name
                    . " không thể bổ nhiệm cho cơ sở " . $cam->name . "|";
                continue;
            }
            $teacher->assignRole('major_head_teacher');
            // có teacher rồi thì add bản ghi mới vào bảng majors_head_teacher
            $mhtModel = new MajorsHeadTeacher();
            $mhtModel->major_id = $major->id;
            $mhtModel->campus_id = $campusId;
            $mhtModel->teacher = $teacher->id;
            $mhtModel->save();
        }
        return redirect()->route('chuyen-nganh')->with('message', 'Cập Nhật Bộ Môn Thành Công')
            ->with('fail_message', trim($errorMsg, "|"));
        

        


    }
    public function del($id){
        $head_teacher=MajorsHeadTeacher::where('major_id',$id)->get();
        
        foreach($head_teacher as $ht){
            $user=User::where('id', $ht->teacher)->first();

            $count=count(MajorsHeadTeacher::where('teacher',$user->id)->get());
            if($count==1){
                $user->removeRole(['major_head_teacher']);
            }

            MajorsHeadTeacher::destroy($ht->id);
        }
        Majors::destroy($id);
        return redirect()->route('chuyen-nganh')->with('message','Xóa Bộ Môn Thành Công');
    }
}
