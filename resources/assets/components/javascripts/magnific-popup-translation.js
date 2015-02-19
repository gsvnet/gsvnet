jQuery.extend(true, $.magnificPopup.defaults, {
  tClose: 'Sluiten (Esc)', // Alt text on close button
  tLoading: 'Bezig met laden...', // Text that is displayed during loading. Can contain %curr% and %total% keys
  gallery: {
    tPrev: 'Vorige (pijltje naar links)', // Alt text on left arrow
    tNext: 'Volgende (pijltje naar rechts)', // Alt text on right arrow
    tCounter: '%curr% van de %total%' // Markup for "1 of 7" counter
  },
  image: {
    tError: '<a href="%url%">De foto</a> kon niet worden geladen.' // Error message when image could not be loaded
  },
  ajax: {
    tError: '<a href="%url%">De inhoud</a> kon niet worden geladen.' // Error message when ajax request failed
  }
});