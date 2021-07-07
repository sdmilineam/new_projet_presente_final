(function($){
 
    $(".icon").click(function(){
      $("ul").slideToggle("slow");
    });
    
    
    $(".prev").click(function(){
      $('.slidershow').animate({left: '+=100vw' },"slow");
    });
    
    $(".next").click(function(){
      $('.slidershow').animate({left: '-=100vw' },"slow");
    });  
  
  
  //   $('input').click(function() {
  //     $('#destination').val($(this).html());
  //  });
  
  
  
  
  
  
  
  })(jQuery);