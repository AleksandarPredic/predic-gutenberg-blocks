/**
 * global _sportsOddsTableData
 */

/**
 * Sports table object
 */
export default class OddsTable {

  /**
   * Constructor
   *
   * @param {Object} table
   */
  constructor(table) {
    this.table = table;
    this.filtersWrapper = this.table.querySelector('.prblocks-odds-table__filters');
    this.filtersForm = this.table.querySelector('form');
    this.button = this.filtersForm.querySelector('button');
    this.loader = this.table.querySelector('.prblocks-odds-table__loader');
    this.message = this.table.querySelector('.prblocks-odds-table__message');
    this.matchesWrapper = this.table.querySelector('.prblocks-odds-table__matches');

    // Bind submit form
    this.filtersForm.addEventListener('submit', this.submitForm.bind(this));

    // Bind change sport to reset team select
    this.filtersForm.querySelector('select[name="sport"]').addEventListener('change', () => {
      this.filtersForm.querySelector('select[name="team"]').value = 'all';
    });
  }

  /**
   * Submit form
   *
   * @param {Event} event
   */
  submitForm(event) {
    event.preventDefault();

    //Disable button and show loader
    this.disableSubmitButton(true);
    this.showLoader(true);

    let formData = new FormData(this.filtersForm);
    formData.append('action', _sportsOddsTableData.submitAction);
    formData.append('check', _sportsOddsTableData.submitCheck);
    this.sendRequest(formData, (response) => {
      if (! response.success) {
        if (response.data.message) {
          this.handleMessage(response.data.message);
        }

        // Enable the button again
        this.disableSubmitButton(false);

        // Hide loader
        this.showLoader(false);
      } else {
        // Replace filters
        let newForm = document.createElement('div');
        newForm.innerHTML = response.data.form.trim();

        // Change this to div.childNodes to support multiple top-level nodes
        //const newForm = response.data.form;
        this.filtersForm.querySelector('select[name="sport"]').innerHTML = newForm.querySelector('select[name="sport"]').innerHTML;
        this.filtersForm.querySelector('select[name="region"]').innerHTML = newForm.querySelector('select[name="region"]').innerHTML;
        this.filtersForm.querySelector('select[name="market"]').innerHTML = newForm.querySelector('select[name="market"]').innerHTML;
        this.filtersForm.querySelector('select[name="team"]').innerHTML = newForm.querySelector('select[name="team"]').innerHTML;

        // Replace matches
        this.matchesWrapper.innerHTML = response.data.matches;

        // Enable the button again
        this.disableSubmitButton(false);

        // Hide loader
        this.showLoader(false);
      }
    });
  }

  /**
   * Disable or enable button
   *
   * @param {boolean} disable
   */
  disableSubmitButton(disable) {
    this.button.disabled = disable;
  }

  /**
   * Show or hide loader
   *
   * @param {boolean} show
   */
  showLoader(show) {
    const cssClass = 'prblocks-odds-table__loader--show';
    if (show) {
      this.loader.classList.add(cssClass);
    } else {
      this.loader.classList.remove(cssClass);
    }
  }

  /**
   * Show or hide message
   *
   * @param {string} message
   */
  handleMessage(message) {
    this.message.innerText = message;
  }

  /**
   * Make POST requests
   *
   * @param {FormData} data
   * @param {Function} callback
   */
  sendRequest (data, callback) {
    const xhr = new XMLHttpRequest();
    xhr.open('POST', _sportsOddsTableData.ajaxUrl, true);
    xhr.send(data);

    xhr.onload = () => {
      if (xhr.readyState === 4) {
        let response = JSON.parse(xhr.response);
        if (callback) {
          callback(response);
        }
      }
    };

    xhr.onerror = () => {
      console.log('Something went wrong. Please contact your tech support.');
    };
  };
}
