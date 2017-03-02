/**
 * Created by wzh on 28/11/2016.
 */
$('#btn_activity').click(function () {
    var title=$('#title').val();
    var type=$('#type').find("option:selected").text();
    var start_date=$('#start').val();
    var end_date=$('#end').val();
    var num=$('#num').val();
    var profile=$('#profile').val();
    $.post("/sports/index.php/activity/addActivity",
        {
            'title':title,
            'type':type,
            'start_date':start_date,
            'end_date':end_date,
            'num':num,
            'profile':profile
        },
        function(data,status){
            if(data.add_result==1){
                alert("发布成功!!")
                location.reload();
            }else {
                alert("发布失败!")
            }
        });
});
function participate(id) {
    $.post("/sports/index.php/activity/participateActivity",
        {
            'activityId':id,
        },
        function(data,status){
            if(data.participate_result==1){
                alert("报名成功!")
                location.reload();
            }else {
                alert("您已参加了此活动!")
            }
        });
}

function exit(id) {
    $.post("/sports/index.php/activity/exitActivity",
        {
            'activityId':id,
        },
        function(data,status){
            if(data.exit_result==1){
                alert("退出成功!")
                location.reload();
            }else {
                alert("退出失败!")
            }
        });
}

function deleteActivity(id) {
    $.post("/sports/index.php/activity/deleteActivity",
        {
            'activityId':id,
        },
        function(data,status){
            if(data.delete_result==1){
                alert("取消成功!")
                location.reload();
            }else {
                alert("取消失败!")
            }
        });
}

function getActivityResult(activityId) {
    $.post("/sports/index.php/activity/saveActivityId",
        {
            'activityId':activityId,
        },
        function(data,status){
            if(data.save_result==1){
                window.location.href="result.html";
            }else {
                alert("获取失败!")
            }
        });

}


$(document).ready(function(){
    $.getJSON("/sports/index.php/activity/getAllActivities",function (data) {
        var i=0;
        for(;i<data.length;i++){
            var x=data[i];
            $('#all_activity_div').append(
                "<div class=\"act-content\">"+
                "<div class=\"act-content\">"+
                "<div class=\"row\">"+
                "<div class=\"col-md-1\">"+
                "<img src=\""+x.user_header_url+"\" class=\"img-rounded  act-header\">"+
                "<h5 style=\"margin-left: 18px\">"+x.userName+"</h5>"+
                "</div>"+
                "<div class=\"col-md-10\">"+
                "<h4>#"+x.title+"#"+x.type+"#"+x.num+"人#"+x.start_date+"至"+x.end_date+"#</h4>"+
                "<p>已有<strong>"+x.participated_num+"</strong>人报名</p>"+
                "</div>"+
                "</div>"+
                "<p>"+x.content+"</p>"+
                "<div class=\"row\" style=\"height: auto\" >"+
                "<div class=\"col-md-offset-8 col-md-2\">"+
                "<button class=\" btn btn-primary btn-sm btn-participation\""+"style=\"width: 100%\" onclick=\'participate("+x.activityId+")\' >参加"+
                "</button>"+
                "</div>"+
                "<div class=\"col-md-2\">"+
                "<button class=\"  btn btn-danger btn-sm\" style=\"width: 100%\">举报"+
                "</button>"+
                "</div>"+
                "</div>"+
                "</div>"
            );

        }
    });

    $.getJSON("/sports/index.php/activity/getMyAcitivities",function (data) {
        var i=0;
        for(;i<data.length;i++){
            var x=data[i];
            $("#my_activity_div").append(
                "<div class=\"act-content\">"+
                "<div class=\"row\">"+
                "<div class=\"col-md-1\">"+
                "<img src=\""+x.user_header_url+"\" class=\"img-rounded  act-header\">"+
                "<h5 style=\"margin-left: 18px\">"+x.userName+"</h5>"+
                "</div>"+
                "<div class=\"col-md-10\">"+
                "<h4>#"+x.title+"#"+x.type+"#"+x.num+"人#"+x.start_date+"至"+x.end_date+"#</h4>"+
            "</div>"+
            "</div>"+
            "<p>"+x.content+"</p>"+
            "<div class=\"row\" style=\"height: auto\" >"+
                "<div class=\"col-md-offset-10 col-md-2\">"+
                "<button class=\" btn btn-danger btn-sm btn-participation\""+"style=\"width: 100%\" onclick=\'deleteActivity("+x.activityId+")\' >取消活动"+
                "</button>"+
                "</div>"+
                "</div>"+
                "</div>"
            );
        }

    })
    $.getJSON("/sports/index.php/activity/getParticipatedActivities",function (data) {
        var i =0;
        for(;i<data.length;i++){
            var x= data[i];
            if(x.exit_date!=null){
                $('#participated_activity_div').append(
                    "<div class=\"act-content\" >"+
                    "<div class=\"row\">"+
                    "<div class=\"col-md-1\">"+
                    "<img src=\""+x.user_header_url+"\" class=\"img-rounded  act-header\"   >"+
                    "<h5 style=\"margin-left: 18px\">"+x.userName+"</h5>"+
                    "</div>"+
                    "<div class=\"col-md-10\">"+
                    "<h4>"+"#"+x.title+"#"+x.type+"#"+x.num+"人#"+x.end_date+"结束#"+"</h4>"+
                    // "<p>已有<strong>"+x.participated_num+"</strong>人报名</p>"+
                    "</div>"+
                    "</div>"+
                    "<p>"+x.content+"</p>"+
                    "<hr>"+
                    "<div class=\"row\">"+
                    "<div class=\"col-md-4\"><p>报名日期:<strong>"+x.participate_date+"</strong></p></div>"+
                    "<div class=\"col-md-4\"><p>结束日期:<strong>"+x.exit_date+"</strong></p></div>"+
                    "</div>"+
                    "</div>"
                );
            }else {
                $('#participated_activity_div').append(
                    "<div class=\"act-content\" >"+
                    "<div class=\"row\">"+
                    "<div class=\"col-md-1\">"+
                    "<img src=\""+x.user_header_url+"\" class=\"img-rounded  act-header\"   >"+
                    "<h5 style=\"margin-left: 18px\">"+x.userName+"</h5>"+
                    "</div>"+
                    "<div class=\"col-md-10\">"+
                    "<h4>"+"#"+x.title+"#"+x.type+"#"+x.num+"人#"+x.end_date+"结束#"+"</h4>"+
                    // "<p>已有<strong>"+x.participated_num+"</strong>人报名</p>"+
                    "</div>"+
                    "</div>"+
                    "<p>"+x.content+"</p>"+
                    "<hr>"+
                    "<div class=\"row\">"+
                    "<div class=\"col-md-4\"><p>报名日期:<strong>"+x.participate_date+"</strong></p></div>"+
                    "</div>"+
                    "<div class=\"row\" style=\"height: auto\" >"+
                    "<div class=\"col-md-offset-8 col-md-2\">"+
                    "<button class=\" btn btn-primary btn-sm btn-participation\""+"style=\"width: 100%\" onclick=\'getActivityResult("+x.activityId+")\' >查看"+
                    "</button>"+
                    "</div>"+
                    "<div class=\"col-md-2\">"+
                    "<button class=\"  btn btn-danger btn-sm\" style=\"width: 100%\"onclick=\'exit("+x.activityId+")\' >退出"+
                    "</button>"+
                    "</div>"+
                    "</div>"+
                    "</div>"
                );
            }
        }
    })

})