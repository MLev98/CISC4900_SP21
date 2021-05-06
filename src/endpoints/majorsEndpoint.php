<h3> Welcome <?php echo $_SESSION['username']?> </h3>

<form action="dashboard.php" method="POST">
    <label for="major">Major:</label>
    <select name="major">
    <?php
        //Display current major
        if(isset($_SESSION['majorID']) && $_SESSION['majorID'] != '') {
            $sql = "SELECT id, name FROM majors WHERE id = '{$_SESSION['majorID']}' AND NOT isOnlyMinor = 1";
            $result = mysqli_query($link, $sql);
            $arr = mysqli_fetch_assoc($result);
            echo '<option value="'. $arr['id'] . '">' . $arr['name'] . '</option>';
        } else {
            echo '<option value = "-1">NONE</option>';
        }

        //Display all majors
        $sql = "SELECT * FROM majors";
        $majors = mysqli_query($link, $sql);

        foreach($majors as $row) {
            if($row['id'] != $_SESSION['majorID'])
                echo '<option value="'. $row['id'] . '">' . $row['name'] . '</option>';
        }
    ?>
    </select>
    <label for="minor">Minor:</label>
    <select name="minor">
     <?php
     //Display current minor
     if(isset($_SESSION['minorID']) && $_SESSION['minorID'] != '') {
        $sql = "SELECT id, name FROM majors WHERE id = '{$_SESSION['minorID']}'";
        $result = mysqli_query($link, $sql);
        $arr = mysqli_fetch_assoc($result);
        echo '<option value="'. $arr['id'] . '">' . $arr['name'] . '</option>';
    } else {
        echo '<option value = "-1">NONE</option>';
    }
     //Display all minors
     foreach($majors as $row) {
         if($row['isMinor'] != 0 && $row['id'] != $_SESSION['minorID']) {
             echo '<option value="'. $row['id'] . '">' . $row['name'] . '</option>';
            }
        }
    ?>
    </select>
    <button type="submit" name="majorForm">Save</button>
</form>

<!-- HANDLE REQUEST -->

<?php
if(isset($_POST['majorForm'])) {
    $major = $_POST['major'] ?? '';
    $minor = $_POST['minor'] ?? '';
    if($minor == -1 && $major != -1) {
        $sql = "UPDATE users SET majorID = '$major' WHERE id = '{$_SESSION['userID']}'";
        $_SESSION['majorID'] = $major;
    } else if ($minor != -1 && $major == -1) {
        $sql = "UPDATE users SET minorID = '$minor' WHERE id = '{$_SESSION['userID']}'";
        $_SESSION['minorID'] = $minor;
    } else {
        $sql = "UPDATE users SET majorID = '$major', minorID = '$minor' WHERE id = '{$_SESSION['userID']}'";
        $_SESSION['majorID'] = $major;
        $_SESSION['minorID'] = $minor;
    }

    $result = mysqli_query($link, $sql);
    header("Refresh:0");
}
?>
