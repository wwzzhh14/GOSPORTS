/**
 * Created by wzh on 29/11/2016.
 */
$(document).ready(function () {

    function init() {
        var name;
        var header;
        return function () {
            $.getJSON("/sports/index.php/user/getDetailedInfo", function (data) {
                 name=data.userName;
                 header_url=data.header_url;
                $('#my_header').attr("src",header_url);
                $('#my_name').text(name);
            });
        }

    }
    var a=init();
    a();

})