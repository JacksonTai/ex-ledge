// let votesIcon = document.querySelectorAll(".vote-icon");

// for (let voteIcon of votesIcon) {
//   voteIcon.addEventListener("click", function () {
//     let id = this.parentElement.dataset.voteId;
//     if (this.id == "upvote") {
//       updateVote(1, id);
//     }
//     if (this.id == "downvote") {
//       updateVote(0, id);
//     }
//   });
// }

// async function updateVote(voteType, id) {
//   try {
//     await fetch(`../../controller/vote.php?voteType=${voteType}&id=${id}`);

//     // Reset previous vote once the vote has been updated.
//     if (id[0] == "Q") {
//       setQuestionPrevVote();
//     }
//   } catch (e) {
//     console.log("Error: ", e);
//   }
// }

// // Select answer actions' vote by excluding the vote id of question Id.
// let ansActionsVote = document.querySelectorAll(
//   `[data-vote-id]:not([data-vote-id="${url.searchParams.get("id")}"])`
// );

// let questionActionVote = document.querySelector(
//   `[data-vote-id=${url.searchParams.get("id")}]`
// );

// async function setQuestionPrevVote() {
//   try {
//     let res = await fetch(`../../controller/vote.php?voteFor=question`);
//     let prevVotes = await res.json();

//     let upvoteIcon = questionActionVote.children[0];
//     let downvoteIcon = questionActionVote.children[2];
//     for (let prevVote of prevVotes) {
//       if (prevVote.question_id == url.searchParams.get("id")) {
//         if (prevVote.vote == 1) {
//           upvoteIcon.classList.add("upvote");
//           if (downvoteIcon.classList.contains("downvote")) {
//             downvoteIcon.classList.remove("downvote");
//           }
//         }
//         if (prevVote.vote == 0) {
//           downvoteIcon.classList.add("downvote");
//           if (upvoteIcon.classList.contains("upvote")) {
//             upvoteIcon.classList.remove("upvote");
//           }
//         }
//         return;
//       }
//     }
//     if (upvoteIcon.classList.contains("upvote")) {
//       upvoteIcon.classList.remove("upvote");
//     }
//     if (downvoteIcon.classList.contains("downvote")) {
//       downvoteIcon.classList.remove("downvote");
//     }
//   } catch (e) {
//     console.log("Error: ", e);
//   }
// }

// async function setAnsPrevVote() {
//   try {
//     let res = await fetch(`../../controller/vote.php?voteFor=answer`);
//     return await res.text();
//   } catch (e) {
//     console.log("Error: ", e);
//   }
// }
 
// window.onload = () => {
//   setQuestionPrevVote();
// };
