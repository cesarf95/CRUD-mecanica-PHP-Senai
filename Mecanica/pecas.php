<?php
session_start();

if (!isset($_SESSION['nome'])) {
    header('Location: index.php?status=erro&msg=Acesso Negado');
    exit();
}

$nome = $_SESSION['nome'];

include 'conecta.php';
echo "<script>alert('Bem-vindo, $nome');</script>"; //Recurso novo adicionado para exibir uma mensagem de boas-vindas ao usuário após o login bem-sucedido.
?>

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Peças</title>

    <style>
    body {
        background-color: #ddd7d7;
        margin: 0;
        padding: 0;
    }

    /* TOPO */
    .topo {
        position: relative;
        width: 100%;
        overflow: hidden;
    }

    /* IMAGEM DO BANNER */
    .banner {
        width: 100%;
        height: 80%;
        object-fit: cover;
        display: block;
    }

    /* ÁREA DO USUÁRIO */
    .header {
        position: absolute;
        top: 20px;
        right: 20px;

        background-color: rgba(221, 43, 11, 0.95);

        padding: 10px 18px;
        border-radius: 12px;

        z-index: 10;
    }

    .header a {
        color: black;
        text-decoration: none;
        font-weight: bold;
        transition: 0.3s;
    }

    .header a:hover {
        color: white;
    }

    .texto-destaque {
        font-size: 24px;
        color: red;
        font-weight: bold;
    }

    .table {
        text-transform: uppercase;
    }
    </style>
</head>

<body>

    <!-- TOPO / BANNER -->
    <div class="topo">

        <img src="Imagens/banner mecanica.png" class="banner">

        <div class="header">

            <a href="mecanica.php">HOME</a> |

            <b><?= htmlspecialchars($nome) ?></b> |

            <a href="sair.php">SAIR</a>

        </div>

    </div>

    <hr>

    <!-- BOTÃO CADASTRAR -->
    <div class="text-center my-3">
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalCadastrar">
            CADASTRAR PEÇA
        </button>
    </div>

    <!-- TABELA -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-11">

                <div class="card">

                    <div class="card-header text-center text-uppercase">

                        <b>PEÇAS CADASTRADAS </b>
                    </div>

                    <div class="card-body">

                        <?php

$sql = "SELECT * FROM pecas ORDER BY codigo DESC";
$dados = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);

if(count($dados) > 0){

    echo "
    <table class='table table-hover table-bordered'>
    
        <thead class='table-dark'>
            <tr>
                <th>CÓDIGO</th>
                <th>NOME</th>
                <th>MARCA</th>
                <th>MODELO</th>
                <th>DESCRIÇÃO</th>
                <th>DATA ENTRADA</th>
                <th width='120'>AÇÕES</th>
            </tr>
        </thead>

        <tbody>
    ";

    foreach($dados as $item){

        $codigo = $item['codigo'];

        echo "
        <tr>

            <td>{$item['codigo']}</td>
            <td>{$item['nome']}</td>
            <td>{$item['marca']}</td>
            <td>{$item['modelo']}</td>
            <td>{$item['descricao']}</td>
            <td>{$item['data_entrada']}</td>

            <td>

                <a href='#'
                   data-bs-toggle='modal'
                   data-bs-target='#modalEditar'
                   data-id='$codigo'>

                    ✏️
                </a>

                |

                <a href='excluir_peca.php?codigo=$codigo'
                   onclick=\"return confirm('Deseja realmente excluir esta peça?')\">

                    ❌
                </a>

            </td>

        </tr>
        ";
    }

    echo "
        </tbody>
    </table>
    ";

}else{

    echo "<p class='text-danger'>NÃO EXISTEM PEÇAS CADASTRADAS</p>";
}
?>

                    </div>

                </div>

            </div>
        </div>
    </div>

    <!-- MODAL CADASTRAR -->
    <div class="modal fade" id="modalCadastrar">

        <div class="modal-dialog">

            <div class="modal-content">

                <div class="modal-header">

                    <h5>CADASTRAR PEÇA</h5>

                    <button class="btn-close" data-bs-dismiss="modal"></button>

                </div>

                <div class="modal-body">

                    <form action="cadastro_peca.php" method="POST">

                        <label>NOME</label>
                        <input type="text" name="nome" class="form-control mb-2" required>

                        <label>MARCA</label>
                        <input type="text" name="marca" class="form-control mb-2" required>

                        <label>MODELO</label>
                        <input type="text" name="modelo" class="form-control mb-2" required>

                        <label>DESCRIÇÃO</label>
                        <textarea name="descricao" class="form-control mb-2"></textarea>

                        <label>DATA ENTRADA</label>
                        <input type="date" name="data_entrada" class="form-control mb-3" required>

                        <button class="btn btn-success">
                            CADASTRAR
                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

    <!-- MODAL EDITAR -->
    <div class="modal fade" id="modalEditar">

        <div class="modal-dialog">

            <div class="modal-content">

                <div class="modal-header">

                    <h5>EDITAR PEÇA</h5>

                    <button class="btn-close" data-bs-dismiss="modal"></button>

                </div>

                <div class="modal-body">

                    <form action="editar_peca.php" method="POST">

                        <input type="hidden" name="codigo" id="edit_codigo">

                        <label>NOME</label>
                        <input type="text" name="nome" id="edit_nome" class="form-control mb-2">

                        <label>MARCA</label>
                        <input type="text" name="marca" id="edit_marca" class="form-control mb-2">

                        <label>MODELO</label>
                        <input type="text" name="modelo" id="edit_modelo" class="form-control mb-2">

                        <label>DESCRIÇÃO</label>
                        <textarea name="descricao" id="edit_descricao" class="form-control mb-2"></textarea>

                        <label>DATA ENTRADA</label>
                        <input type="date" name="data_entrada" id="edit_data_entrada" class="form-control mb-3">

                        <button class="btn btn-primary">
                            SALVAR
                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

    <!-- SCRIPT -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
    document.getElementById('modalEditar').addEventListener('show.bs.modal', function(event) {

        let codigo = event.relatedTarget.getAttribute('data-id');

        fetch('buscar_peca.php?codigo=' + codigo)

            .then(res => res.json())

            .then(data => {

                document.getElementById('edit_codigo').value = data.codigo;
                document.getElementById('edit_nome').value = data.nome;
                document.getElementById('edit_marca').value = data.marca;
                document.getElementById('edit_modelo').value = data.modelo;
                document.getElementById('edit_descricao').value = data.descricao;
                document.getElementById('edit_data_entrada').value = data.data_entrada;

            });

    });
    </script>

</body>

</html>