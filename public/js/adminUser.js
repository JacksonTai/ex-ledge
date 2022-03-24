// let banButtons = document.querySelectorAll("#banUser");

// banButtons.forEach((banButton)=>{
//     banButton.addEventListener("click", ()=> {
//         confirmDeletion(banButton.dataset.userId);
//     })
// })

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

async function banUser(userId) {
    try {
        await fetch(`../../controller/user.php?deleteId=${userId}`);
    } catch(e) {
        console.log(e);
    }
}
