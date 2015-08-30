<?php
    $this->title = 'Заказы';
    $this->params['breadcrumbs'][] = $this->title;
?>
<div class="ord-default-index">
    <h1>Заказы</h1>
    <table class="table table-bordered">
    <?php
    echo '<tr>';
        echo '<th>Номер заказа</th>';
        echo '<th>Название</th>';
        echo '<th>Код материала</th>';
        echo '<th>Телефон</th>';
        echo '<th>Дата заказа</th>';
    echo '</tr>';
        foreach($orders as $v){
            echo '<tr>';
                echo '<td>'.$v->id.'</td>';
                echo '<td>'.$v->blind.'</td>';
                echo '<td>'.$v->materials.'</td>';
                echo '<td>'.$v->telephone.'</td>';
                echo '<td>'.date('Y.m.d',$v->dt_add).'</td>';
            echo '</tr>';

        }
    ?>
    </table>
</div>
