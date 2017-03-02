/**
 * Created by wzh on 27/11/2016.
 */
/**
 * Created by wzh on 27/11/2016.
 */
$(document).ready(function(){
    $.getJSON("/sports/index.php/user/getBasicInfo",function (data) {
        $('#name').text(data.name);
        $('#city').text(data.city);
        $('#sex').text(data.sex);
        $('#birth').text(data.birth);
        $('#distance').text(data.distance);
        $('#friends_num').text(data.friends_num);
    });
    $.getJSON("/sports/index.php/sports/getCycleDatabyDate",function (data) {
        $('#cycling_distance').text(data.distance);
        $('#cycling_energy').text(data.energy);
        $('#cycling_max_distance').text(data.max_distance);
        $('#cycling_total_distance').text(data.total_distance);
    });

    $.getJSON("/sports/index.php/sports/getRunningDatabyDate",function (data) {
        $('#running_distance').text(data.distance);
        $('#running_energy').text(data.energy);
        $('#running_max_distance').text(data.max_distance);
        $('#running_total_distance').text(data.total_distance);
    });
    $.getJSON("/sports/index.php/sports/getWalkingDatabyDate",function (data) {
        $('#walking_distance').text(data.distance);
        $('#walking_energy').text(data.energy);
        $('#walking_total_distance').text(data.total_distance);
        $('#walking_max_distance').text(data.max_distance);
    });
})