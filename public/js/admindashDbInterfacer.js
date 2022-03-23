//the virgin ajax vs the chad xhr
//init an xhr object
// var xhr= new XMLHttpRequest();

// xhr.onreadystatechange = function(){
//     if (this.readystate==4 && this.status==200){
//         echo(xhr.responseText);
//     }
// };


// xhr.open("GET", '../../controller/user.php', true);
// xhr.setRequestHeader('returnAdministrativeData', 'true');
// xhr.send();

fetch('../../controller/user.php',{headers: {returnAdministrativeData: 'true',}})


//.then (response=>{
//    if (!response.ok) {throw new Error(`HTTP error: ${response.status}`)}
//    console.log(response.json()
//)})

.then(result=>{console.log('Success:', result)})
.catch(error => {console.error('Error:', error)})

console.log("hi");