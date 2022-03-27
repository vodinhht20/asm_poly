@extends('admin.layouts.main')
@section('content')
<div class="container">
  
  <div class="card card-custom gutter-b">
    <div class="card-header flex-wrap py-3">
      <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
          <div class="m-portlet__head-title">
            <span class="m-portlet__head-icon m--hide">
              <i class="la la-gear"></i>
            </span>
            <h3 class="m-portlet__head-text">
              Sản Phẩm Chờ Phê Duyệt
            </h3>
          </div>
        </div>
      </div>
      <div class="search">
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
        <thead>
          <tr role="row">
            <th class="sorting sorting_desc" tabindex="0" aria-controls="kt_datatable" rowspan="1" colspan="1"  >ID</th>
            <th class="sorting" tabindex="0" aria-controls="kt_datatable" rowspan="1" colspan="1" >Tên Dự Án</th>
            <th class="sorting" tabindex="0" aria-controls="kt_datatable" rowspan="1" colspan="1" >Mã Môn Học</th>
            <th class="sorting" tabindex="0" aria-controls="kt_datatable" rowspan="1" colspan="1" >Giảng Viên Hướng Dẫn</th>
            <th class="sorting" tabindex="0" aria-controls="kt_datatable" rowspan="1" colspan="1" >Kỳ Học</th>
            <th class="sorting" rowspan="1" colspan="1" style="text-align: center"  aria-label="Actions">Actions</th>
          </tr>
        </thead>
        <tbody id="list-content">
          @foreach ($products as $prod)
              
            <tr>
              <td >{{$prod->id}}</td>
              <td>{{$prod->name}}</td>
              <td>{{$prod->code_subject}}</td>
              <td>{{$prod->teacher}}</td>
              <td>{{$prod->semester_obj->name}}</td>
              <td style="display: grid-flex; text-align: center">
                <button type="button" data-id="{{$prod->id}}"  class="preview btn btn-info" @popper(Xem Trước)>
                <i class="fa fa-file"></i>
                </button>   
                <a onclick="return confirm('Bạn Có Muốn Phê Duyệt Sản Phẩm Này Không??')" href="{{route('final-preview/accept', ['id' => $prod->id])}}" class="btn btn-primary" @popper(Phê Duyệt)><i class="fa	fa-check"></i></a>  
                <button id="reject_modal" class="reject_modal btn btn-danger" data-id="{{$prod->id}}" data-url="{{route('preview/reject')}}" @popper(Từ Chối)><i class="fa fa-ban"></i></button>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
  <div  class=" dataTables_pager">
          
    {!!$products->links()!!}
  
  </div>
  </div>
      <!--end: Datatable-->
    </div>
  </div>

</div>

 {{--------------------}}
 <div class="modal fade" id="preview_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalSizeLg"  aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h3 class="modal-title" id="preview_title"></h3>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <i aria-hidden="true" class="ki ki-close"></i>
              </button>
          </div>
          <div class="modal-body" id="modal-contenttt">
            <div class="detail-body modal-form">
              <div id="preview_content">

              </div>
             
              <div id="preview_desc"></div>
            </div>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
              
              
          </div>
          
      </div>
  </div>
</div>
{{---------------------}}
<div class="modal fade" id="reason_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="reason_title"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
            @csrf
          <div class="form-group">
            <label for="message-text" class="col-form-label">Lý Do:</label>
            <textarea class="form-control " id="reason_text" name="reason_text" style="height: 200px" required></textarea>
                  <span id="error_msg" class="text text-danger"></span>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="reset" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" data-url="{{route('preview/reject')}}" id="reject_btn" class="reject_btn btn btn-danger">Từ Chối</button>
      </div>
    </div>
  </div>
</div>

{{---------------------}}


<!-- Modal-->

 @endsection
 @section('page-script')
 
<script>

      // search ==============================================
     
     //--------------AJAX---------------------
     let baseurl = '{{url('')}}';
     $(document).ready(function(){
        $('.preview').click(function(){
          const preview_id=$(this).data('id');
          $.ajax({
            headers: { 'X-CSRF-TOKEN': "{{ csrf_token() }}"},
            type: "post",
            url: "{{route('ajaxpreview')}}",
            data: {preview_id: preview_id},
            dataType: "JSON",
            
            success: function (response) {
              let url=baseurl+"/admin/demo/"+preview_id;
              let popup= window.open(url, "_blank","width=1200,height=600,");
              popup.focus();  
                              
              // const result=`
              // <iframe src="${baseurl}/admin/demo/${preview_id}" width="100%" height="600" frameborder="0"></iframe>
              // `;
              // $('#preview_content').html(result);
              // $('#preview_modal').modal('show');
              
               
              
            } 
          });
        })
      })

      //===============================================================
     
      $(document).ready(function(){
        $('.reject_modal').click(function(){
          const url=$(this).attr('data-url');
          const preview_id=$(this).data('id');
          $.ajax({
            method: "get",
            url: url,
            data: {preview_id: preview_id},
            dataType: "JSON",
            success: function (response) {
              console.log(url)
              $('#reason_title').text("Sản Phẩm Bị Từ Chối : "+response.name)
              $('#reason_modal').modal('show');
                    $('#reject_btn').click(function(e){
                        const id=preview_id;
                        const url=$(this).attr('data-url');
                        const reason=$('#reason_text').val();
                        if(reason.trim() ==''){
                          $('#reason_text').addClass('is-invalid')
                          $('#error_msg').text("Lý Do Không Được Bỏ Trống")
                        }
                        else{
                          $.ajax({
                        headers: { 'X-CSRF-TOKEN': "{{ csrf_token() }}"},
                        method: "post",
                        url: url,
                        dataType: "JSON",
                        data: {
                        id:id,
                        reason:$('#reason_text').val(),
                        status:2
                              },
                      beforeSend:function(){
                        $('.loader').removeClass('hide');
                      },
                        success: function (response) {
                          window.location.reload()
                        } 
                      });
                        }
                        
                    })    
              
            } 
          });
        })
      })
      
      //--------------------------GALLERY SLIDER---------------------------------
     
      


      
     
 
</script>

@endsection

