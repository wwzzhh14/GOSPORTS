/**
 * Created by wzh on 29/11/2016.
 */
$('#btn_send').click(function () {
    var account=$('#account').val();

    $.post("/sports/index.php/contact/sendRequest",
        {
            'userAccount':account
        },
        function(data,status){
            if(data.request_result==1){
                alert("发送成功!!")
            }else {
                alert("发送失败!")
            }
        });
});

function agree(id) {
    $.post("/sports/index.php/contact/acceptResquest",
        {
            'userId':id,
        },
        function(data,status){
            if(data.request_result==1){
                alert("添加好友成功!")
                location.reload();
            }else {
                alert("添加好友失败!")
            }
        });
}
function refuse(id) {
    $.post("/sports/index.php/contact/refuseRequest",
        {
            'userId':id,
        },
        function(data,status){
            if(data.delete_result==1){
                alert("拒绝成功!")
            }else {
                alert("拒绝失败!")
            }
        });
}

// function deleteContact(id) {
//     $.post("/sports/index.php/contact/refuseRequest",
//         {
//             'userId':id,
//         },
//         function(data,status){
//             if(data.delete_result==1){
//                 alert("拒绝成功!")
//             }else {
//                 alert("拒绝失败!")
//             }
//         });
// }
$(document).ready(function() {
    $.getJSON("/sports/index.php/contact/getContactRequests", function (data) {
        var i = 0;
        for (; i < data.length; i++) {
            var x = data[i]
            $('#request_div').append(
            "<div class=\"act-content\">"+
                "<div class=\"row\">"+
                "<div class=\"col-md-1\">"+
                "<img src=\""+x.header_url+"\" class=\"img-rounded  act-header\">"+
                "<h5 style=\"margin-left: 18px\">"+x.userName+"</h5>"+
                "</div>"+
                "<div class=\"col-md-offset-10 col-md-1\">"+
                "<button type=\"button\" class=\" btn btn-link\""+"onclick=\'agree("+x.userId+")\' >同意"+
                "</button>"+
                "<button type=\"button\" class=\" btn btn-link\""+"onclick=\'refuse("+x.userId+")\' >拒绝"+
                "</button>"+
                "</div>"+
                "</div>"+
                "</div>"
            )

        }
    });
    $.getJSON("/sports/index.php/contact/getContacts", function (data) {
        var i = 0;
        for (; i < data.length; i++) {
            var x = data[i]
            $('#div_contact').append(
            "<div class=\"act-content\">"+
                "<div class=\"row\">"+
                "<div class=\"col-md-1\">"+
                "<img src=\""+x.header_url+"\" class=\"img-rounded  act-header\">"+
                "<h5 style=\"margin-left: 18px\">"+x.userName+"</h5>"+
                "</div>"+
                "<div class=\"col-md-offset-10 col-md-1\">"+
                // "<button type=\"button\" class=\" btn btn-link\""+"onclick=\'deleteContact("+x.userId+")\' >删除"+
                // "</button>"+
                "</div>"+
                "</div>"+
                "</div>"
            )

        }
    });
}
);