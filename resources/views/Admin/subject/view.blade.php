@extends('admin.layouts.main')
@section('title')
    <title>Môn Học</title>
@endsection
@section('content')

<div class="container">
    <div class="card card-custom gutter-b">
      <div class="card-header flex-wrap py-3">
        <div class="card-title">
         <h3>Môn Học</h3>
        </div>
          <div class="search">
            <div>
             
             <a href="{{route('mon-hoc/add')}}" class="btn btn-outline-brand m-btn m-btn--custom m-btn--icon m-btn--pill m-btn--air" @popper(Thêm Mới)>
               <span>
                 <i class="la la-plus"></i>
                 <span>Add</span>
               </span>
             </a>
             <a href="{{route('mon-hoc/excel-add')}}" class="btn btn-outline-brand m-btn m-btn--custom m-btn--icon m-btn--pill m-btn--air" @popper(Thêm Mới Bằng Excel)>
              <span>
                <i class="la la-plus"></i>
                <span>Excel</span>
              </span>
            </a>
            </div>
           <div class="m-input-icon m-input-icon--right form-search">
              <form action="" method="get">
                <div class="input-group m-input-group m-input-group--pill">
                  <input type="text" name="search_value" id="search_value" value="{{$searchValue}}" class="form-control m-input" placeholder="search..." aria-describedby="basic-addon1">
                  <div class="input-group-append"><button class="input-group-text btn btn-outline-metal m-btn m-btn--custom m-btn--icon m-btn--outline-2x m-btn--pill m-btn--air" id="basic-addon1"><i class="flaticon-search-magnifier-interface-symbol"></i></button></div>
                </div>
              </form>        

             

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
              <th class="sorting" tabindex="0" aria-controls="kt_datatable" rowspan="1" colspan="1" >Tên Môn Học</th>
              <th class="sorting" tabindex="0" aria-controls="kt_datatable" rowspan="1" colspan="1" >Mã Môn Học</th>
              <th class="sorting" tabindex="0" aria-controls="kt_datatable" rowspan="1" colspan="1" >Ngành Học</th>
              <th class="sorting" rowspan="1" colspan="1" style="text-align: center"  aria-label="Actions">Actions</th>
            </tr>
          </thead>
          <tbody id="list-content">
            @foreach ($subject as $s)
            
                <tr class="odd">
                  <td >{{$s->id}}</td>
                  <td>{{$s->name}}</td>
                  <td>{{$s->code}}</td>
                  <td>{{$s->major_obj->name}}</td>
                  <td style="text-align: center" ><a href="{{route('mon-hoc/edit',['id' => $s->id])}}" class="btn btn-primary " @popper(Chỉnh Sửa)><i class="fa	fa-edit"></i></a> 
                                                  @role('admin')  <a onclick="return confirm('Bạn Có Muốn Xóa Môn Học Này Không??')" href="{{route('mon-hoc/del',['id'=>$s->id])}}" class="btn btn-danger" @popper(Xóa)><i class="fa fa-trash-alt"></i></a></td> @endrole
                      </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
    
      <div  class=" dataTables_pager">
          
            {!!$subject->links()!!}
          
        </div>
      
    </div>
        <!--end: Datatable-->
      </div>
    </div>
  
</div>
<!------------------------------------->
<style>
    @import url('https://fonts.googleapis.com/css2?family=Roboto&display=swap');

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
@section('page-script')
    <script>
      // search ==========================================
 
    </script>
@endsection