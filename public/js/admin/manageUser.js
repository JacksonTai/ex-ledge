/* -- User search bar -- */
let userSearchBar = document.querySelector(".user-search-bar");
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

// Pop Up Display to ask if admin wants to ban user
function confirmDeletion(uid) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
            banUser(uid);
          Swal.fire(
            'Deleted!',
            'Account has been banned and deleted.',
            'success'
          ).then(()=>{
            window.location = "../../view/admin/manageUser.php";          
          })
        }
      }) 
}

// Execute function
async function banUser(userId) {
    try {
        await fetch(`../../controller/user.php?deleteId=${userId}`);
    } catch(e) {
        console.log(e);
    }
}
