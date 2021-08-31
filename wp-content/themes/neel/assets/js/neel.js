(function($) {
  "use strict"; // Start of use strict

  /**
   * Calculate and set custom header media height.
   */
  function calculateBannerHeight() {
    var customHeadHeight = 0;
    if( $( '.site-banner-image' ).length ) {
      if( $('.custom-heading').length ) {
         customHeadHeight = $( '.custom-heading' ).outerHeight( true );
        $( '.site-banner-image' ).css( 'min-height', customHeadHeight+40 );
      }
    }
  }

  $( document ).ready(
    function () {
       calculateBannerHeight();
    }
  );

  $( window ).resize(function(){
    calculateBannerHeight();
    }
  );
  /**
   * Control the serchbox events.
   */
  $('.link-search-icon').on('click tap',function(event) {
     $('.neel-popup-search-form').addClass('open-search-form');
     var x = setTimeout('jQuery(".neel-popup-search-form .search-form .search-field").focus()', 700);
  });
  
  $('.neel-close-popup').on('click tap', function (event) {
      $('.neel-popup-search-form').removeClass('open-search-form');
      $('.link-search-icon').focus();
  });

  //Set focus to input field in search form
  if( $('.neel-popup-search-form').css('display') == 'block' ) {
    $('.neel-popup-search-form .search-form .search-field').focus();
  };

  $('.dark-mode-switcher a.dark').on('click tap',function(event) {
      $('.dark-mode-switcher a.dark').hide();
      $('.dark-mode-switcher a.bright').css('display','block');
      $('body').addClass('neel-dark-theme');
      $( ".dark-mode-switcher a.bright" ).focus();
      localStorage.setItem( 'neelDarkMode', 'on' );
  });
  $('.dark-mode-switcher a.bright').on('click tap',function(event) {
  		$('.dark-mode-switcher a.bright').hide();
      $('.dark-mode-switcher a.dark').css('display','block');
      $('body').removeClass('neel-dark-theme');
      $('.dark-mode-switcher a.dark').focus();
      localStorage.setItem( 'neelDarkMode', 'off' );
  });

// Apply on Load
  if ( 'on' === localStorage.getItem('neelDarkMode') ) {
    $('.dark-mode-switcher a.dark').hide();
    $('.dark-mode-switcher a.bright').css('display','block');
    $('body').addClass('neel-dark-theme');
    $( 'body' ).addClass( 'neel-dark-theme' );
  }

  $('.menu-toggle').on('click',function() {
    $(this).toggleClass('toggled');
    $('.primary-menu-list').slideToggle();
  });

  $('.dropdown-toggle').on('click',function() {
    $(this).next().slideToggle(300);
  });

  //loop the focus of elements when tab and tab+shift keys are used in keyboard navigation
  $( ".neel-popup-search-form" ).keydown( function( event ) {

      var tabKey = event.keyCode === 9;
      var shiftKey = event.shiftKey;
      if( shiftKey || tabKey) {
        var selectors = 'a, input, button';
        var parent = $( document ).find('.neel-popup-search-form');
        var elements = parent.find(selectors);
        
        var firstEl = elements[0];
        
        var lastEl = elements[elements.length -1 ];
        
        var activeEl = event.target;

        if ( ! shiftKey && tabKey && lastEl === activeEl ) {
          event.preventDefault();
          firstEl.focus();
        }

        if ( shiftKey && tabKey && firstEl === activeEl ) {
          event.preventDefault();
          lastEl.focus();
        }
      }
    });

    //loop the focus of elements when tab and tab+shift keys are used in keyboard navigation
    $( '#site-navigation' ).keydown( function( event ) {
      var tabKey,shiftKey,selectors,parent,elements,firstEl,lastEl,activeEl;
      tabKey = event.keyCode === 9;
      shiftKey = event.shiftKey;
      if( shiftKey || tabKey) {
        selectors = 'button, li, a,.dark-mode-switcher,.search-icon-box';
        //selectors = 'button';
        parent = $( document ).find('.primary-menu-list');
        //parent = $( document ).find('.main-navigation');

        elements = parent.find(selectors);
        elements = elements.filter('button, li, a');
        for( var i = 0; i < elements.length; i++){ 
            if ( elements[i] === '.dark-mode-switcher') { 
                arr.splice(i, 1); 
            }
            if ( elements[i] === '.search-icon-box' ) { 
                arr.splice(i, 1); 
            }
        }
        firstEl = elements[1];
        lastEl = elements[elements.length - 1 ];
        activeEl = event.target;
        console.log(elements);
        if ( ! shiftKey && tabKey && lastEl === activeEl && $('.menu-toggle').css('display') !== 'none' ) {
          event.preventDefault();
          //firstEl.focus();
          $('.menu-toggle.toggled').focus();
        }

        if ( shiftKey && tabKey && firstEl === activeEl && $('.menu-toggle').css('display') !== 'none' ) {
          event.preventDefault();
          //lastEl.focus();
          $('.menu-toggle.toggled').focus();
        }
      }
    });

    if ($('.site-slider-banner').length > 0) {
        $('.site-slider-banner').slick({
          items: 1,
          dots: true,
          arrows: true,
          infinite: true,
          centerMode: false,
          autoplay: false,
          adaptiveHeight: true,
          responsive: [
            {
              breakpoint: 768,
              settings: {
                arrows: false,
              }
            },
          ]
      });
    }
})(jQuery); // End of use strict