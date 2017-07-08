<script>
    var notyf = new Notyf();
    var rols = [];
    var cantRols = 0;
    
    $.ajax({
        method: "POST",
        url:   "<?php echo base_url(); ?>index.php/rol/get_rols",
        dataType: 'json',
        success: function(data){
            $('#rols').html(data);
        }
    });
    
    function limpiar()
    {
      $('#id').val("");
      $('#first_name').val("");
      $('#second_name').val("");
      $('#surname').val("");
      $('#second_surname').val("");
      $('#email').val("");
      $('#username').val("");
      $('#password').val("");
      $('#phone').val("");
      $('#address').val("");
      $("#table-modal tbody").html("");
      rols = [];
      cantRols = 0;
    }
    
    function actualizarTablaUsuario()
    {
        $('#tableUsers').dataTable().fnDestroy();
        tableUsers = $('#tableUsers').dataTable({
              "scrollX": true,
              "ajax":{
                       "url": "<?php echo base_url(); ?>index.php/user/listado_data",
                       "type": 'POST',
                       "error": function (ajaxContext) {
                           notyf.alert('Error inesperado contacte a su proveedor de sistema.');
                        }
                    }, 
              "bDestroy": true,
              columns: [
                    {"data":"username"},
                    {"data":"password"},
                    {"data":"rols"},
                    {"data":"permissions"},
                    {"data":"complete_name"},
                    {"data":"start_date"}
              ]
        });
    }
    
    function validado(personal_data)
    {
        var text = "";
        var names = ["","primer nombre","segundo nombre","primer apellido","segundo apellido"];
        var can_register = true;
        
        for(var i = 1; i < names.length; i++)
        {
            if(!(/^[a-zA-Z]*$/).test(personal_data[i]) || personal_data[i] == "")
            {
                text = "Error "+names[i]+" mal introducido.";
                notyf.alert(text);
                can_register = false;
            }
        }
        
        if(!(/^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/).test(personal_data[5]))
        {
            text = "Error email mal introducido.";
            notyf.alert(text);
            can_register = false;
        }
        
        if(personal_data[8].length < 11 || personal_data[8].length > 11 || personal_data[8] == "")
        {
            text = "Error numero de telefono mal introducido.";
            notyf.alert(text);
            can_register = false;
        }
        
        return can_register;
    }
    
    $("#cancel").click(function(){
      limpiar();   
    });

    $("#addUser").click(function(){
        var personal_data = new Array(10);    
        personal_data[0] = $('#id').val();
        personal_data[1] = $('#first_name').val();
        personal_data[2] = $('#second_name').val();
        personal_data[3] = $('#surname').val();
        personal_data[4] = $('#second_surname').val();
        personal_data[5] = $('#email').val();
        personal_data[6] = $('#username').val();
        personal_data[7] = $('#password').val();
        personal_data[8] = $('#phone').val();
        personal_data[9] = $('#address').val();
        
        if(validado(personal_data))
        {
          $.ajax({
                method: "POST",
                url:   "<?php echo base_url(); ?>index.php/user/addUser",
                dataType: 'json',
                data:{
                    "personal_data"     :personal_data,
                    "rols"              :rols
                },
                success: function(data){
                    switch(data)
                    {
                        case 1:
                            $("#modal-add-user-data").modal('hide');
                            notyf.confirm('Usuario registrado exitosamente!');
                            actualizarTablaUsuario();
                            limpiar();
                            break;
                        case 2:
                            notyf.alert('El usuario ya se encuentra registrado.');
                            break;
                        case 3:
                            notyf.alert('El nombre de usuario ya se encuentra en uso.');
                            break;
                    }
                },
                error: function (ajaxContext) {
                    notyf.alert('Error inesperado contacte a su proveedor de sistema.');
                }
            });
        }
    });
</script>
<script src="/assets/js/user/addUser.js"></script>