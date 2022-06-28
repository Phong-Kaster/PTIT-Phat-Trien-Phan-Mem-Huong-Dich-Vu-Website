$(document).ready(function() {

var account 			       = $('#incomeaccount').attr("data-url");
var expenseaccount             = $('#expenseaccount').attr("data-url");
var getaccount                 = $('#getaccount').attr("data-url");                  

$('#incomeaccount').select2();
$('#expenseaccount').select2();
$('#account').select2();

//get income account
	$.ajax({
        type: "GET",
        url: account,
        dataType: "json",
        success: function (html) {
			var objs = html.data;
			jQuery.each(objs, function (index, record) {
                var id = decodeURIComponent(record.id);
                var name = decodeURIComponent(record.name);
				//alert(name);
                $("#incomeaccount").append($("<option></option>")
                    .attr("value",id)
                    .text(name));
				$("#expenseaccount").append($("<option></option>")
                    .attr("value",id)
                    .text(name)); 		
            });
        },
    });

//get expense account
    $.ajax({
        type: "GET",
        url: expenseaccount,
        dataType: "json",
        success: function (html) {
            var objs = html.data;
            jQuery.each(objs, function (index, record) {
                var id = decodeURIComponent(record.id);
                var name = decodeURIComponent(record.name);
               
                $("#expenseaccount").append($("<option></option>")
                    .attr("value",id)
                    .text(name));       
            });
        },
    });


    //get account
    $.ajax({
        type: "GET",
        url: getaccount,
        dataType: "json",
        success: function (html) {
            var options;
            var objs = html.data;
            $.each(objs, function(index, object) {
                    options += '<option value="' + object.id + '">' + object.name + '</option>';
                });
                $('#form #account').html(options);
        },
    });


});

