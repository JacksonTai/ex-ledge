$(document).ready(function(){
    var limit = 12; // Set how many display to load
    var start = 0; // Set from which row in MySQL to start
    var searchTerm = document.querySelector(".chat-section__user-search-bar").value;
    var action = 'inactive'; // To determine if fetch request is running
    function load_user_data(limit, start, searchTerm)
    {
         $.ajax({
              url:"../../controller/user.php", // Page in which we will be sending our request
              method: "POST", // Im not getting info back, I am posting my request to the url above, and getting the reply I want constantly
              data:{limit:limit, start:start, searchTerm:searchTerm}, //The data that will be sent to URL.

              // A safeguard for someone using Internet Explorer running Ex-Ledge
              cache:false, // Internet Explorer Issue: If i don't put this, I have a chance of getting old data. Example: If one of the users suddenly change their username, I will be seeing his old username, rather than the new one due to cache
              
              // Request has been called successfully
              success:function(data)
              {     
                    // Add what was returned from the url into the user_container id
                    $('#user_container').append(data);                         

                    if(data == '') // If url returns nothing
                    {     
                         // NOTICE FROM E HENG: 
                         // IF U WANT TO ADD SOMETHING HTML LIKE 'No more users', DO IT IN THIS BLOCK 
                         action = 'active';
                    }
                    else
                    {
                         // NOTICE FROM E HENG: 
                         // IF U WANT TO ADD SOMETHING HTML LIKE 'Loading...', DO IT IN THIS BLOCK
                         action = 'inactive';
                    }
              }
         });
    }
    
    if(action == 'inactive')
    {
         action = 'active';
         var searchTerm = document.querySelector(".chat-section__user-search-bar").value;
         load_user_data(limit, start, searchTerm);
    }
    // If we scroll the page, function below will execute
    $(window).scroll(function(){
         // Check if height of scroll position + height of window is higher than the heigh of user container
         if($(window).scrollTop() + $(window).height() > $("#user_container").height() && action == 'inactive')
         {
              action = 'active';
              start = start + limit;
              var searchTerm = document.querySelector(".chat-section__user-search-bar").value;
              setTimeout(function(){
                   load_user_data(limit, start, searchTerm);
              }, 1000);
         }
    });
});