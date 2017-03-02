/**
 * Created by wzh on 27/11/2016.
 */
$(document).ready(function(){

     function checkPhone(phone){
            if(!(/^1[34578]\d{9}$/.test(phone))){
                alert("手机号码有误，请重填");
                return false;
            }
            return true;
        }

    $('#btn_login').click(function () {
        var account=$('#account').val();
        var password=$('#password').val();
        $.post("/sports/index.php/user/login",
            {
                'phone_number':account,
                'password':password
            },
            function(data,status){
                if(data.login_result==1){
                    if(account=="admin"){window.location.href="admin.html";}else {window.location.href="homepage.html";}

                }else {
                    alert("账号或密码错误!")
                }
            });
    });
    $('#btn_register').click(function () {
        var account=$('#phone_number').val();
        var password=$('#new_password').val();
        if(checkPhone(account)){
            $.post("/sports/index.php/user/register",
                {
                    'phone_number':account,
                    'password':password
                },
                function(data,status){
                    if(data.register_result==1){
                        alert("注册成功!!")
                    }else {
                        alert("账号重复!")
                    }
                });
        }

    });

    $('#submit_header').click(function () {
        // alert("!!!");
        $.getJSON("/sports/index.php/user/updateMyHeader",function (data) {
                if(data.update_result==1){
                    alert("修改成功!!")
                    location.reload();
                }else {
                    alert("修改失败!")
                }
            });
    });
    $('#btn_update').click(function () {
        var birth=$('#birth').val();
        var name=$('#name').val();
        var sex=$('#sex').find("option:selected").text();
        var city=$('#place').val();
        var interest=$('#interest').val();
        var declaration=$('#saying').val();


        $.post("/sports/index.php/user/updateDatailInfo",
            {
                'name':name,
                'birth':birth,
                'sex':sex,
                'city':city,
                'interest':interest,
                'sports_declaration':declaration
            },
            function(data,status){
                if(data.register_result==1){
                    alert("修改成功!!")
                }else {
                    alert("修改失败!")
                }
            });
    });

    $.getJSON("/sports/index.php/user/getDetailedInfo", function (data) {
        var name=data.userName;
        var sex=data.sex;
        var birth=data.birth;
        var city=data.city;
        var interest = data.interest;
        var declaration=data.declaration;
        var header_url=data.header_url;
        $('#header').attr("src",header_url);
        $('#name').attr("placeholder",name);
        $('#sex').attr("placeholder",sex);
        $('#birth').attr("placeholder",birth);
        $('#place').attr("placeholder",city);
        $('#saying').attr("placeholder",declaration);
        $('#interest').attr("placeholder",interest);


    })
})
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
