<?php
#Evita que usuários acesse este arquivo diretamente
if (!defined('DIR_BASE')) exit;
 
#Inicia a sessão
session_start();

#Verifica o modo debugar
if (!defined('DEBUG') || DEBUG === false ) {
	#Esconde todos os erros
	error_reporting(0);
	ini_set("display_errors", 0); 
	
} else {
	#Mostra todos os erros
	error_reporting(E_ALL);
	ini_set("display_errors", 1); 
}

#Funções globais
require_once DIR_BASE .'/system/functions/globalFunctions.php';

#Carrega a classe principal, responçavel por iniciar a aplicação.
new Main();

