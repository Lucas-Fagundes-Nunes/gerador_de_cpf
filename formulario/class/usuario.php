<?php
class Cadastros
{

    private $pdo; # Informa que a váriavel $pdo é privada, podendo ser chamada apenas dentro da class
    public $msgErro; # Mensagem de errro é publica, podendo ser apresentada fora da class


public function conectar($dbname, $host, $usuario, $senha) # fução que vai pegar as váriaveis do db 
{
    global $pdo; 
    
    $pdo = new PDO('mysql:dbname='.$dbname.';host='.$host, $usuario, $senha); # PDO faz a conexão ao banco

    try # try serve para validar a coneção com o banco, caso não valide, vai pro catch e apresenta uma mensagem
    {
    }catch(PDOException $e)
    {
        $msgErro = $e->getMessage();
    }

}


public function cadastrar($nome, $email, $senha) # Verificado os 3 campos, é colocado aqui para ser cadastrado
{
    global $pdo;
		$sql = $pdo->prepare('SELECT id FROM usuarios WHERE email = :e'); # Aqui vai realizar o SELECT no banco 
                                                                        # validando se não tem campos iguais
		$sql->bindValue(':e', $email); # Pega a váriavel que foi enviada na funcition e insere no sql
		$sql->execute(); # Executa o comando

		if($sql->rowCount() > 0) # Se $sql tiver dados, return false para não cadastrar pois já tem registro
		{
			return false;
		}else # se não tiver registro insere...
		{
			$sql = $pdo->prepare('INSERT INTO usuarios(nome, email, senha) VALUES (:n, :e, :s)');
            # ...Insere no banco de dados
                   $sql->bindValue(':n', $nome); # bindValue sempre terá o mesmo sentido, pegar o valor da função e
                   $sql->bindValue(':e', $email); # trocar pela letra desejada no insert ou select...ex:( :n por $nome )
                   $sql->bindValue(':s', md5($senha)); # md5 serve para proteger a senha, ela criptografa trazendo um número grande. 
                   $sql->execute(); # Sempre mesmo processo, executa a função a cima.
			return true; # Retorna true para dizer que foi registrado 
        }
}


public function logar($email, $senha)
    {
        global $pdo;

        $sql = $pdo->prepare('SELECT id FROM usuarios WHERE email = :e AND senha = md5(:s) AND inativo IS NULL');
        $sql->bindValue(':e', $email);
        $sql->bindValue(':s', $senha);
        $sql->execute();
        if($sql->rowCount() > 0)
        {
            $dado = $sql->fetch();
            session_start();
            $_SESSION['id'] = $dado['id'];
            return true;
        }else
        {
           return false; 
        }
    }



}
?>