$(document).ready(function(){
    $('#show-register').click(function(){
        $('#login-form').hide('slide', {direction: 'left'}, 300);
        $('#register-form').show('slide', {direction: 'right'}, 300);
    });

    $('#show-login').click(function(){
        $('#register-form').hide('slide', {direction: 'right'}, 300);
        $('#login-form').show('slide', {direction: 'left'}, 300);
    });
});
