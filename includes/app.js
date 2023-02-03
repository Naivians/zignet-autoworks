$(document).ready(function () {
  $("html").niceScroll({
    cursorwidth: "8px",
    autohidemode: false,
    zindex: 999,
    cursorcolor: "#FF70DF",
  });

  $("#adminTable").niceScroll({
    cursorwidth: "8px",
    autohidemode: false,
    zindex: 999,
    cursorcolor: "#FF70DF",
    cursorborder: "none",
  });
});

function navBar() {
  var menuBar = document.getElementById("wrapper");
  menuBar.classList.toggle("move-to-right");

  var side = document.getElementById("sidebar");
  side.classList.toggle("move-to-right");
}



var option1 = {
  width: 450,
  height: 300,
  zoomWidth: 500,
  offset: {
    vertical: 1,
    horizontal: 10,
  },
  scale: 1,
};
new ImageZoom(document.getElementById("zoom-container"), option1);

// function for all reset
function reset() {
    // for admin Account
    $("#adminName").val('');
    $("#password").val('');
    $("#role").val('');
    $("#username").val('');
}
