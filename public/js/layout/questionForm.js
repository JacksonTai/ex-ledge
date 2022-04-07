let questionForm = document.querySelector(".question__form");

questionForm.addEventListener("submit", async function (e) {
  e.preventDefault();

  let formData = new FormData(this);

  try {
    // Start fetch request
    const res = await fetch("../../controller/question.php", {
      method: "POST",
      body: formData,
    });

    // Waits for a response, and treat it as a json object
    let errMsg = await res.json();
    console.log(errMsg)

    // Redirect to user page once there is no error messages.
    if (!errMsg) {
      pop_up_success();
    } else {
      // Destruct the errMsg object.
      let { title, content, tag } = errMsg;

      // Add error messages to the respective HTML element.
      let titleErrMsg = document.querySelector(".askquestion__err-msg--title");
      let contentErrMsg = document.querySelector(
        ".askquestion__err-msg--content"
      );
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
