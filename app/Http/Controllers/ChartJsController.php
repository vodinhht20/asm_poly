<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\FuncCall;

class ChartJsController extends Controller
{
    public function index()

    {
        $data_majors = DB::select('<sql query>');
        $name = [];
        $count = [];
        foreach($data_majors as $item){
            $name[] = $item->major_name;
            $count[] = $item->sl;
        }
        
        
        
        // dd($name_product_type);
    	return view('pie-chartjs')->with('name', json_encode($name,JSON_NUMERIC_CHECK))->with('count', json_encode($count, JSON_NUMERIC_CHECK));
                                    
    }

    public function columnchart(){
        $data_product_type = DB::select('
        SELECT
            COUNT(*) as "cvideo",
            majors.`name` as "majors_name",
            subjects.`name`,
            DATE_FORMAT(products.updated_at,"%M") AS "month"
        FROM
                majors INNER JOIN subjects ON majors.id = subjects.major_id INNER JOIN products ON subjects.`code` = products.code_subject
        WHERE products.`status` = 5
        GROUP BY
            majors.`name`,
            subjects.`name`,
        DATE_FORMAT(products.updated_at,"%M")
        ORDER BY 
        DATE_FORMAT(products.updated_at,"%M") ASC 
        ');
        $cvideo = [];
        $month = [];
        $majors_name = [];
        $subjects_name = [];
        foreach($data_product_type as $item){
            $cvideo[] = $item->cvideo; 
            $month[] = $item->month; 
            $majors_name[] = $item->majors_name;
            $subjects_name[] = $item->name;
        }
        // dd($cvideo);
        return view('bar-chartjs')->with('cvideo', json_encode($cvideo, JSON_NUMERIC_CHECK))
                                    ->with('month', json_encode($month, JSON_NUMERIC_CHECK))
                                    ->with('subjects_name', json_encode($subjects_name, JSON_NUMERIC_CHECK))
                                    ->with('majors_name', json_encode($majors_name, JSON_NUMERIC_CHECK));
    }
}
