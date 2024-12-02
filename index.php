<?php include "cabecalho.php" ?>
<?php include "conexao.php" ?>

<div id="carouselExampleCaptions" class="carousel slide">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="IMG/museums.png" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5>Museum Activity!</h5>
        <p>This is Web Page to test this news Hackathon.</p>
      </div>
    </div>
    <div class="carousel-item">
      <img src="IMG/museums.png" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5>Museum Activity!</h5>
        <p>Welcome to the museum!</p>
      </div>
    </div>
    <div class="carousel-item">
      <img src="IMG/museums.png" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5>Museum Activity!</h5>
        <p>This is Web Page to test this news Hackathon.</p>
      </div>
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>

<!-- Container de Cards -->
<div class="container mt-4">
    <div class="row">
        <?php
        // Consulta para buscar todos os produtos
        $sql = "SELECT * FROM produtos";
        $resultado = $conexao->query($sql);

        // Verifica se existem produtos
        if ($resultado->num_rows > 0) {
            // Loop para mostrar todos os produtos
            while ($row = $resultado->fetch_assoc()) {
                $id = $row['id'];
                $nome = $row['nome'];
                $descricao = $row['descricao'];
               

                echo "
                <div class='col-md-4 mb-4'>
                    <div class='card'>
                     
                        <div class='card-body'>
                            <h5 class='card-title'>$nome</h5>
                            <p class='card-text'>$descricao</p>
                            <a href='detalhes.php?id=$id' class='btn btn-Warning'>Ver Detalhes</a>
                        </div>
                    </div>
                </div>
                ";
            }
        } else {
            echo "<p>Nenhum produto encontrado</p>";
        }
        ?>
    </div>
</div>

<?php include "rodape.php"; ?>