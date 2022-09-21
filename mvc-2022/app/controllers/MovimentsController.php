 <?php
/**
 * Movimento - Controller responsavel pelos moviemntos do livro caixa.
 * @author Cândido Farias
 * @package mvc.controller
 * @since 0.1
 */
class MovimentsController extends MainController
{

	public function __construct(){
		parent::__construct();
		if(!isset($_SESSION['user'])){
			header("Location:".URL_BASE."users/login");
		}
	}

	/**
	* URL: dominio.com/exemplo/
	*  */ 
	public function index() {
		
		$this->title="Moviment";
		
		$this->list();
		
		
	}
	
	/**
	 * Método list, responsável por buscar a lista de movimentos de determinado periodo
	 * URL: dominio.com/moviments/list
	 * @access public
	 *  */ 
	public function list($dateStart=null, $dateEnd=null) {
		#Instanciar um objeto da classe MovimentModel 
		$model=$this->load_model("Moviments");
		//var_dump($model);
		# busca a lista de movimento para o periodo
		$listMoviments=$model->list($dateStart, $dateEnd);
		$data['moviments']=$listMoviments;
		$cash_balance=$model->cash_balance();
		$data['cash_balance']=$cash_balance;
		
		//print_r($data);
		/** Carrega os arquivos do view **/
		$this->view->show("moviments\index", $data);
		
		
	}
	

	public function select($id=null){
		$model=$this->load_model("exemplo");
		$dadosExemplo=$model->select($id);
		/** Carrega os arquivos do view **/
		require PATH . '/views/includes/header.php';
       	require PATH . '/views/includes/menu.php';
		require_once PATH . '/views/exemplo/index.php';
		require PATH . '/views/includes/footer.php';
	}
	
	public function insert(){
		require PATH . '/views/includes/header.php';
       	require PATH . '/views/includes/menu.php';
		$exemplo=$this->load_model("exemplo");
		if($result=$exemplo->insert()){
			echo "Registro Realizado!";
		}else{
			echo "Falha ao realizar o registro";
		}
		require PATH . '/views/includes/footer.php';
	}

	
}