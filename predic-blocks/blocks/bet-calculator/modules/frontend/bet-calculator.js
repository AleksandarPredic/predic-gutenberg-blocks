import oddslib from 'oddslib';
import debounce from "./debounce";
import RecentBets from './recent-bets';

/**
 * Bet caclulator class
 */
export default class BetCalculator {

  /**
   * Class constructor
   *
   * @param {Object} calculator
   */
  constructor(calculator) {
    this.calculator = calculator;
    this.message = this.calculator.querySelector('.prblocks-bet-calc__odds-form-msg');
    this.inputs = this.calculator.querySelectorAll('.prblocks-bet-calc__odds-form-group input');
    this.oddsFormat = this.calculator.querySelector('.prblocks-bet-calc__odds-format select');
    this.payout = this.calculator.querySelector('.prblocks-bet-calc__odds-form-payout');
    this.formGroupsWrapper = this.calculator.querySelector('.prblocks-bet-calc__odds-form-groups-wrapper');
    this.formGroup = this.calculator.querySelector('.prblocks-bet-calc__odds-form-group');
    this.errorCssClass = 'prblocks-bet-calc__odds-form-input--error';
    this.messages = JSON.parse(this.calculator.dataset.messages);

    // Trigger changes on select change
    this.oddsFormat.addEventListener('change', () => {
      const event = new Event('input');
      this.inputs[0].dispatchEvent(event);
    });

    // Trigger change on input number
    this.inputs.forEach(input => this.addInputListener(input));

    // Add new form group on button click
    this.calculator.querySelector('.prblocks-bet-calc__odds-form-add').addEventListener('click', this.addFormGroup.bind(this));

    // Clear added fields and input values
    this.calculator.querySelector('.prblocks-bet-calc__odds-form-clear').addEventListener('click', this.clearFormGroups.bind(this));

    // Init recent bets table
    this.recentBetsTable = new RecentBets(this.calculator);
  }

  /**
   * Recalculate payout and validate the inputs
   */
  onInputHandler() {
    const messageStake = this.messages.stake;
    const messageOdd = this.messages.odd;
    const formGroups = this.calculator.querySelectorAll('.prblocks-bet-calc__odds-form-group');

    // Collect all inputs so we can calculate sum
    let stakeOddsRawValues = [];
    let stakeOdds = [];
    for (const formGroup of formGroups) {
      const stake = formGroup.querySelector('.prblocks-bet-calc__odds-form-stake');
      const stakeValue = stake.value;
      if (!stakeValue || isNaN(stakeValue)) {
        this.handleMessage(messageStake);
        this.handleInputError(stake, true);
        return;
      }
      this.handleMessage('');
      this.handleInputError(stake, false);

      const odd = formGroup.querySelector('.prblocks-bet-calc__odds-form-odd');
      const oddValue = odd.value;
      const oddVerifiedValue = this.getOddValue(oddValue);
      if (!odd || !oddVerifiedValue) {
        this.handleMessage(messageOdd);
        this.handleInputError(odd, true);
        return;
      }
      this.handleMessage('');
      this.handleInputError(odd, false);

      // Collect raw values for the recent bets table
      stakeOddsRawValues.push({
        stake: stakeValue,
        odd: oddValue
      });

      stakeOdds.push({
        stake: Number(stakeValue),
        odd: oddVerifiedValue
      });
    }

    let sum = [];
    for (const stakeOdd of stakeOdds) {
      sum.push(stakeOdd.stake * stakeOdd.odd);
    }

    // Display payout sum
    const payout = sum.reduce((a, b) => a + b, 0).toFixed(2);
    this.handlePayout(payout);

    // Fill in the recent bets table
    this.recentBetsTable.displayBets(stakeOddsRawValues, payout);
  }

  /**
   * Add new fields to the form
   *
   * @param {Event} event
   */
  clearFormGroups(event) {
    const formGroups = this.formGroupsWrapper.querySelectorAll('.prblocks-bet-calc__odds-form-group');

    // reset message
    this.handleMessage('');

    // reset payout
    this.handlePayout('0.00');

    // reset inputs and remove error class
    formGroups[0].querySelectorAll('input')
      .forEach(input => {
        input.value = '';
        this.handleInputError(input, false);
      });

    // Handle case when no form groups are added
    if (formGroups.length < 2) {
      return;
    }

    // Remove all added form groups
    let i;
    for (i = 1; i < formGroups.length; i++) {
      formGroups[i].remove();
    }

    // Switch to new row in the recent bets table
    this.recentBetsTable.setNextRow();
  }

  /**
   * Add new fields to the form
   *
   * @param {Event} event
   */
  addFormGroup(event) {
    event.preventDefault();

    // Form a template to use on button add click
    const element = this.formGroup.cloneNode(true);

    // Remove labels
    element.querySelectorAll('label')
      .forEach(label => {
        label.remove();
      });

    // Add input listeners, remove error css class for the clonned input
    element.querySelectorAll('input')
      .forEach(input => {
        input.value = '';
        this.handleInputError(input, false);
        this.addInputListener(input);
      });

    this.formGroupsWrapper.insertAdjacentElement('beforeend', element);

  }

  /**
   * Add event listener for keypress
   *
   * @param {Object} input
   */
  addInputListener(input) {
    input.addEventListener('input', debounce(this.onInputHandler.bind(this), 800));
  }

  /**
   * Return number or decimal number OR false
   *
   * @param {string} value
   * @return {boolean|*}
   */
  getOddValue(value) {
    const oddsFormat = this.oddsFormat.value;

    // american case
    if ('american' === oddsFormat) {
      try {
        value = oddslib.from('moneyline', value).to('decimal');

        if (isNaN(value)) {
          return false;
        }

        return value;
      } catch (err) {
        return false;
      }

    }

    // fractal case
    if ('fractal' === oddsFormat) {
      try {
        value = oddslib.from('fractional', value).to('decimal');

        if (isNaN(value)) {
          return false;
        }

        return value;
      } catch (err) {
        return false;
      }

    }

    // decimal case
    if (isNaN(value) || Number(value) < 0) {
      return false;
    }

    return value;
  }

  /**
   * Add or remove form message
   *
   * @param {string} message
   */
  handleMessage(message) {
    this.message.innerText = message;
  }

  /**
   * Mark input incorrect or not
   *
   * @param {Object} input
   * @param {boolean} error
   */
  handleInputError(input, error) {
    if (error) {
      input.classList.add(this.errorCssClass);
    } else {
      input.classList.remove(this.errorCssClass);
    }
  }

  /**
   * Add or remove payot value
   *
   * @param {string} value
   */
  handlePayout(value) {
    this.payout.innerText = value;
  }
}
