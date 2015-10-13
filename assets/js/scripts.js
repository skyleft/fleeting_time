$(function(){

    loadData();

    $("#addbtn").click(function () {
        $("#codedialog").modal('show');
    });

    $("#deletebtn").click(function () {
        var ids = $("input[name='ids']:checked");
        if(ids && ids.length>0){
            var sids = "";
            for(var i=0;i<ids.length;i++){
                sids += ids[i].value+",";
            }
            if(sids){
                $.post(AJAXURL, {id: sids,action:'doRemove'}, function(data) {
                    if (data && data.success) {
                        bootbox.alert('ok');
                    }else{
                        bootbox.alert('failed.');
                    }
                    loadData();
                },'json');
            }
        }else{
            bootbox.alert('Please choose at least one row.');
        }
        
    });
    
    $("#savebtn").click(function () {
        if(formcheck()){
            var params = $("#fleetingform").serialize();
            params += '&action=doCreate';
            $.post(AJAXURL,params,function(data){
                if(data && data.success){
                    bootbox.alert("ok");
                    $("#fleetingform")[0].reset();
                    $("#codedialog").modal('hide');
                    loadData();
                }else{
                    bootbox.alert("failed.");
                }
            },'json');
        }
    });

    $("#refreshbtn").click(function(){
        loadData();
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
                for(var i=0;i<data.length;i++){
                    var d = data[i];
                    var ntr = $("<tr>");
                    ntr.append($("<td><input type='checkbox' name='ids' id='ids"+ d.ID+"' value='"+ d.ID +"'> </td>"));
                    ntr.append($("<td>"+ d.TITLE +"</td>"));
                    ntr.append($("<td>"+ d.POSITION +"</td>"));
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