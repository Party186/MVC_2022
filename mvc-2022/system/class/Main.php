<?php


/**
 * Main - Classe principal
 * Carrega a classe controller equivalente ao caminho definido pelo usuário.
 * @package mvc.system.class
 * @since 0.1
 */
class Main
{

	/**
	 * $controller
	 * Receberá o valor do controller (Vindo da URL).
	 * exemplo.com/controller/
	 * @access private
	 */
	private $controller;
	
	/**
	 * $action
	 * Receberá o valor da ação (Também vem da URL):
	 * exemplo.com/controller/action
	 * @access private
	 */
	private $action;
	
	/**
	 * $params
	 * Receberá um array com parâmetros (Também vem da URL):
	 * exemplo.com/controller/action/param1/param2/.../paramN
	 * @access private
	 */
	private $params=null;
	
	/**
	 * $not_found
	 * Caminho da página não encontrada
	 * @access private
	 */
	private $not_found = '/app/views/includes/404.php';
	
	/**
	 * Construtor da classe
	 * Obtém os valores do controller, ação e parâmetros. Configura 
	 * o controller e a action (método).
	 */
	public function __construct () {
		# Chama o método get_url)data, para obter os dados da url.
		$this->get_url_data();
		
		#Verifica se o controller existe. Caso contrário, adiciona o
		#controller padrão (controllers/homeController.php) e chama o método index().
		if (!$this->controller ) {
			#Adiciona o controller padrão
			require_once DIR_BASE . '/app/controllers/HomeController.php';
			#Cria o objeto do controller "homeController.php" (classe HomeController)
			$this->controller = new HomeController();
			#Executa o método index()
			$this->controller->index();
			#fim
			return; 
		}#cnotroller

		#Tranforma a primeira letra do nome do controller em maiusculo.
		$this->controller=ucfirst($this->controller);
		
		#Se o arquivo do controller não existir?
		if ( !file_exists( DIR_BASE . '/app/controllers/' . $this->controller . '.php' ) ) {
			
			# exibe página não encontrada
			require_once DIR_BASE . $this->not_found;
			#fim
			return;
		}#file_exists

				
		#Inclui o arquivo do controller
		require_once DIR_BASE . '/app/controllers/' . $this->controller . '.php';
		#Se a classe do controller indicado não existir?
		if ( !class_exists( $this->controller ) ) {
			#Exibe página não encontrada
			require_once DIR_BASE . $this->not_found;
			#fim
			return;
		}#class_exists
		
		
		#Cria o objeto da classe do controller
		$this->controller = new $this->controller();
		
		#Se o método indicado existir, executa o método e envia os parâmetros
		if ( method_exists( $this->controller, $this->action ) ) {
			#verifica a quantidades de parametros
			if(count($this->params)==0)
				#Chama o metodo/ação sem parametros */
				$this->controller->{$this->action}();
			else if(count($this->params)==1)
				#Chama o metodo/ação com um  parametro */
			   	$this->controller->{$this->action}( $this->params[0] );
			else if(count($this->params)==2)
				#Chama o metodo/ação com dois parametros */
			    $this->controller->{$this->action}($this->params[0],$this->params[1], $this->params[2] );
			else if(count($this->params)==3)
				#Chama o metodo/ação com três parametros */
			    $this->controller->{$this->action}($this->params[0],$this->params[1], $this->params[2]);
			#fim
			return;
		}#method_exists

		#Sem ação, chamamos o método index
		if ( !$this->action && method_exists( $this->controller, 'index' ) ) {
			#chama o método index
			$this->controller->index();		
			#fim
			return;
		}# !$this->action 

		#Página não encontrada
		require_once DIR_BASE . $this->not_found;
		#fim
		return;
	} # __construct
	
	/**
	 * Obtém parâmetros de $_GET['path']
	 * Obtém os parâmetros de $_GET['path'] e configura as propriedades 
	 * $this->controller, $this->action e $this->params
	 * A URL deverá ter o seguinte formato:
	 * http://www.example.com/controller/action/parametro1/parametro2/.../parametroN
	 */
	public function get_url_data () {
		
		#Verifica se o parâmetro path foi enviado
		if (isset( $_GET['path'] ) ) {
			#Captura o valor de $_GET['path']
			$path = $_GET['path'];
			#Limpa os dados
			$path = rtrim($path, '/');
			#Cria um array de parâmetros
			$path = explode('/', $path);
			# [0]exemplo
			#Configura o controller
			#Extrai o primeiro valor do array para atribuir ao controller
			$this->controller  = chk_array( $path, 0 );
			#Acrecenta sufixo 'Controller' para formar o nome da classe
			$this->controller .= 'Controller'; #Controller -> exemploController
			#Configura a ação do controller
			#Extrai o segundo valor do array para atribuir a ação a ser executada pelo controller
			$this->action = chk_array( $path, 1 );
			#Configura os parâmetros recebidos
			if ( chk_array( $path, 2 ) ) {
				unset( $path[0] );
				unset( $path[1] );
				#Os parâmetros sempre virão após a ação
				$this->params = array_values( $path );
			}else{
				#Nenhum parametro
				$this->params=[];
			}
		}
	}#get_url_data
	
}