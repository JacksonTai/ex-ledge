async function setQuestionPrevVote() {
  let voteContainers = document.querySelectorAll(
    ".layout__question-vote-container"
  );
  for (let voteContainer of voteContainers) {
    try {
      let res = await fetch(
        `../../controller/vote.php?voteFor=question&id=${voteContainer.dataset.questionId}`
      );
      let prevVote = await res.json();
      let upvoteIcon = voteContainer.children[0];
      let downvoteIcon = voteContainer.children[2];

      if (prevVote.question_id == voteContainer.dataset.questionId) {
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
      if (prevVote.question_id != voteContainer.dataset.questionId) {
        // Remove upvote or downvote icon color if there's no previous vote.
        if (upvoteIcon.classList.contains("upvote")) {
          upvoteIcon.classList.remove("upvote");
        }
        if (downvoteIcon.classList.contains("downvote")) {
          downvoteIcon.classList.remove("downvote");
        }
      }
    } catch (e) {
      console.log("Error: ", e);
    }
  }
}

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
    let layoutQuestionVotes = document.querySelectorAll(
      ".layout__question-vote"
    );

    for (let layoutQuestionVote of layoutQuestionVotes) {
      layoutQuestionVote.addEventListener("click", function () {
        let id = this.parentElement.dataset.questionId;

        let point = this.parentElement.children[1];
        let pointNum = parseInt(point.textContent.trim());

        let upvote = this.parentElement.children[0];
        let downvote = this.parentElement.children[2];

        if (this.id == "upvote") {
          if (layoutQuestionVote.classList.contains("upvote")) {
            point.textContent = pointNum - 1;
          } else if (downvote.classList.contains("downvote")) {
            point.textContent = pointNum + 2;
          } else {
            point.textContent = pointNum + 1;
          }
          updateVote(1, id);
        }
        if (this.id == "downvote") {
          if (layoutQuestionVote.classList.contains("downvote")) {
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
        if (id[0] == "Q") {
          setQuestionPrevVote();
        }
      } catch (e) {
        console.log("Error: ", e);
      }
    }
  }
});

window.onload = () => {
  setQuestionPrevVote();
  checkVerifStatus();
};
