/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

   $(document).ready(function(){
       $("#search").keyup(function(){
          var query = $(this).val();
          if (query != "") {
            $.ajax({
              url: 'process/search.php',
              method: 'POST',
              data: {query:query},
              success: function(data){
 
                $("#result").html(data);
                $("#result").css("display", 'block');
 
                $("#search").focusout(function(){
                    $("#result").css("display", 'none');
                });
                $("#search").focusin(function(){
                    $('#result').css("display", 'block');
                });
              }
            });
          } else {
          $('#result').css('display', 'none');
        }
      });
    });
