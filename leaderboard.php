#!/usr/local/bin/php
<?php 
   
    session_start();

    $db = new SQLite3('participants.db');

    $statement = 'CREATE TABLE IF NOT EXISTS participants(firstname TEXT, lastname TEXT, email TEXT, affiliation TEXT, cdate TEXT, landingpageversion TEXT, followup INTEGER)';
    $db->exec($statement);


    // this code was copied from the dashboard code, but we ended up not really needing any of it except for list_results (affiliation list). If future programmers want to delete unused variables, that is okay.
    $statement = 'SELECT firstname FROM participants WHERE lastname=\''.$_SESSION["UserData"]["username"].'\'';
    $results = $db->query($statement);
    $row = $results->fetchArray();
    $firstname = $row['firstname'];
    $lastname = $row['lastname'];
    $date = $row['cdate'];
    $followupversion = $row['followupversion'];
    $followup=$row['followup'];
    $affiliation = $row['affiliation']; 
    $statement = 'SELECT DISTINCT affiliation FROM participants';
    $list_results = $db->query($statement);


    // this creates an array that stores the # of pariticpants within each dorm affiliation. 
    $arrayforwinner = array();
    while($dorm_list = $list_results->fetchArray())
        {

            $rows = $db -> query('SELECT COUNT(*) as count FROM participants WHERE affiliation="'.$dorm_list['affiliation'].'"');
            $row = $rows->fetchArray();
            if ($row['count']) {
            $arrayforwinner[] = $row['count'];
          }
          else{
            $arrayforwinner= array();
            $arrayforwinner[] = 0;
          }

        }

        // this selects the dorm with the highest number of participants and stores it as the winner. 
        if (max($arrayforwinner) > 0) {
    $statement = 'SELECT affiliation FROM participants GROUP BY affiliation HAVING COUNT(*)='.max($arrayforwinner);
    $results = $db->query($statement);
    $row = $results->fetchArray();
    $i = 1;
    while ($i<2){
    $winner = $row['affiliation'];
    $i+=1;
}
}
else{
  $winner = "No-one yet!";
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Precommitment LeaderBoard</title>
    <link rel="stylesheet" href="dashboard.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap"
      rel="stylesheet"
    />
  </head>

  <body>
    <div id="main-div">
      <header>
        <h1>LeaderBoard</h1>
      </header>

      <main>
        <p><span id="winner-span"><?php echo $winner; ?></span> is winning!!</p>
        <div id="table-div">
        <?php
        // this is the table that is displayed for the leaderboard
            echo "<table style=\"border:1px solid black\">
            <tr>
            <th>Dorm</th>
            <th>Number Committed</th>
            </tr>";

            while($dorm_list = $list_results->fetchArray())
            {

            echo "<tr>";
            $rows = $db -> query('SELECT COUNT(*) as count FROM participants WHERE affiliation="'.$dorm_list['affiliation'].'"');
            if ($rows) {
            $row = $rows->fetchArray();
            echo "<td>".$dorm_list['affiliation']."</td>";
            echo "<td>".$row['count']."</td></tr>";
          }
        }
            echo "</table>";
            $db->close();
            ?>
        </div>
      </main>
    </div>
  </body>
</html>
