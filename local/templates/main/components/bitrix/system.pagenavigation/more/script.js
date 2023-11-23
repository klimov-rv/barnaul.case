$(document).ready(function(){

    $(document).on('click', '.load-more-items', function(){
        var targetContainer = $('.items-list'),
            url =  $('.load-more-items').attr('data-url');
        if (url !== undefined) {
            $.ajax({
                type: 'GET',
                url: url,
                dataType: 'html',
                success: function(data){
                    //$('.load-more-items').remove();
                    var elements = $(data).find('.items-list .item'),
                        paginationUrl = $(data).find('.load-more-items').data('url');
                    targetContainer.append(elements);
                    if(paginationUrl)
                        $('.load-more-items').attr('data-url', paginationUrl);
                    else
                        $('.load-more-items').hide();
                }
            });
        }
    });
});
