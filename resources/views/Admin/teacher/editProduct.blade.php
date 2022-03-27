@extends('admin.layouts.main')
@section('content')
<div class="col-lg-12">

    <!--begin::Portlet-->
    <div class="m-portlet m-portlet--last m-portlet--head-lg m-portlet--responsive-mobile" id="main_portlet">
        <div class="m-portlet__head" style="">
            <div class="m-portlet__head-progress">

                <!-- here can place a progress bar-->
            </div>
            <div class="m-portlet__head-wrapper">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">
                            Dự án bức ảnh thiên nhiên
                        </h3>
                    </div>
                </div>
                <div class="m-portlet__head-tools">
                    <a href="#" class="btn btn-secondary m-btn m-btn--icon m-btn--wide m-btn--md m--margin-right-10">
                        <span>
                            <i class="la la-arrow-left"></i>
                            <span>Quay lại</span>
                        </span>
                    </a>
                    <div class="btn-group">
                        <button type="button" class="btn btn-primary  m-btn m-btn--icon m-btn--wide m-btn--md" data-toggle="modal" data-target="#m_modal_1">
                            <span>
                                <i class="la la-check"></i>
                                <span>Lưu Lại</span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="m-portlet__body">
            <form class="m-form m-form--label-align-left- m-form--state-" id="m_form">

                <!--begin: Form Body -->
                <div class="m-portlet__body">
                    <div class="row">
                        <div class="col-xl-8 offset-xl-2">
                            <div class="m-form__section m-form__section--first">
                                <div class="m-form__heading">
                                    <h3 class="m-form__heading-title">Chỉnh sửa</h3>
                                </div>
                                <div class="form-group m-form__group row">
                                    <label class="col-xl-3 col-lg-3 col-form-label">* Tên dự án:</label>
                                    <div class="col-xl-9 col-lg-9">
                                        <input type="text" name="name" class="form-control m-input" placeholder="" value="Nick Stone">
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <label class="col-xl-3 col-lg-3 col-form-label">* Giảng viên:</label>
                                    <div class="col-xl-9 col-lg-9">
                                        <input type="email" name="email" class="form-control m-input" placeholder="" value="nick.stone@gmail.com">
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <label class="col-xl-3 col-lg-3 col-form-label">* Mã môn:</label>
                                    <div class="col-xl-9 col-lg-9">
                                        <input type="email" name="email" class="form-control m-input" placeholder="" value="nick.stone@gmail.com">
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <label class="col-xl-3 col-lg-3 col-form-label">* Điểm:</label>
                                    <div class="col-xl-9 col-lg-9">
                                        <input type="email" name="email" class="form-control m-input" placeholder="" value="nick.stone@gmail.com">
                                    </div>
                                </div>
                                <div id="m_repeater_1">
                                    <div class="form-group  m-form__group row" id="m_repeater_1">
                                        <label class="col-lg-2 col-form-label">Thành viên:</label>
                                        <div data-repeater-list="" class="col-lg-10">
                                            <div data-repeater-item="" class="form-group m-form__group row align-items-center" style="">
                                                <div class="col-md-4">
                                                    <div class="m-form__group m-form__group--inline">
                                                        <div class="m-form__label">
                                                            <label>Họ & Tên:</label>
                                                        </div>
                                                        <div class="m-form__control">
                                                            <input type="text" class="form-control m-input" placeholder="Enter full name">
                                                        </div>
                                                    </div>
                                                    <div class="d-md-none m--margin-bottom-10"></div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="m-form__group m-form__group--inline">
                                                        <div class="m-form__label">
                                                            <label class="m-label m-label--single">Mã SV:</label>
                                                        </div>
                                                        <div class="m-form__control">
                                                            <input type="text" class="form-control m-input" placeholder="Nhập mã sinh viên">
                                                        </div>
                                                    </div>
                                                    <div class="d-md-none m--margin-bottom-10"></div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div data-repeater-delete="" class="btn-sm btn btn-danger m-btn m-btn--icon m-btn--pill">
                                                        <span>
                                                            <i class="la la-trash-o"></i>
                                                            <span>Delete</span>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="m-form__group form-group row">
                                        <label class="col-lg-2 col-form-label"></label>
                                        <div class="col-lg-4">
                                            <div data-repeater-create="" class="btn btn btn-sm btn-brand m-btn m-btn--icon m-btn--pill m-btn--wide">
                                                <span>
                                                    <i class="la la-plus"></i>
                                                    <span>Add</span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="m-separator m-separator--dashed m-separator--lg"></div>
                            <div class="m-form__section">
                                <div class="m-form__heading">
                                    <h3 class="m-form__heading-title">
                                        Mailing Address
                                        <i data-toggle="m-tooltip" data-width="auto" class="m-form__heading-help-icon flaticon-info" title="" data-original-title="Some help text goes here"></i>
                                    </h3>
                                </div>
                                <div class="form-group m-form__group row">
                                    <label class="col-xl-3 col-lg-3 col-form-label">* Address Line 1:</label>
                                    <div class="col-xl-9 col-lg-9">
                                        <input type="text" name="address1" class="form-control m-input" placeholder="" value="Headquarters 1120 N Street Sacramento 916-654-5266">
                                        <span class="m-form__help">Street address, P.O. box, company name, c/o</span>
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <label class="col-xl-3 col-lg-3 col-form-label">Address Line 2:</label>
                                    <div class="col-xl-9 col-lg-9">
                                        <input type="text" name="address2" class="form-control m-input" placeholder="" value="P.O. Box 942873 Sacramento, CA 94273-0001">
                                        <span class="m-form__help">Appartment, suite, unit, building, floor, etc</span>
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <label class="col-xl-3 col-lg-3 col-form-label">* City:</label>
                                    <div class="col-xl-9 col-lg-9">
                                        <input type="text" name="city" class="form-control m-input" placeholder="" value="Polo Alto">
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <label class="col-xl-3 col-lg-3 col-form-label">* State:</label>
                                    <div class="col-xl-9 col-lg-9">
                                        <input type="text" name="state" class="form-control m-input" placeholder="" value="California">
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <label class="col-xl-3 col-lg-3 col-form-label">* Country:</label>
                                    <div class="col-xl-9 col-lg-9">
                                        <select name="country" class="form-control m-input">
                                            <option value="">Select</option>
                                            
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="m-separator m-separator--dashed m-separator--lg"></div>
                            <div class="m-form__section m-form__section--first">
                                <div class="m-form__heading">
                                    <h3 class="m-form__heading-title">Account Details</h3>
                                </div>
                                <div class="form-group m-form__group row">
                                    <div class="col-lg-12">
                                        <label class="form-control-label">* URL:</label>
                                        <input type="url" name="account_url" class="form-control m-input" placeholder="" value="http://sinortech.vertoffice.com">
                                        <span class="m-form__help">Please enter your preferred URL to your dashboard</span>
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <div class="col-lg-6 m-form__group-sub">
                                        <label class="form-control-label">* Username:</label>
                                        <input type="text" name="account_username" class="form-control m-input" placeholder="" value="nick.stone">
                                        <span class="m-form__help">Your username to login to your dashboard</span>
                                    </div>
                                    <div class="col-lg-6 m-form__group-sub">
                                        <label class="form-control-label">* Password:</label>
                                        <input type="password" name="account_password" class="form-control m-input" placeholder="" value="qwerty">
                                        <span class="m-form__help">Please use letters and at least one number and symbol</span>
                                    </div>
                                </div>
                            </div>
                            <div class="m-separator m-separator--dashed m-separator--lg"></div>
                            <div class="m-form__section">
                                <div class="m-form__heading">
                                    <h3 class="m-form__heading-title">Client Settings</h3>
                                </div>
                                <div class="form-group m-form__group row">
                                    <div class="col-lg-6 m-form__group-sub">
                                        <label class="form-control-label">* User Group:</label>
                                        <div class="m-radio-inline">
                                            <label class="m-radio m-radio--solid m-radio--brand">
                                                <input type="radio" name="account_group" checked="" value="2"> Sales Person
                                                <span></span>
                                            </label>
                                            <label class="m-radio m-radio--solid m-radio--brand">
                                                <input type="radio" name="account_group" value="2"> Customer
                                                <span></span>
                                            </label>
                                        </div>
                                        <span class="m-form__help">Please select user group</span>
                                    </div>
                                    <div class="col-lg-6 m-form__group-sub">
                                        <label class="form-control-label">* Communications:</label>
                                        <div class="m-checkbox-inline">
                                            <label class="m-checkbox m-checkbox--solid m-checkbox--brand">
                                                <input type="checkbox" name="account_communication[]" checked="" value="email"> Email
                                                <span></span>
                                            </label>
                                            <label class="m-checkbox m-checkbox--solid  m-checkbox--brand">
                                                <input type="checkbox" name="account_communication[]" value="sms"> SMS
                                                <span></span>
                                            </label>
                                            <label class="m-checkbox m-checkbox--solid  m-checkbox--brand">
                                                <input type="checkbox" name="account_communication[]" value="phone"> Phone
                                                <span></span>
                                            </label>
                                        </div>
                                        <span class="m-form__help">Please select user communication options</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!--end::Portlet-->
</div>
@endsection
@section('list-product')
<li class="m-menu__item  m-menu__item--active" aria-haspopup="true"><a href="../../components/icons/flaticon.html" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">Dự án nhóm 1</span></a></li>
<li class="m-menu__item " aria-haspopup="true"><a href="../../components/icons/fontawesome5.html" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">Dự án nhóm 1</span></a></li>
<li class="m-menu__item " aria-haspopup="true"><a href="../../components/icons/lineawesome.html" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">Dự án nhóm 1</span></a></li>
<li class="m-menu__item " aria-haspopup="true"><a href="../../components/icons/socicons.html" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">Dự án nhóm 1</span></a></li>
@endsection
@section('title')
    <title>Preview Dự Án</title>
@endsection