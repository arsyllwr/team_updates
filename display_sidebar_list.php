<?php

/*

*/

function display_sidebar_list($list) {
// function to build the sidebar list of users, update types or dates
// takes a 2-dimensional array of items and counts
  while ($list_arr = mssql_fetch_array($list)) {
    // only show users that have updates against them
    if ($list_arr[1] > 0) {
      echo '<li class="list-group-item">' . $list_arr[0] . '<span class="badge rounded-2x badge-u pull-right">' . $list_arr[1] . '</span></li>';
    }
  }   //end while
}


// temporary variable for testing
$show_team = true;

if ($show_team) {
  $list = $team_names;
} else {
  $list = $update_types;
}
