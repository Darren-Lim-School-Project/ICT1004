/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
         $(".addfriend").click(function() {
                $.post('process/addFriend.php',
                        {
                            friendid: $(".addfriend").attr("id")
                        },
                        function (response) {

                            switch (response) {
                                case 'Already friends':
                                    $('#message_newfriend').html('<div id="alertFadeOut" style="color: green">Already friends!</div>');
                                    $('#alertFadeOut').fadeOut(3000, function () {
                                        $('#alertFadeOut').text('');
                                    });
                                    break;
                                case 'Trying to add themselves':
                                    $('#message_newfriend').html('<div id="alertFadeOut" style="color: red">You\'re trying to add yourself</div>');
                                    $('#alertFadeOut').fadeOut(3000, function () {
                                        $('#alertFadeOut').text('');
                                    });
                                    break;
                                case 'Added as friend':
                                    $('#message_newfriend').html('<div id="alertFadeOut" style="color: red">You\'re now friends!</div>');
                                    $('#alertFadeOut').fadeOut(3000, function () {
                                        $('#alertFadeOut').text('');
                                    });
                                    break;
                            }
                        });
            });   