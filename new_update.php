<?php

// Connect to the Powerview database
include $_SERVER['DOCUMENT_ROOT'] . '/common/mod_database.php';
connect_PVDB();

// Get the user's details
include $_SERVER['DOCUMENT_ROOT'] . '/common/mod_user.php';
$user =  json_decode(get_user_info($_SERVER['REMOTE_USER']));

// Are they in the people directory?
if ($user->PDUser=='No') {
    // Prompt to enter their details in PD
    echo '<div class="not_found">Oops! We can\'t find you in the People Directory. Please <a href="http://intrapps.tns-global.com/uk/worldpanel/deliveryservices/ChangeControl/clientservice.asp?choice=100">click here</a> to update your details and then try again.</div>';
} else {
// Store the user ID in a variable
  $userID = $user->UserID;

// Say hello to the user
  $displayname = $user->FirstName;
}

$title = "service design & development";
$subtitle = "add new update";
include "header.php";

/*
// check here if form has been posted.
if ($_SERVER["REQUEST_METHOD"] == "POST") {
// if here then validate form.
// patterns for replacing, but could just use str_replace for simplicity
  $patt = "/\./";
  $repl = "-";
  $myDate = preg_replace($patt, $repl, $_POST['date']);
  $newDate = date("Y-m-d", strtotime($myDate));

  // is the date field blank?
  if ($_POST['date'] != "") {
  // if not blank, replace the full-stops with forward slashes then re-order the date for sql
    $myDate = preg_replace($patt, $repl, $_POST['date']);
    $newDate = date("Y-m-d", strtotime($myDate));
  // is the given date a Monday?
    if (date('D', strtotime($newDate)) == "Mon") {
    // is the date 6 days greater than today?
      if (strtotime($newDate) < strtotime('+7 days') && strtotime($newDate) > strtotime('-2 months')) {
      // Hooray, all date checks passed. So enter whatever information is present in the database
        $error_message = "";
      } else {
      // too far in the future or past
        $error_message = "Are you an astrologer or historian? Your week-commencing date is not entirely contemporary";
      }

    } else {
      $error_message = "Your week-commencing date doesn't commence the week";
    // better to actually push forward or back to previous/next Monday here 
    }

  } else {
    $error_message = "You haven't chosen a week-commencing date";
  }   // end if ($_POST['date'] != "") {

  if ($error_message = "") {
  // patterns and replacement values to fix the keys for database entries (remove '_' & any trailing digits)
    $patterns = array("/\d+$/", "/\_/");
    $replacements = array("", " ");

    foreach ($_POST as $key => $value) {
      if ($key != "date" && $key != "userid" && $value != "") {
      // sql query to insert data. Can either build one big string or execute it multiple times. Not sure on trade-off
        //$query_text = 'INSERT INTO ddWeeklyUpdates (UserId, MeetingDate, UpdateTypeId, Details, TimeStamp) SELECT ' . $_POST['userid'] . ', ' . $_POST['date'] . ', (SELECT UpdateTypeId FROM ddUpdateType WHERE UpdateType =' . preg_replace($patterns, $replacements, $key) . '), ' . trim($value) . ', CURRENT_TIMESTAMP;';
        // mssql_query($query_text);
      }
    }
  }   // end if ($error_message = "") {
}   // end if ($_SERVER["REQUEST_METHOD"] == "POST") {
*/

$rowsInTextArea = 1;
$updateTypeQuery = mssql_query('SELECT UpdateType FROM ddUpdateType;');

?>

<!-- :::::::::::::::::::: Build the form :::::::::::::::::::: -->

<div>   <!-- class="col-md-9" -->
<!-- General Unify Forms -->
  <form class="sky-form" method="post" action="temp_form_submit.php" onsubmit="return ValidateForm()">     
    <header>Details</header>
    <fieldset>
      <section class="col">
        <label class="label" for="date">Select week commencing date</label> 
        <label class="input">
            <i class="icon-append fa fa-calendar"></i>
            <input type="text" name="date" id="date">
        </label>
        <em for="date" class="invalid" id="date_err_msg">Date error</em>
      </section>
      <section><input type="hidden" name="userid" id="userid" value="<?php echo $userID; ?>"></section>
    </fieldset>
    <fieldset>

<?php
  // loop through the update types to add the titles, textareas and buttons for each
    while ($updateTypeArr = mssql_fetch_array($updateTypeQuery)) {
      echo "<section>";
      echo '<div class="col col-11">';
      echo '<label class="counter" style="display: none;">1</label>';
      echo '<label class="label" for="' . $updateTypeArr[0] . '">' . $updateTypeArr[0] . '</label>';
      echo '<label class="textarea textarea-expandable">';
      echo '<textarea rows="3" id="' . $updateTypeArr[0] . '" name="' . $updateTypeArr[0] . '"></textarea>';
      echo "</label>";
      echo '<input type="button" class="add_new" value="+">';
      echo '<input type="button" value="-">';
      echo "</div>";
      echo "</section>";
    }

?>

<!-- ¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬ Submit button and close form ¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬ -->
    </fieldset>
    <footer>
      <button type="submit" class="btn-u">Submit</button>
      <button type="button" class="btn-u btn-u-default" onclick="window.history.back();">Back</button>
    </footer>
  </form>
</div>

<!-- :::::::::::::::::: Include separate footer file ::::::::::::::::::::: -->
<?php include "footer.php"; ?>