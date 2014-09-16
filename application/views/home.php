<!DOCTYPE html>
<html lang="en">
    <head>
        <link href="/static/css/bootstrap3.css" rel="stylesheet" type="text/css">
        <link href="/static/css/style.css" rel="stylesheet" type="text/css">
        <script src="/static/js/jquery-1.10.2.min.js" type="text/javascript"></script>
        <script src="/static/js/jquery.validate.min.js" type="text/javascript"></script>
        <script src="/static/js/bootstrap3.min.js" type="text/javascript"></script>
        <script src="/static/js/home.js" type="text/javascript"></script>
        <meta charset="utf-8">
        <title>Resistance</title>
    </head>
    <body>
        <?php include 'header.php'; ?>
        <?php include 'modal.php' ?>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4 col-xs-12" style="height: 550px;">
                    <ul class="nav nav-pills nav-stacked">
                        <div class="col-xs-12" style="margin-bottom: 15px;"><button data-toggle="modal" data-target="#broad_message_modal" class="btn btn-default">Broadcast Message</button><br></div>
                        <div class="col-xs-12" style="margin-bottom: 15px;"><button id="saved_messages" class="btn btn-default">Saved Messages</button><br></div>
                        <div class="col-xs-12" style="margin-bottom: 15px;"><button id="logout" class="btn btn-default">Logout</button></div>
                    </ul>
                </div>
                <div id="message_part" class="">
                </div>

                <div id="saved_messages_part" class="col-md-8 col-xs-12" >
                    <h4 id="heading" style="display: none;">Your Saved Messages:</h4>
                </div>
            </div>
        </div>
        <?php include 'footer.php'; ?>
    </body>
</html>