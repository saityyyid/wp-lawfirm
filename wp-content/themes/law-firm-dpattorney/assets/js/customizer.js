// law-firm-dpattorney customizer.js
(function($){
  wp.customize('color_primary_dark', function(value) {
    value.bind(function(newval) {
      document.documentElement.style.setProperty('--color-primary-dark', newval);
    });
  });
  // ...repeat for other customizer settings...
})(jQuery);
