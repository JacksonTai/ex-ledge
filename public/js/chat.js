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

// Comprehensive helper to update page status when user is being clicked.
async function updateStatus(user) {
  // Set URL parameter with the value of selected user ID.
  url.searchParams.set("id", user.dataset.userId);
  window.history.replaceState({}, "", url);

  // Update chatting username in header of chat area.
  let userData = await getData(
    `../../controller/user.php?userId=${user.dataset.userId}`
  );
  chattingUsername.textContent = "";
  chattingUsername.append(userData.username);

  // Open chat area in small screen size when page URL parameter has user ID.
  window.innerWidth < 1245 ? showChatArea() : "";
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

// Add previously messaged user.
async function addPreviousMessagedUser() {
  let previousMessagedUsers = await getData(
    `../../controller/user.php?
    senderId=${sendMsgBtn.dataset.senderId}&
    receiverId=${url.searchParams.get("id")}`
  );
  userContainer.innerHTML = previousMessagedUsers;

  // Add event listener for messaged user in user container.
  for (let user of userContainer.children) {
    user.addEventListener("click", () => {
      updateStatus(user);
    });
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
  if (this.value.trim()) {
    // Use helper function to get users search result.
    let searchingUser = await getData(
      `../../controller/user.php?searchTerm=${this.value.trim()}`
    );
    userContainer.innerHTML = searchingUser;
    for (let user of userContainer.children) {
      user.addEventListener("click", () => {
        updateStatus(user);
        // Clear search bar input once searching user is clicked.
        addPreviousMessagedUser();
        userSearchBar.value = "";
      });
    }
  } else {
    addPreviousMessagedUser();
  }
});

/* -- Message handling -- */
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
      addPreviousMessagedUser();
      scrollToBottom();
    } catch (e) {
      console.log("Error: ", e);
    }
  }
});

let chatAreaFocus = false;
chatArea.addEventListener("mouseenter", () => {
  chatAreaFocus = true;
});
chatArea.addEventListener("mouseleave", () => {
  chatAreaFocus = false;
});

setInterval(() => {
  // Constantly updating new messages within specify time interval.
  addMsg();

  // Stop updating user in user container if the user is searching for other user.
  if (!userSearchBar.value) {
    addPreviousMessagedUser();
  }

  // Stop scrolling to bottom if user's cursor is focusing on the chat area.
  chatAreaFocus ? null : scrollToBottom();
}, 350);
