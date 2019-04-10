<?php
$i=0;
foreach ($types as $type) {
    $i++;
?>
<option
        value="<?= $i ?>"
    <?php if ($i == $model->type) echo ' selected' ?>
>
    <?=$type ?>

</option>
<?php
}
?>