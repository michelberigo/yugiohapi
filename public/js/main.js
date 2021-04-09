$(document).ready(function() {
    if (localStorage.getItem('theme') == 'dark') {
        $('#dark-mode').prop('checked', true);

        definirTema(true);
    } else {
        $('#dark-mode').prop('checked', false);

        definirTema(false);
    }

    $('#dark-mode').on('change', function (event) {
        let checked = $(this).is(':checked');
        
        if (checked) {
            localStorage.setItem('theme', 'dark');

            definirTema(true);
        } else {
            localStorage.setItem('theme', 'light');

            definirTema(false);
        }
    });

    function definirTema(temaEscuro) {
        if (temaEscuro) {
            $('.custom-switch').find(".fa-sun").removeClass('fa-sun').addClass('fa-moon');
            $('body').addClass('dark-theme');
        } else {
            $('.custom-switch').find($(".fa-moon")).removeClass('fa-moon').addClass('fa-sun');
            $('body').removeClass('dark-theme');
        }
    }
});