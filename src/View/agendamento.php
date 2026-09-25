<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>PetCare - Agendar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card p-3 shadow-sm">
                <h3 class="text-center">Novo Agendamento</h3>

                <?php if (!empty($erro)): ?>
                    <div class="alert alert-danger"><?= htmlspecialchars($erro) ?></div>
                <?php endif; ?>

                <form action="index.php?action=agendar" method="POST">
                    <div class="mb-3">
                        <label>Nome do Pet</label>
                        <input type="text" name="pet_nome" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Serviço</label>
                        <select name="servico" class="form-select" required>
                            <option value="Banho">Banho</option>
                            <option value="Tosa">Tosa</option>
                            <option value="Consulta">Consulta</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Data</label>
                        <input type="date" name="data_agendamento" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Horário</label>
                        <input type="time" name="horario" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Agendar</button>
                </form>
                <div class="text-center mt-3">
                    <a href="index.php?action=dashboard">Voltar</a>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>