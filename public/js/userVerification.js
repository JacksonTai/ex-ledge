let acceptBtns = document.querySelectorAll(".user-verification-btn--accept");

for (let acceptBtn of acceptBtns) {
  acceptBtn.addEventListener("click", function () {
    updateVerification(acceptBtn.parentElement.dataset.userId);
    acceptBtn.closest(".user-verification-wrapper").style.display = "none";
  });
}

let rejectBtns = document.querySelectorAll(".user-verification-btn--reject");

for (let rejectBtn of rejectBtns) {
  rejectBtn.addEventListener("click", function () {
    rejectVerification(rejectBtn.parentElement.dataset.userId);
    rejectBtn.closest(".user-verification-wrapper").style.display = "none";
  });
}

let nricNo = document.querySelector(".user-verification--nric-no");

async function updateVerification(userId) {
  await fetch(
    `../../controller/user.php?verifId=${userId}&
    nricNo=${nricNo.textContent.replace("NRIC:", "").trim()}`
  );
}

async function rejectVerification(userId) {
  await fetch(`../../controller/user.php?rejectverifId=${userId}`);
}
