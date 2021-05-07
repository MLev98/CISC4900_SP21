<?php
session_start();
ob_start();
include("config.php");

if (!isset($_SESSION['logged_in'])) {
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<!-- jQuery min js -->
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
<!-- jQuery ui js -->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.3/jquery.ui.touch-punch.min.js" integrity="sha512-0bEtK0USNd96MnO4XhH8jhv3nyRF0eK87pJke6pkYf3cM0uDIhNJy9ltuzqgypoIFXw3JSuiy04tVk4AjpZdZw==" crossorigin="anonymous"></script>
<!-- BOOTSTRAP CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
<!-- CUSTOM sortable CSS -->
<link rel="stylesheet" href="css/sortable.css?v=<?php echo time(); ?>">
<!-- sweet alert js -->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>
<!-- custom sweet alert notifications -->
<script src="js/notifications.js"></script>
<!-- CUSTOM JS for Sortable -->
<script src="js/sortable.js"></script>

<!-- ADD A COURSE FORM -->
<?php include('endpoints/addCourseEndpoint.php');?>

<br>

<!-- DISPLAY/UPDATE COURSES-->
<div id = "container">
<?php include('endpoints/coursesTakenEndpoint.php'); ?>
</div>
</html>