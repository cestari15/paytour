<h1>Novo formulário cadastrado!</h1>
<h1>Função de Email pronta!!</h1>

<p><strong>Nome:</strong> {{ $dados['nome'] }}</p>
<p><strong>Telefone:</strong> {{ $dados['telefone'] }}</p>
<p><strong>Email:</strong> {{ $dados['email'] }}</p>
<p><strong>Cargo Desejado:</strong> {{ $dados['cargo_desejado'] }}</p>
<p><strong>Escolaridade:</strong> {{ $dados['escolaridade'] }}</p>
<p><strong>Observações:</strong> {{ $dados['observacoes'] ?? 'Nenhuma' }}</p>
<p><strong>Data/Hora:</strong> {{ $dados['data_hora'] }}</p>
<p><strong>IP do usuário:</strong> {{ $dados['ip'] }}</p>
