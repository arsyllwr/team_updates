 <!-- 
 Requirements:-
    Validate the date:
      - check there has been a date entered                         - DONE
      - check it's a Monday                                         - DONE
      - check it's no more than 6 days in the future                - DONE
      - check it's no more than 2 months ago                        - DONE
    If date validation fails:
      - form to be rebuilt with all previously entered data intact  - To do
    If date validation succeeds
      - post all data to sql database                               - To do

 -->


<!-- <pre> -->
<?php
//var_dump($_POST);

/*$someString = "this is a string with numbers in the middle (345456) and at the end 11134";
echo $someString;
echo '<br />';
echo "Now here's the string after a preg_replace to get rid of the trailing numbers:";
echo '<br />';
$newString = preg_replace("/\d+$/","", $someString);
echo $newString;*/

/*echo '<br />';
echo $_POST['date'];*/

/*$patt = "/\./";
$repl = "-";
echo '<br />';
echo preg_replace($patt, $repl, $_POST['date']);*/

/*$myDate = preg_replace($patt, $repl, $_POST['date']);
$newDate = date("Y-m-d", strtotime($myDate));
echo '<br />';
echo $newDate;*/

/*echo '<br />';
echo date('D', strtotime($newDate));*/

/*$timenow = getdate();
echo '<br />';
echo print_r($timenow);*/

// Connect to the Powerview database
include $_SERVER['DOCUMENT_ROOT'] . '/common/mod_database.php';
connect_PVDB();

?>

<!-- </pre> -->

<?php
/*
// set pattern & replace values for preg_replace to change date format, then re-order using date()
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
  // better to actually push forwward or back to previous/next Monday here 
  }

} else {
  $error_message = "You haven't chosen a week-commencing date";
}
*/

$patterns = array("/\d+$/", "/\_/");
$replacements = array("", " ");

echo $_POST['date'];
echo '<br />';
echo $_POST['userid'];
echo '<br />';
echo '<br />';
echo preg_replace("/(\d+)\.(\d+)\.(\d+)/", "$3-$2-$1", $_POST['date']);
echo '<br />';
echo '<br />';

foreach ($_POST as $key => $value) {
  if ($key != "date" && $key != "userid") {
    //if ($error_message == "") {
      if ($value != "") {
      // sql query to insert data. Can either build one big string or execute it multiple times. Not sure on trade-off
        $query_text = 'INSERT INTO ddWeeklyUpdates (UserId, MeetingDate, UpdateTypeId, Details, TimeStamp) SELECT ' . $_POST['userid'] . ', "' . preg_replace("/(\d+)\.(\d+)\.(\d+)/", "$3-$2-$1", $_POST['date']) . '", (SELECT UpdateTypeId FROM ddUpdateType WHERE UpdateType ="' . preg_replace($patterns, $replacements, $key) . '"), "' . trim($value) . '", CURRENT_TIMESTAMP;';
        mssql_query($query_text);
      // echo to page too
        echo '<div>';
        echo preg_replace($patterns, $replacements, $key) . ': ' . $value;
        echo '</div>';
      }
    /*} else {
    // rebuild the form including the data entered
      echo '<div>';
      echo preg_replace($patterns, $replacements, $key) . ': ' . $value;
      echo '</div>';
    }*/
  }
}

echo '<br />';
if ($error_message != "") {
  echo $error_message;
} else {
  echo "Successful completion of form!";
}

?>
