$(document).ready(function() {
	var gettotal = $('#gettotal_income').attr("data-url");	
		//get income
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
							$(".incomeyear").html(objs.year);
						}

						
					},
			});
	});
	
	