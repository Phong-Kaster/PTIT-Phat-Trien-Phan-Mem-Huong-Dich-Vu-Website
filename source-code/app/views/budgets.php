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
         $Nav->activeMenu = "budgets";
         require_once(APPPATH.'/views/fragments/navigation.fragment.php'); ?>
      <!-- END left screen -->

      <!-- right screen -->
      <div class="main-panel">
         <!-- top navigation bar -->
         <?php require_once(APPPATH.'/views/fragments/topbar.fragment.php'); ?>
         <!-- END top navigation bar -->

         <!-- content -->
         <?php require_once(APPPATH.'/views/fragments/budgets.fragment.php'); ?>
         <!-- END content -->
         
      
      
         <!-- footer -->
         <?php require_once(APPPATH.'/views/fragments/footer.fragment.php'); ?>
         <!-- END footer -->

      </div><!-- end right screen -->

      <?php require_once(APPPATH.'/inc/js-locale.inc.php'); ?>
      <!-- general Script -->
      <?php require_once(APPPATH.'/views/fragments/script.fragment.php'); ?>
      <!-- End general script -->
      <!-- individual script --> 
      <script src="<?= APPURL."/assets/js/general.js?v=".VERSION ?>"></script>
      <script>
      $(document).ready(function() {
         
         //get income category
         $.ajax({
            type: "GET",
            url: "<?= APIURL."/incomecategories" ?>",
            dataType: "json",
            success: function (html) {
               var objs = html.data;
               jQuery.each(objs, function (index, record) {
                     var id = decodeURIComponent(record.id);
                     var name = decodeURIComponent(record.name);
                  //alert(name);
                     $("#category #income").append($("<option></option>")
                        .attr("value",id)
                        .text(name));
                  $("#editcategory #income").append($("<option></option>")
                        .attr("value",id)
                        .text(name));
                  });
            },
         });

         //get expense category
         $.ajax({
            type: "GET",
            url: "<?= APIURL."/expensecategories" ?>",
            dataType: "json",
            success: function (html) {
               var objs = html.data;
               jQuery.each(objs, function (index, record) {
                     var id = decodeURIComponent(record.id);
                     var name = decodeURIComponent(record.name);
                  //alert(name);
                     $("#category #expense").append($("<option></option>")
                        .attr("value",id)
                        .text(name));
                  $("#editcategory #expense").append($("<option></option>")
                        .attr("value",id)
                        .text(name));
                  });
            },
         });


         //do save budget
         $("#formadd").validate({
            submitHandler: function(forms) {
               let $category = $("#category optgroup").find("option:selected").val();
               let $month = $("#months").val();
               let $year = $("#years").val();
               let $amount = $("#amount").val();
               let $description = $("#note").val();

               let data = {
                  category_id: $category,
                  month: $month,
                  year: $year,
                  amount: $amount,
                  description: $description
               }
               $.ajax({
                  type: "POST",
                     url: "<?= APIURL."/budgets" ?>",
                     data: data,
                     dataType: "JSON",
                     success: function(resp) 
                     {
                        if(resp.result == 0){
                           Swal.fire(__('Fail'), resp.msg, 'error');
                        }
                        if(resp.result == 1){
                           $('#add').modal('hide');
                           Swal.fire(__('Success'), resp.msg, 'success');
                           table.ajax.reload();
                        }
                     }
               });
               return false;
            }
         });


         
         //get data
         var table = $('#data').DataTable( {
               ajax: {
                  url: "<?= APIURL."/budgets" ?>",
                  data: function (d) {
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
                  {
                     targets: 0,
                     class:          "details-control",
                     orderable:      false,
                     searchable:      false,
                     data:           null,
                     defaultContent: ""
                  },
                  { targets: 1, data: 'id', orderable: false, searchable: false, visible: false},
                  { targets: 2, data: 'amount', orderable: false, searchable: false, visible: false },
                  { targets: 3, data: 'category.name', render: function (data, type, row) {
                     return row.category.type == 1 ? data + "<i style='color:green' class='ti-angle-double-up'></i>" : data + "<i style='color:red' class='ti-angle-double-down'></i>";
                  }},
                  { targets: 4, data: 'amount', orderable: false, searchable: false, visible: false, render: function (data, type, row) {
                     return currency + " " + data.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")
                  }},
                  { targets: 5, data: 'todate', render: function (data, type, row) {
                     return moment(data).format("MMM YYYY")
                  }},
                  { targets: 6, data: 'description', orderable:false},
                  { targets: 7, data: 'id',  orderable: false, searchable: false, render: function (data, type, row) {
                     return `<a  href="#" id="btnedit" data-id="${row.id}" class="text-blue-sky" data-toggle="modal" data-target="#edit">
                              <i data-toggle="tooltip" data-placement="top" title="${__("Edit")}" class="ti-pencil"></i>
                           </a>&nbsp;&nbsp;\n\t\t\t\t
                           <a  href="javascript:void(0)" data-url="<?= APIURL."/budgets"?>" data-id="${row.id}" class="btndelete text-danger">
                           <i data-toggle="tooltip" data-placement="top" title="${__("Delete")}" class="ti-close"></i>
                           </a>`
                     }
                  }
               ],
               buttons: [
                  {
                     extend: 'copy',
                     text:   '<?= __("Copy") ?>',
                     title: '<?= __("Budget List") ?>',
                     className: 'btn btn-sm btn-fill ',
                     exportOptions: {
                        columns: [ 2, 3, 4, 5, 6 ]
                     }
                  },
                  {
                     extend:'csv',
                     text:   '<?= __("CSV") ?>',
                     title: '<?= __("Budget List") ?>',
                     className: 'btn btn-sm btn-fill ',
                     exportOptions: {
                        columns: [2, 3, 4, 5, 6 ]
                     }
                  },
                  {
                     extend:'pdf',
                     text:   '<?= __("PDF") ?>',
                     title: '<?= __("Budget List") ?>',
                     orientation:'landscape',
                     className: 'btn btn-sm btn-fill ',
                     exportOptions: {
                        columns: [2, 3, 4, 5, 6 ]
                     },
                     customize : function(doc){
                        doc.styles.tableHeader.alignment = 'left';
                        doc.content[1].table.widths = Array(doc.content[1].table.body[0].length + 1).join('*').split('');
                     }
                  },
                  {
                     extend:'print',
                     text:   '<?= __("Print") ?>',
                     className: 'btn btn-sm btn-fill ',
                     exportOptions: {
                        columns: [ 3, 4, 5, 6 ]
                     }
                  }
               ]
         } );


         function format ( d ) {

         return '<div class="d-flex justify-content-between flex-sm-row flex-column">'+
                                 '<div class="pb-3 pb-md-0 " style="min-width:400px;">'+
                                    '<h4 class="mb-0">'+__('Budget Remaining') +'</h4>'+
                                    '<h3 classs="mt-0" style="margin-top:0;"><span class="currency"><?= $Settings->get("currency")?></span><span id="remainingbudget"></span></h3>'+
                                    '<div class="row">'+
                                       '<div class="col-md-6">'+
                                             '<p class="mb-0 text-blue">'+__('Planned') +'</p>'+
                                             '<p>'+d.amount+'</p>'+
                                       '</div>'+
                                       '<div class="col-md-6">'+
                                             '<p class="mb-0 text-green">'+__('Actual') +'</p>'+
                                             '<p id="actualbudget"></p>'+
                                       '</div>'+
                                    '</div>'+
                                 '</div>'+
                                 
                                 '<div class="d-flex flex-row">'+
                                    '<div id="chart"></div>'+
                                 '</div>'+
                              '</div>';




      }

         // Array to track the ids of the details displayed rows
         var detailRows = [];

         $('#data tbody').on( 'click', 'tr td.details-control', function () {
            var tr = $(this).closest('tr');
            var table = $('#data').DataTable();
            var row = table.row( tr );
            var idx = $.inArray( tr.attr('id'), detailRows );

            if ( row.child.isShown() ) {
                  tr.removeClass( 'details' );
                  row.child.hide();

                  // Remove from the 'open' array
                  detailRows.splice( idx, 1 );
            }
            else {
               tr.addClass( 'details' );
               row.child( format( row.data() ) ).show();
               var category_id = row.data().category.id;
               var date = row.data().fromdate;
               //start search by id expense/income category detail
               $.ajax({
                  type: "GET",
                  url: "<?= APIURL."/budgets/gettransactionbydate" ?>",
                  data: {
                     category_id: category_id,
                     date: moment(date).format("YYYY-MM"),
                  },
                  dataType: "JSON",
                  success: function(data) {
                     var remaining = row.data().amount - data.totalamount;
                     $("#currencybudget").html(currency);
                     $("#actualbudget").html(currency + " " + data.totalamount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
                     $("#remainingbudget").html( remaining.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ","));
                     Morris.Donut({
                        element: 'chart',
                        data: [
                           {label: __("Planned"), value: row.data().amount},
                           {label: __("Actual"), value: data.totalamount}
                        ],
                        colors: ['#3E7EFF','#1DC873']
                     });

                  }
               });
               // Add to the 'open' array
               if ( idx === -1 ) {
                  detailRows.push( tr.attr('id') );
               }
            }
         } );

         // On each draw, loop over the `detailRows` array and show any child rows
         $('#data').on( 'draw', function () {
            $.each( detailRows, function ( i, id ) {
                  $('#'+id+' td.details-control').trigger( 'click' );
            } );
         } );



         //do save edit budget
         $("#formedit").validate({
            submitHandler: function(forms) {
               var id 				= $("#idedit").val();
               let amount        = $("#editamount").val();
               let description   = $("#editnote").val();

               let data = {
                  amount: amount,
                  description: description
               }
               // console.log("save change");
               // console.log(data);
               $.ajax({
                  type: "PUT",
                     url: "<?= APIURL ?>/budgets/"+id,
                     data: data,
                     success: function(resp) 
                     {
                        if( resp.result == 1)
                        {
                           Swal.fire({
                              position: 'center',
                              icon: 'success',
                              title: resp.msg,
                              showConfirmButton: false,
                              timer: 1500
                           });
                           
                           $(".modal-header").find("button.close").click();
                           table.ajax.reload();
                       }
                       else
                       {
                           Swal.fire(__('Fail'), resp.msg, 'error');
                       }
                     },
                     error: function(err){
                        console.log(err);
                        Swal.fire(__('Oops...'), __("Oops! An error occured. Please try again later!"), 'error');
                     }
               });
               return false;
            }
         });

      } );


            //for get id to modal edit

            $('#edit').on('show.bs.modal', function(e) {
                  var $modal = $(this),
                  id = $(e.relatedTarget).data('id');

                  $.ajax({
                     type: "GET",
                     url: "<?= APIURL ?>/budgets/"+id ,
                     dataType: "JSON",
                     success: function(data) {
                        $modal.find(".modal-content").removeClass("loading");
                        if(data.result){
                           $("#expensename").val(data.budget.name);
                           $("#editamount").val(data.budget.amount);
                           $("#editnote").val(data.budget.description);
                           $("#editmonths").val(data.months);
                           $("#edityears").val(data.years);
                           $("#editcategory").val(data.budget.category.id);
                           $('#editcategory').trigger("change");
                           $("#idedit").val(id);
                        }else{
                           Swal.fire(__('Oops...'), data.msg, 'error');
                        }
                        
                     },
                     error: function(err){
                        $modal.find(".modal-content").removeClass("loading");
                        Swal.fire(__('Oops...'), __("Oops! An error occured. Please try again later!"), 'error');
                     }
                  });


            });


      </script>
      <!-- End individual script --> 
   </body>
</html>