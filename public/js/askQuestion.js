// Pop Up Alert After a successful post submission
function pop_up_success(){
    Swal.fire({
        icon:'success',
        title: 'Success', 
        text: 'Question Successfully Posted!',
        showDenyButton: false,
        showCancelButton: false,
        confirmButtonText: '<p class="alert_text">Continue</p>'
    }).then(function() {
        window.location = "../student/home.php";
    });
}


let questionForm = document.querySelector(".question__form");

questionForm.addEventListener("submit", async function (e){
  e.preventDefault();

  let formData = new FormData(this);

    try {
        const res = await fetch("../../controller/askQuestion.php", {
            method: "POST",
            body: formData,
        });

        let errMsg = await res.json();

        // Redirect to user page once there is no error messages.
        if (!errMsg) {
            pop_up_success();
        } else {
            // Destruct the errMsg object.
            let { title, content, tag } = errMsg;

            // Add error messages to the respective HTML element.
            let titleErrMsg = document.querySelector(".askquestion__err-msg--title");
            let contentErrMsg = document.querySelector(".askquestion__err-msg--content");
            let tagErrMsg = document.querySelector(".askquestion__err-msg--tag");

            titleErrMsg.textContent = decodeEntity(title);
            contentErrMsg.textContent = decodeEntity(content);
            tagErrMsg.textContent = decodeEntity(tag);

        }
    } catch (e) {
    console.log("Error: ", e);
    }
});

// Decode HTML entity code to use in JavaScript.
const decodeEntity = function (entityCode) {
  let textarea = document.createElement("textarea");
  textarea.innerHTML = entityCode;
  return textarea.value;
};