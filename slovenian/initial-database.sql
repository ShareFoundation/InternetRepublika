SET FOREIGN_KEY_CHECKS=0;

SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT;
SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS;
SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION;
SET NAMES utf8;

DROP TABLE IF EXISTS `badge`;
CREATE TABLE IF NOT EXISTS `badge` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `place_count` int(11) DEFAULT '0',
  `image` varchar(255) DEFAULT NULL,
  `style` varchar(255) DEFAULT NULL,
  `order` int(11) DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `badge_FI_1` (`type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

INSERT INTO `badge` (`id`, `type_id`, `name`, `description`, `place_count`, `image`, `style`, `order`, `created_at`, `updated_at`) VALUES
(1, 1, 'Main badge 1', 'Main badge 1 description', 0, '59c480db6c90309d9895ab2c69c1f01663312b0c.png', 'badge1', 1, '2012-03-07 16:34:07', '2013-02-11 10:30:44'),
(2, 1, 'Main badge 2', 'Main badge 2 description', 0, '69514ef880b8fccc8b576731f88c0c7dc3593228.png', 'badge2', 2, '2012-03-07 16:34:11', '2013-02-11 10:32:51'),
(3, 1, 'Main badge 3', 'Main badge 3 description', 0, 'd696f6c66fbbd1f12bfc22b5cc5ab23b040acc4f.png', 'badge3', 3, '2012-03-07 16:34:15', '2013-02-11 10:33:03'),
(4, 1, 'Main badge 4', 'Main badge 4 description', 0, '25ccc65627061e9dbc23c8ecfabfb85b5b9ac1db.png', 'badge4', 4, '2012-03-07 16:34:18', '2013-02-11 10:33:13'),
(5, 1, 'Main badge 5', 'Main badge 5 description', 0, '5c48b119d0a5feff9fa41bc5edd9ae6b579e7612.png', 'badge5', 5, '2012-03-07 16:34:23', '2013-02-11 10:33:22'),
(6, 1, 'Main badge 6', 'Main badge 6 description', 0, '406e5ab7fca87ff3ae725a85859e33fd07058c12.png', 'badge6', 6, '2012-03-07 16:34:27', '2013-02-11 10:33:32'),
(7, 2, '+++', '+++', 0, 'e1a957ea9c9af5cac5b547e82f0de7a7b5598e9b.png', '#5bd700', 1, '2012-03-07 16:34:32', '2013-02-12 11:37:32'),
(8, 2, '++', '++', 0, '562694b77fccf13972540dcd67b3aa0f6595fddb.png', '#a7d700', 2, '2012-03-07 16:34:37', '2013-02-12 11:37:50'),
(9, 2, '+', '+', 0, 'e30d9f0b85254cf96dcabe479029a6a2af5abd71.png', '#d7bb00', 3, '2012-03-07 16:34:43', '2013-02-12 11:38:03'),
(10, 2, '-', '-', 0, '037e5bb264129b17dcb108317278687be13702cc.png', '#ecb235', 4, '2012-03-07 16:34:49', '2013-02-12 11:38:50'),
(11, 2, '--', '--', 0, '6c37e6a6e5d2fe3bdf274898c091b38e578c5ab9.png', '#d76000', 5, '2012-03-07 16:34:55', '2013-02-12 11:39:00'),
(12, 2, '---', '---', 0, 'b29e9d3021adca4150550e6b6f80404d8702b7bb.png', '#d70000', 6, '2012-03-07 16:35:00', '2013-02-12 11:39:13'),
(13, 3, 'Neutral', 'This post has not dominant orientation.', 0, 'a980c89afcf0cdd888a9769d88a3b719112e40ab.png', 'neutral', 1, '2012-03-16 09:39:42', '2013-02-11 11:03:22'),
(15, 4, 'Flag as inappropriate', 'Flag as inappropriate', 0, '77f2935cb81da440caa0db215d3fdd5644d1170e.png', 'report1', 2, '2012-03-20 06:07:28', '2013-02-11 11:03:35');

DROP TABLE IF EXISTS `badge_type`;
CREATE TABLE IF NOT EXISTS `badge_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

INSERT INTO `badge_type` (`id`, `name`) VALUES
(1, 'Main'),
(2, 'Quality'),
(3, 'Neutral'),
(4, 'Report Post');

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `order` int(11) DEFAULT '0',
  `is_published` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


DROP TABLE IF EXISTS `comment`;
CREATE TABLE IF NOT EXISTS `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `item_id` int(11) NOT NULL,
  `item_type` int(1) DEFAULT '1',
  `parent_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `text` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `comment_FI_1` (`user_id`),
  KEY `comment_FI_2` (`parent_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


DROP TABLE IF EXISTS `configuration`;
CREATE TABLE IF NOT EXISTS `configuration` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(255) NOT NULL,
  `value` text NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

INSERT INTO `configuration` (`id`, `code`, `value`, `created_at`, `updated_at`) VALUES
(1, 'site_name', '', '2013-02-26 10:32:53', '2013-02-26 10:32:53'),
(2, 'index_boundary', '0', '2013-02-26 10:32:53', '2013-02-26 10:32:53'),
(3, 'google_analytics', '', '2013-02-26 10:32:53', '2013-02-26 10:32:53'),
(4, 'logo', '', '2013-02-26 10:32:53', '2013-02-26 10:32:53'),
(5, 'facebook', '', '2013-02-26 10:32:53', '2013-02-26 10:32:53'),
(6, 'twitter', '', '2013-02-26 10:32:53', '2013-02-26 10:32:53'),
(7, 'youtube', '', '2013-02-26 10:32:53', '2013-02-26 10:32:53'),
(8, 'linkedin', '', '2013-02-26 10:32:53', '2013-02-26 10:32:53'),
(9, 'instagram', '', '2013-02-26 10:32:53', '2013-02-26 10:32:53'),
(10, 'pinterest', '', '2013-02-26 10:32:53', '2013-02-26 10:32:53'),
(11, 'hashtag', '', '2013-02-26 10:32:53', '2013-02-26 10:32:53'),
(12, 'use_badges', '1', '2013-02-26 10:32:53', '2013-02-26 10:32:53');

DROP TABLE IF EXISTS `inappropriate`;
CREATE TABLE IF NOT EXISTS `inappropriate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `type` int(11) DEFAULT '1',
  `message` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `inappropriate_FI_1` (`post_id`),
  KEY `inappropriate_FI_2` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


DROP TABLE IF EXISTS `inappropriate_comment`;
CREATE TABLE IF NOT EXISTS `inappropriate_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `comment_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `inappropriate_comment_FI_1` (`comment_id`),
  KEY `inappropriate_comment_FI_2` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


DROP TABLE IF EXISTS `menu`;
CREATE TABLE IF NOT EXISTS `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `link` varchar(255) DEFAULT NULL,
  `order_position` int(11) DEFAULT '0',
  `is_enabled` tinyint(4) DEFAULT '1',
  `is_target_blank` tinyint(4) DEFAULT '0',
  `parent_id` int(11) DEFAULT NULL,
  `language` varchar(255) NOT NULL DEFAULT 'all',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

INSERT INTO `menu` (`id`, `title`, `link`, `order_position`, `is_enabled`, `is_target_blank`, `parent_id`, `language`, `created_at`, `updated_at`) VALUES
(1, 'Header Menu', '###', 1, 1, 0, NULL, 'all', '2013-02-19 14:21:23', '2013-02-19 14:21:23'),
(2, 'Left Menu', '###', 2, 1, 0, NULL, 'all', '2013-02-19 14:22:39', '2013-02-19 14:22:39'),
(3, 'Posts', '{url=''@homepage''}', 1, 1, 0, 1, 'all', '2013-02-19 14:33:32', '2013-02-19 14:35:11'),
(4, 'Parties', '{url=''@party_index''}', 2, 1, 0, 1, 'all', '2013-02-19 14:34:15', '2013-02-19 14:35:05'),
(5, 'News', '{url=''@news_index''}', 3, 1, 0, 1, 'all', '2013-02-19 14:34:58', '2013-02-19 14:34:58'),
(6, 'About Us', '{page=''About Us''}', 1, 1, 0, 2, 'all', '2013-02-19 14:38:29', '2013-02-21 13:51:27'),
(7, 'Terms and Conditions', '{page=''Terms and Conditions''}', 2, 1, 0, 2, 'all', '2013-02-19 14:38:57', '2013-02-21 13:50:58'),
(8, 'Contact', '{url=''@contact''}', 3, 1, 0, 2, 'all', '2013-02-19 14:39:15', '2013-02-19 14:39:15');

DROP TABLE IF EXISTS `mg_content`;
CREATE TABLE IF NOT EXISTS `mg_content` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `label` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `text` text,
  `is_published` tinyint(4) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `mg_content_U_1` (`label`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

INSERT INTO `mg_content` (`id`, `label`, `title`, `text`, `is_published`, `created_at`, `updated_at`) VALUES
(1, 'Contact', 'Contact', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 1, NULL, '2012-03-22 16:24:27'),
(2, 'Top Block', 'Top Block', '<p><img src="/uploads/assets/image/promo-banner.jpg" width="815" height="75" alt="" />&nbsp;</p>', 1, NULL, '2013-02-26 10:13:09'),
(3, 'Contact Success', 'Contact Success', 'Thank you for contacting us.', 1, '2012-03-17 06:31:56', '2012-03-17 06:31:56'),
(4, 'Top Block Register', 'Top Block Register', '<p><img src="/uploads/assets/image/promo-banner.jpg" width="815" height="75" alt="" />&nbsp;</p>', 1, NULL, NULL),
(5, 'Register Success', 'Register Success', '<h3 style="margin: 0px 0px 14px; padding: 0px; font-size: 11px; font-family: Arial, Helvetica, sans;">The standard Lorem Ipsum passage, used since the 1500s</h3>\r\n<p style="text-align: justify; font-size: 11px; line-height: 14px; margin: 0px 0px 14px; padding: 0px; font-family: Arial, Helvetica, sans;">&quot;Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.&quot;</p>\r\n<h3 style="margin: 0px 0px 14px; padding: 0px; font-size: 11px; font-family: Arial, Helvetica, sans;">Section 1.10.32 of &quot;de Finibus Bonorum et Malorum&quot;, written by Cicero in 45 BC</h3>\r\n<p style="text-align: justify; font-size: 11px; line-height: 14px; margin: 0px 0px 14px; padding: 0px; font-family: Arial, Helvetica, sans;">&quot;Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?&quot;</p>', 1, '2013-02-25 12:45:33', '2013-02-25 12:45:33');

DROP TABLE IF EXISTS `mg_page`;
CREATE TABLE IF NOT EXISTS `mg_page` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `label` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` text,
  `meta_keywords` text,
  `text` text,
  `is_published` tinyint(4) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `mg_page_U_1` (`label`),
  UNIQUE KEY `mg_page_U_2` (`url`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

INSERT INTO `mg_page` (`id`, `label`, `url`, `title`, `meta_title`, `meta_description`, `meta_keywords`, `text`, `is_published`, `created_at`, `updated_at`) VALUES
(1, 'About Us', 'about_us', 'About Us', 'About Us', 'About Us', 'About Us', '<h3 style="margin: 0px 0px 14px; padding: 0px; font-size: 11px; text-align: left; font-family: Arial, Helvetica, sans; ">The standard Lorem Ipsum passage, used since the 1500s</h3>\r\n<p style="text-align: justify; font-size: 11px; line-height: 14px; margin: 0px 0px 14px; padding: 0px; font-family: Arial, Helvetica, sans; ">&quot;Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.&quot;</p>\r\n<h3 style="margin: 0px 0px 14px; padding: 0px; font-size: 11px; text-align: left; font-family: Arial, Helvetica, sans; ">Section 1.10.32 of &quot;de Finibus Bonorum et Malorum&quot;, written by Cicero in 45 BC</h3>\r\n<p style="text-align: justify; font-size: 11px; line-height: 14px; margin: 0px 0px 14px; padding: 0px; font-family: Arial, Helvetica, sans; ">&quot;Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?&quot;</p>\r\n<h3 style="margin: 0px 0px 14px; padding: 0px; font-size: 11px; text-align: left; font-family: Arial, Helvetica, sans; ">1914 translation by H. Rackham</h3>\r\n<p style="text-align: justify; font-size: 11px; line-height: 14px; margin: 0px 0px 14px; padding: 0px; font-family: Arial, Helvetica, sans; ">&quot;But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?&quot;</p>\r\n<h3 style="margin: 0px 0px 14px; padding: 0px; font-size: 11px; text-align: left; font-family: Arial, Helvetica, sans; ">Section 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot;, written by Cicero in 45 BC</h3>\r\n<p style="text-align: justify; font-size: 11px; line-height: 14px; margin: 0px 0px 14px; padding: 0px; font-family: Arial, Helvetica, sans; ">&quot;At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.&quot;</p>\r\n<h3 style="margin: 0px 0px 14px; padding: 0px; font-size: 11px; text-align: left; font-family: Arial, Helvetica, sans; ">1914 translation by H. Rackham</h3>\r\n<p style="text-align: justify; font-size: 11px; line-height: 14px; margin: 0px 0px 14px; padding: 0px; font-family: Arial, Helvetica, sans; ">&quot;On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal blame belongs to those who fail in their duty through weakness of will, which is the same as saying through shrinking from toil and pain. These cases are perfectly simple and easy to distinguish. In a free hour, when our power of choice is untrammelled and when nothing prevents our being able to do what we like best, every pleasure is to be welcomed and every pain avoided. But in certain circumstances and owing to the claims of duty or the obligations of business it will frequently occur that pleasures have to be repudiated and annoyances accepted. The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.&quot;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>', 1, NULL, NULL),
(3, 'Terms and Conditions', 'terms_and_conditions', 'Terms and Conditions', 'Terms and Conditions', 'Terms and Conditions', 'Terms and Conditions', '<div style="text-align: justify; ">\r\n<h3 style="margin: 0px 0px 14px; padding: 0px; font-size: 11px; text-align: left; font-family: Arial, Helvetica, sans; ">The standard Lorem Ipsum passage, used since the 1500s</h3>\r\n<p style="font-size: 11px; line-height: 14px; margin: 0px 0px 14px; padding: 0px; font-family: Arial, Helvetica, sans; ">&quot;Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.&quot;</p>\r\n<h3 style="margin: 0px 0px 14px; padding: 0px; font-size: 11px; text-align: left; font-family: Arial, Helvetica, sans; ">Section 1.10.32 of &quot;de Finibus Bonorum et Malorum&quot;, written by Cicero in 45 BC</h3>\r\n<p style="font-size: 11px; line-height: 14px; margin: 0px 0px 14px; padding: 0px; font-family: Arial, Helvetica, sans; ">&quot;Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?&quot;</p>\r\n<h3 style="margin: 0px 0px 14px; padding: 0px; font-size: 11px; text-align: left; font-family: Arial, Helvetica, sans; ">1914 translation by H. Rackham</h3>\r\n<p style="font-size: 11px; line-height: 14px; margin: 0px 0px 14px; padding: 0px; font-family: Arial, Helvetica, sans; ">&quot;But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?&quot;</p>\r\n<h3 style="margin: 0px 0px 14px; padding: 0px; font-size: 11px; text-align: left; font-family: Arial, Helvetica, sans; ">Section 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot;, written by Cicero in 45 BC</h3>\r\n<p style="font-size: 11px; line-height: 14px; margin: 0px 0px 14px; padding: 0px; font-family: Arial, Helvetica, sans; ">&quot;At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.&quot;</p>\r\n<h3 style="margin: 0px 0px 14px; padding: 0px; font-size: 11px; text-align: left; font-family: Arial, Helvetica, sans; ">1914 translation by H. Rackham</h3>\r\n<p style="font-size: 11px; line-height: 14px; margin: 0px 0px 14px; padding: 0px; font-family: Arial, Helvetica, sans; ">&quot;On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal blame belongs to those who fail in their duty through weakness of will, which is the same as saying through shrinking from toil and pain. These cases are perfectly simple and easy to distinguish. In a free hour, when our power of choice is untrammelled and when nothing prevents our being able to do what we like best, every pleasure is to be welcomed and every pain avoided. But in certain circumstances and owing to the claims of duty or the obligations of business it will frequently occur that pleasures have to be repudiated and annoyances accepted. The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.&quot;</p>\r\n</div>', 1, NULL, '2013-02-21 13:50:53');

DROP TABLE IF EXISTS `missed_theme`;
CREATE TABLE IF NOT EXISTS `missed_theme` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `missed_theme_FI_1` (`post_id`),
  KEY `missed_theme_FI_2` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


DROP TABLE IF EXISTS `news`;
CREATE TABLE IF NOT EXISTS `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(255) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `is_published` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

INSERT INTO `news` (`id`, `url`, `title`, `text`, `is_published`, `created_at`, `updated_at`) VALUES
(1, 'news-1', 'Welcome News', 'This is generic initial news', 1, '2012-01-01 00:00:00', '2012-01-01 00:00:00');

DROP TABLE IF EXISTS `newsletter`;
CREATE TABLE IF NOT EXISTS `newsletter` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `is_subscribed` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


DROP TABLE IF EXISTS `partie`;
CREATE TABLE IF NOT EXISTS `partie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `bio` text NOT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `facebook_page` text,
  `total_index` float NOT NULL DEFAULT '0',
  `is_published` tinyint(4) NOT NULL DEFAULT '1',
  `comments_count` int(11) DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `partie_FI_1` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


DROP TABLE IF EXISTS `partie_custom_points`;
CREATE TABLE IF NOT EXISTS `partie_custom_points` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `partie_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `points` int(11) NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `partie_custom_points_FI_1` (`partie_id`),
  KEY `partie_custom_points_FI_2` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


DROP TABLE IF EXISTS `partie_daily_stats`;
CREATE TABLE IF NOT EXISTS `partie_daily_stats` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `partie_id` int(11) NOT NULL,
  `like` int(11) NOT NULL DEFAULT '0',
  `twitt` int(11) NOT NULL DEFAULT '0',
  `comment` int(11) NOT NULL DEFAULT '0',
  `badge` int(11) NOT NULL DEFAULT '0',
  `views` int(11) NOT NULL DEFAULT '0',
  `current_index` float NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `partie_daily_stats_FI_1` (`partie_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


DROP TABLE IF EXISTS `partie_index`;
CREATE TABLE IF NOT EXISTS `partie_index` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `partie_id` int(11) NOT NULL,
  `daily` float NOT NULL DEFAULT '0',
  `weekly` float NOT NULL DEFAULT '0',
  `total` float NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `partie_index_FI_1` (`partie_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


DROP TABLE IF EXISTS `partie_visits`;
CREATE TABLE IF NOT EXISTS `partie_visits` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `partie_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `cookie_id` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `partie_visits_FI_1` (`partie_id`),
  KEY `partie_visits_FI_2` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


DROP TABLE IF EXISTS `post`;
CREATE TABLE IF NOT EXISTS `post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `partie_id` int(11) NOT NULL,
  `replica_post_id` int(11) DEFAULT NULL,
  `type` int(11) NOT NULL DEFAULT '1',
  `title` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `text` text,
  `photo_file` varchar(255) DEFAULT NULL,
  `photo_url` varchar(255) DEFAULT NULL,
  `quote` text,
  `quote_author` varchar(255) DEFAULT NULL,
  `link_title` varchar(255) DEFAULT NULL,
  `link_url` varchar(255) DEFAULT NULL,
  `link_image` varchar(255) DEFAULT NULL,
  `video_url` varchar(255) DEFAULT NULL,
  `total_index` float NOT NULL DEFAULT '0',
  `best_badge_1` int(11) NOT NULL,
  `best_badge_2` int(11) NOT NULL,
  `is_published` tinyint(4) NOT NULL DEFAULT '1',
  `is_featured` tinyint(4) NOT NULL DEFAULT '0',
  `comments_count` int(11) DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `post_FI_1` (`partie_id`),
  KEY `post_FI_2` (`replica_post_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


DROP TABLE IF EXISTS `post_badge`;
CREATE TABLE IF NOT EXISTS `post_badge` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `badge_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `post_badge_FI_1` (`badge_id`),
  KEY `post_badge_FI_2` (`post_id`),
  KEY `post_badge_FI_3` (`user_id`),
  KEY `post_badge_FI_4` (`type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


DROP TABLE IF EXISTS `post_daily_stats`;
CREATE TABLE IF NOT EXISTS `post_daily_stats` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `like` int(11) NOT NULL DEFAULT '0',
  `twitt` int(11) NOT NULL DEFAULT '0',
  `comment` int(11) NOT NULL DEFAULT '0',
  `badge` int(11) NOT NULL DEFAULT '0',
  `views` int(11) NOT NULL DEFAULT '0',
  `current_index` float NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `post_daily_stats_FI_1` (`post_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


DROP TABLE IF EXISTS `post_index`;
CREATE TABLE IF NOT EXISTS `post_index` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `daily` float NOT NULL DEFAULT '0',
  `weekly` float NOT NULL DEFAULT '0',
  `total` float NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `post_index_FI_1` (`post_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


DROP TABLE IF EXISTS `post_poll_answer`;
CREATE TABLE IF NOT EXISTS `post_poll_answer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `answer` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `post_poll_answer_FI_1` (`post_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


DROP TABLE IF EXISTS `post_poll_vote`;
CREATE TABLE IF NOT EXISTS `post_poll_vote` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `answer_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `post_poll_vote_FI_1` (`post_id`),
  KEY `post_poll_vote_FI_2` (`user_id`),
  KEY `post_poll_vote_FI_3` (`answer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


DROP TABLE IF EXISTS `post_visits`;
CREATE TABLE IF NOT EXISTS `post_visits` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `cookie_id` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `post_visits_FI_1` (`post_id`),
  KEY `post_visits_FI_2` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


DROP TABLE IF EXISTS `session`;
CREATE TABLE IF NOT EXISTS `session` (
  `sess_id` varchar(128) NOT NULL,
  `sess_data` text,
  `sess_time` int(11) DEFAULT NULL,
  `sess_user` int(11) DEFAULT NULL,
  PRIMARY KEY (`sess_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `sf_guard_group`;
CREATE TABLE IF NOT EXISTS `sf_guard_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `sf_guard_group_U_1` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

INSERT INTO `sf_guard_group` (`id`, `name`, `description`) VALUES
(1, 'Member', 'Member'),
(2, 'Admin', 'Admin');

DROP TABLE IF EXISTS `sf_guard_group_permission`;
CREATE TABLE IF NOT EXISTS `sf_guard_group_permission` (
  `group_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  PRIMARY KEY (`group_id`,`permission_id`),
  KEY `sf_guard_group_permission_FI_2` (`permission_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `sf_guard_group_permission` (`group_id`, `permission_id`) VALUES
(1, 1),
(2, 2),
(2, 3),
(2, 4),
(2, 5),
(2, 6),
(2, 7),
(2, 8),
(2, 9),
(2, 10),
(2, 11),
(2, 12),
(2, 13),
(2, 14),
(2, 15),
(2, 16),
(2, 17),
(2, 18);

DROP TABLE IF EXISTS `sf_guard_permission`;
CREATE TABLE IF NOT EXISTS `sf_guard_permission` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `sf_guard_permission_U_1` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

INSERT INTO `sf_guard_permission` (`id`, `name`, `description`) VALUES
(1, 'Member', 'Member'),
(2, 'Entire Admin', 'Entire Admin'),
(3, 'See Flag', 'See Flag'),
(4, 'Manage Flag', 'Manage Flag'),
(5, 'See User', 'See User'),
(6, 'Manage User', 'Manage User'),
(9, 'See Badge', 'See Badge'),
(10, 'Manage Badge', 'Manage Badge'),
(11, 'See Party', 'See Party'),
(12, 'Manage Party', 'Manage Party'),
(13, 'See Page', 'See Page'),
(14, 'Manage Page', 'Manage Page'),
(15, 'See Content', 'See Content'),
(16, 'Manage Content', 'Manage Content'),
(17, 'See News', 'See News'),
(18, 'Manage News', 'Manage News');

DROP TABLE IF EXISTS `sf_guard_remember_key`;
CREATE TABLE IF NOT EXISTS `sf_guard_remember_key` (
  `user_id` int(11) NOT NULL,
  `remember_key` varchar(32) DEFAULT NULL,
  `ip_address` varchar(50) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`user_id`,`ip_address`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `sf_guard_user`;
CREATE TABLE IF NOT EXISTS `sf_guard_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(128) DEFAULT NULL,
  `algorithm` varchar(128) NOT NULL DEFAULT 'sha1',
  `salt` varchar(128) DEFAULT NULL,
  `password` varchar(128) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT '1',
  `is_super_admin` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


DROP TABLE IF EXISTS `sf_guard_user_group`;
CREATE TABLE IF NOT EXISTS `sf_guard_user_group` (
  `user_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`group_id`),
  KEY `sf_guard_user_group_FI_2` (`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `sf_guard_user_permission`;
CREATE TABLE IF NOT EXISTS `sf_guard_user_permission` (
  `user_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`permission_id`),
  KEY `sf_guard_user_permission_FI_2` (`permission_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `sf_guard_user_profile`;
CREATE TABLE IF NOT EXISTS `sf_guard_user_profile` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `email_hash` varchar(255) DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `is_email_comfirmed` tinyint(4) NOT NULL DEFAULT '0',
  `last_ip` varchar(255) DEFAULT '0.0.0.0',
  `is_first_login` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `sf_guard_user_profile_FI_1` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


DROP TABLE IF EXISTS `sf_tag`;
CREATE TABLE IF NOT EXISTS `sf_tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `is_triple` tinyint(4) DEFAULT NULL,
  `triple_namespace` varchar(100) DEFAULT NULL,
  `triple_key` varchar(100) DEFAULT NULL,
  `triple_value` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`),
  KEY `triple1` (`triple_namespace`),
  KEY `triple2` (`triple_key`),
  KEY `triple3` (`triple_value`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


DROP TABLE IF EXISTS `sf_tagging`;
CREATE TABLE IF NOT EXISTS `sf_tagging` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tag_id` int(11) NOT NULL,
  `taggable_model` varchar(30) DEFAULT NULL,
  `taggable_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tag` (`tag_id`),
  KEY `taggable` (`taggable_model`,`taggable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

SET FOREIGN_KEY_CHECKS=1;