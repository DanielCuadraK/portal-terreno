function showAlert(containerId, alertType, message, timeActive) {
    $("#" + containerId).html('<div class=" text-center alert alert-' + alertType + '" id="alert' + containerId + '">' + 
      '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' + message + '</div>');
    $("#alert" + containerId).alert();
    window.setTimeout(function () { $("#alert" + containerId).fadeTo(500, 0).slideUp(500, function(){ $(this).remove(); });}, timeActive);
}

function validarCampo(valor){
if(valor != "" && valor !== null)
    return true;
else
    return false;
}