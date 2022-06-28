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
            $Nav->activeMenu = "users";
            require_once(APPPATH.'/views/fragments/navigation.fragment.php');
      ?>
      <!-- END screen -->

      <!-- right screen -->
      <div class="main-panel">


         <!-- top navigation bar -->
         <?php require_once(APPPATH.'/views/fragments/topbar.fragment.php'); ?>
         <!-- END top navigation bar -->


         
         <!-- content -->
         <?php require_once(APPPATH.'/views/fragments/user.fragment.php'); ?>
         <!-- END content -->




         <!-- footer -->
         <?php require_once(APPPATH.'/views/fragments/footer.fragment.php'); ?>
         <!-- END footer -->
         
      </div>
      <!-- END right screen -->



      <?php require_once(APPPATH.'/inc/js-locale.inc.php'); ?>
      <!-- general Script -->
		<?php require_once(APPPATH.'/views/fragments/script.fragment.php');
      ?>
      <!-- End general Script -->

      
      <!-- individual script --> 
      <script src="<?= APPURL."/assets/js/category.js?v=".VERSION ?>"></script>
      <script src="<?= APPURL."/assets/js/account.js?v=".VERSION ?>"></script>
      <script src="<?= APPURL."/assets/js/general.js?v=".VERSION ?>"></script>
      <script>
      $(document).ready(function() {


         /**
          * @author Phong
          * SAVE INCOME TRANSACTION - CODE: 1
          */
         $("#formadduser").validate({
               rules: {
                  
               },
               /**Step 1 */
               submitHandler: function(forms) {
                  var email 		   = $("#email").val();
                  var firstname 		= $("#firstname").val();
                  var lastname 	   = $("#lastname").val();
                  var account_type 	= $("#account_type").val();
                  var is_active 	   = $("#is_active").val();



                  /**Step 2 */
                  var data = {
                     email: email,
                     firstname: firstname,
                     lastname: lastname,
                     account_type: account_type,
                     is_active: is_active
                  };
                  
                  console.log(data);

                  /**Step 3 */
                  $.ajax({
                     type: "POST",
                     url: "<?= APIURL."/users" ?>",
                     data: data,
                     dataType: 'JSON',
                     success: function(resp){
                       console.log(resp);
                       if( resp.result == 1)
                       {
                           Swal.fire(__('Success'), resp.msg, 'success');
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
      } );


      </script>
      <!-- End individual script --> 
   </body>
</html>