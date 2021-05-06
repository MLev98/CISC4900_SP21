<!-- DEPT FORM -->
<div class = "row fake-navbar">
<div class = "col-1 my-auto">
<a href="logout.php"> <button type="button" class = "btn">Logout</button> </a>
</div>
<div class = "col-2 offset-4">
<form class = "dept-form" name = "addDeptForm" action="dashboard.php" method="POST" style = "display:block;">
<label>Department</label>
<select class="form-select" name="selectDept" onchange="this.form.submit();">
<?php
$sql = "SELECT id, name FROM majors";
$majors = mysqli_query($link, $sql);
$test = mysqli_fetch_all($majors, MYSQLI_ASSOC);
$tmp = $_SESSION['majorID']-1;

if(!isset($_SESSION['deptSelect'])) {
    if(isset($_SESSION['majorID'])) {
        echo '<option value="'. $tmp . '">' . $test[$tmp]['name'] . '</option>';
    } else {
        echo '<option value="-1"> - </option>';
    }
} else {
    echo '<option value="'. $_SESSION['deptSelect'] . '">' . $test[$_SESSION['deptSelect']]['name'] . '</option>';
}

foreach($majors as $row) {
    if(isset($_SESSION['deptSelect'])) {
        if($row['id'] == $_SESSION['deptSelect']+1){

        } else {
            echo '<option value="'. $row['id'] . '">' . $row['name'] . '</option>';
        }
    } else {
        if(isset($_SESSION['majorID'])) {
            if($row['id'] == $_SESSION['majorID']){

            } else {
                echo '<option value="'. $row['id'] . '">' . $row['name'] . '</option>';
            }
        }else {
            echo '<option value="'. $row['id'] . '">' . $row['name'] . '</option>';
        }
    }
    
}


?>
</select>
<noscript><input type="submit" name="deptForm"></noscript>
</form>
</div>
<div class = "col-2">
<!-- COURSE FORM -->

<label>Course</label>
<select id = "addCourseF" class="form-select" name="addCourse">
<?php
    $tmp = $_SESSION['deptSelect']+1;
    if(isset($_SESSION['deptSelect']) && (!isset($_SESSION['majorID']) || $tmp != $_SESSION['majorID'])) {
        $sql = "SELECT courses.id, courses.courseCode, courses.courseName FROM courses left join (SELECT * FROM courses_taken WHERE userID = '{$_SESSION['userID']}') ct ON courses.id = ct.courseID WHERE courses.majorID = '{$tmp}' AND ct.courseID is null";
    } else {
        $sql = "SELECT courses.id, courses.courseCode, courses.courseName FROM courses left join (SELECT * FROM courses_taken WHERE userID = '{$_SESSION['userID']}') ct ON courses.id = ct.courseID WHERE courses.majorID = '{$_SESSION['majorID']}' AND ct.courseID is null";
    }

    $courses = mysqli_query($link, $sql);
    
    foreach($courses as $row) {
        echo '<option value="'. $row['id'] . '">' . $row['courseCode'] . " | " . $row['courseName'] . '</option>';
    }

?>
</select>
</div>
<div class = "col-2 my-auto">
<div class = "btn-group" role="group">
<button class = "btn btn-add" onClick="createClass();" name="courseForm">Add Class</button>
<button type="button" class = "btn" onclick="createSemester()">Add Semester</button>
</div>
</div>
</div> <!-- end of row -->
</html>
<!-- HANDLE DEPT FORM REQUEST -->
<?php
if(isset($_POST['selectDept'])) {
    $_SESSION['deptSelect'] = $_POST['selectDept']-1;
    
    header("Refresh:0");
}
?>