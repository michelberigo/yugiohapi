$(document).ready(function(){
    $("#search").click(function() {
        var data = $("#filter").serializeArray();

        $.ajax({
            "context": this,
            "url": '/YugiohAPI/public/',
            "method": "GET",
            "data": data
        }).done(function (content) {
            //
        }).fail(function (content) {
            console.log("falhou");
        });
    });
});