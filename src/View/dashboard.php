<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>PetCare - Painel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-4">
    <div class="d-flex justify-content-between mb-3">
        <h2>Olá, <?= htmlspecialchars($_SESSION['usuario_nome'] ?? '') ?></h2>
        <a href="index.php?action=logout" class="btn btn-danger">Sair</a>
    </div>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Meus Agendamentos</h4>
        <a href="index.php?action=agendar" class="btn btn-success">+ Novo Agendamento</a>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered bg-white">
            <thead>
                <tr>
                    <th>Pet</th>
                    <th>Serviço</th>
                    <th>Data</th>
                    <th>Horário</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($agendamentos)): ?>
                    <tr>
                        <td colspan="5" class="text-center">Nenhum agendamento encontrado.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($agendamentos as $item): ?>
                        <tr>
                            <td><?= htmlspecialchars($item['pet_nome']) ?></td>
                            <td><?= htmlspecialchars($item['servico']) ?></td>
                            <td><?= date('d/m/Y', strtotime($item['data_agendamento'])) ?></td>
                            <td><?= htmlspecialchars($item['horario']) ?></td>
                            <td>
                                <a href="index.php?action=cancelar&id=<?= $item['id'] ?>" 
                                   class="btn btn-sm btn-danger" 
                                   onclick="return confirm('Deseja realmente cancelar este agendamento?')">
                                   Cancelar
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>