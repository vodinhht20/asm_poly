<?php

namespace App\Http\Controllers;

use App\Models\Majors;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Semester;
use App\Models\Subject;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\FuncCall;

class DashboardController extends Controller
{
    public function index(){
        $semester = Semester::orderByDesc('id')->take(3)->get();
        $majors = Majors::all();
        
        $dataArr = [];
        foreach($semester as $index => $se){
            $listSubjCode = [];
            $dataArr[$index][] = $se->name;
            foreach($majors as $mj){
                $listSubjCode = $mj->subjects->pluck('code');
                
                $countProjectByMajor = Product::where('status', 5)
                                ->where('semester', $se->id)
                                ->whereIn('code_subject', $listSubjCode)->count();
                $dataArr[$index][] = $countProjectByMajor;
            }
        }
        $titleArr = ["Thống kê sản phẩm"];
        foreach($majors as $mj){
            $titleArr[] = $mj->name;
        }
        array_unshift($dataArr, $titleArr);

        return view('admin.dashboard.index', compact('dataArr'));
        
    }
    public function nhapdiem(){
        
        $semester=Semester::orderByDesc('id')->get();
        return view('admin.upload-file.upload-excel',compact('semester'));
    }
    public function test(){
        return view('admin.test.test');
    }
}
