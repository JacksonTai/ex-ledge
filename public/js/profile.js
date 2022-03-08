/* -- Section view modification -- */
let profileBannerBtns = document.querySelectorAll(
  ".profile__banner-navbar-btn"
);

for (let profileBannerBtn of profileBannerBtns) {
  profileBannerBtn.addEventListener("click", styleBtn);
}

function styleBtn() {
  for (let profileBannerBtn of profileBannerBtns) {
    if (profileBannerBtn.classList.contains("profile-btn-selected")) {
      profileBannerBtn.classList.remove("profile-btn-selected");
    }
  }
  this.classList.add("profile-btn-selected");
  switchSection(this.dataset.section);
}

let profileSections = document.querySelectorAll(".profile-section");

function switchSection(section) {
  let showSection = "profile-section-selected";
  let showFlexSection = "profile-section-selected--flex";
  for (let profileSection of profileSections) {
    if (profileSection.classList.contains(showSection)) {
      profileSection.classList.remove(showSection);
    }
    if (profileSection.classList.contains(showFlexSection)) {
      profileSection.classList.remove(showFlexSection);
    }
  }
  if (section == "overview") {
    showSection = showFlexSection;
  }
  document
    .querySelector(`.profile-section--${section}`)
    .classList.add(showSection);
}

/* -- Edit profile modal -- */
let editProfileBtn = document.querySelector(".profile__edit-btn");
let editProfileModal = document.querySelector(".modal--edit-profile");
let editProfileModalOverlay = document.querySelector(
  ".modal-overlay--edit-profile"
);

editProfileBtn.addEventListener("click", function () {
  editProfileModal.style.display = "block";
  editProfileModalOverlay.style.display = "flex";
  document.body.classList.add("no-scroll");
});

let modalCloseBtn = document.querySelector(".modal__close-btn");
modalCloseBtn.addEventListener("click", () => {
  document.body.classList.remove("no-scroll");
  editProfileModal.style.display = "none";
  editProfileModalOverlay.style.display = "none";
});
