@extends('admin.layouts.main')
@section('title')
    <Title>Chỉnh Sửa Thông Tin Bộ Môn</Title>
@endsection
@section('content')
<div class="m-portlet m-portlet--tab" style="width:100%;">
	<div class="m-portlet__head">
		<div class="m-portlet__head-caption">
			<div class="m-portlet__head-title">
				<span class="m-portlet__head-icon m--hide">
					<i class="la la-gear"></i>
				</span>
				<h3 class="m-portlet__head-text">
					Chỉnh Sửa Thông Tin Bộ Môn
				</h3>
			</div>
		</div>
	</div>

	<!--begin::Form-->
	<form class="m-form m-form--fit m-form--label-align-right" action="" method="POST" enctype="multipart/form-data">
        @csrf
		<div class="m-portlet__body">
			@if(session()->has('message'))
    			<div class="alert alert-success">
        			{{ session()->get('message') }}
    			</div>
			@endif
			@if(session()->has('error'))
    			<div class="alert alert-danger">
        			{{ session()->get('error') }}
    			</div>
			@endif
			<div class="form-group1 m-form__group">
              
				<div class="form-group">
                    <label for="name">Tên Bộ Môn</label>
                    <input type="text" id="name"  class="form-control @error('name') is-invalid @enderror" name="name" value="{{$main_major->name}}" >
                    @error('name')
                        <div class="alert text-danger">{{ $message }}</div>
                    @enderror
                </div>
			</div>
			
		</div>
		<div class="m-portlet__foot m-portlet__foot--fit">
			<div class="m-form__actions">
				<button type="submit" class="btn-add btn btn-primary" id="form-upload">
                    <i class="fas fa-save"></i>
                    Thêm Bộ Môn
                </button>
			</div>
		</div>
	</form>
	

	<!--end::Form-->
</div>


        
@endsection