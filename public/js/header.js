function showToast(titulo, information, opcao = 0,tempo = 5000) {
    let opcoes = ["info","success", "warning","error",""];
    $.toast({
        heading: titulo,
        text: information,
        showHideTransition: 'slide',
        position: 'bottom-right',
        hideAfter: tempo,
        icon: opcoes[opcao]
    })
}