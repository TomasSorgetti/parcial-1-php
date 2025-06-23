# TABLAS SQL

## View

id INT, UNSIGNED, PRIMARY KEY, AUTO_INCREMENT
name VARCHAR(100) NOT NULL

## Category

id INT, UNSIGNED, PRIMARY KEY, AUTO_INCREMENT
name VARCHAR(100) NOT NULL

## Brand

id INT, UNSIGNED, PRIMARY KEY, AUTO_INCREMENT
name VARCHAR(100) NOT NULL

## Product

id INT, PRIMARY KEY, AUTO_INCREMENT
id_category INT, FOREIGN KEY, NOT NULL
id_brand INT, FOREIGN KEY
title VARCHAR(150) NOT NULL
image VARCHAR(256)
description TEXT
stock INT
price DECIMAL(10,2)
offer_price DECIMAL(10,2), NULL

## tag

id INT, UNSIGNED, PRIMARY KEY, AUTO_INCREMENT
name VARCHAR(100), NOT NULL

## user

id INT, UNSIGNED, PRIMARY KEY, AUTO_INCREMENT
username VARCHAR(60) NOT NULL UNIQUE
email VARCHAR(100) NOT NULL UNIQUE
password VARCHAR(256)
role ENUM('user', 'admin', 'superadmin')

## product_tag

id INT, UNSIGNED, PRIMARY KEY, AUTO_INCREMENT
id_product INT, FOREIGN KEY
id_tag INT, FOREIGN KEY

### Relaciones entre tablas

#### Uno a muchos

Category-Product: Un producto pertenece a una sola categoría, y una categoría puede estar asociada a muchos productos.

Brand-Product: Un producto tiene una sola marca, y una marca puede estar asociada a muchos productos.

#### Muchos a muchos

Product-tag: Un producto puede tener múltiples etiquetas, y una etiqueta puede estar asociada a múltiples productos.
