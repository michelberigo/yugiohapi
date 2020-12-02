$(document).ready(function() {
    let pendulumMonsterTypeIds = [14, 15, 16, 17, 19, 22, 24];
    let linkMonsterTypeIds = [25];
    let spellTrapTypeIds = [26, 27];

    $('.card-type-display').hide();
    $('.monster-display').hide();

    $('#form_filter select').change(function() {
        let urlParams = window.location.search.substring(1);
        let data = '?' + urlParams + '&' + $('#form_filter').serialize();

        window.location.href = '/' + data;
    });

    $('#card-type').change(function() {
        var url1 = '/getCardSpecificTypes/' + $(this).val();
        var url2 = '/getTypes/' + $(this).val();

        $.ajax({
            url: url1,
            method: 'GET',
            success: function(response) {
                var select = $('#type');

                select.empty();
                select.append("<option value=''>Selecionar</option>");

                response.forEach(function (item) {
                    select.append("<option value='" + item.type + "' data-id='" + item.id + "'>" + item.type + "</option>");
                });
            }
        });

        $.ajax({
            url: url2,
            method: 'GET',
            success: function(response) {
                var select = $('#race');

                select.empty();
                select.append("<option value=''>Selecionar</option>");

                response.forEach(function (item) {
                    select.append("<option value='" + item.type + "'>" + item.type + "</option>");
                });
            }
        });

        if ($(this).val()) {
            $('.card-type-display').show();
        } else {
            $('.card-type-display').hide();
        }

        if ($(this).val() == 1) {
            $('.monster-display').show();
        } else {
            $('.monster-display').hide();
        }
    });

    $('#type').change(function() {
        let id = $(this).find(':selected').data('id');

        if (linkMonsterTypeIds.includes(id)) {
            $('.pendulum-display').hide();
            $('.link-display').show();

            $('#def-display, #level-display').hide();
        } else {
            if (!spellTrapTypeIds.includes(id)) {
                $('#def-display, #level-display').show();
            }

            if (pendulumMonsterTypeIds.includes(id)) {
                $('.pendulum-display').show();
                $('.link-display').hide();
            } else if (id) {
                $('.pendulum-display').hide();
                $('.link-display').hide();
            } else {
                $('.pendulum-display').show();
                $('.link-display').show();
            }
        }
    });

    $('.scroll').infiniteScroll({
        // options
        path: '.pagination__next',
        append: '.card-result',
        status: '.scroller-status',
        hideNav: '.pagination',
    });
});