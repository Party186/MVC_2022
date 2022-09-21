<?php

/**
 * UserController - Controller de usuários
 * @author Cândido Farias
 * @package mvc
 * @since 0.1
 */
class UsersController extends MainController
{
	public function __construct(){
		parent::__construct();
	}

	/**
	 * Carrega a página "/views/user/index.php"
	 * @author Cândido Farias
	 */
    public function index() {
		// Título da página
		$this->title = 'User';

		# Carrega os arquivos do view		
		$this->view->show('user/index', null);
	} // index
	
	

    /**
	 * Carrega a página "/views/user/login.php"
	 * @author Cândido Farias
	 */
    public function login() {
		// Título da página
		$this->title = 'Login';
		/** Carrega os arquivos do view **/
		require VIEW . '/user/login.php';
	} // login


    /**
	 * Encerra a sessão do usuário
	 * @author Cândido Farias
	 */
    public function logout() {
		$this->unsetUser();
		$msg['class']="success";
		$msg['msg']="By";
		$_SESSION['msg'][]=$msg;
		header("Refresh: 2; url =".URL_BASE);
    } // logout

    /**
	 * Autentica o usuario"
	 * @author Cândido Farias
	 */
    public function auth() {
		
		if(isset($_POST['user']['send_login'])){
			
			$userModel=$this->load_model("user");
			$cols[]='id';
			$cols[]='name';
			$cols[]='email';

			$where['email']=$_POST['user']['email'];
			$where['password']=md5($_POST['user']['password']);
			
			$user=$userModel->select($cols,$where);
			
			if($user){
				$this->setUser($user[0]);
				$msg['class']="success";
				$msg['msg']="Login realizado com sucesso!";
			}else{
				$msg['class']="danger";
				$msg['msg']="Falha ao realizar login!";
			}
			$_SESSION['msg'][]=$msg;
			
		}
		header("Refresh: 2; url =".URL_BASE);
	} // autenticar
} // class UserController