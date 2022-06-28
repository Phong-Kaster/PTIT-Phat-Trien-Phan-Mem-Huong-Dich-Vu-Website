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


         <?php require_once(APPPATH.'/views/fragments/accounts.fragment.php'); ?>
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
         //load data
         var table = $('#data').DataTable( {
               ajax: {
                  url: "<?= APIURL."/accounts" ?>",
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
                  { targets: 0, data: 'id', orderable: false, searchable: false},
                  { targets: 1, data: 'name'},
                  { targets: 2, data: 'balance', render: function (data, type, row) {
                     return currency + " " + data.toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")
                  }},
                  { targets: 3, data: 'description'},
                  { targets: 4, data: 'id',  orderable: false, searchable: false, render: function (data, type, row) {
                     return `<a href="<?= APPURL."/accounts/detail/"?>${row.id}" id="btnedit" data-id="${row.id}" class="text-success">
                     <i data-toggle="tooltip" data-placement="top" title="${__("Detail")}" class="ti-check-box"></i></a>\n\t\t\t\t\t&nbsp;&nbsp;\n\t\t\t\t
                     <a  href="#" id="btnedit" data-id="${row.id}" class="text-blue-sky" data-toggle="modal" data-target="#edit">
                              <i data-toggle="tooltip" data-placement="top" title="${__("Edit")}" class="ti-pencil"></i>
                           </a>&nbsp;&nbsp;\n\t\t\t\t
                           <a  href="javascript:void(0)" data-url="<?= APIURL."/accounts"?>" data-id="${row.id}" class="btndelete text-danger">
                           <i data-toggle="tooltip" data-placement="top" title="${__("Delete")}" class="ti-close"></i>
                           </a>`
                     }
                  }
               ],
               buttons: [
                  {
                     extend: 'copy',
                     text:   'Copy ',
                     title: __('Account List'),
                     className: 'btn btn-sm btn-fill ',
                     exportOptions: {
                        columns: [ 1, 2, 3 ]
                     }
                  }, 
                  {
                     extend:'csv',
                     text:   'CSV ',
                     title: __('Account List'),
                     className: 'btn btn-sm btn-fill ',
                     exportOptions: {
                        columns: [  1, 2, 3 ]
                     }
                  },
                  {
                     extend:'pdf',
                     text:   'PDF ',
                     title: __('Account List'),
                     orientation:'landscape',
                     className: 'btn btn-sm btn-fill ',
                     exportOptions: {
                        columns: [  1, 2, 3 ]
                     },
                     customize : function(doc){
                        doc.styles.tableHeader.alignment = 'left';
                        doc.content[1].table.widths = Array(doc.content[1].table.body[0].length + 1).join('*').split('');
                     }
                  },
                  {
                     extend:'print',
                     title: __('Account List'),
                     text:   'Print ',
                     className: 'btn btn-sm btn-fill ',
                     exportOptions: {
                        columns: [ 1, 2, 3 ]
                     }
                  }
               ]
         } );


         function submitForm(form, modal, url, method, data){
            form.parents(".modal-content").addClass("loading");
            $.ajax({
               method: method,
               url: url,
               data: data,
               dataType: "JSON",
               success: function(resp) {
                  if(resp.result == 1){
                     Swal.fire(__('Success'), resp.msg, 'success');
                     modal.modal('hide');
                     table.ajax.reload();
                  }else{
                     Swal.fire(__('Fail'), resp.msg, 'error');
                  }
                  form.parents(".modal-content").removeClass("loading");
               },
               error: function(err){
                  Swal.fire(__('Oops...'), __("Oops! An error occured. Please try again later!"), 'error')
                  form.parents(".modal-content").removeClass("loading");
               }
            });
         }

         //do save expense
         $("#formadd").validate({
            submitHandler: function(forms) {
               var name 					= $("#name").val();
               var balance 			= $("#balance").val();
               var description 	= $("#description").val();
               var accountnumber = $("#accountnumber").val();
               
               var data = {
                  name: name,
                  balance: balance,
                  description: description,
                  accountnumber: accountnumber
               };
               submitForm($(forms), $('#add'), "<?= APIURL."/accounts"?>", "POST", data);
               return false;
            }
         });


         //do edit expense
         $("#formedit").validate({
            submitHandler: function(forms) {
               var name 					= $("#editname").val();
               var balance 			= $("#editbalance").val();
               var description 	= $("#editdescription").val();
               var accountnumber = $("#editaccountnumber").val();
               var id 						= $("#idedit").val();
               
               var data = {
                  name: name,
                  balance: balance,
                  description: description,
                  accountnumber: accountnumber
               };
               submitForm($(forms), $('#edit'), "<?= APIURL."/accounts/"?>"+id, "PUT", data);
               return false;
            }
         }); 
         
         //for get id to modal edit
         $('#edit').on('show.bs.modal', function(e) {
            var $modal = $(this),
            id = $(e.relatedTarget).data('id');
            
            $modal.find(".modal-content").addClass("loading");
            $.ajax({
               type: "GET",
               url: "<?= APIURL ?>/accounts/" + id,
               dataType: "JSON",
               success: function(resp) {
                  $modal.find(".modal-content").removeClass("loading");
                  if(resp.result){
                     $("#idedit").val(id);
                     $("#editname").val(resp.data.name);
                     $("#editbalance").val(resp.data.balance);
                     $("#editdescription").val(resp.data.description);
                     $("#editaccountnumber").val(resp.data.accountnumber);
                  }else{
                     Swal.fire(__('Oops...'), resp.msg, 'error');
                  }
               },
               error: function(err){
                  $modal.find(".modal-content").removeClass("loading");
                  Swal.fire(__('Oops...'), __("Oops! An error occured. Please try again later!"), 'error');
               }
            });
         });
         
         
      });
            
            

      </script>
      <!-- End individual script --> 
   </body>
</html>