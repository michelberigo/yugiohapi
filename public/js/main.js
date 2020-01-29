$(document).ready(function() {
    $('.hide-card-type').hide();

    //$('#archetype').select2();

    $('form[method="get"]').submit(function(){
        $(this).find(':input').each(function() {
            var inp = $(this);
            if (!inp.val()) {
                inp.remove();
            }
        });
    });

    $('select[id=card-type]').change(function() {
        if ($(this).val() != '') {
            $('.hide-card-type').show();
        }
        else {
            $('.hide-card-type').hide();
        }

        var url1 = '/getCardSpecificTypes/' + $(this).val();
        var url2 = '/getTypes/' + $(this).val();

        $.get(url1, function(data) {
            var select = $('form select[name=type]');

            select.empty();

            select.append("<option value=''>Selecionar</option>");

            $.each(data,function(key, value) {
                select.append("<option value='" + value.type + "'>" + value.type + "</option>");
            });
        });

        $.get(url2, function(data) {
            var select = $('form select[name=race]');

            select.empty();

            select.append("<option value=''>Selecionar</option>");


            $.each(data,function(key, value) {
                select.append("<option value='" + value.type + "'>" + value.type + "</option>");
            });
        });
    });
});