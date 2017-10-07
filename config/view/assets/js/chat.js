$(function() {
    window.inArr = {ja_shoutbox:false};
    $('#ja_shoutbox').submit(function(e) {
        e.preventDefault();
        var url = 'api/enviar';
        var enviar = $.post(url,$(this).serialize());
        $('#ja_shoutbox input[name="mensagem"]').empty().val('').focus();
        enviar.done(function(data) {
            $('#ja_shoutbox #msg').empty().append(data.msg).show('slow',function () {
                setTimeout(function() {
                    $('#ja_shoutbox #msg').empty().hide('slow');
                },1500);
            });
        });
    });
    $('#ja_shoutbox textarea').mouseout(function(){
        window.inArr['ja_shoutbox'] = false;
    });
    $('#ja_shoutbox textarea').mouseover(function(){
        window.inArr['ja_shoutbox'] = true;
    });
    setInterval(function() {
        if (window.inArr['ja_shoutbox'] == false && $('#ja_shoutbox textarea').prop("scrollHeight") > 400) {
            $('#ja_shoutbox textarea').animate({scrollTop:$('#ja_shoutbox textarea').prop("scrollHeight")}, '500');
        }
    },1000);
    setInterval(function() {
        var url = 'api/listar';
        $.get(url,function(data) {
            $('#ja_shoutbox textarea').empty();
            $.each(data.mensagens,function (a,b) {
                $('#ja_shoutbox textarea').append(b.nome + ': '+b.mensagem+"\n");
            });
        });
    },100);
});