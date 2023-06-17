// allows for randomization between versions c and d of the landing page 
window.onload = function () {
  let x = Math.floor(Math.random() * 2);
  if (x) {
    window.location.href = 'landingPage_rvc.php';
  } else {
    window.location.href = 'landingPage_rvd.php';
  }
};
