@extends('admin.layouts.main')
@section('content')
<style>
   /*==============================================ADMIN====================================================*/
   .detail-body .grid{
       display: grid;
       grid-template-columns: 65% 35%;
       margin: 20px;
   }
    .slideshow_gallery .mySlides img {
    vertical-align: middle;

  }
  
  /* Position the image container (needed to position the left and right arrows) */
  .slideshow_gallery {
    position: relative;
  }
  
  /* Hide the images by default */
  .slideshow_gallery .mySlides {
    display: none;
  }
  
  /* Add a pointer when hovering over the thumbnail images */
  .slideshow_gallery .cursor {
    cursor: pointer;
  }
  
  /* Next & previous buttons */
  .slideshow_gallery .prev,
  .slideshow_gallery .next {
    cursor: pointer;
    position: absolute;
    top: 40%;
    width: auto;
    padding: 16px;
    margin-top: -50px;
    color: white;
    font-weight: bold;
    font-size: 20px;
    border-radius: 0 3px 3px 0;
    user-select: none;
    -webkit-user-select: none;
  }
  
  /* Position the "next button" to the right */
  .slideshow_gallery .next {
    right: 0;
    border-radius: 3px 0 0 3px;
  }
  
  /* On hover, add a black background color with a little bit see-through */
  .slideshow_gallery .prev:hover,
  .slideshow_gallery .next:hover {
    background-color: rgba(0, 0, 0, 0.8);
  }
  
  .slideshow_gallery .img-small {
    display: flex;
    margin: 10px 0;
  }
  
  /* Six columns side by side */
  .slideshow_gallery .img-small .column{
    display: flex;
    width: 40%;
    margin: 0 5px;
  }
  
  /* Add a transparency effect for thumnbail images */
  .slideshow_gallery .demo {
    opacity: 0.6;
  }
  
  .slideshow_gallery .active,
  .slideshow_gallery .demo:hover {
    opacity: 1;
  }
  .content-detail{
      margin: 0 0 0 30px;
      font-family: sans-serif;
  }
  .content-detail-item {
    margin: 4px 0;
    padding: 4px 0;
  }
  .content-detail .name-member h5{
    color: #F26F21;
    font-size: 18px;
    margin: 4px 0;
    padding: 4px 0;
  }
  .description .description-item .title,
  .content-detail-item .title{
    color: #F26F21;
    display: inline-block;
    font-size: 18px;
  }
  
  .content-detail .name-member p{
    font-size: 15px;
    margin: 4px 0;
    padding: 4px 0;
  }
  .description .description-item .text,
  .content-detail-item .text{
      display: inline-block;
      font-size: 15px;
      margin: 0 5px
  }
  .description .description-item .description-link h6{
    font-size: 15px;
    display: inline-block;
    margin: 10px 0;
  }
  .description .description-item .description-link p{
    font-size: 14px;
    color: #F26F21;
    display: inline-block;
    margin: 10px 0;
  }
  .description .description-item>p{
    font-size: 14px;
  }
  .description{
    margin: 20px;
    font-family: sans-serif;
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
<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#m_modal_4">Launch Modal</button>
    <!--begin::Modal-->
    <div class="modal fade" id="m_modal_4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="padding-right: 17px">
        <div class="modal-dialog modal-lg" role="document" >
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <div class="detail-body">
              <div class="grid">
                <div class="slideshow_gallery">
                    
                    
                    <div class="mySlides">
                    
                    <img src="https://firebasestorage.googleapis.com/v0/b/shop-11594.appspot.com/o/images%2Fblog7-1170x650.jpg?alt=media&token=d842787c-4a58-438f-903c-daf5e222821b" style="width:100%">
                    </div>
                
                    <div class="mySlides">
                    
                    <img src="https://firebasestorage.googleapis.com/v0/b/shop-11594.appspot.com/o/images%2Fblog4-1170x650.jpg?alt=media&token=ea3d250d-887f-4cd4-bda7-90b0f95bc60d" style="width:100%">
                    </div>
                    
                    <div class="mySlides">
                    
                    <img src="https://firebasestorage.googleapis.com/v0/b/shop-11594.appspot.com/o/images%2Fblog5-1170x650.jpg?alt=media&token=f64269af-d073-4645-8e42-9780bd35d730" style="width:100%">
                    </div>
                    
                    <a class="prev" onclick="plusSlides(-1)">❮</a>
                    <a class="next" onclick="plusSlides(1)">❯</a>
                
                    {{-- <div class="caption-container">
                    <p id="caption"></p>
                    </div> --}}
                
                    <div class="img-small">
                        <div class="column">
                            <img class="demo cursor" src="https://firebasestorage.googleapis.com/v0/b/shop-11594.appspot.com/o/images%2Fblog7-1170x650.jpg?alt=media&token=d842787c-4a58-438f-903c-daf5e222821b" style="width:100%" onclick="currentSlide(1)" alt="The Woods">
                        </div>
                        <div class="column">
                            <img class="demo cursor" src="https://firebasestorage.googleapis.com/v0/b/shop-11594.appspot.com/o/images%2Fblog4-1170x650.jpg?alt=media&token=ea3d250d-887f-4cd4-bda7-90b0f95bc60d" style="width:100%" onclick="currentSlide(2)" alt="Cinque Terre">
                        </div>
                        <div class="column">
                            <img class="demo cursor" src="https://firebasestorage.googleapis.com/v0/b/shop-11594.appspot.com/o/images%2Fblog5-1170x650.jpg?alt=media&token=f64269af-d073-4645-8e42-9780bd35d730" style="width:100%" onclick="currentSlide(3)" alt="Mountains and fjords">
                        </div>
                        <div class="column">
                          <img class="demo cursor" src="https://firebasestorage.googleapis.com/v0/b/shop-11594.appspot.com/o/images%2Fblog7-1170x650.jpg?alt=media&token=d842787c-4a58-438f-903c-daf5e222821b" style="width:100%" onclick="currentSlide(1)" alt="The Woods">
                      </div>
                      <div class="column">
                          <img class="demo cursor" src="https://firebasestorage.googleapis.com/v0/b/shop-11594.appspot.com/o/images%2Fblog4-1170x650.jpg?alt=media&token=ea3d250d-887f-4cd4-bda7-90b0f95bc60d" style="width:100%" onclick="currentSlide(2)" alt="Cinque Terre">
                      </div>
                      <div class="column">
                          <img class="demo cursor" src="https://firebasestorage.googleapis.com/v0/b/shop-11594.appspot.com/o/images%2Fblog5-1170x650.jpg?alt=media&token=f64269af-d073-4645-8e42-9780bd35d730" style="width:100%" onclick="currentSlide(3)" alt="Mountains and fjords">
                      </div>
                    </div>
                </div>
                <div class="content-detail">
                    <div class="name-member">
                        <h5 class="m-subheader__title title">Tên thành viên</h5>
                        <p class="text">Đỗ Văn Dương -<span style="margin: 0px 5px">PH11568</span></p>
                        <p class="text">Đỗ Văn Dương -<span style="margin: 0px 5px">PH11568</span></p>
                        <p class="text">Đỗ Văn Dương -<span style="margin: 0px 5px">PH11568</span></p>
                        <p class="text">Đỗ Văn Dương -<span style="margin: 0px 5px">PH11568</span></p>
                        <p class="text">Đỗ Văn Dương -<span style="margin: 0px 5px">PH11568</span></p>
                        <p class="text">Đỗ Văn Dương -<span style="margin: 0px 5px">PH11568</span></p>
                        <p class="text">Đỗ Văn Dương -<span style="margin: 0px 5px">PH11568</span></p> 
                    </div>
                    <div>
                    <div class="content-detail-item">
                        <h5 class=" title">Khóa :</h5>
                        <p class="text">15.3.5</p>
                    </div>
                    <div class="content-detail-item">
                        <h5 class=" title">Giảng viên hướng dẫn:</h5>
                        <p class="text">15.3.5</p>
                    </div>
                    <div class="content-detail-item">
                        <h5 class="m-subheader__title title">Chuyên ngành:</h5>
                        <p class="text">15.3.5</p>
                    </div>
                    <div class="content-detail-item">
                        <h5 class="m-subheader__title title">Mã môn học:</h5>
                        <p class="text">15.3.5</p>
                    </div>
                    <div class="content-detail-item">
                      <h5 class="m-subheader__title title">kỳ học:</h5>
                      <p class="text">15.3.5</p>
                  </div>
                </div>
                </div>
              </div>





                <div class="description">
                  
                <div class="description-item">
                  <h5 class="m-subheader__title title">Chi tiết dự án:</h5>
                  <div class="description-link">
                    <h6 class="m-subheader__title ">Link Website:</h6>
                    <p class="text">15.3.5</p>
                  </div>
                  <p >Lorem ipsum dolor sit amet consectetur adipisicing elit. Nisi modi libero dolore iusto est mollitia cumque ducimus maiores corporis assumenda, nulla fugit sit beatae praesentium distinctio, aliquam velit optio quibusdam? Lorem ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis magnam assumenda soluta obcaecati laborum libero optio quae sit exercitationem deserunt. 
                    Dicta amet cum nostrum vel maiores laudantium nesciunt, obcaecati id!</p>
                  </div>
                </div>
            </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Send message</button>
                </div>
            </div>
        </div>
    </div>

    <!--end::Modal-->

    <script>
        var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("demo");
  
  if (n > slides.length) {slideIndex = 1}
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " active";
  
}
    </script>
@endsection