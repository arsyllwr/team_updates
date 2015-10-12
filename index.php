<?php

// Connect to the Powerview database
include $_SERVER['DOCUMENT_ROOT'] . '/common/mod_database.php';
connect_PVDB();

// Get the user details
include $_SERVER['DOCUMENT_ROOT'] . '/common/mod_user.php';
$user =  json_decode(get_user_info($_SERVER['REMOTE_USER']));

// Get the current user's windows login
if ($user->PDUser=='No') {
    // Prompt to enter their details in PD
    echo '<div class="not_found">Oops! We can\'t find you in the People Directory. Please <a href="http://intrapps.tns-global.com/uk/worldpanel/deliveryservices/ChangeControl/clientservice.asp?choice=100">click here</a> to update your details and then try again.</div>';
} else {
// Store the user ID in a variable
  $userID = $user->UserID;

//What appears at top in greeting
  $displayname = $user->FirstName;
}

// set page title and include separate header file
$title = "service design & development";
$subtitle = "team updates";
include "header.php";

// keep the textareas to 1 line when not in focus
//$rowsInTextArea = 1;
// get the list of update types from the database table
//$updateTypeQuery = mssql_query('SELECT UpdateType FROM tuUpdateType;');

?>

<!-- ::::::::::::::::::: Add links to sections :::::::::::::::::::: -->

<div>   <!-- class="col-md-9" -->
  <div><p>Click <a href="new_update.php">here</a> to add latest weekly updates</p></div>
  <div><p>Click <a href="view_updates.php">here</a> to review previously entered updates</p></div>
</div>

<!-- :::::::::::::::::: Include a separate footer file ::::::::::::::::::::: -->
<?php include "footer.php"; ?>


</div><!-- /class="wrapper" -->

    <!-- JS Global Compulsory -->     
    <script type="text/javascript" src="assets/plugins/jquery/jquery.min.js"></script>
    <script type="text/javascript" src="assets/plugins/jquery/jquery-migrate.min.js"></script>
    <script type="text/javascript" src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <!-- JS Implementing Plugins -->
    <script type="text/javascript" src="assets/plugins/back-to-top.js"></script>
    <script type="text/javascript" src="assets/plugins/smoothScroll.js"></script>
    <script src="assets/plugins/sky-forms-pro/skyforms/js/jquery-ui.min.js"></script>
    <script type="text/javascript" src="assets/plugins/masonry/jquery.masonry.min.js"></script>
    <script type="text/javascript" src="plugins/autosize.js"></script>

    <!-- JS Customization -->
    <script type="text/javascript" src="assets/js/custom.js"></script>
    <!-- JS Page Level -->
    <script type="text/javascript" src="assets/js/app.js"></script>
    <script type="text/javascript" src="assets/js/plugins/datepicker.js"></script>
    <script type="text/javascript" src="assets/js/pages/blog-masonry.js"></script>
    
    <!-- JS user customisations -->
    <script type="text/javascript" src="js/app.js"></script>
    <script type="text/javascript" src="js/app_jqy.js"></script>

    <script type="text/javascript">
        jQuery(document).ready(function() {
            App.init();
            Datepicker.initDatepicker();
            autosize($('textarea'));
        });
    </script>
<!--[if lt IE 9]>
    <script src="assets/plugins/respond.js"></script>
    <script src="assets/plugins/html5shiv.js"></script>
    <script src="assets/plugins/placeholder-IE-fixes.js"></script>
<![endif]-->

</body>
</html>