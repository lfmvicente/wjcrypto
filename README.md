<h1>WJCrypto - A criptomoda do ecommerce</h1>

Cansados de enganação com criptomoedas e fraudes com bancos tradicionais, nós da Webjump queremos oferecer como solução uma moeda segura para transações no ecommerce. Para isso, iremos estruturar um software bancário, onde cada lojista irá ter uma conta e conseguirá fazer as principais operações.

<H3>Os requisitos são:</H3>

<ul><li>Cadastro de correntistas com dados básicos (Nome/Razão Social, CPF/CNPJ, RG/Inscrição estatual, Data de nascimento/Data fundação, telefone e endereço)
</br><b>OBS: Cada cliente terá um número de conta que será único, e não deve ser a chave primária da tabela.</b></li>

<li>Sistema de login para o correntista ter acesso a um ambiente seguro para realizar suas transações.</li></ul>

<H3>Nosso software inicialmente irá dispor da seguintes transações</H3>

<ul><li>Depósito - O correntista irá adicionar um valor X na sua conta.</li>

<li>Retirada - O correntista poderá retirar um valor X da sua conta.</li>

<li>Transferência para outro correntista - O correntista poderá transferir um valor X para a conta de outro correntista do nosso banco, mas não para outros bancos pro enquanto.</li>
</ul>
<H3>Funcional</H3>

<ul><li>API Rest para o backend usando JSON para requisições e resposta.</li>

<li>Protocolo de autenticação para comunicação do cliente com a API Basic Auth (token e password).</li>

<li>Todos os valores armazenados no banco de dados precisarão ser criptografados obrigatoriamente.</li>

<li>Logs das operações de:</li>
<ul>
<li>Login</li>
<li>Acesso as recursos (visualizações)</li>
<li>Transações</li>
</ul></ul>
Por fim, uma página WEB para consumir a api.

<h3>Recursos PHP implantados</h3>
<ul>
<li>Aplicação do Code Standard (PSR-1)</li>

<li>Aplicação do Coding Style (PRS-12)</li>

<li>Logs (PSR-3)</li>

<li>Auto Injeção de dependência</li>

<li>SOLID</li>

<li>Autoload via Composer (PSR-4)</li>

<li>Testes unitários (diferencial)</li>

<li>Testes de integração (diferencial)</li>

<li>Tratamento de erros</li>

<li>Código limpo e legível</li>

<li>Banco de dados</li></ul>

<h3>MySQL</h3>

<ul><li>Criação de tabelas com chaves primárias e auto incremento</li>

<li>Relacionamentos (1:1 e 1:n)</li></ul>
