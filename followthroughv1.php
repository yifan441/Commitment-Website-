#!/usr/local/bin/php
<?php

  // THIS IS A COPY OF FOLLOWTHROUGH.PHP
  
    session_start();

    function phpalert($string) {
        echo "<script type=\"text/javascript\">";
        echo "alert(\"$string\")";
        echo "</script>";
    }

   
    if($_SESSION["message"]) {
        phpalert($_SESSION["message"]);
        $_SESSION["message"] = "";
    }
?>
<!DOCTYPE html>

<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="followthrough.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap"
      rel="stylesheet"
    />
    <title>Follow Up</title>
  </head>

  <body>
    <div id="main-div">
      <header>
        <h1 id="header">Follow Through</h1>
      </header>

      <main>
        <p id="instructions">
          Please enter your information into this form (same info from making
          your precommitment).
        </p>
        <div id="secondary-div">
          <form
            method="POST"
            action="changecheckmark.php"
            style="text-align: center"
          >
            <label for="firstname">First name:</label>
            <input value="" id="firstname" name="firstname" />
            <label for="lastname">Last name:</label>
            <input value="" id="lastname" name="lastname" />
            <label for="email" class="email">Email:</label>
            <input value="" id="email" name="email" class="email" />
            <label for="confirmemail" class="c">Confirm Email:</label>
            <input value="" class="c" id="confirm_email" name="confirm_email" />
            <p id="follow-through-prompt">
              Did you follow through with your precommitment? Be honest! ;)
            </p>
            <label for="yes" id="yes-label">Yes </label>
            <input
              type="radio"
              checked="checked"
              name="radio"
              value="1"
              id="yes"
            />
            <label for="no" id="no-label"> No </label>
            <input type="radio" name="radio" value="0" id="no" />

            <input
              type="submit"
              id="submit"
              name="submit_followthrough"
              value="Submit"
            />
          </form>
        </div>
      </main>
    </div>
  </body>
</html>