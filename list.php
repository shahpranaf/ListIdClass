<?php
class listIdClass {

  public function upload_zip( $FILES ){
    if($FILES["zip_file"]["name"]) {
      $filename = $FILES["zip_file"]["name"];
      $source = $FILES["zip_file"]["tmp_name"];
      $type = $FILES["zip_file"]["type"];
      
      $name = explode(".", $filename);
      $accepted_types = array('application/zip', 'application/x-zip-compressed', 'multipart/x-zip', 'application/x-compressed');
      foreach($accepted_types as $mime_type) {
        if($mime_type == $type) {
          $okay = true;
          break;
        } 
      }
      
      if (!file_exists('upload/'.$name[0])) {
        mkdir('upload/'.$name[0], 0777, true);
      }
      $target_path = "upload/".$filename;  // change this to the correct site path

      $continue = strtolower($name[1]) == 'zip' ? true : false;
      if(!$continue) {
        $message = 3;
        $this->del_dir($target_path);
        return $message;
      }

      if(move_uploaded_file($source, $target_path)) {
        $zip = new ZipArchive();
        $x = $zip->open($target_path);
        if ($x === true) {
          $zip->extractTo('upload/'.$name[0]); // change this to the correct site path
          $zip->close();
          
          unlink($target_path);
        }
        $message = 1;
      } else {  
        $message = 2;
      }
      return $message;
    }
  }

  function getIDClass( $foldername ){ ?>
  <div class="container"><?php
  $dir = 'upload/'.explode('.',$foldername)[0];

  $files = $this->rsearch($dir,'/^.*\.(?:html|php|tmpl|jsp|htm)$/i');?>
  <div class="row"><?php

  foreach ($files as $key => $filename) {
    $myfile = fopen($filename, "r") or die("Unable to open file!");
    $f = fread($myfile,filesize($filename));
    $subject = $f;
    $id_pattern = '/id\s*=\s*"(.*?)"/';
    $class_pattern = '/class\s*=\s*"(.*?)"/';
    preg_match_all($id_pattern, $subject, $id_matches);
    preg_match_all($class_pattern, $subject, $class_matches);

    if( count($id_matches[1]) != 0 || count($class_matches[1]) != 0 ) { ?>
    <div class="row list-row col-sm-12 col-md-6">
      <h3 class="bg-info list-filepath"><?php echo $filename; ?></h3><?php
      $class = "col-sm-12";
      $id_exist = ( count($id_matches[1]) != 0 ) ? true : false;
      $class_exist = ( count($class_matches[1]) != 0 ) ? true : false;  

      $class = ( $id_exist && $class_exist ) ? 'col-sm-6' : 'col-sm-12';
      if( $id_exist ){ ?>
      <div class="<?php echo $class; ?>">
        <table class="table left">
          <thead>
            <tr>
              <th><?php echo "ID"; ?></th>
            </tr>
            </thead>
            <tr><td><?php
            foreach ($id_matches[1] as $mtchkey => $match) {  
              echo "#".$match.', ';
            }?></td><tr>
        </table>
        </div><?php
      }
      if( $class_exist ){ ?>
      <div class="<?php echo $class; ?>">
        <table class="table left">
          <thead>
           <tr><th><?php echo "Class"; ?></th></tr>
           </thead>
           <tr><td><?php
           foreach ($class_matches[1] as $mtchkey => $class_match) { 
              echo ".".$class_match.', ';
            }?></td></tr>
       </table>
       </div><?php
     }?>
     </div><?php
   }

   fclose($myfile);
 }
 $this->del_dir($dir); ?>
</div>
</div><?php
}
public function rsearch($folder, $pattern) {
  $dir = new RecursiveDirectoryIterator($folder);
  $ite = new RecursiveIteratorIterator($dir);
  $files = new RegexIterator($ite, $pattern, RegexIterator::GET_MATCH);
  $fileList = array();
  foreach($files as $file) {
    $fileList = array_merge($fileList, $file);
  }
  return $fileList;
}
function del_dir($path){
  if (is_dir($path) === true)
  {
    $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path), RecursiveIteratorIterator::CHILD_FIRST);

    foreach ($files as $file)
    {
      if (in_array($file->getBasename(), array('.', '..')) !== true)
      {
        if ($file->isDir() === true)
        {
          rmdir($file->getPathName());
        }

        else if (($file->isFile() === true) || ($file->isLink() === true))
        {
          unlink($file->getPathname());
        }
      }
    }

    return rmdir($path);
  }

  else if ((is_file($path) === true) || (is_link($path) === true))
  {
    return unlink($path);
  }

  return false;
}
}?>