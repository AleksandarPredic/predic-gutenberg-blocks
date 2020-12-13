import BetCalculator from './modules/frontend/bet-calculator';

(function () {

  "use strict";

  window.addEventListener('load', () => {
    const forms = document.getElementsByClassName('prblocks-bet-calc');

    if (forms.length < 1) {
      return;
    }

    for (const form of forms) {
      new BetCalculator(form);
    }
  });

})();
