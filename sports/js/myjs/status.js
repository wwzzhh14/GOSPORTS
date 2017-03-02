/**
 * Created by wzh on 30/11/2016.
 */
$(document).ready(function () {

    function testStatus() {
        return function () {
            $.getJSON("/sports/index.php/user/getUserStatus",function (data) {
                if(data.status==0){
                    window.location.href="index.html";
                }
            });
        }
    }

    var test=testStatus();
    test();

})