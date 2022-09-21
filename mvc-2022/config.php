<?php
/**
 * Configuração geral
 */

# Caminho para a raiz
define( 'DIR_BASE', dirname( __FILE__ ) );

# Caminho para a pasta de uploads
define( 'UP_DIR_BASE', DIR_BASE . '/app/uploads' );

# URL da home
define( 'URL_BASE', 'http://localhost/MVC-2022/' );


# Caminho para a view
define( 'VIEW',DIR_BASE.'/app/views/'  );

/**INFORMAÇÃO REFERENTE AO TEMA A SER UTILIZADO */
#Pasta contendo os temas
define("DIR_TEMPLATES", DIR_BASE."/public/templates/");
#define o TEMPLATE
define('TEMPLATE','default');
#define a pasta do template
define('DIR_TEMPLATE',DIR_TEMPLATES.TEMPLATE);
# URL do tema
define( 'URL_TEMPLATE', URL_BASE.'public/templates/'.TEMPLATE."/" );



/**INFORMAÇÕES PARA CONEXAO COM O BANCO DE DADOS */
# Nome do host da base de dados
define( 'HOSTNAME', '' );

# Porta de host
define( 'PORT', '33' );

# Nome do DB
define( 'DB_NAME', 'cash_book' );

# Usuário do DB
define( 'DB_USER', 'root' );

# Senha do DB
define( 'DB_PASSWORD', '' );

# Charset da conexão PDO
define( 'DB_CHARSET', 'utf8' );

/*-------------------------*/
# Se você estiver desenvolvendo, modifique o valor para true
define( 'DEBUG', true );


?>