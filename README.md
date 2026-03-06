# Microservice System

Example project demonstrating a simple **microservice architecture**.

## Stack

* **Laravel** – gateway service
* **RabbitMQ** – message broker
* **Go** – notification microservice
* **Mailpit** – local SMTP testing

## Architecture

```
User
 │
 ▼
Laravel Gateway
 │
 │ publish event
 ▼
RabbitMQ
 │
 │ consume event
 ▼
Go Notification Service
 │
 ▼
Email (Mailpit)
```

## Project Structure

```
microservice-system
│
├─ gateway-service        # Laravel application
├─ notification-service   # Go notification microservice
```

## Event Flow

```
User registration
      │
      ▼
Laravel publishes event → RabbitMQ
      │
      ▼
Go service consumes event
      │
      ▼
Email with activation link is sent
```

## Purpose

This project demonstrates:

* event-driven architecture
* communication between microservices
* asynchronous processing using RabbitMQ
* multi-language backend stack (PHP + Go)
