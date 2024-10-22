document.getElementById('navbar-toggle').addEventListener('click', function() {
  var navbar = document.getElementById('navbar-default');
  var isExpanded = this.getAttribute('aria-expanded') === 'true';

  this.setAttribute('aria-expanded', !isExpanded);
  navbar.classList.toggle('hidden');
});