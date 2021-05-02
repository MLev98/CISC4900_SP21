<?php
$sql = "SELECT courses.id, courses.courseCode, courses.courseName, courses.credits, courses.isElective, courses_taken.groupID FROM courses INNER JOIN courses_taken ON courses_taken.courseID = courses.id WHERE courses_taken.userID = '{$_SESSION['userID']}'";
$result = mysqli_query($link, $sql);
$semester_arr = array();

foreach($result as $row) { //creates array of ids of semesters
    if( !in_array($row['groupID'],$semester_arr)) array_push($semester_arr,$row['groupID']);
}

$credits_array = array(); //stores array of each semester credits

foreach($semester_arr as $groupid) {
    echo '<div class="row container d-flex justify-content-center">';
    echo '<div class="col-sm-12">';
    echo '<div class="card" id = "'. $groupid .'">';
    echo '<div class="card-header">';
    echo '<h5 id = "h5'.$groupid.'"> Semester '. $groupid .'</h5>';
    echo '</div>';
    echo '<div class="card-block">';
    echo '<div class="row sortable">';

    $credits = 0;

    foreach($result as $row) {
        if($row['groupID'] == $groupid) {
            
            echo '<div class="col-lg-12 col-xl-3 qitem" style="" id="c'. $row['id'] .'">'; //c+id BECAUSE form bug
            echo '<div class="card-sub">';
            echo '<div class="card-block popup" onclick="myFunction()> <span class="popuptext" id="myPopup">Popup text...</span>';
            echo '<h4 class="card-title">'. $row['courseCode'] .'</h4>';
            echo '<p class="card-text">'. $row['courseName'] .'</p>';
            echo '</div>';
            echo '</div>';
            echo '</div>';

            $credits += $row['credits'];
        }
    }
    
    echo '<script> addCreateForm("'.$groupid.'","addCourseForm")</script>';
    
    echo '</div>';
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

// HANDLE DRAG/DROP REQUEST

if(isset($_POST['groupID']) && !empty($_POST['groupID'])) {
    $groupID = $_POST['groupID'];
    $courseID = ltrim($_POST['courseID'],'c'); //c is a delimeter 
    
    $sql = "UPDATE courses_taken SET groupID = '$groupID' WHERE userID = '{$_SESSION['userID']}' AND courseID = '$courseID'";
    $result = mysqli_query($link,$sql);
    header("Refresh:0");
}
?>
