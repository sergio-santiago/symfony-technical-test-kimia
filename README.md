# Symfony Technical Test (Kimia)

Technical test built for Kimia: a small football minigame backed by a CRUD for the
teams and players it draws from.

The original requirements are in
[doc/REQUISITES_SymfonyTechnicalTestKimia.pdf](https://github.com/sergio-santiago/symfony-technical-test-kimia/blob/main/doc/REQUISITES_SymfonyTechnicalTestKimia.pdf).
This file summarises what the code actually does.

## Stack

- PHP 7.2.5+ and Symfony 5.2
- Doctrine ORM with MySQL and a migration to create the schema
- Twig for templates, plus vanilla JavaScript for the game
- Docker Compose for the whole environment

## What it does

- **CRUD for teams** (`TeamController`) and **players** (`PlayerController`), with
  Doctrine entities and Symfony forms
- **The minigame** (`GameController`) renders a form and exposes an AJAX endpoint
  that picks 10 random players and returns them as JSON, serialised through a
  dedicated `players_serialization` group so only the intended fields travel

## Running it locally

```bash
docker-compose up -d
composer install
php bin/console doctrine:migrations:migrate
```

## Status

Archived. It was a one off technical test and is kept as a work sample.
