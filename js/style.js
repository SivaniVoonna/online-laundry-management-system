$(document).ready(function(){
    // Add smooth scrolling to all links in navbar + footer link
    $(".navbar a, footer a[href='#myPage']").on('click', function(event) {
      // Make sure this.hash has a value before overriding default behavior
      if (this.hash !== "") {
        // Prevent default anchor click behavior
        event.preventDefault();
  
        // Store hash
        var hash = this.hash;
  
        // Using jQuery's animate() method to add smooth page scroll
        // The optional number (900) specifies the number of milliseconds it takes to scroll to the specified area
        $('html, body').animate({
          scrollTop: $(hash).offset().top
        }, 900, function(){
     
          // Add hash (#) to URL when done scrolling (default click behavior)
          window.location.hash = hash;
        });
      } // End if
    });
    
    $(window).scroll(function() {
      $(".slideanim").each(function(){
        var pos = $(this).offset().top;
  
        var winTop = $(window).scrollTop();
          if (pos < winTop + 600) {
            $(this).addClass("slide");
          }
      });
    });
  })

  function validate(){
    var uname = document.getElementById("uname").value;
    var pass = document.getElementById("pass").value;
    if(uname.trim()=="" || pass.trim()==""){
        alert("BLANK VALUES NOT ALLOWED!!!");
        document.location.reload(true);
        return false;
    }
}

function validatesign(){
    var p1 = document.getElementById("p1").value;
    var p2 = document.getElementById("p2").value;
    if(p1 != p2){
        alert("Password Confirmation Failed!!!");
        document.location.reload(true);
        return false;
    }
}

