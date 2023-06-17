//this code just adds functionality to the buttons on the landing pages

const commit_btn = document.getElementById('commit-btn');
const dashboard_btn = document.getElementById('dashboard-btn');

commit_btn.addEventListener('click', handle_commit);
dashboard_btn.addEventListener('click', handle_dashboard);

function handle_commit() {
  // replace page with sign up form
  window.location.href = 'signuppagestatic.php';
}

function handle_dashboard() {
  // open dashboard in new tab
  window.open('dashboard.php', '_blank');
}
