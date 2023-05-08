CREATE TABLE customers (
  customer_id INT PRIMARY KEY,
  first_name VARCHAR(50) NOT NULL,
  last_name VARCHAR(50) NOT NULL,
  email VARCHAR(100) NOT NULL,
  phone_number VARCHAR(20),
  address VARCHAR(200) NOT NULL,
  city VARCHAR(50) NOT NULL,
  state VARCHAR(50) NOT NULL,
  password_hash VARCHAR NOT NULL,
  zip_code VARCHAR(10) NOT NULL
);

CREATE TABLE admins (
  admin_id INT PRIMARY KEY,
  username VARCHAR(100) NOT NULL,
  password_hash VARCHAR NOT NULL,
);

CREATE TABLE orders (
  order_id INT PRIMARY KEY,
  customer_id INT NOT NULL,
  order_date DATETIME NOT NULL,
  total DECIMAL(10, 2) NOT NULL,
  payment_type_id INT NOT NULL,
  order_state_id INT NOT NULL,
  FOREIGN KEY (customer_id) REFERENCES customers(customer_id),
  FOREIGN KEY (payment_type_id) REFERENCES payment_types(payment_type_id)
  FOREIGN KEY (order_state_id) REFERENCES order_states(order_state_id)
);

CREATE TABLE order_items (
  order_item_id INT PRIMARY KEY,
  order_id INT NOT NULL,
  product_id INT NOT NULL,
  configuration_id INT NOT NULL,
  quantity INT NOT NULL,
  price DECIMAL(10, 2) NOT NULL,
  FOREIGN KEY (order_id) REFERENCES orders(order_id),
  FOREIGN KEY (product_id) REFERENCES products(product_id),
  FOREIGN KEY (configuration_id) REFERENCES product_configurations(configuration_id)
);

CREATE TABLE products (
  product_id INT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  description TEXT NOT NULL,
  price DECIMAL(10, 2) NOT NULL,
  available INT NOT NULL,
  image_url VARCHAR(200) NOT NULL
);

CREATE TABLE categories (
  category_id INT PRIMARY KEY,
  name VARCHAR(50) NOT NULL
);

CREATE TABLE product_categories (
  product_category_id INT PRIMARY KEY,
  product_id INT NOT NULL,
  category_id INT NOT NULL,
  FOREIGN KEY (product_id) REFERENCES products(product_id),
  FOREIGN KEY (category_id) REFERENCES categories(category_id)
);

CREATE TABLE product_configurations (
  configuration_id INT PRIMARY KEY,
  product_id INT NOT NULL,
  price DECIMAL(10, 2) NOT NULL,
  available INT NOT NULL,
  configuration_name VARCHAR(50) NOT NULL,
  description TEXT NOT NULL,
  FOREIGN KEY (product_id) REFERENCES products(product_id)
);

CREATE TABLE shopping_carts (
  cart_id INT PRIMARY KEY,
  customer_id INT NOT NULL,
  creation_date DATETIME NOT NULL,
  FOREIGN KEY (customer_id) REFERENCES customers(customer_id)
);

CREATE TABLE cart_items (
  cart_item_id INT PRIMARY KEY,
  cart_id INT NOT NULL,
  product_id INT NOT NULL,
  configuration_id INT NOT NULL,
  quantity INT NOT NULL,
  price DECIMAL(10, 2) NOT NULL,
  FOREIGN KEY (cart_id) REFERENCES shopping_carts(cart_id),
  FOREIGN KEY (product_id) REFERENCES products(product_id),
  FOREIGN KEY (configuration_id) REFERENCES product_configurations(configuration_id)
);

CREATE TABLE payment_types (
  payment_type_id INT PRIMARY KEY,
  name VARCHAR(50) NOT NULL
);


CREATE TABLE order_states (
  order_state_id INT PRIMARY KEY,
  name VARCHAR(50) NOT NULL
);
