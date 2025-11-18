# 📡 Sistema de Controle de Acesso RFID  
**ESP32 + RFID RC522 + Aplicação Web PHP + MariaDB**  
**Desenvolvido por: João Vitor Nepomuceno Máximo**

---

## 📘 Sobre o Projeto
Este projeto implementa um **sistema completo de controle de acesso por RFID**, utilizando:

- **ESP32**
- **Módulo RFID-RC522**
- **Etiquetas MIFARE Classic 1K**
- **Aplicação Web em PHP**
- **Banco de dados MariaDB**
- **Segurança orientada à LGPD** (dados sensíveis separados dos UID RFID)

O sistema permite:
- Cadastro de alunos
- Cadastro de etiquetas RFID
- Dashboard administrativo
- Registro automático de acessos via Arduino
- Listagem completa com filtros (nome, matrícula, datas)
- Logs armazenados em banco separado

---

# 🏗️ Arquitetura Geral

[RFID Tag] --UID--> [ESP32 + RC522] --HTTP--> [API PHP] --INSERT--> [rfid_tags.access_logs]

                                 [Dashboard PHP] <-----> [rfid_students.students]
                                                         [rfid_tags.tags]
                                                         [rfid_tags.access_logs]


---

# 🔐 Segurança — Separação dos Bancos (LGPD)
Para proteger dados sensíveis, a aplicação utiliza **dois bancos de dados independentes**:

### 📘 Banco 1 → `rfid_students`
Contém informações pessoais:
- ID
- Nome
- Matrícula
- Curso

### 📗 Banco 2 → `rfid_tags`
Contém apenas dados técnicos:
- UID RFID
- Referência do aluno (ID numérico)
- Registros de acesso

Essa separação impede que um vazamento dos logs revele dados pessoais do aluno.

---

# 🗂️ Estrutura de Pastas do Repositório

```text
rfid-access-control/
│
├── rfid-app/
│   ├── config/
│   ├── includes/
│   └── public/
│
├── sql/
│   ├── schema_students.sql
│   ├── schema_tags.sql
│   └── test_data.sql
│
├── arduino/
│   └── rfid_reader_ethernet/
│       └── rfid_reader_ethernet.ino
│
├── .gitignore
└── README.md
```


---

