@extends('admin.layouts.main')
@section('title')
    <title>Chỉnh Sửa Thông Tin Chuyên Ngành</title>
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
					Chỉnh Sửa Thông Tin Chuyên Ngành
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
                    <label for="name">Tên Chuyên Ngành</label>
                    <input type="text" id="name" @if ($auth->hasRole('admin'))
						
					@else
					disabled
					@endif class="form-control @error('name') is-invalid @enderror" name="name" value="{{$major->name}}" >
					@error('name')
						<div class="alert text-danger">{{ $message }}</div>
					@enderror
                </div>
                <div class="form-group">
                    <label for="code">Mã Chuyên Ngành</label>
                    <input type="text" id="code" @if ($auth->hasRole('admin'))
						
					@else
					disabled
					@endif  class="form-control form-control @error('code') is-invalid @enderror" name="code" value="{{$major->code}}" >
					@error('code')
                            <div class="alert text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="teacher">Trưởng Bộ Môn</label>
                    <br>
					@if ($auth->hasRole('admin'))
					<div class="form-group">
						<label for="name">Thuộc Bộ Môn</label>
						<select name="main_major_id" id="" class="form-control">
							@foreach ($main_major as $mj)
								<option @if($major->main_major_id==$mj->id) selected @endif value="{{$mj->id}}">{{$mj->name}}</option>
							@endforeach
						</select>
					</div>
							@foreach ($campus as $ca)
								<div>
									<label for="">{{$ca->name}}</label>
									<br>
									@php
										$headTeacher = $ca->getHeadTeacherByMajor($major->id);
									@endphp
									<input type="text" style="height: 40.3px ; text-align: center"  name="teacher[{{$ca->id}}]" class="@error('teacher') is-invalid @enderror" 
										value="{{isset($headTeacher) ? Str::replace('@fpt.edu.vn', '', $headTeacher->email) : ""}}"
									
									placeholder="nhập tên, VD: hoangvlh">
									<input type="text" style="height: 40.3px" disabled value="@fpt.edu.vn">
									@error('teacher')
										<div class="alert text-danger">{{ $message }}</div>
									@enderror
								</div>
								<br> 
							@endforeach
					@else
						<input type="text" style="height: 40.3px ; text-align: center"  name="teacher" class="@error('teacher') is-invalid @enderror" value="{{$teacher}}" placeholder="nhập tên, VD: hoangvlh">
						<input type="text" style="height: 40.3px" disabled value="@fpt.edu.vn">
						@error('teacher')
							<div class="alert text-danger">{{ $message }}</div>
						@enderror
					@endif
                </div>
			</div>
			
		</div>
		<div class="m-portlet__foot m-portlet__foot--fit">
			<div class="m-form__actions">
				<button type="submit" class="btn-add btn btn-primary" id="form-upload">
                    <i class="fas fa-save"></i>
                    Cập nhật
                </button>
			</div>
		</div>
	</form>
	

	<!--end::Form-->
</div>

        
@endsection