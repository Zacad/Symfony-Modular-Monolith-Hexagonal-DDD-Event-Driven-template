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

## Directory structure

On the highest level we have independent modules. Each module communicates with each other via interfaces. Modules
communicate with each other via commands, queries and events.
By default modules represents bounded contexts.

Module structure follow architectural principles from patterns like Hexagonal or clean architecture, separating domain
and infrastructure layers.

## CQRS

Commands and Commands handlers are located within Application directory.
Queries and Query Handlers are located within ReadModel directory.

They use bus pattern to dispatch commands and queries.
Technical implementation of buses is based on Symfony Messenger component.