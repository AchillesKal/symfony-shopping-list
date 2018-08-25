/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you require will output into a single css file (app.css in this case)
require('../css/app.scss');

// Need jQuery? Install it with "yarn add jquery", then uncomment to require it.
var $ = require('jquery');


$(document).ready(function() {

  var $wrapper = $('.js-products-wrapper');

  $wrapper.on('click', '.js-remove-product', function(e) {
    e.preventDefault();
    $(this).closest('.js-product-item')
      .fadeOut()
      .remove();
  });

  $wrapper.on('click', '.js-product-add', function(e) {
    e.preventDefault();
    // Get the data-prototype explained earlier
    var prototype = $wrapper.data('prototype');
    // get the new index
    var index = $wrapper.data('index');
    // Replace '__name__' in the prototype's HTML to
    // instead be a number based on how many items we have
    var newForm = prototype.replace(/__name__/g, index);
    // increase the index with one for the next item
    $wrapper.data('index', index + 1);
    // Display the form in the page before the "new" link
    $(this).before(newForm);
  });

});