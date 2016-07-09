<?php
include_once 'connect.php';

$export=$_GET['export'];                                            // get type of export

if ($export=='XLS'){
    exportXLS();
}elseif($export=='CSV'){
    exportCSV();
}elseif($export=='ZIP'){
    exportZIP();
}

function exportXLS(){
    $query="SELECT title,image FROM posts";                         //get titles and images from database
    $result=mysql_query($query) or die("error");

    header('Content-Type: text/plain; charset=utf-8;');
    header('Content-Disposition: attachment; filename=data.xls');

    $output = fopen('php://output', 'w');                           // open file to write
    fputcsv($output, ['POSTS']);                                    // write title in file
    fputcsv($output, ['Title', 'Filename']);                        // write column titles
    while($row=mysql_fetch_array($result)){                         // write data from database
        $row['image']=str_replace('images/','',$row['image']);
        fputcsv($output, [$row['title'],$row['image']]);    }

    fclose($output);                                                //close file
}

function exportCSV(){
    $query="SELECT title,image FROM posts";                       //get titles and images from database
    $result=mysql_query($query) or die("error");

    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=data.csv');

    $output = fopen('php://output', 'w');                          // open file to write
    fputcsv($output, ['POSTS']);                                   // write title in file
    fputcsv($output, ['Title', 'Filename']);                       // write column titles
    while($row=mysql_fetch_array($result)){                        // write data from database
        $row['image']=str_replace('images/','',$row['image']);
        fputcsv($output, [$row['title'],$row['image']]);
    }

    fclose($output);                                                //close file
}

function exportZIP(){
    $filename_no_ext= $_GET['zip'];                 // folder to zip

    header("Content-Type: archive/zip");
    header("Content-Disposition: attachment; filename=$filename_no_ext".".zip");

    $tmp_zip = tempnam ("tmp", "images") . ".zip";  // get a temp name for the zip

    chdir('../'.$_GET['zip']);                      // change directory
    exec('zip '.$tmp_zip.' *');                     // zip all files

    $filesize = filesize($tmp_zip);                 // get filesize of zip
    header("Content-Length: $filesize");

    $fp = fopen("$tmp_zip","r");                    // deliver the zip file
    echo fpassthru($fp);
    unlink($tmp_zip);                               // clean up the tmp zip file
}

?>