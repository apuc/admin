<?php
$this->title = 'Заявки';
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="request-default-index">
    <h1>Заявки</h1>
    <table class="table table-bordered">
        <?php
        echo '<tr>';

        echo '<th>Телефон</th>';
        echo '<th>Дата заявки</th>';
        echo '</tr>';
        foreach($request as $r){
            echo '<tr>';
            echo '<td>'.$r->telephone.'</td>';
            echo '<td>'.date('Y.m.d G:i:s',$r->dt_add).'</td>';
            //echo '<td>'.date('H:m:s \m \i\s\ \m\o\n\t\h',$r->dt_add).'</td>';
            echo '</tr>';

        }
        ?>
    </table>
</div>
