
if ($('.iso-filter').length > 0) {
    $(function () {
        // Найти все элементы с классом "day" внутри элемента "days"
        const days = document.querySelectorAll('.days .day');

        // Создаем пустой фрагмент для добавления кнопок фильтра
        const fragment = document.createDocumentFragment();

        // Перебираем все найденные элементы "day" и создаем соответствующие кнопки фильтра
        days.forEach(day => {
            // Проверяем, содержит ли класс "day" дополнительный класс "event" и отсекаем смежные месяцы по классу "adjacent-month"
            if (day.classList.contains('event') && !day.classList.contains('adjacent-month')) {
                // Получаем дату из класса элемента "day"
                day.classList.forEach(function (сlass) {
                    if (сlass.startsWith("calendar-day-")) {

                        const dateArray = сlass.split('-').slice(2); // Получаем массив ['2023', '11', '09']
                        const date = dateArray.join('-'); // Преобразуем массив в строку формата: "2023-11-09"  
                        console.log(date);
                        // Создаем новый элемент для кнопки фильтра
                        const filterButton = document.createElement('div');
                        filterButton.classList.add('iso-filter__btn', 'iso-filter__btn_date', `iso-filter__btn_date${date}`);
                        filterButton.setAttribute('data-filter', `event-${date}`);
                        filterButton.innerHTML = `<div class="iso-filter-title">Фильтр по дате ${date}</div>`;

                        // Добавляем созданный элемент во временный фрагмент
                        fragment.appendChild(filterButton);

                        day.addEventListener('click', e => {
                            const eventButton = document.querySelector(`.iso-filter .iso-filter__btn_date${date}`);
                            if (eventButton) {
                                eventButton.click();
                            }
                        });
                    }
                });
            }
        });

        const isoFilter = document.querySelector('.iso-filter');

        // Вставляем созданные кнопки фильтра в ".iso-filter"
        isoFilter.appendChild(fragment);

        var $types_filter = $('.event-list');

        // filter isotope
        $types_filter.isotope({
            itemSelector: '.event-list__item',
        });
        var $filters = $('.iso-filter').on('click', '.iso-filter__btn', function () {
            var filterAttr = $(this).attr('data-filter');
            $types_filter.isotope({
                filter: '.' + filterAttr,
            });
            $('.iso-filter__btn').removeClass('is-checked');
            $(this).addClass('is-checked');
        });

        // trigger destroy iso on ajax load
        $(window).on('before-ajax-load-trigger', function () {
            $types_filter.isotope('destroy');
        });

    });
}

