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

/* -- Modal opening and closing -- */
let editProfileBtn = document.querySelector(".profile__edit-btn");
let deleteAccountBtn = document.querySelector(".profile__delete-btn");
let verifyLink = document.querySelector(".profile__banner-verify-link");

editProfileBtn.addEventListener("click", openModal);
deleteAccountBtn.addEventListener("click", openModal);
verifyLink.addEventListener("click", openModal);

let modals = document.querySelectorAll(".modal");
let modalsOverlay = document.querySelectorAll(".modal-overlay");
let modalsCloseBtn = document.querySelectorAll(".modal__close-btn");

function openModal() {
  // Check if btn classname contains extracted modifier name in modal classname.
  for (let modal of modals) {
    if (this.className.includes(modal.className.split("-")[2])) {
      modal.style.display = "block";
    }
  }

  // Check if btn classname contains extracted modifier name in modal overlay classname.
  for (let modalOverlay of modalsOverlay) {
    if (this.className.includes(modalOverlay.className.split("-")[4])) {
      modalOverlay.style.display = "flex";
    }
  }

  // Avoid user scrolling the browser if modal is being opened.
  document.body.classList.add("no-scroll");
}

for (let modalCloseBtn of modalsCloseBtn) {
  modalCloseBtn.addEventListener("click", closeModal);
}

function closeModal() {
  // closest() - ref: https://developer.mozilla.org/en-US/docs/Web/API/Element/closest
  this.closest(".modal").style.display = "none";
  this.closest(".modal-overlay").style.display = "none";
  document.body.classList.remove("no-scroll");
  window.location.href = "profile.php";
}

/* -- Delete account modal -- */
let deleteAccountInput = document.querySelector(".modal__delete-account-input");
let deletAccountbtn = document.querySelector(".modal__delete-account-btn");

deleteAccountInput.addEventListener("input", () => {
  deletAccountbtn.classList.add("modal__delete-account-btn--disabled");
  if (deleteAccountInput.value == deleteAccountInput.dataset.userId) {
    deletAccountbtn.classList.remove("modal__delete-account-btn--disabled");
  }
});
