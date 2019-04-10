
<?php
    if (($model->type ==1)||($model->type ==2))
    { ?>

<div id="w1" class="grid-view"><table class="table table-striped table-bordered"><tbody>
    <?php
    $i=0;
    foreach ($answers as $answer) {
        $i++;
     ?> <tr>
            <td><?= $i ?></td>
            <td>
            <span
                <?php if ($answer['correct']==1) echo ' class="correct_answer"'; else echo ' class="wrong_answer"' ?>
            >
                <?= $answer['text'] ?>

            </span>
            </td>
        </tr>
        <?php
    }
    ?>
</tbody></table></div>
<?php
} elseif ($model->type ==3) {
?>
<div id="w1" class="grid-view"><table class="table table-striped table-bordered"><tbody>
        <?php

        function cmp($a, $b)
        {
            return strcmp($a["correct"], $b["correct"]);
        }

        usort($answers, "cmp");

        while (list($key, $value) = each($answers)) {

            ?> <tr>
                <td>
                    <span>
                        <?= $value['correct'] ?>

                    </span>
                </td>
                <td>
                    <span>
                        <?= $value['text'] ?>

                    </span>
                </td>
            </tr>
            <?php
        }
        ?>
        </tbody></table></div>

<?php
} elseif ($model->type ==4) {
?>
        <div id="w1" class="grid-view"><table class="table table-striped table-bordered"><tbody>
                <?php

                       foreach ($answers as $answer){
                            if (iconv_strlen ($answer->correct) === 3){
//                                $modif_answers[$y]=
                                $modif_answers[strval($answer->correct)[2]][2]=$answer;


//                                $modif_answers[2][]=$answer;
                            } else {
                                $modif_answers[$answer['correct']][1]=$answer;

//                                $modif_answers[1][]=$answer;
                            }
                        }



                $i=0;
                foreach ($modif_answers as $answer) {
                    $i++;
                    ?>
                    <tr>
                        <td><?= $i ?></td>
                        <td>
                            <span>
                                <?= $answer[1]['text'] ?>
                            </span>
                        </td>
                        <td>
                            <?= $answer[2]['text'] ?>

                        </td>
                    </tr>
                    <?php
                }
                ?>
                </tbody></table></div>

<?php
} else {
        echo 'Ничего не найдено';
    }
?>





