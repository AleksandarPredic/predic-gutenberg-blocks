/**
 * Adds debounce effect
 *
 * @param {function} fn Callback to execute
 * @param {number} wait Time in miliseconds
 */
export default function debounce (fn, wait) {
  let t
  return function () {
    clearTimeout(t)
    t = setTimeout(() => fn.apply(this, arguments), wait)
  }
}
