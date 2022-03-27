@extends('admin.layouts.main')
@section('title')
    <title>Chuyên Ngành</title>
@endsection
@section('content')
<div class="container">
    <div class="card card-custom gutter-b">
      <div class="card-header flex-wrap py-3">
        <div class="search">
          @role('admin')
            <a href="{{route('chuyen-nganh/add')}}" class="btn btn-outline-brand m-btn m-btn--custom m-btn--icon m-btn--pill m-btn--air" @popper(Thêm Mới)>
              <span>
                <i class="la la-plus"></i>
                <span>Add</span>
              </span>
            </a>
          @endrole
          <div class="m-input-icon m-input-icon--left m-input-icon--right form-search">
            <form action="" method="GET" >
              <div class="input-group m-input-group m-input-group--pill">
              <input type="text" name="search_value" id="search_value" class="form-control m-input" placeholder="search..." aria-describedby="basic-addon1">
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
          @if (session()->has('fail_message'))
              @php
                  $failMsgArr = explode("|", session()->get('fail_message'));
              @endphp
              @foreach ($failMsgArr as $fMsg)
                <div class="alert alert-danger">
                    {{ $fMsg }}
                </div>
              @endforeach
              
          @endif
          <thead>
            <tr role="row">
              <th class="sorting sorting_desc" tabindex="0" aria-controls="kt_datatable" rowspan="1" colspan="1"  >ID</th>
              <th class="sorting" tabindex="0" aria-controls="kt_datatable" rowspan="1" colspan="1" >Tên Chuyên Ngành</th>
              <th class="sorting" tabindex="0" aria-controls="kt_datatable" rowspan="1" colspan="1" >Mã Chuyên Ngành</th>
              <th class="sorting" tabindex="0" aria-controls="kt_datatable" rowspan="1" colspan="1" >Trưởng Bộ Môn</th>
              <th class="sorting" rowspan="1" colspan="1" style="text-align: center"  aria-label="Actions">Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($major as $maj)
            
                <tr class="odd">
                  <td >{{$maj->id}}</td>
                  <td>{{$maj->name}}</td>
                  <td>{{$maj->code}}</td>
                  <td>
                      @if ($auth->hasRole('admin'))
                        @if(isset($maj->head_teachers ) )
                          @foreach ($maj->head_teachers as $ht)
                              <p>{{$ht->name}} - {{$ht->user_campus->name}}</p>
                          @endforeach
                        @endif
                      @else
                        @foreach ($teacher as $t)
                          @if ($t->major_id==$maj->id && $t->campus_id==Auth::user()->campus_id)
                              @foreach ($user as $u)
                                  @if ($u->id==$t->teacher)
                                      {{$u->name}}
                                  @endif
                              @endforeach
                          @endif  
                        @endforeach
                      @endif
                  </td>
                  <td style="text-align: center" >
                   
                    <a 
                  @if ($auth->hasRole('admin'))
                    href="{{ route('chuyen-nganh/admin-edit', ['id'=>$maj->id]) }}"
                  @else
                    href="{{ route('chuyen-nganh/edit', ['id'=>$maj->id]) }}"
                  @endif class="btn btn-primary " @popper(Chỉnh Sửa)><i class="fa	fa-edit"></i></a>
                    @role('admin')<a onclick="return confirm('Bạn Có Muốn Xóa Bộ Môn Này Không??')" href="{{route('chuyen-nganh/del',['id'=>$maj->id])}}" class="btn btn-danger" @popper(Xóa)><i class="fa fa-trash-alt"></i></a>@endrole
                </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12 col-md-7 dataTables_pager">
        <div  class=" dataTables_pager">
          
          {!!$major->links()!!}
        
      </div>
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