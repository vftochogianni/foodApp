<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food | What we last ate!</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">
</head>
<body>
    <?php
        include 'admin/functions.php';
        include 'admin/connect.php';

        //Update the number of views
        $query="UPDATE views SET num=num+1 ";
        mysql_query($query) or die ('Could not update number of views');
    ?>
    <!-- header -->
    <header class="container-fluid text-center">
        <div class="text-left col-sm-6"> <img src="app_images/food-title.png" height="90px" style="margin: 1%"></div>
        <div class="text-center col-sm-6">
            <h2>
                <small>
                    <p>Get ready to explore the world through the sense of taste ...</p>
                    <p>Discover new ideas and share your own plates!!</p>
                </small>
            </h2>
        </div>
    </header>
    <!-- endheader -->

    <!-- topBar -->
    <nav class="navbar navbar-default">
        <div class="container-fluid">

            <div class="col-sm-4 text-center" style="margin-top: 1%">Posts: <b><?php fetchNumPosts(); ?></b></div>
            <div class="col-sm-4 text-center" style="margin-top: 1%">
                <a class="btn btn-default" href="admin/export.php?export=CSV">Export CVS</a>
                <a class="btn btn-default" href="admin/export.php?export=XLS">Export XLS</a>
                <a class="btn btn-default" href="admin/export.php?export=ZIP&zip=images">Export ZIP</a>
            </div>
            <div class="col-sm-4 text-center" style="margin-top: 1%">Views: <b><?php fetchViews(); ?></b></div>
        </div>
    </nav>
    <!-- endtopBar -->
