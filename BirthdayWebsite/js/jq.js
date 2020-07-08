$('.owl-carousel').owlCarousel({
    loop:true,
    nav:true,
    navigationText : ["",""],
    autoplay:100,
    autoplayHoverPause:true,
    merge:true,
    responsive:{
        0:{
            items:1,
            mergeFit:true
        },
        600:{
            items:2,
            mergeFit:false
        },
        900:{
            items:3,
            mergeFit:false
        },
        1200:{
            items:4,
            mergeFit:false
        },
        1700: {
            items: 5,
            mergeFit: false
        }
    }
})
$(".goto").click(function() {
    window.location = $(this).find("a").attr("href"); 
    return false;
  });

function myFunction(imgs) {
    // Get the expanded image
    var expandImg = document.getElementById("modal-img");
    // Get the image text
    var imgText = document.getElementById("caption");
    // Use the same src in the expanded image as the image being clicked on from the grid
    expandImg.src = imgs.src;
    // Use the value of the alt attribute of the clickable image as text inside the expanded image
    imgText.innerHTML = imgs.alt;
    // Show the container element (hidden with CSS)
    expandImg.parentElement.style.display = "block";
    onkeydown = function(evt){
        if (evt.keyCode == 27) 
        expandImg.parentElement.style.display='none';
    }
  }