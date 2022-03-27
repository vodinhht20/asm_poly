<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\ExcelDetail;
use App\Models\ExcelImport;
use App\Models\User;
use Illuminate\Support\Facades\File;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;



class ExcelController extends Controller
{

    public function import(Request $request)
    {
        $request->validate([
            'semester' => 'required',
            'file' => 'required|max:50000|mimes:xlsx,xls',
        ], [
            'file.required' => 'Không Được Để Trống File',
            'file.mimes'=>'Xin Hãy Xem Lại Loại File, Hệ Thống Chỉ Chấp Nhận Các Loại File Có Đuôi: xlsx, xls.'
        ]);
        
            $semester = $_POST['semester']; //kỳ học
            $model = new ExcelImport();
            $model->fill($_POST);
            $result = $model->save();
            try {
            if ($result) {
                $excelName = $_FILES['file']['name'];
                $tmp_name = $_FILES['file']['tmp_name'];
                move_uploaded_file($tmp_name, "./exceldata/" . $excelName); //lấy file
                $file = "./exceldata/" . $excelName;
                $spreadsheet = IOFactory::load($file); //load file excel
                $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true); //đọc file excel
                
                for ($i = 2; $i <= count($sheetData); $i++) {
                    $excel = new ExcelDetail();
                    $excel->excel_id = $model->id;
                    $excel->name = $sheetData[$i]["A"];
                    $excel->subject_code = $sheetData[$i]["B"];
                    $excel->teacher = $sheetData[$i]["C"];
                    $excel->score = $sheetData[$i]["D"];
                    $excel->semester_id = $semester;
                    $excel->save();
                    
                    // check sinh viên và tạo tài khoản
                    $count = count(User::where('email', 'like', '%' . $sheetData[$i]['A'] . '%')->get());
                    if ($count == 0) {
                        $student = new User();
                        $student->name = $sheetData[$i]['A'];
                        $student->email = $sheetData[$i]['A'] . "@fpt.edu.vn";
                        $student->campus_id = $model->campus_id;
                        $student->save();
                        if ($student->save()) {
                            $student->assignRole('student');
                        }
                    }
                    //check giáo viên và tạo tài khoản
                    $count = count(User::where('email', 'like', '%' . $sheetData[$i]['C'] . '%')->get());
                    if ($count == 0) {
                        $teacher = new User();
                        $teacher->name = $sheetData[$i]['C'];
                        $teacher->email = $sheetData[$i]['C'] . "@fpt.edu.vn";
                        $teacher->campus_id = $model->campus_id;
                        $teacher->save();
                        if ($teacher->save()) {
                            $teacher->assignRole('teacher');
                        }
                    }
                }
            }
            File::delete($file);
            return redirect()->back()->with('message', 'Nhập File Thành Công');
        } catch (\Exception $ex) {
            $id=$model->id;
            ExcelImport::destroy($id);
            File::delete($file);
            return back()->with('error', 'Đã Có Lỗi Xảy Ra');

        }
    }
}
