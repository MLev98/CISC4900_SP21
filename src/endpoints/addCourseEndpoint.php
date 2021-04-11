<form name = "addCourseForm" action="dashboard.php" method="POST" style = "display:none;">
<select name="addCourse">
<?php

$sql = "SELECT courses.id, courses.courseCode, courses.courseName FROM courses left join (SELECT * FROM courses_taken WHERE userID = '{$_SESSION['userID']}') ct ON courses.id = ct.courseID WHERE courses.majorID = '{$_SESSION['majorID']}' AND ct.courseID is null";
$courses = mysqli_query($link, $sql);

foreach($courses as $row) {
    echo '<option value="'. $row['id'] . '">' . $row['courseCode'] . " " . $row['courseName'] . '</option>';
}
?>
</select>
<button type="submit" name="courseForm">Add</button>
</form>

<!-- HANDLE REQUEST -->

<?php
if(isset($_POST['courseForm'])) {
    $course = $_POST['addCourse'] ?? '';
    $groupID = $_POST['groupID'] ?? '';

    $sql = "SELECT * FROM courses_taken WHERE userID = '{$_SESSION['userID']}' AND courseID = '$course'";
  
    if($result = mysqli_query($link,$sql)) {
        if(!mysqli_num_rows($result)) {
            $sql = "INSERT INTO courses_taken(userID, courseID, groupID) VALUES ('{$_SESSION['userID']}', '$course', '$groupID')";
            $result = mysqli_query($link, $sql);
            header("Refresh:0");
        }else {
            print '<script>alert("Class already added...");</script>';
        }
    }
}
?>
