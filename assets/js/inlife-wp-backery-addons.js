(function( $ ) {

    $('.inlife-post-grid-style-1-item').each(function (index , element) {

        $(element).find('.overlay').height($(element).find('.background-block').height()).width($(element).find('.background-block').width());

    });

    $('body').on('click' , '.inlife-post-grid-filter-toggle' , function(e){

        e.preventDefault();
        e.stopImmediatePropagation();

        var data = {
            action: 'filter_posts',
            term: $(this).data('term'),
            post_type: $(this).data('posttype'),
            taxonomy: $(this).data('taxonomy'),
            style: $('.inlife-post-grid.has_filter').data('style'),
            show: $('.inlife-post-grid.has_filter').data('show'),
            buttontext: $('.inlife-post-grid.has_filter').data('buttontext')
        };

        $.post(my_ajax_object.ajax_url , data , function (res) {

            $('.inlife-post-grid.has_filter').html(res);

            setTimeout(function () {
                $('.inlife-post-grid-style-1-item').each(function (index , element) {
                    $(element).find('.overlay').height($(element).find('.background-block').height()).width($(element).find('.background-block').width());
                });
            } , 100);

        });

    });

})( jQuery );