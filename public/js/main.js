$(document).ready(function(){
    $("#search").click(function() {
        var data = $('#filter').serializeArray();

        $.each(data, function(i, field){
            console.log(field);
            if (field.value == '') {
                data.splice(i, 1);
            }
            else {
                alert('não null');
            }
        },data);

        $.ajax({
            "context": this,
            "url": '/YugiohAPI/public/',
            "method": "GET",
            "data": data
        }).done(function (content) {
            console.log('tois');
        }).fail(function (content) {
            console.log("falhou");
        });
    });
});