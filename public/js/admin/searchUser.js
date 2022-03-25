/* -- User search bar -- */
let userSearchBar = document.querySelector(".chat-section__user-search-bar");
let userContainer = document.querySelector("#user_container");

// Get and return data from the given sources.
async function getData(url) {
    try {
      let res = await fetch(url);
      return await res.json();
    } catch (e) {
      console.log("Error: ", e);
    }
}

userSearchBar.addEventListener("input", async function () {
  try {
    let res = await getData(
      `../../controller/user.php?searchTerm=${this.value}`
    );
    userContainer.innerHTML = res;
  } catch (e) {
    console.log("Error: ", e);
  }
});