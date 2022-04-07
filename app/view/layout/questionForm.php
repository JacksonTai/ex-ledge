<?php
$question = new \Controller\Question();
$questionInfo = isset($_GET['id']) ? $question->read($_GET['id'])[0] : null;
?>
<div class="panel dialog">
     <form class="question__form" method="POST">
          <input type="hidden" name="userId" value="<?php echo htmlspecialchars($_SESSION['userId']) ?>">
          <input type="hidden" name="questionId" value="<?php echo htmlspecialchars($questionInfo ? $questionInfo['question_id'] : ''); ?>">
          <input type="hidden" name="action" value="<?php echo strpos($_SERVER['REQUEST_URI'], 'askQuestion') ? 'create' : 'update'; ?>">
          <div class="section title">
               <p class="input-header">Title</p>
               <p class="askquestion__err-msg--title invalid-input"></p>
               <input class="input-box question" type="text" id="title" name="title" value="<?php echo htmlspecialchars($questionInfo ? $questionInfo['title'] : ''); ?>" placeholder="e.g. How to solve question ..." maxlength="100">
          </div>
          <div class="section body">
               <p class="input-header">Content</p>
               <p class="askquestion__err-msg--content invalid-input"></p>
               <textarea class="input-box content" id="content" name="content" placeholder="Description of the question ..." maxlength="10000"><?php echo htmlspecialchars($questionInfo ? $questionInfo['content'] : ''); ?></textarea>
          </div>
          <div class="section tag">
               <p class="input-header">Tags</p>
               <p class="askquestion__err-msg--tag invalid-input"></p>
               <input class="input-box" type="text" id="tag" name="tag" value="<?php echo htmlspecialchars($questionInfo ? $questionInfo['tag'] : ''); ?>" placeholder="e.g. Physics, Mathematics, Science, ...">
          </div>
          <div class="btn-container">
               <?php if (strpos($_SERVER['REQUEST_URI'], 'askQuestion')) : ?>
                    <button class="post_question_btn" type="submit">Post Question</button>
               <?php elseif (strpos($_SERVER['REQUEST_URI'], 'editQuestion')) : ?>
                    <button class="post_question_btn" type="submit">Edit Question</button>
               <?php endif; ?>
          </div>
     </form>
</div>