<?php //error_reporting(0); 
require('list.php');
$list = new listIdClass() ; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ListIdClass</title>

  <!-- Boostrap Style -->
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

  <!-- jQuery library -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

  <!-- Latest compiled JavaScript -->
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="style.css">

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="assets/js/html5shiv.min.js"></script>
      <script src="assets/js/respond.min.js"></script>
      <![endif]-->
    </head>
    <body>

      <div class="container">
        <h1 class="text-center">ListIdClass</h1>
        <form class="form-inline" role="form" enctype="multipart/form-data" method="post" action="">
          <div class="form-group">
            <label>Choose a zip file to upload: <input class=".form-control" type="file" name="zip_file" /></label><br />
          </div>
          <input class="btn btn-primary" type="submit" name="submit" value="Upload" />
        </form><?php

        $zip_status = $list->upload_zip( $_FILES );

        if( $zip_status == '1' ){ ?>
          <p class="msg success">Success !! Zip file uploaded successfully. </p><?php
          $list->getIdClass( $_FILES["zip_file"]["name"] );
        }
        if( $zip_status == '2') {?>
          <p class="msg error">Error !! Please upload zip file only. </p><?php
        }?>
        
      </div>
      <footer>
        <h5 class="bg-warning">This application is developed by Pranav Shah. Please note we do not store code file on our server.</h5>
      </footer>

    </body>
    </html>