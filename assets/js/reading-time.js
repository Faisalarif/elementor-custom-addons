document.addEventListener("DOMContentLoaded", function () {
  // Progress bar
  const bar = document.getElementById("eca-progress-bar");
  if (bar) {
    window.addEventListener("scroll", () => {
      let scrollTop = window.scrollY || document.documentElement.scrollTop;
      let docHeight = document.documentElement.scrollHeight - document.documentElement.clientHeight;
      let percent = (scrollTop / docHeight) * 100;
      bar.style.width = percent + "%";
    });
  }

  // Reading time
  const label = document.getElementById("eca-reading-time");
  if (label) {
    const wordsPerMinute = 200;
    const suffix = label.getAttribute("data-suffix") || "min read";
    const bodyText = document.body.innerText || "";
    const wordCount = bodyText.trim().split(/\s+/).length;
    const minutes = Math.ceil(wordCount / wordsPerMinute);
    label.textContent = `${minutes} ${suffix}`;
  }
});