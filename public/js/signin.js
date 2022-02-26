let signinForm = document.querySelector(".signin__form");

signinForm.addEventListener("submit", async function (e) {
  e.preventDefault();

  let formData = new FormData(this);

  try {
    const res = await fetch("../../controller/signin.php", {
      method: "POST",
      body: formData,
    });

    let result = await res.json();

    // Redirect to user page once there is no error messages.
    if (result[0] == "U") {
      window.location.href = "../student/home.php";
    } else if (result[0] == "A") {
      window.location.href = "../admin/dashboard.php";
    } else {
      // Destruct the result object.
      let { email, password, invalidCredential } = result;

      // Add error messages to the respective HTML element.
      let emailErrMsg = document.querySelector(".signin__err-msg--email");
      let passwordErrMsg = document.querySelector(".signin__err-msg--password");
      let invalidCredentialErrMsg = document.querySelector(
        ".signin__err-msg--invalid-credential"
      );

      emailErrMsg.textContent = decodeEntity(email);
      passwordErrMsg.textContent = decodeEntity(password);
      invalidCredentialErrMsg.textContent = decodeEntity(invalidCredential);
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
