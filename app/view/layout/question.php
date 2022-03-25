<?php
$questions = new \Controller\Question();
$answer = new \Controller\Answer(); 
$timestamp = $questions->get_time($question['time_posted']); ?>
<article class="layout__question dialog">
     <div class="layout__question-vote-container">
          <i class="layout__question-vote fa-solid fa-arrow-up fa-lg up" id="up" data-question-id="<?php echo htmlspecialchars($question['question_id']); ?>"></i>
          <p class="layout__question-point" id="vote" data-question-id="<?php echo htmlspecialchars($question['question_id']); ?>"><?php echo htmlspecialchars($question['point']); ?></p>
          <i class="layout__question-vote fa-solid fa-arrow-down fa-lg down" id="down" data-question-id="<?php echo htmlspecialchars($question['question_id']); ?>"></i>
     </div>
     <div class="layout__question-header">
          <h3 class="layout__question-title">
               <?php echo htmlspecialchars($question['title']); ?>
          </h3>
          <div class="layout__question-button">
               <p class="layout__question-answer">
                    <?php
                    $answerNum = $answer->answerCount($question['question_id']);
                    if ($answerNum > 1) {
                         echo htmlspecialchars($answerNum . ' Answers');
                    } else if ($answerNum == 0 || $answerNum == 1) {
                         echo htmlspecialchars($answerNum . ' Answer');
                    }
                    ?>
               </p>
               <?php if ($_SESSION['userId'][0] == "A") { ?>
                    <button class="layout__question-remove-btn" onclick="confirmDeletion('<?php echo htmlspecialchars($question['question_id']); ?>')">Remove</button>
               <?php } ?>
          </div>
     </div>

     <a class="layout__question-body" href="../student/question.php?id=<?php echo htmlspecialchars($question['question_id']); ?>">
          <p class="layout__question-content"><?php echo htmlspecialchars($question['content']); ?></p>
     </a>
     
     <p class="layout__question-tag"><?php echo htmlspecialchars($question['tag']); ?></p>

     <div class="layout__question-footer">
          <div class="layout__question-poster">
               <img class="layout__question-profile-img profile-icon" src="../../../public/img/profile1.jpg" alt="Profile Image">
               <p class="layout__question-post-info">
                    <span class="layout__question-posted-by">Posted by</span>
                    <a class="layout__question-username" href="../student/profile.php?id=<?php echo htmlspecialchars($question['user_id']); ?>"><?php echo htmlspecialchars($question['username']); ?></a>
                    <span class="layout__question-posted-time"><?php echo htmlspecialchars($timestamp); ?></span>
               </p>
          </div>
          <?php if ($_SESSION['userId'][0] == "U") { ?>
               <div class="layout__question-bookmark" data-bookmark-id="<?php echo htmlspecialchars($question['question_id']); ?>">
                    <i class="question-bookmark-icon fa-solid fa-bookmark"></i>
                    <p>Bookmark</p>
               </div>
          <?php } ?>
     </div>
</article>