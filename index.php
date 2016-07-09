<?php
    include_once 'header.php';
?>

<div class="container-fluid">
    <?php
    //messages afrer uploading a post
        if (isset($_GET["Status"])){
            switch($_GET["Status"]){
                case "Success":
                    echo '<div class="alert alert-success text-center" role="alert">Your post was uploaded successfully!</div>';
                    break;
                case "Error":
                    echo '<div class="alert alert-danger text-center" role="alert">Ooops something went wrong, please try again!</div>';
                    break;
                case "Ext":
                    echo '<div class="alert alert-danger text-center" role="alert">Wrong type of file! Supported files .jpeg, .png, .gif.</div>';
                    break;
                case "Dimension":
                    echo '<div class="alert alert-danger text-center" role="alert">Image must not be greater that 1920x1080! </div>';
                    break;
                case "Size":
                    echo '<div class="alert alert-danger text-center" role="alert">Image must not exceed 20MB!</div>';
                    break;
            }
        }

    ?>
    <!-- form -->
    <div class="container-fluid">
        <h4 class="text-center">
            Add a Post!
        </h4>
        <form action="post.php" enctype="multipart/form-data" method="post">
            <table border="0" align="center">
                <tr>
                    <td align="right" style="padding: 1%">Title: </td>
                    <td style="padding: 1%"><input name="title" type="text" class="form-control"></td> <!-- title field -->
                    <td align="center" style="padding: 2%"><input name="uploadedimage" id="uploadedimage" type="file" required="true" class="form-control"></td> <!-- file field -->
                    <td align="center" style="padding: 2%"><input name="Upload Now" type="submit" value="Upload Post" class="btn btn-success"></td> <!-- submit field -->
                </tr>
            </table>
        </form>
    </div>
    <!-- endform -->

    <?php
        // after uploading an image show all posts
        if(isset($_GET["Show"]) && $_GET["Show"]=="All"){
            $sql = "SELECT * FROM posts ORDER BY posted_at DESC";
            $result = mysql_query($sql) or die("Result Failed");
            while ($row = mysql_fetch_array($result)) {
                ?>

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><strong><?php echo $row['title']; ?></strong></h3> <!-- post title -->
                    </div>
                    <div class="panel-body text-center">
                        <img src="<?php echo $row['image']; ?>" height="200px"> <!-- post image -->

                        <div class="caption">
                            <p class="text-right"><i>Posted at: <?php echo $row['posted_at']; ?></i></p> <!-- post date & time of submission -->
                        </div>
                    </div>
                </div>
    <?php
            }
        }
    ?>
</div>

<?php
    include_once 'footer.php';
?>