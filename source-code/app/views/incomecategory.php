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
         $Nav->activeMenu = "incomecategory";
         require_once(APPPATH.'/views/fragments/navigation.fragment.php'); ?>
      <!-- END left screen -->


      
      <div class="main-panel"><!-- right screen -->

         <!-- top navigation bar -->
         <?php require_once(APPPATH.'/views/fragments/topbar.fragment.php'); ?>
         <!-- END top navigation bar -->

        
         <!-- content -->
         <?php require_once(APPPATH.'/views/fragments/incomecategory.fragment.php'); ?>
         <!-- END content -->
      </div><!-- end right screen -->


      <!-- footer -->
      <?php require_once(APPPATH.'/views/fragments/footer.fragment.php'); ?>
      <!-- END footer -->
      </div>


      <?php require_once(APPPATH.'/inc/js-locale.inc.php'); ?>
      <!-- general Script -->
      <?php require_once(APPPATH.'/views/fragments/script.fragment.php'); ?>
      <!-- End general script -->


      <!-- individual script --> 
      <script src="<?= APPURL."/assets/js/general.js?v=".VERSION ?>"></script>
      <script src="<?= APPURL."/assets/js/category.js?v=".VERSION ?>"></script>
      <script>
      $(document).ready(function() {
         var table = $('#data').DataTable( {
            ajax: {
               url: "<?= APIURL."/incomecategories"?>",
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
               { targets: 0, data: 'id', orderable: false, searchable: false, visible: false},
               { targets: 1, data: 'name'},
               { targets: 2, data: 'description'},
               { targets: 3, data: 'color', orderable: false, searchable: false, render: function (data, type, row) {
                  return `<span class="label" style= width:70px;background:${data}>&nbsp;&nbsp;&nbsp;&nbsp;<span>`
               }},
               { targets: 4, data: 'id',  orderable: false, searchable: false, render: function (data, type, row) {
                  return `<a  href="#" id="btnedit" data-id="${row.id}" class="text-blue-sky" data-toggle="modal" data-target="#edit">
                              <i data-toggle="tooltip" data-placement="top" title="${__("Edit")}" class="ti-pencil"></i>
                           </a>&nbsp;&nbsp;\n\t\t\t\t
                           <a  href="javascript:void(0)" data-url="<?= APIURL."/incomecategories"?>" data-id="${row.id}" class="btndelete text-danger">
                           <i data-toggle="tooltip" data-placement="top" title="${__("Delete")}" class="ti-close"></i>
                           </a>`
               }}
            ],
         
            buttons: [
               {
                  extend: 'copy',
                  text:   '<?= __("Copy") ?>',
                  title: __('Income Category List'),
                  className: 'btn btn-sm btn-fill ',
                  exportOptions: {
                     columns: [ 1, 2]
                  }
               }, 
               {
                  extend:'csv',
                  text:   '<?= __("CSV") ?>',
                  title: __('Income Category List'),
                  className: 'btn btn-sm btn-fill ',
                  exportOptions: {
                     columns: [  1, 2]
                  }
               },
               {
                  extend:'pdf',
                  text:   '<?= __("PDF") ?>',
                  title: __('Income Category List'),
                  className: 'btn btn-sm btn-fill ',
                  orientation:'landscape',
                  exportOptions: {
                     columns: [  1, 2]
                  },
                  customize : function(doc){
                     doc.styles.tableHeader.alignment = 'left';
                     doc.content[1].table.widths = Array(doc.content[1].table.body[0].length + 1).join('*').split('');
                  }
               },
               {
                  extend:'print',
                  title: __('Income Category List'),
                  className: 'btn btn-sm btn-fill ',
                  text:   '<?= __("Print") ?>',
                  exportOptions: {
                     columns: [ 1, 2]
                  }
               }
            ]
         });



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



         $("#formadd").validate({
            submitHandler: function(forms) {
               var name        = $("#name").val();
               var description = $("#description").val();
               var color       = $("#color").val();
               var data = {
                  color: color,
                  name: name,
                  description: description
               };
               submitForm($(forms), $('#add'), "<?= APIURL ?>/incomecategories", "POST", data);
               return false;
            }
         });

         $("#formedit").validate({
            submitHandler: function(forms) {
               var name        = $("#editname").val();
               var description = $("#editdescription").val();
               var color       = $("#editcolor").val();
               var id          = $("#idedit").val();

               var data = {
                  color: color,
                  name: name,
                  description: description
               };
               submitForm($(forms), $('#edit'), "<?= APIURL ?>/incomecategories/" + id, "PUT", data);
               return false;
            }
         });

         $('#edit').on('show.bs.modal', function(e) {
            var $modal = $(this),
            id = $(e.relatedTarget).data('id');

            $modal.find(".modal-content").addClass("loading");
            $.ajax({
               type: "GET",
               url: "<?= APIURL ?>/incomecategories/" + id,
               success: function(resp) {
                  $modal.find(".modal-content").removeClass("loading");
                  if(resp.result){
                     $("#idedit").val(id);
                     $("#editname").val(resp.data.name);
                     $("#editdescription").val(resp.data.description);
                     $("#editcolor").val(resp.data.color.replace("#",''));
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