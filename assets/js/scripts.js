$(function(){

    loadData();

    $("#addbtn").click(function () {
        $("#fleetingform")[0].reset();
        $("textarea[name='flag_content']").text('');
        $("#codedialog").modal('show');
    });

    $("#editbtn").click(function(event) {
        var ids = $("input[name='ids']:checked");
        if(ids && ids.length==1){
            var sid = ids[0].value;
            $.post(AJAXURL, {id: sid,action:'doGet'}, function(data, textStatus, xhr) {
                if (data) {
                    $("input[name='id']").val(data.ID);
                    $("input[name='title']").val(data.TITLE);
                    if(data.POSITION=="up")
                        $("#upposition").prop('selected', true);
                    if (data.POSITION=='bottom')
                        $("#bottomposition").prop('selected', true);
                    $("input[name='starttime']").val(data.STARTTIME.split(/\s+/)[0]);
                    $("input[name='endtime']").val(data.ENDTIME.split(/\s+/)[0]);
                    $("textarea[name='flag_content']").text(data.FLAG_CONTENT);
                    $("#codedialog").modal('show');
                };
            },'json');

        }else{
            bootbox.alert(ALERT_PLEASE_CHOOSE_ONE_ROW);
        }
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
                        bootbox.alert(ALERT_OK);
                    }else{
                        bootbox.alert(ALERT_FAILED);
                    }
                    loadData();
                },'json');
            }
        }else{
            bootbox.alert(ALERT_PLEASE_CHOOSE_ONE_ROW);
        }
        
    });
    
    $("#savebtn").click(function () {
        if(formcheck()){
                var starttime = $("#starttime").val();
                var endtime = $("#endtime").val();
            $.post(AJAXURL, {starttime: starttime,endtime:endtime,action:'doCheckExisted'}, function(data, textStatus, xhr) {
                if (!data.existed) {
                    var params = $("#fleetingform").serialize();
                    params += '&action=doCreate';
                    $.post(AJAXURL,params,function(data){
                        if(data && data.success){
                            bootbox.alert("ok");
                            $("#fleetingform")[0].reset();
                            $("#codedialog").modal('hide');
                            loadData();
                        }else{
                            bootbox.alert(ALERT_FAILED);
                        }
                    },'json');
                }else{
                    bootbox.alert(TIME_ALREADY_EXISTED);
                }
            },'json');
            
        }
    });

    $("#refreshbtn").click(function(){
        loadData();
    });


});

function formcheck(){

    var title = $("#title").val();
    var position = $("#title").val();
    var starttime = $("#starttime").val();
    var endtime = $("#endtime").val();
    var flag_content = $("#flag_content").val();
    if (title==null||title=="") {
        bootbox.alert(TITLE_SHOULD_NOT_BE_EMPTY);
        $("#title").focus();
        return false;
    }
    if (position==null||position=="") {
        bootbox.alert(POSITION_SHOULD_NOT_BE_EMPTY);
        $("#position").focus();
        return false;
    }
    if (starttime==null||starttime=="") {
        bootbox.alert(STARTTIME_SHOULD_NOT_BE_EMPTY);
        $("#starttime").focus();
        return false;
    }
    if (endtime==null||endtime=="") {
        bootbox.alert(ENDTIME_SHOULD_NOT_BE_EMPTY);
        $("#endtime").focus();
        return false;
    }
    if (flag_content==null||flag_content=="") {
        bootbox.alert(CONTENT_SHOULD_NOT_BE_EMPTY);
        $("#flag_content").focus();
        return false;
    }

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
                    ntr.append($("<td>"+ ('bottom'==d.POSITION?BOTTOMLABEL:UPLABEL) +"</td>"));
                    ntr.append($("<td>"+ d.STARTTIME + "</td>"));
                    ntr.append($("<td>"+ d.ENDTIME+"</td>"));
                    ntr.append($("<td><a href=\"javascript:viewlabel('"+ d.FLAG_CONTENT+"','"+d.POSITION+"')\">"+VIEWLABEL+"</a></td>"));
                    $("#datacon").append(ntr);
                }
            }
        },
        'json'
    );
}

function viewlabel (content,upOrBottom) {
    $("#pre_post .fleeting-box-090807").remove();
    var con = $('<div class="fleeting-box-090807" id="pre_fleeting_content"></div>');
    con.html(content);
    if ("bottom"===upOrBottom) {
        $("#pre_post").append(con);
    }else{
        $("#pre_post").prepend(con);
    }
    $("#previewdialog").modal('show');
}