<?php
foreach ($cases as $case) {
?>
<option
        value="<?= $case['id'] ?>"
    <?php if (($case['id'] == $model->caseid)||($case['id']==$caseid)) echo ' selected' ?>
>
    <?=$case['name'] ?>

</option>
<?php
}
?>