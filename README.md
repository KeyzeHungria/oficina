# Sistema de Gerenciamento de Oficina Mecânica

Este repositório contém o código-fonte do projeto de Sistema de Gerenciamento de Oficina Mecânica, desenvolvido com PHP. O projeto foi estruturado em iterações ao longo do tempo, com o objetivo de entregar funcionalidades de forma incremental, utilizando boas práticas de desenvolvimento. Este sistema é destinado a uso em ambiente local (localhost) e não possui hospedagem online.

## 🔄 Release 1

### ✅ Iteração 1: Configuração Inicial e Desenvolvimento Básico
📅 **Data:** 27/04/2025 a 11/05/2025   
🎯 **Objetivo:** Estabelecer as bases do projeto e implementar funcionalidades essenciais para o cadastro de clientes, veículos, produtos, funcionários e usuários.

#### Atividades:
1. Configuração do Ambiente: Configuração da IDE, versionamento de código e ambientes de teste.
2. Estrutura do Projeto: Criação da estrutura básica do projeto, incluindo organização de pastas e arquivos.
3. Cadastro de Usuários: Desenvolvimento de telas e lógica para permitir que usuários sejam cadastrados no sistema.
4. Cadastro de Clientes, Produtos, Veículos e Funcionários: Desenvolvimento de telas e lógica para permitir o cadastro de clientes, veículos, produtos e funcionários por parte dos usuários.

--- 

### 🛠️ Iteração 2: Desenvolvimento de Funcionalidades Principais
📅 **Data:** 12/05/2025 a 01/06/2025  
🎯 **Objetivo:** Implementar as funcionalidades principais relacionadas à realização de agendamento de horários e gerenciamento de serviços.

#### Atividades:
1. Agendamento de Serviços: Implementação da funcionalidade para os usuários agendarem serviços mecânicos associados a clientes e veículos.
2. Gerenciamento de Serviços: Desenvolvimento de funcionalidades essenciais para os usuários controlarem e visualizarem o status dos serviços.
3. Controle Financeiro Inicial: Integração de uma funcionalidade destinada ao armazenamento de dados básicos sobre os pagamentos realizados na oficina.

---

### 📈 Iteração 3: Refinamento e Melhorias
📅 **Data:** 02/06/2025 a 29/06/2025  
🎯 **Objetivo:** Refinar funcionalidades existentes com base no feedback dos usuários e adicionar novas funcionalidades, como notificações de estoque e funcionalidades de gestão integrada.

#### Atividades:
1. Refinamento com Feedback: Revisão de funcionalidades existentes e ajustes com base no feedback dos usuários.
2. Notificações de Estoque Baixo: Implementação de sistema de notificações para a oficina sobre estoque baixo de peças e materiais.
3. Gestão Integrada: Adição de funcionalidades de gestão de estoque, clientes, veículos e funcionários para a oficina.
4. Geração de Relatórios Financeiros: Atualização das funcionalidades existentes para a emissão de faturas detalhadas para os clientes. Implementação de registro de pagamentos, controle de contas a receber e a geração de relatórios financeiros para análise do desempenho econômico da oficina.

---

### 🚀 Iteração 4: Testes Finais e Preparação para Lançamento
📅 **Data:** 30/06/2025 a 30/07/2025  
🎯 **Objetivo:** Realizar testes finais, corrigir problemas identificados e preparar o sistema para o lançamento.

#### Atividades:
1. Testes de Integração e Aceitação: Realização de testes finais para garantir que todas as funcionalidades estejam operando corretamente em conjunto.
2. Correção de Bugs: Identificação e correção de quaisquer problemas ou bugs encontrados durante os testes.
3.Preparação para Lançamento: Finalização da documentação básica para o usuário, preparação do ambiente de uso local e revisão final do sistema antes da entrega.

---

## 📦 Pacotes/Bibliotecas Utilizadas

O projeto utilizou: PDO (PHP Data Objects)


---

## 📁 Estrutura de Pastas

```bash
OficinaMecanica/
├── config/             
├── controller/        
├── img/               
├── model/              
├── view/               
├── agendamento.php    
├── cadastraradmin.php  
├── cliente.php        
├── funcionario.php     
├── index copy.php      
├── index.php
├── item_servico.php
├── login.php  
├── logout.php    
├── menu.php     
├── menulogin.php   
├── pagamento.php 
├── produto.php    
├── relatorioEstoque.php 
├── servico.php   
├── servico_funcionario.php
├── tipo_pagamento.php
├── usuario.php  
└── veiculo.php           
```

---

## 🧪 Testes

Foram realizados testes manuais e/ou testes de integração onde as funcionalidades foram testadas com o banco de dados e outros componentes reais.

---

## 📝 Licença

Este projeto não possui uma licença de código aberto formal e destina-se a uso exclusivo escolar e em ambiente local.
