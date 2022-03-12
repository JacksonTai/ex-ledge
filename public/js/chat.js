const url = new URL(window.location);
const originalUrl = url.href.split("?")[0];
let userList = document.querySelector(".chat-section__user-list");
let chattingUsername = document.querySelector(
  ".chat-section__chatting-username"
);
let chatBackBtn = document.querySelector(".chat-section__back-btn");
let chatArea = document.querySelector(".chat-section__chat-area");
let chatBox = document.querySelector(".chat-section__chat-box");

/* ==================== Helper function ==================== */
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

// Get and return data from the given sources.
async function getData(url) {
  try {
    let res = await fetch(url);
    return await res.json();
  } catch (e) {
    console.log("Error: ", e);
  }
}

// Style chat box and user list.
async function styleChat(user) {
  // let previousMessagedUsers = await getData(
  //   `../../controller/user.php?senderId=${sendMsgBtn.dataset.senderId}`
  // );
  // console.log(users);
  // for (let previousMessagedUser of previousMessagedUsers) {
  // console.log(previousMessagedUser);
  // if (previousMessagedUser.classList.contains("user-selected")) {
  //   previousMessagedUser.classList.remove("user-selected");
  // }
  // }
}

// Comprehensive helper to update page status when user is being clicked.
async function updateStatus(user) {
  // Set URL parameter with the value of selected user ID.
  url.searchParams.set("id", user.dataset.userId);
  window.history.replaceState({}, "", url);

  // Open chat area in small screen size when page URL parameter has user ID.
  window.innerWidth < 1245 ? showChatArea() : "";

  let userData = await getData(
    `../../controller/user.php?userId=${user.dataset.userId}`
  );
  chattingUsername.textContent = "";
  chattingUsername.append(userData.username);
}

// Add chatting messages to chat box.
async function addMsg() {
  let msgInfos = await getData(
    `../../controller/message.php?
    senderId=${sendMsgBtn.dataset.senderId}&
    receiverId=${url.searchParams.get("id")}`
  );
  chatBox.innerHTML = msgInfos;
}

// Add user to user container.
async function addUser(user) {
  // Create HTML element of searching user.
  let username = document.createElement("p");
  username.classList.add("chat-section__username");
  username.textContent = user.username;

  let userContent = document.createElement("div");
  userContent.classList.add("chat-section__user-content");
  userContent.append(username);

  let userImg = document.createElement("img");
  userImg.classList.add(...["chat-section__user-img", "chat-profile-img"]);
  userImg.src = "../../../public/img/profile1.jpg";

  let searchingUser = document.createElement("div");
  searchingUser.classList.add("chat-section__user");
  searchingUser.id = user.user_id;
  searchingUser.dataset.userId = user.user_id;
  searchingUser.append(userImg, userContent);

  // Add event listener for user that is being searched.
  searchingUser.addEventListener("click", () => {
    // Clear search bar when user click on one of the searching user.
    userSearchBar.value = "";

    // Clear all searching user when user click on one of it.
    removeUser();

    // Add back the removed previously messaged user.
    addPreviousMessagedUser();

    // Refresh message in chat box.
    chatBox.textContent = "";
    addMsg();

    updateStatus(searchingUser);
  });
  userContainer.append(searchingUser);
}

// Remove all user in user container.
function removeUser() {
  while (userContainer.firstChild) {
    userContainer.removeChild(userContainer.firstChild);
  }
}

// Add previously messaged user.
async function addPreviousMessagedUser() {
  let previousMessagedUsers = await getData(
    `../../controller/user.php?senderId=${sendMsgBtn.dataset.senderId}`
  );
  for (let previousMessagedUser of previousMessagedUsers) {
    addUser(previousMessagedUser);
  }

  for (let user of userContainer.children) {
    if (
      !user.classList.contains("user-selected") &&
      user.dataset.userId == url.searchParams.get("id")
    ) {
      user.classList.add("user-selected");
    }
  }
}

/* ==================== Responsive handling ==================== */
window.onload = async function () {
  // Scroll the chatbox to bottom once page is being loaded or reloaded.
  scrollToBottom();

  addPreviousMessagedUser();

  if (url.href.includes("id")) {
    // Keep chat area opened in small screen size when page URL parameter has user ID.
    window.innerWidth < 1245 ? showChatArea() : null;

    addMsg();

    // Style when page URL parameter has user ID.
    let userData = await getData(
      `../../controller/user.php?userId=${url.searchParams.get("id")}`
    );

    if (userData) {
      chattingUsername.textContent = "";
      chattingUsername.append(userData.username);
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

    chattingUsername.textContent = "";
  }
});

/* -- User search bar -- */
let userSearchBar = document.querySelector(".chat-section__user-search-bar");
let userContainer = document.querySelector(".chat-section__user-container");

userSearchBar.addEventListener("input", async function () {
  // Clear searching user everytime user type.
  removeUser();

  if (this.value.trim()) {
    // Use helper function to get users search result.
    var searchingUsers = await getData(
      `../../controller/user.php?searchTerm=${this.value.trim()}`
    );

    // Use helper function to add user in HTML.
    for (let searchingUser of searchingUsers) {
      addUser(searchingUser);
    }
  }

  if (!userContainer.firstChild) {
    addPreviousMessagedUser();
  }
});

/* -- Message handling -- */
let previousChatUser = [];
let typingForm = document.querySelector(".chat-section__typing-form");
let typingBox = document.querySelector(".chat-section__typing-box");
let sendMsgBtn = document.querySelector(".chat-section__send-msg-btn");

typingBox.addEventListener("input", function () {
  sendMsgBtn.classList.remove("chat-typed");
  if (this.value) {
    sendMsgBtn.classList.add("chat-typed");
  }
});

typingForm.addEventListener("submit", async function (e) {
  e.preventDefault();

  if (typingBox.value.trim()) {
    let formData = new FormData(this);
    formData.append("senderId", sendMsgBtn.dataset.senderId);
    formData.append("receiverId", url.searchParams.get("id"));

    try {
      await fetch("../../controller/message.php", {
        method: "POST",
        body: formData,
      });

      // Disable send message button when message is being sent.
      if (sendMsgBtn.classList.contains("chat-typed")) {
        sendMsgBtn.classList.remove("chat-typed");
      }

      // Clear typing box when message is being sent.
      if (typingBox.value) {
        typingBox.value = "";
      }
      removeUser();
      addPreviousMessagedUser();
    } catch (e) {
      console.log("Error: ", e);
    }
  }
});

setInterval(() => {
  addMsg();
  scrollToBottom();
}, 500);
