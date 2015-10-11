$(function(){
    $("#addbtn").click(function () {
        $("#codedialog").modal('show');
    });

    $("#deletebtn").click(function () {
        alert("delete");
    });
    
    $("#savebtn").click(function () {
        if(formcheck()){
            var params = $("#fleetingform").serialize();
            params += '&action=doCreate';
            $.post(AJAXURL,params,function(data){
                if(data && data.success){
                    $("#alertsuccess").alert('show');

                }else{
                    $("#alertsyserror").alert('show');
                }
            },'json');
        }
    });
});

function formcheck(){

    return true;
}