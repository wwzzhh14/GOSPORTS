/**
 * Created by wzh on 30/11/2016.
 */
$(document).ready(function() {
    $.post("/sports/index.php/activity/getActivityResult",
        {
            'type':'cycling',
        },
        function(data,status){
            var i = 0;
            for (; i < data.length; i++) {
                var x = data[i]
                $('#cycling').append(
                    "<div class=\"act-content\">"+
                    "<div class=\"row\">"+
                    "<div class=\"col-md-1\">"+
                    "<img src=\""+x.header_url+"\" class=\"img-rounded  act-header\">"+
                    "<h5 style=\"margin-left: 18px\">"+x.name+"</h5>"+
                    "</div>"+
                    "<div class=\"col-md-offset-9 col-md-1\">"+
                    "<h3 >"+x.distance/1000+"KM"+"</h3>"+
                    "</div>"+
                    "</div>"+
                    "</div>"
                )

            }
        });
    $.post("/sports/index.php/activity/getActivityResult",
        {
            'type':'running',
        },
        function(data,status){
            var i = 0;
            for (; i < data.length; i++) {
                var x = data[i]
                $('#running').append(
                    "<div class=\"act-content\">"+
                    "<div class=\"row\">"+
                    "<div class=\"col-md-1\">"+
                    "<img src=\""+x.header_url+"\" class=\"img-rounded  act-header\">"+
                    "<h5 style=\"margin-left: 18px\">"+x.name+"</h5>"+
                    "</div>"+
                    "<div class=\"col-md-offset-9 col-md-1\">"+
                    "<h3 >"+x.distance/1000+"KM"+"</h3>"+
                    "</div>"+
                    "</div>"+
                    "</div>"
                )

            }
        });
    $.post("/sports/index.php/activity/getActivityResult",
        {
            'type':'walking',
        },
        function(data,status){
            var i = 0;
            for (; i < data.length; i++) {
                var x = data[i]
                $('#walking').append(
                    "<div class=\"act-content\">"+
                    "<div class=\"row\">"+
                    "<div class=\"col-md-1\">"+
                    "<img src=\""+x.header_url+"\" class=\"img-rounded  act-header\">"+
                    "<h5 style=\"margin-left: 18px\">"+x.name+"</h5>"+
                    "</div>"+
                    "<div class=\"col-md-offset-9 col-md-1\">"+
                    "<h3 >"+x.distance/1000+"KM"+"</h3>"+
                    "</div>"+
                    "</div>"+
                    "</div>"
                )

            }
        });
});