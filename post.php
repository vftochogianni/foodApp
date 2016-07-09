<?php
    include 'admin/connect.php';
    @session_start();

    define('MB', 1048576);                                              // definision for Byte to MB conversion

    function GetImageExtension($imagetype)                              //function to get image extension
    {
        if(empty($imagetype)) return false;
        switch($imagetype)
        {
            case 'image/gif': return '.gif';
            case 'image/jpeg': return '.jpg';
            case 'image/png': return '.png';
            default: return false;
        }

    }

    if (!empty($_FILES["uploadedimage"]["name"])) {
        $title=$_POST["title"];
        if ($title==null){                                              //check title if null
            $title='Untitled';
        }
        $file_name=$_FILES["uploadedimage"]["name"];                    //get name of image
        $temp_name=$_FILES["uploadedimage"]["tmp_name"];                //get temp_name of image
        $imgtype=$_FILES["uploadedimage"]["type"];                      // get type of image
        $ext= GetImageExtension($imgtype);

        list($width,$height)=getimagesize($temp_name);
        if($width > "1920" || $height > "1080") {                       //check dimensions
            header("Location: ../index.php?Status=Dimension");          //redirect and show  a message of error
            exit;
        }
        if ($_FILES["uploadedimage"]["size"] > 20*MB){                  //check size
            header("Location: ../index.php?Status=Size");               //redirect and show  a message of error
            exit;
        }
        if ($ext==false){                                               //check extension
            header("Location: ../index.php?Status=Ext");                //redirect and show  a message of error
            exit;
        }

        $imagename=date("d-m-Y")."-".time().$ext;                       //rename image
        $target_path = "images/".$imagename;                            //path where the image will be stored


        if(move_uploaded_file($temp_name, $target_path)) {              //move file & upload path of image on database
            $query="INSERT into posts (image, title) VALUES ('".$target_path."', '".$title."')";
            mysql_query($query) or die("error in $query == ----> ".mysql_error());
            header("Location: ../index.php?Status=Success&Show=All");   //redirect and show all posts and a message of success
        }else{
            header("Location: ../index.php?Status=Error");              //redirect and show  a message of error
        }
    }
?>