<?php
$user = new \Controller\User;
$question = new \Controller\Question();
?>
<aside class="layout-sidebar">
     <?php $url = $_SERVER['REQUEST_URI']; ?>
     <?php if (strpos($url, 'question')) : ?>
          <button class="layout-sidebar-btn layout-sidebar-btn--ask-question dialog">
               <a class="layout-sidebar-link" href="askQuestion.php">Ask Question</a>
          </button>
     <?php endif; ?>
     <div class="layout-sidebar__content layout-sidebar__content--top-user dialog">
          <h3 class="layout-sidebar__content-title">Top Users</h3>
          <?php $topUsers = $user->readRank(5); ?>
          <?php foreach ($topUsers as $topUser) : ?>
               <a class="layout-sidebar__top-user" href="profile.php?id=<?php echo htmlspecialchars($topUser['user_id']); ?>">
                    <img class="sidebar-top-user__profile-img profile-icon" src="<?php echo $path ?>public/img/profile1.jpg" alt="Profile Image">
                    <p class="sidebar-top-user__username"><?php echo htmlspecialchars($topUser['username']); ?></p>
               </a>
          <?php endforeach; ?>
     </div>
     <div class="layout-sidebar__content layout-sidebar__content--hot-topic dialog">
          <h3 class="layout-sidebar__content-title">Hot Topics</h3>
          <?php foreach ($question->hotQuestion() as $hotQuestion) : ?>
               <a class="layout-sidebar__hot-topic" href="question.php?id=<?php echo htmlspecialchars($hotQuestion['question_id']); ?>">
                    <?php echo htmlspecialchars($hotQuestion['content']) ?>
               </a>
          <?php endforeach; ?>
     </div>
</aside>