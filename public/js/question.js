let url = new URL(window.location);

/* -- Opening and closing of comment form -- */
let commentActions = document.querySelectorAll(".question__action--comment");
let cancelCommentBtns = document.querySelectorAll(
  ".question__cancel-comment-btn"
);

for (let commentAction of commentActions) {
  commentAction.addEventListener("click", () => {
    commentAction.classList.toggle("action-btn-click");
    toggleCommentForm(commentAction.dataset.replyId);
  });
}

for (let cancelCommentBtn of cancelCommentBtns) {
  cancelCommentBtn.addEventListener("click", () => {
    // Select the comment action that has same dataset with the cancel button.
    let commentAction = document.querySelector(
      `[data-reply-id='${cancelCommentBtn.parentElement.dataset.replyId}']`
    );

    // Toggle the click effect of the matching comment action.
    commentAction.classList.toggle("action-btn-click");

    toggleCommentForm(cancelCommentBtn.parentElement.dataset.replyId);
  });
}

// Get and toggle the comment form through the dataset being passed.
function toggleCommentForm(dataset) {
  let commentForm = document.querySelector(`[data-comment-id='${dataset}']`);

  commentForm.classList.toggle("show");

  if (ansAction) {
    if (
      ansAction.classList.contains("action-btn-click") &&
      postAnsForm.classList.contains("show") &&
      /* Only toggle the answer form and action if the comment
         action being clicked is for question. */
      dataset == url.searchParams.get("id")
    ) {
      ansAction.classList.toggle("action-btn-click");
      postAnsForm.classList.toggle("show");
    }
  }
}

/* -- Get comment -- */
async function getComment($replyId) {
  try {
    let res = await fetch(`../../controller/comment.php?replyId=${$replyId}`);
    return await res.json();
  } catch (e) {
    console.log("Error: ", e);
  }
}

// Set answers' comment into comment container of answers.
async function setAnsComment() {
  for (let commentContainerAn of commentsContainerAn) {
    let answer = await getComment(commentContainerAn.dataset.ansId);

    if (commentContainerAn.dataset.ansId == answer.id) {
      commentContainerAn.innerHTML = answer.comment;
    }
  }
}

// Set question's comment into comment container of question.
async function setQnComment() {
  let question = await getComment(url.searchParams.get("id"));
  commentContainerQn.innerHTML = question.comment;
}

// Comment container of question.
let commentContainerQn = document.querySelector(
  ".question__comment-container--question"
);

// Comment container of answer.
let commentsContainerAn = document.querySelectorAll(
  ".question__comment-container--ans"
);

window.onload = async function () {
  setQnComment();
  setAnsComment();
};

/* -- Add comment -- */
let questionCommentForm = document.querySelector(
  `form[data-comment-id=${url.searchParams.get("id")}]`
);
questionCommentForm.addEventListener("submit", async function (e) {
  e.preventDefault();

  let formData = new FormData(this);

  try {
    await fetch("../../controller/comment.php", {
      method: "POST",
      body: formData,
    });
  } catch (error) {
    console.log("Error: ", e);
  }

  // Get and toggle comment action of the question.
  let commentAction = document.querySelector(
    `[data-reply-id=${url.searchParams.get("id")}]`
  );
  commentAction.classList.toggle("action-btn-click");

  // Get latest comment once user submitted.
  setQnComment();

  // Reset comment form.
  this.reset();

  toggleCommentForm(url.searchParams.get("id"));
});

// Select all answers comment form by excluding the comment id of question Id.
let answersCommentForm = document.querySelectorAll(
  `form[data-comment-id]:not([data-comment-id="${url.searchParams.get("id")}"])`
);

for (let answerCommentForm of answersCommentForm) {
  answerCommentForm.addEventListener("submit", async function (e) {
    e.preventDefault();

    let formData = new FormData(this);

    try {
      await fetch("../../controller/comment.php", {
        method: "POST",
        body: formData,
      });
    } catch (error) {
      console.log("Error: ", e);
    }

    // Get and toggle comment action of the answer.
    let commentAction = document.querySelector(
      `[data-reply-id=${this.dataset.commentId}]`
    );
    commentAction.classList.toggle("action-btn-click");

    // Get latest comment once user submitted.
    setAnsComment();

    // Reset comment form.
    this.reset();

    toggleCommentForm(this.dataset.commentId);
  });
}

/* -- Opening and closing of post answer form -- */
let ansAction = document.querySelector(".question__action--ans");
let postAnsForm = document.querySelector(".question__post-ans-form");
let postAnsInput = document.querySelector(".question__post-ans-input");
let cancelAnsBtn = document.querySelector(".question__cancel-ans-btn");

if (ansAction && cancelAnsBtn) {
  ansAction.addEventListener("click", toggleAnswerForm);
  cancelAnsBtn.addEventListener("click", toggleAnswerForm);

  function toggleAnswerForm() {
    ansAction.classList.toggle("action-btn-click");
    postAnsForm.classList.toggle("show");

    // Get comment action and form of the question.
    let commentAction = document.querySelector(
      `[data-reply-id=${url.searchParams.get("id")}]`
    );
    let commentForm = document.querySelector(
      `[data-comment-id=${url.searchParams.get("id")}]`
    );

    /* Close the comment form and disable the comment action if it's 
       being activated while the answer action is being clicked. */
    if (
      commentAction.classList.contains("action-btn-click") &&
      commentForm.classList.contains("show")
    ) {
      commentAction.classList.toggle("action-btn-click");
      commentForm.classList.toggle("show");
    }
  }
}
