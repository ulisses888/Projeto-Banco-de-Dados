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