let acceptBtns = document.querySelectorAll('.user-verification-btn--accept');
let verifContainer = document.querySelector('.user-verification-wrapper');

for (let acceptBtn of acceptBtns) {
    acceptBtn.addEventListener('click', function () {
        console.log(acceptBtn.parentElement.dataset.userId);
        updateVerification(acceptBtn.parentElement.dataset.userId);
        verifContainer.style.display = "none";
    })
}

let rejectBtns = document.querySelectorAll('.user-verification-btn--reject');
let rejectBtnContainer = document.querySelector('.user-verification-wrapper');

for (let rejectBtn of rejectBtns) {
    rejectBtn.addEventListener('click', function () {
        console.log(rejectBtn.parentElement.dataset.userId);
        rejectVerification(rejectBtn.parentElement.dataset.userId);
        verifContainer.style.display = "none";
    })
}

async function updateVerification (userId) {
    await fetch(`../../controller/user.php?verifId=${userId}`);
}

async function rejectVerification (userId) {
    await fetch(`../../controller/user.php?rejectverifId=${userId}`);
}