$(document).ready(function() {
    $('#traduzir_efeito').click(function(event) {
        let language = $(this).data("language");
        let id = $('#cartaId').val();

        let url = 'https://db.ygoprodeck.com/api/v7/cardinfo.php?id=' + id;

        if (language != 'en') {
            url = url + '&language=' + language;
        }

        $.ajax({
            url: url,
            method: 'GET',
            success: function(response) {
                let efeito = response.data[0].desc;
                
                $('#carta_efeito').html(nl2br(efeito));

                ajustarTraducao(language);
            }
        });
    });

    function ajustarTraducao(language) {
        if (language == 'pt') {
            $('#traduzir_efeito').data('language', 'en');
            $('#traduzir_efeito').text('Efeito Original');
        } else {
            $('#traduzir_efeito').data('language', 'pt');
            $('#traduzir_efeito').text('Traduzir Efeito');
        }
    }

    function nl2br(str, is_xhtml) {
        var breakTag = (is_xhtml || typeof is_xhtml === 'undefined') ? '<br/>' : '<br>';

        return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1'+ breakTag +'$2');
    }
});