
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?= $Settings->get("site_description") ?>">
    <meta name="keywords" content="<?= $Settings->get("site_keywords") ?>">

    <link rel="icon" href="<?= $Settings->get("logomark") ? $Settings->get("logomark") : APPURL."/assets/img/logomark.png" ?>" type="image/x-icon">
    <link rel="shortcut icon" href="<?= $Settings->get("logomark") ? $Settings->get("logomark") : APPURL."/assets/img/logomark.png" ?>" type="image/x-icon">

    <title class="company"><?= __("Password Reset") ?></title>

	  <!-- Bootstrap core CSS     -->
    <link href="<?= APPURL."/assets/css/bootstrap.min.css?v=".VERSION ?>" rel="stylesheet" />
    <link href="<?= APPURL."/assets/plugin/sweetalert2/sweetalert2.min.css?v=".VERSION ?>"  rel="stylesheet">
	  <link href="<?= APPURL."/assets/css/login.css?v=".VERSION ?>" rel="stylesheet" />

    <!--  Paper Dashboard core CSS    -->
    <link href="<?= APPURL."/assets/css/paper-dashboard.css?v=".VERSION ?>" rel="stylesheet"/>
    <script src="<?= APPURL."/assets/js/jquery-3.5.1.min.js?v=".VERSION ?>"></script>
    <script src="<?= APPURL."/assets/plugin/jqueryvalidation/jquery.validate.js?v=".VERSION ?>"></script>
    <script src="<?= APPURL."/assets/plugin/sweetalert2/sweetalert2.min.js?v=".VERSION ?>"></script>

<body class="login-background">
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3" style="margin-top:15%">
            <div class="panel panel-default">
               <div class="header">
						<div class="row">
							<div class="col-lg-12">
							  <h3 class="title text-center"><?= __("Password Reset") ?></h3>
                </div>
              </div>
                </div>
                <div class="panel-body">

                    <form class="form-horizontal" id="form-reset" method="POST" action="<?= APIURL."/recovery/".$Route->params->id.".".$Route->params->hash ?>">
                        <div class="form-group">
                            <div class="col-md-9 col-md-offset-2">
							                  <label for="password" class="control-label"><?= __('New Password') ?></label>
                                <input id="password" type="password" class="form-control" name="password" value="<?= htmlchars(Input::Post("password")) ?>" required autofocus>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-9 col-md-offset-2">
							                  <label for="password-confirm" class="control-label"><?= __('Password confirm') ?></label>
                                <input id="password-confirm" type="password" class="form-control" name="password-confirm" value="<?= htmlchars(Input::Post("password-confirm")) ?>" required autofocus>
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-2">
                                <button type="submit" class="btn btn-fill btn-primary text-center">
                                  <?= __("Reset Password") ?>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require_once(APPPATH.'/inc/js-locale.inc.php'); ?>
<script>
  $(document).ready(function() {
    $("#form-reset").validate({
            submitHandler: function(forms) {
              $form = $(forms);
              $.ajax({
                type: "POST",
                url: $form.attr("action"),
                data: $form.serialize(),
                dataType: "JSON",
                success: function(resp) {
                  if(resp.result == 1){
                    Swal.fire(__('Success'), resp.msg, 'success');
                  }else{
                    Swal.fire(__('Fail'), resp.msg, 'error');
                  }
                }, 
                error: function(err) {
                  Swal.fire(__('Oops...'), __("Oops! An error occured. Please try again later!"), 'error');
                }
              });
              return false;
            }
         });
  });
</script>
</body>
</html>
