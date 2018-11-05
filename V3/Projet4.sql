-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le :  sam. 03 nov. 2018 à 14:09
-- Version du serveur :  5.7.23
-- Version de PHP :  7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données :  `Projet4`
--

-- --------------------------------------------------------

--
-- Structure de la table `chapters`
--

CREATE TABLE `chapters` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `creation_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `chapters`
--

INSERT INTO `chapters` (`id`, `title`, `author`, `content`, `creation_date`) VALUES
(1, 'Lorem Ipsum 1', 'Jean Forteroche', 'At nunc si ad aliquem bene nummatum tumentemque ideo honestus advena salutatum introieris, primitus tamquam exoptatus suscipieris et interrogatus multa coactusque mentiri, miraberis numquam antea visus summatem virum tenuem te sic enixius observantem, ut paeniteat ob haec bona tamquam praecipua non vidisse ante decennium Romam.', '2018-04-16 16:07:16'),
(2, 'Lorem Ipsum 2', 'Jean Forteroche', 'Itaque verae amicitiae difficillime reperiuntur in iis qui in honoribus reque publica versantur; ubi enim istum invenias qui honorem amici anteponat suo? Quid? Haec ut omittam, quam graves, quam difficiles plerisque videntur calamitatum societates! Ad quas non est facile inventu qui descendant. Quamquam Ennius recte', '2018-04-17 16:07:16'),
(3, 'Lorem Ipsum 3', 'Jean Forteroche', 'Et est admodum mirum videre plebem innumeram mentibus ardore quodam infuso cum dimicationum curulium eventu pendentem. haec similiaque memorabile nihil vel serium agi Romae permittunt. ergo redeundum ad textum.', '2018-04-18 16:07:16'),
(4, 'Lorem Ipsum 4', 'Jean Forteroche', 'Per hoc minui studium suum existimans Paulus, ut erat in conplicandis negotiis artifex dirus, unde ei Catenae inditum est cognomentum, vicarium ipsum eos quibus praeerat adhuc defensantem ad sortem periculorum communium traxit. et instabat ut eum quoque cum tribunis et aliis pluribus ad comitatum imperatoris vinctum perduceret: quo percitus ille exitio urgente abrupto ferro eundem adoritur Paulum. et quia languente dextera, letaliter ferire non potuit, iam districtum mucronem in proprium latus inpegit. hocque deformi genere mortis excessit e vita iustissimus rector ausus miserabiles casus levare multorum.', '2018-04-19 16:07:16'),
(5, 'Lorem Ipsum 5', 'Jean Forteroche', 'Hacque adfabilitate confisus cum eadem postridie feceris, ut incognitus haerebis et repentinus, hortatore illo hesterno clientes numerando, qui sis vel unde venias diutius ambigente agnitus vero tandem et adscitus in amicitiam si te salutandi adsiduitati dederis triennio indiscretus et per tot dierum defueris tempus, reverteris ad paria perferenda, nec ubi esses interrogatus et quo tandem miser discesseris, aetatem omnem frustra in stipite conteres summittendo.', '2018-04-20 16:07:16'),
(6, 'Lorem Ipsum 6', 'Jean Forteroche', 'Hacque adfabilitate confisus cum eadem postridie feceris, ut incognitus haerebis et repentinus, hortatore illo hesterno clientes numerando, qui sis vel unde venias diutius ambigente agnitus vero tandem et adscitus in amicitiam si te salutandi adsiduitati dederis triennio indiscretus et per tot dierum defueris tempus, reverteris ad paria perferenda, nec ubi esses interrogatus et quo tandem miser discesseris, aetatem omnem frustra in stipite conteres summittendo.', '2018-04-20 23:07:16'),
(7, 'Lorem Ipsum 7', 'Jean Forteroche', 'Illud autem non dubitatur quod cum esset aliquando virtutum omnium domicilium Roma, ingenuos advenas plerique nobilium, ut Homerici bacarum suavitate Lotophagi, humanitatis multiformibus officiis retentabant.', '2018-05-11 11:55:49'),
(8, 'Lorem Ipsum 8', 'Jean Forteroche', 'Ut enim quisque sibi plurimum confidit et ut quisque maxime virtute et sapientia sic munitus est, ut nullo egeat suaque omnia in se ipso posita iudicet, ita in amicitiis expetendis colendisque maxime excellit. Quid enim? Africanus indigens mei? Minime hercule! ac ne ego quidem illius; sed ego admiratione quadam virtutis eius, ille vicissim opinione fortasse non nulla, quam de meis moribus habebat, me dilexit; auxit benevolentiam consuetudo. Sed quamquam utilitates multae et magnae consecutae sunt, non sunt tamen ab earum spe causae diligendi profectae.', '2018-05-11 12:04:12'),
(9, 'Lorem Ipsum 9', 'Jean Forteroche', 'Altera sententia est, quae definit amicitiam paribus officiis ac voluntatibus. Hoc quidem est nimis exigue et exiliter ad calculos vocare amicitiam, ut par sit ratio acceptorum et datorum. Divitior mihi et affluentior videtur esse vera amicitia nec observare restricte, ne plus reddat quam acceperit; neque enim verendum est, ne quid excidat, aut ne quid in terram defluat, aut ne plus aequo quid in amicitiam congeratur.', '2018-05-21 19:55:29');

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `id_chapter` int(11) NOT NULL,
  `author` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `comment_date` datetime NOT NULL,
  `update_date` datetime NOT NULL,
  `reporting` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `comments`
--

INSERT INTO `comments` (`id`, `id_chapter`, `author`, `comment`, `comment_date`, `update_date`, `reporting`) VALUES
(1, 1, 'Adrien', 'Ex his quidam aeternitati se commendari posse per', '2018-04-19 14:48:00', '2018-04-19 14:48:00', 1),
(2, 2, 'Marion', 'Ex turba vero imae sortis et paupertinae in', '2018-04-19 14:50:00', '2018-04-19 14:50:00', 0),
(3, 5, 'Jérémy', 'MAJ, Et licet quocumque oculos flexeris feminas adfatim', '2018-04-19 15:57:00', '2018-05-12 18:59:23', 0),
(4, 5, 'Amélie', 'Rogatus ad ultimum admissusque in consistorium', '2018-04-19 16:06:00', '2018-04-19 16:06:00', 1),
(5, 5, 'Adeline', 'Alii summum decus in carruchis solito altioribus', '2018-04-19 16:08:00', '2018-04-19 16:08:00', 0),
(6, 5, 'Livio', 'Sed quid est quod in hac causa maxime homines', '2018-04-20 08:45:27', '2018-04-20 08:45:27', 0),
(7, 5, 'Marion', 'Tempore quo primis auspiciis in mundanum fulgorem', '2018-04-21 11:51:38', '2018-04-21 11:51:38', 1),
(10, 6, 'Paul Walk', 'MAJ, In his tractibus navigerum nusquam visitur flumen', '2018-04-28 14:58:39', '2018-04-28 14:58:39', 1),
(11, 2, 'Jean Forteroche', 'MAJ, Itaque tum Scaevola cum in eam ipsam mentionem', '2018-04-28 14:58:04', '2018-04-28 14:58:04', 0),
(12, 6, 'Adrien', 'MAJ Version Membre, Has autem provincias, quas Orontes ambiens amnis OK MAJ 2.1', '2018-04-28 15:12:09', '2018-06-14 22:30:28', 0),
(13, 6, 'Adri-one', 'MAJ, Iamque non umbratis fallaciis res agebatur, sed V2', '2018-04-28 22:09:26', '2018-05-15 15:22:40', 0),
(14, 6, 'Livio', 'MAJ, Itaque tum Scaevola cum in eam ipsam mentionem', '2018-04-29 17:10:49', '2018-05-11 17:38:37', 0),
(15, 4, 'Hector', 'Sin autem ad adulescentiam perduxissent, dirimi', '2018-04-29 17:40:49', '2018-04-29 17:40:49', 0),
(16, 1, 'Ludi', 'Inter quos Paulus eminebat notarius ortus in', '2018-04-29 18:04:21', '2018-04-29 18:04:21', 0),
(18, 4, 'Odin', 'Et olim licet otiosae sint tribus pacataeque', '2018-04-29 18:08:14', '2018-04-29 18:08:14', 0),
(19, 4, 'Sacha', 'Inter haec Orfitus praefecti potestate regebat', '2018-04-29 18:31:51', '2018-04-29 18:31:51', 0),
(20, 1, 'Kevin', 'Haec ubi latius fama vulgasset missaeque', '2018-04-29 19:17:00', '2018-04-29 19:17:00', 0),
(21, 2, 'Michel', 'Haec ubi latius fama vulgasset missaeque ', '2018-04-29 19:21:30', '2018-04-29 19:21:30', 0),
(22, 3, 'Alice', 'Accenderat super his incitatum propositum ad\r\nEt est admodum mirum videre plebem innumeram', '2018-04-29 19:24:39', '2018-04-29 19:24:39', 0),
(23, 3, 'Jean Forteroche', 'Et quia Montius inter dilancinantium manus', '2018-04-29 19:28:37', '2018-04-29 19:28:37', 0),
(24, 3, 'Marine', 'Ex turba vero imae sortis et paupertinae in', '2018-04-29 19:30:15', '2018-04-29 19:30:15', 0),
(25, 3, 'Ad', 'Hacque adfabilitate confisus cum eadem postridie', '2018-04-29 19:32:24', '2018-04-29 19:32:24', 0),
(26, 3, 'Paolo', 'Martinus agens illas provincias pro praefectis', '2018-04-29 19:32:54', '2018-04-29 19:32:54', 0),
(27, 3, 'Ad', 'His cognitis Gallus ut serpens adpetitus telo vel', '2018-04-29 19:33:26', '2018-04-29 19:33:26', 0),
(28, 4, 'Paul', 'At nunc si ad aliquem bene nummatum tumentemque', '2018-05-04 15:23:52', '2018-05-04 15:23:52', 0),
(29, 6, 'Gabriel', 'Le site que tu as créer est super.', '2018-05-09 13:37:20', '2018-05-09 13:37:20', 0),
(30, 6, 'Adrien', 'Alios autem dicere aiunt multo etiam inhumanius (quem locum breviter paulo ante perstrinxi) ', '2018-06-21 18:17:14', '2018-06-21 18:17:14', 0),
(31, 6, 'Adrien', 'Quaestione igitur per multiplices dilatata fortunas cum ambigerentur quaedam,', '2018-06-21 18:17:42', '2018-06-21 18:17:42', 0),
(32, 8, 'Adrien', 'Quam ob rem vita quidem talis fuit vel fortuna vel gloria, ut nihil posset accedere', '2018-06-21 18:21:23', '2018-06-21 18:21:23', 0),
(33, 9, 'Gabriel', 'Si seulement je m\'étais attendu à un moment pareil ! J\'en ai encore le souffle coupé', '2018-07-08 10:49:44', '2018-07-08 10:49:44', 1),
(34, 9, 'Adrien', 'impressionnant !', '2018-08-09 15:37:03', '2018-08-09 15:38:19', 0),
(35, 9, 'Kevin', 'Trop bien l\'article !', '2018-09-01 18:35:43', '2018-09-01 18:35:43', 1),
(36, 7, 'Kevin', 'Le caca c\'est délicieux', '2018-09-01 18:36:11', '2018-09-01 18:36:11', 0),
(37, 7, 'fezfezfez', 'fekzfe', '2018-09-01 18:40:13', '2018-09-01 18:40:13', 0);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `id_group` int(11) NOT NULL,
  `pseudo` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `registration_date` datetime NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `birthday_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `id_group`, `pseudo`, `pass`, `email`, `registration_date`, `firstname`, `surname`, `birthday_date`) VALUES
(1, 1, 'Jean Forteroche', '$2y$10$boUSvyjj3./Mw9WE.YnoLubdciJQoSpHEYQKGWgliiDxwqEBuN0sC', 'jeanforteroche@alaska.com', '2018-04-28 18:18:00', 'Jean', 'Forteroche', '1986-07-23'),
(3, 2, 'Adrien', '$2y$10$RtrMfYhMbFFIzlYQXUyM/.XphfJtDNUBhMvAEmDPAGmbxseAKrDh.', 'adrien_lol@gmail.com', '2018-05-03 16:31:29', 'Adrien', 'Morim', '1986-08-09'),
(4, 1, 'Marion', '$2y$10$Fvgyz9dfoxKC5THoUV2KtOiL8LeQ1wNFgCAfERdkHNLeEMjJVilOq', 'marion.aze@gmail.com', '2018-05-15 20:25:25', '', '', '0000-00-00'),
(5, 2, 'Kevin', '$2y$10$omUJcIHMuFZaoBg95FJ3gOdiiDb39Y9OpEY60eyLIxSz00TJs6wQa', 'kevin@gmail.com', '2018-06-24 15:36:41', '', '', '0000-00-00');

-- --------------------------------------------------------

--
-- Structure de la table `users_group`
--

CREATE TABLE `users_group` (
  `id` int(11) NOT NULL,
  `group_level` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users_group`
--

INSERT INTO `users_group` (`id`, `group_level`) VALUES
(1, 'administrateur'),
(2, 'membre');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `chapters`
--
ALTER TABLE `chapters`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users_group`
--
ALTER TABLE `users_group`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `chapters`
--
ALTER TABLE `chapters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `users_group`
--
ALTER TABLE `users_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
