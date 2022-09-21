var URL_BASE="http://127.0.0.1/cimol/coordenacao";
$(document).ready(function(){
    
    $("#user-show").click(
        function(){
            if($("#user-info").hasClass('hide')){
                $("#user-info").removeClass('hide');
                $("#user-info").addClass('show');
            }else{
                $("#user-info").removeClass('show');
                $("#user-info").addClass('hide');
            }
        }
    );
    
   
});