<?php

/**
 * DataBase- Classe para gerenciamento da base de dados
  * @package mvc.classes
 * @since 0.1
 */
class DataBase
{
	/**
	 * $pdo
	 * Receberá o objeto PDO.
	 * @access private
	 */
	private $pdo;
	
	/**
	 * Construtor da classe
	 * @since 0.1
	 * @access public
	 */
	public function __construct() {
		//Obtem intancia PDO
		$this->pdo=Conexao::getInstance();
	} // __construct
	
	
	
	/**
	 * query - Consulta PDO
	  * @since 0.1
	 * @access public
	 * @param $sql String  Consulta a ser executada no banco de dados
	 * @param $data_array Array  Lista de valores a serem vinculados a consulta.
	 * @return object|bool Retorna a consulta ou falso
	 */
	public function query( $sql, $data_array = null ) {
		
		// Prepara para executar a query
		/*
		$stmt = $this->pdo->prepare("INSERT INTO contato (nome, email) VALUES (?, ?)");
		Este método transforma uma declaração SQL na forma de um “objeto declaração” 
		que pode ser manipulado por alguns métodos específicos.
		Entre estes métodos, o bindParam() que vincula uma variável a um espaço demarcado na declaração.
		Ex: $stmt->bindParam(1, $nome);
			$stmt->bindParam(2, $email);
			*/
		$stmt= $this->pdo->prepare($sql); 
		/* Se Houver valores a serem vinculados */
		if($data_array){
			/**Executar a query com os valores viculados */
			$check_exec = $stmt->execute($data_array);
		}else{
			/*Executa a query */
			$check_exec = $stmt->execute();
		}
		// Verifica se a consulta aconteceu
		if ( $check_exec ) {
			/*Retorna objeto com o conteúdo da consulta */
			return $stmt;
		} else {
		 	// Configura o erro
			$error       = $query->errorInfo();
			/**Registra o erro */
			$this->error = $error[2];
			// Retorna falso
			return false;
		}
	}

	/**
	 * insert - Insere valores
	 * Insere os valores e tenta retornar o último id enviado
	 * @since 0.1
	 * @access public
	 * @param string $table O nome da tabela
	 * @param array ... Ilimitado número de arrays com chaves e valores
	 * @return object|bool Retorna a consulta ou falso
	 */
	public function insert($table, $data ) {
		// Configura o array de colunas
		$cols = array();
		// Configura o valor inicial do modelo
		$place_holders = '(';
		// Configura o array de valores
		$values = array();
		// O $j  assegura que colunas serão configuradas apenas uma vez
		$j = 0;
		// É preciso enviar pelo menos um array de chaves e valores
		if(!isset( $data[0] ) || !is_array($data[0]) ) {
			//conteúdo inválido
			return;
		}
		// Faz um laço nos argumentos
		for ( $i=0; $i < count($data); $i++ ) {
			// Obtém as chaves como colunas e valores como valores
			foreach ($data[$i] as $col=>$val) {
				// A primeira volta do laço configura as colunas
				if ( $i === 0 ) {
					$cols[] = "$col";
				}
				if ( $j <> $i ) {
					// Configura os divisores
					$place_holders .= '), (';
				}
				// Configura os place holders do PDO
				$place_holders .= '?, ';
				// Configura os valores a serem enviados
				$values[] = $val;
				$j = $i;
			}
			// Remove os caracteres extra dos place holders
			$place_holders = substr( $place_holders, 0, strlen( $place_holders ) - 2 );
		}
		// Separa as colunas por vírgula
		$cols = implode(', ', $cols);
		// Cria a declaração para enviar ao PDO
		$stmt = "INSERT INTO $table ( $cols ) VALUES $place_holders) ";
		/**INSERT INTO usuario (nome,email,senha) VALUES (?,?,?) */
		// Insere os valores
		$insert = $this->query( $stmt, $values );
		// Verifica se a consulta foi realizada com sucesso
		if ( $insert ) {
			// Verifica se temos o último ID enviado
			if ( method_exists( $this->pdo, 'lastInsertId' ) 
				&& $this->pdo->lastInsertId() 
			) {
				// Configura o último ID
				$this->last_id = $this->pdo->lastInsertId();
			}
			// Retorna a consulta
			return $insert;
		}
		// The end :)
		return;
	} // insert
	
	/**
	 * Update simples
	 * Atualiza uma linha da tabela baseada em um campo
	 * @since 0.1
	 * @access protected
	 * @param string $table Nome da tabela
	 * @param string $where_field WHERE $where_field = $where_field_value
	 * @param string $where_field_value WHERE $where_field = $where_field_value
	 * @param array $values Um array com os novos valores
	 * @return object|bool Retorna a consulta ou falso
	 */
	public function update( $table, $where_field, $where_field_value, $values ) {
		// Você tem que enviar todos os parâmetros
		if ( empty($table) || empty($where_field) || empty($where_field_value)  ) {
			return;
		}
		
		// Começa a declaração
		$stmt = " UPDATE $table SET ";
		
		// Configura o array de valores
		$set = array();
		
		// Configura a declaração do WHERE campo=valor
		$where = " WHERE $where_field = ? ";
		
		// Você precisa enviar um array com valores
		if ( !is_array( $values ) ) {
			return;
		}
		
		// Configura as colunas a atualizar
		foreach ( $values as $column => $value ) {
			$set[] = " $column = ?";
		}
		
		// Separa as colunas por vírgula
		$set = implode(', ', $set);
		
		// Concatena a declaração
		$stmt .= $set . $where;
		
		// Configura o valor do campo que vamos buscar
		$values[] = $where_field_value;
		
		// Garante apenas números nas chaves do array
		$values = array_values($values);
				
		// Atualiza
		$update = $this->query( $stmt, $values );
		
		// Verifica se a consulta está OK
		if ( $update ) {
			// Retorna a consulta
			return $update;
		}
		
		// The end :)
		return;
	} // update

	/**
	 * Delete
	 * Deleta uma linha da tabela
	 * @since 0.1
	 * @access protected
	 * @param string $table Nome da tabela
	 * @param string $where_field WHERE $where_field = $where_field_value
	 * @param string $where_field_value WHERE $where_field = $where_field_value
	 * @return object|bool Retorna a consulta ou falso
	 */
	public function delete( $table, $where_field, $where_field_value ) {
		// É necessário enviar todos os parâmetros
		if ( empty($table) || empty($where_field) || empty($where_field_value)  ) {
			return;
		}
		// Inicia a declaração
		$stmt = " DELETE FROM $table ";
		// Configura a declaração WHERE campo=valor
		$where = " WHERE $where_field = ? ";
		// Concatena tudo
		$stmt .= $where;
		// O valor que vamos buscar para apagar
		$values = array( $where_field_value );
		// Apaga
		$delete = $this->query( $stmt, $values );
		// Verifica se a consulta está OK
		if ( $delete ) {
			// Retorna a consulta
			return $delete;
		}
		// The end :)
		return;
	} // delete
	
	/**
	 * SELECT
	 * Lista registros da tabela
	 * @since 0.1
	 * @access protected
	 * @param string $table Nome da tabela
	 * @param array $cols lista de colunas
	 * @param array $where lista de chaves e valor para definir as condições da consulta
	 * @return Array Retorna a lista de registros
	 */
	public function select($table,$cols=null, $where=null){
		if($cols){
			$sql="SELECT ";
			var_dump($cols);
			foreach($cols as $col){
				$sql.=$col."," ;
			}
			//Remove aultima virgula
			$sql=substr($sql,0,-1);
			$sql.=" FROM ".$table;
		}else{
			$sql="SELECT * FROM ".$table;
		}
		if($where){
			$sql.=" where ";
			$num_cols=1;
			foreach($where as $col=>$val){
				if($num_cols>1){
					$sql.=" AND ";
				}
				$sql.=$col."='".$val."' ";
				$num_cols++;
			}
			if($num_cols>2)
				$sql=rtrim($sql,'AND');
		}
		$return=$this->query($sql, null);
		if($return->rowCount() > 0){
			$result=null;
			// Retorna a consulta
			While($item=$return->fetch(PDO::FETCH_ASSOC)){
				$result[]=$item;
			}
			return $result;
		}
		return null;
	}//select
	
} // Class DataBase