<!DOCTYPE html>
<html id="locale" lang="<?= ACTIVE_LANG ?>">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="description" content="<?= $Settings->get("site_description") ?>">
      <meta name="keywords" content="<?= $Settings->get("site_keywords") ?>">
      <link rel="icon" href="<?= $Settings->get("logomark") ? $Settings->get("logomark") : APPURL."/assets/img/logomark.png" ?>" type="image/x-icon">
      <link rel="shortcut icon" href="<?= $Settings->get("logomark") ? $Settings->get("logomark") : APPURL."/assets/img/logomark.png" ?>" type="image/x-icon">
      <!-- Bootstrap core CSS     -->
      <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" />
      <link href="<?= APPURL."/assets/css/bootstrap-datepicker.css?v=".VERSION ?>" rel="stylesheet">
      <!--  Paper Dashboard core CSS    -->
      <link href="<?= APPURL."/assets/css/paper-dashboard.css?v=".VERSION ?>" rel="stylesheet"/>
      <!--  Datatables    -->
      <link href="<?= APPURL."/assets/plugin/datatables/css/dataTables.bootstrap.css?v=".VERSION ?>" rel="stylesheet"/>
      <!--  Fonts and icons     -->
      <link href="<?= APPURL."/assets/css/font-awesome.min.css?v=".VERSION ?>" rel="stylesheet">
      <link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>
      <link href="<?= APPURL."/assets/css/themify-icons.css?v=".VERSION ?>"  rel="stylesheet">
      <link href="<?= APPURL."/assets/css/select2.min.css?v=".VERSION ?>"  rel="stylesheet">
      <link href="<?= APPURL."/assets/plugin/datatables/css/buttons.dataTables.min.css?v=".VERSION ?>"  rel="stylesheet">
      <link href="<?= APPURL."/assets/plugin/datatables/css/buttons.bootstrap.min.css?v=".VERSION ?>"  rel="stylesheet">
      <link href="<?= APPURL."/assets/plugin/morris/morris.css?v=".VERSION ?>"  rel="stylesheet">
      <link href="<?= APPURL."/assets/plugin/fullcalendar2/main.css?v=".VERSION ?>"  rel="stylesheet">
      <title><?= $Settings->get("site_name"). " - ".$Settings->get("site_slogan") ?></title>
   </head>
   <body>
      <!-- left screen -->
      <?php
	  	 $Nav = new stdClass;
		 		$Nav->activeMenu = "report"; 
         require_once(APPPATH.'/views/fragments/navigation.fragment.php');
        ?>
      <!-- END left screen -->

      <!-- right screen  -->
      <div class="main-panel">

         <!-- top navigation bar -->
         <?php require_once(APPPATH.'/views/fragments/topbar.fragment.php'); ?>
         <!-- END top navigation bar -->

        
        <!-- content -->
        <?php require_once(APPPATH.'/views/fragments/reportexpense.fragment.php'); ?>
        <!-- end Content -->


         <?php require_once(APPPATH.'/inc/js-locale.inc.php'); ?>
         <!-- general Script -->
         <?php require_once(APPPATH.'/views/fragments/script.fragment.php'); ?>
         <!-- End general script -->
         <!-- individual script -->
         <script src="<?= APPURL ."/assets/js/general.js?v=".VERSION ?>"></script>
         <script src="<?= APPURL ."/assets/js/expense.js?v=".VERSION ?>"></script>
         <script src="<?= APPURL ."/assets/js/account.js?v=".VERSION ?>"></script>
         <script src="<?= APPURL ."/assets/js/category.js?v=".VERSION ?>"></script>
         <script>
            $(document).ready(function() {	
				
            	//expense total
            	$.ajax({
                    type: "GET",
                    url: "<?= APIURL."/transactions/expense/gettotal" ?>",
                    dataType: "json",
                    success: function (resp) {
            					$("#totalyear").html(resp.data.totalbalance);
                    },
										error: function(err)
										{
											console.log(err);
										}
                });
            
            
            	//reset form
                $("#reset").click(function(e) {
                	e.preventDefault();
                	
            	    $("#form").find("input").val("");
            	    $('select').val('');
            	});
            	

            	//get data
                var table = $('#data').DataTable( {
            			searching : false,
                  ajax: {
            				url : "<?= APIURL."/report/transactions" ?>",
										data: {
											type: "expense"
										},
            				data: function (d) {
            					d.type 		= '1';
            					d.category = $('select[name=category]').val();
            					d.search = $('input[name=name]').val();
											d.account = $('select[name=expenseaccount]').val();
            					d.fromdate = $('input[name=fromdate]').val();
            					d.todate = $('input[name=todate]').val();
											
            					d.search = d.search.value;
											d.order ={
													column: d.columns[d.order[0].column].data,
													dir: d.order[0].dir
											}
											delete d.columns;
            				},
										dataFilter: function(d){
											var json = JSON.parse(d);
											var data = {};
											if(json.result){
													data.data = json.data;
													data.recordsTotal = json.summary.total_count;
													data.recordsFiltered = json.summary.total_count;
											}else{
													data.data = [];
													data.recordsTotal = 0;
													data.recordsFiltered = 0;
													Swal.fire(__('Oops...'), json.msg, 'error');
											}
											return JSON.stringify(data);
                  	}
            			},
            			
            			columnDefs: [
            				{ targets: 0, data: 'name', name:'name'},
            				{ targets: 1, data: 'category.name', name:'category'},
            				{ targets: 2, data: 'account.name', name:'account'},				
            				{ targets: 3, data: 'amount', name:'amount', render: function (data, type, row) {
                     return currency + " " + data.toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")
                  	}},	
            				{ targets: 4, data: 'transactiondate', name:'transactiondate'}
            			],
            
            			buttons: [
            				{
            					extend: 'copy',
            					text:   '<?= __("Copy") ?>',
            					title: '<?= __("Expense Reports") ?>',
            					className: 'btn btn-sm btn-fill ',
            					exportOptions: {
            						columns: [ 0, 1, 2, 3, 4, 5]
            					}
            				}, 
            				{
            					extend:'csv',
            					text:   '<?= __("CSV") ?>',
            					title: '<?= __("Expense Reports")?>',
            					className: 'btn btn-sm btn-fill ',
            					exportOptions: {
            						columns: [ 0, 1, 2, 3, 4, 5 ]
            					}
            				},
            				{
            					extend:'pdf',
            					text:   '<?= __("PDF") ?>',
            					title: '<?= __("Expense Reports") ?>',
            					className: 'btn btn-sm btn-fill ',
            					orientation:'landscape',
            					exportOptions: {
            						columns: [0, 1, 2, 3, 4, 5]
            					},
            					customize : function(doc){
            						doc.styles.tableHeader.alignment = 'left';
            						doc.content[1].table.widths = Array(doc.content[1].table.body[0].length + 1).join('*').split('');
            					}
            				},
            				{
            					extend:'print',
            					title: '<?= __("Expense Reports")?>',
            					text:   '<?= __("Print") ?>',
            					className: 'btn btn-sm btn-fill ',
            					exportOptions: {
            						columns: [ 0, 1, 2, 3, 4, 5 ]
            					}
            				}
            			]
                } );
            	//do search
            	$('#form').on('submit', function(e) {
                    table.draw();
                    e.preventDefault();
                });
            
				
							let currency = " <?= $Settings->get("currency") ?>";
            	
            	//expense graph
            	$.ajax({
                    type: "GET",
                    url: "<?= APIURL."/home/incomevsexpense?type=expense&date=month" ?>",
                    dataType: "json",
                    data: {},
                    success: function (resp) {
            			var cchart1 = document.getElementById("chart1");
            			var chart1 = new Chart(cchart1, {
            				type: 'line',
            				legendPosition: 'bottom',
            				data: {
            					labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
            					datasets: [
            					{
            						label: 'Expense',
            						data: resp.expense.map(item => item.value),
            						backgroundColor: '#41D5E2',
            						borderColor: '#41D5E2',
            						borderWidth: 1
            					}
            					]
            				},
            				options: {
            					 pieceLabel: {
            					  // render 'label', 'value', 'percentage' or custom function, default is 'percentage'
            					  render: 'label'
            					 }, 
            					legend: {
            						   position: 'bottom',
            						},
            					tooltips: {
            							mode: 'index',
            							intersect: false,
            							callbacks: {
            								label: function(tooltipItem, data) {
            									return tooltipItem.yLabel.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") + currency;
            								},
            							}
            						},
            					hover: {
            							mode: 'nearest',
            							intersect: true
            						},
            					scales: {
            						yAxes: [{
            							ticks: {
            								beginAtZero:true,
            								callback: function(value, index, values) {
            								  if(parseInt(value) >= 1000){
            									return  value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") + currency;
            								  } else {
            									return  value + currency;
            								  }
            								}
            							}
            						}]
            					}
            				}
            			});
            			
                    },
                });
            	
            	//expensebycategory
            	$.ajax({
								type: "GET",
								url: "<?= APIURL."/home/category/expense" ?>",
								data: { 
									date: "year"
								},
								dataType: "json",
								success: function (resp) {
									var data = resp.data;
            			var label = [];
            			var amount = [];
            			var color = [];
            			
            			for(var i in data) {
										label.push(data[i].name);
										amount.push(data[i].amount);
										color.push(data[i].color);
									}
            			
            			var cchart2 = document.getElementById("chart2");
            			var chart2 = new Chart(cchart2, {
            				type: 'bar',
            				legendPosition: 'bottom',
            				data: {
            					labels: label,
            					datasets: [
            					{
            						label: 'Category',
            						data: amount,
            						backgroundColor: '#41D5E2',
            						borderColor: '#41D5E2',
            						borderWidth: 1
            					}
            					]
            				},
            				options: {
            					legend: {
            						   position: 'bottom',
            					},
            					tooltips: {
            					  callbacks: {
            						title: function(tooltipItem, data) {
            						  return data['labels'][tooltipItem[0]['index']];
            						},
            						label: function(tooltipItem, data) {
            						  return data['datasets'][0]['data'][tooltipItem['index']].toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") + currency;
            						}
            					  },
            					}
            				}
            			});
            		}
            	});	
            		
            } );
            
            
            
         </script>
         <!-- footer -->
         <?php require_once(APPPATH.'/views/fragments/footer.fragment.php'); ?>
         <!-- END footer -->
      </div>
   </body>
</html>