const hamburgerMenu = document.querySelector(".layout-header__hamburger-menu");
const nav = document.querySelector(".layout-header__nav");

hamburgerMenu.addEventListener("click", () => {
  if (hamburgerMenu.classList.contains("open")) {
    // open hamburger menu
    hamburgerMenu.classList.remove("open");
    nav.classList.remove("fade-in");
    nav.classList.add("fade-out");
  } else {
    // close hamburger menu
    hamburgerMenu.classList.add("open");
    nav.classList.add("fade-in");
    nav.classList.remove("fade-out");
  }
});
