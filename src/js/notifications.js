/* sweet alert notifications */
/**
 * Notifies user of successful login message and redirects user to main page.
 * 
 */
function logged_in_notification() {
    Swal.fire({
    title: '<strong>Successfully logged in</strong>',
    icon: 'success'
  }).then((result) => {
    if (result.isConfirmed) {
      window.location.href = "dashboard.php";
  }
  })
  }
  
  /**
   * Notifies user of Invalid credentials error
   * 
   */
  function wrong_log_in_notification() {
    Swal.fire({
    title: '<strong>Invalid Username or Password</strong>',
    icon: 'warning'
  })
  }
  
   /**
   * Notifies user of Username taken error
   * 
   */
  function username_taken_notification() {
    Swal.fire({
    title: '<strong>Username taken, try again</strong>',
    icon: 'warning'
  })
  }
  
   /**
   * Notifies user of Successful creation of account, and redirtects user to main page
   * 
   */
  function successfully_registered_notification() {
    Swal.fire({
    title: '<strong>Successfully registered</strong>',
    icon: 'success'
  }).then((result) => {
    if (result.isConfirmed) {
      window.location.href = "dashboard.php";
  }
  })
  }
  
   /**
   * Notifies user of Miss Matched Password error
   * 
   */
  function passwords_dont_match_notification() {
    Swal.fire({
    title: '<strong>Passwords dont match, try again</strong>',
    icon: 'warning'
  })
  }
  
   /**
   * Notifies user of Course Deleted and updates page if notification is approved
   * 
   */
  function successfully_delete_course_notification() {
    Swal.fire({
    title: '<strong>Successfully deleted</strong>',
    icon: 'success',
    iconColor: 'red',
    confirmButtonColor: 'red',
  }).then((result) => {
    if (result.isConfirmed) {
      window.location.href = "dashboard.php";
  }
  })
  }

    /**
   * Notifies user of Course added and updates page if notification is approved
   * 
   */
  function successfully_added_course_notification() {
    Swal.fire({
    title: '<strong>Successfully added</strong>',
    icon: 'success'
  }).then((result) => {
    if (result.isConfirmed) {
      window.location.href = "dashboard.php";
  }
  })
  }

    /**
   * Notifies user of Course not added error
   * 
   */
  function unsuccessfully_added_course_notification() {
    Swal.fire({
    title: '<strong>Credit Limit Overpassed</strong>',
    icon: 'error'
  }).then((result) => {
    if (result.isConfirmed) {
      window.location.href = "dashboard.php";
  }
  })
  }

   /**
   * Notifies user to select a department and class with an error message
   * 
   */
  function no_dept_class_selected() {
    Swal.fire({
    title: '<strong>Select a department and class</strong>',
    icon: 'warning'
  })
  }