/* -- Helper function -- */
function styleVote(vote) {
    let upVoteSelected = false, downVoteSelected = false;

    if (vote.id == 'up') {
        vote.style.color = "var(--clr-primary)";
        vote.nextElementSibling.nextElementSibling.style.color = "#9f9f9f";
    }
    if (vote.id == 'down') {
        vote.style.color = "#FF5757";
        vote.previousElementSibling.previousElementSibling.style.color = "#9f9f9f"
    }
  
}


let upvotes = document.querySelectorAll("#up");
for (let upvote of upvotes) {
    upvote.addEventListener("click", ()=> {
        updateVote(upvote.dataset.questionId, 1);
        styleVote(upvote);
    })
}

let downvotes = document.querySelectorAll("#down");
for (let downvote of downvotes) {
    downvote.addEventListener("click", ()=> {
        updateVote(downvote.dataset.questionId, -1);
        styleVote(downvote);
    })
}

async function updateVote(questionId, voteType) {
    try {
        await fetch(`../../controller/question.php?questionId=${questionId}&voteType=${voteType}`);
    } catch(e) {
        console.log(e);
    }
}

async function readPoint(questionId) {
    try {
        let res = await fetch(`../../controller/question.php?p-questionId=${questionId}`);
        let data = await res.json();
        return data.point;
    } catch(e) {
        console.log(e);
    }
}

async function readVote(questionId) {
    try {
        let res = await fetch(`../../controller/question.php?v-questionId=${questionId}`);
        let data = await res.text();
        return data.vote;
    } catch(e) {
        console.log(e);
    }
}

let votes = document.querySelectorAll("#vote");
setInterval(async function () {
    
    for(let vote of votes) {
        let point = await readPoint(vote.dataset.questionId);
        let prevVote = await readVote(vote.dataset.questionId);
      d
        vote.textContent = point;
}}, 1000);
