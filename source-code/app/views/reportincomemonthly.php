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
      <!-- right screen -->
      <div class="main-panel">
         <!-- top navigation bar -->
         <?php require_once(APPPATH.'/views/fragments/topbar.fragment.php'); ?>
         <!-- END top navigation bar -->  
         
         <!-- content -->
         <?php require_once(APPPATH.'/views/fragments/reportincomemonthly.fragment.php'); ?>
         <!-- end content -->

         <?php require_once(APPPATH.'/inc/js-locale.inc.php'); ?>
      <!-- general Script -->
      <?php require_once(APPPATH.'/views/fragments/script.fragment.php');
      ?>

         <script src="<?= APPURL."/assets/js/general.js?v=".VERSION ?>" ></script>
         <script>
            $(document).ready(function() {
            	//get data
                var table = $('#monthlyreportsincome').DataTable( {
            			
            			processing: true,
            			serverSide: true,
            			bFilter : false,
                  ajax: {
            				url : "<?= APIURL ?>/report/categorymonthly",	
										data: function (d) {
                     d.search = d.search.value;
                     d.order ={
                        column: d.columns[d.order[0].column].data,
                        dir: d.order[0].dir
                     }
                     delete d.columns;
										 d.type = 1;
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
            				{ targets: 0 ,data: 'category', name:'category', render: function (data, type, row) {
                     return `<p class=" mb-0 netincome"><strong>${data}</strong></p>`
                  	}},
            				{ targets: 1 ,data: 'jan', name:'jan', render: function (data, type, row) {
                     return `${currency} ${data.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")}`
                  	}},
            				{ targets: 2 ,data: 'feb', name:'feb', render: function (data, type, row) {
                     return `${currency} ${data.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")}`
                  	}},
            				{ targets: 3 ,data: 'mar', name:'mar', render: function (data, type, row) {
                     return `${currency} ${data.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")}`
                  	}},				
            				{ targets: 4 ,data: 'apr', name:'apr', render: function (data, type, row) {
                     return `${currency} ${data.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")}`
                  	}},		
            				{ targets: 5 ,data: 'may', name:'may', render: function (data, type, row) {
                     return `${currency} ${data.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")}`
                  	}},
            				{ targets: 6 ,data: 'jun', name:'jun', render: function (data, type, row) {
                     return `${currency} ${data.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")}`
                  	}},
            				{ targets: 7 ,data: 'jul', name:'jul', render: function (data, type, row) {
                     return `${currency} ${data.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")}`
                  	}},
            				{ targets: 8 ,data: 'aug', name:'aug', render: function (data, type, row) {
                     return `${currency} ${data.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")}`
                  	}},
            				{ targets: 9 ,data: 'sep', name:'sep', render: function (data, type, row) {
                     return `${currency} ${data.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")}`
                  	}},
            				{ targets: 10 ,data: 'oct', name:'oct', render: function (data, type, row) {
                     return `${currency} ${data.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")}`
                  	}},
            				{ targets: 11 ,data: 'nov', name:'nov', render: function (data, type, row) {
                     return `${currency} ${data.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")}`
                  	}},
            				{ targets: 12 ,data: 'dec', name:'dec', render: function (data, type, row) {
                     return `${currency} ${data.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")}`
                  	}},
            				{ targets: 13 ,data: 'total', name:'total', render: function (data, type, row) {
                     return `<p class=" mb-0 netincome text-green"><b>${currency} ${data.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")}</b></p>`
                  	}},
            			],
            			buttons: [
            				{
            					extend: 'copy',
            					text:   '<?= __("Copy") ?>',
            					title: '<?= __("Income Monthly Report") ?>',
            					className: 'btn btn-sm btn-fill ',
            					exportOptions: {
            						columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13]
            					}
            				}, 
            				{
            					extend:'csv',
            					text:   'CSV ',
            					title: '<?= __("Income Monthly Report") ?>',
            					className: 'btn btn-sm btn-fill ',
            					exportOptions: {
            						columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13]
            					}
            				},
            				{
            					extend:'pdf',
            					text:   '<?= __("PDF") ?>',
            					title: '<?= __("Income Monthly Report")?>',
            					className: 'btn btn-sm btn-fill ',
            					orientation:'landscape',
            					exportOptions: {
            						columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13]
            					},
            					customize : function(doc){
            						doc.styles.tableHeader.alignment = 'left';
            						doc.content[1].table.widths = Array(doc.content[1].table.body[0].length + 1).join('*').split('');
            					}
            				},
            				{
            					extend:'print',
            					title: '<?= __("Income Monthly Report") ?>',
            					text:   '<?= __("Print") ?>',
            					className: 'btn btn-sm btn-fill ',
            					exportOptions: {
            						columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13]
            					}
            				}
            			]
                } );
            	
            
            	
            		
            } );
         </script>
         <!-- footer -->
         <?php require_once(APPPATH.'/views/fragments/footer.fragment.php'); ?>
         <!-- END footer -->
      </div>
   </body>
</html>