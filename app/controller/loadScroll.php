<?php 

if (isset($_POST["limit"], $_POST["start"]))
{
    $connect = mysqli_connect("localhost", "root", "", "ex_ledge");
    $sql = "SELECT * FROM user WHERE `user_id` LIKE 'U%' ORDER BY username ASC LIMIT ".$_POST["limit"]." OFFSET ".$_POST["start"]."";
    $result = mysqli_query($connect, $sql);
    while($row = mysqli_fetch_array($result))
    {
        echo'
            <div class="user_box" id='.($row['user_id']).' data-user-id='.($row['user_id']).'>
                <a class="user_info" href="profile.php?id='.($row['user_id']).'">
                    <img class="user_img" src="https://wac-cdn.atlassian.com/dam/jcr:ba03a215-2f45-40f5-8540-b2015223c918/Max-R_Headshot%20(1).jpg?cdnVersion=231" alt="user_img">
                    <div class="user_info-detail">    
                        <p class="user_name">'.($row['username']).'</p>
                        <p class="RP">RP: '.($row['point']).'</p>
                    </div>
                </a>
            </div>        
        ';
    }
}


?>