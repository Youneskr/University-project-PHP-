mybutton = document.getElementById("myBtn");
window.onscroll = function() {scrollFunction()};
function scrollFunction() {
  if (document.body.scrollTop > 87.5 || document.documentElement.scrollTop > 87.5) {
    mybutton.style.display = "block";
  } else {
    mybutton.style.display = "none";
  }
}
function topFunction() {
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
}
// ____________________________________________________________________________________________


function affiche(){
  forum_clic = document.getElementById("forum-clic");
  clic = document.getElementById("clic");
  if(forum_clic.style.display =='none'){
    forum_clic.style.display ='block';
    clic.style.display ='none';
  }
  else {
    forum_clic.style.display ='none';
  }
}