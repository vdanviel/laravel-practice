# Some-Practice

## Descrição
Some-Practice é um projeto desenvolvido em Laravel e Bootstrap 5, que serve tanto como uma prática pessoal no framework quanto como uma aplicação que pode ser utilizada profissionalmente. O objetivo principal do projeto é criar um mini e-commerce para a venda de produtos digitais.

## Recursos
- Integração com a API do Stripe para processamento de pagamentos.
- Utilização da API da ViaCEP para obter informações de localização do usuário.
- Tecnologia de envio de e-mails usando o Laravel Mail.
- Interface desenvolvida com Bootstrap 5 e Blade, o mecanismo de templates do Laravel.

## Funcionalidades
1. Pagamentos com o Stripe: O projeto Some-Practice utiliza a página de checkout de teste do Stripe para processar pagamentos. Os usuários podem realizar pagamentos utilizando cartões de crédito ou débito de forma rápida e segura.

2. Localização do usuário com ViaCEP: Através da API da ViaCEP, o projeto permite que os usuários informem seu CEP e obtenham informações detalhadas sobre sua localização, como cidade, estado, bairro, etc. Essas informações são utilizadas para fins de entrega ou personalização da experiência do usuário.

3. Envio de e-mails: O Laravel Mail é utilizado no projeto para enviar e-mails. É possível configurar e personalizar facilmente o envio de e-mails, fornecendo uma forma rápida e segura de se comunicar com os usuários.

## Como utilizar o projeto
1. Clone o repositório do Some-Practice em sua máquina.
2. Execute o comando `composer install` para instalar as dependências do Laravel.
3. Configure as chaves de API do Stripe e da ViaCEP no arquivo `.env`.
4. Execute as migrações do banco de dados usando o comando `php artisan migrate`.
5. Inicie o servidor de desenvolvimento do Laravel com o comando `php artisan serve`.
6. Acesse a aplicação no navegador usando a URL fornecida pelo servidor de desenvolvimento.
