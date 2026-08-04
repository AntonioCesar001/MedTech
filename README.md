# MedTech

<p align="center">
  <img src="https://img.shields.io/badge/PHP-8.x-777BB4?style=for-the-badge&logo=php&logoColor=white">
  <img src="https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white">
  <img src="https://img.shields.io/badge/Composer-885630?style=for-the-badge&logo=composer&logoColor=white">
  <img src="https://img.shields.io/badge/MVC-Arquitetura-blue?style=for-the-badge">
</p>

##  Sobre o Projeto

O **MedTech** é um sistema web desenvolvido para auxiliar na administração de instituições de saúde, permitindo o gerenciamento de profissionais, departamentos, unidades, escalas de trabalho, plantões e relatórios.

Este projeto foi desenvolvido **em grupo** como **Trabalho de Conclusão de Curso (TCC)** do curso **Técnico em Desenvolvimento de Sistemas** do **SENAI**, com o objetivo de aplicar, na prática, os conhecimentos adquiridos durante a formação, utilizando boas práticas de desenvolvimento de software e a arquitetura **MVC (Model-View-Controller)**.

O sistema foi desenvolvido utilizando **PHP**, juntamente com outras tecnologias como **MySQL**, **HTML**, **CSS**, **JavaScript** e **Composer**, buscando oferecer uma aplicação organizada, escalável e de fácil manutenção.

---

#  Funcionalidades

- 👤 Cadastro e autenticação de usuários
- 🔐 Recuperação de senha por e-mail
- 🏥 Cadastro de Unidades de Saúde
- 🏢 Cadastro de Departamentos
- 👨‍⚕️ Cadastro de Funcionários
- 📅 Gerenciamento de Escalas
- 🩺 Controle de Plantões
- 📊 Emissão de Relatórios
- 🔎 Consulta de informações cadastradas

---

#  Tecnologias Utilizadas

- PHP
- MySQL
- HTML5
- CSS3
- JavaScript
- Composer
- PHPMailer

---

#  Estrutura do Projeto

```
MedTech
│
├── Source
│   ├── Controllers
│   ├── Models
│   ├── Views
│   ├── Core
│   └── Test
│
├── Manual
│   ├── Manual.html
│   └── img
│
├── vendor
├── index.php
├── composer.json
└── README.md
```

---

#  Arquitetura

O projeto utiliza o padrão MVC.

- **Models** → Regras de negócio e acesso ao banco.
- **Views** → Interface do usuário.
- **Controllers** → Intermediário entre usuário e sistema.
- **Core** → Classes base da aplicação.

---

#  Requisitos

- PHP 8.0 ou superior
- MySQL
- Apache (XAMPP, WampServer ou Laragon)
- Composer

---

#  Instalação

Clone o projeto

```bash
git clone https://github.com/AntonioCesar001/MedTech.git
```

Entre na pasta

```bash
cd MedTech
```

Instale as dependências

```bash
composer install
```

Configure o banco de dados na classe:

```
Source/Core/Connect.php
```

Depois execute o projeto em um servidor Apache.

---

#  Módulos

## Usuários

- Login
- Cadastro
- Recuperação de senha

## Funcionários

- Cadastro
- Consulta
- Controle de informações

## Unidades

- Cadastro
- Consulta

## Departamentos

- Cadastro
- Gerenciamento

## Escalas

- Cadastro
- Organização das escalas

## Plantões

- Cadastro
- Controle dos plantões

## Relatórios

- Visualização
- Emissão de relatórios

---

#  Manual

O projeto possui um manual localizado em:

```
Manual/
```

Para visualizar:

```
Manual/Manual.html
```

O manual apresenta imagens e instruções de utilização do sistema.

---

#  Recuperação de Senha

O envio de e-mails é realizado utilizando a biblioteca **PHPMailer**.

---

#  Telas do Sistema

O projeto possui imagens das seguintes telas:

- Login
- Cadastro
- Painel Principal
- Funcionários
- Departamentos
- Unidades
- Escalas
- Plantões
- Relatórios

Todas disponíveis na pasta:

```
Manual/img
```

---

#  Autores

**Antonio César**
| **Ezequias Barreto**
| **Edmo Gibson**
| **Herbet Santos**

---

#  Licença

Projeto desenvolvido para fins acadêmicos.
