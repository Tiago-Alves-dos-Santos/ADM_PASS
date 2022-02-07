/**
 * Função para mostrar toast
 * @param {*} titulo 
 * @param {*} information 
 * @param {*} opcao 
 * @param {*} tempo 
 */
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

function showQuestion(titulo, information, callback) { 
    $.confirm({
        title: titulo,
        content: information,
        type: 'dark',
        typeAnimated: true,
        icon: 'fas fa-question-circle',
        buttons: {
            SIM: {
                text: 'SIM',
                action: callback
            },
            NAO: {
                text: 'NÃO',
                btnClass: 'btn-dark',
                action: function(){
                }
            }
        }
    });
 }