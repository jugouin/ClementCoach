CREATE TABLE `HostingForm` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` varchar(50) NOT NULL,
  `hour` varchar(50) NOT NULL,
  `capacity` int(11) NOT NULL,
  `street_num` int(11) NOT NULL,
  `street_name` varchar(500) NOT NULL,
  `postcode` int(11) NOT NULL,
  `city` varchar(50) NOT NULL,
  `message` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `HostingForm` 
        (`id`, `user_id`, `date`, `hour`, `capacity`, `street_num`, `street_name`, `postcode`, `city`, `message`)
VALUES  (10, 25, '2024-05-29', '13h30', 6, 14, 'Rue du bois', 74000, 'Chambéry', ''),
        (11, 24, '2024-05-19', '09h30', 6, 7, 'rue des lys', 35000, 'Rennes', '');

CREATE TABLE `reservation` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `hour` varchar(50) NOT NULL,
  `address` varchar(500) NOT NULL,
  `equipment` int(11) NOT NULL,
  `level` varchar(50) NOT NULL,
  `capacity` int(11) NOT NULL,
  `limitation` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `reservation` 
        (`id`, `date`, `hour`, `address`, `equipment`, `level`, `capacity`, `limitation`) 
VALUES  (6, '2024-06-01', '20h00', '54 Rue du champs, 74500 Évian-les-bains', 1, 'expérimenté', 8, 8),
        (16, '2024-05-31', '08h00', '45 chemin de pré, 74500 Féternes', 1, 'intermédiaire', 3, 3);

CREATE TABLE `userReservation` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `reservation_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


INSERT INTO `userReservation` 
        (`id`, `user_id`, `reservation_id`)
VALUES  (7, 24, 13),
        (8, 24, 15);

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `level` varchar(50) NOT NULL,
  `host` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `users`
        (`id`, `name`, `email`, `password`, `level`, `host`)
VALUES  (24, 'Bob', 'bob@oui.fr', '$2y$10$I2C5dZlcuSkuHo6fmTwb9e56LGFTQj/NzXvTfSstd66Tb/Sm31doW', 'intermédiaire', 'true'),
        (28, 'Admin', 'clementcoach@pilates.com', '$2y$10$w9hztVrBhfwe5RVbhnDzWOdX0K/aIGV76CP.d3sdiu0OHhKh0/JN.', 'débutant', 'false');

ALTER TABLE `HostingForm`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

ALTER TABLE `reservation`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `userReservation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_idk` (`user_id`),
  ADD KEY `reservation_id` (`reservation_id`);

ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `HostingForm`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;


ALTER TABLE `reservation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;


ALTER TABLE `userReservation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;


ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

ALTER TABLE `HostingForm`
  ADD CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);


ALTER TABLE `userReservation`
  ADD CONSTRAINT `reservation_id` FOREIGN KEY (`reservation_id`) REFERENCES `reservation` (`id`),
  ADD CONSTRAINT `user_idk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

