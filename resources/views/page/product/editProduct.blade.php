@php
    use Illuminate\Support\Str;
@endphp
@extends('layouts.main')
@section('title')
    <title>Sửa sản phẩm | {{$product->name}}</title>
@endsection
@section('content')
<div class="main-content create-project-page" >
    <div class="container">
        <form action="" id="form-add-product" name="registration-form" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <h2>Chỉnh sửa sản phẩm</h2>
            <div class="add-project">
                <div class="form-add">
                    <div class="form-group">
                        <label for="valName">Tên sản phẩm</label>
                        <input type="text" id="valName" placeholder="Nhập tên sản phẩm" class="name-product" value="{{$product->name}}" name="name">
                        <span class="form-message">
                            @error('name')
                                Vui lòng nhập tên sản phẩm
                            @enderror
                        </span>
                    </div>
                    <div class="form-group">
                        <label for="valSelectCate">Loại sản phẩm</label>
                        <select name="type_id" id="valSelectCate">
                            <option value="">Chọn loại sản phẩm</option>
                            @foreach ($product_types as $product_type)
                            <option value="{{$product_type->id}}">{{$product_type->name}}</option>
                            @endforeach
                        </select>
                        <span class="form-message">
                            @error('type_id')
                                Vui lòng chọn loại sản phẩm
                            @enderror
                        </span>
                    </div>
                    <div class="form-group">
                        <label for="valUrlVideo">Link video (link driver)</label>
                        <input type="url" id="valUrlVideo" name="url_video" value="{{$product->url_video}}" class="select-product" pattern="https://drive.google.com/file/d/.*" placeholder="https://drive.google.com/file/d/. . .">
                        <span class="form-message">
                            @error('url_video')
                                Vui lòng nhập link video
                            @enderror
                        </span>
                    </div>
                    <div class="form-group">
                        <label for="">Học kì</label>
                        <input type="text" value="{{$semester->name}}" disabled>
                        <span class="form-message"></span>
                    </div>
                    <div class="form-group">
                        <label for="">Giảng viên</label>
                        <input type="text" value="{{$product->teacher}}" disabled>
                        <span class="form-message"></span>
                    </div>
                    <div class="form-group">
                        <label for="">Môn học</label>
                        <input type="text" value="{{$subject->name}} - ({{$subject->code}})" disabled>
                        <span class="form-message"></span>
                    </div>
                    <div class="student" class="form-group">
                        <label for="">Nhóm Sinh viên</label>
                        <div class="">
                            <div class="student-item">
                                <div class="student-name">
                                    <input type="text" name="memeberNameActive[]" value="{{$members[0]->full_name}}" class="name-member" placeholder="Tên Thành viên">
                                </div>
                                <div class="student-code">
                                    <input type="text" name="memeberCodeActive[]" value="{{$members[0]->student_code}}" class="code-member" placeholder="Mã sinh viên">
                                </div>
                                <div>
                                    <input type="hidden" value="{{$members[0]->id}}" name="idMemner[]">
                                    <button type="button" id="bnt_add_member"><i class="fas fa-plus"></i></button>
                                </div>
                            </div>
                            <div class="student-sub">
                                @foreach ($members as $item)
                                    @if ($item->id !== $members[0]->id)
                                        <div class="student-item">
                                            <div class="student-name">
                                                <input type="text" name="memeberNameActive[]" value="{{$item->full_name}}" placeholder="Tên Thành viên" class="name-member">
                                            </div>
                                            <div class="student-code">
                                                <input type="text" name="memeberCodeActive[]" value="{{$item->student_code}}" placeholder="Mã sinh viên" class="code-member">
                                            </div>
                                            <div>
                                                <input type="hidden" value="{{$item->id}}" name="idMemner[]">
                                                <button type="button" class="bnt-delete-student-sub"> <i class="far fa-trash-alt"></i></button>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                            <div class="notification">

                            </div>
                            <span class="form-message">
                                @error('memeberNames.*')
                                        <p>Vui lòng nhập đầy đủ tên thành viên</p>
                                @enderror
                                @error('memeberCode.*')
                                    <p>Vui lòng nhập đầy đủ mã thành viên</p>
                                @enderror
                            </span>
                        </div>
                    </div>
                </div>
                <div class="show-img">
                    <div class="upload_document">
                        <label for="">Tài liệu dự án </label>
                        <div class="show_document">
                            <span title="Xem tài liệu" id="show_document_data" data-url-document="{{$product->document_url}}">tai-lieu-{{Str::slug($product->name)}}</span>
                            <button title="Xóa" type="button" id="remove_document_data"><i class="fas fa-minus-square"></i></button>
                        </div>
                        <span class="form-message">
                            {{ $errors->first('document_url') }}
                        </span>
                    </div>
                    <label for="">Hình ảnh sản phẩm <i>(chọn nhiều file)</i></label>
                    <p class="notify-warning">Lưu ý: những file trên 500kb sẽ được hệ thống giảm độ phân giải</p>
                    <div class="upload__box">
                        <div class="upload__btn-box">
                          <label class="upload__btn">
                            <p id="label-input-file">Choose File</p>
                            <input type="file" id="upFile" multiple="" class="upload__inputfile">
                            <input type="file" id="valFile" style="display: none;"  name="images[]" multiple="">
                        </label>
                        <span>No file chosen</span>
                    </div>
                    <div class="upload__img-wrap">
                        @if (count($productGalleries)>0)
                            @foreach ($productGalleries as $item)
                                <div class="upload__img-box">
                                    <div style="background-image: url('{{$item->url_image}}');" class="img-bg show_img-bg" data-imglink="{{$item->url_image}}">
                                        <div class="modalButton bnt-close-img" data-popup="popupOne" data-imglink="{{$item->url_image}}" data-imgid="{{$item->id}}" style="background-color: #db3333;">
                                        </div>
                                    </div>	
                                </div>
                            @endforeach
                        @else
                        <label for="upFile" class="image-empty"><p>Bạn chưa chọn tệp nào? <b>Chọn tệp</b></p></label>
                        @endif
                    </div>
                </div>
                <div class="notification-image"></div>
                </div>
            </div>
            <div class="box-description add-project form-add" style="display: block;">
                <div class="form-group name-descriptShort">
                    <label for="nameDescriptShort">Mô tả ngắn</label>
                    <textarea rows="4" id="nameDescriptShort" name="descript_short" class="" placeholder="Mô tả ngắn . . .">{!! $product->descript_short !!}</textarea>
                    <span class="form-message">
                        @error('descript_short')
                            Vui nhập đúng dữ liệu yêu cầu
                        @enderror
                    </span>
                </div>
                <div class="form-group name-descriptDetail">
                    <label for="nameDescriptDetail">Mô tả chi tiết</label>
                    <textarea rows="7" name="descript_detail" id="nameDescriptDetail" class="tinymceTextarea" placeholder="Mô tả chi tiết . . .">{!! $product->descript_detail !!}</textarea>
                    <span class="form-message">
                        @error('descript_detail')
                            Vui lòng nhập mô tả chi tiết
                        @enderror
                    </span>
                </div class="form-group">
            </div>
            <div id="box_load">
                <div class="box-bnt-submit">
                    <a href="javascript:history.back()" class="bnt-history-back">
                        <i class="fas fa-arrow-left"></i>
                        Quay lại
                    </a>
                    <button type="" class="btn-add" id="form-upload">
                        <i class="fas fa-save"></i>
                        Cập nhật
                    </button>
                </div>
                <div class="box-over-right">

                </div>
            </div>
        </form>
    </div>
    <div class="box-modal">
        <section class="modal modalWindow" id="popupOne">  
            <section class="modalWrapper">
                <h2>Thông báo</h2>
                <p>Ảnh này đã được lưu từ trước đó! Bạn có muốn xóa hình ảnh này không? Hành động này không thể khôi phục.</p>
                <div class="box-bnt-modal">
                    <button class="bnt-modal bnt-confirm-modal bnt-danger" id="confirm-modal">Xác nhận</button>
                    <button class="bnt-modal bnt-close-modal closeBtn">Đóng</button>
                </div>
            </section>
            <span class="closeBtn"><i class="fas fa-times-circle"></i></a>
        </section>
        <section class="modal overlay"></div>
    </div>
</div>
@endsection
@section('page-script')
<script src="https://cdn.tiny.cloud/1/f486sgzy6a1gmtp45aqn15arqe90oi8qz8h7swhh7sx2kzzd/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script src="{{asset('frontend')}}/js/uploadfile.js"></script>
<script>
    qSelect('#valSelectCate').value="{{$product->type_id}}";
    onChangeImage();
    function onChangeImage() {
        jQuery(document).ready(function () {
            ImgUpload();
        });
    }
    var imgArray = [];
    function ImgUpload() {
        var imgWrap = "";

        $('.upload__inputfile').each(function () {
            $(this).on('change', function (e) {
                imgWrap = $(this).closest('.upload__box').find('.upload__img-wrap');
                    var maxLength = 5-(qSelectAll('.upload__img-box .bnt-close-img').length);
                    var files = e.target.files;
                    var filesArr = Array.prototype.slice.call(files);
                    var iterator = 0;
                    filesArr.forEach(function (f, index) {

                        if (!f.type.match('image.*')) {
                            qSelect('.notification-image').innerHTML = "Không thể tải lên tệp này vì không phải là file ảnh";
                            return;
                        }
                        if (imgArray.length > maxLength) {
                            qSelect('.notification-image').innerHTML = "Bạn chỉ được upload tối đa 6 ảnh !";

                        return false
                        } else {
                            qSelect('.notification-image').innerHTML = "";
                            qSelect('.upload__btn-box span').innerHTML = `Đang chọn ${imgArray.length+1} tệp`
                            var len = 0;
                            for (var i = 0; i < imgArray.length; i++) {
                                if (imgArray[i] !== undefined) {
                                len++;
                            }
                        }
                        if (len > maxLength) {
                            qSelect('.notification-image').innerHTML = "Bạn chỉ được upload tối đa 6 ảnh !";
                            return false;
                        } else {
                            if(qSelect('.upload__img-wrap .image-empty')) {
                            qSelect('.upload__img-wrap .image-empty').remove();
                            }
                            imgArray.push(f);
                            qSelect('#label-input-file').innerHTML = "Thêm tệp";
                            qSelect('.notification-image').innerHTML = "";
                            var reader = new FileReader();
                            reader.onload = function (e) {
                            var html = "<div class='upload__img-box'><div style='background-image: url(" + e.target.result + ")' data-number='" + $(".upload__img-close").length + "' data-file='" + f.name + "' class='img-bg show_img-bg'><div class='upload__img-close'></div></div></div>";
                            imgWrap.append(html);
                            iterator++;
                            }
                            reader.readAsDataURL(f);
                        }
                    }
                });

            });
        });

        $('body').on('click', ".upload__img-close", function (e) {
            var file = $(this).parent().data("file");
            for (var i = 0; i < imgArray.length; i++) {
            if (imgArray[i].name === file) {
                qSelect('.notification-image').innerHTML = "";
                imgArrayElement = $('.upload__img-box').length;
                if (imgArrayElement === 0) {
                        qSelect('.upload__img-wrap').innerHTML = '<label for="upFile" class="image-empty"><p>Bạn chưa chọn tệp nào? <b>Chọn tệp</b></p></label>';
                        qSelect('.upload__btn-box span').innerHTML = 'Bạn chưa chọn tệp nào';
                        qSelect('#label-input-file').innerHTML = "Chọn tệp";

                } else {
                    qSelect('.upload__btn-box span').innerHTML = `Đang chọn ${imgArray.length-1} tệp`;
                }
                imgArray.splice(i, 1);
                break;
            }
            }
            $(this).parent().parent().remove();

            if (qSelectAll('.upload__img-box').length === 0) {
                qSelect('.upload__img-wrap').innerHTML = '<label for="upFile" class="image-empty"><p>Bạn chưa chọn tệp nào? <b>Chọn tệp</b></p></label>';
            }
        });
        
    }
    Validator({
        form: '#form-add-product',
        errorSelector: '.form-message',
        membersRequired: ['.name-member','.code-member'],
        rules: [
            Validator.isRequired('#valName',"* Vui lòng nhập tên dự án"),
            Validator.isMaxLenght('#valName',50,"* Tên dự án quá dài"),
            Validator.isRequired('#valSelectCate',"* Vui lòng chọn loại dự án"),
            Validator.isRequired('#valUrlVideo',"* Không được để trống"),
            Validator.isLinkDriver('#valUrlVideo'),
        ],
        onSubmit: function(status) {
            if (status) {
                if (qSelectAll('.upload__img-box .upload__img-close').length > 0) {
                    var boxBig = document.querySelector('#box_load');
                    var boxElement = qSelect('.box-over-right');
                    boxElement.classList.add('over-right');

                    boxElement.innerHTML = `<div class="over-right-content"><img src="{{asset('frontend')}}/images/loading_001.gif" alt=""><p>Vui lòng chờ . . .</p></div>`;
                    
                    qSelect('#box_load .btn-add').style = 'opacity: 0.7;cursor: auto;';
                    var form_data = new FormData();
                    imgArray.forEach(item=> {
                        var file_data = item;
                        form_data.append('file[]', file_data);
                    })
                    setTimeout(() => {
                                $('.over-right-content p').html("Vui lòng đợi chúng tôi đang xử lý dữ liệu . . .");
                            }, 7000);
                    form_data.append('token', `{{$token}}`);
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': "{{ csrf_token() }}"
                        }
                    });
                    $.ajax({
                        method: "POST",
                        url: "{{route('insertFile.product')}}",
                        data:form_data,
                        dataType: "JSON",
                        contentType: false,
                        cache: false,
                        processData: false,
                        success: function (response) {
                            if (response) {
                                qSelect('#form-add-product').submit();
                            } else {
                                boxElement.innerHTML =
                                "Không thể tạo sản phẩm vào lúc này. Vui Lòng Thử lại !";
                                boxElement.classList.remove('over-right');
                                qSelect('#box_load .btn-add').style = 'opacity: 1;cursor: pointer;';
                            }
                        },
                        error: function(err) {
                            boxElement.innerHTML="Không thể tạo sản phẩm vào lúc này. Vui Lòng Thử lại !";
                            boxElement.classList.remove('over-right');
                            qSelect('#box_load .btn-add').style = 'opacity: 1;cursor: pointer;';
                        }
                    });
                } else {
                    qSelect('#form-add-product').submit();
                }
            }
        }
    })
    if (qSelectAll('.upload__img-box .bnt-close-img')) {
        qSelectAll('.upload__img-box .bnt-close-img').forEach(item => {
            item.addEventListener('click', e => {
                qSelect('#confirm-modal').value = item.getAttribute('data-imglink');
                var attributeNewImgid  = document.createAttribute("data-imgid");
                attributeNewImgid.value = item.getAttribute('data-imgid');
                qSelect('#confirm-modal').setAttributeNode(attributeNewImgid);
            })
        })
        qSelect('#confirm-modal').addEventListener('click', e => {
            $(".modal").fadeOut();
            var stringUrl = qSelect('#confirm-modal').value.trim();
            qSelectAll('.upload__img-box .bnt-close-img').forEach(item => {
                if (item.getAttribute('data-imglink').trim() == stringUrl) {
                    item.parentElement.innerHTML = `<div class="loading-delete"><img src="{{asset('frontend')}}/images/loading_001.gif" width="50" alt=""><span>Đang xóa . . .</span></div>`;
                }
            })
            $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    }
            });
            $.ajax({
                method: "POST",
                url: "{{route('removeFile.product')}}",
                data:   {   linkDriver: stringUrl.slice(30, stringUrl.length),
                            idImage: qSelect('#confirm-modal').getAttribute('data-imgid')
                        },
                dataType: "JSON",
                success: function (response) {
                    if (response) {

                        qSelectAll('.upload__img-box .show_img-bg').forEach(item => {
                            if (item.getAttribute('data-imglink').trim() == stringUrl) {
                                qSelect('.upload__img-wrap').removeChild(item.parentElement);
                            }
                        })
                        if (qSelectAll('.upload__box .upload__img-wrap .upload__img-box').length === 0) {
                            qSelect('.upload__box .upload__img-wrap').innerHTML = '<label for="upFile" class="image-empty"><p>Bạn chưa chọn tệp nào? <b>Chọn tệp</b></p></label>';
                        } 
                    }
                },
                error: function(err) {
                    alert('Lỗi !!!');
                }
            });
            
        })

    }
    
    $('.show-img .upload_document #remove_document_data').click(function (e) {
        $('.show-img .upload_document').html(`   <label for="">Tài liệu dự án </label>
                <input type="file" name="document_url" accept=".docx,.doc,.pdf" id="upload_document">
            <span class="form-message">
                {{ $errors->first('document_url') }}
            </span>
        `);

        
    });

</script>
@endsection
