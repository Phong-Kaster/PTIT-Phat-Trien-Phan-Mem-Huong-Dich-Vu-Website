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
      <!-- left navigation bar -->
      <?php
         $Nav = new stdClass;
         $Nav->activeMenu = "report"; 
         require_once(APPPATH.'/views/fragments/navigation.fragment.php'); ?>
      <!-- END left navigation bar -->
      <!-- right screen -->
      <div class="main-panel">
         <!-- top navigation bar -->
         <?php require_once(APPPATH.'/views/fragments/topbar.fragment.php'); ?>
         <!-- END top navigation bar -->

         <!-- content-->
         <?php require_once(APPPATH.'/views/fragments/reportincomevsexpense.fragment.php'); ?>
         <!-- end content-->

         <?php require_once(APPPATH.'/inc/js-locale.inc.php'); ?>
         <!-- general Script -->
         <?php require_once(APPPATH.'/views/fragments/script.fragment.php');?>
         <!-- End general script -->

         <script src="<?= APPURL ."/assets/js/general.js?v=".VERSION ?>"></script>
         <script src="<?= APPURL ."/assets/js/expense.js?v=".VERSION ?>"></script>
         <script src="<?= APPURL ."/assets/js/income.js?v=".VERSION ?>"></script>
         <script>
            $(document).ready(function() {
            
            	let currency = "<?= $Settings->get("currency") ?>";
            	
            	//balance
            	//expense total
            	$.ajax({
               type: "GET",
               url: "<?= APIURL ?>/report/totalBalance",
               data: {
                  date: "year"
               },
               dataType: "json",
               success: function (resp) {
                  $(".totalbalance").html(resp.year);
                  
               },
            });
            	
            	//incomevsexpense
            	$.ajax({
                    type: "GET",
                    url: "<?= APIURL."/home/incomevsexpense?type=all&date=month" ?>",
                    dataType: "json",
                    success: function (resp) {
            			var cincomevsexpense = document.getElementById("incomevsexpense");
            			var incomevsexpense = new Chart(cincomevsexpense, {
            				type: 'line',
            				legendPosition: 'bottom',
            				data: {
            					labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
            					datasets: [
            					{
            						label: 'Income',
            						data: resp.income.map(item => item.value),
            						backgroundColor: '#41D5E2',
            						borderColor: '#41D5E2',
            						borderWidth: 1
            					},{
            						label: 'Expense',
            						data: resp.expense.map(item => item.value),
            						backgroundColor: '#FF5668',
            						borderColor:	'#FF5668',
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
            									return currency+tooltipItem.yLabel.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","); 
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
            									return  currency+value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            								  } else {
            									return  currency+value;
            								  }
            								}
            							}
            						}]
            					}
            				}
            			});
            			
                    },
                });
            		
            } );
            
         </script>
         <!-- footer -->
         <?php require_once(APPPATH.'/views/fragments/footer.fragment.php'); ?>
         <!-- END footer -->
      </div>
   </body>
</html>