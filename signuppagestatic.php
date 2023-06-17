#!/usr/local/bin/php
<?php
  
    session_start();
    // this function allows an error message to pop up if needed
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
    <link rel="stylesheet" href="signuppagestatic.css" />
    <title>Sign Up</title>
  </head>

  <!--Any white text can be reworded, it shows up on the page.-->
  <body>
    <main>
      <div id="main-div">
        <div id="secondary-div">
          <h1 id="signup-text">Welcome!</h1>
          <p id="subtext">Make a precommitment today</p>
          <!--This form allows participants to sign up to make a precommitment.-->
          <form method="POST" action="signupstatic.php">
            <label for="firstname">First name:</label>
            <input value="" id="firstname" name="firstname" placeholder="Joe" />
            <label for="lastname">Last name:</label>
            <input value="" id="lastname" name="lastname" placeholder="Bruin" />
            <label for="email" class="email">Email:</label>
            <input
              value=""
              id="email"
              name="email"
              class="email"
              placeholder="example@gmail.com"
            />
            <label for="confirmemail" class="c">Confirm Email:</label>
            <input
              value=""
              class="c"
              id="confirm_email"
              name="confirm_email"
              placeholder="example@gmail.com"
            />
            <!--This is the drop down list for dorms. Feel free to add another <option>, or change them completely to something else. As you can see, there is a pattern for adding options to the list, so I think you can easily figure out how to change this list.-->
            <label for="affiliation" class="c">Dorm Affiliation:</label>
            <select name="affiliation" id="affiliation" class="c">
              <option value="" selected disabled hidden>select a dorm</option>
              <option value="Canyon Point & Courtside">
                Canyon Point & Courtside
              </option>
              <option value="Centennial Hall">Centennial Hall</option>
              <option value="Delta Terrace">Delta Terrace</option>
              <option value="De Neve East">De Neve East</option>
              <option value="De Neve West">De Neve West</option>
              <option value="De Neve Towers">De Neve Towers</option>
              <option value="Dykstra Hall">Dykstra Hall</option>
              <option value="Hedrick Hall">Hedrick Hall</option>
              <option value="Hedrick Summit">Hedrick Summit</option>
              <option value="Hitch Suites">Hitch Suites</option>
              <option value="Olympic Hall">Olympic Hall</option>
              <option value="Rieber Hall">Rieber Hall</option>
              <option value="Rieber Terrace">Rieber Terrace</option>
              <option value="Rieber Vista">Rieber Vista</option>
              <option value="Saxon Suites">Saxon Suites</option>
              <option value="Sproul Cove/Landing">Sproul Cove/Landing</option>
              <option value="Sproul Hall">Sproul Hall</option>
              <option value="Westwood Hills">Westwood Hills</option>
              <option value="Gayley Heights">Gayley Heights</option>
              <option value="Southwest">Southwest</option>
              <option value="Weyburn/Hilgard">Weyburn/Hilgard</option>
              <option value="Sawtelle">Sawtelle</option>
              <option value="Sepulveda">Sepulveda</option>
              <option value="Keystone/Mentone">Keystone/Mentone</option>
              <option value="Venice/Barry">Venice/Barry</option>
              <option value="Rose Ave/Clarington">Rose Ave/Clarington</option>
              <option value="Unaffiliated">Unaffiliated</option>
            </select>
            <input type="checkbox" id="tandc" name="tandc" />
            <label for="tandc" id="terms">
              I have read and accept the
              <a href="termsAndConditions.html" target="_blank">
                Terms and Conditions</a
              >
            </label>
            <input
              type="submit"
              id="signupbutton"
              name="submit_signup"
              value="Commit!"
            />
          </form>
        </div>
      </div>
    </main>
  </body>
</html>