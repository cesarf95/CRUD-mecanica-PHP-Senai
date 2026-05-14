<?php
session_start();

if (!isset($_SESSION['nome'])) {
    header('Location: index.php?status=erro&msg=Acesso negado');
    exit;
}

$nome = $_SESSION['nome'];
echo "<script>alert('Bem-vindo, $nome');</script>"; //Recurso novo adicionado para exibir uma mensagem de boas-vindas ao usuário após o login bem-sucedido.
?>
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta http-equiv="content-language" content="pt-br">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" href="imagens/logo_aba.png" type="image/png">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Mecânica Senai</title>

    <style>
    body {
        background-color: #ddd7d7;
        margin: 0;
        padding: 0;
    }

    /* BANNER */
    .banner {
        width: 100%;
        height: auto;
        display: block;
    }

    /* TOPO */
    .topo {
        position: relative;
    }

    /* ÁREA DO USUÁRIO */
    .header {
        position: absolute;
        top: 20px;
        right: 20px;

        background-color: rgba(221, 43, 11, 0.95);

        padding: 8px 15px;
        border-radius: 10px;
    }

    .header a {
        color: black;
        text-decoration: none;
        font-weight: bold;
    }

    .texto-destaque {
        font-size: 24px;
        color: red;
        font-weight: bold;
    }
    </style>
</head>

<body>

    <!-- TOPO -->
    <div class="container-fluid p-0 topo">

        <!-- IMAGEM -->
        <img src="imagens/banner mecanica.png" class="banner" alt="Banner Mecânica">

        <!-- USUÁRIO -->
        <div class="header">

            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                class="bi bi-person-circle" viewBox="0 0 16 16">

                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />

                <path fill-rule="evenodd"
                    d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1" />

            </svg>

            &nbsp;<b><?= htmlspecialchars($nome) ?></b> |

            <a href="sair.php">SAIR</a>

        </div>

    </div>

    <!-- MENU -->
    <nav class="mt-3">
        <?php include 'menu.php'; ?>
    </nav>
    <br />
    <div class="container">
        <div class="row">
            <div class="col-md-6 mb-4">
                <div class="card shadow border-2">
                    <div class="card-header bg-red border-bottom py-3">
                        <span class="texto-destaque">ORDENS DE SERVIÇO</span>
                    </div>
                    <div class="card-body">
                        ORDENS DE SERVIÇO
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="card shadow border-2">
                    <div class="card-header bg-red border-bottom py-3">
                        <span class="texto-destaque">ORDENS DE SERVIÇO</span>
                    </div>
                    <div class="card-body">
                        ORDENS DE SERVIÇO
                    </div>
                </div>

            </div>

            <!-- Bootstrap JS -->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>