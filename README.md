# Formulário de Currículos - Paytour

Formulário web para envio de currículos, desenvolvido em Laravel 10, com validação, persistência no banco de dados, captura de IP e envio de e-mail para o usuário cadastrado.

## Funcionalidades

- Cadastro de currículos com os campos:
  - Nome
  - E-mail
  - Telefone
  - Cargo Desejado
  - Escolaridade
  - Observações (opcional)
  - Arquivo (.pdf, .doc, .docx, até 1MB)
  - Data e hora
- Validação de formulário
- Persistência no banco de dados
- Captura do IP do usuário
- Envio de e-mail para o usuário cadastrado
- Feedback de erros nos campos

## Tecnologias

- PHP 8 / Laravel 10
- MySQL
- Bootstrap 5
- Axios
- PHPUnit

## Instalação

1. Clone o repositório:

git clone https://github.com/cestari15/paytour.git
cd paytour
composer update
cp .env.example .env
# Configure o banco de dados e dados de e-mail no arquivo .env
php artisan key:generate
php artisan migrate
php artisan serve

Acesse o formulário no navegador:

http://127.0.0.1:8000/formulario
