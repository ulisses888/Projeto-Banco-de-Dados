# UFPel - Projetos

Sistema de gestão de projetos de ensino, pesquisa e extensão da UFPel, desenvolvido como projeto
prático da disciplina de **Projeto de Banco de Dados** (2026/1).

## Sobre o projeto

**Disciplina:** Projeto de Banco de Dados — Curso de Bacharelado em Ciência
da Computação, UFPel/CDTec

**Integrantes:** Érick Freitas, Ulisses Junior, Vinícius Campos




### Objetivo do sistema

O objetivo do projeto é a criação de um banco de dados para centralizar as informações de projetos, abrangendo os eixos de ensino, pesquisa e extensão. O domínio da aplicação foca na administração destes projetos, permitindo o registro detalhado desde a identificação básica, como código, título, eixo, unidade, até o acompanhamento dos membros da equipe.

O sistema permite o cadastro e a gestão de:
- **Programas** — agrupam um ou mais projetos institucionais
- **Projetos** — de ensino, pesquisa ou extensão, com eixo, status e ano
- **Ações** — atividades vinculadas a um projeto (ex.: oficinas, eventos)
- **Articulações** — Articulações com os cursos da UFPel
- **Alunos** — participantes discentes, podendo atuar como bolsistas
- **Servidores** — participantes docentes/técnicos, podendo atuar como coordenadores
- **Outros participantes** — colaboradores externos identificados por CPF

### Scripts SQL

Os scripts de criação das tabelas, restrições de integridade, carga de dados
de teste, consultas estão
em `database/scripts/`

## Arquitetura da interface

O sistema foi construído em **Laravel**, mas sem o ORM, toda a
comunicação com o banco é feita via **SQL puro**, conforme exigido pela
disciplina.

- **`app/Repositories/`** — uma classe por entidade, concentrando todo o SQL
  (`DB::select` / `DB::insert` / `DB::update` / `DB::delete`). É a única
  camada que acessa o banco diretamente.
- **`app/Http/Controllers/`** — um controller por entidade, com o padrão
  CRUD (`index`, `create`, `store`, `edit`, `update`, `destroy`), responsável
  por validar dados e orquestrar a chamada aos Repositories.
- **`resources/views/`** — telas em Blade (listagem, formulário de
  criação/edição e, para Projeto e Programa, tela de detalhes com gestão de
  equipe/vínculos), estilizadas com Bootstrap 5.
- **`routes/web.php`** — mapeia cada URL para o método correspondente do
  Controller.

### Funcionalidades da interface

- Cadastro, edição, exclusão e listagem (CRUD completo) de todas as entidades
- Busca por nome/eixo/status na listagem de projetos
- Tela de detalhes do projeto: gestão da equipe (adicionar/remover alunos,
  servidores e outros participantes) e visualização das ações e articulações
  vinculadas
- Tela de detalhes do programa: vínculo/desvínculo de projetos

## Como executar

### Pré-requisitos
- PHP 8.4+
- Composer
- MariaDB

### Passos

```bash
# instalar dependências
composer install

# configurar variáveis de ambiente
cp .env.example .env
php artisan key:generate

# editar o .env com as credenciais do banco (DB_DATABASE, DB_USERNAME, DB_PASSWORD)

# rodar os scripts SQL do projeto no banco configurado
# (schema + dados de teste, disponíveis em [preencher caminho])

# subir o servidor
php artisan serve
```

Acesse `http://127.0.0.1:8000/projetos` no navegador.

## Estrutura de pastas relevante

```
app/
  Http/Controllers/     # lógica de cada entidade (CRUD)
  Repositories/          # SQL puro de acesso ao banco
resources/
  views/                 # telas Blade (index, form, show)
  views/layouts/app.blade.php  # layout base com menu e Bootstrap
routes/
  web.php                 # rotas da aplicação
database/
  scripts/                # [preencher] scripts SQL (schema, seeds, consultas, trigger)
```
