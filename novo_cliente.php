<<?php include "cabecalho.php"; ?>
<?php include "conexao.php"; ?>
<BR><BR>
<center><h1 class="text-white">Cadastrar Produtos</h1></center>
<br>

<?php 
if (isset($_POST["nome"]) && isset($_POST['descricao']) && isset($_POST['url']) && isset($_FILES['imagem'])) {
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $url = $_POST['url'];

    // Processar a imagem
    $imagem = $_FILES['imagem'];
    $imagemNome = $imagem['name'];
    $imagemTmp = $imagem['tmp_name'];
    $imagemError = $imagem['error'];

    if ($imagemError === 0) {
        $imagemDestino = 'uploads/' . $imagemNome;
        move_uploaded_file($imagemTmp, $imagemDestino);  // Move a imagem para o diretório de uploads

        // Inserir dados no banco de dados
        $query = "INSERT INTO produtos (nome, descricao, url, imagem) VALUES ('$nome', '$descricao', '$url', '$imagemNome')";
        $resultado = mysqli_query($conexao, $query);

        if ($resultado) {
            echo "<div class='alert alert-success'>Produto salvo com sucesso!</div>";
            header('Location: clientes.php');
            exit;
        } else {
            echo "<div class='alert alert-danger'>Erro ao salvar o produto: " . mysqli_error($conexao) . "</div>";
        }
    } else {
        echo "<div class='alert alert-danger'>Erro ao fazer upload da imagem.</div>";
    }
}   
?>
<style>
form {
    max-width: 300px;
    margin: auto;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
}
input, button {
    width: 100%;
    margin: 5px 0;
    padding: 8px;
    font-size: 14px;
}
</style>

<br><BR>
<form action="novo_cliente.php" method="post" enctype="multipart/form-data">
    <center><label class="text-white">Nome do Produto</label></center>
    <input class="form-control" name="nome" />
    <br>
    <center><label class="text-white">Descrição</label></center>
    <input class="form-control" name="descricao" />
    <br>
    <center><label class="text-white">URL</label></center>
    <input class="form-control" name="url" />
    <br>
    <center><label class="text-white">Imagem</label></center>
    <input type="file" class="form-control" name="imagem" />
    <br>
    <button type="submit" class="btn btn-secondary">
        Enviar dados
    </button>
</form>
<br>
<BR>
<BR>

<?php include "rodape.php"; ?>
