<?php

/**
 * Classe View
 * Classe responsável por exibir o conteúdo pra p usuário
 */
class View{
    /**
     * $template
     * @package mvc.system.class
     * @access private
     */
    private $template;
    
    /**
     * $user
     * Mantém informações do usuário corrente
     * @access private
     */
    private $user=null;

    /**
     * Método construtor
     */
    public function __construct(){
        
    }
    /**
     * $setTemplate()
     * Define o template corrente
     * @access public
     * @param String
     */
    public function setTemplate($template){
        $this->template=$template;
    }

    /**
     * $settemplate()
     * Define o usuário corrente
     * @access public
     * @param Object
     */
    public function setUser($user){
        $this->user=$user;
    }

    /**
     * $getUser()
     * Pega o usuário corrente
     * @access public
     * @return Object
     */
    public function getUser(){
        return $this->user;
    }

    /**
     * $show()
     * Exibe o conteúdo ao usuário
     * @access public
     * @param String
     * @param Array
     */
    public function show($content,$data){
        
        if(empty($this->template)){
           $this->template='default'; 
        }
      
        include DIR_TEMPLATE."/index.php";

    }



}
