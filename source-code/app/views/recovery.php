
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

    <title class="company"><?= __("Password Recovery") ?></title>

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
							  <h3 class="title text-center"><?= __("Password Recovery") ?></h3>
                </div>
              </div>
                </div>
                <div class="panel-body" id="recovery">
                  <div class="alert alert-info" role="alert"><?= __("Enter your registration email address to receive password reset instructions.") ?></div>
                  <form class="form-horizontal" id="form-recovery" method="POST" action="<?= APIURL."/recovery" ?>">
                        <div class="form-group">
                            <div class="col-md-9 col-md-offset-2">
							                  <label for="email" class="control-label"><?= __('Your e-mail address') ?></label>
                                <input id="email" type="email" class="form-control" name="email" value="<?= htmlchars(Input::Post("email")) ?>" required autofocus>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-2">
                                <button type="submit" class="btn btn-fill btn-primary text-center">
                                <?= __("Submit") ?> 
                                </button>
                            </div>
                        </div>
                    </form>
                    
                </div>
                <!-- OTP -->
              <div class="panel-bopy" id="code"  style="display:none;" >   
                <div class="alert alert-info" role="alert"><p style="text-align:center"><?= __("Enter your code you received in your email.") ?></div> </p>
                  <form class="form-horizontal" id="form-code" method="POST" action="<?= APIURL."/reset/"?>">
                        <input type="hidden" value="" name="email">
                        <input type="hidden" value="check" name="action">
                        <div class="form-group row">
                            <div class="col-md-9 col-md-offset-2">
							                  <label for="code" class="control-label"><?= __('Enter code') ?></label>
                                <input id="code" type="text" class="form-control input-code" name="code" value="" required autofocus/>
                                <div style="display:inline-block">Time left = <span id="timer"></span></div>
                                <button id="resend-btn" style="padding: 1px 6px; margin-top:5px; display:none;" class="btn btn-primary pull-right ">Resend</button>
                            </div>
                        </div>                                        
                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-2">
                                <button type="submit" class="btn btn-fill btn-primary text-center">
                                <?= __("Send OTP") ?>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- RESET PASSWORD -->
                <div class="panel-bopy" id="reset"  style="display:none;" >   
                <div class="alert alert-info" role="alert"><p style="text-align:center"><?= __("Enter new password.") ?></div> </p>
                  <form class="form-horizontal" id="form-reset" method="POST" action="<?= APIURL."/reset/"?>">
                      <input type="hidden" value="" name="email">
                      <input type="hidden" value="reset" name="action">
                      <input type="hidden" value="" name="hash">
                      <div class="form-group">
                          <div class="col-md-9 col-md-offset-2">
                              <label for="password" class="control-label"><?= __('New Password') ?></label>
                              <input id="password" type="password" class="form-control" name="password" value="" required autofocus>
                          </div>
                      </div>
                      <div class="form-group">
                          <div class="col-md-9 col-md-offset-2">
                              <label for="password-confirm" class="control-label"><?= __('Password confirm') ?></label>
                              <input id="password-confirm" type="password" class="form-control" name="password-confirm" value="" required autofocus>
                          </div>
                      </div>
                      <div class="form-group">
                            <div class="col-md-8 col-md-offset-2">
                      <button type="submit" class="btn btn-fill btn-primary text-center">
                                <?= __("Change password") ?>
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
    $("#form-recovery").validate({
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
                    $("#recovery").hide();
                    $("#code").show();
                    $("#code input[name='email']").val(resp.email);

                    //  timer 60s 
                    document.getElementById('timer').innerHTML =
                      01 + ":" + 00;
                    startTimer();


                    function startTimer() {
                      var presentTime = document.getElementById('timer').innerHTML;
                      var timeArray = presentTime.split(/[:]+/);
                      var m = timeArray[0];
                      var s = checkSecond((timeArray[1] - 1));
                      if(s==59){m=m-1}
                      if(m<0){
                        $("#resend-btn").show();
                        return
                      }
                      
                      document.getElementById('timer').innerHTML =
                        m + ":" + s;
                      console.log(m)
                      setTimeout(startTimer, 1000);
                      
                    }

                    function checkSecond(sec) {
                      if (sec < 10 && sec >= 0) {sec = "0" + sec}; // add zero in front of numbers < 10
                      if (sec < 0) {sec = "59"};
                      return sec;
                    }

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




         
         $("#form-code").validate({
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
                    // an form, hien thong bao;
                    $("#code").hide();
                    $("#reset").show();
                    $("#reset input[name='email']").val(resp.email);
                    $("#reset input[name='hash']").val(resp.hash);

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
                    // an form, hien thong bao;
                    window.location.replace('<?=APPURL?>');


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
