# Arena Facil

Sistema web para cadastro de usuarios, cadastro de quadras e reservas.

## Tecnologias

- PHP
- MySQL
- HTML, CSS e JavaScript
- Bootstrap
- XAMPP

## Como rodar

1. Copie a pasta `arena-facil` para `C:\xampp\htdocs\`.
2. Importe o arquivo `arena_facil.sql` no MySQL Workbench ou phpMyAdmin.
3. Copie `api/config/database.example.php` para `api/config/database.php`.
4. Ajuste usuario e senha do MySQL no arquivo `api/config/database.php`.
5. Inicie Apache e MySQL no XAMPP.
6. Acesse:

```text
http://localhost/arena-facil/frontend/login.html
```

## Usuarios de teste

Cliente:

```text
email: teste@gmail.com
senha: 123
```

Proprietario:

```text
email: admin@arenafacil.com
senha: 123
```

Proprietario alternativo:

```text
email: joaoteste@gmail.com
senha: 123
```

## Banco de dados

O arquivo `arena_facil.sql` cria o banco `arena_facil` e as tabelas:

- `usuarios`
- `quadras`
- `reservas`

## Observacao sobre seguranca

O arquivo `api/config/database.php` nao deve ser enviado ao GitHub, porque contem dados locais de conexao com o banco.
Use `api/config/database.example.php` como modelo.
