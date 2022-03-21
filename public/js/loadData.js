$(document).ready(function(){
    var limit = 12;
    var start = 0;
    var action = 'inactive';
    function load_user_data(limit, start)
    {
         $.ajax({
              url:"../../controller/loadScroll.php",
              method: "POST", 
              data:{limit:limit, start:start},
              cache:false, 
              success:function(data)
              {
                   $('#user_container').append(data);
                   if(data == '')
                   {
                        $('#user_container_message').html("<h3>No More Users</h3>")
                        action = 'active';
                   }
                   else
                   {
                        $('#user_container_message').html("<h3>Loading...</h3>")
                        action = 'inactive';
                   }
              }
         });
    }

    if(action == 'inactive')
    {
         action = 'active';
         load_user_data(limit, start);
    }
    $(window).scroll(function(){
         if($(window).scrollTop() + $(window).height() > $("#user_container").height() && action == 'inactive')
         {
              action = 'active';
              start = start + limit;
              setTimeout(function(){
                   load_user_data(limit, start);
              }, 1000);
         }
    });
});