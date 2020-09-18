$(function() {


    $('.searchPagination a').not(".prev,.next").click(function() {
        event.preventDefault();

        $('.pagination li.active').removeClass('active');
        $(this).parent('li').addClass('active');

        var page = $(this).attr('href').split('page=')[1];
        var username = $("#search-username").val();
        
        var data = [page, username];
        console.log(data);
        fetch_search_data(data);
    })

    function fetch_search_data(data) {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:'POST',
            data: {
                'username':data[1],
            },
            url: '/order/searchpaginate?page='+data[0],

            success:function(data) {
                // console.log(data)
                $('#order-search-data').html(data);
            }
        })
    }
});