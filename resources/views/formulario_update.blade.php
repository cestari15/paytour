<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container mt-5 pt-5">
        <h2 class="mb-4">Formulário de Cadastro</h2>

        <form action="{{ route('formularios.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="nome" class="form-label">Nome</label>
                <input type="text" name="nome" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="telefone" class="form-label">Telefone</label>
                <input type="text" name="telefone" class="form-control">
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">E-mail</label>
                <input type="email" name="email" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="cargo_desejado" class="form-label">Cargo Desejado</label>
                <input type="text" name="cargo_desejado" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="escolaridade" class="form-label">Escolaridade</label>
                <input type="text" name="escolaridade" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="observacoes" class="form-label">Observações</label>
                <textarea name="observacoes" class="form-control" rows="4" required></textarea>
            </div>

            <div class="mb-3">
                <label for="arquivo" class="form-label">Anexar Arquivo (máx. 1MB)</label>
                <input type="file" name="arquivo" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="data_hora" class="form-label">Data e Hora</label>
                <input type="date" name="data_hora" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Enviar</button>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
