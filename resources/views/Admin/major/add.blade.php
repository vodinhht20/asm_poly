@extends('admin.layouts.main')
@section('title')
    <title>Thêm Chuyên Ngành</title>
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
					Thêm Chuyên Ngành
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
                    <input type="text" id="name"  class="form-control @error('name') is-invalid @enderror" name="name" >
                    @error('name')
                                <div class="alert text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="code">Mã Chuyên Ngành</label>
                    <input type="text" id="code"  class="form-control form-control @error('code') is-invalid @enderror" name="code" >
                    @error('code')
                            <div class="alert text-danger">{{ $message }}</div>
                    @enderror
                </div>
				<div class="form-group">
					<label for="name">Thuộc Bộ Môn</label>
					<select name="main_major_id" id="" class="form-control">
						@foreach ($main_major as $mj)
							<option value="{{$mj->id}}">{{$mj->name}}</option>
						@endforeach
					</select>
				</div>
                <div class="form-group">
                    <label for="teahcer">Trưởng Bộ Môn</label>
                    		{{-- @for ($i = 1; $i < count($campus); $i++)
								<div>
									<label for="">{{$campus[$i]->name}}</label>
									<br>
									<input type="text" style="height: 40.3px ; text-align: center"  name="teacher[{{$i-1}}]" class="" 
									placeholder="nhập tên, VD: hoangvlh">
									<input type="text" style="height: 40.3px" disabled value="@fpt.edu.vn">
								</div>
								<br> 
							@endfor --}}
							@foreach ($campus as $ca)
							<div>
								<label for="">{{$ca->name}}</label>
								<br>
								<input type="text" style="height: 40.3px ; text-align: center"  name="teacher[{{$ca->id}}]" class="" 
								placeholder="nhập tên, VD: hoangvlh">
								<input type="text" style="height: 40.3px" disabled value="@fpt.edu.vn">
							</div>
							<br> 
							@endforeach
                </div>
			</div>
			
		</div>
		<div class="m-portlet__foot m-portlet__foot--fit">
			<div class="m-form__actions">
				<button type="submit" class="btn-add btn btn-primary" id="form-upload">
                    <i class="fas fa-save"></i>
                    Tạo Chuyên Ngành
                </button>
			</div>
		</div>
	</form>
	

	<!--end::Form-->
</div>



        
@endsection