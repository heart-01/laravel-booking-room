function fetch_data(page, sort_type, sort_by, query){
    var result1;
    var result2;
    $.when(
        $.ajax({
            url: config.routes.fetch_data,
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: { page:page, sorttype:sort_type, sortby:sort_by, query:query },
            success:function(result){
                result1 = result;
                //console.log(result);
            }
        }),

        $.ajax({
            url: config.routes.pagination_link,
            type: 'POST',
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {page:page, sorttype:sort_type, sortby:sort_by, query:query },
            success:function(result){
                result2 = result;
                //console.log(result);
            }
        })

    ).then(function() {
        $('tbody').html('');
        $('tbody').html(result1);
        $('#pagination-link').html('');
        $('#pagination-link').html(result2);
    });
}

$(document).on('keyup', '#serach', function(){
    var query = $('#serach').val();
    var column_name = $('#hidden_column_name').val();
    var sort_type = $('#hidden_sort_type').val();
    $('#hidden_page').val(1);
    var page = $('#hidden_page').val();
    fetch_data(page, sort_type, column_name, query);
});

$(document).on('click', '.sorting', function(){
    var column_name = $(this).data('column_name');
    var order_type = $(this).data('sorting_type');
    var reverse_order = '';
    if(order_type == 'asc'){
        $(this).data('sorting_type', 'desc');
        reverse_order = 'desc';
        $('#'+column_name+'_icon').html('<i class="fas fa-arrow-up"></i>');
    }
    if(order_type == 'desc'){
    $(this).data('sorting_type', 'asc');
        reverse_order = 'asc';
        $('#'+column_name+'_icon').html('<i class="fas fa-arrow-down"></i>');
    }
    $('#hidden_column_name').val(column_name);
    $('#hidden_sort_type').val(reverse_order);
    var page = $('#hidden_page').val();
    var query = $('#serach').val();
    //alert(page + reverse_order + column_name + query);
    fetch_data(page, reverse_order, column_name, query);
});

$(document).on('click', '.pagination a', function(event){
    event.preventDefault();
    var page = $(this).attr('href').split('page=')[1];
    $('#hidden_page').val(page);
    var column_name = $('#hidden_column_name').val();
    var sort_type = $('#hidden_sort_type').val();

    var query = $('#serach').val();

    $('li').removeClass('active');
    $(this).parent().addClass('active');
    //alert(page + sort_type + column_name + query);
    fetch_data(page, sort_type, column_name, query);
});