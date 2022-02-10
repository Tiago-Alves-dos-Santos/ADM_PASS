$(function(){
    
    //saber qual pagina atual e marcar o link clicado
    let id = $('body').attr('id');
    $('div.link-icon-container a').removeClass('atual-page');
    $('div.link-icon-container').find('a#'+id).addClass('atual-page');
});