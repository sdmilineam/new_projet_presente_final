(function($){

    $('#burger').on('click', function() {
        $(".menu").slideToggle("slow", function() {
            $("i").toggleClass("fa-times");
            $("i").toggleClass("fa-bars");
           
        });
    });
    


})(jQuery);