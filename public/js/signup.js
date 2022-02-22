let signupForm = document.querySelector(".signup__form");

signupForm.addEventListener("submit", async function (e) {
  e.preventDefault();

  let formData = new FormData(this);
  formData.append("action", "signup");

  try {
    const res = await fetch("../controller/signup.php", {
      method: "POST",
      body: formData,
    });

    let errMsg = await res.json();

    // Redirect to user page once there is no error messages.
    if (!errMsg) {
      window.location.href = "student.php";
    } else {
      // Destruct the errMsg object.
      let { email, fullName, password, passwordRepeat } = errMsg;

      // Add error messages to the respective HTML element.
      let emailErrMsg = document.querySelector(".signup__err-msg--email");
      let fullNameErrMsg = document.querySelector(
        ".signup__err-msg--full-name"
      );
      let passwordErrMsg = document.querySelector(".signup__err-msg--password");
      let passwordRepeatErrMsg = document.querySelector(
        ".signup__err-msg--password-repeat"
      );
      emailErrMsg.textContent = decodeEntity(email);
      fullNameErrMsg.textContent = decodeEntity(fullName);
      passwordErrMsg.textContent = decodeEntity(password);
      passwordRepeatErrMsg.textContent = decodeEntity(passwordRepeat);

      // Display field rules when the input is invalid.
      let fullNameRules = document.querySelectorAll(
        ".signup__rules--full-name"
      );
      for (let fullNameRule of fullNameRules) {
        if (fullName.includes("&#9888;")) {
          fullNameRule.classList.add("signup__rules-show");
        } else {
          fullNameRule.classList.remove("signup__rules-show");
        }
      }

      let passwordRules = document.querySelectorAll(".signup__rules--password");
      for (let passwordRule of passwordRules) {
        if (password.includes("&#9888;")) {
          passwordRule.classList.add("signup__rules-show");
        } else {
          passwordRule.classList.remove("signup__rules-show");
        }
      }
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
