FSOFT AUTO - Sistema de Gestão de Veículos

Bem-vindo ao FSOFT AUTO, um sistema completo de gestão para concessionárias de veículos usados. Essa aplicação web permite o controle total de clientes, compras, vendas, gastos, documentos, fornecedores e fluxo de caixa de forma eficiente e centralizada.

Funcionalidades
	•	Gestão de clientes
	•	Cadastro e controle de veículos usados
	•	Registros de compras e vendas
	•	Cadastro de fornecedores
	•	Registro de gastos por veículo
	•	Controle de documentos de veículos
	•	Fluxo de caixa detalhado (entradas e saídas)
	•	Módulo multiempresa
	•	Autenticação com tipos de usuário: Master, Admin e User
	•	Interface AdminLTE com tela de login personalizada

Tecnologias utilizadas
	•	PHP 8+
	•	Laravel 10
	•	MySQL
	•	AdminLTE 3
	•	Bootstrap 4

Instalação
	1.	Clone o repositório:

git clone https://github.com/seuusuario/fsoft-auto.git
cd fsoft-auto

	2.	Instale as dependências:

composer install
npm install && npm run dev

	3.	Configure o arquivo .env:

cp .env.example .env
php artisan key:generate

	4.	Configure seu banco de dados no .env e rode as migrations com seed:

php artisan migrate --seed

	5.	Inicie o servidor:

php artisan serve

Acesse: http://localhost:8000

Usuário padrão criado pelo seed
	•	Email: master@example.com
	•	Senha: master1234

Recomenda-se alterar essa senha após o primeiro login.

Estrutura de Tipos de Usuário
	•	Master: Acesso total ao sistema (incluindo módulo de empresas)
	•	Admin: Acesso total restrito a uma empresa
	•	User: Acesso limitado a recursos da empresa atribuída

Licença

Este projeto está licenciado sob os termos da MIT License.

⸻

Desenvolvido por FSOFT SISTEMAS ❤️