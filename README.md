<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>




---

# Grocery Store - ERD

This section contains the **Entity Relationship Diagram (ERD)** for our Grocery Store project.

```mermaid
erDiagram
    USERS {
        int id PK
        string name
        string email
        string password
        string phone
        text address
        string role
        string status
    }

    CATEGORIES {
        int id PK
        string name
        string image
    }

    SUBCATEGORIES {
        int id PK
        int category_id FK
        string name
    }

    PRODUCTS {
        int id PK
        string name
        text description
        decimal price
        decimal discount
        int stock
        string unit
        int category_id FK
        int subcategory_id FK
    }

    ORDERS {
        int id PK
        int user_id FK
        decimal total
        string status
        datetime created_at
    }

    ORDER_ITEMS {
        int id PK
        int order_id FK
        int product_id FK
        int quantity
        decimal price
    }

    PAYMENTS {
        int id PK
        int order_id FK
        string method
        decimal amount
        string status
    }

    USERS ||--o{ ORDERS : "places"
    ORDERS ||--o{ ORDER_ITEMS : "contains"
    PRODUCTS ||--o{ ORDER_ITEMS : "included_in"
    CATEGORIES ||--o{ PRODUCTS : "has"
    SUBCATEGORIES ||--o{ PRODUCTS : "has"
    ORDERS ||--|| PAYMENTS : "paid_by"
    CATEGORIES ||--o{ SUBCATEGORIES : "has"
