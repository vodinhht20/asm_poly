<script src="{{asset('frontend')}}/js/jquery.min.js"></script>
<script src="{{asset('frontend')}}/js/app.js"></script>
<script src="{{asset('frontend')}}/js/lodash.min.js"></script>
<script>
    $("#search_header").on("input", _.debounce(function(e) {
        if (e.target.value.trim()!=="") {
            $.ajax({
                type: "GET",
                url: "{{route('ajax-search-product')}}",
                data: {keyword: e.target.value.trim()},
                dataType: "json",
                success: function (response) {
                    $(".box__search").fadeIn();
                    if (response.success) {
                        $('.box__search ul').html(response.products.map(item => {
                            return `<li><a href="{{url("san-pham")}}/${item.token}/view">${item.name}</a></li>`;
                        }));
                    } else {
                        $('.box__search ul').html("<li style='padding: 5px;color: #3a3737;font-size: 14px;'>Không tìm thấy kết quả nào !</li>")
                    }
                    console.log(response)
                }
            });
        } else {
            $('.box__search').fadeOut();
        }
    }, 500));
</script>

