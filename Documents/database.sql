#Quyền truy cập
CREATE TABLE permissions(
	id INT AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(255) NOT NULL,
	display_name VARCHAR(255) ,
	permission_group VARCHAR(255) NOT NULL
);

#Vai trò người dùng
CREATE TABLE roles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    display_name VARCHAR(255) ,
	role_group  VARCHAR(255) NOT NULL
);

# 1 vai trò có thể làm nhiều quyền
CREATE TABLE permission_role (
	id INT AUTO_INCREMENT PRIMARY KEY,
    permission_id INT,
    role_id INT,
    FOREIGN KEY (permission_id) REFERENCES permissions(id),
    FOREIGN KEY (role_id) REFERENCES roles(id)
);


CREATE TABLE users (
   id INT AUTO_INCREMENT PRIMARY KEY,
    fullname VARCHAR(255),
    birthOfDay DATE,
    gender VARCHAR(10),
    email VARCHAR(50) UNIQUE,
    phone VARCHAR(20),
    address_defaultid INT,
	avatar VARCHAR(1000),
     password VARCHAR(255) NOT NULL,
    status TINYINT(1) DEFAULT 0,	
    coin FLOAT DEFAULT 0,
  createdat DATE DEFAULT CURDATE()
);


#Mỗi người dùng có thể có nhiều vai trò
CREATE TABLE role_user (
	id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    role_id INT,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (role_id) REFERENCES roles(id)
);

CREATE TABLE categories(
	id INT AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(255) NOT NULL
);


CREATE TABLE products(
	id INT AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(255) NOT NULL,
	description TEXT NOT NULL,
	price DOUBLE,
	sale DOUBLE,
	rate FLOAT DEFAULT 5,
	createdat DATE DEFAULT CURDATE()
);

CREATE TABLE images(
	id INT AUTO_INCREMENT PRIMARY KEY,
	url TEXT NOT NULL,
	imgtable_id INT,
	imgable_type VARCHAR(255) NOT NULL,
	FOREIGN KEY (imgtable_id) REFERENCES products(id)
);

CREATE TABLE category_product(
	id INT AUTO_INCREMENT PRIMARY KEY,
	category_id INT,
	product_id INT,
	FOREIGN KEY (category_id) REFERENCES categories(id),
    FOREIGN KEY (product_id) REFERENCES products(id)
);

CREATE TABLE product_details(
	id INT AUTO_INCREMENT PRIMARY KEY,
	product_id INT NOT NULL,
	color VARCHAR(255) NOT NULL,
	quantity INT,
	FOREIGN KEY (product_id) REFERENCES products(id)
);


CREATE TABLE carts(
	id INT AUTO_INCREMENT PRIMARY KEY, 
	user_id INT,
	FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE cart_details(
	id INT AUTO_INCREMENT PRIMARY KEY,
	cart_id INT,
	product_id INT,
	color VARCHAR(255) NOT NULL,
	quantity INT,
	FOREIGN KEY (cart_id) REFERENCES carts(id),
	FOREIGN KEY (product_id) REFERENCES products(id)
);

CREATE TABLE vouchers(
	id INT AUTO_INCREMENT PRIMARY KEY, 
	name VARCHAR(255) NOT NULL,
	DESCRIPTION VARCHAR(255) NOT NULL,
	discount DOUBLE,
	TYPE VARCHAR(255) NOT NULL,
	quantity INT NOT NULL,
	start_time DATETIME NOT NULL,
	end_time DATETIME NOT NULL
	
);

CREATE TABLE paymentmethods(
	id INT AUTO_INCREMENT PRIMARY KEY, 
	icon TEXT NOT NULL,
	display_name VARCHAR(255) NOT NULL
);

CREATE TABLE orders(
	id INT AUTO_INCREMENT PRIMARY KEY, 
	user_id INT,
	orderdate DATETIME DEFAULT NOW(),
	total DOUBLE,
	voucher_id INT,
	feeship FLOAT,
	totalmoney DOUBLE,
	customer_receive VARCHAR(1000) NOT NULL,
	status VARCHAR(255) NOT NULL,
	methodpayment_id INT,
	FOREIGN KEY (methodpayment_id) REFERENCES paymentmethods(id),
	FOREIGN KEY (user_id) REFERENCES users(id),
	FOREIGN KEY (voucher_id) REFERENCES vouchers(id)
);

CREATE TABLE order_details(
	id INT AUTO_INCREMENT PRIMARY KEY,
	product_id INT,
	order_id INT,
	color VARCHAR(255) NOT NULL,
	quantity INT,
	price DOUBLE,
	 FOREIGN KEY (product_id) REFERENCES products(id),
	 FOREIGN KEY (order_id) REFERENCES orders(id)
);
