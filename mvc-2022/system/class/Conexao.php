<?php

/**
 * Conexão - Classe Conexão
 * @author Cândido Farias
 * @package mvc.system.class
 * @since 0.1
 */
class Conexao {
    /**
	 * $instance
	 * Receberá uma instancia do Objeto PDO com a conexão com o banco de dados.
	 * @access private
	 */
	public static $instance;
    
    /**
	 * Construtor da classe
	 * @since 0.1
	 * @access public
	 */
    private function __construct() {
     
    }  

    /**
	 * getInstance() - Obtem uma instancia da conexão com o banco de dados
	* @since 0.1
	* @access public
	* @return object|PDO Retorna objeto PDO com a conexao do banco de dados
	*/
    public static function getInstance() {
        if (!isset(self::$instance)) {
            self::$instance = new PDO('mysql:host='.HOSTNAME.';
                port='.PORT.';
                dbname='.DB_NAME,
                DB_USER, 
                DB_PASSWORD
            );

            self::$instance->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            self::$instance->setAttribute(PDO::ATTR_ORACLE_NULLS,PDO::NULL_EMPTY_STRING);
        
        }
        
        return self::$instance;
    }
}

?>