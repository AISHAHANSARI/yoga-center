<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Image Gallery</title>

	<!-- fancybox css -->
	<link rel="stylesheet" type="text/css" href="../fancybox/jquery.fancybox.min.css">

	<!-- stylesheet file-->
	<link rel="stylesheet" type="text/css" href="../css/style.css">

	<!-- jquery library -->
	<script src="../js/jquery.min.js"></script>

	<!-- fancybox js library -->
	<script src="../fancybox/jquery.fancybox.min.js"></script>

    <!-- bootstrap css  -->
    <!-- <link rel="stylesheet" href="bootstrap/bootstrap.min.css"> -->

    <!-- bootstrap script  -->
    <!-- <script src="bootstrap/bootstrap.min.js"></script> -->

</head>
<body>
<?php require 'partials/_header.php' ; ?>

    <div class="container">
<?php
// Start session
// session_start();

// Include and initialize DB class
require_once 'DB.class.php';
$db = new DB();

// Fetch the users data
$images = $db->getRows('images');

// Get session data
$sessData = !empty($_SESSION['sessData'])?$_SESSION['sessData']:'';

// Get status message from session
if(!empty($sessData['status']['msg'])){
    $statusMsg = $sessData['status']['msg'];
    $statusMsgType = $sessData['status']['type'];
    unset($_SESSION['sessData']['status']);
}
?>

<!-- Display status message -->
<?php if(!empty($statusMsg)){ ?>
<div class="col-xs-12">
    <div class="alert alert-<?php echo $statusMsgType; ?>"><?php echo $statusMsg; ?></div>
</div>
<?php } ?>

<div class="row">
    <div class="col-md-12 head">
        <h5>Images</h5>
        <!-- Add link -->
        <div class="float-right">
            <a href="addEdit.php" class="btn btn-success"><i class="plus"></i> New Image</a>
        </div>
    </div>
    
    <!-- List the images -->
    <table class="table table-striped table-bordered">
        <thead class="thead-dark">
            <tr>
                <th width="5%"></th>
                <th width="12%">Image</th>
                <th width="45%">Title</th>
                <th width="17%">Created</th>
                <th width="8%">Status</th>
                <th width="13%">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if(!empty($images)){
                foreach($images as $row){
                    $statusLink = ($row['status'] == 1)?'postAction.php?action_type=block&id='.$row['id']:'postAction.php?action_type=unblock&id='.$row['id'];
                    $statusTooltip = ($row['status'] == 1)?'Click to Inactive':'Click to Active';
            ?>
            <tr>
                <td><?php echo '#'.$row['id']; ?></td>
                <td><img src="<?php echo '../uploads/images/'.$row['file_name']; ?>" alt="" /></td>
                <td><?php echo $row['title']; ?></td>
                <td><?php echo $row['created']; ?></td>
                <td><a href="<?php echo $statusLink; ?>" title="<?php echo $statusTooltip; ?>"><span class="badge <?php echo ($row['status'] == 1)?'btn-success':'btn-danger'; ?>"><?php echo ($row['status'] == 1)?'Active':'Inactive'; ?></span></a></td>
                <td>
                    <a href="addEdit.php?id=<?php echo $row['id']; ?>" class="btn btn-warning">edit</a>
                    <a href="postAction.php?action_type=delete&id=<?php echo $row['id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure to delete data?')?true:false;">delete</a>
                </td>
            </tr>
            <?php } }else{ ?>
            <tr><td colspan="6">No image(s) found...</td></tr>
            <?php } ?>
        </tbody>
    </table>
</div>
</div>

<?php require 'partials/_footer.php' ; ?>
</body>
</html>