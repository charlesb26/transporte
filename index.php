<?php
require_once("sistema/conexao.php");
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $nome_sistema?></title>

    <link rel="stylesheet" href="css/style.css">

    <link rel="icon" href="sistema/imagens/icone1.ico" type="image/x-icon">

<!-- Font Awesome -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"  rel="stylesheet"/>
<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"  rel="stylesheet"/>
<!-- MDB -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.2.0/mdb.min.css"  rel="stylesheet"/>
</head>
<body>

    <section style="background-color: #eee;">
        <div class="container py-5">
          <h4 class="text-center mb-5"><strong>SELECIONE O SISTEMA</strong></h4>
      
          <div class="row">
            <div class="col-lg-4 col-md-12 mb-4">
              <div class="bg-image hover-zoom ripple shadow-1-strong rounded">
                <img src="img/transporte.jpg"
                  class="w-100" />
                <a href="main.php">
                  <div class="mask" style="background-color: rgba(0, 0, 0, 0.3);">
                    <div class="d-flex justify-content-start align-items-start h-100">
                      <h5><span class="badge bg-light pt-2 ms-3 mt-3 text-dark">Transporte</span></h5>
                    </div>
                  </div>
                  <div class="hover-overlay">
                    <div class="mask" style="background-color: rgba(253, 253, 253, 0.15);"></div>
                  </div>
                </a>
              </div>
            </div>
      
            <div class="col-lg-4 col-md-6 mb-4">
              <div class="bg-image hover-zoom ripple shadow-1-strong rounded">
                <img src="img/nti.jpg"
                  class="w-100" />
                <a href="#!">
                  <div class="mask" style="background-color: rgba(0, 0, 0, 0.3);">
                    <div class="d-flex justify-content-start align-items-start h-100">
                      <h5><span class="badge bg-light pt-2 ms-3 mt-3 text-dark">NTI</span></h5>
                    </div>
                  </div>
                  <div class="hover-overlay">
                    <div class="mask" style="background-color: rgba(253, 253, 253, 0.15);"></div>
                  </div>
                </a>
              </div>
            </div>
      
            <div class="col-lg-4 col-md-6 mb-4">
              <div class="bg-image hover-zoom ripple shadow-1-strong rounded">
                <img src="img/colomae.jpg"
                  class="w-100" />
                <a href="#!">
                  <div class="mask" style="background-color: rgba(0, 0, 0, 0.3);">
                    <div class="d-flex justify-content-start align-items-start h-100">
                      <h5><span class="badge bg-light pt-2 ms-3 mt-3 text-dark">Colo de Mãe</span></h5>
                    </div>
                  </div>
                  <div class="hover-overlay">
                    <div class="mask" style="background-color: rgba(253, 253, 253, 0.15);"></div>
                  </div>
                </a>
              </div>
            </div>
          </div>
      
      
          </div>
        </div>
      </section>


  <!-- Inner -->

      <!-- MDB -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.2.0/mdb.min.js" ></script>
    
</body>
</html>