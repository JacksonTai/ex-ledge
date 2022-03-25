/* -- User search bar -- */
let userSearchBar = document.querySelector(".chat-section__user-search-bar");
let userContainer = document.querySelector("#user_container");

userSearchBar.addEventListener("input", async function () {
  try {
    let res = await fetch(
      `../../controller/user.php?searchTerm=${this.value}`
    );
    userContainer.innerHTML = await res.json();
  } catch (e) {
    console.log("Error: ", e);
  }
});