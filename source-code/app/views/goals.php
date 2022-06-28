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
         $Nav->activeMenu = "goals";
         require_once(APPPATH.'/views/fragments/navigation.fragment.php'); ?>
      <!-- END left screen -->
      <div class="main-panel">
         <!-- right screen -->
         <!-- top navigation bar -->
         <?php require_once(APPPATH.'/views/fragments/topbar.fragment.php'); ?>
         <!-- END top navigation bar -->
         <!-- content -->
         <?php require_once(APPPATH.'/views/fragments/goals.fragment.php'); ?>
         <!-- END content -->
         <!-- footer -->
         <?php require_once(APPPATH.'/views/fragments/footer.fragment.php'); ?>
         <!-- END footer -->
      </div>
      <!--end right screen -->
      <?php require_once(APPPATH.'/inc/js-locale.inc.php'); ?>
      <!-- general Script -->
      <?php require_once(APPPATH.'/views/fragments/script.fragment.php'); ?>
      <!-- End general script -->
      <!-- individual script --> 
      <script src="<?= APPURL."/assets/js/general.js?v=".VERSION ?>"></script>
      <script>
         $(document).ready(function() 
         {
            
               //do save data
               $("#formadd").validate({
                  submitHandler: function(forms) {
                        var form             = $(forms);
                        var name 				= $("#name").val();
                        var balance 		   = $("#opening").val();
                        var target 			   = $("#target").val();
                        var deadline 		   = $("#tdate").val();
                        var modal            = $('#add');
                        var data = {
                           name: name,
                           balance: balance,
                           amount: target,
                           deadline: deadline
                        }
                        console.log(data);
                        form.parents(".modal-content").addClass("loading");
                        $.ajax({
                              type: "POST",
                              url: "<?= APIURL ?>/goals",
                              data: data,
                              dataType: "JSON",
                              success: function(resp) 
                              {
                                 if(resp.result == 1)
                                 {
                                    Swal.fire(__('Success'), resp.msg, 'success');
                                    modal.modal('hide');
                                    table.ajax.reload();
                                 } 
                                 else
                                 {
                                    Swal.fire(__('Fail'), resp.msg, 'error');
                                 }
                                 form.parents(".modal-content").removeClass("loading");
                              },
                              error: function(err)
                              {
                                 Swal.fire(__('Oops...'), __("Oops! An error occured. Please try again later!"), 'error')
                                 form.parents(".modal-content").removeClass("loading");
                              }
                        });
                     return false;
                  }
            });
         
               //get data
               var table = $('#data').DataTable( {
                  ajax: {
                     url: "<?= APIURL."/goals" ?>",
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
                     { targets: 0, data: 'id', orderable: false, searchable: false, visible: false },
                     { targets: 1, data: 'name' ,orderable: false},
                     { targets: 2, data: 'balance', render: function (data, type, row) {
                     return currency + " " + data.toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")
                     }},
                     { targets: 3, data: 'amount', render: function (data, type, row) {
                     return currency + " " + data.toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")
                     }},				
                     { targets: 4, data: 'remaining',  orderable: false, searchable: false, render: function (data, type, row) {
                        var target   = row.amount;
                        var deposit   = row.deposit;
                        var balance   = row.balance;
                        var totaldeposit  = deposit + balance;
                        var remaining   = target - (deposit + balance);
                        var percentage  = target > 0 ? (totaldeposit/target)*100 : 0;

                     return htmlRemaining = `<div class="progress" style="height:6px;">
                        <div class="progress-bar progress-bar-success " role="progressbar"aria-valuenow="${percentage}" aria-valuemin="0" aria-valuemax="100" style="width:${percentage}%">
                                </div>
                            </div>
                            <div class="pull-left text-primary text-bold"><small>${currency} ${totaldeposit.toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")} (${percentage.toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")}%)</small></div>
                            <div class="pull-right"><small>${currency} ${remaining.toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")}</small></div>`
                     }},					
                     { targets: 5, data: 'deadline', render: function (data, type, row) {
                        return moment(data).format("D MMM YYYY")
                     }},					
                     { targets: 6, data: 'id',  orderable: false, searchable: false , render: function (data, type, row) {
                        var target   = row.amount;
                        var deposit   = row.deposit;
                        var balance   = row.balance;
                        var remaining   = target - (deposit + balance);

                        var htmlAction = "";
                        if(remaining > 0 ){
                           htmlAction = `<a href="javascript:void(0)" id="btndeposit" data-id="${data}" class="btn btn-sm btn-success" data-toggle="modal" data-target="#deposit"><i class="ti-plus"></i> ${__("Deposit")}</a>`;
                        }else{
                           htmlAction = `<span class="label text-success">${__("Done")}</span>`;
                        }

                        return `${htmlAction}
                              <a href="javascript:void(0)" id="btnedit" data-id="${data}" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#edit"><i class="ti-pencil"></i> ${__("Edit")}</a>
                              <a href="javascript:void(0)" data-url="<?= APIURL."/goals"?>" data-id="${data}" class="btndelete btn btn-sm btn-danger" data-toggle="modal" data-target="#delete"><i class="ti-trash"></i> ${__("Delete")}</a>'`
                     }},	
                  ],
         
                  buttons: [
                     {
                        extend: 'copy',
                        text:   '<?= __("Copy") ?>',
                        title: '<?= __("Goals List") ?>',
                        className: 'btn btn-sm btn-fill ',
                        exportOptions: {
                           columns: [ 1, 2, 3, 4, 5, 6 ]
                        }
                     }, 
                     {
                        extend:'csv',
                        text:   '<?= __("CSV") ?>',
                        title: '<?= __("Goals List") ?>',
                        className: 'btn btn-sm btn-fill ',
                        exportOptions: {
                           columns: [  2, 3, 4, 5,6 ]
                        }
                     },
                     {
                        extend:'pdf',
                        text:   '<?= __("PDF") ?>',
                        title: '<?= __("Goals List") ?>',
                        orientation:'landscape',
                        className: 'btn btn-sm btn-fill ',
                        exportOptions: {
                           columns: [ 2, 3, 4, 5,6]
                        },
                        customize : function(doc){
                           doc.content[1].table.widths = Array(doc.content[1].table.body[0].length + 1).join('*').split('');
                        }
                     },
                     {
                        extend:'print',
                        title: '<?= __("Goals List") ?>',
                        text:   '<?= __("Print") ?>',
                        className: 'btn btn-sm btn-fill ',
                        exportOptions: {
                           columns: [  2, 3, 4, 5, 6 ]
                        }
                     }
                  ]
               } );
               
         
               //do save edit
               $("#formedit").validate({
                  submitHandler: function(forms) {
                        var id 				= $("#idedit").val();
                        var name 			= $("#editname").val();
                        var target 	      = $("#edittarget").val();
                        var opening       = $("#editopening").val();
                        var deadline 	   = $("#edate").val();
                        var modal         = $('#edit');
                        var form          = $(forms);
         
                        var data = {
                           name: name,
                           amount: target,
                           opening: opening,
                           deadline: deadline
                        };
                        // console.log(data);
                        form.parents(".modal-content").addClass("loading");
                        $.ajax({
                           type: "PUT",
                           url: "<?= APIURL ?>/goals/"+id,
                           dataType: "JSON",
                           data: data,
                           success: function(resp) 
                           {
                              if(resp.result == 1)
                              {
                                 Swal.fire(__('Success'), resp.msg, 'success');
                                 modal.modal('hide');
                                 table.ajax.reload();
                              } 
                              else
                              {
                                 Swal.fire(__('Fail'), resp.msg, 'error');
                              }
                              form.parents(".modal-content").removeClass("loading");
                           },
                           error: function(err)
                           {
                              Swal.fire(__('Oops...'), __("Oops! An error occured. Please try again later!"), 'error');
                              console.log(err);
                              form.parents(".modal-content").removeClass("loading");
                           }
                        });
                     return false;
                  }
            });
         
            
         
         
         
            //do save data
            $("#formdeposit").validate({
               submitHandler: function(forms) {
                     var id		= $("#iddeposit").val();
                     var deposit = $("#depositvalue").val();
                     var modal   = $('#deposit');
                     var form    = $(form);
         
                     
                     form.parents(".modal-content").addClass("loading");
                     $.ajax({
                        type: "POST",
                           url: "<?= APIURL."/goals/" ?>" + id,
                           data: {
                              deposit: deposit,
                              action: "deposit"
                           },
                           dataType: "JSON",
                           success: function(data) {
                              if(data.result == 1)
                              {
                                 Swal.fire(__('Success'), data.msg, 'success');
                                 modal.modal('hide');
                                 table.ajax.reload();
                              } 
                              else
                              {
                                 Swal.fire(__('Fail'), data.msg, 'error');
                              }  
                              form.parents(".modal-content").removeClass("loading");
                           },
                           error: function(err)
                           {
                              Swal.fire(__('Oops...'), __("Oops! An error occured. Please try again later!"), 'error');
                              form.parents(".modal-content").removeClass("loading");
                           }
                     });
                  return false;
               }
            });
               
               
            //for deposit to modal
            $('#deposit').on('show.bs.modal', function(e) {
                  var $modal = $(this),
                  id = $(e.relatedTarget).data('id');
                  $("#iddeposit").val(id);
            });
         
               
               //for get id to modal edit
         
               $('#edit').on('show.bs.modal', function(e) 
               {
                  var $modal = $(this),
                  id = $(e.relatedTarget).data('id');
                  if(!id) return;
                  $.ajax({
                     type: "GET",
                     url: "<?= APIURL ?>/goals/"+id,
                     dataType: "JSON",
                     success: function(resp) {
                        if( resp.result == 1)
                        {
                           $("#editname").val(resp.data.name);
                           $("#editopening").val(resp.data.balance);
                           $("#edittarget").val(resp.data.amount);
                           $("#edate").val(resp.data.deadline);
                           $("#idedit").val(id);
                        }
                        else
                        {
                           Swal.fire(__('Fail'), resp.msg, 'error');
                        }
                     },
                     error: function(err)
                     {
                        Swal.fire(__('Oops...'), __("Oops! An error occured. Please try again later!"), 'error')
                     }
                  });
               
               });
               
         //for balance support number only
         $('.number').keypress(function(event) {
               var $this = $(this);
               if ((event.which != 46 || $this.val().indexOf('.') != -1) &&
                  ((event.which < 48 || event.which > 57) &&
                  (event.which != 0 && event.which != 8))) {
                     event.preventDefault();
               }
         
               var text = $(this).val();
               if ((event.which == 46) && (text.indexOf('.') == -1)) {
                  setTimeout(function() {
                     if ($this.val().substring($this.val().indexOf('.')).length > 3) {
                        $this.val($this.val().substring(0, $this.val().indexOf('.') + 3));
                     }
                  }, 1);
               }
         
               if ((text.indexOf('.') != -1) &&
                  (text.substring(text.indexOf('.')).length > 2) &&
                  (event.which != 0 && event.which != 8) &&
                  ($(this)[0].selectionStart >= text.length - 2)) {
                     event.preventDefault();
               }      
            });
         
            $('.number').bind("paste", function(e) {
            var text = e.originalEvent.clipboardData.getData('Text');
            if ($.isNumeric(text)) {
               if ((text.substring(text.indexOf('.')).length > 3) && (text.indexOf('.') > -1)) {
                  e.preventDefault();
                  $(this).val(text.substring(0, text.indexOf('.') + 3));
               }
            }
            else {
                  e.preventDefault();
               }
            });
         
         $('#targetdate #tdate').datepicker({
                     autoclose: true,
                     dateFormat: "yy-mm-dd",
                     todayHighlight: true
               });	
         $('#edate').datepicker({
                     autoclose: true,
                     dateFormat: "yy-mm-dd",
                     todayHighlight: true
               });
            } );
      </script>
      <!-- End individual script --> 
   </body>
</html>