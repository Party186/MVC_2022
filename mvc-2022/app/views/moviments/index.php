<?php

$ano=date("Y");
$mes=date("m");

?>
<div id="header-moviment">
    <div class="input-group">
        <a class="btn btn-primary" href="<?php echo URL_BASE ?>?page=moviments&action=add"> Add </a>
    </div>
    <div class="input-group">
        <label class="input-group-text" for="inputGroupSelect01">Year</label>
        <select class="form-select" id="inputGroupSelect01">
            <?php  
                echo "<option value='$ano' selected>$ano</option>";
                $ano=$ano-1;
                echo "<option value='$ano' >$ano</option>";
                $ano=$ano-1;
                echo "<option value='$ano' >$ano</option>";
                $ano=$ano-1;
                echo "<option value='$ano' >$ano</option>";
            ?>
            
        </select>
    </div>
    <div class="input-group">
        <label class="input-group-text" for="inputGroupSelect01">Month</label>
        <select class="form-select" id="inputGroupSelect01">
            <?php  
                echo "<option value='$mes'>Mes Atual </option>";
            ?>

            <option value="1">Janeiro</option>
            <option value="2">Fevereiro</option>
            <option value="3">Março</option>
            <option value="4">Abril</option>
            <option value="5">Maio</option>
            <option value="6">Junho</option>
            <option value="7">Julho</option>
            <option value="8">Agosto</option>
            <option value="9">Setembro</option>
            <option value="10">Outubro</option>
            <option value="11">Novembro</option>
            <option value="12">Dezembro</option>
        </select>
    </div>
    <div class="input-group">
        <span class="input-group-text" id="basic-addon1">Cash balance</span>
        <input type="text" class="form-control" id="input-cash-balance" value="R$<?php echo $data['cash_balance']?>" disabled>
    </div>
</div>

<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Date</th>
      <th scope="col">Description</th>
      <th scope="col">Value</th>
      <th scope="col">Input</th>
      <th scope="col">Output</th>
    </tr>
  </thead>
  <tbody>
    <?php
    foreach($data['moviments'] AS $moviment){
        
        echo "<tr>
        <td>{$moviment['id']}</td>
        <td>{$moviment['date']}</td>
        <td>{$moviment['description']}</td>
        <td>{$moviment['value']}</td>";
        if($moviment['type']=="input"){
            echo "<td>*</td><td> - </td>";
        }else{
            echo "<td> - </td><td> * </td>";
        }
        echo "</tr>";
    }
    ?>
  </tbody>
<table> 