/**
 * Created by wzh on 29/11/2016.
 */
// var url;
$(document).ready(function(){

    $.getJSON("/sports/index.php/social/getAllMessages", function (data) {
        var i = 0;
        console.log(data[0].user);
        for (; i < data.length; i++) {
            var x = data[i]
            if(x.has_fabuloused==0){
                if(x.pic_urls==""){
                    $('#div_message').append(

                        "<div class=\"act-content\">"+
                        "<div class=\"row\">"+
                        "<div class=\"col-md-1\">"+
                        "<img src=\""+x.userheader_url+"\" class=\"img-rounded  act-header\">"+
                        "</div>"+
                        "<div class=\"col-md-2\">"+
                        "<h4>"+x.user+"</h4>"+
                        "<p>"+x.time+"</p>"+
                        "</div>"+
                        "</div>"+
                        "<p>"+x.content+"</p>"+
                        "<div class=\"row\">"+
                        "</div>"+
                        "<div class=\"row\" style=\"height: auto\" >"+
                        "<div class=\"col-md-offset-8 col-md-2\">"+
                        "<button class=\" btn btn-primary btn-sm\"  style=\"width: 100%\" >"+
                        "<span class=\"glyphicon glyphicon-heart\"></span> 赞("+x.fabulous_num +")"+
                        "</button>"+
                        "</div>"+
                        "<div class=\"col-md-2\">"+
                        "<button class=\" btn btn-danger btn-sm \""+"style=\"width: 100%\" onclick=\'fabulous("+x.messageId+")\' >"+
                        "<span class=\"glyphicon glyphicon-heart\"></span> 赞"+
                        "</button>"+
                        "</div>"+
                        "</div>"+
                        "</div>"
                    );
                }else {

                    $('#div_message').append(
                        "<div class=\"act-content\">" +
                        "<div class=\"row\">" +
                        "<div class=\"col-md-1\">" +
                        "<img src=\"" + x.userheader_url + "\" class=\"img-rounded  act-header\">" +
                        "</div>" +
                        "<div class=\"col-md-2\">" +
                        "<h4>" + x.user + "</h4>" +
                        "<p>" + x.time + "</p>" +
                        "</div>" +
                        "</div>" +
                        "<p>" + x.content + "</p>" +
                        "<div class=\"row\">" +
                        "<div class=\"col-md-3\">" +
                        "<img src=\"" + x.pic_urls + "\" class=\"img-rounded act-img\" >" +
                        "</div>" +
                        "</div>" +
                        "<div class=\"row\" style=\"height: auto\" >" +
                        "<div class=\"col-md-offset-8 col-md-2\">" +
                        "<button class=\" btn btn-primary btn-sm\"  style=\"width: 100%\" >" +
                        "<span class=\"glyphicon glyphicon-heart\"></span> 赞(" + x.fabulous_num + ")" +
                        "</button>" +
                        "</div>" +
                        "<div class=\"col-md-2\">" +
                        "<button class=\" btn btn-danger btn-sm \"" + "style=\"width: 100%\" onclick=\'fabulous(" + x.messageId + ")\' >" +
                        "<span class=\"glyphicon glyphicon-heart\"></span> 赞" +
                        "</button>" +
                        "</div>" +
                        "</div>" +
                        "</div>"
                    );
                }
            }else {

                if(x.pic_urls==""){
                    $('#div_message').append(

                        "<div class=\"act-content\">"+
                        "<div class=\"row\">"+
                        "<div class=\"col-md-1\">"+
                        "<img src=\""+x.userheader_url+"\" class=\"img-rounded  act-header\">"+
                        "</div>"+
                        "<div class=\"col-md-2\">"+
                        "<h4>"+x.user+"</h4>"+
                        "<p>"+x.time+"</p>"+
                        "</div>"+
                        "</div>"+
                        "<p>"+x.content+"</p>"+
                        "<div class=\"row\">"+
                        "</div>"+
                        "<div class=\"row\" style=\"height: auto\" >"+
                        "<div class=\"col-md-offset-8 col-md-2\">"+
                        "<button class=\" btn btn-primary btn-sm\"  style=\"width: 100%\" >"+
                        "<span class=\"glyphicon glyphicon-heart\"></span> 赞("+x.fabulous_num +")"+
                        "</button>"+
                        "</div>"+
                        "<div class=\"col-md-2\">"+
                        "<button class=\" btn btn-sm \""+"style=\"width: 100%\" >"+
                        "<span class=\"glyphicon glyphicon-heart\"></span> 已赞"+
                        "</button>"+
                        "</div>"+
                        "</div>"+
                        "</div>"
                    );
                }else {

                    $('#div_message').append(

                        "<div class=\"act-content\">"+
                        "<div class=\"row\">"+
                        "<div class=\"col-md-1\">"+
                        "<img src=\""+x.userheader_url+"\" class=\"img-rounded  act-header\">"+
                        "</div>"+
                        "<div class=\"col-md-2\">"+
                        "<h4>"+x.user+"</h4>"+
                        "<p>"+x.time+"</p>"+
                        "</div>"+
                        "</div>"+
                        "<p>"+x.content+"</p>"+
                        "<div class=\"row\">"+
                        "<div class=\"col-md-3\">"+
                        "<img src=\""+x.pic_urls +"\" class=\"img-rounded act-img\" >"+
                        "</div>"+
                        "</div>"+
                        "<div class=\"row\" style=\"height: auto\" >"+
                        "<div class=\"col-md-offset-8 col-md-2\">"+
                        "<button class=\" btn btn-primary btn-sm\"  style=\"width: 100%\" >"+
                        "<span class=\"glyphicon glyphicon-heart\"></span> 赞("+x.fabulous_num +")"+
                        "</button>"+
                        "</div>"+
                        "<div class=\"col-md-2\">"+
                        "<button class=\" btn btn-sm \""+"style=\"width: 100%\" >"+
                        "<span class=\"glyphicon glyphicon-heart\"></span> 已赞"+
                        "</button>"+
                        "</div>"+
                        "</div>"+
                        "</div>"
                    );
                }

            }


        }
    });
    $.getJSON("/sports/index.php/social/getMyMessages", function (data) {
        var i = 0;
        console.log(data[0].user);
        for (; i < data.length; i++) {
            var x = data[i]
                if(x.pic_urls==""){
                    $('#div_my_message').append(

                        "<div class=\"act-content\">"+
                        "<div class=\"row\">"+
                        "<div class=\"col-md-1\">"+
                        "<img src=\""+x.userheader_url+"\" class=\"img-rounded  act-header\">"+
                        "</div>"+
                        "<div class=\"col-md-2\">"+
                        "<h4>"+x.user+"</h4>"+
                        "<p>"+x.time+"</p>"+
                        "</div>"+
                        "</div>"+
                        "<p>"+x.content+"</p>"+
                        "<div class=\"row\">"+
                        "</div>"+
                        "<div class=\"row\" style=\"height: auto\" >"+
                        "<div class=\"col-md-2 col-md-offset-10\">"+
                        "<button class=\" btn btn-primary btn-sm\"  style=\"width: 100%\" >"+
                        "<span class=\"glyphicon glyphicon-heart\"></span> 赞("+x.fabulous_num +")"+
                        "</button>"+
                        "</div>"+
                        "</div>"+
                        "</div>"
                    );
                }else {

                    $('#div_my_message').append(
                        "<div class=\"act-content\">" +
                        "<div class=\"row\">" +
                        "<div class=\"col-md-1\">" +
                        "<img src=\"" + x.userheader_url + "\" class=\"img-rounded  act-header\">" +
                        "</div>" +
                        "<div class=\"col-md-2\">" +
                        "<h4>" + x.user + "</h4>" +
                        "<p>" + x.time + "</p>" +
                        "</div>" +
                        "</div>" +
                        "<p>" + x.content + "</p>" +
                        "<div class=\"row\">" +
                        "<div class=\"col-md-3\">" +
                        "<img src=\"" + x.pic_urls + "\" class=\"img-rounded act-img\" >" +
                        "</div>" +
                        "</div>" +
                        "<div class=\"row\" style=\"height: auto\" >" +
                        "<div class=\"col-md-2 col-md-offset-10\">" +
                        "<button class=\" btn btn-primary btn-sm\"  style=\"width: 100%\" >"+
                        "<span class=\"glyphicon glyphicon-heart\"></span> 赞("+x.fabulous_num +")"+
                        "</button>"+
                        "</div>" +
                        "</div>" +
                        "</div>"
                    );
                }
        }
    });
    $.getJSON("/sports/index.php/social/getMyFabulous", function (data) {
        var i=0;
        for (;i<data.length;i++){
            var x=data[i];
            $('#div_about_me').append(
                "<div class=\"act-content\">"+
                "<h4><span>"+x.userName+"</span>赞了你</h4>"+
                "<p>&quot"+x.content+"&quot</p>"+
                "</div>"
        )

        }

    })

});

function fabulous(messageId) {
    $.post("/sports/index.php/social/fabulous",
        {
            'messageId':messageId,
        },
        function(data,status){
            if(data.fabulous_result==1){
                alert("点赞成功!")
                location.reload();
            }else {
                alert("点赞失败!")
            }
        });
}
$("#upload_file").change(function(){
    if($("#upload_file").val() != '') $("#submit_form").submit();
});
//iframe加载响应，初始页面时也有一次，此时data为null。
$("#exec_target").load(function(){
    var data = $(window.frames['exec_target'].document.body).find("textarea").html();
    //若iframe携带返回数据，则显示在feedback中
    if(data != null){
        $("#feedback").append(data.replace(/&lt;/g,'<').replace(/&gt;/g,'>'));
        $("#upload_file").val('');
    }
});
$('#btn_submit').click(function () {
    var content=$('#content').val();

    $.post("/sports/index.php/social/addMessage",
        {
            'content':content
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