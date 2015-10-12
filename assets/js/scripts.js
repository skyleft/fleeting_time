$(function(){

    loadData();

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

function loadData(){
    var params = 'action=doLoadData';
    $.post(
        AJAXURL,
        params,
        function(data){
            if(data){
                $("#datacon").empty();
                for(var d in data){
                    var ntr = $("<tr>");
                    ntr.append($("<td><input type='checkbox' name='ids' id='ids"+ d.id+"' value='"+ d.ID +"'> </td>"));
                    ntr.append($("<td>"+ d.TITLE +"</td>"));
                    ntr.append($("<td>"+ d.STARTTIME + "</td>"));
                    ntr.append($("<td>"+ d.ENDTIME+"</td>"));
                    ntr.append($("<td><a href=\"javascript:viewlabel('"+ d.ID+"')\">"+VIEWLABEL+"</a></td>"));
                    $("#datacon").append(ntr);
                }
            }
        },
        'json'
    );
}