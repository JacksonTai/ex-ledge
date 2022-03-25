
// Pop Up Display to ask if admin wants to ban user
function confirmDeletion(qid) {
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
            banUser(qid);
          Swal.fire(
            'Deleted!',
            'Question has been deleted.',
            'success'
          ).then(()=>{
            window.location = "../../view/admin/manageQA.php";          
          })
        }
      }) 
}

// Execute function
async function banUser(questionId) {
    try {
        await fetch(`../../controller/question.php?deleteId=${questionId}`);
    } catch(e) {
        console.log(e);
    }
}
