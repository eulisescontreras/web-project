$("#rols").change(function(){
    
    if($("#rols").find('option:selected').val() != "" && $("#table-modal tbody").html().indexOf($("#rols").find('option:selected').val()) == -1){
        
        if($("#rols").find('option:selected').val() == 'Auditor General')
        {   
            $("#table-modal tbody").html('<tr><td id="delete" style="cursor:pointer;"><img width="30px" height="30px" src="/assets/img/delete.png" /></td><td style="color:white;">'+$("#rols").find('option:selected').val()+'</td></tr>');
            rols = [];
            rols[0] = $("#rols").find('option:selected').val();
            cantRols = 1;
        }
        else
        {
            if($("#table-modal tbody").html().indexOf('Auditor General') == -1)
            {
                $("#table-modal tbody").html($("#table-modal tbody").html()+'<tr><td id="delete" style="cursor:pointer;"><img width="30px" height="30px" src="/assets/img/delete.png" /></td><td style="color:white;">'+$("#rols").find('option:selected').val()+'</td></tr>'); 
                rols[cantRols] = $("#rols").find('option:selected').val();
                cantRols++;
            }else
                notyf.alert('El auditor general ya tiene todo los permisos, no necesita de otros roles.');
        }
    }
    else
        notyf.alert('Error debe seleccionar un rol o ya se encuentra en la lista.');

});


$('#modal-add-user-data').on( 'click', 'td', function () {
     if($(this).index() == 0)
     {
        rols.splice($(this).parent().index(),1);
        $(this).closest('tr').remove();
        cantRols--;
     }
});