CREATE TABLE city (
  id int(7) NOT NULL AUTO_INCREMENT,
  name varchar(50) NOT NULL,
  url_name varchar(50) NOT NULL,
  PRIMARY KEY (id)
);

CREATE TABLE zona (
  id int(7) NOT NULL AUTO_INCREMENT,
  name varchar(50) NOT NULL,
  refCity int(7) NOT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (refCity) REFERENCES city(id)
);

CREATE TABLE delivery_price (
  id int(7) NOT NULL AUTO_INCREMENT,
  price varchar(5) NOT NULL,
  bonus varchar(5) NOT NULL,
  discount varchar(5) NOT NULL,
  refZona int(7) NOT NULL,
  refRest int(7) NOT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (refZona) REFERENCES zona(id),
  FOREIGN KEY (refRest) REFERENCES restaurant(id)
);

CREATE TABLE restaurant (
  id int(7) NOT NULL AUTO_INCREMENT,
  name varchar(100) NOT NULL,
  title varchar(100) NOT NULL,
  url_name varchar(50) NOT NULL,
  description text DEFAULT NULL,
  extra_info text DEFAULT NULL,
  min_price varchar(5) NOT NULL,
  delivery_price varchar(5) NOT NULL,
  delivery_time int(3) NOT NULL,
  card_payment int(1) NOT NULL,
  online_payment int(1) NOT NULL,
  special int(1) NOT NULL,
  rate int(1) DEFAULT NULL,
  num_rate int(6) DEFAULT NULL,
  address varchar(255) DEFAULT NULL,
  tel varchar(255) DEFAULT NULL,
  gps varchar(255) NOT NULL,
  schedule varchar(255) NOT NULL,
  holiday varchar(255) NOT NULL,
  logo varchar(255) DEFAULT NULL,
  usercounter int(6) DEFAULT NULL,
  startdate timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  enddate timestamp DEFAULT '0000-00-00 00:00:00',
  renewdate timestamp DEFAULT '0000-00-00 00:00:00',
  contract_type int(1) DEFAULT NULL,
  public int(1) NOT NULL,
  refCity int(7) NOT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (refCity) REFERENCES city(id)
);

CREATE TABLE cuisine_type (
  id int(7) NOT NULL AUTO_INCREMENT,
  name varchar(30) NOT NULL,
  PRIMARY KEY (id)
);

CREATE TABLE rest_cuisine_type (
  id int(7) NOT NULL AUTO_INCREMENT,
  refRest int(7) NOT NULL,
  refCuisine int(7) NOT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (refRest) REFERENCES restaurant(id),
  FOREIGN KEY (refCuisine) REFERENCES cuisine_type(id)
);

CREATE TABLE `user` (
  id int(7) NOT NULL AUTO_INCREMENT,
  name varchar(50) NOT NULL,
  username varchar(30) NOT NULL,
  email varchar(50) NOT NULL,
  password varchar(255) NOT NULL,
  tel varchar(20) NOT NULL,
  nif varchar(9),
  points int(7),
  status varchar(10),
  creation_date varchar(100),
  last_login varchar(100),
  facebook varchar(100),
  PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS `tokens` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(255) NOT NULL,
  `user_id` int(10) NOT NULL,
  `created` date NOT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE user_address (
  id int(7) NOT NULL AUTO_INCREMENT,
  default_address boolean NOT NULL,
  city varchar(50) NOT NULL,
  id_zone int(3) NOT NULL,
  address varchar(200) NOT NULL,
  refUser int(7) NOT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (refUser) REFERENCES user(id)
);

CREATE TABLE user_phone (
  id int(7) NOT NULL AUTO_INCREMENT,
  default_phone boolean NOT NULL,
  number varchar(50) NOT NULL,
  refUser int(7) NOT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (refUser) REFERENCES user(id)
);

CREATE TABLE comment (
  id int(7) NOT NULL AUTO_INCREMENT,
  comment varchar(255) NOT NULL,
  class int(1) NOT NULL,
  date_time timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  refRest int(7) NOT NULL,
  refUser int(7) NOT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (refRest) REFERENCES restaurant(id),
  FOREIGN KEY (refUser) REFERENCES user(id)
);

CREATE TABLE favorite (
  id int(7) NOT NULL AUTO_INCREMENT,
  refRest int(7) NOT NULL,
  refUser int(7) NOT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (refRest) REFERENCES restaurant(id),
  FOREIGN KEY (refUser) REFERENCES user(id)
);

CREATE TABLE `order` (
  id int(7) NOT NULL AUTO_INCREMENT,
  num_order int(7) NOT NULL,
  price varchar(7) NOT NULL,
  discount varchar(7),
  date_time timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  refUser int(7) NOT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (refUser) REFERENCES user(id)
);

CREATE TABLE user_commerce (
  id int(7) NOT NULL AUTO_INCREMENT,
  name varchar(50) NOT NULL,
  type varchar(15) NOT NULL,
  username varchar(30) NOT NULL,
  password varchar(255) NOT NULL,
  tel varchar(20) NOT NULL,
  email varchar(50) NOT NULL,
  nif varchar(9) NOT NULL,
  PRIMARY KEY (id)
);

CREATE TABLE rest_user (
  id int(7) NOT NULL AUTO_INCREMENT,
  public int(1) NOT NULL,
  refRest int(7) NOT NULL,
  refUser int(7) NOT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (refRest) REFERENCES restaurant(id),
  FOREIGN KEY (refUser) REFERENCES user_commerce(id)
);

CREATE TABLE category (
  id int(7) NOT NULL AUTO_INCREMENT,
  cat int(2) NOT NULL, 
  sub_cat int(2),
  public int(1) NOT NULL,
  refRest int(7) NOT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (refRest) REFERENCES restaurant(id)
);

CREATE TABLE cat_name (
  id int(7) NOT NULL AUTO_INCREMENT,
  name varchar(50) NOT NULL,
  description varchar(255) NOT NULL,
  lang varchar(5) NOT NULL,
  refCat int(7) NOT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (refCat) REFERENCES category(id)
);

CREATE TABLE product (
  id int(7) NOT NULL AUTO_INCREMENT,
  extra int(1) NOT NULL DEFAULT 0,
  public int(1) NOT NULL,
  type varchar(30) NOT NULL,
  refCat int(7) NOT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (refCat) REFERENCES category(id)
);

CREATE TABLE extra_product (
  id int(7) NOT NULL AUTO_INCREMENT,
  price varchar(10) NOT NULL,
  refProd int(7) NOT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (refProd) REFERENCES product(id)
);

CREATE TABLE extra_product_name (
  id int(7) NOT NULL AUTO_INCREMENT,
  name varchar(100) NOT NULL,
  description varchar(100) NOT NULL,
  lang varchar(5) NOT NULL,
  refExtraProd int(7) NOT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (refExtraProd) REFERENCES extra_product(id)
);

CREATE TABLE prod_name (
  id int(7) NOT NULL AUTO_INCREMENT,
  name varchar(50) NOT NULL,
  description varchar(255) NOT NULL,
  lang varchar(5) NOT NULL,
  refProd int(7) NOT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (refProd) REFERENCES product(id)
);

CREATE TABLE prod_image (
  id int(7) NOT NULL AUTO_INCREMENT,
  url varchar(255) NOT NULL,
  refProd int(7) NOT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (refProd) REFERENCES product(id)
);

CREATE TABLE prod_type (
  id int(7) NOT NULL AUTO_INCREMENT,
  name varchar(30) NOT NULL,
  refProd int(7) NOT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (refProd) REFERENCES product(id)
);

CREATE TABLE user_prod (
  id int(7) NOT NULL AUTO_INCREMENT,
  price varchar(7) NOT NULL,
  public int(1) NOT NULL,
  refProd int(7) NOT NULL,
  refUser int(7) NOT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (refProd) REFERENCES product(id),
  FOREIGN KEY (refUser) REFERENCES user_commerce(id)
);

CREATE TABLE order_prod (
  id int(7) NOT NULL AUTO_INCREMENT,
  qnt int(2) NOT NULL,
  refProd int(7) NOT NULL,
  refOrder int(7) NOT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (refProd) REFERENCES product(id),
  FOREIGN KEY (refOrder) REFERENCES `order`(id)
);

CREATE TABLE user_order (
  id int(7) NOT NULL AUTO_INCREMENT,
  delivery_cost varchar(7) NOT NULL,
  refUser int(7) NOT NULL,
  refOrder int(7) NOT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (refUser) REFERENCES user_commerce(id),
  FOREIGN KEY (refOrder) REFERENCES `order`(id)
);