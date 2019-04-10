<?php
foreach ($skills as $skill) {
?>
<option
        value="<?= $skill['id'] ?>"
    <?php if (($skill['id'] == $model->skillid)||($skill['id']==$skillid)) echo ' selected' ?>
>
    <?=$skill['name'] ?>

</option>
<?php
}
?>