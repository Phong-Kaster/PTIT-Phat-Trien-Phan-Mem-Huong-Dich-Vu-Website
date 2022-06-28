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
      <link href="<?= APPURL."/assets/plugin/sweetalert2/sweetalert2.min.css?v=".VERSION ?>"  rel="stylesheet">
      <title><?= $Settings->get("site_name"). " - ".$Settings->get("site_slogan") ?></title>
   </head>
   <body>
      <!-- left screen -->
      <?php 
         $Nav = new stdClass;
         $Nav->activeMenu = "report";
         require_once(APPPATH.'/views/fragments/navigation.fragment.php'); ?>
      <!-- END left screen -->
      <div class="main-panel">
         <!-- top navigation bar -->
         <?php require_once(APPPATH.'/views/fragments/topbar.fragment.php'); ?>
         <!-- END top navigation bar -->  

         <!-- content -->
         <?php require_once(APPPATH.'/views/fragments/reporttransactions.fragment.php'); ?>
         <!-- end content -->

         <?php require_once(APPPATH.'/inc/js-locale.inc.php'); ?>
         <!-- Script -->
         <?php require_once(APPPATH.'/views/fragments/script.fragment.php');
            ?>
         <!-- End Script -->
         <!-- individual script -->
         <script src="<?= APPURL."/assets/js/general.js?v=".VERSION ?>"></script> 
         <script src="<?= APPURL."/assets/js/account.js?v=".VERSION ?>"></script>
         <!-- end individual script -->
         <script>
            $(document).ready(function() {
            	let currency = "<?= $Settings->get("currency") ?>";
            	//get data
                var table = $('#data').DataTable( {
            			bFilter : false,
                    ajax: {
            				url : "<?= APIURL."/report/accounttransactions" ?>",
            				data: function (d) {
            					d.account = $('select[name=account]').val();
            					d.fromdate = $('input[name=fromdate]').val();
            					d.todate = $('input[name=todate]').val();
            					d.search = $('input[name=name]').val();
            				},
            			},
            			
            			columns: [
            				{ data: 'name', name:'name'},
            				{ data: 'category', name:'category'},
            				{ data: 'reference', name:'reference'},				
            				{ data: 'description', name:'description'},		
            				{ data: 'transactiondate', name:'transactiondate'},
            				{ data: 'income', name:'income'},
            				{ data: 'expense', name:'expense'}
            			],
            			
            
            			buttons: [
            				{
            					extend: 'copy',
            					text:   '<?= __("Copy") ?>',
            					title: '<?= __("Account Transaction Reports")  ?>',
            					className: 'btn btn-sm btn-fill ',
            					exportOptions: {
            						columns: [ 0, 1, 2, 3, 4, 5, 6, 7]
            					}
            				}, 
            				{
            					extend:'csv',
            					text:   '<?= __("CSV") ?>',
            					title: '<?= __("Account Transaction Reports") ?>',
            					className: 'btn btn-sm btn-fill ',
            					exportOptions: {
            						columns: [ 0, 1, 2, 3, 4, 5, 6, 7 ]
            					}
            				},
            				{
            					extend:'pdf',
            					text:   '<?= __("PDF") ?>',
            					title: '<?= __("Account Transaction Reports") ?>',
            					className: 'btn btn-sm btn-fill ',
            					orientation:'landscape',
            					exportOptions: {
            						columns: [0, 1, 2, 3, 4, 5, 6, 7]
            					},
            					customize : function(doc){
            						doc.styles.tableHeader.alignment = 'left';
            						doc.content[1].table.widths = Array(doc.content[1].table.body[0].length + 1).join('*').split('');
            					}
            				},
            				{
            					extend:'print',
            					title: '<?= __("Account Transaction Reports") ?>',
            					text:   'Print ',
            					className: 'btn btn-sm btn-fill ',
            					exportOptions: {
            						columns: [ 0, 1, 2, 3, 4, 5, 6, 7 ]
            					}
            				}
            			]
                } );
            	//do search
            	$('#form').on('submit', function(e) {
                    table.draw();
                    e.preventDefault();
                });
            	
            	//reset form
                $("#reset").on('click', function(e) {
                	e.preventDefault();
            	    $("#form").find("input").val("");
            	    $('select').val('');
            	});
            
            	//accountbalance
            	$.ajax({
                    type: "GET",
                    url: "<?= APIURL ."/home/accountbalance" ?>",
                    dataType: "json",
                    success: function (resp) {
            			var label = [];
            			var amount = [];			
            			for(var i = 0 ; i < resp.data.length;i++) {
            				label.push(resp.data[i].name);
            				amount.push(resp.data[i].balance);
            			}
            			
            			var caccountbalance = document.getElementById("accountbalance");
            			var accountbalance = new Chart(caccountbalance, {
            				type: 'bar',
            				legendPosition: 'bottom',
            				data: {
            					labels: label,
            					datasets: [
            					{
            						label: __('Account'),
            						data: amount,
            						backgroundColor: '#1DC873',
            						borderColor: '#1DC873',
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
            						  return currency + data['datasets'][0]['data'][tooltipItem['index']].toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
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