<?php

/**
 * home - Controller de exemplo
 * @author Cândido Farias
 * @package mvc
 * @since 0.1
 */
class ReportsController extends MainController
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
		$this->title = 'Reports';
		
		# Carrega os arquivos do view		
		$this->view->show('reports/index', null);
	
		
    } // index
	
} // class HomeController