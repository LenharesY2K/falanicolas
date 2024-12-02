<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aula do Master of PHP!</title>
    <link rel="stylesheet" href="bootstrap.min.css" />
    <link rel="stylesheet" href="style.css">
    <style>
        /* Estilo customizado para a navbar */
        .navbar-custom {
            background-color: #f5f5dc; /* Cor bege */
        }

        /* Fontes mais elegantes */
        .navbar-custom .navbar-brand,
        .navbar-custom .nav-link {
            color: #DAA520 !important; /* Letras brancas */
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; /* Fonte moderna */
            font-weight: 600; /* Negrito para destaque */
            text-transform: uppercase; /* Letras maiúsculas */
            letter-spacing: 1px; /* Espaçamento entre as letras */
        }

        /* Efeito hover na navbar */
        .navbar-custom .nav-link:hover {
            color: #f8f9fa !important; /* Alteração de cor ao passar o mouse */
            text-decoration: underline; /* Sublinha o texto ao passar o mouse */
            text-shadow: 1px 1px 5px rgba(0, 0, 0, 0.3); /* Sombra suave no texto */
        }

        /* Melhorando a aparência da navbar-brand */
        .navbar-custom .navbar-brand {
            font-family: 'Arial', sans-serif; /* Fonte mais refinada para o título */
            font-size: 1.8rem; /* Tamanho maior do título */
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3); /* Sombra no título */
        }

        /* Ajustes na barra de pesquisa */
        .navbar-custom .form-control {
            border-radius: 30px; /* Bordas arredondadas */
        }

        /* Estilo do botão de pesquisa */
        .navbar-custom .btn-outline-light {
            border-radius: 30px; /* Bordas arredondadas */
            font-weight: 600;
            transition: background-color 0.3s ease; /* Transição suave */
        }

        .navbar-custom .btn-outline-light:hover {
            background-color: #ffffff;
            color: #333333;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-custom">
  <div class="container-fluid">
    <a class="navbar-brand fs-3 fw-bold" href="index.php"></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="clientes.php">Administrar Peças</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="novo_cliente.php">Adicionar Peças</a>
        </li>
      </ul>
      <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Pesquisar" aria-label="Pesquisar">
        <button class="btn btn-outline-light" type="submit">Buscar</button>
      </form>
    </div>
  </div>
</nav>

<!-- Adicione mais conteúdo abaixo -->


