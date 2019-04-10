<?php
foreach ($tasks as $task) {
?>
<option
        value="<?= $task['id'] ?>"
    <?php if (($task['id'] == $model->taskid)||($task['id']==$taskid)) echo ' selected' ?>
>
    <?=$task['text'] ?>

</option>
<?php
}
?>