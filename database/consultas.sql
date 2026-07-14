USE projetos;

# Alunos do projeto 2
SELECT matricula, nome, bolsista FROM alunos NATURAL JOIN aluno_participa WHERE codigo = 2;

# Servidores do projeto 2
SELECT siape, nome, funcao FROM servidores NATURAL JOIN servidor_participa WHERE codigo = 2;

# Outros participantes do projeto 2
SELECT cpf, nome FROM outros NATURAL JOIN outro_participa WHERE codigo = 2;

# Selecionar programas e seus projetos
SELECT codigo_programa, programas.nome, codigo_projeto, projetos.nome, status FROM programas
INNER JOIN programa_contem ON programa_contem.codigo_programa = programas.codigo 
INNER JOIN projetos ON programa_contem.codigo_projeto = projetos.codigo;

# Selecionar bolsistas
SELECT matricula, nome, bolsista FROM alunos NATURAL JOIN aluno_participa WHERE bolsista = 1;

# Selecionar não bolsistas
SELECT matricula, nome, bolsista FROM alunos NATURAL JOIN aluno_participa WHERE bolsista = 0;

# Selecionar todas as ações
SELECT acoes.codigo, projetos.nome AS nome_projeto, titulo, genero, acoes.status FROM acoes
INNER JOIN projetos ON acoes.codigo_projeto = projetos.codigo;

# Selecionar todos os coordenadores
SELECT siape, nome, funcao FROM servidor_participa NATURAL JOIN servidores WHERE funcao = 'Coordenador';