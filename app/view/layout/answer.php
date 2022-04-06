<div class="layout-answer dialog">
     <div class="layout-answer__user">
          <img class="profile-icon" src="../../../public/img/profile1.jpg" alt="Profile Image">
          <div class="layout-answer__user-info">
               <h3><?php echo htmlspecialchars($user->read($userAns['answer_id'])['username']) ?></h3>
          </div>
          <div class="layout-answer__best-answer <?php echo $userAns['status'] ? 'show' : '' ?>">
               <i class="fa-solid fa-circle-check"></i>
               <span>Best Answer</span>
          </div>
     </div>
     <?php $answerLink = $userAns['question_id'] . '#' . $userAns['answer_id']; ?>
     <a href="../../view/student/question.php?id=<?php echo htmlspecialchars($answerLink) ?>" class="layout-answer__text">
          <?php echo htmlspecialchars($userAns['content']); ?>
     </a>
     <div class="layout-answer__action-container">
          <div class="layout-answer__action layout-answer__action--vote" data-vote-id="<?php echo htmlspecialchars($userAns['answer_id']); ?>">
               <i class="vote-icon fa-solid fa-arrow-up fa-lg" id="upvote"></i>
               <p class="layout-answer__point">
                    <?php echo htmlspecialchars($userAns['point']); ?>
               </p>
               <i class="vote-icon fa-solid fa-arrow-down fa-lg" id="downvote"></i>
          </div>
          <a class="layout-answer__action layout-answer__action--comment" href="../../view/student/question.php?id=<?php echo htmlspecialchars($answerLink) ?>">
               <i class="action--comment-icon fa-solid fa-comment"></i>
               <p>Comment</p>
          </a>
          <?php if ($_SESSION['userId'] == $userAns['user_id']) : ?>
               <a class="layout-answer__action layout-answer__action--edit" href="<?php echo htmlspecialchars("editQuestion.php?id=" . $questionInfo['question_id']); ?>">
                    <i class="action--edit-icon fa-solid fa-edit"></i>
                    <p>Edit</p>
               </a>
               <div class="layout-answer__action layout-answer__action--delete" onclick="confirmDeletion('<?php echo htmlspecialchars($questionInfo['question_id']); ?>')">
                    <i class="action--delete-icon fa-solid fa-trash-can"></i>
                    <p>Delete</p>
               </div>
          <?php endif; ?>
          <div class="layout-answer__action layout-answer__action--bookmark" data-bookmark-id="<?php echo htmlspecialchars($userAns['answer_id']); ?>">
               <i class="action--bookmark-icon fa-solid fa-bookmark"></i>
               <p>Bookmark</p>
          </div>
     </div>
</div>