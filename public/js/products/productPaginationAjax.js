$(function() {

    // $('#next-product').click(function() {
    //     $('.pagination li.active').next().addClass('active');
    // })

    // $('#prev-product').click(function() {
    //     $('.pagination li.active').prev().addClass('active');
    // })


    $('.productPagination a').not(".prev,.next").click(function() {
        event.preventDefault();

        $('.pagination li.active').removeClass('active');
        $(this).parent('li').addClass('active');

        var page = $(this).attr('href').split('page=')[1];
        var category = $(this).attr('href').split('/')[2];
        var category = category.split('?')[0];

        // var next = Number(page)+1;
        // var prev = Number(page)-1;
        // if(next > 0) {

        //     $('#next-product').attr('href', '/paginate/'+category+'?page='+next);
        // }
        
        // if(prev >= 0) {
        //     $('#prev-product').attr('href', '/paginate/'+category+'?page='+prev);
        // }
        
        var data = [page, category];
        // console.log(data);
        fetch_data(data);
    })

    // var prev = $("#next-product");
    // var next = $("#prev-product");

    // next.click(function() {
    //     $('.pagination li.active').removeClass('active').next('li').addClass('active');
    // });

    // prev.click(function() {
    //     $('.pagination li.active').removeClass('active').prev().addClass('active');
    // });

    function fetch_data(data) {
        $.ajax({
            type:'GET',
            url: '/paginate/'+data[1]+'?page='+data[0],

            success:function(data) {
                $('#products-list').html(data);
            }
        })
    }
});