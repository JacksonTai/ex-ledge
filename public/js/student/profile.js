let url = new URL(window.location);
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

// Overview section
let aboutMeEditBtn = document.querySelector(".overview--about__edit-btn");
let aboutMeContent = document.querySelector(".overview--about__content");
let aboutMeInput = document.querySelector(".overview--about__bio-input");
let aboutMeBtnContainer = document.querySelector(
  ".overview--about__bio-btn-container"
);
let aboutMeCancelBtn = document.querySelector(
  ".overview--about__bio-cancel-btn"
);
let aboutMeConfirmBtn = document.querySelector(
  ".overview--about__bio-confirm-btn"
);

if (aboutMeEditBtn) {
  aboutMeEditBtn.addEventListener("click", () => {
    aboutMeContent.style.display = "none";
    aboutMeEditBtn.style.display = "none";
    aboutMeInput.style.display = "block";
    aboutMeBtnContainer.style.display = "flex";
  });
}

aboutMeCancelBtn.addEventListener("click", hideEditField);
aboutMeConfirmBtn.addEventListener("click", async function () {
  try {
    await fetch(`../../controller/user.php?bio=${aboutMeInput.value.trim()}`);

    let res = await fetch(
      `../../controller/user.php?userId=${aboutMeContent.dataset.userId}`
    );
    let data = await res.json();

    if (data.bio) {
      aboutMeContent.textContent = data.bio;
    } else {
      aboutMeContent.textContent = "Your about me section is currently empty.";
    }
    hideEditField();
  } catch (e) {
    console.log("Error: ", e);
  }
});

function hideEditField() {
  aboutMeContent.style.display = "block";
  aboutMeEditBtn.style.display = "block";
  aboutMeInput.style.display = "none";
  aboutMeBtnContainer.style.display = "none";
}

// Bookmark section.
let bookmarkQnContainer = document.querySelector(
  ".bookmark-question-container"
);
let bookmarkAnsContainer = document.querySelector(".bookmark-answer-container");

let bookmarkQnAction = document.querySelector(".bookmark__action--question");
let bookmarkAnsAction = document.querySelector(".bookmark__action--ans");

// Default bookmark action.
bookmarkQnAction.classList.add("action-btn-click");
bookmarkQnAction.classList.toggle("disabled");

bookmarkQnAction.addEventListener("click", toggleBookmarkContainer);
bookmarkAnsAction.addEventListener("click", toggleBookmarkContainer);

function toggleBookmarkContainer() {
  bookmarkAnsAction.classList.toggle("action-btn-click");
  bookmarkQnAction.classList.toggle("action-btn-click");
  bookmarkQnContainer.classList.toggle("hide");
  bookmarkAnsContainer.classList.toggle("hide");
  bookmarkQnAction.classList.toggle("disabled");
  bookmarkAnsAction.classList.toggle("disabled");
}

/* -- Add and remove answers' bookmark -- */
let bookmarkAnsActions = document.querySelectorAll(
  ".layout-answer__action--bookmark"
);

for (let bookmarkAnsAction of bookmarkAnsActions) {
  bookmarkAnsAction.addEventListener("click", async function () {
    bookmarkAnsAction.classList.toggle("action-btn-click");
    try {
      await fetch(
        `../../controller/bookmark.php?id=${this.dataset.bookmarkId}`
      );
    } catch (e) {
      console.log("Error: ", e);
    }
  });
}

// Get answers' bookmark.
async function getBookmark(criteria) {
  try {
    let res = await fetch(`../../controller/bookmark.php?criteria=${criteria}`);
    return await res.json();
  } catch (e) {
    console.log("Error: ", e);
  }
}

async function setBookmark() {
  try {
    // Get user id.
    let userIdRes = await fetch("../../helper/session.php");
    let userId = await userIdRes.json();
 
    // Store all bookmark Id record of the user.
    let bookmarksId = [];

    let bookmarks = await getBookmark(userId);

    for (let bookmark of bookmarks) {
      bookmarksId.push(bookmark.id);
    }

    for (let bookmarkAnsAction of bookmarkAnsActions) {
      if (bookmarksId.includes(bookmarkAnsAction.dataset.bookmarkId)) {
        bookmarkAnsAction.classList.toggle("action-btn-click");
      }
    }
  } catch (e) {
    console.log("Error", e);
  }
}

/* -- Vote -- */
let ansAction = document.querySelector(".question__action--ans");
var userIsVerified = false;

async function checkVerifStatus() {
  // Get user id.
  let userIdRes = await fetch("../../helper/session.php");
  let userId = await userIdRes.json();

  // Get user info.
  let res = await fetch(`../../controller/user.php?userId=${userId}`);
  let userInfo = await res.json();

  // Verification with value of 1 will result in true in boolean and vice versa for 0.
  userIsVerified = parseInt(userInfo.verification) ? true : false;
}

// Wait for the checkVerifStatus async function to finish its update.
checkVerifStatus().then(() => {
  if (userIsVerified) {
    let votesIcon = document.querySelectorAll(".vote-icon");

    for (let voteIcon of votesIcon) {
      voteIcon.addEventListener("click", function () {
        let id = this.parentElement.dataset.voteId;

        let point = this.parentElement.children[1];
        let pointNum = parseInt(point.textContent.trim());

        let upvote = this.parentElement.children[0];
        let downvote = this.parentElement.children[2];

        if (this.id == "upvote") {
          if (voteIcon.classList.contains("upvote")) {
            point.textContent = pointNum - 1;
          } else if (downvote.classList.contains("downvote")) {
            point.textContent = pointNum + 2;
          } else {
            point.textContent = pointNum + 1;
          }
          updateVote(1, id);
        }
        if (this.id == "downvote") {
          if (voteIcon.classList.contains("downvote")) {
            point.textContent = pointNum + 1;
          } else if (upvote.classList.contains("upvote")) {
            point.textContent = pointNum - 2;
          } else {
            point.textContent = pointNum - 1;
          }
          updateVote(0, id);
        }
      });
    }

    async function updateVote(voteType, id) {
      try {
        await fetch(`../../controller/vote.php?voteType=${voteType}&id=${id}`);

        // Reset previous vote once the vote has been updated.
        if (id[0] == "A") {
          setAnsPrevVote();
        }
      } catch (e) {
        console.log("Error: ", e);
      }
    }
  }
});

// Select answer actions' vote by excluding the vote id of question Id.
let ansActionsVote = document.querySelectorAll(
  `[data-vote-id]:not([data-vote-id="${url.searchParams.get("id")}"])`
);

async function setAnsPrevVote() {
  try {
    for (let ansActionVote of ansActionsVote) {
      let upvoteIcon = ansActionVote.children[0];
      let downvoteIcon = ansActionVote.children[2];

      let res = await fetch(
        `../../controller/vote.php?voteFor=answer&id=${ansActionVote.dataset.voteId}`
      );
      let prevVote = await res.json();

      if (ansActionVote.dataset.voteId == prevVote.answer_id) {
        if (prevVote.vote == 1) {
          upvoteIcon.classList.add("upvote");
          if (downvoteIcon.classList.contains("downvote")) {
            downvoteIcon.classList.remove("downvote");
          }
        }
        if (prevVote.vote == 0) {
          downvoteIcon.classList.add("downvote");
          if (upvoteIcon.classList.contains("upvote")) {
            upvoteIcon.classList.remove("upvote");
          }
        }
      }

      // Remove upvote or downvote icon color if there's no previous vote.
      if (ansActionVote.dataset.voteId != prevVote.answer_id) {
        if (upvoteIcon.classList.contains("upvote")) {
          upvoteIcon.classList.remove("upvote");
        }
        if (downvoteIcon.classList.contains("downvote")) {
          downvoteIcon.classList.remove("downvote");
        }
      }
    }
  } catch (e) {
    console.log("Error: ", e);
  }
}

/* -- Modal opening and closing -- */
let editProfileBtn = document.querySelector(".profile__edit-btn");
let deleteAccountBtn = document.querySelector(".profile__delete-btn");
let verifyLink = document.querySelector(".profile__banner-verify-link");

if (editProfileBtn) {
  editProfileBtn.addEventListener("click", openModal);
}
if (deleteAccountBtn) {
  deleteAccountBtn.addEventListener("click", openModal);
}
if (verifyLink) {
  verifyLink.addEventListener("click", openModal);
}

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

/* -- Verify account modal -- */
let verifyAccountForm = document.querySelector(".verify-form");
if (verifyAccountForm) {
  verifyAccountForm.addEventListener("submit", async function (e) {
    e.preventDefault();

    let formData = new FormData(this);

    try {
      let res = await fetch("../../controller/user.php", {
        method: "POST",
        body: formData,
      });
      let errMsg = await res.json();
      // Redirect to profile page again once there is no error messages.
      if (!errMsg) {
        window.location.href = "profile.php";
      } else {
        let usernameErrMsg = document.querySelector(
          ".verify-form__err-msg--full-name"
        );
        let ageErrMsg = document.querySelector(".verify-form__err-msg--nric");
        usernameErrMsg.textContent = decodeEntity(errMsg.fullName);
        ageErrMsg.textContent = decodeEntity(errMsg.nric);
      }
    } catch (e) {
      console.log(e);
    }
  });
}

/* -- Edit profile modal -- */
let editProfileForm = document.querySelector(".edit-profile-form");
editProfileForm.addEventListener("submit", async function (e) {
  e.preventDefault();

  let formData = new FormData(this);

  try {
    let res = await fetch("../../controller/user.php", {
      method: "POST",
      body: formData,
    });
    let errMsg = await res.json();

    // Redirect to profile page again once there is no error messages.
    if (!errMsg) {
      window.location.href = "profile.php";
    } else {
      // Destruct the errMsg object.
      let { username, age, gender } = errMsg;
      let usernameErrMsg = document.querySelector(
        ".edit-profile__err-msg--username"
      );
      let ageErrMsg = document.querySelector(".edit-profile__err-msg--age");
      let genderErrMsg = document.querySelector(
        ".edit-profile__err-msg--gender"
      );
      usernameErrMsg.textContent = decodeEntity(username);
      ageErrMsg.textContent = decodeEntity(age);
      genderErrMsg.textContent = decodeEntity(gender);
    }
  } catch (e) {
    console.log(e);
  }
});

// Decode HTML entity code to use in JavaScript.
const decodeEntity = function (entityCode) {
  let textarea = document.createElement("textarea");
  textarea.innerHTML = entityCode;
  return textarea.value;
};

/* -- Delete account modal -- */
let deleteAccountPassword = document.querySelector(
  ".modal__delete-account-password"
);
let deletAccountbtn = document.querySelector(".modal__delete-account-btn");
let validPassword = false;

// Check if password is correct in real time.
deleteAccountPassword.addEventListener("input", async function () {
  deletAccountbtn.classList.add("modal__delete-account-btn--disabled");
  try {
    let res = await fetch(
      `../../controller/signin.php?email=${deleteAccountPassword.dataset.email.trim()}&
      password=${deleteAccountPassword.value}`
    );
    if (await res.json()) {
      deletAccountbtn.classList.remove("modal__delete-account-btn--disabled");
      validPassword = true;
    }
  } catch (e) {
    console.log(e);
  }
});

// Delete account process.
deletAccountbtn.addEventListener("click", async function () {
  if (validPassword) {
    try {
      await fetch(
        `../../controller/user.php?deleteId=${aboutMeContent.dataset.userId}`
      );
      window.location = "../../helper/logout.php";
    } catch (e) {
      window.location = "profile.php";
    }
  }
});

setBookmark();
setAnsPrevVote();
