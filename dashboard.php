#!/usr/local/bin/php
<?php 
   
    session_start();

    $db = new SQLite3('participants.db');

    $statement = 'CREATE TABLE IF NOT EXISTS participants(firstname TEXT, lastname TEXT, email TEXT, affiliation TEXT, cdate TEXT, landingpageversion TEXT, followup INTEGER)';
    $db->exec($statement);

    // creates variables from the database in case we need to access them, most of them were not used, but helps us visualize database
    // $numrows is the number of participants
    $statement = 'SELECT firstname FROM participants WHERE lastname=\''.$_SESSION["UserData"]["username"].'\'';
    $results = $db->query($statement);
    $row = $results->fetchArray();
    $firstname = $row['firstname'];
    $lastname = $row['lastname'];
    $date = $row['cdate'];
    $followup=$row['followup'];
    $statement = 'SELECT * FROM participants';
    $list_results = $db->query($statement);

    $rows = $db->query("SELECT COUNT(*) as count FROM participants");
    $row = $rows->fetchArray();
    $numrows = $row['count'];

    $lastinitial = mb_substr($lastname, 0, 1)."."; // first character of lastname


    $statement = "SELECT DATE('now','localtime') FROM "; 
    $time = "";
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Precommitment Dashboard</title>
    <link rel="stylesheet" href="dashboard.css" />
    <link rel="stylesheet" href="dashboard2.css" />
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
        <h1>Dashboard</h1>
      </header>

      <main>
        <h3>
          <span id="number-committed">
            <?php echo $numrows;?>
          </span> people have committed! Click <a href="leaderboard.php">here</a> to check out the Leaderboard.
        </h3>
        <div id="table-div">
          <?php
              //this creates the table that is displayed
              echo "<table style=\"border:1px solid black\">
              <tr>
              <th>Name</th>
              <th>Dorm</th>
              <th>Date of Commitment</th>
              <th>Followed Through?</th>
              </tr>";
              while($name_list = $list_results->fetchArray())
              {
                  echo "<tr>";
                  echo "<td>".$name_list['firstname']." ".mb_substr($name_list['lastname'], 0, 1)."."."</td>";
                  echo "<td>".$name_list['affiliation']."</td>";
                  echo "<td>".$name_list['cdate']."</td>"; 
                  echo "<td> <label class=\"container\">";

                  //this if-else statement determines whether the checkbox for follow through is checked or not
                  if ($name_list['followup']==0){
                      echo "<input type=\"checkbox\" disabled=\"disabled\">";                  }
                  else {
                      echo "<input type=\"checkbox\" disabled=\"disabled\" checked=\"checked\">";
                  } 
                  echo "<span class=\"checkmark\"></span></label></td>";
                  echo "</tr>";
              }
              echo "</table>";
              $db->close();
          ?>
        </div>
      </main>
    </div>
  </body>
</html>
