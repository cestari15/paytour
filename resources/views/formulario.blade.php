<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/formulario.css') }}">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" defer></script>

    <!-- Axios -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>

<body>
    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #7864d0;">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Paytour</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link active" href="#">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Sobre</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Contato</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- FORMULÁRIO -->
    <div class="container col-11 col-md-8 p-4 mt-5 main-content">
        <div class="row gx-5">
            <h1 class="mb-4">Complete seu cadastro</h1>

            <form id="formCadastro" class="col-md-6" enctype="multipart/form-data">
                @csrf

                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome">
                    <label for="nome">Nome</label>
                    <div class="invalid-feedback"></div>
                </div>

                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="telefone" name="telefone" placeholder="Telefone">
                    <label for="telefone">Telefone</label>
                    <div class="invalid-feedback"></div>
                </div>

                <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="email" name="email" placeholder="E-mail">
                    <label for="email">E-mail</label>
                    <div class="invalid-feedback"></div>
                </div>

                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="cargo_desejado" name="cargo_desejado"
                        placeholder="Cargo Desejado">
                    <label for="cargo_desejado">Cargo Desejado</label>
                    <div class="invalid-feedback"></div>
                </div>

                <div class="form-floating mb-3">
                    <select class="form-select" id="escolaridade" name="escolaridade">
                        <option value="">Selecione...</option>
                        <option value="Ensino Fundamental">Ensino Fundamental</option>
                        <option value="Ensino Médio">Ensino Médio</option>
                        <option value="Superior">Superior</option>
                        <option value="Pós-Graduação">Pós-Graduação</option>
                        <option value="Mestrado">Mestrado</option>
                        <option value="Doutorado">Doutorado</option>
                    </select>
                    <label for="escolaridade">Escolaridade</label>
                    <div class="invalid-feedback"></div>
                </div>

                <div class="form-floating mb-3">
                    <textarea class="form-control" id="observacoes" name="observacoes" placeholder="Observações" style="height: 100px;"></textarea>
                    <label for="observacoes">Observações</label>
                    <div class="invalid-feedback"></div>
                </div>

                <div class="form-floating mb-3">
                    <input type="file" class="form-control" id="arquivo" name="arquivo">
                    <label for="arquivo">Arquivo (máx. 1MB)</label>
                    <div class="invalid-feedback"></div>
                </div>

                <div class="form-floating mb-3">
                    <input type="datetime-local" class="form-control" id="data_hora" name="data_hora">
                    <label for="data_hora">Data e Hora</label>
                    <div class="invalid-feedback"></div>
                </div>

                <button type="submit" class="btn btn-primary col-12 col-md-auto my-4"
                    style="background-color: #7864d0;">Cadastrar</button>
            </form>

            <div class="col-md-6 row align-items-center">
                <img class="img-fluid my-4" src="{{ asset('img/hello.svg') }}" alt="Ilustração de cadastro">
            </div>
        </div>
    </div>

    <!-- FOOTER -->
    <footer class="mt-5 text-white py-4" style="background-color: #7864d0;">
        <div class="container text-center">
            <p>© 2025 Paytour. Todos os direitos reservados.</p>
        </div>
    </footer>

    <!-- SCRIPT AJAX -->
    <script>
        const form = document.getElementById('formCadastro');

        form.addEventListener('submit', function(e) {
            e.preventDefault();

            // Remove erros antigos
            form.querySelectorAll('.form-control, .form-select, textarea').forEach(input => {
                input.classList.remove('is-invalid');
                input.parentElement.querySelector('.invalid-feedback').innerText = '';
            });

            const formData = new FormData(form);

            axios.post("{{ route('formularios.store') }}", formData, {
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content'),
                        'Accept': 'application/json'
                    }
                })
                .then(response => {
                    if (response.data.success === false) {
                        const errors = response.data.error;
                        for (const field in errors) {
                            const input = document.getElementById(field);
                            if (input) {
                                input.classList.add('is-invalid');
                                input.parentElement.querySelector('.invalid-feedback').innerText = errors[field]
                                    [0];
                            }
                        }
                    } else {
                        alert('Cadastro realizado com sucesso!');
                        form.reset();
                    }
                })
                .catch(error => console.log(error));
        });
    </script>
</body>

</html>
