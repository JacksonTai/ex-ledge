let url = new URL(window.location);

/* -- Opening and closing of Add comment container -- */
let commentActions = document.querySelectorAll(".question__action--comment");
let cancelCommentBtns = document.querySelectorAll(
  ".question__cancel-comment-btn"
);

for (let commentAction of commentActions) {
  commentAction.addEventListener("click", () => {
    commentAction.classList.toggle("action-btn-click");
    toggleCommentContainer(commentAction.dataset.replyId);
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

    toggleCommentContainer(cancelCommentBtn.parentElement.dataset.replyId);
  });
}

// Get and toggle the comment container through the dataset being passed.
function toggleCommentContainer(dataset) {
  let commentContainer = document.querySelector(
    `[data-comment-id='${dataset}']`
  );
  commentContainer.classList.toggle("show");

  if (ansAction) {
    if (
      ansAction.classList.contains("action-btn-click") &&
      postAnsContainer.classList.contains("show") &&
      /* Only toggle the answer container abd action if the comment
         action being clicked is for question. */
      dataset == url.searchParams.get("id")
    ) {
      ansAction.classList.toggle("action-btn-click");
      postAnsContainer.classList.toggle("show");
    }
  }
}

/* -- Opening and closing of post answer container -- */
let ansAction = document.querySelector(".question__action--ans");
let postAnsContainer = document.querySelector(".question__post-ans-container");
let postAnsInput = document.querySelector(".question__post-ans-input");
let cancelAnsBtn = document.querySelector(".question__cancel-ans-btn");

if (ansAction && cancelAnsBtn) {
  ansAction.addEventListener("click", toggleAnsContainer);
  cancelAnsBtn.addEventListener("click", toggleAnsContainer);

  function toggleAnsContainer() {
    ansAction.classList.toggle("action-btn-click");
    postAnsContainer.classList.toggle("show");

    // Get comment action and container of the question.
    let commentAction = document.querySelector(
      `[data-reply-id=${url.searchParams.get("id")}]`
    );
    let commentContainer = document.querySelector(
      `[data-comment-id=${url.searchParams.get("id")}]`
    );

    /* Close the comment container and disable the comment action if it's 
       being activated while the answer action is being clicked. */
    if (
      commentAction.classList.contains("action-btn-click") &&
      commentContainer.classList.contains("show")
    ) {
      commentAction.classList.toggle("action-btn-click");
      commentContainer.classList.toggle("show");
    }
  }
}
