CREATE TABLE Tb_banco (
    codigo INT NOT NULL,
    nome VARCHAR(100) NOT NULL,
    PRIMARY KEY (codigo)
);

INSERT INTO Tb_banco (
    codigo,
    nome
) VALUES (
    135,
    "Banco Saquarema"
), (
    246,
    "Banco Sapucaia"
), (
    357,
    "Banco Moneyjah"
);

CREATE TABLE Tb_convenio (
    codigo INT NOT NULL AUTO_INCREMENT,
    convenio VARCHAR(100) NOT NULL,
    verba DECIMAL(10,2) NOT NULL,
    banco INT NOT NULL,
    PRIMARY KEY (codigo),
    FOREIGN KEY (banco) REFERENCES Tb_banco(codigo)
);

INSERT INTO Tb_convenio (
    convenio,
    verba,
    banco
) VALUES (
    "Convenio A",
    1872.89,
    135
), (
    "Convenio B",
    3827.77,
    135
), (
    "Convenio C",
    7742.21,
    357
);

CREATE TABLE Tb_convenio_servico (
    codigo INT NOT NULL AUTO_INCREMENT,
    convenio INT NOT NULL,
    servico VARCHAR(255) NOT NULL,
    PRIMARY KEY (codigo),
    FOREIGN KEY (convenio) REFERENCES Tb_convenio(codigo)
);

INSERT INTO Tb_convenio_servico (
    convenio,
    servico
) VALUES (
    2,
    "Obra de restauração da praça"
), (
    2,
    "Manutenção de computadores do escritório"
), (
    3,
    "Serviços de limpeza do prédio"
);

CREATE TABLE Tb_contrato (
    codigo INT NOT NULL AUTO_INCREMENT,
    prazo DATE NOT NULL,
    valor DECIMAL(10,2) NOT NULL,
    data_inclusao TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    convenio_servico INT NOT NULL,
    PRIMARY KEY (codigo),
    FOREIGN KEY (convenio_servico) REFERENCES Tb_convenio_servico(codigo)
);

INSERT INTO Tb_contrato (
    prazo,
    valor,
    convenio_servico
) VALUES (
    "2023-09-23",
    599.78,
    3
), (
    "2023-11-30",
    767.12,
    3
), (
    "2023-08-11",
    381.44,
    1
);