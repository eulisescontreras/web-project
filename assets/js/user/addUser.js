$("#rols").change(function(){
    
    if($("#rols").find('option:selected').val() != "" && $("#table-modal tbody").html().indexOf($("#rols").find('option:selected').val()) == -1){
        $("#table-modal tbody").html($("#table-modal tbody").html()+'<tr><td style="color:white;">'+$("#rols").find('option:selected').val()+'</td></tr>'); 
        rols[cantRols]=$("#rols").find('option:selected').val();
        cantRols++;
    }
    else
        notyf.alert('Error debe seleccionar un rol o ya se encuentra en la lista.');

});