$(document).ready(function() {

    var gettotal = $('#gettotal_expense').attr("data-url");	
        //get expense
        $.ajax({
            type: "GET",
            url: gettotal,
            dataType: "json",
            success: function (html) {
                var objs = html.data;
                if(objs){
                    $("#overall").html(objs.totalbalance);
                    $("#month").html(objs.month);
                    $("#today").html(objs.day);
                    $("#week").html(objs.week);
                    $(".expenseyear").html(objs.year);
                }
            },
        });
    });
    
    