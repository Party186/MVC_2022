<?php

class MovimentsModel extends MainModel{ 

    public function list($dateStart, $dateEnd){
        $sql="SELECT * FROM moviment";

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

    public function select($id=null){
		if($id){
			$where['id']=$id;
		}else{
			$where=null;
        }
        return $this->db->select("aluno", null, $where);
    }
    

    public function insert($moviment){
        $array[]=$moviment;
        return $resultado=$this->db->insert("moviment",$array);
    }

    /**
     * 
     */
    public function update($moviment){
        return $this->db->update("moviment","id_moviment",$moviment['id_moviment'], $moviment);
    }

    /**
     * 
     */
    public function delete($id){
        return $this->db->delete("moviment","id_moviment",$id);
    }



}