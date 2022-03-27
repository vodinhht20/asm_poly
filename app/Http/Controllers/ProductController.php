<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendResultEmailTeacher;
use App\Mail\NotiUpdateProduct;
use App\Models\Semester;
use App\Models\Product;
use App\Models\Subject;
use App\Models\Member;
use App\Models\User;
use App\Models\ProductType;
use App\Models\ProductGallery;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use Carbon\Carbon;
use Storage;
use File;


class ProductController extends Controller
{
    public function createProduct($token) {
        $product_types = ProductType::all();
        $product = Product::where('token',$token)->first();
        if (isset($product)) {
            if ($product->status != 1) {
                return view('error.errorCreateProduct');
            } else {
                $semester = Semester::find($product->semester);
                $subject = Subject::where('code',$product->code_subject)->first();
                return view('page.product.createProduct',compact('product','product_types','semester','subject','token'));
            }
        } else {
            return view('error.error404');
        }
    }
    public function insertProduct(Request $request,$token) {
        $request->validate([
            'name'=>'required',
            'type_id'=>'required',
            'url_video'=>'required',
            'descript_short'=>'required|max:500',
            'descript_detail'=>'required',
            'memeberNames.*'=>'required',
            'memeberCode.*'=>'required',
            'document_url' => 'required|max:51200|mimes:docx,doc,pdf'
        ], [
            'document_url.required' => 'Vui lòng chọn file',
            'document_url.max' => 'Tài liệu không được quá 50MB',
            'document_url.mimes' => 'Vui lòng chọn file định dạng docx, doc, pdf'
        ]);
        // upload tài liệu
        $path = $request->file('document_url')->store('documents');
        $getPart =  storage_path('app/'.$path);// lấy ra đường dẫn file trên server
        $fileData = File::get($getPart);
        unlink($getPart);  // xóa file ở server
        $newNameFile = Carbon::now()->format('Y-m-d').'_'.uniqid();
        Storage::disk('third_google')->put($newNameFile,$fileData); // đẩy file lên driver
        $contents = collect(Storage::disk('third_google')->listContents('/', false)); // lấy ra tên file
        $linkDriver = $contents ->where('type', '=', 'file')
                                ->where('filename', '=', pathinfo($newNameFile, PATHINFO_FILENAME))
                                ->where('extension', '=', pathinfo($newNameFile, PATHINFO_EXTENSION))
                                ->first();
        $document_url = 'https://drive.google.com/file/d/'.$linkDriver['path'].'/preview';

        $product = Product::where('token',$token)->first();
        $product->fill($request->all());
        $product->status = 3;
        $product->status_video = 1;
        $product->document_url = $document_url;
        $product->descript_detail = preg_replace('/font-family.+?;/', "", $product->descript_detail);
        $product->descript_short = preg_replace('/font-family.+?;/', "", $product->descript_short);
        $product->save();
        for ($i=0; $i < count($_POST['memeberNames']); $i++) { 
            $member = new Member();
            $member ->product_id = $product->id;
            $member ->full_name = $_POST['memeberNames'][$i];
            $member ->student_code = $_POST['memeberCode'][$i];
            $member->save();
        }
        // gửi mail cho giáo viên preview
        $nameProducts = $_POST['name'];
        $createBy = User::find(Auth::id())->name;
        $productType = ProductType::find($_POST['type_id'])->name;
        $subjectName = Subject::where('code',$product->code_subject)->first()->name;
        $teacherName = $product->teacher;
        $emailTeacher = $product->teacher.'@fpt.edu.vn';
        $mailable = new SendResultEmailTeacher($nameProducts,$createBy,$productType,$subjectName,$teacherName,$token);
        Mail::to($emailTeacher)->send($mailable);
        return view('page.product.successfulCreateProduct',compact('token'));
    }
    public function insertFile(Request $request) {
        if (count($_FILES['file']['name']) > 0 && count($_FILES['file']['name']) < 7 ) {
            $getProduct = Product::where('token',$request->token)->first(); // làm sạch bộ nhớ
            if ($getProduct->status == 1) {
                ProductGallery::where('product_id', $getProduct->id)->delete();
            }
            for ($i=0; $i < count($_FILES['file']['name']); $i++) {
                $fileNameLocal = Carbon::now()->format('Y-m-d').'-'.uniqid().'.jpg'; //tất cả chuyển thành file.jpg
                $tmp_name = $_FILES['file']['tmp_name'][$i];
                move_uploaded_file($tmp_name, "./images/" . $fileNameLocal); // đẩy file lên server
                $image[0] = Image::make('images/'.$fileNameLocal);
                $image[1] = Image::make('images/'.$fileNameLocal);

                if($image[0]->filesize() > 512000) { // những file trên 500kb resize lại $image[0]->filesize() > 512000
                    $image[0]->resize(600, null, function ($constraint1) { // resize với chiều rộng cố định là 600
                        $constraint1->aspectRatio();
                    });
                    $image[1]->resize(400, null, function ($constraint2) { // resize với chiều rộng cố định là 400
                        $constraint2->aspectRatio();
                    });

                    $image[0]->save("images/big-".$fileNameLocal);   // lưu ảnh đã chỉnh sủa vào thư mục
                    
                    $name = Carbon::now()->format('Y-m-d').'-'.uniqid().'.jpg';
                    $image[1]->save("images/small-".$name);   // lưu ảnh đã chỉnh sủa vào thư mục
                    
                    unlink(public_path('images/'.$fileNameLocal)); // xóa file gốc

                    $path[0] = public_path('images/big-'.$fileNameLocal); // lấy ra đường dẫn file trên server
                    $path[1] = asset('images/small-'.$name); // lấy ra đường dẫn file trên server
                    
                    $fileData = File::get($path[0]);
                    unlink($path[0]);  // xóa file ở server
                } else { 
                    $path[0] = public_path('images/'.$fileNameLocal); // lấy ra đường dẫn file trên server
                    
                    $path[1] = asset('images/'.$fileNameLocal); // lấy ra đường dẫn file trên server
                    $fileData = File::get($path[0]);
                }
                    Storage::disk('google')->put($fileNameLocal,$fileData); // đẩy file lên driver
                    $contents = collect(Storage::disk('google')->listContents('/', false)); // lấy ra tên file
                    $linkDriver[0] = $contents ->where('type', '=', 'file')
                                            ->where('filename', '=', pathinfo($fileNameLocal, PATHINFO_FILENAME))
                                            ->where('extension', '=', pathinfo($fileNameLocal, PATHINFO_EXTENSION))
                                            ->first();

                // lưu đường dẫn driver vào database
                $product_gallery = new ProductGallery();
                $product_gallery->product_id = $getProduct->id;
                $product_gallery->url_image = 'https://docs.google.com/uc?id='.$linkDriver[0]['path'];
                $product_gallery->url_image_small = $path[1];
                $product_gallery->save();
            }
            return response()->json(true);
        }
        return response()->json(false);
    }
    public function removeFile(Request $request) {
        ProductGallery::destroy($request->idImage);
        $fileinfo = collect(Storage::disk('google')->listContents('/', false)) // lấy ra tên file
                    ->where('type','file')
                    ->where('path',$request->linkDriver)
                    ->first();
        Storage::disk('google')->delete($fileinfo['path']);
        return response()->json(true);


    }
    public function editProduct($token) {
        $product = Product::where([['token','=',$token],['status', '>', 1]])->first();
        if (isset($product)) {  // kiểm tra xem đúng đường dẫn
            if ($product->status === 2 || $product->status === 3) {
                $productGalleries = ProductGallery::where('product_id',$product->id)->get();
                $product_types = ProductType::all();
                $semester = Semester::find($product->semester);
                $subject = Subject::where('code',$product->code_subject)->first();
                $members = Member::where('product_id',$product->id)->get();
                return view('page.product.editProduct',compact('product','product_types','semester','subject','token','productGalleries','members'));
            } else {
                return view('error.error403');
            }
        } else {
            return view('error.error404');
        }
    }
    public function updateProduct(Request $request, $token) {
        $request->validate([
            'name'=> 'required',
            'type_id'=> 'required',
            'url_video'=> 'required',
            'descript_short'=> 'required|max:500',
            'descript_detail'=> 'required',
            'memeberNames.*'=> 'required',
            'memeberCode.*'=> 'required',
            'document_url' => 'max:51200|mimes:docx,doc,pdf'
        ], [
            'document_url.max' => 'Tài liệu không được quá 50MB',
            'document_url.mimes' => 'Vui lòng chọn file định dạng docx, doc, pdf'
        ]);
        $product = Product::where([['token','=',$token],['status', '=', 2]])
                                ->orWhere([['token','=',$token],['status', '=', 3]])
                                ->first();
        if (isset($product)) {

            $product = Product::where('token',$token)->first();

            // upload tài liệu
            if ($request->file('document_url')) {
                $path = $request->file('document_url')->store('documents');
                $getPart =  storage_path('app/'.$path);// lấy ra đường dẫn file trên server
                $fileData = File::get($getPart);
                unlink($getPart);  // xóa file ở server
                $newNameFile = Carbon::now()->format('Y-m-d').'_'.uniqid();
                Storage::disk('third_google')->put($newNameFile,$fileData); // đẩy file lên driver
                $contents = collect(Storage::disk('third_google')->listContents('/', false)); // lấy ra tên file
                $linkDriver = $contents ->where('type', '=', 'file')
                                        ->where('filename', '=', pathinfo($newNameFile, PATHINFO_FILENAME))
                                        ->where('extension', '=', pathinfo($newNameFile, PATHINFO_EXTENSION))
                                        ->first();
                $document_url = 'https://drive.google.com/file/d/'.$linkDriver['path'].'/preview';
                $product -> document_url = $document_url;
            }
            //-- *** --//
            $product->fill($request->all());
            $product->status = 3;
            $product->save();
            $product->descript_detail = preg_replace('/font-family.+?;/', "", $product->descript_detail);
            $product->descript_short = preg_replace('/font-family.+?;/', "", $product->descript_short);
            $members = Member::where('product_id',$product->id)->get();
            foreach ($members as $member) {
                for ($i=0; $i < count($_POST['idMemner']); $i++) {
                    if ($member->id === intval($_POST['idMemner'][$i])) {
                        $member->full_name = $_POST['memeberNameActive'][$i];
                        $member->student_code = $_POST['memeberCodeActive'][$i];
                        $member->save();
                    }
                }
                if (!in_array($member->id, $_POST['idMemner'])) {
                    Member::destroy($member->id);
                }
            }
            if (isset($_POST['memeberNames'])) {
                for ($i=0; $i < count($_POST['memeberNames']); $i++) { 
                    $member = new Member();
                    $member ->product_id = $product->id;
                    $member ->full_name = $_POST['memeberNames'][$i];
                    $member ->student_code = $_POST['memeberCode'][$i];
                    $member->save();
                }
            }
            // gửi mail cho sinh viên khi thay đổi file
                // $productUpdate = Product::where('token',$token)->first();
                // $nameProducts = $productUpdate->name;
                // $updateBy = User::find(Auth::id())->name;
                // $createBy = User::find($productUpdate->create_by)->name;
                // $emailStudent = User::find($productUpdate->create_by)->email;

                // $dateNow = Carbon::now('Asia/Ho_Chi_Minh');
                // $mailable = new NotiUpdateProduct($nameProducts,$createBy,$updateBy,$dateNow,$token);
                // Mail::to($emailStudent)->send($mailable);
            return view('page.product.successfulUpdateProduct',compact('token'));
        } else {
            return view('error.permissionDeny');
        }
    }
}
