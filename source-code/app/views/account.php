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
         $Nav->activeMenu = "accounts";
         require_once(APPPATH.'/views/fragments/navigation.fragment.php'); ?>
      <!-- END left screen -->
      <!-- right screen -->
      <div class="main-panel">
        
         <!-- top navigation bar -->
         <?php require_once(APPPATH.'/views/fragments/topbar.fragment.php'); ?>
         <!-- END top navigation bar -->


         <?php require_once(APPPATH.'/views/fragments/account.fragment.php'); ?>
      </div>
      <!-- End right screen -->


      <!-- footer -->
      <?php require_once(APPPATH.'/views/fragments/footer.fragment.php'); ?>
      <!-- End footer -->
      </div>


      <?php require_once(APPPATH.'/inc/js-locale.inc.php'); ?>
      <!-- Script -->
      <?php require_once(APPPATH.'/views/fragments/script.fragment.php'); ?>
      <!-- End Script -->

      <!-- individual script --> 
      <script src="<?= APPURL."/assets/js/general.js?v=".VERSION ?>"></script>
      <script src="<?= APPURL."/assets/js/account.js?v=".VERSION ?>"></script>
      <script>
      $(document).ready(function() {
        var id = $("#idbank").val();
        $.ajax({
            type: "GET",
            url: "<?= APIURL ."/accounts/".$accountid ?>",
            dataType: "json",
            success: function(resp) {
                $(".accountnumber").html(resp.data.accountnumber);
                $(".bankname").html(resp.data.name);
                $(".accountbalance").html(numberWithCommas(resp.data.balance));

            },
        });

        $.ajax({
            type: "GET",
            url: "<?= APIURL ."/accounts/accountbalancebymonth/".$accountid ?>",
            dataType: "json",
            success: function(resp) {
                if(!resp.result){
                    Swal.fire(__('Oops...'), json.msg, 'error');
                    return;
                }
                var data = resp.data;
                var cincomevsexpense = document.getElementById("accountgraph");
                var incomevsexpense = new Chart(cincomevsexpense, {
                    type: 'line',
                    legendPosition: 'bottom',
                    data: {
                        labels: [__("Jan"), __("Feb"), __("Mar"), __("Apr"), __("May"), __("Jun"), __("Jul"), __("Aug"), __("Sep"), __("Oct"), __("Nov"), __("Dec")],
                        datasets: [{
                            label: "Balance",
                            data: [data.jan, data.feb, data.mar, data.apr, data.may, data.jun, data.jul, data.aug, data.sep, data.oct, data.nov, data.dec],
                            backgroundColor: '#28a745',
                            borderColor: '#28a745',
                            borderWidth: 3
                        }]
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
                                    return currency + tooltipItem.yLabel.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
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
                                    beginAtZero: true,
                                    callback: function(value, index, values) {
                                        if (parseInt(value) >= 1000) {
                                            return currency + value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
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

        //load data
        //get data
        var table = $('#data').DataTable({

            bFilter: false,
            ajax: {
                url: "<?= APIURL ."/accounts/getaccounttransaction/".$accountid ?>",
                data: function(d) {
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
            columnDefs: [{
                    targets: 0, 
                    data: 'transactiondate',
                    name: 'transactiondate'
                },
                {
                    targets: 1,
                    data: 'name',
                    name: 'name'
                },
                {
                    targets: 2,
                    data: 'category.name',
                    name: 'category.name'
                },
                {
                    targets: 3,
                    data: 'reference',
                    name: 'reference'
                },
                {
                    targets: 4,
                    data: 'description',
                    name: 'description'
                },
                {
                    targets: 5,
                    data: 'income',
                    name: 'income', render: function (data, type, row) {
                        return `<p class="text-success">${currency + " " +data.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")}</p>`
                    }
                },
                {
                    targets: 6,
                    data: 'expense',
                    name: 'expense', render: function (data, type, row) {
                        return `<p class="text-success">${currency + " " +data.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")}</p>`
                    }
                }
            ],

            buttons: [{
                    extend: 'copy',
                    text: '<?= __("Copy") ?>',
                    title: '<?= __("Account Transaction Reports") ?>',
                    className: 'btn btn-sm btn-fill ',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7]
                    }
                },
                {
                    extend: 'csv',
                    text: '<?= __("CSV") ?>',
                    title: '<?= __("Account Transaction Reports") ?>',
                    className: 'btn btn-sm btn-fill ',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7]
                    }
                },
                {
                    extend: 'pdf',
                    text: '<?= __("PDF") ?>',
                    title: '<?= __("Account Transaction Reports") ?>',
                    className: 'btn btn-sm btn-fill ',
                    orientation: 'landscape',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7]
                    },
                    customize: function(doc) {
                        doc.styles.tableHeader.alignment = 'left';
                        doc.content[1].table.widths = Array(doc.content[1].table.body[0].length + 1).join('*').split('');
                    }
                },
                {
                    extend: 'print',
                    title: '<?= __("Account Transaction Reports") ?>',
                    text: '<?= __("Print") ?>',
                    className: 'btn btn-sm btn-fill ',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7]
                    }
                }
            ]
        });

      });
      </script>
      <!-- End individual script --> 
   </body>
</html>