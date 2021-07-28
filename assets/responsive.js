(function($){
   
    $(".menu").slideToggle("slow", function(){
        $("i").toggleClass("fa-bars");
         $("i").toggleClass("fa-times");
    });
    $('#burger').on('click', function() {
        $(".menu").slideToggle("slow", function() {
            $("i").toggleClass("fa-bars");
            $("i").toggleClass("fa-times");
           
        });
        
    });
    


})(jQuery);