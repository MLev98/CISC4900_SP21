/* sweet alert notifications */

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
  
  function wrong_log_in_notification() {
    Swal.fire({
    title: '<strong>Invalid Username or Password</strong>',
    icon: 'warning'
  })
  }
  
  function username_taken_notification() {
    Swal.fire({
    title: '<strong>Username taken, try again</strong>',
    icon: 'warning'
  })
  }
  
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
  
  function passwords_dont_match_notification() {
    Swal.fire({
    title: '<strong>Passwords dont match, try again</strong>',
    icon: 'warning'
  })
  }
  
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

  