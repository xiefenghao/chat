-- Adminer 4.7.7 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `chat_message`;
CREATE TABLE `chat_message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fromid` int(11) NOT NULL,
  `toid` int(11) NOT NULL,
  `content` varchar(50) NOT NULL,
  `type` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  `isread` int(11) NOT NULL,
  `shopid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `chat_message` (`id`, `fromid`, `toid`, `content`, `type`, `time`, `isread`, `shopid`) VALUES
(331,	40,	10,	'1',	0,	1,	1,	11),
(332,	40,	10,	'sds ',	0,	1615364601,	1,	0),
(333,	40,	10,	'saa ',	0,	1615364654,	1,	0),
(334,	60,	10,	'aassaultassault',	0,	1615365935,	1,	0),
(335,	60,	10,	'飒飒',	0,	1615366216,	1,	0),
(336,	60,	10,	'阿萨斯',	0,	1615367148,	1,	0),
(337,	90,	60,	'飒飒',	0,	1615367874,	1,	0),
(338,	90,	60,	'是的是的',	0,	1615367895,	1,	0),
(339,	90,	60,	'是多少单词',	0,	1615385594,	1,	0),
(340,	10,	40,	'飒飒',	0,	1616332850,	1,	0),
(341,	10,	40,	'a\'s',	0,	1616332856,	1,	0),
(342,	10,	40,	's',	0,	1616332857,	1,	0),
(343,	10,	40,	'a',	0,	1616332858,	1,	0),
(344,	10,	40,	'sa',	0,	1616332860,	1,	0),
(345,	10,	40,	'sa',	0,	1616332861,	1,	0),
(346,	10,	40,	'a\'s',	0,	1616332862,	1,	0),
(347,	10,	40,	'a\'sa',	0,	1616332863,	1,	0),
(348,	10,	40,	'a\'s',	0,	1616332864,	1,	0),
(349,	10,	40,	'发送sa\'sa',	0,	1616332874,	1,	0),
(350,	40,	10,	'sa\'s',	0,	1616477088,	1,	0),
(351,	60,	10,	'阿萨斯',	0,	1616477125,	1,	0),
(352,	60,	10,	'img60597efb89c2b.jpg',	2,	1616477947,	1,	0),
(353,	60,	10,	'img60597f6c29166.jpg',	2,	1616478060,	1,	0),
(354,	60,	10,	'img60597fa7f312f.jpg',	2,	1616478119,	1,	0),
(355,	60,	10,	'img60597fe05dfc1.jpg',	2,	1616478176,	1,	0),
(356,	60,	10,	'img60597ffaecc41.jpg',	2,	1616478202,	1,	0),
(357,	60,	90,	'sas ',	0,	1616506950,	1,	0),
(358,	90,	10,	'SaaS',	0,	1616507239,	1,	0),
(359,	60,	90,	'SaaS',	0,	1616507247,	1,	0),
(360,	90,	60,	'ccxcx',	0,	1616507559,	1,	0),
(361,	90,	10,	'assa',	0,	1616507922,	1,	0),
(362,	60,	10,	'不在吗',	0,	1616508106,	0,	0),
(363,	90,	110,	'12',	0,	1616509269,	0,	0),
(364,	90,	60,	'法规规范',	0,	1616553423,	0,	0),
(365,	90,	60,	'a\'sa\'s',	0,	1616554377,	0,	0),
(366,	90,	60,	'sa\'sa',	0,	1616554490,	0,	0),
(367,	90,	10,	'a\'s',	0,	1616560407,	1,	0),
(368,	90,	10,	'飒飒',	0,	1616560443,	1,	0),
(369,	90,	10,	'assa',	0,	1616560488,	1,	0),
(370,	90,	110,	'a\'sa\'s',	0,	1616560506,	0,	0),
(371,	90,	110,	'img605aca2e6c0e6.jpg',	2,	1616562734,	0,	0),
(372,	90,	110,	'[em_6]',	0,	1616562761,	0,	0),
(373,	90,	110,	'[em_6]',	0,	1616562761,	0,	0),
(374,	90,	110,	'[em_41]',	0,	1616562770,	0,	0),
(375,	90,	110,	'[em_41]',	0,	1616562770,	0,	0),
(376,	90,	110,	'img605acb8aec740.jpg',	2,	1616563082,	0,	0),
(377,	90,	110,	'[em_29]',	0,	1616563089,	0,	0),
(378,	90,	110,	'[em_29]',	0,	1616563089,	0,	0),
(379,	90,	110,	'[em_10]',	0,	1616563176,	0,	0),
(380,	90,	110,	'[em_10]',	0,	1616563176,	0,	0),
(381,	90,	110,	'saas',	0,	1616563235,	0,	0),
(382,	90,	110,	'saas',	0,	1616563235,	0,	0),
(383,	90,	110,	'dds ',	0,	1616563323,	0,	0),
(384,	90,	110,	'dds ',	0,	1616563323,	0,	0),
(385,	90,	110,	'ghgh',	0,	1616563343,	0,	0),
(386,	90,	110,	'ghgh',	0,	1616563343,	0,	0),
(387,	90,	110,	'实打实打算',	0,	1616563353,	0,	0),
(388,	90,	110,	'实打实打算',	0,	1616563353,	0,	0),
(389,	90,	110,	'assault',	0,	1616563431,	0,	0),
(390,	90,	110,	'[em_8]',	0,	1616563483,	0,	0),
(391,	90,	10,	'[em_36]',	0,	1616563511,	1,	0),
(392,	40,	90,	'SaaS',	0,	1616566293,	1,	0),
(393,	90,	40,	'sa\'sa',	0,	1616567718,	1,	0),
(394,	40,	90,	'飒飒',	0,	1616567724,	1,	0),
(395,	40,	90,	'sa\'sa',	0,	1616567740,	1,	0),
(396,	40,	90,	'sa\'sa',	0,	1616567755,	1,	0),
(397,	40,	90,	'啊啊',	0,	1616567784,	1,	0),
(398,	40,	90,	'啊啊撒',	0,	1616567818,	1,	0),
(399,	10,	90,	'是的是的',	0,	1616567925,	1,	0),
(400,	10,	90,	'assault',	0,	1616568084,	1,	0),
(401,	10,	90,	'飒飒撒',	0,	1616568558,	1,	0),
(402,	10,	90,	'阿萨',	0,	1616568565,	1,	0),
(403,	10,	90,	'[em_43]',	0,	1616568575,	1,	0),
(404,	10,	90,	'[em_38]',	0,	1616568584,	1,	0),
(405,	10,	90,	'img605ae11465383.jpg',	2,	1616568596,	1,	0),
(406,	40,	90,	'img605ae13776b56.jpg',	2,	1616568631,	0,	0),
(407,	10,	190,	'asas',	0,	1616593305,	0,	0),
(408,	10,	190,	'sa',	0,	1616593561,	0,	0),
(409,	10,	190,	'sa',	0,	1616593603,	0,	0),
(410,	10,	190,	's',	0,	1616593644,	0,	0),
(411,	10,	190,	'ddf',	0,	1616593696,	0,	0),
(412,	10,	190,	'df',	0,	1616593756,	0,	0),
(413,	40,	190,	'd',	0,	1616593792,	0,	0),
(414,	40,	190,	'fg',	0,	1616593891,	0,	0),
(415,	10,	190,	'a\'s',	0,	1616594884,	0,	0),
(416,	10,	190,	'啊啊',	0,	1616595199,	0,	0),
(417,	10,	190,	'阿萨',	0,	1616595270,	0,	0),
(418,	10,	190,	'是',	0,	1616595306,	0,	0),
(419,	10,	190,	'方法',	0,	1616595365,	0,	0),
(420,	40,	190,	'你好',	0,	1616595396,	0,	0),
(421,	10,	190,	'规划',	0,	1616595415,	0,	0),
(422,	10,	190,	'自增',	0,	1616595479,	0,	0),
(423,	10,	190,	'啊啊',	0,	1616595500,	0,	0),
(424,	10,	190,	'发广告',	0,	1616595518,	0,	0),
(425,	10,	190,	'啊',	0,	1616595589,	0,	0),
(426,	10,	190,	'啊啊撒',	0,	1616595636,	0,	0),
(427,	10,	190,	'的',	0,	1616596055,	0,	0),
(428,	10,	190,	'喝喝酒',	0,	1616596118,	0,	0),
(429,	10,	190,	'版本',	0,	1616596149,	0,	0),
(430,	10,	190,	'烦烦烦',	0,	1616596168,	0,	0),
(431,	10,	190,	'方法',	0,	1616596185,	0,	0),
(432,	10,	190,	'反反复复',	0,	1616596240,	0,	0),
(433,	10,	190,	'个',	0,	1616596290,	0,	0),
(434,	10,	190,	'古风',	0,	1616596298,	0,	0),
(435,	40,	190,	'个',	0,	1616596311,	0,	0),
(436,	40,	190,	'在',	0,	1616596343,	0,	0),
(437,	10,	190,	'个',	0,	1616596387,	0,	0),
(438,	10,	190,	'覆盖',	0,	1616596395,	0,	0),
(439,	40,	190,	'规划',	0,	1616596456,	0,	0),
(440,	10,	190,	'个',	0,	1616596623,	0,	0),
(441,	10,	190,	'v',	0,	1616596654,	0,	0),
(442,	40,	190,	'阿萨撒啊',	0,	1616639312,	0,	0),
(443,	40,	190,	'img605bf56640365.jpg',	2,	1616639334,	0,	0),
(444,	10,	190,	'嫁汉嫁汉',	0,	1616639485,	0,	0),
(445,	40,	190,	'img605bf68706194.jpg',	2,	1616639623,	0,	0),
(446,	10,	190,	'img605bf6be42dc2.jpg',	2,	1616639678,	0,	0),
(447,	10,	190,	'h\'g',	0,	1616639683,	0,	0),
(448,	40,	190,	'撒',	0,	1616640064,	0,	0),
(449,	10,	190,	'啊',	0,	1616640161,	0,	0),
(450,	10,	190,	'谷歌',	0,	1616640210,	0,	0),
(451,	10,	190,	'个',	0,	1616640219,	0,	0),
(452,	10,	190,	'img605bf8ee6c4bb.jpg',	2,	1616640238,	0,	0),
(453,	10,	190,	'img605bf90748d64.jpg',	2,	1616640263,	0,	0),
(454,	10,	190,	'img605bf93ba829f.jpg',	2,	1616640315,	0,	0),
(455,	10,	190,	'img605bf95f2691b.jpg',	2,	1616640351,	0,	0),
(456,	10,	190,	'[em_25]',	0,	1616642018,	0,	0),
(457,	10,	190,	'[em_35]',	0,	1616642163,	0,	0),
(458,	10,	90,	'啊啊撒',	0,	1616681611,	0,	0),
(459,	10,	190,	'阿萨斯',	0,	1616681628,	0,	0),
(460,	10,	190,	'撒',	0,	1616681693,	0,	0),
(461,	10,	190,	'撒',	0,	1616681763,	0,	0),
(462,	10,	190,	'撒',	0,	1616681833,	0,	0),
(463,	10,	190,	'img605c9edb67d42.jpg',	2,	1616682715,	0,	0),
(464,	10,	190,	'img605c9f1b904db.jpg',	2,	1616682779,	0,	0),
(465,	10,	190,	'但是',	0,	1616818013,	0,	0),
(466,	10,	190,	'飒飒',	0,	1616818023,	0,	0),
(467,	10,	190,	'发的',	0,	1616818468,	0,	0),
(468,	10,	190,	'飒飒',	0,	1616818505,	0,	0),
(469,	10,	190,	'啊',	0,	1616818761,	0,	0),
(470,	10,	190,	'a\'sa\'s',	0,	1616818923,	0,	0),
(471,	10,	190,	'选择',	0,	1616818938,	0,	0),
(472,	10,	190,	'阿萨',	0,	1616818958,	0,	0),
(473,	10,	190,	'撒',	0,	1616819049,	0,	0),
(474,	10,	190,	'撒',	0,	1616819090,	0,	0),
(475,	10,	190,	'啊啊',	0,	1616819094,	0,	0),
(476,	10,	190,	'撒',	0,	1616819832,	0,	0),
(477,	10,	190,	'阿萨',	0,	1616820072,	0,	0),
(478,	10,	190,	'阿萨斯',	0,	1616820370,	0,	0),
(479,	10,	190,	'撒',	0,	1616820375,	0,	0),
(480,	10,	190,	'撒啊',	0,	1616823427,	0,	0),
(481,	10,	190,	'撒啊',	0,	1616823431,	0,	0),
(482,	10,	190,	'撒',	0,	1616823519,	0,	0),
(483,	10,	190,	'阿萨飒飒',	0,	1616823533,	0,	0),
(484,	10,	190,	'撒',	0,	1616823540,	0,	0),
(485,	10,	190,	'阿萨',	0,	1616823557,	0,	0),
(486,	10,	190,	'阿萨',	0,	1616823590,	0,	0),
(487,	60,	190,	'阿萨斯',	0,	1616823605,	0,	0),
(488,	10,	190,	'a\'s',	0,	1616823630,	0,	0),
(489,	60,	190,	'assassinated',	0,	1616823665,	0,	0),
(490,	60,	190,	'撒',	0,	1616823706,	0,	0),
(491,	10,	190,	'是',	0,	1616823742,	0,	0),
(492,	60,	190,	's',	0,	1616823817,	0,	0),
(493,	10,	190,	's\'s\'d',	0,	1616823884,	0,	0),
(494,	10,	190,	'a',	0,	1616823914,	0,	0),
(495,	10,	190,	'阿萨',	0,	1616823948,	0,	0),
(496,	10,	190,	'撒',	0,	1616824148,	0,	0),
(497,	60,	190,	'阿萨',	0,	1616824177,	0,	0),
(498,	60,	190,	'阿萨',	0,	1616824442,	0,	0),
(499,	60,	190,	'撒',	0,	1616824485,	0,	0),
(500,	60,	190,	'阿萨斯',	0,	1616824544,	0,	0),
(501,	60,	190,	'啊啊啊',	0,	1616824569,	0,	0),
(502,	60,	190,	'啊啊啊啊啊',	0,	1616824585,	0,	0),
(503,	60,	190,	'啊啊',	0,	1616824594,	0,	0),
(504,	60,	190,	'vb',	0,	1616824623,	0,	0),
(505,	60,	190,	'啊啊啊',	0,	1616824974,	0,	0),
(506,	10,	190,	'SaaS',	0,	1616824987,	0,	0),
(507,	10,	190,	'啊啊啊',	0,	1616824991,	0,	0),
(508,	60,	190,	'撒啊',	0,	1616825008,	0,	0),
(509,	60,	190,	'a',	0,	1616825012,	0,	0),
(510,	60,	90,	'assa',	0,	1617085482,	0,	0),
(511,	60,	90,	'img6062c4331f38b.jpg',	2,	1617085491,	0,	0),
(512,	10,	60,	'干什么',	0,	1617087291,	0,	0),
(513,	10,	60,	'啊啊',	0,	1617087313,	0,	0),
(514,	10,	60,	'啊啊',	0,	1617087340,	0,	0),
(515,	10,	60,	'啊啊啊啊顶顶顶顶',	0,	1617087344,	0,	0),
(516,	10,	60,	'和',	0,	1617087357,	0,	0),
(517,	10,	60,	'img6062cbdd9866c.jpg',	2,	1617087453,	0,	0),
(518,	10,	60,	'a',	0,	1617087459,	0,	0),
(519,	10,	60,	'啊啊',	0,	1617087488,	0,	0);

DROP TABLE IF EXISTS `chat_user`;
CREATE TABLE `chat_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(25) NOT NULL,
  `img_url` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `chat_user` (`id`, `name`, `img_url`) VALUES
(10,	'我是10',	'http://localhost/chat/public/static/1.jpg'),
(40,	'我是40',	'http://localhost/chat/public/static/2.jpg'),
(60,	'我是60',	'http://localhost/chat/public/static/3.jpg'),
(90,	'我是90',	'http://localhost/chat/public/static/3.jpg'),
(110,	'我是1100',	'http://localhost/chat/public/static/3.jpg');

-- 2021-03-31 02:25:07