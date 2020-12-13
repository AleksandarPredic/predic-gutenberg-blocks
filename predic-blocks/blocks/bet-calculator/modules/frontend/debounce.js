/**
 * Adds debounce effect
 *
 * @param {Function} fn Callback to execute
 * @param {number} wait Time in milliseconds
 */
export default function debounce (fn, wait) {
  let t;
  return function () {
    clearTimeout(t);
    t = setTimeout(() => fn.apply(this, arguments), wait);
  };
}
