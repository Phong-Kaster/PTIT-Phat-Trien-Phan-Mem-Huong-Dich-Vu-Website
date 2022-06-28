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
         $Nav->activeMenu = "users";
         require_once(APPPATH.'/views/fragments/navigation.fragment.php'); ?>
      <!-- END left navigation bar -->


      <!-- right screen -->
      <div class="main-panel">
         
         <!-- top navigation bar -->
         <?php require_once(APPPATH.'/views/fragments/topbar.fragment.php'); ?>
         <!-- END top navigation bar -->

         
         <!-- content - import - edit - delete data -->
         <?php require_once(APPPATH.'/views/fragments/users.fragment.php'); ?>
         <!-- End content - import - edit - delete data -->
      </div>
      <!-- End right screen -->



      <!-- footer -->
      <?php require_once(APPPATH.'/views/fragments/footer.fragment.php'); ?>
      <!-- END footer -->
      </div>


      <?php require_once(APPPATH.'/inc/js-locale.inc.php'); ?>
      <!-- general Script -->
      <?php require_once(APPPATH.'/views/fragments/script.fragment.php');
      ?>
      <!-- End general script -->

      <!-- individual script --> 
      <script src="<?= APPURL."/assets/js/general.js?v=".VERSION ?>"></script>
      <script src="<?= APPURL."/assets/js/user.js?v=".VERSION ?>"></script>
      <script>

      $(document).ready(function() {
         // jQuery data table
         //get data
         var table = $('#data').DataTable( {
                  ajax: {
                  url: "<?= APIURL."/users" ?>",
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
                     { targets: 2, data: 'account_type' ,orderable: true, searchable: true},
                     { targets: 3, data: 'firstname', orderable: true, render: function (data, type, row) {
                        return row.firstname + " " + row.lastname
                     }},
                     { targets: 4, data: 'email'},
                     { targets: 5, data: 'is_active', orderable: false, render: function (data, type, row) {
                        return row.is_active ? "<i style='color:green' class='fa fa-check-circle' aria-hidden='true'></i>" : 
                                                 "<i style='color:red' class='fa fa-times-circle' aria-hidden='true'></i>";
                     }},
                     { targets: 6, data: 'id',  orderable: false, searchable: false, render: function (data, type, row) {
                     return `<a  href="#" id="btnedit" data-id="${row.id}" class="text-blue-sky" data-toggle="modal" data-target="#edit">
                              <i data-toggle="tooltip" data-placement="top" title="${__("Edit")}" class="ti-pencil"></i>
                           </a>&nbsp;&nbsp;\n\t\t\t\t
                           <a  href="javascript:void(0)" data-url="<?= APIURL."/users"?>" data-id="${row.id}" class="btndelete text-danger">
                           <i data-toggle="tooltip" data-placement="top" title="${__("Delete")}" class="ti-close"></i>
                           </a>`
                     }
                  }
                  ],
               buttons: [
                  {
                     extend: 'copy',
                     text:   '<?= __("Copy") ?>',
                     title: '<?= __("Users") ?>',
                     className: 'btn btn-sm btn-fill ',
                     exportOptions: {
                        columns: [ 2, 3, 4, 5, 6, 7, 8  ]
                     }
                  },
                  {
                     extend:'csv',
                     text:   '<?= __("CSV") ?>',
                     title: '<?= __("Users") ?>',
                     className: 'btn btn-sm btn-fill ',
                     exportOptions: {
                        columns: [   2, 3, 4, 5, 6, 7, 8 ]
                     }
                  },
                  {
                     extend:'pdf',
                     text:   '<?= __("PDF") ?>',
                     title: '<?= __("Users") ?>',
                     orientation:'landscape',
                     className: 'btn btn-sm btn-fill',
                     exportOptions: {
                        columns: [   2, 3, 4, 5, 6, 7, 8 ]
                     },
                     customize : function(doc){
                        doc.styles.tableHeader.alignment = 'left';
                        doc.content[1].table.widths = Array(doc.content[1].table.body[0].length + 1).join('*').split('');
                     }
                  },
                  {
                     extend:'print',
                     title: '<?= __("Users") ?>',
                     text:   '<?= __("Print") ?>',
                     className: 'btn btn-sm btn-fill',
                     exportOptions: {
                        columns: [  2, 3, 4, 5, 6, 7, 8, 9 ]
                     }
                  }
               ]
         } );

         function format ( d ) {
         return '<table cellpadding="10" cellspacing="0" border="0" width="100%" class="table-detail" style="">'+

            '<tr class="table-detail" height="30">'+
                  '<td width="50"><strong>&nbsp;</td>'+
                  '<td><strong>'+__("First Name")+'</strong>:</td>'+
                  '<td><strong>'+__("Last Name")+'</strong>:</td>'+
                  '<td><strong>'+__("Create At")+'</strong>:</td>'+
            '</tr >'+
            '<tr class="" height="30">'+
                  '<td width="50"><strong>&nbsp;</td>'+
                  '<td>'+d.firstname+'</td>'+
                  '<td>'+d.lastname+'</td>' +
                  '<td>'+d.date+'</td>'+
            '</tr >'+
         '</table>';

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

         //do save income transaction changes
         $("#formedituser").validate({
            rules: {
                  incomename: {
                     required: true
                  }
               },
            submitHandler: function(forms) {
                  /**Step 1 */
                  var modal       = $('#edit');
                  var id          = $("#idedit").val();
                  let firstname   = $("#efirstname").val();
                  let lastname    = $("#elastname").val();
                  let account_type = $("#eaccount_type").val();
                  let is_active    = $("#eis_active").val();

                  /**Step 2 */
                  var data = {
                     firstname: firstname,
                     lastname: lastname,
                     account_type: account_type,
                     is_active: is_active
                  };
                  
                  /**Step 3 */
                  $.ajax({
                     type: "PUT",
                     url: "<?= APIURL."/users/" ?>"+id,
                     data: data,
                     dataType: 'JSON',
                     success: function(resp){
                       
                       if( resp.result == 1)
                       {
                           Swal.fire(__('Success'), resp.msg, 'success');
                           modal.modal('hide');
                           table.ajax.reload();
                       }
                       else
                       {
                           Swal.fire(__('Fail'), resp.msg, 'error');
                       }
                     },
                     error: function(err){
                        Swal.fire(__('Oops...'), __("Oops! An error occured. Please try again later!"), 'error');
                        console.log(err);
                     }
                  });

                  return false;
            }
         });

      });
         

      //for get id to modal edit
      $('#edit').on('show.bs.modal', function(e) {
         var $modal = $(this),
         id = $(e.relatedTarget).data('id');
         if(!id) return;
         $modal.find(".modal-content").addClass("loading");
         $.ajax({
            type: "GET",
            url: "<?= APIURL."/users/" ?>" +id,
            success: function(resp) {
               $modal.find(".modal-content").removeClass("loading");
               console.log(resp);
               
               if( resp.result == 1 )
               {
                  $("#eemail").val(resp.data.email);
                  $("#efirstname").val(resp.data.firstname);
                  $("#elastname").val(resp.data.lastname);
                  $("#eaccount_type").val(resp.data.account_type);
                  $("#eis_active").val(resp.data.is_active);
                  $("#idedit").val(resp.data.id);
               }
               else
               {
                  Swal.fire(__('Oops...'), resp.msg, 'error');
                  $modal.find(".close").click();
                  $("#eemail").val("");
                  $("#efirstname").val("");
                  $("#elastname").val("");
                  $("#eaccount_type").val("");
                  $("#eis_active").val("");
                  $("#idedit").val("");
               }
                  
            },
            error: function(err)
            {
               $modal.find(".modal-content").removeClass("loading");
               Swal.fire(__('Oops...'), __("Oops! An error occured. Please try again later!"), 'error');
               console.log(err);
            }
         });
      });

      </script>
      <!-- End individual script --> 
   </body>
</html>