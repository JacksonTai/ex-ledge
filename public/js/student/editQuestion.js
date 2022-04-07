let url = new URL(window.location);
// Pop Up Alert After a successful post submission
function pop_up_success() {
  Swal.fire({
    icon: "success",
    title: "Success",
    text: "Question Successfully Edited!",
    showDenyButton: false,
    showCancelButton: false,
    confirmButtonText: '<p class="alert_text">Continue</p>',
  }).then(() => {
    window.location = `../student/question.php?id=${url.searchParams.get(
      "id"
    )}`;
  });
}
