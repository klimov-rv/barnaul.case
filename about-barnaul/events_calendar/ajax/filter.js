
if ($('.iso-filter').length > 0) {
    $(function () {

        var $grid = $('.event-list');

        // TODO дестрой события по подгрузке аякса
        var $filters = $('.iso-filter').on('click', '.iso-filter__btn', function () {
            var filterAttr = $(this).attr('data-filter');
            location.hash = 'filter=' + encodeURIComponent(filterAttr);
        });

        var isIsotopeInit = true;

        function getHashFilter() {
            var hash = location.hash;
            // get filter=filterName
            var matches = location.hash.match(/filter=([^&]+)/i);
            var hashFilter = matches && matches[1];
            return hashFilter && decodeURIComponent(hashFilter);
        }

        function removeHash() {
            history.pushState("", document.title, window.location.pathname +
                window.location.search);
        }

        function onHashchange() {
            var hashFilter = getHashFilter();
            // TODO переписать повторяющуюся грязь
            if (hashFilter === '*') {
                $grid.isotope({
                    itemSelector: '.event-list__item',
                    filter: hashFilter
                });
                $filters.find('.is-checked').removeClass('is-checked');
                $filters.find('[data-filter="*"]').addClass('is-checked');
                removeHash();
                return;
            }
            if (!hashFilter && isIsotopeInit) {
                return;
            }
            isIsotopeInit = true;
            // filter isotope
            $grid.isotope({
                itemSelector: '.event-list__item',
                filter: '.' + hashFilter
            });
            // set selected class on button
            if (hashFilter) {
                $filters.find('.is-checked').removeClass('is-checked');
                $filters.find('[data-filter="' + hashFilter + '"]').addClass('is-checked');
            }

            // trigger destroy iso on ajax load
            $(window).on('ajax-load-trigger', function () {
                $grid.isotope('destroy');
                $filters.find('.is-checked').removeClass('is-checked');
                $filters.find('[data-filter="*"]').addClass('is-checked');
                removeHash();
            });

        }

        $(window).on('hashchange', onHashchange);
        // trigger event handler to init Isotope
        onHashchange();

    });
}

