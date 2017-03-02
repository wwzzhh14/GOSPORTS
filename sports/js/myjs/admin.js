/**
 * Created by wzh on 30/11/2016.
 */
$(document).ready(
    function () {
        $.getJSON("/sports/index.php/admin/getAllUsers",function (data) {
            var i=0;
            for(;i<data.length;i++){
                var x=data[i];
                $('#user_admin_div').append(
                    "<div class=\"act-content\">"+
                    "<div class=\"row\">"+
                    "<div class=\"col-md-2\">"+
                    "<img src=\""+x.header_url+"\" class=\"img-rounded  act-header\">"+
                    "<h5 style=\"margin-left: 8px\">"+x.userName+"</h5>"+
                    "</div>"+
                    "</div>"+
                    "<div class=\"row\" style=\"height: auto\" >"+
                    "<div class=\"col-md-offset-10 col-md-2\">"+
                    "<button class=\" btn btn-danger btn-sm btn-participation\""+"style=\"width: 100%\" onclick=\'deleteUser("+x.userId+")\' >删除"+
                    "</button>"+
                    "</div>"+
                    "</div>"+
                    "</div>"
                );
            }

        });
        $.getJSON("/sports/index.php/admin/getAllActivities",function (data) {
            var i=0;
            for(;i<data.length;i++){
                x=data[i];
                $('#activity_admin_div').append(
                    "<div class=\"act-content\">"+
                    "<div class=\"row\">"+
                    "<div class=\"col-md-1\">"+
                    "<img src=\""+x.user_header_url+"\" class=\"img-rounded  act-header\">"+
                    "<h5 styl、e=\"margin-left: 18px\">"+x.userName+"</h5>"+
                    "</div>"+
                    "<div class=\"col-md-10\">"+
                    "<h4>#"+x.title+"#"+x.type+"#"+x.num+"人#"+x.start_date+"至"+x.end_date+"#</h4>"+
                    "</div>"+
                    "</div>"+
                    "<p>"+x.content+"</p>"+
                    "<div class=\"row\" style=\"height: auto\" >"+
                    "<div class=\"col-md-offset-10 col-md-2\">"+
                    "<button class=\" btn btn-danger btn-sm btn-participation\""+"style=\"width: 100%\" onclick=\'deleteActivity("+x.activityId+")\' >删除"+
                    "</button>"+
                    "</div>"+
                    "</div>"+
                    "</div>"
                );
            }
        });
    }
);

function deleteUser(id) {
    $.post("/sports/index.php/admin/deleteUser",
        {
            'userId':id
        },
        function(data,status){
            if(data.delete_result==1){
                alert("删除成功!")
                location.reload();
            }else {
                alert("删除失败!")
            }
        });

}
function deleteActivity(id) {
    $.post("/sports/index.php/admin/deleteActivity",
        {
            'activityId':id
        },
        function(data,status){
            if(data.delete_result==1){
                alert("删除成功!")
                location.reload();
            }else {
                alert("删除失败!")
            }
        });

}
