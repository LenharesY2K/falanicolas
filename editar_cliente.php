<?php include "cabecalho.php"; include "conexao.php"; ?>

<?php 
if (isset($_POST["nome"]) && !empty($_POST["nome"]) &&
    isset($_POST["descricao"]) && !empty($_POST["descricao"]) &&
    isset($_POST["url"]) && !empty($_POST["url"])) {

    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $url = $_POST['url'];
    $id = $_GET['id']; 

    // Verificando se o usuário enviou uma nova imagem
    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] == 0) {
        $extensao = pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION);
        $nome_imagem = "produto_" . $id . "." . $extensao;
        $caminho_imagem = "uploads/" . $nome_imagem;

        // Move o arquivo para o diretório de uploads
        move_uploaded_file($_FILES['imagem']['tmp_name'], $caminho_imagem);
        
        // Atualiza a URL da imagem no banco de dados
        $sql = "UPDATE produtos SET 
                    nome = '$nome', 
                    descricao = '$descricao', 
                    url = '$url', 
                    imagem = '$caminho_imagem' 
                WHERE id = $id";
    } else {
        // Se não enviar uma nova imagem, apenas atualiza os dados sem modificar a imagem
        $sql = "UPDATE produtos SET 
                    nome = '$nome', 
                    descricao = '$descricao', 
                    url = '$url' 
                WHERE id = $id";
    }

    $resultado = $conexao->query($sql);
    if ($resultado) {
        header("location: clientes.php");
    } else {
        echo "<div class='alert alert-danger'>Erro ao salvar os dados</div>";
    }
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM produtos WHERE id = $id";
    $resultado = $conexao->query($sql);
    if ($row = $resultado->fetch_assoc()) {
        $nome = $row['nome'];
        $descricao = $row['descricao'];
        $url = $row['url'];
        $imagem = $row['imagem']; // Caminho da imagem atual
    }
}
?>

<!-- Estilo CSS para um design mais bonito -->
<style>
    body {
        background-color: #f5f5dc; /* Cor de fundo suave */
        font-family: 'Arial', sans-serif;
        color: #333;
    }

    .container {
        max-width: 600px;
        margin: 50px auto;
        background-color: #fff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    h1 {
        color: #8b4513; /* Cor marrom suave */
        font-size: 2rem;
        text-align: center;
        margin-bottom: 30px;
    }

    form {
        display: flex;
        flex-direction: column;
    }

    label {
        font-size: 1.1rem;
        margin-bottom: 8px;
        color: #555;
    }

    input {
        padding: 12px;
        margin: 10px 0 20px;
        font-size: 1rem;
        border-radius: 5px;
        border: 1px solid #ddd;
        transition: border-color 0.3s ease;
    }

    input:focus {
        border-color: #8b4513; /* Cor de borda no foco */
        outline: none;
    }

    button {
        padding: 12px;
        background-color: #8b4513; /* Cor de fundo do botão */
        color: white;
        border: none;
        border-radius: 5px;
        font-size: 1.1rem;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    button:hover {
        background-color: #6f3512; /* Cor de fundo ao passar o mouse */
    }

    .alert {
        background-color: #f8d7da;
        color: #721c24;
        padding: 10px;
        margin: 20px 0;
        border-radius: 5px;
        border: 1px solid #f5c6cb;
    }

    .image-preview {
        margin-top: 10px;
        max-width: 200px;
    }
</style>

<!-- Corpo do formulário -->
<div class="container">
    <h1>Editar Peça</h1>

    <form action="editar_cliente.php?id=<?php echo $_GET['id']; ?>" method="post" enctype="multipart/form-data">
        <label for="nome">Nome do Produto</label>
        <input class="form-control" value="<?php echo $nome ?? ''; ?>" name="nome" type="text" id="nome" required />

        <label for="descricao">Descrição</label>
        <input class="form-control" value="<?php echo $descricao ?? ''; ?>" name="descricao" type="text" id="descricao" required />

        <label for="url">URL</label>
        <input class="form-control" value="<?php echo $url ?? ''; ?>" name="url" type="url" id="url" required />

        <label for="imagem">Imagem do Produto</label>
        <input class="form-control" type="file" name="imagem" id="imagem" />
        
        <?php if (isset($imagem) && !empty($imagem)): ?>
            <div class="image-preview">
                <p>Imagem atual:</p>
                <img src="<?php echo $imagem; ?>" alt="Imagem do produto" style="max-width: 100%;"/>
            </div>
        <?php endif; ?>

        <button type="submit">Salvar</button>
    </form>
</div>

<?php include "rodape.php"; ?>
