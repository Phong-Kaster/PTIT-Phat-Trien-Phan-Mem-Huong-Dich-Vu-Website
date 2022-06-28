$(document).ready(function() {

var incomecategory 		= $('#incomecategory').attr("data-url");
var expensecategory 	= $('#expensecategory').attr("data-url");

//enable search category
//$('#category').select2();
$('#incomecategory').select2();
$('#expensecategory').select2();

//get income category
	$.ajax({
        type: "GET",
        url: incomecategory,
        dataType: "json",
        success: function (html) {
			var objs = html.data;
			jQuery.each(objs, function (index, record) {
                var id = decodeURIComponent(record.id);
                var name = decodeURIComponent(record.name);
				//alert(name);
                $("#incomecategory").append($("<option></option>")
                    .attr("value",id)
                    .text(name));
                $("#editcategory").append($("<option></option>")
                    .attr("value",id)
                    .text(name));                  
            });
        },
    });
	
	//get expense category
	$.ajax({
        type: "GET",
        url: expensecategory,
        dataType: "json",
        success: function (html) {
			var objs = html.data;
			jQuery.each(objs, function (index, record) {
                var id = decodeURIComponent(record.id);
                var name = decodeURIComponent(record.name);
                $("#expensecategory").append($("<option></option>")
                    .attr("value",id)
                    .text(name));
                $("#editcategory").append($("<option></option>")
                    .attr("value",id)
                    .text(name));                      
            });
        },
    });

});