$("#navs").niceScroll({
  cursorwidth: "8px",
  autohidemode: true,
  zindex: 999,
  cursorcolor: "#FF70DF",
  cursorborder: "none",
  horizrailenabled: false,
});

function toggle() {
  var responsive_nav = document.getElementById("nav-res-container");  

  responsive_nav.classList.toggle("move");
}
