-- Adminer 4.8.1 MySQL 8.4.1 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `answers`;
CREATE TABLE `answers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `answer` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `question_id` bigint unsigned NOT NULL,
  `correct_answer` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `answers_question_id_foreign` (`question_id`),
  CONSTRAINT `answers_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `answers` (`id`, `answer`, `question_id`, `correct_answer`, `created_at`, `updated_at`) VALUES
(1,	'allen Phasen',	1,	NULL,	NULL,	NULL),
(2,	'der Planungsphase',	1,	NULL,	NULL,	NULL),
(3,	'der Implementierungsphase',	1,	NULL,	NULL,	NULL),
(4,	'der Designphase',	1,	NULL,	NULL,	NULL),
(5,	'permanent während',	2,	NULL,	NULL,	NULL),
(6,	'in der Mitte',	2,	NULL,	NULL,	NULL),
(7,	'erst ganz am Ende',	2,	NULL,	NULL,	NULL),
(8,	'muss',	3,	NULL,	NULL,	NULL),
(9,	'kann',	3,	NULL,	NULL,	NULL),
(10,	'darf',	3,	NULL,	NULL,	NULL),
(11,	'braucht nicht',	3,	NULL,	NULL,	NULL),
(12,	'ein Konzept zur Entwicklung von sicherer Software',	4,	1,	NULL,	NULL),
(13,	'die regelmäßige Benutzung der Software von Kunden',	4,	0,	NULL,	NULL),
(14,	'den Update Time Schedule',	4,	0,	NULL,	NULL),
(15,	'Secure Development Lifecycle',	5,	1,	NULL,	NULL),
(16,	'SecureSafe Login',	5,	0,	NULL,	NULL),
(17,	'Lean Development',	5,	0,	NULL,	NULL),
(18,	'Phasen',	6,	NULL,	NULL,	NULL),
(19,	'Verschlüsselungsalgorithmen',	6,	NULL,	NULL,	NULL),
(20,	'Methoden',	6,	NULL,	NULL,	NULL),
(21,	'Analyse',	7,	NULL,	NULL,	NULL),
(22,	'Design',	7,	NULL,	NULL,	NULL),
(23,	'Implementierung',	7,	NULL,	NULL,	NULL),
(24,	'Testdurchführung',	7,	NULL,	NULL,	NULL),
(25,	'Verbindlichkeit',	8,	1,	NULL,	NULL),
(26,	'Testbarkeit',	8,	0,	NULL,	NULL),
(27,	'Performance',	8,	0,	NULL,	NULL),
(28,	'Integrität',	9,	NULL,	NULL,	NULL),
(29,	'Verbindlichkeit',	9,	NULL,	NULL,	NULL),
(30,	'Authentizität',	9,	NULL,	NULL,	NULL),
(31,	'Vertraulichkeit',	9,	NULL,	NULL,	NULL),
(32,	'Verfügbarkeit',	9,	NULL,	NULL,	NULL),
(33,	'Integrität',	10,	NULL,	NULL,	NULL),
(34,	'Verbindlichkeit',	10,	NULL,	NULL,	NULL),
(35,	'Authentizität',	10,	NULL,	NULL,	NULL),
(36,	'Vertraulichkeit',	10,	NULL,	NULL,	NULL),
(37,	'Verfügbarkeit',	10,	NULL,	NULL,	NULL),
(38,	'Integrität',	11,	NULL,	NULL,	NULL),
(39,	'Verbindlichkeit',	11,	NULL,	NULL,	NULL),
(40,	'Authentizität',	11,	NULL,	NULL,	NULL),
(41,	'Vertraulichkeit',	11,	NULL,	NULL,	NULL),
(42,	'Verfügbarkeit',	11,	NULL,	NULL,	NULL),
(43,	'Integrität',	12,	NULL,	NULL,	NULL),
(44,	'Verbindlichkeit',	12,	NULL,	NULL,	NULL),
(45,	'Authentizität',	12,	NULL,	NULL,	NULL),
(46,	'Vertraulichkeit',	12,	NULL,	NULL,	NULL),
(47,	'Verfügbarkeit',	12,	NULL,	NULL,	NULL),
(48,	'Integrität',	13,	NULL,	NULL,	NULL),
(49,	'Verbindlichkeit',	13,	NULL,	NULL,	NULL),
(50,	'Authentizität',	13,	NULL,	NULL,	NULL),
(51,	'Vertraulichkeit',	13,	NULL,	NULL,	NULL),
(52,	'Verfügbarkeit',	13,	NULL,	NULL,	NULL),
(53,	'zu jedem Zeitpunkt eingehalten werden. ',	14,	1,	NULL,	NULL),
(54,	'nur in der Entwicklungsphase beachtet werden müssen. ',	14,	0,	NULL,	NULL),
(55,	'als Firewall dienen können. ',	14,	0,	NULL,	NULL),
(56,	'Integrität, Authentizität, Verbindlichkeit, Vertraulichkeit, Verfügbarkeit ',	15,	1,	NULL,	NULL),
(57,	'Authentizität, Vertraulichkeit, Identität, Verlässlichkeit, Verfügbarkeit ',	15,	0,	NULL,	NULL),
(58,	'Verbindlichkeit, Kongruenz, Vertraulichkeit, Verfügbarkeit, Autorität ',	15,	0,	NULL,	NULL),
(59,	'Autorität ',	16,	1,	NULL,	NULL),
(60,	'Integrität ',	16,	0,	NULL,	NULL),
(61,	'Authentizität ',	16,	0,	NULL,	NULL),
(62,	'Vertraulichkeit ',	16,	0,	NULL,	NULL),
(63,	'Secure ',	17,	NULL,	NULL,	NULL),
(64,	'Development ',	17,	NULL,	NULL,	NULL),
(65,	'Lifecycle ',	17,	NULL,	NULL,	NULL),
(66,	'Microsoft ',	18,	NULL,	NULL,	NULL),
(67,	'IBM ',	18,	NULL,	NULL,	NULL),
(68,	'Google ',	18,	NULL,	NULL,	NULL),
(69,	'W3C ',	18,	NULL,	NULL,	NULL),
(70,	'Planung',	19,	1,	NULL,	NULL),
(71,	'Testdurchführung',	19,	0,	NULL,	NULL),
(72,	'Design',	19,	0,	NULL,	NULL),
(73,	'Analyse',	20,	NULL,	NULL,	NULL),
(74,	'Design',	20,	NULL,	NULL,	NULL),
(75,	'Implementierung',	20,	NULL,	NULL,	NULL),
(76,	'Testdurchführung',	20,	NULL,	NULL,	NULL),
(77,	'Veröffentlichung & Wartung',	20,	NULL,	NULL,	NULL),
(78,	'Die Testdurchführung ',	21,	1,	NULL,	NULL),
(79,	'Die Analysephase',	21,	0,	NULL,	NULL),
(80,	'Die Designphase',	21,	0,	NULL,	NULL),
(81,	'Identity Management ',	22,	1,	NULL,	NULL),
(82,	'Passwortkontrolle ',	22,	0,	NULL,	NULL),
(83,	'Rechteverwaltung ',	22,	0,	NULL,	NULL),
(84,	'Zugriffskontrolle (Access Control) ',	23,	1,	NULL,	NULL),
(85,	'Login Mechanismen ',	23,	0,	NULL,	NULL),
(86,	'Passwortschutz (Verwendung von Sonderzeichen etc.) ',	23,	0,	NULL,	NULL),
(87,	'die Erfassung der Einlogdauer: wie lange befindet sich das System im angemeldeten Zustand ',	24,	1,	NULL,	NULL),
(88,	'die Repräsentation von Personen oder Objekten in einem System ',	24,	0,	NULL,	NULL),
(89,	'die Prüfung der Entität: ob eine Entität auch genau jene ist, für die sie sich ausgibt ',	24,	0,	NULL,	NULL),
(90,	'die Prüfung der Rechte: welche Rechte mit dieser Person (Entität) verknüpft sind ',	24,	0,	NULL,	NULL),
(91,	'authentisiert ',	25,	NULL,	NULL,	NULL),
(92,	'authentifiziert ',	25,	NULL,	NULL,	NULL),
(93,	'Vertraulichkeit ',	26,	NULL,	NULL,	NULL),
(94,	'Privatsphäre ',	26,	NULL,	NULL,	NULL),
(95,	'Eigenschaften ',	27,	NULL,	NULL,	NULL),
(96,	'digitalen Signatur ',	27,	NULL,	NULL,	NULL),
(97,	'Quelle ',	27,	NULL,	NULL,	NULL),
(98,	'Zurechenbarkeit ',	28,	NULL,	NULL,	NULL),
(99,	'Verlässlichkeit ',	28,	NULL,	NULL,	NULL),
(100,	'Verständlichkeit ',	28,	NULL,	NULL,	NULL),
(101,	'Über die Verschlüsselung sensibler Daten ',	29,	1,	NULL,	NULL),
(102,	'Über die Störung der zugrunde liegenden Infrastruktur ',	29,	0,	NULL,	NULL),
(103,	'Über die Schädigung des Dienstes ',	29,	0,	NULL,	NULL),
(104,	'Über die Veränderung der Daten selbst ',	29,	0,	NULL,	NULL),
(105,	'Änderung von Daten durch unautorisierte Benutzer ',	30,	1,	NULL,	NULL),
(106,	'Änderung von Daten durch autorisierte Benutzer ',	30,	0,	NULL,	NULL),
(107,	'Unterbrechung der Netzwerkverbindung ',	30,	0,	NULL,	NULL),
(108,	'Programierer:innen, die Software entwickeln, welche bösartigen Angriffen gewachsen sein muss.',	31,	1,	NULL,	NULL),
(109,	'Anwender:innen, werlche die Anwendung sicher verwenden möchten.',	31,	0,	NULL,	NULL),
(110,	'Student:innen, die sich für Datenschutz interessieren.',	31,	0,	NULL,	NULL),
(111,	'Planung',	32,	NULL,	NULL,	NULL),
(112,	'Analyse',	32,	NULL,	NULL,	NULL),
(113,	'Design',	32,	NULL,	NULL,	NULL),
(114,	'Implementierung',	32,	NULL,	NULL,	NULL),
(115,	'Testdurchführung',	32,	NULL,	NULL,	NULL),
(116,	'Veröffentlichung & Wartung',	32,	NULL,	NULL,	NULL),
(117,	'des Designs',	33,	NULL,	NULL,	NULL),
(118,	'der Testdurchführung',	33,	NULL,	NULL,	NULL),
(119,	'der Implementierung',	33,	NULL,	NULL,	NULL),
(120,	'der Implementierung',	34,	NULL,	NULL,	NULL),
(121,	'des Designs',	34,	NULL,	NULL,	NULL),
(122,	'der Testdurchführung',	34,	NULL,	NULL,	NULL),
(123,	'die umgehend behoben werden müssen. ',	35,	1,	NULL,	NULL),
(124,	'die man nicht mehr ändern kann und man muss Schwachstellen hinnehmen. ',	35,	0,	NULL,	NULL),
(125,	'sodass die Anwendung in so einem Fall neu entwickelt werden muss. ',	35,	0,	NULL,	NULL),
(126,	'Default ',	36,	NULL,	NULL,	NULL),
(127,	'Design ',	36,	NULL,	NULL,	NULL),
(128,	'Design ',	37,	NULL,	NULL,	NULL),
(129,	'Default ',	37,	NULL,	NULL,	NULL),
(130,	'Design ',	38,	NULL,	NULL,	NULL),
(131,	'Default ',	38,	NULL,	NULL,	NULL),
(132,	'Default ',	39,	NULL,	NULL,	NULL),
(133,	'Design ',	39,	NULL,	NULL,	NULL),
(134,	'Identity Management ',	40,	NULL,	NULL,	NULL),
(135,	'Verschlüsselung ',	40,	NULL,	NULL,	NULL),
(136,	'Verfügbarkeit ',	40,	NULL,	NULL,	NULL),
(137,	'die tatsächliche Person ',	41,	NULL,	NULL,	NULL),
(138,	'die reale Entität ',	41,	NULL,	NULL,	NULL),
(139,	'die technische Identität ',	41,	NULL,	NULL,	NULL),
(140,	'Authentisierung ',	42,	NULL,	NULL,	NULL),
(141,	'Authentifizierung ',	42,	NULL,	NULL,	NULL),
(142,	'Autorisierung ',	42,	NULL,	NULL,	NULL),
(143,	'Authentifizierung ',	43,	NULL,	NULL,	NULL),
(144,	'Authentisierung ',	43,	NULL,	NULL,	NULL),
(145,	'Autorisierung ',	43,	NULL,	NULL,	NULL),
(146,	'Autorisierung ',	44,	NULL,	NULL,	NULL),
(147,	'Authentifizierung ',	44,	NULL,	NULL,	NULL),
(148,	'Authentisierung ',	44,	NULL,	NULL,	NULL),
(149,	'Verwendung von Checksummen ',	45,	1,	NULL,	NULL),
(150,	'Einsatz von Firewalls ',	45,	0,	NULL,	NULL),
(151,	'Verschlüsselung der Daten ',	45,	0,	NULL,	NULL),
(152,	'die Authentizität ',	46,	NULL,	NULL,	NULL),
(153,	'die Verbindlichkeit ',	46,	NULL,	NULL,	NULL),
(154,	'die Verfügbarkeit ',	46,	NULL,	NULL,	NULL),
(155,	'Verbindlichkeit ',	47,	NULL,	NULL,	NULL),
(156,	'Vertraulichkeit ',	47,	NULL,	NULL,	NULL),
(157,	'Integrität ',	47,	NULL,	NULL,	NULL),
(158,	'minimale Ausfallzeit eines Systems ',	48,	1,	NULL,	NULL),
(159,	'Verwendung von Checksummen ',	48,	0,	NULL,	NULL),
(160,	'Änderung der Daten durch unautorisierte Benutzer ',	48,	0,	NULL,	NULL),
(161,	'Formatieren von Datenträgern ',	49,	1,	NULL,	NULL),
(162,	'Ablegen der Daten an einem Ort mit Zugriffsschutz ',	49,	0,	NULL,	NULL),
(163,	'Verschlüsselung der Daten ',	49,	0,	NULL,	NULL),
(164,	'Confidentiality (Vertraulichkeit) ',	50,	1,	NULL,	NULL),
(165,	'Integrity (Integrität) ',	50,	0,	NULL,	NULL),
(166,	'Availability (Verfügbarkeit) ',	50,	0,	NULL,	NULL),
(167,	'Accountability (Verbindlichkeit) ',	50,	0,	NULL,	NULL),
(168,	'Authenticity (Authentizität) ',	50,	0,	NULL,	NULL),
(169,	'Security & Privacy by Default ',	51,	1,	NULL,	NULL),
(170,	'Security & Privacy by Design ',	51,	0,	NULL,	NULL),
(171,	'Security by Default & Privacy by Design ',	51,	0,	NULL,	NULL),
(172,	'Security by Design & Privacy by Default ',	51,	0,	NULL,	NULL),
(173,	'sicherste ',	52,	NULL,	NULL,	NULL),
(174,	'performanteste ',	52,	NULL,	NULL,	NULL),
(175,	'individuellste ',	52,	NULL,	NULL,	NULL),
(176,	'Autorisierung ',	53,	NULL,	NULL,	NULL),
(177,	'Authentifizierung ',	53,	NULL,	NULL,	NULL),
(178,	'Authentisierung ',	53,	NULL,	NULL,	NULL),
(179,	'Identity Management in einer Anwendung zu integrieren ',	54,	1,	NULL,	NULL),
(180,	'Zugriffsrechte zu verteilen ',	54,	0,	NULL,	NULL),
(181,	'Passwörter sicher zu generieren ',	54,	0,	NULL,	NULL),
(182,	'wird mit Single Sign On auf sichere Art und Weise ermöglicht. ',	55,	1,	NULL,	NULL),
(183,	'die Aussage scheint mir ohne Weiteres eine gute Idee zu sein. ',	55,	0,	NULL,	NULL),
(184,	'wenn man sein Passwort immer mal wieder ändert, dann geht das schon. ',	55,	0,	NULL,	NULL),
(185,	'Zugriffskontrollen festgelegt ',	56,	1,	NULL,	NULL),
(186,	'Aktionen dokumentiert ',	56,	0,	NULL,	NULL),
(187,	'Berechtigungen abgelehnt ',	56,	0,	NULL,	NULL),
(188,	'Datenschutzsaspekte ',	57,	NULL,	NULL,	NULL),
(189,	'Datenssicherheitsaspekte ',	57,	NULL,	NULL,	NULL),
(190,	'Datenverschlüsselungsaspekte ',	57,	NULL,	NULL,	NULL),
(191,	'Security by Default ',	58,	1,	NULL,	NULL),
(192,	'Security by Design ',	58,	0,	NULL,	NULL),
(193,	'Privacy by Default ',	58,	0,	NULL,	NULL),
(194,	'Privacy by Design ',	58,	0,	NULL,	NULL),
(195,	'Security by Default ',	59,	1,	NULL,	NULL),
(196,	'Security by Design ',	59,	0,	NULL,	NULL),
(197,	'Privacy by Default ',	59,	0,	NULL,	NULL),
(198,	'Privacy by Design ',	59,	0,	NULL,	NULL),
(199,	'Privacy by Default ',	60,	1,	NULL,	NULL),
(200,	'Security by Default ',	60,	0,	NULL,	NULL),
(201,	'Privacy by Design ',	60,	0,	NULL,	NULL),
(202,	'Security by Design ',	60,	0,	NULL,	NULL);

DROP TABLE IF EXISTS `questions`;
CREATE TABLE `questions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `question` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `topic` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` int NOT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `lecture` int NOT NULL,
  `unit` int NOT NULL,
  `blanks` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `questions` (`id`, `question`, `topic`, `level`, `type`, `lecture`, `unit`, `blanks`, `created_at`, `updated_at`) VALUES
(1,	'In ___ der Produktentwicklung sollte Security unbedingt mitgedacht werden.',	'Secure Development Lifecycle',	1,	'dd',	1,	1,	'[\"allen Phasen\"]',	NULL,	NULL),
(2,	'Sicheres Produktdesign ist ___ des Entwicklungsprozesses mit zu bedenken.',	'Secure Development Lifecycle',	1,	'dd',	1,	1,	'[\"permanent während\"]',	NULL,	NULL),
(3,	'Security in der Softwareentwicklung ___ in allen Phasen des Development Lifecycles mit implementiert werden.',	'Secure Development Lifecycle',	1,	'dd',	1,	1,	'[\"muss\"]',	NULL,	NULL),
(4,	'Der Secure Development Lifecycle beschreibt',	'Secure Development Lifecycle',	1,	'mc',	1,	1,	NULL,	NULL,	NULL),
(5,	'Ein Modell, welches zur Entwicklung sicherer Software verwendet werden kann lautet',	'Secure Development Lifecycle',	1,	'mc',	1,	1,	NULL,	NULL,	NULL),
(6,	'Der Secure Development Lifecycle besteht aus aufeinander folgenden ___, die immer wieder von vorne durchlaufen werden.',	'Secure Development Lifecycle',	1,	'dd',	1,	1,	'[\"Phasen\"]',	NULL,	NULL),
(7,	'Die Phasen des Secure Development Lifecycles: Planung, ___, ___, ___, ___, Veröffentlichung & Wartung -\r\nSobald die letzte Phase erreicht ist, beginnt der Lifecycle wieder von vorn.',	'Secure Development Lifecycle',	1,	'dd',	1,	1,	'[\"Analyse\", \"Design\", \"Implementierung\", \"Testdurchführung\"]',	NULL,	NULL),
(8,	'Integrität, Authentizität, Vertraulichkeit, Verfügbarkeit - welches Schutzziel fehlt?',	'Schutzziele',	1,	'mc',	2,	1,	NULL,	NULL,	NULL),
(9,	'___ von Daten oder Ressourcen bedeutet, dass diese unverfälscht sind.',	'Schutzziele',	1,	'dd',	2,	1,	'[\"Integrität\"]',	NULL,	NULL),
(10,	'Für die ___ wird sichergestellt, dass ein bestimmtes Ereignis oder eine bestimmte Aktion einer Person zuzuordnen ist und von dieser nicht abgestritten werden kann.',	'Schutzziele',	1,	'dd',	2,	1,	'[\"Verbindlichkeit\"]',	NULL,	NULL),
(11,	'Die ___ beschreibt hauptsächlich die Echtheit der Quellen von Daten.',	'Schutzziele',	1,	'dd',	2,	1,	'[\"Authentizität\"]',	NULL,	NULL),
(12,	'Die ___ stellt die Geheimhaltung von Informationen gegenüber unberechtigten Dritten sicher.',	'Schutzziele',	1,	'dd',	2,	1,	'[\"Vertraulichkeit\"]',	NULL,	NULL),
(13,	'Die ___ von Daten oder Diensten ist gewährleistet, wenn sie erreichbar und erwartungskonform nutzbar sind.',	'Schutzziele',	1,	'dd',	2,	1,	'[\"Verfügbarkeit\"]',	NULL,	NULL),
(14,	'Kernziel der sicheren Softwareentwicklung ist es, dass die primären Schutzziele.',	'Schutzziele',	1,	'mc',	2,	1,	NULL,	NULL,	NULL),
(15,	'Welche 5 Schutzziele gehören zu den klassischen Schutzzielen?',	'Schutzziele',	1,	'mc',	3,	1,	NULL,	NULL,	NULL),
(16,	'Welches ist kein grundlegendes Schutzziel?',	'Schutzziele',	1,	'mc',	3,	1,	NULL,	NULL,	NULL),
(17,	'Das von Microsoft entwickelte Konzept zur Entwicklung sicherer Software nennt sich ___ ___ ___.',	'Secure Development Lifecycle',	2,	'dd',	3,	1,	'[\"Secure\", \"Development\", \"Lifecycle\"]',	NULL,	NULL),
(18,	'Der Secure Development Lifecycle wurde von ___ entwickelt.',	'Secure Development Lifecycle',	2,	'dd',	3,	1,	'[\"Microsoft\"]',	NULL,	NULL),
(19,	'Der Secure Development Lifecycle besteht aus mehreren Phasen, die sich immer wiederholen. Ein neuer Zyklus beginnt mit der Phase',	'Secure Development Lifecycle',	2,	'mc',	3,	1,	NULL,	NULL,	NULL),
(20,	'Die Phasen des Secure Development Lifecycle: Planung, ___, ___, ___, ___, ___ - Sobald die letzte Phase erreicht ist, beginnt der Lifecycle wieder von vorn.',	'Secure Development Lifecycle',	2,	'dd',	3,	1,	'[\"Analyse\", \"Design\", \"Implementierung\", \"Testdurchführung\", \"Veröffentlichung & Wartung\"]',	NULL,	NULL),
(21,	'Welche Phase folgt im Secure Development Lifecycle nach der Implementierungsphase?',	'Secure Development Lifecycle',	2,	'mc',	3,	1,	NULL,	NULL,	NULL),
(22,	'Wenn man die Identität von Personen (oder Systemen) und deren Rechte mit technischen Mitteln automatisiert prüft, handelt es sich um',	'Identity Management',	1,	'mc',	4,	1,	NULL,	NULL,	NULL),
(23,	'Identity Management ist eine Möglichkeit zur Realisation von',	'Identity Management',	1,	'mc',	4,	1,	NULL,	NULL,	NULL),
(24,	'Das Identity Management hat drei Aufgaben, welche gehört nicht dazu?',	'Identity Management',	1,	'mc',	4,	1,	NULL,	NULL,	NULL),
(25,	'Ein Benutzer ___ sich am Server. Der Server ___ den Benutzer.',	'Identity Management',	1,	'dd',	4,	1,	'[\"authentisiert\", \"authentifiziert\"]',	NULL,	NULL),
(26,	'Die Sicherheitsanforderung ___ ist eine Voraussetzung dafür, ___ zu schaffen.',	'Schutzziele',	2,	'dd',	4,	1,	'[\"Vertraulichkeit\", \"Privatsphäre\"]',	NULL,	NULL),
(27,	'Die Authentizität muss mit Hilfe bestimmter ___ überprüfbar sein, z.B einer ___, ob sie der ___ zuzuschreiben ist.',	'Schutzziele',	2,	'dd',	4,	1,	'[\"Eigenschaften\", \"digitalen Signatur\", \"Quelle\"]',	NULL,	NULL),
(28,	'Mit der Verbindlichkeit hängt die ___ eng zusammen, welche sicherstellt, dass eine Aktion oder ein Ereignis überhaupt einer Person zuzuordnen ist.',	'Schutzziele',	2,	'dd',	4,	1,	'[\"Zurechenbarkeit\"]',	NULL,	NULL),
(29,	'Die Verfügbarkeit von Daten oder Diensten kann über verschiedene Wege gestört werden. Auf welche nicht?',	'Schutzziele',	2,	'mc',	5,	1,	NULL,	NULL,	NULL),
(30,	'Welche der folgenden Bedrohungen gefährdet primär die Integrität von Daten?',	'Schutzziele',	2,	'mc',	5,	1,	NULL,	NULL,	NULL),
(31,	'Der Secure Development Lifecycle richtet sich an ',	'Secure Development Lifecycle',	3,	'mc',	5,	1,	NULL,	NULL,	NULL),
(32,	'Die Phasen des Secure Development Lifecycle:  ___, ___, ___, ___, ___, ___ - Sobald die letzte Phase erreicht ist, beginnt der Lifecycle wieder von vorn.',	'Secure Development Lifecycle',	3,	'dd',	5,	1,	'[\"Planung\", \"Analyse\", \"Design\", \"Implementierung\", \"Testdurchführung\", \"Veröffentlichung & Wartung\"]',	NULL,	NULL),
(33,	'Threat Modelling gehört in die Phase ___.',	'Secure Development Lifecycle',	3,	'dd',	5,	1,	'[\"des Designs\"]',	NULL,	NULL),
(34,	'Das Prüfen von Benutzereingaben vor der Verarbeitung gehört in die Phase ___.',	'Secure Development Lifecycle',	3,	'dd',	5,	1,	'[\"der Implementierung\"]',	NULL,	NULL),
(35,	'Wenn die Software bereits im Betrieb ist, dann werden oft noch Schwachstellen gefunden,',	'Secure Development Lifecycle',	3,	'mc',	5,	1,	NULL,	NULL,	NULL),
(36,	'Security by ___ bedeutet, dass in konfigurierbaren Systemen die Standardeinstellungen mit möglichst strengen Sicherheitsvorkehrungen versehen werden sollten.',	'Security/Privacy by Design/Default',	1,	'dd',	6,	1,	'[\"Default\"]',	NULL,	NULL),
(37,	'Security by ___ bedeutet, dass Bedrohungsszenarien für das zu gestaltende System im Vorwege analysiert, Schutzanforderungen an das System abgeleitet und entsprechende Mechanismen implementiert werden.',	'Security/Privacy by Design/Default',	1,	'dd',	6,	1,	'[\"Design\"]',	NULL,	NULL),
(38,	'Privacy by ___ bedeutet, dass in konfigurierbaren Systemen die Standardeinstellungen einen möglichst hohen Datenschutz vorsehen.',	'Security/Privacy by Design/Default',	1,	'dd',	6,	1,	'[\"Design\"]',	NULL,	NULL),
(39,	'Privacy by ___ bedeutet, dass im Vorwege definiert wird, auf welche Weise Daten überhaupt und wenn ja auf welchem Wege gespeichert werden müssen.',	'Security/Privacy by Design/Default',	1,	'dd',	6,	1,	'[\"Default\"]',	NULL,	NULL),
(40,	'Zugriffskontrolle wird durch ___ realisiert.',	'Identity Management',	2,	'dd',	6,	1,	'[\"Identity Management\"]',	NULL,	NULL),
(41,	'Um festzustellen, ob es sich bei einem eingeloggten Nutzer um ___ geht, müssen ___ und ___ mithilfe von Referenzdaten gebunden werden.',	'Identity Management',	2,	'dd',	6,	1,	'[\"die tatsächliche Person\", \"die reale Entität\", \"die technische Identität\"]',	NULL,	NULL),
(42,	'___ : eine Person muss zeigen, dass die entsprechende Identität zu ihr gehört.',	'Identity Management',	2,	'dd',	6,	1,	'[\"Authentisierung\"]',	NULL,	NULL),
(43,	'___ : das System prüft die Identität.',	'Identity Management',	2,	'dd',	7,	1,	'[\"Authentifizierung\"]',	NULL,	NULL),
(44,	'___ : Prüfen, welche Rechte die Entität nach der Authentifizierung hat.',	'Identity Management',	2,	'dd',	7,	1,	'[\"Autorisierung\"]',	NULL,	NULL),
(45,	'Welche der folgenden Maßnahmen dient vor Allem dem Schutzziel der Integrität von Daten?',	'Schutzziele',	3,	'mc',	7,	1,	NULL,	NULL,	NULL),
(46,	'Wenn ein Foto von einer bestimmten Kamera aufgenommen wurde, dann lässt sich daran ___ überprüfen.',	'Schutzziele',	3,	'dd',	7,	1,	'[\"die Authentizität\"]',	NULL,	NULL),
(47,	'Die ___ ist insbesondere für digitale Transaktionen wichtig. Bestimmte Verfahren prüfen, dass nur die angegebene Person diese durchführen darf.',	'Schutzziele',	3,	'dd',	7,	1,	'[\"Verbindlichkeit\"]',	NULL,	NULL),
(48,	'Welche Maßnahme unterstützt hauptsächlich das Schutzziel der Verfügbarkeit?',	'Schutzziele',	3,	'mc',	7,	1,	NULL,	NULL,	NULL),
(49,	'Die Geheimhaltung von Informationen kann auf unterschiedlichen Ebenen erfolgen. Auf welchem Wege ist die Geheimhaltung nicht sichergestellt?',	'Schutzziele',	3,	'mc',	7,	1,	NULL,	NULL,	NULL),
(50,	'Welches Schutzziel wird von Privacy by Design und by Default erreicht?',	'Security/Privacy by Design/Default',	2,	'mc',	8,	1,	NULL,	NULL,	NULL),
(51,	'Die Standardeinstellungen betreffen',	'Security/Privacy by Design/Default',	2,	'mc',	8,	1,	NULL,	NULL,	NULL),
(52,	'Nutzer sollten davon ausgehen können, dass die Ausgangskonfiguration der Anwendung die ___ Konfiguration ist.',	'Security/Privacy by Design/Default',	2,	'dd',	8,	1,	'[\"sicherste\"]',	NULL,	NULL),
(53,	'___ : Prüfen, welche Rechte die Entität nach der ___ hat.',	'Identity Management',	3,	'dd',	8,	1,	'[\"Autorisierung\", \"Authentifizierung\"]',	NULL,	NULL),
(54,	'Single Sign On ist eine Methode, um',	'Identity Management',	3,	'mc',	8,	1,	NULL,	NULL,	NULL),
(55,	'Mit nur einem Passwort kann sich ein Nutzer bei mehreren Anwendungen anmelden -',	'Identity Management',	3,	'mc',	8,	1,	NULL,	NULL,	NULL),
(56,	'Mithilfe eines Berechtigungssystems werden',	'Identity Management',	3,	'mc',	8,	1,	NULL,	NULL,	NULL),
(57,	'Privacy by Default/Design behandelt ___, Security by Default/Design hingegen ___.',	'Security/Privacy by Design/Default',	1,	'dd',	9,	1,	'[\"Datenschutzsaspekte\", \"Datenssicherheitsaspekte\"]',	NULL,	NULL),
(58,	'\"Nutzer müssen im Registrierungsprozess ein eigenes Passwort mit bestimmten Vorgaben angeben\" ist ein Beispiel für',	'Security/Privacy by Design/Default',	3,	'mc',	9,	1,	NULL,	NULL,	NULL),
(59,	'\"Die Standardeinstellungen der App sind die sichersten Einstellungen\" ist ein Beispiel für',	'Security/Privacy by Design/Default',	3,	'mc',	9,	1,	NULL,	NULL,	NULL),
(60,	'\"Nur die Daten zu erheben, die wirklich gebraucht werden\" ist ein Beispiel für',	'Security/Privacy by Design/Default',	3,	'mc',	9,	1,	NULL,	NULL,	NULL);

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `experience_points` int NOT NULL DEFAULT '0',
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `experience_points`, `remember_token`, `created_at`, `updated_at`) VALUES
(1,	'Testuser',	'test@test.de',	NULL,	'$2y$12$ivKh1uuOlV9RTxUeei9OX.VENBV213Z2z9lqUJL087mSdYKdgEUv.',	0,	NULL,	'2024-07-27 18:02:29',	'2024-07-27 18:02:29');

-- 2024-07-27 18:07:24
