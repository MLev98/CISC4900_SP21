<?php
$sql = "SELECT courses.id, courses.courseCode, courses.courseName, courses.credits, courses.isElective, courses_taken.groupID FROM courses INNER JOIN courses_taken ON courses_taken.courseID = courses.id WHERE courses_taken.userID = '{$_SESSION['userID']}'";
$result = mysqli_query($link, $sql);
$semester_arr = array();

foreach($result as $row) { //creates array of ids of all semesters
    if( !in_array($row['groupID'],$semester_arr)) array_push($semester_arr,$row['groupID']);
}

$credits_array = array(); //stores array of individual semester credits

echo '<div class="row-fluid d-flex" id = "listofcard">';
foreach($semester_arr as $groupid) {
    echo '<div class="col-3 col-cards d-flex" style = "">';
    echo '<div class="card" id = "'. $groupid .'">';
    echo '<div class="card-header">';
    echo '<h5 id = "h5'.$groupid.'"> Semester '. $groupid .'</h5>';
    echo '</div>';
    echo '<div class="card-block main-block">';
    echo '<div class="row sortable">';

    $credits = 0;

    foreach($result as $row) {
        if($row['groupID'] == $groupid) {
            
            echo '<div class="col-lg-12 col-xl-12 qitem" style="" id="c'. $row['id'] .'">'; //c is a delimeter
            echo '<div class="card-sub">';
            echo '<div class="card-block class-block">';
            echo '<button class = "btn-danger" onclick="removeClass(\'c'.$row['id'].'\')";> X </button>';
            echo '<h4 class="card-title">'. $row['courseCode'] .'</h4>';
            echo '<p class="card-text">'. $row['courseName'] .'</p>';
            echo '</div>';
            echo '</div>';
            echo '</div>';

            $credits += $row['credits'];
        }
    }

    echo '</div>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
    
    $credits_array[] = $credits;
    
    echo '<script>';
    echo 'document.getElementById("h5'.$groupid.'").innerHTML += " ('. $credits .') credits";';
    echo '</script>';

    echo '<br><br>';
}
?>

<?php
// HANDLE DELETE BUTTON
if(isset($_POST['deleteClass'])) {
    $courseID = ltrim($_POST['courseID'],'c'); //c is a delimeter 
    
    $sql = "DELETE FROM courses_taken WHERE userID = '{$_SESSION['userID']}' AND courseID = '$courseID'";
    $result = mysqli_query($link, $sql);

    if(mysqli_num_rows($result)) echo "<script>successfully_delete_course_notification; </script>";
}

// HANDLE DRAG/DROP REQUEST
if(isset($_POST['dropClass']) && !empty($_POST['courseID'])) {
    $groupID = $_POST['groupID'];
    $courseID = ltrim($_POST['courseID'],'c'); //c is a delimeter 
    
    $sql = "UPDATE courses_taken SET groupID = '$groupID' WHERE userID = '{$_SESSION['userID']}' AND courseID = '$courseID'";
    $result = mysqli_query($link,$sql);
    //if not update, then insert
    if(!mysqli_num_rows($result)) {
        $sql = "SELECT * FROM courses_taken WHERE groupID = '$groupID' AND courseID = '$courseID' AND userID = '{$_SESSION['userID']}'";
        $result = mysqli_query($link,$sql);
        if(!mysqli_num_rows($result)) {
            $sql = "INSERT INTO courses_taken(userID, courseID, groupID) VALUES ('{$_SESSION['userID']}', '$courseID', '$groupID')";
            $result = mysqli_query($link, $sql);
            header("Refresh:0");
        }

    } else {
        header("Refresh:0");
    }
}
?>