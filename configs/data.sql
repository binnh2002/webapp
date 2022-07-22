create database 0905b;

use 0905b;

create table producer
(
	producerID int auto_increment primary key,
    producerName varchar(30) not null unique
);

create table product
(
	productID varchar(5) not null primary key,
    productName varchar(50) not null,
    productPrice int not null,
    productDetails varchar(3000) null,
    productImage1 varchar(30) not null,
    productImage2 varchar(30) null,
    productImage3 varchar(30) null,
    producerID int not null,
    constraint foreign key (producerID) references producer(producerID)
);

-- insert data

insert into producer(producerName) values
('Samsung'), ('Apple'), ('LG'), ('Nokia'), ('Xiaomi'), ('Oppo');

select * from producer;

insert into product(productID, productName, productPrice, productImage1, producerID) values
('P001', 'Samsung Galaxy S22', 550, 'product01.jpg', 1),
('P002', 'iPhone 13 Pro', 1000, 'product02.jpg', 2),
('P003', 'LG G5', 100, 'product03.jpg', 3);
