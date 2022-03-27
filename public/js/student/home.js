let homeFilterBtn = document.querySelector(".home__header-btn--filter");
let cancelFilterBtn = document.querySelector(".home__cancel-filter-btn");
let filterContainer = document.querySelector(".home__filter-container");

homeFilterBtn.addEventListener("click", () => {
  homeFilterBtn.classList.toggle("btn-click");
  filterContainer.classList.toggle("hide");
});

cancelFilterBtn.addEventListener("click", () => {
  homeFilterBtn.classList.toggle("btn-click");
  filterContainer.classList.toggle("hide");
});
