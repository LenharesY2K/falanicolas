<?php
// Conexão com o banco de dados
$host = "localhost";
$user = "root";
$password = "";
$database = "museu";

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Verificar se o ID foi passado
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = (int) $_GET['id']; // Convertendo para inteiro por segurança
    $sql = "SELECT * FROM produtos WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $produto = $result->fetch_assoc();
    } else {
        die("Produto não encontrado.");
    }

    $stmt->close();
} else {
    die("ID inválido ou não fornecido.");
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes do Produto</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .produto {
            border: 1px solid #ccc;
            padding: 15px;
            border-radius: 5px;
            max-width: 500px;
            margin: auto;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }
        .produto img {
            max-width: 100%;
            height: auto;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="produto">
        <h1><?php echo htmlspecialchars($produto['nome']); ?></h1>
        <p><strong>Descrição:</strong> <?php echo htmlspecialchars($produto['descricao']); ?></p>
        <?php if (!empty($produto['url'])): ?>
            <img src="<?php echo htmlspecialchars($produto['url']); ?>" alt="Imagem do Produto">
        <?php endif; ?>
    </div>
</body>
</html>
