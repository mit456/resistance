<!DOCTYPE html>
<html>
    <head>
        <link href="/static/css/bootstrap3.css" rel="stylesheet" type="text/css">
        <link href="/static/css/style.css" rel="stylesheet" type="text/css">
        <script src="/static/js/jquery-1.10.2.min.js" type="text/javascript"></script>
        <script src="/static/js/jquery.validate.min.js" type="text/javascript"></script>
        <script src="/static/js/bootstrap3.min.js" type="text/javascript"></script>
        <script src="/static/js/login.js" type="text/javascript"></script>
    </head>
    <body>
        <?php include 'header.php' ?>
        <?php include 'modal.php' ?>
        <div class="container-fluid form-container" style="padding: 0px;">
            <div class="row">
                <form id ="login_form" class="form-horizontal" role="form">
                    <div class="col-md-6 col-xs-12" style="margin-top: 6%;">
                        <div class="form-group has-feedback">
                            <label for="input_email" class="col-sm-2 control-label">Email<span>*</span></label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" name="login_email" id="login_email" placeholder="Email">
                                <span class="glyphicon form-control-feedback" id="login_email_mark" style=""></span>
                            </div>
                        </div>
                        <div class="form-group has-feedback">
                            <label for="input_password" class="col-sm-2 control-label">Password<span>*</span></label>
                            <div class="col-sm-7">
                                <input type="password" class="form-control" name="login_password" id="login_password" placeholder="Password">
                                <span class="glyphicon form-control-feedback" id="login_password_mark" style=""></span>
                            </div>
                        </div>
                        <div class="col-sm-offset-6 col-sm-3">
                            <button type="submit" class="btn my_button">Log In</button>
                        </div>
                    </div>
                </form>


                <form id ="signup_form" class="form-horizontal" role="form">
                    <div class="col-md-6 col-xs-12" style="border-left: 1px solid #6f5499;">
                        <div class="form-group has-feedback">
                            <label class="col-sm-3 control-label">First Name<span>*</span></label>
                            <div class="col-sm-7">
                                <input type="text" name="first_name" class="form-control" id="input_first_name" placeholder="First Name">
                                <span class="glyphicon form-control-feedback" id="input_first_name_mark" style=""></span>
                            </div>
                        </div>
                        <div class="form-group has-feedback">
                            <label class="col-sm-3 control-label">Last Name<span>*</span></label>
                            <div class="col-sm-7">
                                <input type="text" name="last_name" class="form-control" id="input_last_name" placeholder="Last Name">
                                <span class="glyphicon form-control-feedback" id="input_last_name_mark" style=""></span>
                            </div>
                        </div>
                        <div class="form-group has-feedback">
                            <label for="input_email" class="col-sm-2 control-label label_email" style="">Email<span>*</span></label>
                            <div class="col-sm-7">
                                <input type="text" name="email" class="form-control" id="input_email" placeholder="Email">
                                <span class="glyphicon form-control-feedback" id="input_email_mark" style=""></span>
                            </div>
                        </div>
                        <div class="form-group has-feedback">
                            <label for="input_password" class="col-sm-2 control-label label_password">Password<span>*</span></label>
                            <div class="col-sm-7">
                                <input type="password" name="password" class="form-control" id="input_password" placeholder="Password">
                                <span class="glyphicon form-control-feedback" id="input_password_mark" style=""></span>
                            </div>
                        </div>
                        <div class="col-sm-offset-6 col-sm-3">
                            <button type="submit" class="btn my_button">Sign In</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <?php include 'footer.php'; ?>
    </body>

</html>
