--
-- MySQL 5.7.14
-- Sat, 29 Apr 2017 07:03:32 +0000
--

CREATE TABLE `accounts` (
   `id` int(11) not null auto_increment,
   `username` varchar(255) not null,
   `password` varchar(255) not null,
   PRIMARY KEY (`id`),
   UNIQUE KEY (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=0;

INSERT INTO `accounts` (`id`, `username`, `password`) VALUES 
('1', 'max98', '867a79be28576005bc18883f5f38c8ef');

CREATE TABLE `chart_info` (
   `id` int(11) not null auto_increment,
   `x` int(11) not null,
   `y` float not null,
   PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=0;

-- [Table `chart_info` is empty]

CREATE TABLE `circuit` (
   `id` int(11) not null auto_increment,
   `x` varchar(255) not null,
   `y` varchar(255),
   `z` varchar(255),
   PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=0;

-- [Table `circuit` is empty]

CREATE TABLE `data_logs` (
   `id` int(11) not null auto_increment,
   `x` varchar(255),
   `y` varchar(255),
   `z` varchar(255),
   `a` varchar(255),
   `b` varchar(255),
   `c` varchar(255),
   `d` varchar(255),
   `e` varchar(255),
   `f` varchar(255),
   `g` varchar(255),
   `h` varchar(255),
   `i` varchar(255),
   `date_time` datetime,
   PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=0;

-- [Table `data_logs` is empty]

CREATE TABLE `notifications` (
   `id` int(11) not null auto_increment,
   `title` varchar(255) not null,
   `desc` varchar(255),
   `date_time` datetime not null,
   `type` int(11) not null default '0',
   PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=0;

INSERT INTO `notifications` (`id`, `title`, `desc`, `date_time`, `type`) VALUES 
('1', 'Update recieved', '', '2017-04-29 04:05:14', '0'),
('2', 'Circuit updated', '', '2017-04-29 01:05:14', '1'),
('3', 'Drone rebooted', '', '2017-04-28 04:05:14', '2'),
('4', 'Date recived corrupted', '', '2017-04-27 09:05:14', '2');