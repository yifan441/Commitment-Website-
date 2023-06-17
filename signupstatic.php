#!/usr/local/bin/php
<?php

    session_start();
    // if the participant signed up, this code will execute. First, it creates variables of the info submitted.
    if($_POST["submit_signup"]) {
       
        $submitted_firstname = isset($_POST["firstname"]) ? $_POST["firstname"]: "";
        $submitted_lastname = isset($_POST["lastname"]) ? $_POST["lastname"]: "";
        $submitted_email = isset($_POST["email"]) ? $_POST["email"]: "";
        $submitted_confirm_email = isset($_POST["confirm_email"]) ? $_POST["confirm_email"]: "";
        $affiliation = isset($_POST["affiliation"]) ? $_POST["affiliation"]: "";
        $checked = isset($_POST["tandc"]);
        date_default_timezone_set('America/Los_Angeles');
        $date = date('m/d/Y');

        // this variable is the landing page version, which is n/a if the participant went directly to the sign-up page and bypassed the landing page. 
        if (isset($_SESSION['landing'])) {
            $landingpageversion = $_SESSION['landing'];
            } else {
            $landingpageversion = "n/a";
            }


        $followup=0;

        // these are the error messages that can be displayed if the participant did something wrong when signing up. 

        if(!$submitted_firstname) {
            $_SESSION["message"] = "Please enter your first name.";
        }
 
        else if(!$submitted_lastname) {
            $_SESSION["message"] = "Please enter your last name.";
        }

        else if(!$submitted_email) {
            $_SESSION["message"] = "Please enter your email.";
        }
       
        else if($submitted_email != $submitted_confirm_email) {
            $_SESSION["message"] = "Emails do not match, please reenter.";
        }
        else if(!filter_var($submitted_email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION["message"] = "Email is invalid, please reenter.";
        }

        else if(!$checked){
            $_SESSION["message"] = "Please confirm that you have read the Terms and Conditions.";
        }
     
        // this else statement runs if no errors were found. 
        else {
            $db = new SQLite3('participants.db');

                // opens the database and creates/opens the participants table
            $statement = 'CREATE TABLE IF NOT EXISTS participants(firstname TEXT, lastname TEXT, email TEXT, affiliation TEXT, cdate TEXT, landingpageversion TEXT, followup INTEGER)';
            $db->exec($statement); 
            $statement = 'SELECT lastname FROM participants WHERE email=\''.$submitted_email.'\'';
            $results = $db->query($statement);
            $row = $results->fetchArray();
            if($row['lastname']) {
                // if the participant was already found in the database, this message is given. 
                $_SESSION["message"] = "You have already committed!";
            } else {
                // if this is a new participant, all of their info will be stored in the database 
                // ucwords and strtolower help to format the names 
                $statement = 'INSERT INTO participants (firstname, lastname, email, affiliation, cdate, landingpageversion, followup) VALUES (\''.ucwords(strtolower($submitted_firstname)).'\', \''.ucwords(strtolower($submitted_lastname)).'\', \''.$submitted_email.'\', \''.$affiliation.'\', \''.$date.'\', \''.$landingpageversion.'\', '.$followup.')';
                $db->exec($statement);
                $db->close(); 
                // relocates to the dashboard after signing up 
                header("Location: dashboard.php");
                exit;

            }
            $db->exec($statement);
            $db->close();
        }
           
    }
        // if errors occured, will display on the signup page 
    header("Location: signuppagestatic.php");
    exit;

?>