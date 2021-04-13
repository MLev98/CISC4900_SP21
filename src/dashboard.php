<?php
session_start();
ob_start();
include("config.php");

?>
<!DOCTYPE html>
<html lang="en">
<!-- jQuery min js -->
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
<!-- jQuery ui js -->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<!-- BOOTSTRAP CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

<link rel="stylesheet" href="sortable.css">
<script src="sortable.js"></script>

<!-- ADD A COURSE FORM -->
<?php include('endpoints/addCourseEndpoint.php');?>

<!-- UPDATE MAJOR FORM -->
<?php include('endpoints/majorsEndpoint.php');?>

<!-- DISPLAY/UPDATE COURSES-->
<div id = "container">
<?php include('endpoints/coursesTakenEndpoint.php'); ?>
</div>

<button onclick="createSemester('addCourseForm')">Add Semester</button>
<a href="logout.php"> <button>Logout</button> </a>
</html>
