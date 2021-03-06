/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.scss';

// start the Stimulus application
import './bootstrap';



// require jQuery normally
const $ = require('./jquery.js');
// create global $ and jQuery variables
global.$ = global.jQuery = $;

$("i").toggleClass("fa-bars").hide;
$("i").toggleClass("fa-times").hide;


$('#burger').on('click', function(){
    $(".menu ").slideToggle();
    $(".menu ").on('click', function(){
        $("#menu ul").slideUp();
        $("i").toggleClass("fa-bars").hide;
        $("i").toggleClass("fa-times").show;
    })

})