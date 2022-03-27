@extends('admin.layouts.main')
@section('content')
<div class="m-portlet m-portlet--tab" style="width:100%;">
	<div class="m-portlet__head">
		<div class="m-portlet__head-caption">
			<div class="m-portlet__head-title">
				<span class="m-portlet__head-icon m--hide">
					<i class="la la-gear"></i>
				</span>
				<h3 class="m-portlet__head-text">
					Sửa Thông Tin Môn Học
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
                    <label for="name">Tên Môn</label>
                    <input type="text" id="name"  class="form-control @error('name') is-invalid @enderror" name="name" value="{{$subject->name}}" >
                    @error('name')
                        <div class="alert text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="code">Mã Môn</label>
                    <input type="text" id="code"  class="form-control @error('code') is-invalid @enderror" name="code" value="{{$subject->code}}">
                    @error('code')
                        <div class="alert text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="major_id">Bộ Môn</label>
                    <select name="major_id" id="major_id" class="form-control">
                        @foreach ($major as $m)
                                   <option @if ($m->id==$subject->major_id)
                                       selected
                                   @endif value="{{$m->id}}">{{$m->name}}</option>
                                @endforeach
                    </select>
                    <span class="form-message"></span>
                </div>
			</div>
			
		</div>
		<div class="m-portlet__foot m-portlet__foot--fit">
			<div class="m-form__actions">
				<button type="submit" class="btn-add btn btn-primary" id="form-upload">
                    <i class="fas fa-save"></i>
                    Cập Nhật
                </button>
			</div>
		</div>
	</form>
	

	<!--end::Form-->
</div>

        
@endsection