<?php 

class HomeModel extends MainModel{
    public function list($dateStart, $dateEnd){
        $sql="SELECT * FROM moviment";

		$retorno=$this->db->query($sql, null);
		While($item=$retorno->fetch(PDO::FETCH_ASSOC)){
			$resultado[]=$item;
		}
		return $resultado;
    }

    public function inp_out(){
        $sql = "SELECT DISTINCT date, (SELECT SUM(value) from moviment where date = m.date AND type='input') as input, (SELECT SUM(value) from moviment where date = m.date AND type='output') as output FROM moviment m;";
        $retorno=$this->db->query($sql, null);
		While($item=$retorno->fetch(PDO::FETCH_ASSOC)){
			$resultado[]=$item;
		}
		return $resultado;
    }

    public function cash_balance(){
        $sql = "SELECT sum(value) AS input FROM moviment WHERE type='input'";
        $result=$this->db->query($sql, null);
        $input=$result->fetch(PDO::FETCH_ASSOC);
        $sql = "SELECT sum(value) AS output FROM moviment WHERE type='output'";
        $result=$this->db->query($sql, null);
        $output=$result->fetch(PDO::FETCH_ASSOC);
        return $input['input']-$output['output'];
    }
}

?>