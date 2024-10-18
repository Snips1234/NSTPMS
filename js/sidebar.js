const hamBurger = document.querySelector("#toggle-btn");
hamBurger.addEventListener('click', function() {
  document.querySelector('#sidebar').classList.toggle("expand");
});

window.addEventListener('resize', function() {
  const sidebar = document.querySelector('#sidebar');
  
  if (window.innerWidth <= 996) {
    // Collapse the sidebar by removing the 'expand' class
    sidebar.classList.remove('expand');
  } else {
    // Expand the sidebar by adding the 'expand' class
    sidebar.classList.add('expand');
  }
});
window.dispatchEvent(new Event('resize'));