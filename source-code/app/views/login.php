
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

    <title class="company"><?= __("Login") ?></title>

	  <!-- Bootstrap core CSS     -->
    <link href="<?= APPURL."/assets/css/bootstrap.min.css?v=".VERSION ?>" rel="stylesheet" />

	<link href="<?= APPURL."/assets/css/login.css?v=".VERSION ?>" rel="stylesheet" />

    <!--  Paper Dashboard core CSS    -->
    <link href="<?= APPURL."/assets/css/paper-dashboard.css?v=".VERSION ?>" rel="stylesheet"/>
    <script src="<?= APPURL."/assets/js/jquery-3.5.1.min.js?v=".VERSION ?>"></script>
    <script src="<?= APPURL."/assets/js/bootstrap.min.js?v=".VERSION ?>"></script>

<body class="login-background">
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3" style="margin-top:15%">
            <div class="panel panel-default">
               <div class="header">
						<div class="row">
							<div class="col-lg-12">
							<h3 class="title text-center"><?= __("Login") ?></h3>
							</div>
						</div>
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="<?= APPURL."/login" ?>">
                    <input type="hidden" name="action" value="login">
                        <?php if (Input::post("action") == "login"): ?>
                            <p class="bg-danger text-center" style="padding: 10px"><?= __("Login credentials didn't match!") ?></p>
                        <?php endif; ?>

                        <div class="form-group">
                           
                            <div class="col-md-9 col-md-offset-2">
							    <label for="username" class="control-label"><?= __("Email") ?></label>
                                <input id="username" type="email" class="form-control" name="username" value="<?= htmlchars(Input::Post("username")) ?>" required autofocus>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-9 col-md-offset-2">
                                <label for="password" class="control-label"><?= __("Password") ?></label>
                                <input id="password" type="password" class="form-control" name="password" value="" required>
                                <a class="pull-right" href="<?= APPURL."/recovery/"?>">Forgot password ?</a>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-2">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" value="1" <?= Input::post("remember") ? "checked" :"" ?>> <?= __("Remember Me") ?>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-2">
                                <button type="submit" class="btn btn-fill btn-primary text-center">
                                     <?= __("Login") ?>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>


</html>
