# Padrão de Projeto Estrutural: Adapter

Este documento detalha os passos executados para a implementação do padrão de projeto estrutural Adapter em PHP, demonstrando a integração entre interfaces incompatíveis.

## 1. Clonagem do Repositório
O projeto base foi obtido a partir do repositório de design patterns em PHP.

```bash
git clone https://github.com/DesignPatternsPHP/DesignPatternsPHP.git
cd DesignPatternsPHP
```

## 2. Instalação de Dependências
As dependências do projeto foram preparadas garantindo o ambiente correto com o PHP e o gerenciador de pacotes.

```bash
composer install
```

## 3. Mapeamento do Domínio
Os componentes do diretório `Structural/Adapter` foram analisados para compreender as responsabilidades de cada classe e interface:
* **Book (Target):** Interface que define o contrato padrão exigido pelo código cliente (métodos: `open()`, `turnPage()`, `getPage(): int`).
* **PaperBook:** Classe concreta padrão que implementa e obedece diretamente à interface `Book`.
* **EBook (Adaptee Interface):** Interface do sistema externo ou biblioteca de terceiros. Seus métodos possuem assinaturas distintas (`unlock()`, `pressNext()`, `getPage(): array`).
* **Kindle:** Classe concreta que simula o leitor digital, implementando os comportamentos do `EBook`.

## 4. Identificação do Conflito
O código cliente consome objetos baseados no contrato `Book`. Contudo, é impossível injetar diretamente uma instância de `Kindle`, pois os nomes dos métodos (`unlock` vs `open`) e os tipos de retorno (`array` vs `int` no `getPage`) divergem estruturalmente.

## 5. Criação da Classe Adaptadora
Foi criado o arquivo `EBookAdapter.php` no diretório `Structural/Adapter/`. O objetivo principal deste arquivo é agir como um encapsulador (wrapper) que traduz os requisitos do cliente para as ações correspondentes no sistema adaptado.

## 6. Implementação do Contrato e Composição
O fluxo final de integração foi desenvolvido aplicando composição e injeção de dependência na classe `EBookAdapter`:
* **Implementação do Contrato:** A classe assina a interface `Book`.
* **Injeção de Dependência:** O construtor recebe uma instância do tipo `EBook`.
* **Tradução das Chamadas:**
  * O método `open()` invoca `$this->eBook->unlock()`.
  * O método `turnPage()` invoca `$this->eBook->pressNext()`.
  * O método `getPage()` recebe o array do comportamento adaptado (`[página_atual, total_páginas]`), extrai o valor do primeiro índice e o retorna como um tipo primitivo `int`.

## 7. Adequações Finais de Tipagem
Para garantir a consistência do projeto e evitar coerções de tipo indesejadas, a declaração de tipagem estrita `declare(strict_types=1);` foi assegurada no início da implementação do adaptador, seguindo a convenção adotada nas demais interfaces e classes do domínio.
