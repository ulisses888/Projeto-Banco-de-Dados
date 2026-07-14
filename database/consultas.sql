USE projetos;

SELECT matricula, nome, bolsista FROM alunos NATURAL JOIN aluno_participa WHERE codigo = 1;

SELECT siape, nome, funcao FROM servidores NATURAL JOIN servidor_participa WHERE codigo = 1;

SELECT cpf, nome FROM outros NATURAL JOIN outro_participa WHERE codigo = 1;

SELECT codigo_programa, programas.nome, codigo_projeto, projetos.nome, status FROM programas
INNER JOIN programa_contem ON programa_contem.codigo_programa = programas.codigo 
INNER JOIN projetos ON programa_contem.codigo_projeto = projetos.codigo;

SELECT matricula, nome, bolsista FROM alunos NATURAL JOIN aluno_participa WHERE bolsista = 1;

SELECT matricula, nome, bolsista FROM alunos NATURAL JOIN aluno_participa WHERE bolsista = 0;

SELECT acoes.codigo, titulo, genero, acoes.status FROM acoes
INNER JOIN projetos ON acoes.codigo_projeto = projetos.codigo;

SELECT siape, nome, funcao FROM servidor_participa NATURAL JOIN servidores WHERE funcao = 'Coordenador';