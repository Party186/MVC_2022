<?php

/**
 * MainModel - Modelo geral
 *
 * @package mvc.system.class
 * @since 0.1
 */
class MainModel
{
	/**
	 * $db
	 * O objeto da nossa conexão PDO
	 * @access public
	 */
	public $db;

	/**
	 * Construtor para essa classe
	 * @since 0.1
	 * @access public
	 */
	public function __construct(  ) {
		$this->db=new DataBase();
	}
	
	/**
	 * Inverte datas 
	 * Obtém a data e inverte seu valor.
	 * De: d-m-Y H:i:s para Y-m-d H:i:s ou vice-versa.
	 * @since 0.1
	 * @access public
	 * @param string $data A data
	 */
	public function inverte_data( $data = null ) {
		// Configura uma variável para receber a nova data
		$nova_data = null;
		// Se a data for enviada
		if ( $data ) {
			// Explode a data por -, /, : ou espaço
			$data = preg_split('/\-|\/|\s|:/', $data);
			// Remove os espaços do começo e do fim dos valores
			$data = array_map( 'trim', $data );
			// Cria a data invertida
			$nova_data .= chk_array( $data, 2 ) . '-';
			$nova_data .= chk_array( $data, 1 ) . '-';
			$nova_data .= chk_array( $data, 0 );
			// Configura a hora
			if ( chk_array( $data, 3 ) ) {
				$nova_data .= ' ' . chk_array( $data, 3 );
			}
			// Configura os minutos
			if ( chk_array( $data, 4 ) ) {
				$nova_data .= ':' . chk_array( $data, 4 );
			}
			// Configura os segundos
			if ( chk_array( $data, 5 ) ) {
				$nova_data .= ':' . chk_array( $data, 5 );
			}
		}
		// Retorna a nova data
		return $nova_data;
	} // inverte_data
} // MainModel