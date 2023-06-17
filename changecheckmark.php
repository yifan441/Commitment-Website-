#!/usr/local/bin/php
<?php

    session_start();


    // if the user submitted the follow-through form, then store variables of their info
    if($_POST["submit_followthrough"]) {
       
        $submitted_firstname = isset($_POST["firstname"]) ? trim($_POST["firstname"]): "";
        $submitted_lastname = isset($_POST["lastname"]) ? trim($_POST["lastname"]): "";
        $submitted_email = isset($_POST["email"]) ? trim($_POST["email"]): "";
        $submitted_confirm_email = isset($_POST["confirm_email"]) ? trim($_POST["confirm_email"]): "";
        $followup = isset($_POST["radio"]) ? $_POST["radio"]: "";


        // these are the error messages that the participant will get if they have done something wrong
        if(!$submitted_firstname) {
            $_SESSION["message"] = "Please enter your first name with a capitalized first letter.";
        }
 
        else if(!$submitted_lastname) {
            $_SESSION["message"] = "Please enter your last name with a capitalized first letter.";
        }

        else if(!$submitted_email) {
            $_SESSION["message"] = "Please enter your correct email.";
        }
       
        else if($submitted_email != $submitted_confirm_email) {
            $_SESSION["message"] = "Emails do not match, please reenter.";
        }
        else if(!filter_var($submitted_email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION["message"] = "Email is invalid, please reenter.";
        }
     
        // if no error messages were created, then the following else statement will execute
        else {
            $db = new SQLite3('participants.db');


            $statement = 'CREATE TABLE IF NOT EXISTS participants(firstname TEXT, lastname TEXT, email TEXT, affiliation TEXT, cdate TEXT, landingpageversion TEXT, followup INTEGER)';
            $db->exec($statement); 

            //searches through the database to find a participant that has the same first name, last name, and email address as what was typed into the follow through form 
            $statement = 'SELECT lastname FROM participants WHERE email=\''.strtolower($submitted_email).'\''.' AND firstname=\''.trim(ucwords(strtolower($submitted_firstname))).'\''.' AND lastname=\''.trim(ucwords(strtolower($submitted_lastname))).'\'';


            $results = $db->query($statement);
            $row = $results->fetchArray();
            if($row['lastname']) {

                // this sets the participant's followup value to "1" or "0", meaning they followed through or not
                $statement = 'UPDATE participants SET followup ='.intval($followup).' WHERE lastname =\''.$row['lastname'].'\'';
                $db->exec($statement);
                 $_SESSION["message"] = "Thank you for following through, we appreciate it!";
                header("Location: followthrough.php");
                exit;

            } else {

                //if the user did not fill out the form with correct info, this message is displayed
                $_SESSION["message"] = "We could not find your information, please make sure that all of your info is the same as when you signed up for the precommitment. Also, please make sure that you capitalize the first letter of your first and last name!";
            }
            $db->exec($statement);
            $db->close();
        }
           
    }

    header("Location: followthrough.php");
    exit;

?>