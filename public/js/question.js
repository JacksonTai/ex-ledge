/* -- Opening and closing of Add comment container -- */
let questionCommentContainer = document.querySelector(
  ".question__comment-container--question"
);

// questionCommentContainer.addEventListener("click", () => {
//   console.log(questionCommentContainer);
// });

let commentActions = document.querySelectorAll(".question__action--comment");
for (let commentAction of commentActions) {
  console.log(commentAction);
}

/* -- Opening and closing of post answer container -- */
let postAnsContainer = document.querySelector(".question__post-ans-container");

let ansAction = document.querySelector(".question__action--ans");
let postAnsInput = document.querySelector(".question__post-ans-input");
let cancelAnsBtn = document.querySelector(".question__cancel-ans-btn");
let postAnsBtn = document.querySelector(".question__post-ans-btn");

ansAction.addEventListener("click", toggleAnsContainer);
cancelAnsBtn.addEventListener("click", toggleAnsContainer);

function toggleAnsContainer() {
  ansAction.classList.toggle("action-btn-click");
  postAnsContainer.classList.toggle("show");
}
