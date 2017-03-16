<?php session_start() ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Aberstan - SIA</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/custom.css">

    <script type="text/javascript" src="lib-js/jquery-3.1.1.min.js"></script>
  </head>
  <body>
    <script type="text/javascript">
      $(document).ready(function() {
        $.get('lib-php/rp-lock.php').done(function(data){
          if (data == "TRUE") {
            $('body').load('pages/pg-dashboard.html');
          } else {
            $('body').load('pages/pg-login.html');
          }
        }).fail(function(){
          $('body').load('pages/pg-login.html');
        });
      });
    </script>
  </body>
</html>
