import OddsTable from "./modules/odds-table";

(function () {

  "use strict";

  window.addEventListener('load', () => {
    const tables = document.getElementsByClassName('prblocks-odds-table');

    if (tables.length < 1) {
      return;
    }

    for (const table of tables) {
      new OddsTable(table);
    }
  });

})();
