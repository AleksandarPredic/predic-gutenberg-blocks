/**
 * Recent bets class
 */
export default class RecentBets {

  /**
   * Class constructor
   *
   * @param {Object} calculator
   */
  constructor(calculator) {
    this.calculator = calculator;
    this.recentBets = this.calculator.nextElementSibling;
    this.betsWrapper = this.recentBets.querySelector('.prblocks-bet-calc-bets__table');
    this.currency = this.calculator.querySelector('.prblocks-bet-calc__odds-form-currency').innerText;
    this.stakeText = this.calculator.querySelector('.prblocks-bet-calc__odds-form-label-stake').innerText;
    this.oddText = this.calculator.querySelector('.prblocks-bet-calc__odds-form-label-odd').innerText;
  }

  /**
   * Display stakes and odds when they pass validation in the calculator
   *
   * @param {Array} stakeOdds
   * @param {string} payout
   */
  displayBets(stakeOdds, payout) {
    const stakestHtml = stakeOdds.map(({stake, odd}) => {
      return this.getTemplate(stake, odd);
    });

    const payoutHtml = this.currency + payout;

    const html = `<div>${stakestHtml.join('')}</div><span>${payoutHtml}</span>`;

    // Always add to last div if the user hit clear on calculator, we will count it as new row in the table
    this.betsWrapper.querySelector('div:last-child').innerHTML = html;
  }

  /**
   * Add new table for each stake / odd
   *
   * @param {string} stake
   * @param {string} odd
   * @return {string}
   */
  getTemplate(stake, odd) {
    return `<table>
      <tr><th>${this.stakeText}</th><th>${this.oddText}</th></tr>
      <tr><td>${stake}</td><td>${odd}</td></tr>
    </table>`;
  }

  /**
   * Add new div at the end of the wrapper to act as new row
   */
  setNextRow() {
    this.betsWrapper.insertAdjacentHTML('beforeend', '<div></div>');
  }
}
