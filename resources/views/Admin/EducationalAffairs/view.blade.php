@extends('admin.layouts.main')
@section('content')
<div class="container">
  
</div>

<div class="container">
  <div class="card card-custom gutter-b">
    <div class="card-header flex-wrap py-3">
      <div class="search">
        <div> 
         <a href="{{route('giao-vu/add')}}" class="btn btn-outline-brand m-btn m-btn--custom m-btn--icon m-btn--pill m-btn--air">
           <span>
             <i class="la la-plus"></i>
             <span>Add</span>
           </span>
         </a>
        </div>
        
      </div>
    </div>
    <div class="card-body">
      <!--begin: Datatable-->
      <div id="kt_datatable_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer"><div class="row"><div class="col-sm-12"><table class="table table-bordered table-checkable dataTable no-footer dtr-inline collapsed" id="kt_datatable" role="grid" aria-describedby="kt_datatable_info" style="width: 1234px;">
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
        <thead>
          <tr role="row">
            <th class="sorting sorting_desc" tabindex="0" aria-controls="kt_datatable" rowspan="1" colspan="1"  >ID</th>
            <th class="sorting" tabindex="0" aria-controls="kt_datatable" rowspan="1" colspan="1" >Tên</th>
            <th class="sorting" tabindex="0" aria-controls="kt_datatable" rowspan="1" colspan="1" >Email</th>
            <th class="sorting" tabindex="0" aria-controls="kt_datatable" rowspan="1" colspan="1" >Avatar</th>
            <th class="sorting" tabindex="0" aria-controls="kt_datatable" rowspan="1" colspan="1" >Cơ Sở</th>
            <th class="sorting" rowspan="1" colspan="1" style="text-align: center"  aria-label="Actions">Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($user as $u)
            <tr class="odd">
              <td >{{$u->id}}</td>
              <td>{{$u->name}}</td>
              <td>{{$u->email}}</td>
              <td><img src="{{$u->avatar}}" alt=""></td>
              <td>{{$u->user_campus->name}}</td>
                  <td style="text-align: center" ><a href="{{route('giao-vu/edit', ['id'=>$u->id])}}" class="btn btn-primary " @popper(Chỉnh Sửa)><i class="fa	fa-edit"></i></a>  
                                                  <a href="{{route('giao-vu/disable',['id'=>$u->id])}}" class="btn btn-danger " @popper(Hủy Quyền) ><i class="fa fa-ban"></i></a></td>
  
            </tr>
              
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
  
  </div>
      <!--end: Datatable-->
    </div>
  </div>

</div>
<!------------------------------------->
<style>

   .search{
   display: flex;
   justify-content: space-between;
   align-items: center;
 }
 .search .form-search{
   width: 40%;
 }
 @media (max-width: 1120px){
   .detail-body .grid{
      display: block;
  }
  .content-detail{
    margin: 50px 0 0 0 !important;
    display: grid;
    grid-template-columns: repeat(2,1fr);
  }
  
  @media (max-width: 570px) {
   .content-detail{
    margin: 30px 0 0 0 !important;
    display: block;
  }
  }
 }
</style>
@endsection
