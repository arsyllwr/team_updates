<!-- 

A set of functions that execute queries and return 

 -->

<?php

function getTeamList() {
// return a list of team members and the update count
	$team_query = "SELECT RegisteredUsers.FirstName + ' ' + RegisteredUsers.LastName AS FullName, COUNT(tuWeeklyUpdates.UserId) AS NumInstances
	               FROM tuWeeklyUpdates RIGHT OUTER JOIN
	               RegisteredUsers ON tuWeeklyUpdates.UserId = RegisteredUsers.UserId
	               WHERE (RegisteredUsers.TeamId = 66) AND (RegisteredUsers.StatusId = 1)
	               GROUP BY RegisteredUsers.LastName, RegisteredUsers.FirstName";
	return mssql_query($team_query);
}

function getUpdateTypes() {
// return the list of update types, and the count of types in the weekly updates table
	$update_type_query = "SELECT tuUpdateType.UpdateType, COUNT(tuWeeklyUpdates.UpdateTypeId) AS NumOccurences 
	                      FROM tuWeeklyUpdates INNER JOIN 
	                      tuUpdateType ON tuWeeklyUpdates.UpdateTypeId = tuUpdateType.UpdateTypeId 
	                      GROUP BY tuUpdateType.UpdateType";
	return mssql_query($update_type_query);
}
