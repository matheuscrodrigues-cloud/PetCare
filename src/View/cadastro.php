<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>PetCare - Cadastro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card p-3 shadow-sm">
                <h3 class="text-center">Cadastro</h3>

                <?php if (!empty($erro)): ?>
                    <div class="alert alert-danger"><?= htmlspecialchars($erro) ?></div>
                <?php endif; ?>

                <form action="index.php?action=cadastrar" method="POST">
                    <div class="mb-3">
                        <label>Nome</label>
                        <input type="text" name="nome" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>E-mail</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Senha</label>
                        <input type="password" name="senha" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-success w-100">Cadastrar</button>
                </form>
                <div class="text-center mt-3">
                    <a href="index.php?action=login">Voltar ao Login</a>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>