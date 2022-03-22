/* -- Helper function -- */
// Scroll chatbox to the bottom.
function scrollToBottom() {
  chatBox.scrollTop = chatBox.scrollHeight;
}

// Show chat area and hide user list.
function showChatArea() {
  userList.classList.remove("display-chat-element");
  userList.classList.add("hide-chat-element");
  chatArea.classList.remove("hide-chat-element");
  chatArea.classList.add("display-chat-element");
}

// Get and return user data in json format by using user ID.
async function getUserData(userId) {
  try {
    const res = await fetch(`../../controller/user.php?userId=${userId}`);
    return await res.json();
  } catch (e) {
    console.log("Error: ", e);
  }
}

// Style chat box and user list.
async function styleChat(user) {
  for (let user of users) {
    if (user.classList.contains("user-selected")) {
      user.classList.remove("user-selected");
    }
  }
  if (!user.classList.contains("user-selected")) {
    user.classList.add("user-selected");
  }

  let userData = await getUserData(user.dataset.userId);
  let chattingUsername = document.querySelector(
    ".chat-section__chatting-username"
  );

  chattingUsername.textContent = "";
  chattingUsername.append(userData.username);
}

/* -- Responsive handling -- */
const url = new URL(window.location);
const originalUrl = url.href.split("?")[0];
let userList = document.querySelector(".chat-section__user-list");
let users = document.querySelectorAll(".chat-section__user");
let chatBackBtn = document.querySelector(".chat-section__back-btn");
let chatArea = document.querySelector(".chat-section__chat-area");
let chatBox = document.querySelector(".chat-section__chat-box");

window.onload = () => {
  // Scroll the chatbox to bottom once page is being loaded or reloaded.
  scrollToBottom();

  if (url.href.includes("id")) {
    // Keep chat area opened in small screen size when page URL parameter has user ID.
    window.innerWidth < 1245 ? showChatArea() : null;

    // Style when page URL parameter has user ID.
    for (let user of users) {
      if (user.dataset.userId == url.searchParams.get("id")) {
        styleChat(user);
      }
    }
  }
};

window.onresize = () => {
  if (window.innerWidth > 1245) {
    userList.classList.add("display-chat-element");
  }
  if (window.innerWidth < 1245) {
    url.href.includes("id") ? showChatArea() : null;
 
  }
};

chatBackBtn.addEventListener("click", () => {
  // Show user list and hide chat area.
  userList.classList.remove("hide-chat-element");
  chatArea.classList.remove("display-chat-element");
  if (url.href.includes("id")) {
    // Remove URL parameter and replace it with the page original URL.
    url.searchParams.delete("id");
    window.history.replaceState({}, "", originalUrl);
  }
});

for (let user of users) {
  user.addEventListener("click", function () {
    // Set URL parameter with the value of selected user ID.
    url.searchParams.set("id", this.dataset.userId);
    window.history.replaceState({}, "", url);

    // Open chat area in small screen size when page URL parameter has user ID.
    window.innerWidth < 1245 ? showChatArea() : "";

    styleChat(this);
  });
}
/* ========================= CODE BELOW THIS LINE IS STILL IN PROGRESS ============================= */
let typingBox = document.querySelector(".chat-section__typing-box");
let sendMsgBtn = document.querySelector(".chat-section__send-msg-btn");

typingBox.addEventListener("input", function () {
  sendMsgBtn.classList.remove("chat-typed");
  if (this.value) {
    sendMsgBtn.classList.add("chat-typed");
  }
});

sendMsgBtn.addEventListener("click", () => {
  console.log(typingBox.value);
});

/* -- User search bar -- */
let userSearchBar = document.querySelector(".chat-section__user-search-bar");
let userContainer = document.querySelector(".chat-section__user-container");

userSearchBar.addEventListener("input", async function () {
  try {
    const res = await fetch(
      `../../controller/user.php?searchTerm=${this.value}`
    );

    let userList = await res.text();
    console.log(userList);
    // userContainer.append(userList);
  } catch (e) {
    console.log("Error: ", e);
  }
});
