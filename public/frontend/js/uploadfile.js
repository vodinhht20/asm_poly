const qSelect = document.querySelector.bind(document);
const qSelectAll = document.querySelectorAll.bind(document);

$(document).ready(function(){
    var addButton = $('#bnt_add_member');
    var wrapper = $('.student-sub');
    var fieldHTML = `<div class="student-item">
                        <div class="student-name">
                            <input type="text" name="memeberNames[]" class="name-member" placeholder="Tên Thành viên ">
                        </div>
                        <div class="student-code">
                            <input type="text" name="memeberCode[]" class="code-member" placeholder="Mã sinh viên ">
                        </div>
                        <div>
                            <button type="button" class="bnt-delete-student-sub"> <i class="far fa-trash-alt"></i></button>
                        </div>
                    </div>`;
        $(addButton).click(function(){
            if($('.student-item').length < 7){ 
                $(wrapper).append(fieldHTML);

            } else {
                qSelect('.notification').innerHTML = "* Đã đạt tới giới hạn thành viên";
            }
        });
        
        $(wrapper).on('click', '.bnt-delete-student-sub', function(e){
            qSelect('.notification').innerHTML = "";
            e.preventDefault();
            $(this).parent('div').parent('div').remove();
        });
});

function Validator(options) {
    var selectorRules = {};
    function validate(inputElement,rule) {
        var errorMessage;
        var errorElement = inputElement.parentElement.querySelector(options.errorSelector);

        var rules = selectorRules[rule.selector];
        for(var i = 0; i < rules.length; ++i) {
            errorMessage = rules[i](inputElement.value)
            if (errorMessage) {
                break;
            }
        }
        if (errorMessage) {
            errorElement.innerText = errorMessage;
            inputElement.classList.add('invalid');
        } else {
            inputElement.classList.remove('invalid');
            errorElement.innerText = '';
        }
        return !errorMessage;
    }


    var fromElement = qSelect(options.form)

    if (fromElement) {
        fromElement.onsubmit = (e) => {
            e.preventDefault();
            var isFormValid = true;
            options.rules.forEach(rule => {
            var inputElement = fromElement.querySelector(rule.selector)
                var isValid = validate(inputElement,rule)
                if (!isValid) {
                    isFormValid = false;
                }
            });
            CountCharacters();
            function CountCharacters() {  
                var bodyNameDescriptShort = tinymce.get("nameDescriptShort").getBody();  
                var content = tinymce.trim(bodyNameDescriptShort.innerText || bodyNameDescriptShort.textContent);  
                if (content.length == 0) {
                    isFormValid = false;
                    qSelect('.name-descriptShort .form-message').innerHTML = "* Vui lòng nhập mô tả ngắn";
                    qSelect('.create-project-page .form-add .name-descriptShort .tox-tinymce').classList.add('invalid');
                } else if (content.length > 250) {
                    isFormValid = false;
                    qSelect('.name-descriptShort .form-message').innerHTML = "* Mô tả ngắn không được quá 250 ký tự !";
                    qSelect('.create-project-page .form-add .name-descriptShort .tox-tinymce').classList.add('invalid');
                }
                var bodyNameDescriptDetail = tinymce.get("nameDescriptDetail").getBody();  
                content = tinymce.trim(bodyNameDescriptDetail.innerText || bodyNameDescriptDetail.textContent);  
                if (content.length == 0) {
                    isFormValid = false;
                    qSelect('.name-descriptDetail .form-message').innerHTML = "* Vui lòng nhập mô tả chi tiết";
                    qSelect('.create-project-page .form-add .name-descriptDetail .tox-tinymce').classList.add('invalid');

                }
            }; 
            if (imgArray.length ===0) {
                if (qSelectAll('.upload__img-box .bnt-close-img').length === 0) {
                    isFormValid = false;
                    qSelect('.create-project-page .upload__img-wrap .image-empty').style.border = '2px dashed #f38282';
                    qSelect('.create-project-page .notification-image').innerText = "* Vui lòng chọn hình ảnh"
                }
            }
            qSelectAll('.code-member').forEach((valueItemBox,indexBox) => {
                qSelectAll('.code-member').forEach((valueItem,index) => {
                    if (indexBox!=index && valueItemBox.value.trim().toLowerCase() == valueItem.value.trim().toLowerCase()) {
                        isFormValid = false;
                        valueItem.classList.add('invalid');
                        qSelect('.student .form-message').innerText = "* Mã thành viên không được trùng nhau";
                    }
                })
            })
            if ($('#upload_document').val() =="") {
                $(".upload_document .form-message").html("Bạn chưa chọn file nào !");
                isFormValid = false;
            }

            options.membersRequired.forEach(classItem => {
                qSelectAll(classItem).forEach(valueItem => {
                    if (valueItem.value.trim() === '') {
                        isFormValid = false;
                        valueItem.classList.add('invalid');
                        qSelect('.student .form-message').innerText = "* Vui lòng nhập đầy đủ thông tin thành viên";
                    } 
                    if (classItem==".name-member"&&valueItem.value.trim().length > 40) {
                        isFormValid = false;
                        valueItem.classList.add('invalid');
                        qSelect('.student .form-message').innerText = "Tên thành viên không được quá 40 ký tự"
                    }
                    if (classItem==".code-member"&&valueItem.value.trim().length > 15) {
                        isFormValid = false;
                        valueItem.classList.add('invalid');
                        qSelect('.student .form-message').innerText = "Mã thành viên không được quá 15 ký tự"
                    }
                })
            })
            if (isFormValid) {
                    console.log("gửi form")
                options.onSubmit(true)
            } else {
                options.onSubmit(false)
            }
        }
        options.rules.forEach(rule => {
            if (Array.isArray(selectorRules[rule.selector])) {
                selectorRules[rule.selector].push(rule.test);
                
            } else {
                selectorRules[rule.selector] = [rule.test];
            }
            var inputElement = fromElement.querySelector(rule.selector)
            if (inputElement) {
                inputElement.onblur = () => {
                    validate(inputElement,rule)
                }
                inputElement.oninput = () => {
                    var errorElement = inputElement.parentElement.querySelector('.form-message');
                    inputElement.classList.remove('invalid');
                    errorElement.innerText = '';
                }
            }
        })
        options.membersRequired.forEach(classItem => {
            qSelectAll(classItem).forEach(valueItem => {
                valueItem.onblur = () => {
                    if (valueItem.value.trim() === '') {
                        valueItem.classList.add('invalid');
                        qSelect('.student .form-message').innerText = "Vui lòng nhập đầy đủ thông tin thành viên"
                    } else if (classItem==".name-member"&&valueItem.value.trim().length > 40) {
                        valueItem.classList.add('invalid');
                        qSelect('.student .form-message').innerText = "Tên thành viên không được quá 40 ký tự"
                    } else if (classItem==".code-member"&&valueItem.value.trim().length > 15) {
                        valueItem.classList.add('invalid');
                        qSelect('.student .form-message').innerText = "Mã thành viên không được quá 15 ký tự"
                    } else {
                        valueItem.classList.remove('invalid');
                        qSelect('.student .form-message').innerText = ""
                    }
                }
                valueItem.oninput = () => {
                    if (valueItem.value.trim() !== '') {
                        valueItem.classList.remove('invalid');
                        qSelect('.student .form-message').innerText = ""
                    }
                }
                
            })
        })
        qSelect('#bnt_add_member').onclick = () => {
            setTimeout(function() {
                options.membersRequired.forEach(classItem => {
                    qSelectAll(classItem).forEach(valueItem => {
                        valueItem.onblur = () => {
                            if (valueItem.value.trim() === '') {
                                valueItem.classList.add('invalid');
                                qSelect('.student .form-message').innerText = "Vui lòng nhập đầy đủ thông tin thành viên"
                            } else if (classItem==".name-member"&&valueItem.value.trim().length > 40) {
                                valueItem.classList.add('invalid');
                                qSelect('.student .form-message').innerText = "Tên thành viên không được quá 40 ký tự"
                            } else if (classItem==".code-member"&&valueItem.value.trim().length > 15) {
                                valueItem.classList.add('invalid');
                                qSelect('.student .form-message').innerText = "Mã thành viên không được quá 15 ký tự"
                            } else {
                                console.log(classItem);
                                valueItem.classList.remove('invalid');
                                qSelect('.student .form-message').innerText = ""
                            }
                        }
                        valueItem.oninput = () => {
                            if (valueItem.value.trim() !== '') {
                                valueItem.classList.remove('invalid');
                                qSelect('.student .form-message').innerText = ""
                            }
                        }
                        
                    })
                })
            },1000)
        }
    }

}
Validator.isRequired = function(selector,message) {
    return {
        selector: selector,
        test: function (value) {
            return value.trim() ? undefined : message || "* Vui lòng nhập vào trường này"
        }
    };

}
Validator.isLinkDriver = function(selector,message) {
    return {
        selector: selector,
        test: function (value) {
            var regex = /https:\/\/drive\.google\.com\/file\/d\/(.*?)\/.*?\?usp=sharing/;
            return regex.test(value) ? undefined : message || "* Vui lòng nhập đúng đường link"

        }
    };
}
Validator.isMaxLenght = function(selector,length,message) {
    return {
        selector: selector,
        test: function (value) {
            return value.trim().length < length ? undefined : message || "* Tên dự án quá dài"

        }
    };
}

$('#upload_document').change(
    function (e) {
        var fileExtension = ['docx', 'doc', 'pdf'];
        if (!e.target.files[0]) {
            $(".upload_document .form-message").html("Bạn chưa chọn file nào !");
        } else {
            if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
                $("#upload_document").val('');
                $(".upload_document .form-message").html("Hệ thống chỉ nhận các file .docx, .doc, .pdf");
            } else if(e.target.files[0].size > 52428800) {
                $("#upload_document").val('');
                $(".upload_document .form-message").html("File không được quá 50MB");
            } else {
                $(".upload_document .form-message").html('');
            }
        }
});
$("#show_document_data").click(function (e) { 
    window.open(e.target.getAttribute('data-url-document'), "", "width=500, height=700"); 
});
  var editor_config = {
    path_absolute : "/",
    selector: '.tinymceTextarea',
    relative_urls: false,
    plugins: [
      "advlist autolink lists link image charmap print preview hr anchor pagebreak",
      "searchreplace wordcount visualblocks visualchars code fullscreen",
      "insertdatetime media nonbreaking save table directionality",
      "emoticons template paste textpattern"
    ],
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
    plugins: 'image code',
    branding: false,
    height: 450,
    setup:function(ed) {
        ed.on('change', function(e) {
            if (ed.getContent({format: 'text'}).trim() !== '') {
                ed.contentAreaContainer.parentElement.parentElement.parentElement.parentElement.querySelector('.form-message').innerHTML = ''
                ed.contentAreaContainer.parentElement.parentElement.parentElement.classList.remove('invalid');
            } else {
                ed.contentAreaContainer.parentElement.parentElement.parentElement.parentElement.querySelector('.form-message').innerHTML = '* Không được để trống trường này'
                ed.contentAreaContainer.parentElement.parentElement.parentElement.classList.add('invalid');
            }
        });
    },
    file_picker_callback : function(callback, value, meta) {
      var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
      var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

      var cmsURL = editor_config.path_absolute + 'laravel-filemanager?editor=' + meta.fieldname;
      if (meta.filetype == 'image') {
        cmsURL = cmsURL + "&type=Images";
      } else {
        cmsURL = cmsURL + "&type=Files";
      }
      tinyMCE.activeEditor.windowManager.openUrl({
        url : cmsURL,
        title : 'Filemanager',
        width : x * 0.8,
        height : y * 0.8,
        resizable : "yes",
        close_previous : "no",
        onMessage: (api, message) => {
          callback(message.content);
        }
      });
    }
  };

  tinymce.init(editor_config);
  tinymce.init({
    selector: '#nameDescriptShort',
    plugins: ['paste'],
    branding: false,
    max_chars: 250, // max. allowed chars

    setup: function (ed) {                              
        var allowedKeys = [8, 13, 16, 17, 18, 20, 33, 34, 35, 36, 37, 38, 39, 40, 46];
        ed.on('keydown', function (e) {
            if (allowedKeys.indexOf(e.keyCode) != -1) return true;
            if (tinymce_getContentLength() + 1 > this.settings.max_chars) {
                e.preventDefault();
                e.stopPropagation();
                ed.contentAreaContainer.parentElement.parentElement.parentElement.parentElement.querySelector('.form-message').innerHTML = '* Không đượt nhập quá 250 ký tự !';
                ed.contentAreaContainer.parentElement.parentElement.parentElement.classList.add('invalid');
                return false;
            }
            ed.contentAreaContainer.parentElement.parentElement.parentElement.parentElement.querySelector('.form-message').innerHTML = '';
            ed.contentAreaContainer.parentElement.parentElement.parentElement.classList.remove('invalid');
            return true;
        });
        ed.on('keyup', function (e) {
            tinymce_updateCharCounter(this, tinymce_getContentLength());
        });
        ed.on('change', function(e) {
            if (ed.getContent({format: 'text'}).trim() !== '') {
                ed.contentAreaContainer.parentElement.parentElement.parentElement.parentElement.querySelector('.form-message').innerHTML = ''
                ed.contentAreaContainer.parentElement.parentElement.parentElement.classList.remove('invalid');
            } else {
                ed.contentAreaContainer.parentElement.parentElement.parentElement.parentElement.querySelector('.form-message').innerHTML = '* Không được để trống trường này'
                ed.contentAreaContainer.parentElement.parentElement.parentElement.classList.add('invalid');
            }
        });                             
    },
    init_instance_callback: function () { // initialize counter div
        $('#' + this.id).prev().append('<div class="char_count" style="text-align:right"></div>');
        tinymce_updateCharCounter(this, tinymce_getContentLength());
    }
});

function tinymce_updateCharCounter(el, len) {
    $('#' + el.id).prev().find('.char_count').text(len + '/' + el.settings.max_chars);
}

function tinymce_getContentLength() {
    return tinymce.get(tinymce.activeEditor.id).contentDocument.body.innerText.length;
}