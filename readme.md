# Intro

This repository contains example implementation within Symfony Framework of Achitecture patterns such as:

- Modular monolith
- Hexagonal architecture
- Onion architecture
- Clean architecture
- DDD
- CQRS
- Event Driven Architecture

You can find here, how to implement those patterns in Symfony and how to use them in real life projects.

### Modules

On the highest level we have independent modules. By default modules represents bounded contexts.

Module structure follow architectural principles from patterns like Hexagonal or clean architecture, separating domain
and infrastructure layers.

Modules communicate through plugins, which provides clear boundaries and data translation layer.

### Domain Separation

Main principle of architecture patterns like Clean architecture by Robert C. Martin or Hexagonal architecture is
separating domain code from technical aspects like database etc.
Its done by creating domain layer, which is independent from infrastructure layer.
In the Domain layer we have only business logic, which is independent from technical details.
We achieve this by using interfaces and dependency inversion principle.
For example, we have interface for repository, which is implemented by infrastructure layer.

To config symfony to see entities in domain directory, we need to add configuration to doctrine.yaml file:

    orm:
        auto_mapping: true
        mappings:
            App:
                is_bundle: false
                type: annotation
                dir: '%kernel.project_dir%/src/Module/Domain/Entity'
                prefix: 'App\Module\Domain\Entity'
                alias: Module

### CQRS

Commands and Commands handlers are located within Application directory.
Queries and Query Handlers are located within ReadModel directory.

They use bus pattern to dispatch commands and queries.
Technical implementation of buses is based on Symfony Messenger component.

### Event Driven Architecture

Events helps us to decouple our modules and make them independent from each other.
We can use events to communicate between modules, but also to communicate with external systems.
Events signals that something happened in our system and we can react to it.
Event communication is implemented by using Symfony Messenger component.
In each Modules we can have handlers for events, which are triggered by other modules.