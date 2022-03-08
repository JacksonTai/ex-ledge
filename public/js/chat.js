// Helper function for scrolling chatbox to bottom
function scrollToBottom() {
  chatBox.scrollTop = chatBox.scrollHeight;
}

// Scroll the chatbox to bottom once page is being loaded or reloaded.
window.onload = scrollToBottom;

/* -- User list & Chat area -- */
let users = document.querySelectorAll(".chat-section__user");
let userList = document.querySelector(".chat-section__user-list");
let chatAreaHeader = document.querySelector(".chat-section__chat-area-header");
let chatBackBtn = document.querySelector(".chat-section__back-btn");
let chatArea = document.querySelector(".chat-section__chat-area");
let chatBox = document.querySelector(".chat-section__chat-box");
let userSelected = false;

chatBackBtn.addEventListener("click", () => {
  userList.classList.remove("hide-chat");
  chatArea.classList.remove("display-chat");
});

window.onresize = function () {
  if (window.innerWidth > 1245) {
    userList.classList.add("display-chat");
  } else {
    userList.classList.remove("display-chat");
    if (userSelected) {
      userList.classList.add("hide-chat");
      chatArea.classList.add("display-chat");
    }
  }
};

for (let user of users) {
  user.addEventListener("click", () => {
    userSelected = true;
    styleChat(user);
    if (window.innerWidth < 1245) {
      userList.classList.add("hide-chat");
      chatArea.classList.add("display-chat");
    }
  });
}

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

async function getUserData(userId) {
  try {
    const res = await fetch(`../../controller/user.php?userId=${userId}`);
    return await res.json();
  } catch (e) {
    console.log("Error: ", e);
  }
}

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
