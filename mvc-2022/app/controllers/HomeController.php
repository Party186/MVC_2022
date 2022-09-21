<?php

/**
 * home - Controller de exemplo
 * @author Cândido Farias
 * @package mvc
 * @since 0.1
 */
class HomeController extends MainController
{

	public function __construct(){
		parent::__construct();
		if(!isset($_SESSION['user'])){
			header("Location:".URL_BASE."users/login");
		}
	}

	/**
	 * Carrega a página "/views/home/index.php"
	 */
    public function index() {
		# Título da página
		$this->title = 'Home';
		
		# Carrega os arquivos do view		
		$this->list();
	
		
    } // index
	
	/**
	 * Método list, responsável por buscar a lista de movimentos de determinado periodo
	 * URL: dominio.com/home/list
	 * @access public
	 *  */ 
	public function list($dateStart=null, $dateEnd=null) {
		#Instanciar um objeto da classe HomeModel 
		$model=$this->load_model("Home");
		//var_dump($model);
		# busca a lista de movimento para o periodo
		$listMoviments=$model->list($dateStart, $dateEnd);
		$data['moviments']=$listMoviments;
		$cash_balance=$model->cash_balance();
		$data['cash_balance']=$cash_balance;
		$inp_out=$model->inp_out();
		$data['inp_out']=$inp_out;
		
		//print_r($data);
		/** Carrega os arquivos do view **/
		$this->view->show("home\home", $data);
		
		
	}
} // class HomeController