#!/usr/local/bin/php
<?php
// SEE VERSION A FOR COMMENTS
session_start();
$_SESSION['landing'] = 'v3';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Welcome!</title>
    <script src="landingPage.js" defer></script>
    <link rel="stylesheet" href="landingPage.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap"
      rel="stylesheet"
    />
  </head>
  <body>
    <main>
      <section id="commit-section">
        <h1>Make a commitment to make a difference on Volunteer Day 2023</h1>
        <p>
          Click the button below to make your commitment, and we'll remind you
          to follow through when the time comes!
        </p>
        <input type="button" value="Commit!" id="commit-btn" />
      </section>
      <section id="info-section">
        <div id="info-div">
          <p id="info-div-header">How it works:</p>
          <ol>
            <li>
              Fill out the form to make your commitment to join Volunteer Day
              2023.
            </li>
            <li>
              Find yourself - and your friends! - on the dashboard of committed
              volunteers.
            </li>
            <li>
              Multiply your impact by sending
              <a href="landingPage_rvc.php">precommit.us</a> to others.
            </li>
            <li>
              Let us know when you follow through and we'll share the good news
              on the dashboard!
            </li>
          </ol>
          <p id="info-div-header">About Volunteer Day</p>
          <p>
            The UCLA Volunteer Center's main event, UCLA Volunteer Day, has
            become a cornerstone of the UCLA experience. It is one of the
            university's largest community service events and occurs during True
            Bruin Welcome. New freshmen and transfer students join together with
            continuing undergraduates, graduate students, faculty, staff,
            alumni, parents, and community members to participate in a wide
            range of community service projects across Los Angeles and the
            globe. Volunteers participate at 45+ community partner sites
            providing critical service work, beautification, and support at food
            banks, parks, shelters, senior centers, schools, veterans'
            facilities, and various other community organizations.
          </p>
        </div>
      </section>
      <img
        src="png-clipart-university-of-california-los-angeles-ucla-bruins-football-bear-logo-brand-bear-removebg-preview.png"
        id="bruinbear"
      />
      <div id="dashboard-div">
        <p>
          Want to see who else is making a difference? Check out the dashboard!
        </p>
        <input type="button" value="Dashboard" id="dashboard-btn" />
      </div>
      <br />
      <section id="tac-section">
        <a href="termsAndConditions.html" target="_blank">Terms and Conditions</a>
      </section>
    </main>
  </body>
</html>
