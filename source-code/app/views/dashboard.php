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
            $Nav->activeMenu = "dashboard";
            require_once(APPPATH.'/views/fragments/navigation.fragment.php');
      ?>
      <!-- END left screen -->

      <!-- right screen -->
      <div class="main-panel">

         <!-- top navigation bar -->
         <?php require_once(APPPATH.'/views/fragments/topbar.fragment.php'); ?>
         <!-- END top navigation bar -->


         
         <!-- content -->
         <?php require_once(APPPATH.'/views/fragments/dashboard.fragment.php'); ?>
         <!-- END content -->



         <!-- footer -->
         <?php require_once(APPPATH.'/views/fragments/footer.fragment.php'); ?>
         <!-- END footer -->

      </div>
      <!-- END right screen -->
      
		
      
      <?php require_once(APPPATH.'/inc/js-locale.inc.php'); ?>
		<!-- general Script -->
		<?php require_once(APPPATH.'/views/fragments/script.fragment.php'); ?>
      <!-- End general script -->


      <!-- individual script --> 
      <script>
         $(document).ready(function() {
            
            //accountbalance
            $.ajax({
               type: "GET",
               url: "<?= APIURL ?>/home/accountbalance",
               dataType: "json",
               success: function (resp) {
                  if(!resp.result){
                     Swal.fire(__('Oops...'), data.msg, 'error');
                     return;
                  }
                  var label = [];
                  var amount = [];
                  var color = [];
                  for(var i = 0; i < resp.data.length ;i++) {

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
                           label: "Account",
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
                           return currency+data['datasets'][0]['data'][tooltipItem['index']].toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                           }
                        },
                        }
                     }
                  });
               }
            });	
            //expensecaategory
            $.ajax({
               type: "GET",
               url: "<?= APIURL ?>/home/category/expense",
               data: { 
                  date: "month"
               },
               dataType: "json",
               success: function (resp) {
                  if(!resp.result){
                     Swal.fire(__('Oops...'), data.msg, 'error');
                     return;
                  }

                  var label = [];
                  var amount = [];
                  var color = [];
                  
                  for(var i = 0; i < resp.data.length ; i++) {
                     label.push(resp.data[i].name);
                     amount.push(resp.data[i].amount);
                     color.push(resp.data[i].color);
                  }
                  
                  var cexpensecategory = document.getElementById("expensebycategory");
                  var expensecategory = new Chart(cexpensecategory, {
                     type: 'doughnut',
                     legendPosition: 'bottom',
                     data: {
                        labels: label,
                        datasets: [
                        {
                           label: "Name",
                           data: amount,
                           backgroundColor: color,
                           borderColor: color,
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
                           return currency+data['datasets'][0]['data'][tooltipItem['index']].toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                           },
                           afterLabel: function(tooltipItem, data) {
                           var dataset = data['datasets'][0];
                           }
                        },
                        }
                     }
                  });
               },
               error: function(err)
               {
                  console.log(err);
               }
            });	
            
            //incomecategory
            $.ajax({
               type: "GET",
               url: "<?= APIURL ?>/home/category/income",
               data: { 
                  date: "month"
               },
               dataType: "json",
               success: function (resp) {
                  if(!resp.result){
                     Swal.fire(__('Oops...'), data.msg, 'error');
                     return;
                  }

                  var label = [];
                  var amount = [];
                  var color = [];
                  
                  for(var i = 0; i < resp.data.length ; i++) {
                     label.push(resp.data[i].name);
                     amount.push(resp.data[i].amount);
                     color.push(resp.data[i].color);
                  }
                  
                  var cincomebycategory = document.getElementById("incomebycategory");
                  var incomebycategory = new Chart(cincomebycategory, {
                     type: 'doughnut',
                     legendPosition: 'bottom',
                     data: {
                        labels: label,
                        datasets: [
                        {
                           label: "Category",
                           data: amount,
                           backgroundColor: color,
                           borderColor: color,
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
                           return currency+data['datasets'][0]['data'][tooltipItem['index']].toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                           },
                           afterLabel: function(tooltipItem, data) {
                           var dataset = data['datasets'][0];
                           }
                        },
                        }
                     }
                  });
               }
            });
            //incomevsexpense
            $.ajax({
               type: "GET",
               url: "<?= APIURL ?>/home/incomevsexpense?type=all&date=month",
               dataType: "json",
               success: function (resp) {
                  if(!resp.result){
                     Swal.fire(__('Oops...'), data.msg, 'error');
                     return;
                  }
                  var cincomevsexpense = document.getElementById("incomevsexpense");
                  var incomevsexpense = new Chart(cincomevsexpense, {
                     type: 'line',
                     legendPosition: 'bottom',
                     data: {
                        labels: [__("Jan"), __("Feb"), __("Mar"), __("Apr"), __("May"), __("Jun"), __("Jul"), __("Aug"), __("Sep"), __("Oct"), __("Nov"), __("Dec")],
                        datasets: [
                        {
                           label: "Income",
                           data: resp.income.map(item => item.value),
                           backgroundColor: '#41d5e2',
                           borderColor: '#41d5e2',
                           borderWidth: 1
                        },{
                           label: "Expense",
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
                                    return currency+ value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                 } else {
                                    return currency + value;
                                 }
                                 }
                              }
                           }]
                        }
                     }
                  });
                  
               },
            });

            
            //latest income 
            //get data

            $.ajax({
               type: "GET",
               url: "<?= APIURL ?>/home/latest/income",
               dataType: "JSON",
               success: function(resp) {
                  if(!resp.result){
                     Swal.fire(__('Oops...'), data.msg, 'error');
                     return;
                  }
                  var objs = resp.data;
                  jQuery.each(objs, function (index, record) {
                        
                        $(".latestincome").append(
                        '<li>'+
                           '<div class="row">'+
                              '<div class="col-md-7 col pl-5">'+
                                 '<p class="transactionname mb-0">'+record.name+'</p>'+
                                 '<p class="transactiondate">'+moment(record.transactiondate).startOf('day').fromNow()+'</p>'+
                              '</div>'+
                           '<div class="col-md-5 col">'+
                              '<p class="transactionamount">'+currency+numberWithCommas(parseFloat(record.amount).toFixed(0))+'</p>'+
                           '</div>'+
                        '</div>'+
                     '</li>');
                  });
               }
            });
            
            //latest expense 
            //get data
            $.ajax({
               type: "GET",
               url: "<?= APIURL ?>/home/latest/expense",
               dataType: "JSON",
               success: function(html) {
                  if(!html.result){
                     Swal.fire(__('Oops...'), data.msg, 'error');
                     return;
                  }
                  var objs = html.data;
                  jQuery.each(objs, function (index, record) {
                        
                        $(".latestexpense").append(
                        '<li>'+
                           '<div class="row">'+
                              '<div class="col-md-7 col pl-5">'+
                                 '<p class="transactionname mb-0">'+record.name+'</p>'+
                                 '<p class="transactiondate">'+moment(record.transactiondate).startOf('day').fromNow()+'</p>'+
                              '</div>'+
                           '<div class="col-md-5 col">'+
                              '<p class="transactionamount">'+currency+numberWithCommas(parseFloat(record.amount).toFixed(0))+'</p>'+
                           '</div>'+
                        '</div>'+
                     '</li>');
                  });
               }
            });
            
            
            

            
            //income total
            $.ajax({
               type: "GET",
               url: "<?= APIURL ?>/transactions/income/gettotal",
               dataType: "json",
               success: function (resp) {
                  if(resp.data) {
                     $(".incomeday").html(String(resp.data.today).replace(/\B(?=(\d{3})+(?!\d))/g, ","));
                     $(".incomethismonth").html(String(resp.data.month).replace(/\B(?=(\d{3})+(?!\d))/g, ","));
                  }
                  
               },
            });
            
            //expense total
            $.ajax({
               type: "GET",
               url: "<?= APIURL ?>/transactions/expense/gettotal",
               dataType: "json",
               success: function (resp) {
                  if(resp.data) {
                     $(".expenseday").html(String(resp.data.today).replace(/\B(?=(\d{3})+(?!\d))/g, ","));
                     $(".expensemonth").html(String(resp.data.month).replace(/\B(?=(\d{3})+(?!\d))/g, ","));
                  }
               },
            });

            //net balance
            //balance
            $.ajax({
               type: "GET",
               url: "<?= APIURL ?>/report/totalBalance",
               data: {
                  date: "month"
               },
               dataType: "json",
               success: function (resp) {
                  $(".totalbalance").html(resp.month);
                  
               },
            });
            
         } );



         </script>
      <!-- End individual script --> 
   </body>
</html>