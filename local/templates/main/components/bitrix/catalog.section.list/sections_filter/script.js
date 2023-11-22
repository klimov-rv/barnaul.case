// filter-classic
if ($('.filter-toggle').length > 0) {
    jcf.replaceAll();

    var toggleBtns = document.querySelectorAll('.filter-toggle');

    window.addEventListener('click', e => {
        if (!e.target.closest('.filter-popup')) {

            toggleBtns.forEach((item, idx) => {
                if (!item.contains(e.target)) {
                    item.classList.remove("is-button-active");
                }
            })
        }
    });

    toggleBtns.forEach((item, idx) => {
        item.addEventListener('click', e => {
            e.preventDefault();
            e.target.closest('.filter-toggle').classList.toggle("is-button-active");
        });
    });

    var clickedChbxs = document.querySelectorAll('.filter-checbox-item');

    clickedChbxs.forEach((item, idx) => {
        item.addEventListener('click', e => {
            var thisEl = e.target.closest('.filter-popup');
            var countChecked = thisEl.querySelectorAll('input[type="checkbox"]:checked').length;
            var filterWraper = thisEl.closest('.filter-title');
            var insertCount = filterWraper.querySelector('.filter-count-selected');
            if (countChecked > 0) {
                insertCount.innerHTML = countChecked;
                filterWraper.classList.add('is-active');
            } else {
                insertCount.innerHTML = '';
                filterWraper.classList.remove('is-active');
            }
        });
    });

    var applyBtn = document.querySelectorAll('.filter-apply');

    applyBtn.forEach((item, idx) => {
        item.addEventListener('click', e => {
            var filterWraper = e.target.closest('.filter-title');
            filterWraper.querySelector('.filter-toggle').classList.toggle("is-button-active");
        });
    });
}
