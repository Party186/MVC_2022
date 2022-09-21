<?php
/**
 * Verifica chaves de arrays
 *
 * Verifica se a chave existe no array e se ela tem algum valor.
 * Obs.: Essa função está no escopo global, pois, vamos precisar muito da mesma.
 *
 * @param array  $array O array
 * @param string $key   A chave do array
 * @return string|null  O valor da chave do array ou nulo
 */
function chk_array ( $array, $key ) {
	// Verifica se a chave existe no array
	if ( isset( $array[ $key ] ) && !empty( $array[ $key ] ) ) {
		// Retorna o valor da chave
		return $array[ $key ];
	}
	// Retorna nulo por padrão
	return null;
} // chk_array


/**
 * Função para carregar automaticamente todas as classes padrão
 * @see: https://www.php.net/manual/pt_BR/function.spl-autoload-register.php
 * As classes estão na pasta classes/.
 * O nome do arquivo deverá ser NomeDaClasse.php.
 * Exemplo: para a classe Main, o arquivo vai chamar Main.php
 */
spl_autoload_register(function($class_name) {
	$file = DIR_BASE . '/system/class/' . $class_name . '.php';
	if (!file_exists( $file ) ) {
		require_once DIR_TEMPLATE.'/404.php';
		return;
	}
	# Inclui o arquivo da classe
    require_once $file;
}); // __spl_autoload_register
