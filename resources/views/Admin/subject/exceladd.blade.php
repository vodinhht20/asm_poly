@extends('admin.layouts.main')
@section('title')
    <Title>Thêm Môn Học-Excel</Title>
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
					Thêm Môn Học Bằng Excel
				</h3>
			</div>
		</div>
	</div>

	<!--begin::Form-->
	<form class="m-form m-form--fit m-form--label-align-right" action="" method="" enctype="multipart/form-data">
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
			<div class="form-group m-form__group">
				<label for="exampleInputEmail1">File Browser</label>
				<div></div>
				<div class="custom-file">
					@csrf
					<input type="file" class="custom-file-input @error('file') is-invalid @enderror" name="file" id="customFile"   >
					<label class="custom-file-label" for="">Choose file</label>
					<input hidden  type="text" name="created_by" id="" value="{{Auth::user()->id}}">
					<input hidden type="text" name="campus_id" id="" value="{{Auth::user()->campus_id}}">
				</div>
			</div>
			@error('file')
				<div class="alert text-danger">{{ $message }}</div>
			@enderror
		</div>
		<div class="m-portlet__foot m-portlet__foot--fit">
			<div class="m-form__actions">
				<button  class="btn btn-primary">Submit</button>
				<button type="reset" class="btn btn-secondary">Cancel</button>
			</div>
		</div>
	</form>
	

	<!--end::Form-->
</div>

@endsection