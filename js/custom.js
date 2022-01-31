(function($) {
  $(document).ready(function() {
    maxHeight = $('.views_slideshow_cycle_main', "#mmoda-home-banner-events").height();
    $(".mmoda-event-content", "#mmoda-home-banner-events").height(maxHeight);
  });
  Drupal.behaviors.AlignPopup = {
    attach: function() {
      popup = $('#modalContent');
      // Function align element in the middle of the screen.
      function alignCenter() {
        // Popup size
        var wpopup = popup.width();
        var hpopup = popup.height();
        // Window size.
        var hwindow = $(window).height();
        var wwindow = $(window).width();
        var Left = Math.max(40, parseInt($(window).width() / 2 - wpopup / 2));
        var Top = Math.max(40, parseInt($(window).height() / 2 - hpopup / 2));
        if (hwindow < hpopup) {
          popup.css({ 'position': 'absolute' });
        }
        else {
          popup.css({ 'position': 'fixed' });
        }
        popup.css({ 'left': Left, 'top': Top });
      };
      alignCenter();
      $(window).resize(function() {
        alignCenter();
      });


      popup.resize(function() {
        alignCenter();
      });
    }
  }
}(jQuery))