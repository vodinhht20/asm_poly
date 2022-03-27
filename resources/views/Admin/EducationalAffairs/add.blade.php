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
					Thêm Giáo Vụ
				</h3>
			</div>
		</div>
	</div>

	<!--begin::Form-->
	<form class="m-form m-form--fit m-form--label-align-right" action="" method="POST" enctype="multipart/form-data">
        @csrf
		<div class="m-portlet__body">
			@if(session()->has('error'))
				<div class="alert alert-danger">
				{{ session()->get('error') }}
				</div>
			@endif
				
			<div class="form-group1 m-form__group">
                <div class="form-group">
                    <label for="id">Cán Bộ</label>
					<br>
					<input type="text" style="height: 40.3px ;" name="name" class="@error('name') is-invalid @enderror" placeholder="nhập tên, VD: hoangvlh">
					<input type="text" style="height: 40.3px" disabled value="@fpt.edu.vn">
					@error('name')
						<div class="alert text-danger">{{ $message }}</div>
					@enderror
                </div>
			</div>
			<div class="form-group1 m-form__group">
                <div class="form-group">
					<label for="major_id">Cơ Sở</label>
                    <select name="campus_id" id="campus_id" class="form-control">
                        @foreach ($campus as $cp)
                           <option  value="{{$cp->id}}">{{$cp->name}}</option>
                        @endforeach
                    </select>
                </div>
			</div>
			
		</div>
		<div class="m-portlet__foot m-portlet__foot--fit">
			<div class="m-form__actions">
				<button type="submit" class="btn-add btn btn-primary" id="form-upload">
                    <i class="fas fa-save"></i>
                    Thêm Giáo Vụ
                </button>
			</div>
		</div>
	</form>
	

	<!--end::Form-->
</div>

        
@endsection