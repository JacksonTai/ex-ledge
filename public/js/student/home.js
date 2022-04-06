let homeFilterBtn = document.querySelector(".home__header-btn--filter");
let cancelFilterBtn = document.querySelector(".home__cancel-filter-btn");
let filterContainer = document.querySelector(".home__filter-container");

homeFilterBtn.addEventListener("click", () => {
  homeFilterBtn.classList.toggle("btn-click");
  filterContainer.classList.toggle("hide");
});

cancelFilterBtn.addEventListener("click", () => {
  homeFilterBtn.classList.toggle("btn-click");
  filterContainer.classList.toggle("hide");
});

// Pop Up Display to ask if user wants to delete question.
function confirmDeletion(qid) {
  Swal.fire({
    title: "Are you sure?",
    text: "You won't be able to revert this!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Yes, delete it!",
  }).then((result) => {
    if (result.isConfirmed) {
      banUser(qid);
      Swal.fire("Deleted!", "Question has been deleted.", "success").then(
        () => {
          window.location = "../../view/student/home.php";
        }
      );
    }
  });
}

// Execute function
async function banUser(questionId) {
  try {
    await fetch(`../../controller/question.php?deleteId=${questionId}`);
  } catch (e) {
    console.log(e);
  }
}
