

$(document).ready(function(){
    
    
    $('#btnClick').on('click',function(){
        if($('#1').css('display')!='none'){
        $('#2').show().siblings('div').hide();
        }else if($('#2').css('display')!='none'){
            $('#1').show().siblings('div').hide();
        }
    });
    
    
    $('#btnA').on('click',function(){
            $('#1').show().siblings('div').hide();
    });
    
    $('#btnB').on('click',function(){
            $('#2').show().siblings('div').hide();
    });

    $('#btnC').on('click',function(){
            $('#3').show().siblings('div').hide();
    });
    
    $('#btnD').on('click',function(){
            $('#4').show().siblings('div').hide();
    });
    

    // When the user scrolls the page, execute myFunction 
    window.onscroll = function() {myFunction()};
    
    // Get the navbar
    var navigate = document.getElementById("navigate");
    
    // Get the offset position of the navbar
    var sticky = navigate.offsetTop;
    
    // Add the sticky class to the navbar when you reach its scroll position. Remove "sticky" when you leave the scroll position
    function myFunction() {
      if (window.pageYOffset >= sticky) {
        navigate.classList.add("sticky")
      } else {
        navigate.classList.remove("sticky");
      }
    }
    

}); 


$(document).ready(function() {
  $('li.active').removeClass('active');
  $('a[href="' + location.pathname + '"]').closest('li').addClass('active'); 
});



