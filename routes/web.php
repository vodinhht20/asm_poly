<?php
use App\Http\Controllers\testRoleController;

use App\Http\Controllers\ProductDetailController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CopyRight;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ExcelController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\DownloadLinkController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\Admin\Teacher\TeacherPreviewController;
use App\Http\Controllers\Admin\EducationalAffairs\MajorController;
use App\Http\Controllers\MainMajorsController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\MoreSeeController;
use App\Http\Controllers\ProductByMajorController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SeeMoreProductController;
use App\Http\Controllers\test_rating;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|<a href="{{ route('all.product.type', ['id'=>1]) }}" >
                Xem Thêm ...
            </a>
*/

Route::get("test_rating", [test_rating::class, 'index']);

Route::get('/',[HomePageController::class,'index'])->name('home');

Route::post('ajax-home-order-product-type', [HomePageController::class, 'ajaxSortProductType'])->name('home.ajax-order-product-type');

Route::get('/more/products/{id}',[MoreSeeController::class,'more_product_type']);

Route::get('chuyen-nganh/{slug}',[ProductByMajorController::class, 'ListProductByMajor'])->name('list-product-by-major.product');

Route::get('san-pham',[SeeMoreProductController::class, 'seeMore'])->name('seeMore.product');

Route::post('ajax-see-more',[SeeMoreProductController::class, 'ajaxProductSeeMore'])->name('ajax_see_more.product');

Route::post('ajax-list-product-by-major', [ProductByMajorController::class,'ajaxProductByMajor'])->name('ajax-product-by-major');

Route::match(['get', 'post'],'/filter/{id}/{a}',[HomePageController::class,'filter_product_type'])->name('filter.products');

Route::post('/filter',[HomePageController::class,'filter'])->name('filter');

Route::get('san-pham/{token}/view',[ProductDetailController::class,'index'])->name('detail.product.view');

Route::post('san-pham/ajax-rating',[ProductDetailController::class,'rating'])->name('rating.product');

Route::post('san-pham/ajax-comment',[ProductDetailController::class,'comment'])->name('comment.product');

Route::get('san-pham/ajax-increase-view',[ProductDetailController::class,'increaseView'])->name('increase_view.product');

Route::get('/product/type/{id}/', [HomePageController::class, 'list_product_type'])->name('home.product');

Route::get('/search', [SearchController::class, 'index'])->name('search-client');

Route::get('ajax-search', [SearchController::class, 'ajaxSearch'])->name('ajax-search-product');

Route::post('ajax-search-sort', [SearchController::class, 'ajaxProductSearchSort'])->name('ajax-search-product-sort');

Route::get('login', [LoginController::class, 'loginScreen'])->name('login');

Route::get('google-login', [LoginController::class, 'redirectGGAuth'])->name('gg.login');

Route::get('callback/google', [LoginController::class, 'ggAuthCallback']);

Route::any('logout', [LoginController::class, 'logout'])->name('logout');

Route::get('tai-video', [DownloadLinkController::class, 'index'])->name('download.video');

Route::get('chinh-sach-bao-mat',[CopyRight::class,'chinhsachbaomat'])->name('chinhSachBaoMat');

Route::get('error-403', function () {
    return view("error.error403");
})->name("error-403");

Route::middleware('auth')->group(function () {
    Route::get('tao-san-pham/{token}', [ProductController::class, 'createProduct'])->name('create.product')->middleware('auth_create_project');
    Route::post('tao-san-pham/{token}', [ProductController::class, 'insertProduct'])->name('insertProduct.product')->middleware('auth_create_project');
    Route::post('up-file-image-drive', [ProductController::class, 'insertFile'])->name('insertFile.product');
    Route::post('remove-image-driver', [ProductController::class, 'removeFile'])->name('removeFile.product');
    Route::get('san-pham/{token}/edit', [ProductController::class, 'editProduct'])->name('edit.product')->middleware('auth_edit_project');
    Route::post('san-pham/{token}/edit', [ProductController::class, 'updateProduct'])->name('update.product')->middleware('auth_edit_project');
    Route::get('hoan-thanh', [ProductController::class, 'successfulProduct'])->name('successfulProduct.product');
    Route::prefix('admin')->middleware('role:teacher|major_head_teacher|admin|giao_vu')->group(function () {
        //Dashboad
        Route::get('', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

        //import Excel
        Route::get('nhap-diem', [DashboardController::class, 'nhapdiem'])->name('nhap-diem')->middleware('role:giao_vu');
        Route::post('nhap-diem', [ExcelController::class, 'import'])->name('nhap-diem')->middleware('role:giao_vu');

        //Giáo Viên Hướng Dẫn Xem Trước/PHê Duyệt/Từ Chối
        Route::get('preview', [TeacherPreviewController::class, 'preview'])->name('preview')->middleware('role:teacher');
        Route::post('preview', [TeacherPreviewController::class, 'ajaxpreview'])->name('ajaxpreview');
        Route::any('preview/{id}/accept', [TeacherPreviewController::class, 'accept'])->name('preview/accept')->middleware('role:teacher');
        Route::get('preview/reject', [TeacherPreviewController::class, 'rejectModal'])->name('preview/reject')->middleware('role:teacher');
        Route::post('preview/reject', [TeacherPreviewController::class, 'reject'])->name('preview/reject')->middleware('role:teacher');
        Route::any('preview/{id}/del', [TeacherPreviewController::class, 'del'])->name('preview/del')->middleware('role:teacher');

        //demo
        Route::any('demo/{id}', [TeacherPreviewController::class, 'demo'])->name('demo')->middleware('role:teacher|major_head_teacher');

        //Chủ Nhiệm Bộ Môn Xem Trước/Phê Duyệt/Từ CHối
        Route::get('final-preview', [TeacherPreviewController::class, 'FinalPreview'])->name('final-preview')->middleware('role:major_head_teacher');
        Route::post('final-preview', [TeacherPreviewController::class, 'ajaxpreview'])->name('ajaxpreview')->middleware('role:major_head_teacher');
        Route::any('final-preview/{id}/accept', [TeacherPreviewController::class, 'Finalaccept'])->name('final-preview/accept')->middleware('role:major_head_teacher');
        Route::get('final-preview/reject', [TeacherPreviewController::class, 'rejectModal'])->name('final-preview/reject')->middleware('major_head_teacher');
        Route::post('final-preview/reject', [TeacherPreviewController::class, 'reject'])->name('final-preview/reject')->middleware('role:major_head_teacher');
      
        //CHỉnh Sửa Chuyên Ngành
        Route::get('chuyen-nganh', [MajorController::class, 'index'])->name('chuyen-nganh')->middleware('role:giao_vu|admin');
        Route::get('chuyen-nganh/add', [MajorController::class, 'addForm'])->name('chuyen-nganh/add')->middleware('role:admin');
        Route::post('chuyen-nganh/add', [MajorController::class, 'add'])->name('chuyen-nganh/add')->middleware('role:admin');
        Route::get('chuyen-nganh/{id}/edit', [MajorController::class, 'editForm'])->name('chuyen-nganh/edit')->middleware('role:giao_vu');
        Route::get('chuyen-nganh/{id}/admin-edit', [MajorController::class, 'AdminEditForm'])->name('chuyen-nganh/admin-edit')->middleware('role:admin');
        Route::post('chuyen-nganh/{id}/edit', [MajorController::class, 'edit'])->name('chuyen-nganh/edit')->middleware('role:giao_vu');
        Route::post('chuyen-nganh/{id}/admin-edit', [MajorController::class, 'AdminEdit'])->name('chuyen-nganh/admin-edit')->middleware('role:admin');
        Route::any('chuyen-nganh/{id}/del', [MajorController::class, 'del'])->name('chuyen-nganh/del')->middleware('role:admin');
        Route::post('test', [TeacherPreviewController::class, 'ajaxpreview'])->name('ajaxpreview');

        //Chỉnh Sửa Bộ Môn
        Route::get('bo-mon', [MainMajorsController::class, 'index'])->name('bo-mon')->middleware('role:admin');
        Route::get('bo-mon/add', [MainMajorsController::class, 'addForm'])->name('bo-mon/add')->middleware('role:admin');
        Route::post('bo-mon/add', [MainMajorsController::class, 'add'])->name('bo-mon/add')->middleware('role:admin');
        Route::get('bo-mon/{id}/edit', [MainMajorsController::class, 'editForm'])->name('bo-mon/edit')->middleware('role:admin');
        Route::post('bo-mon/{id}/edit', [MainMajorsController::class, 'edit'])->name('bo-mon/edit')->middleware('role:admin');
        Route::any('bo-mon/{id}/del', [MainMajorsController::class, 'del'])->name('bo-mon/del')->middleware('role:admin');

        //Chỉnh Sửa Môn Học
        Route::any('mon-hoc', [SubjectController::class, 'index'])->name('mon-hoc')->middleware('role:giao_vu|admin');
        Route::get('mon-hoc/add', [SubjectController::class, 'addForm'])->name('mon-hoc/add')->middleware('role:giao_vu|admin');
        Route::post('mon-hoc/add', [SubjectController::class, 'add'])->name('mon-hoc/add')->middleware('role:giao_vu|admin');
        Route::get('mon-hoc/excel-add', [SubjectController::class, 'ExcelAddForm'])->name('mon-hoc/excel-add')->middleware('role:giao_vu|admin');
        Route::post('mon-hoc/excel-add', [SubjectController::class, 'ExcelAdd'])->name('mon-hoc/excel-add')->middleware('role:giao_vu|admin');
        Route::get('mon-hoc/{id}/edit', [SubjectController::class, 'editForm'])->name('mon-hoc/edit')->middleware('role:giao_vu|admin');
        Route::post('mon-hoc/{id}/edit', [SubjectController::class, 'edit'])->name('mon-hoc/update')->middleware('role:giao_vu|admin');
        Route::any('mon-hoc/{id}/del', [SubjectController::class, 'del'])->name('mon-hoc/del')->middleware('role:admin');
        Route::get('search-subject', [SubjectController::class, 'searchKey'])->name('searchKey/subject');

        //Admin Thêm,Sửa,Tước Quyền Giáo Vụ
        Route::get('giao-vu', [AdminController::class, 'index'])->name('giao-vu')->middleware('role:admin');
        Route::get('giao-vu/edit/{id}', [AdminController::class, 'editForm'])->name('giao-vu/edit')->middleware('role:admin');
        Route::post('giao-vu/edit/{id}', [AdminController::class, 'edit'])->name('giao-vu/edit')->middleware('role:admin');
        Route::any('giao-vu/disable/{id}', [AdminController::class, 'disable'])->name('giao-vu/disable')->middleware('role:admin');
        Route::get('giao-vu/add',[AdminController::class, 'addForm'])->name('giao-vu/add')->middleware('role:admin');
        Route::post('giao-vu/add',[AdminController::class, 'add'])->name('giao-vu/add')->middleware('role:admin');
    });
});



Route::get('test',function(){
	echo phpinfo();
});
Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});
