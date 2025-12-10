// Comma/Separator counter
// #Backoffice Dashboard Counter
(function () {
  const counters = document.querySelectorAll(".counter");
  const speed = 70;

  counters.forEach((counter) => {
    const target = parseFloat(counter.getAttribute("data-target")) || 0;
    let count = 0;
    const increment = Math.max(1, Math.trunc(target / speed));

    const format = (n) => {
      if (n < 1_000_000) return Math.round(n).toLocaleString("en-US");
      if (n < 1_000_000_000) return (n / 1_000_000).toFixed(1).replace(/\.0$/, "") + "M";
      return (n / 1_000_000_000).toFixed(1).replace(/\.0$/, "") + "B";
    };

    const update = () => {
      count += increment;
      if (count >= target) {
        counter.innerText = format(target);
      } else {
        counter.innerText = format(count);
        setTimeout(update, 20);
      }
    };

    update();
  });
})();
