<?php 
if (!empty($_GET['id']) && isset($_GET['id'])) {
    
    include 'conexao.php';
    $sql = "DELETE FROM produtos WHERE id = $_GET[id]";
    $resultado = $conexao->query($sql);
    
    if ($resultado) {
        header('location: clientes.php');
    } else {
        header('location: clientes.php?Erro=Erro ao excluir');
    }
} else {
    header('location: clientes.php');
}
?>
