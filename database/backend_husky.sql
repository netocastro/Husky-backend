DROP TABLE IF EXISTS deliveries;
DROP TABLE IF EXISTS store;
DROP TABLE IF EXISTS motoboys;
DROP TABLE IF EXISTS status;
DROP TABLE IF EXISTS users;

CREATE TABLE `users`(
    `id` INTEGER AUTO_INCREMENT,
    `name` VARCHAR(100) NOT NULL,
    `address` VARCHAR(200) NOT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    PRIMARY KEY(id)
);

CREATE TABLE `status`(
    `id` INTEGER AUTO_INCREMENT,
    `name` VARCHAR(100) NOT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    PRIMARY KEY(id)
);

INSERT INTO `status`(id, name) VALUES('1', 'Novo'),('2', 'Entregando'),('3', 'Finalizado'),('4', 'Cancelado');

CREATE TABLE `motoboys`(
    `id` INTEGER AUTO_INCREMENT,
    `name` VARCHAR(100) NOT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    PRIMARY KEY(id)
);
CREATE TABLE `deliveries`(
    `id` INTEGER AUTO_INCREMENT,
    `user_id` INTEGER NOT NULL,
    `motoboy_id` INTEGER DEFAULT NULL,
    `status` INTEGER NOT NULL,
    `collection_address` VARCHAR(200) NOT NULL,
    `destination_address` VARCHAR(200) NOT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    PRIMARY KEY(id)
);

ALTER TABLE `deliveries` ADD FOREIGN KEY (user_id) REFERENCES users(id) ON UPDATE CASCADE;
ALTER TABLE `deliveries` ADD FOREIGN KEY(motoboy_id) REFERENCES motoboys(id) ON UPDATE CASCADE;
ALTER TABLE `deliveries` ADD FOREIGN KEY(status) REFERENCES status(id) ON UPDATE CASCADE;

-- falta colocar na entrega o usuario que fez o pedido, alem do endereço.
-- falta criar loja, colocar o id da loja que foi feito o pedido.
