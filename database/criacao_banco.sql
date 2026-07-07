USE projetos;

CREATE TABLE IF NOT EXISTS projetos (
    codigo INT PRIMARY KEY,
    nome VARCHAR(255),
    eixo VARCHAR(255),
    status VARCHAR(50),
    ano SMALLINT
);

CREATE TABLE IF NOT EXISTS servidores (
    siape INT PRIMARY KEY,
    nome VARCHAR(255),
    unidade VARCHAR(255)
);

CREATE TABLE IF NOT EXISTS servidor_participa (
    siape INT,
    CONSTRAINT `fk_siape_servidor`
    FOREIGN KEY (siape) REFERENCES servidores(siape),

    codigo INT,
    CONSTRAINT `fk_servidores_codigo_projeto`
    FOREIGN KEY (codigo) REFERENCES projetos(codigo),

    PRIMARY KEY(siape, codigo)
);

CREATE TABLE IF NOT EXISTS aluno (
    matricula INT PRIMARY KEY,
    nome VARCHAR(255),
    curso VARCHAR(255)
);

CREATE TABLE IF NOT EXISTS aluno_participa (
    matricula INT,
    CONSTRAINT `fk_matricula_aluno`
    FOREIGN KEY (matricula) REFERENCES aluno(matricula),

    codigo INT,
    CONSTRAINT `fk_alunos_codigo_projeto`
    FOREIGN KEY (codigo) REFERENCES projetos(codigo),

    bolsista BOOLEAN,
    PRIMARY KEY(matricula, codigo)
);

CREATE TABLE IF NOT EXISTS outros (
    cpf CHAR(9) PRIMARY KEY,
    nome VARCHAR(255)
);

CREATE TABLE IF NOT EXISTS outro_participa (
    cpf char(9),
    CONSTRAINT `fk_cpf_outro`
    FOREIGN KEY (cpf) REFERENCES outros(cpf),

    codigo INT,
    CONSTRAINT `fk_outros_codigo_projeto`
    FOREIGN KEY (codigo) REFERENCES projetos(codigo),

    PRIMARY KEY(cpf, codigo)
);

CREATE TABLE IF NOT EXISTS acoes (
    codigo INT PRIMARY KEY,
    codigo_projeto INT,
    CONSTRAINT `fk_acoes_codigo_projeto`
    FOREIGN KEY (codigo_projeto) REFERENCES projetos(codigo),

    titulo VARCHAR(255),
    genero VARCHAR(255),
    status VARCHAR(50),
    descricao TEXT
);

CREATE TABLE IF NOT EXISTS articulacoes (
    codigo INT PRIMARY KEY,
    codigo_projeto INT,
    CONSTRAINT `fk_articulacoes_codigo_projeto`
    FOREIGN KEY (codigo_projeto) REFERENCES projetos(codigo),
    nome VARCHAR(255)
);

CREATE TABLE IF NOT EXISTS programas (
    codigo INT PRIMARY KEY,
    nome VARCHAR(255)
);

CREATE TABLE IF NOT EXISTS programa_contem (
    codigo_programa INT,
    CONSTRAINT `fk_codigo_programa`
    FOREIGN KEY (codigo_programa) REFERENCES programas(codigo),

    codigo_projeto INT,
    CONSTRAINT `fk_programas_codigo_projeto`
    FOREIGN KEY (codigo_projeto) REFERENCES projetos(codigo),

    PRIMARY KEY(codigo_programa, codigo_projeto)
);

#
#
# POPULANDO A TABELA: (SO EXECUTA SE ELAS TIVEREM VAZIAS)
#
#

INSERT INTO projetos (codigo, nome, eixo, status, ano)
SELECT * FROM (
    SELECT 1 AS codigo, 'Extensão Digital Rural' AS nome, 'Extensão' AS eixo, 'Ativo' AS status, 2024 AS ano UNION ALL
    SELECT 2, 'Saúde na Comunidade',           'Extensão', 'Ativo',    2025 UNION ALL
    SELECT 3, 'Educação Ambiental Escolar',    'Ensino',   'Concluído',2023 UNION ALL
    SELECT 4, 'Robótica para Jovens',          'Ensino',   'Ativo',    2025 UNION ALL
    SELECT 5, 'Cultura Popular Gaúcha',        'Pesquisa', 'Ativo',    2024
) AS tmp
WHERE NOT EXISTS (SELECT 1 FROM projetos);

INSERT INTO servidores (siape, nome, unidade)
SELECT * FROM (
    SELECT 100001 AS siape, 'Ana Beatriz Souza' AS nome, 'CDTec' AS unidade UNION ALL
    SELECT 100002, 'Carlos Eduardo Lima', 'CDTec' UNION ALL
    SELECT 100003, 'Fernanda Gomes',      'Faculdade de Medicina' UNION ALL
    SELECT 100004, 'Roberto Almeida',     'Instituto de Biologia' UNION ALL
    SELECT 100005, 'Juliana Martins',     'Centro de Artes'
) AS tmp
WHERE NOT EXISTS (SELECT 1 FROM servidores);

INSERT INTO aluno (matricula, nome, curso)
SELECT * FROM (
    SELECT 26010001 AS matricula, 'Lucas Pereira' AS nome, 'Ciência da Computação' AS curso UNION ALL
    SELECT 26010002, 'Mariana Ribeiro',  'Engenharia de Computação' UNION ALL
    SELECT 26010003, 'Pedro Henrique',   'Medicina' UNION ALL
    SELECT 26010004, 'Camila Duarte',    'Biologia' UNION ALL
    SELECT 26010005, 'Gabriel Nunes',    'Ciência da Computação'
) AS tmp
WHERE NOT EXISTS (SELECT 1 FROM aluno);

INSERT INTO outros (cpf, nome)
SELECT * FROM (
    SELECT '111111111' AS cpf, 'Marta Silveira' AS nome UNION ALL
    SELECT '222222222', 'João Batista'    UNION ALL
    SELECT '333333333', 'Renata Costa'
) AS tmp
WHERE NOT EXISTS (SELECT 1 FROM outros);

#ULISSES: AQ SERIA A TABELA PROGRAMAS MAS N ENTENDI MT BEM ELA ENTAO VOU DEIXAR O ESPACO EM BRANCO
#ULISSES: SE ELE É UM GUARDA CHUVA ACREDITO QUE N TEM RPROBLEMA FICAR VAZIO
#
#
#

INSERT INTO servidor_participa (siape, codigo)
SELECT * FROM (
    SELECT 100001 AS siape, 1 AS codigo UNION ALL
    SELECT 100002, 1 UNION ALL
    SELECT 100003, 2 UNION ALL
    SELECT 100004, 3 UNION ALL
    SELECT 100005, 5
) AS tmp
WHERE NOT EXISTS (SELECT 1 FROM servidor_participa);

INSERT INTO aluno_participa (matricula, codigo, bolsista)
SELECT * FROM (
    SELECT 26010001 AS matricula, 1 AS codigo, TRUE AS bolsista  UNION ALL
    SELECT 26010002, 4, TRUE  UNION ALL
    SELECT 26010003, 2, FALSE UNION ALL
    SELECT 26010004, 3, TRUE  UNION ALL
    SELECT 26010005, 4, FALSE
) AS tmp
WHERE NOT EXISTS (SELECT 1 FROM aluno_participa);

INSERT INTO outro_participa (cpf, codigo)
SELECT * FROM (
    SELECT '111111111' AS cpf, 2 AS codigo UNION ALL
    SELECT '222222222', 3 UNION ALL
    SELECT '333333333', 5
) AS tmp
WHERE NOT EXISTS (SELECT 1 FROM outro_participa);

INSERT INTO acoes (codigo, codigo_projeto, titulo, genero, status, descricao)
SELECT * FROM (
    SELECT 1 AS codigo, 1 AS codigo_projeto, 'Oficina de Informática Básica' AS titulo, 'Extensão' AS genero, 'Concluída' AS status, 'Oficina voltada a moradores da zona rural sobre uso de computadores.' AS descricao UNION ALL
    SELECT 2, 1, 'Levantamento de Necessidades Digitais','Pesquisa', 'Concluída', 'Pesquisa de campo para mapear a demanda por inclusão digital na região.' UNION ALL
    SELECT 3, 2, 'Mutirão de Saúde',                     'Extensão', 'Ativa',     'Atendimento comunitário com verificação de pressão e glicemia.' UNION ALL
    SELECT 4, 2, 'Formação de Agentes Comunitários',     'Ensino',   'Ativa',     'Capacitação de agentes comunitários de saúde em primeiros socorros.' UNION ALL
    SELECT 5, 3, 'Palestra sobre Reciclagem',             'Extensão', 'Concluída', 'Palestra em escolas municipais sobre separação de resíduos.' UNION ALL
    SELECT 6, 3, 'Estudo de Impacto Ambiental Local',    'Pesquisa', 'Concluída', 'Levantamento de dados sobre descarte de resíduos no município.' UNION ALL
    SELECT 7, 4, 'Curso de Robótica Básica',              'Ensino',   'Ativa',     'Curso introdutório de robótica para alunos do ensino médio.' UNION ALL
    SELECT 8, 4, 'Feira de Robótica Estudantil',          'Extensão', 'Ativa',     'Evento aberto à comunidade para apresentação dos protótipos desenvolvidos.' UNION ALL
    SELECT 9, 5, 'Registro Audiovisual de Manifestações Culturais', 'Pesquisa', 'Ativa', 'Documentação de tradições e festividades da cultura gaúcha regional.'
) AS tmp
WHERE NOT EXISTS (SELECT 1 FROM acoes);

INSERT INTO articulacoes (codigo, codigo_projeto, nome)
SELECT * FROM (
    SELECT 1 AS codigo, 1 AS codigo_projeto, 'Ciência da Computação e Engenharia de Computação' AS nome UNION ALL
    SELECT 2, 4, 'Ciência da Computação e Engenharia de Computação' UNION ALL
    SELECT 3, 2, 'Medicina e Biologia'                              UNION ALL
    SELECT 4, 3, 'Biologia e Ciência da Computação'
) AS tmp
WHERE NOT EXISTS (SELECT 1 FROM articulacoes);

#ULISSES: AQ SERIA O PROGRAMA_CONTEM, MESMA JUSTIFICATIVA DE ANTES