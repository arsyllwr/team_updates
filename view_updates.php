<?php

/* Functions here, code begins further down the page */
function display_sidebar_list($list) {
// function to build the sidebar list of users, update types or dates
  while ($list_arr = mssql_fetch_array($list)) {
    // only show users that have updates against them
    if ($list_arr[1] > 0) {
      echo '<li class="list-group-item">' . $list_arr[0] . '<span class="badge rounded-2x badge-u pull-right">' . $list_arr[1] . '</span></li>';
    }
  }   //end while
}

function display_update_list($update_list) {
// function takes an array of updates, determined elsewhere and displays them on screen
  while ($update_list_arr = mssql_fetch_array($update_list)) {
    echo '';
  }
}


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

// define the titles and include the header
$title = "service design & development";
$subtitle = "review updates";
include "header.php";

// temporary variable for testing
$show_team = false;

// start off with team members
$team_query = "SELECT RegisteredUsers.FirstName + ' ' + RegisteredUsers.LastName AS FullName, COUNT(ddWeeklyUpdates.UserId) AS NumInstances
               FROM ddWeeklyUpdates RIGHT OUTER JOIN
               RegisteredUsers ON ddWeeklyUpdates.UserId = RegisteredUsers.UserId
               WHERE (RegisteredUsers.TeamId = 66) AND (RegisteredUsers.StatusId = 1)
               GROUP BY RegisteredUsers.LastName, RegisteredUsers.FirstName";
$team_names = mssql_query($team_query);

// will also need the list of update types, and the count of types in the weekly updates table
$update_type_query = "SELECT ddUpdateType.UpdateType, COUNT(ddWeeklyUpdates.UpdateTypeId) AS NumOccurences 
                      FROM ddWeeklyUpdates INNER JOIN 
                      ddUpdateType ON ddWeeklyUpdates.UpdateTypeId = ddUpdateType.UpdateTypeId 
                      GROUP BY ddUpdateType.UpdateType";
$update_types = mssql_query($update_type_query);

// Other queries required:
//   - 
$query = "SELECT RegisteredUsers.FirstName + ' ' + RegisteredUsers.LastName AS FullName, ddUpdateType.UpdateType, ddWeeklyUpdates.MeetingDate, ddWeeklyUpdates.Details, ddWeeklyUpdates.TimeStamp
          FROM ddWeeklyUpdates INNER JOIN
          RegisteredUsers ON ddWeeklyUpdates.UserId = RegisteredUsers.UserId INNER JOIN
          upTeam ON RegisteredUsers.TeamId = upTeam.TeamId INNER JOIN
          ddUpdateType ON ddWeeklyUpdates.UpdateTypeId = ddUpdateType.UpdateTypeId
          WHERE (ddWeeklyUpdates.UpdateTypeId = 1) AND (RegisteredUsers.TeamId = 66)";

// Get the list of meeting dates from the table for filtering. Sort doesn;t work properly if converting date format in SQL so may need do it in PHP
// 3rd query below includes MeetingDate twice and sorts by that before conversion. This now works, just ignore the second column when using in code
$dateListQuery1 = "SELECT DISTINCT MeetingDate FROM ddWeeklyUpdates ORDER BY MeetingDate";
$dateListQuery2 = "SELECT DISTINCT CONVERT(VARCHAR(10), MeetingDate, 104) AS DistinctDate FROM ddWeeklyUpdates";
$dateListQuery3 = "SELECT DISTINCT CONVERT(VARCHAR(10), MeetingDate, 104) AS DistinctDate, MeetingDate FROM ddWeeklyUpdates ORDER BY MeetingDate DESC";

include('../kw_palette.php');

?>

    <div class="row">
      <div class="col-md-3">
        <!-- Sidebar to contain team member names or update type -->
<!-- 
* Use sidebar as a filter?
    - By default display all sidebar list entries but give user remove and re-add options
    - show number of entries in sidebar list and make the icon clickable to remove from or add back to display
 -->
        <ul class="list-group">
<?php
if ($show_team) {
  $list = $team_names;
} else {
  $list = $update_types;
}
display_sidebar_list($list);
?>
        </ul>
      </div>

    <!-- Begin main section -->
<!-- 
* Include an option to select a date range?
* What other filters to include?
    - 
 -->
      <div class="col-md-9">
        <div class="row margin-bottom-20">
        <form class="sky-form">
        <!-- Begin filter row -->
          <div class="row">
            <div class="col col-md-6">
              <label class="select sel_review">
                <select>

<?php
if ($show_team) :


endif;
?>
                  <option value="0">Latest meeting date</option>
                  <option value="1">27.07.2015</option>
                  <option value="2">01.06.2015</option>
                  <option value="3">25.05.2015</option>
                </select>
                <i></i>
              </label>
            </div>
            <div class="col col-md-6">
              <label class="select sel_review">
                <select>
                  <option value="0">All update types</option>
                  <option value="1">Pipeline</option>
                  <option value="2">Active projects</option>
                  <option value="3">Update on previous targets</option>
                  <option value="4">Unplanned work / events</option>
                  <option value="5">Training update</option>
                  <option value="6">Weekly targets</option>
                  <option value="7">Achivements / Positives</option>
                  <option value="8">Concerns</option>
                </select>
                <i></i>
              </label>
            </div>
          </div><!-- End filter row class="row" -->
        </form>
        </div>
        <!-- <div class="blog_masonry_3col">
          <div class="container content grid-boxes"> -->
        <div class="row">
          <!--Tag Box v2-->
          <!-- <div class="tag-box tag-box-v2 margin-bottom-10">
            <div class="sider"><i class="fa fa-thumbs-o-up"></i></div>
              <p>Et harum quidem rerum facilis est et expedita distinctio lorem ipsum dolor sit amet consectetur adipiscing elit. Ut non libero consectetur adipiscing elit magna. Sed et quam lacus. Fusce condimentum eleifend enim a feugiat. Pellentesque viverra vehicula sem ut volutpat.</p>
          </div> -->
          <!--End Tag Box v2-->
          <!--Tag Box v1-->
          <!-- <div class="tag-box tag-box-v1 margin-bottom-20">
              <p>Et harum quidem rerum facilis est et expedita distinctio lorem ipsum dolor sit amet consectetur adipiscing elit. Ut non libero consectetur adipiscing elit magna. Sed et quam lacus. Fusce condimentum eleifend enim a feugiat. Pellentesque viverra vehicula sem ut volutpat.</p>
          </div> -->
          <!--End Tag Box v1-->
          <div class="test-box">
            <div class="test-sider"><i class="fa fa-thumbs-o-up"></i></div>
            <div class="test-main"><p>Here is some text. It needs to be displayed to the right of the .test-sider div which contains the font-awesome icon. Here is some text. It needs to be displayed to the right of the .test-sider div which contains the font-awesome icon. Here is some text. It needs to be displayed to the right of the .test-sider div which contains the font-awesome icon.</p></div>
          </div>

          <div class="test-box">
            <div class="test-sider"><i class="fa fa-tasks"></i></div>
            <div class="test-main"><p>Here is some more text. It's just for demonstration purposes</p></div>
          </div>

          <div class="test-box">
            <div class="test-sider"><i class="fa fa-frown-o"></i></div>
            <div class="test-main">Here is some text. It needs to be displayed to the right of the .test-sider div which contains the font-awesome icon. Here is some text. It needs to be displayed to the right of the .test-sider div which contains the font-awesome icon. Here is some text. It needs to be displayed to the right of the .test-sider div which contains the font-awesome icon.</div>
          </div>

          <div class="test-box">
            <div class="test-sider"><i class="fa fa-inbox"></i></div>
            <div class="test-main">Here is some text. It needs to be displayed to the right of the .test-sider div which contains the font-awesome icon. Here is some text. It needs to be displayed to the right of the .test-sider div which contains the font-awesome icon. Here is some text. It needs to be displayed to the right of the .test-sider div which contains the font-awesome icon.</div>
          </div>

          <div class="test-box">
            <div class="test-sider"><i class="fa fa-book"></i></div>
            <div class="test-main">Here is some text. It needs to be displayed to the right of the .test-sider div which contains the font-awesome icon. Here is some text. It needs to be displayed to the right of the .test-sider div which contains the font-awesome icon. Here is some text. It needs to be displayed to the right of the .test-sider div which contains the font-awesome icon.</div>
          </div>

          <div class="test-box">
            <div class="test-sider"><i class="fa fa-fire-extinguisher"></i></div>
            <div class="test-main">Here is some text. It needs to be displayed to the right of the .test-sider div which contains the font-awesome icon. Here is some text. It needs to be displayed to the right of the .test-sider div which contains the font-awesome icon. Here is some text. It needs to be displayed to the right of the .test-sider div which contains the font-awesome icon.</div>
          </div>

          <div class="test-box">
            <div class="test-sider"><i class="fa fa-bullseye"></i></div>
            <div class="test-main">Here is some text. It needs to be displayed to the right of the .test-sider div which contains the font-awesome icon. Here is some text. It needs to be displayed to the right of the .test-sider div which contains the font-awesome icon. Here is some text. It needs to be displayed to the right of the .test-sider div which contains the font-awesome icon.</div>
          </div>

          <div class="test-box">
            <div class="test-sider"><i class="fa fa-crosshairs"></i></div>
            <div class="test-main">Here is some text. It needs to be displayed to the right of the .test-sider div which contains the font-awesome icon. Here is some text. It needs to be displayed to the right of the .test-sider div which contains the font-awesome icon. Here is some text. It needs to be displayed to the right of the .test-sider div which contains the font-awesome icon.</div>
          </div>

<?php
// code here to add the boxes required. Doesn't seem as though masonry style will work

?>
        </div><!-- End class="row" -->
          <!-- </div> --><!-- End class="container content grid-boxes" -->
        <!-- </div> --><!-- End class="blog_masonry_3col" -->
      </div><!-- End class="col-md-9" -->
    </div><!-- End class="row" -->


<!-- :::::::::::::::::: Include separate footer file ::::::::::::::::::::: -->
<?php include "footer.php"; ?>