<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Comment'), ['action' => 'edit', $comment->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Comment'), ['action' => 'delete', $comment->id], ['confirm' => __('Are you sure you want to delete # {0}?', $comment->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Comments'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Comment'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Posts'), ['controller' => 'Posts', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Post'), ['controller' => 'Posts', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="comments view large-9 medium-8 columns content">
    <h3><?= h($comment->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Post') ?></th>
            <td><?= $comment->has('post') ? $this->Html->link($comment->post->id, ['controller' => 'Posts', 'action' => 'view', $comment->post->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($comment->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Comment From') ?></th>
            <td><?= $this->Number->format($comment->comment_from) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($comment->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($comment->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Comment Content') ?></h4>
        <?= $this->Text->autoParagraph(h($comment->comment_content)); ?>
    </div>
</div>
