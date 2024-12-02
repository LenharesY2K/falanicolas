<?php include "cabecalho.php"; ?>
<style>
    body {
        background-color: #f5f5dc; /* Cor de fundo bege claro */
        font-family: 'Arial', sans-serif;
        color: #333;
    }

    /* Estilo do card (caixa principal) */
    .card {
        background-color: #f5f5dc; /* Cor de fundo suave */
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Sombra suave */
    }

    /* Estilo do cabeçalho do card */
    .card-header {
        background-color: #4682B4; /* Cor azul escuro */
        color: white;
        padding: 15px;
        font-size: 1.25rem;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
    }

    /* Estilo do corpo do card */
    .card-body {
        background-color: #f5f5dc;
        padding: 20px;
    }

    /* Estilo da tabela */
    table {
        width: 100%;
        margin-top: 20px;
        border-collapse: collapse;
    }

    /* Estilo do cabeçalho da tabela */
    thead {
        background-color: #8b4513; /* Cor marrom escuro */
        color: white;
    }

    /* Estilo das células da tabela */
    table td, table th {
        padding: 15px;
        text-align: center;
        border: 1px solid #ddd;
    }

    tbody tr:nth-child(even) {
        background-color: #fafad2; /* Cor de fundo suave para linhas alternadas */
    }

    tbody tr:hover {
        background-color: #f0e68c; /* Amarelo suave ao passar o mouse */
    }

    .btn-secondary {
        background-color: #8b4513; /* Cor marrom escuro */
        border: none;
        color: white;
        padding: 10px 20px;
        border-radius: 5px;
    }

    .btn-secondary:hover {
        background-color: #6a3c1a; /* Cor mais escura ao passar o mouse */
    }

    /* Ajuste para a responsividade da tabela */
    .table-responsive {
        max-width: 100%;
        overflow-x: auto;
    }

    /* Formulário de cadastro */
    .form-control {
        width: 100%;
        padding: 10px;
        margin-bottom: 10px;
        border-radius: 5px;
        border: 1px solid #ddd;
    }
</style>

<div class="card border-0 shadow-sm mb-4" style="background-color: #f5f5dc;">
    <div class="card-header text-white">
        <center><h4 class="m-0">Cadastrar Peça de Museu</h4></center>
    </div>
    <div class="card-body" style="background-color: #f5f5dc;">
        <form action="index.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="nome" class="text-white">Nome do Produto</label>
                <input type="text" class="form-control" name="nome" required />
            </div>
            <div class="form-group">
                <label for="descricao" class="text-white">Descrição</label>
                <textarea class="form-control" name="descricao" required></textarea>
            </div>
            <div class="form-group">
                <label for="url" class="text-white">URL</label>
                <input type="url" class="form-control" name="url" required />
            </div>
            <div class="form-group">
                <label for="imagem" class="text-white">Imagem</label>
                <input type="file" class="form-control" name="imagem" required />
            </div>
            <button type="submit" class="btn btn-secondary">Cadastrar Produto</button>
        </form>
    </div>
</div>

<?php
include "conexao.php";

// Cadastro de novo produto
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['imagem'])) {
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $url = $_POST['url'];

    // Carregar imagem
    $imagem_nome = $_FILES['imagem']['name'];
    $imagem_temp = $_FILES['imagem']['tmp_name'];
    $imagem_destino = 'uploads/' . $imagem_nome;
    
    // Mover a imagem para a pasta 'uploads'
    if (move_uploaded_file($imagem_temp, $imagem_destino)) {
        // Inserir os dados no banco
        $query = "INSERT INTO produtos (nome, descricao, url, imagem) 
                  VALUES ('$nome', '$descricao', '$url', '$imagem_nome')";
        $resultado = mysqli_query($conexao, $query);
        
        if ($resultado) {
            echo "<div class='alert alert-success'>Produto cadastrado com sucesso!</div>";
        } else {
            echo "<div class='alert alert-danger'>Erro ao salvar produto: " . mysqli_error($conexao) . "</div>";
        }
    } else {
        echo "<div class='alert alert-danger'>Erro ao fazer upload da imagem.</div>";
    }
}

// Consulta de produtos
$sql = "SELECT id, nome, descricao, url, imagem FROM produtos ORDER BY id DESC";
if (isset($_GET['consulta']) && !empty($_GET['consulta'])) {
    $consulta = $_GET['consulta'];
    $sql = "SELECT id, nome, descricao, url, imagem FROM produtos 
            WHERE nome LIKE '%$consulta%' 
            ORDER BY id DESC";
}

$resultado = mysqli_query($conexao, $sql);
?>

<div class="table-responsive">
    <table class="table table-striped table-hover table-bordered" style="background-color: #fff;">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Descrição</th>
                <th>URL</th>
                <th>Imagem</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($resultado->num_rows > 0) {
                while($row = $resultado->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["id"] . "</td>";
                    echo "<td>" . $row["nome"] . "</td>";
                    echo "<td>" . $row["descricao"] . "</td>";
                    echo "<td><a href='" . $row["url"] . "' target='_blank' class='text-decoration-none text-primary'>" . $row["url"] . "</a></td>";
                    echo "<td><img src='uploads/" . $row["imagem"] . "' width='100'></td>";
                    echo "<td>";
                    echo "<a href='editar_cliente.php?id=" . $row["id"] . "' class='btn btn-warning btn-sm'>Editar</a>";
                    echo " ";
                    echo "<a href='excluir_cliente.php?id=" . $row["id"] . "' class='btn btn-danger btn-sm'>Excluir</a>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6' class='text-center'>Nenhum produto encontrado</td></tr>";
            }
            $conexao->close();
            ?>
        </tbody>
    </table>
</div>

<?php include "rodape.php"; ?>
