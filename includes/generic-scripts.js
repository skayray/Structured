// JavaScript Document


//vanilla
document.addEventListener('DOMContentLoaded', function(){
//hamburger animation
const CollapseToggle = document.querySelector('[data-bs-toggle="collapse"]');

  if (CollapseToggle) {
    CollapseToggle.addEventListener('click', function() {
     this.classList.toggle('is-active');
    });
  }
	
});

//jquery
jQuery(document).ready(function($){

	///pulsante back to top
	$('body').append('<div id="toTop"><i class="fas fa-arrow-up"></i></div>')
	mybutton = document.getElementById("toTop");
	window.onscroll = function() {scrollFunction()};
	$("#toTop").click(function () {
   $("html, body").animate({scrollTop: 0}, 1000);
	});

	function scrollFunction() {
	  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
		mybutton.style.display = "block";
	  } else {
		mybutton.style.display = "none";
	  }
	}
	//fine back to top


	$('.smoothscroll').click(function(){
			
			fullurl=$.attr(this, 'href');
			urlanchor_pos=fullurl.indexOf("#");
			urlanchor=fullurl.substr(urlanchor_pos);
			console.log(urlanchor);
			target= $( urlanchor ).offset().top - 100;
			$('html, body').animate({
				scrollTop: target
			}, 800);
			return false;
		});
});