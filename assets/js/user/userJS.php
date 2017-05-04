<script>
    var notyf = new Notyf();
    var personal_data = [];
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
        

    $("#addUser").click(function(){
      personal_data['id'] = $('#id').val();
      personal_data['first_name'] = $('#first_name').val();
      personal_data['second_name'] = $('#second_name').val();
      personal_data['surname'] = $('#surname').val();
      personal_data['second_surname'] = $('#second_surname').val();
      personal_data['email'] = $('#email').val();
      personal_data['username'] = $('#username').val();
      personal_data['password'] = $('#password').val();
      personal_data['phone'] = $('#phone').val();
      personal_data['address'] = $('#address').val();

      $.ajax({
            method: "POST",
            url:   "<?php echo base_url(); ?>index.php/user/addUser",
            dataType: 'json',
            data:{
                "personal_data"     :personal_data,
                "rols"              :rols
            },
            success: function(data){
                alert(data);
            },
            error: function (ajaxContext) {
            }
        });
    });
</script>
<script src="/assets/js/user/addUser.js"></script>