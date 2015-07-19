<?php error_reporting(0); 
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

      <div class="container content">
        <h1 class="text-center">ListIdClass</h1>
        <form class="form-inline" role="form" enctype="multipart/form-data" method="post" action="">
          <p>Please upload .zip of your code folder.</p>
          <div class="form-group">
            <input type="text" id="filename">
            <span class="btn btn-default btn-file">
              Browse <input id="upload" type="file" name="zip_file">
            </span>            
          </div>
          <input class="btn btn-primary" type="submit" name="submit" value="Upload" />

          
        </form><?php

        $zip_status = $list->upload_zip( $_FILES );

        if( $zip_status == '1' ){ ?>
          <p class="msg alert alert-success">Success !! Zip file uploaded successfully. </p><?php
          $list->getIdClass( $_FILES["zip_file"]["name"] );
        }
        elseif( $zip_status == '3') {?>
          <p class="msg alert alert-danger">Error !! The file you are trying to upload is not a zip file. Please try again.</p><?php
        }
        elseif( $zip_status == '2') {?>
          <p class="msg alert alert-danger">Error uploading file. Please try again. </p><?php
        }?>        
        
      </div>
      <footer class="container">
          <h5 class="alert alert-warning">This application is developed by Pranav Shah. Please note we do not store code file on our server.</h5>
      </footer>
     

      <script>
        $('#upload').change(function() {
            var filename = $(this).val();
            var lastIndex = filename.lastIndexOf("\\");
            if (lastIndex >= 0) {
                filename = filename.substring(lastIndex + 1);
            }
            $('#filename').val(filename);
        });
      </script>

    </body>
    </html>