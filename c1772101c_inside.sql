-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : jeu. 23 juin 2022 à 12:39
-- Version du serveur :  10.3.34-MariaDB-cll-lve
-- Version de PHP : 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `c1772101c_inside`
--

-- --------------------------------------------------------

--
-- Structure de la table `demandes`
--

CREATE TABLE `demandes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `type_demande` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_depart` datetime NOT NULL,
  `date_retour` datetime NOT NULL,
  `fichier` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `statut` int(11) NOT NULL DEFAULT 0,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `demandes`
--

INSERT INTO `demandes` (`id`, `created_at`, `updated_at`, `type_demande`, `date_depart`, `date_retour`, `fichier`, `message`, `statut`, `user_id`) VALUES
(1, '2022-06-20 17:02:36', '2022-06-20 17:02:36', 'conge', '2022-06-21 20:30:00', '2022-06-29 22:00:00', 'http://inside.godeinter.ci/public/demandes/logo-1655751756.png', '&lt;pre class=&quot;wt-pre wt-pre_theme_light wt-offset-top-24 wt-offset-top-sm-48&quot;&gt;S&amp;eacute;lectionnez l\'outil d\'installation adapt&amp;eacute; pour Intel ou Apple Silicon&lt;/pre&gt;', 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `fonctions`
--

CREATE TABLE `fonctions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `libelle` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `fonctions`
--

INSERT INTO `fonctions` (`id`, `created_at`, `updated_at`, `libelle`, `description`) VALUES
(6, '2022-06-22 15:17:25', '2022-06-22 15:17:25', 'Développeur', 'Création de site web et d\'application mobile'),
(7, '2022-06-22 15:18:08', '2022-06-22 15:18:08', 'Comptabilité', 'Gestion des finances'),
(8, '2022-06-22 15:23:12', '2022-06-22 15:23:12', 'UX/UI Designer', 'Designer web/ mobile  et graphiste'),
(9, '2022-06-22 15:24:18', '2022-06-22 15:24:18', 'Commercial', 'Il développe les ventes en respectant la politique commerciale définie par l\'entreprise.'),
(10, '2022-06-22 15:26:41', '2022-06-22 15:26:41', 'Immobilier', 'Charger de la vente de terrain et de maisons'),
(11, '2022-06-22 15:31:02', '2022-06-22 15:31:02', 'Business unit', 'unités commerciales'),
(12, '2022-06-22 15:33:08', '2022-06-22 15:33:08', 'Social Media Manager', 'Le Social Media Manager (SMM) est en charge de la stratégie digitale de l’entreprise sur les réseaux sociaux.'),
(13, '2022-06-22 15:35:20', '2022-06-22 15:35:20', 'Marketing', 'Son objectif est de trouver de nouveaux clients et de gérer la relation client. Il doit également mettre en place des actions pour fidéliser les clients déjà acquis par la marque ou l\'entreprise.'),
(14, '2022-06-22 15:42:30', '2022-06-22 15:42:30', 'Multimédia', 'Assurer la couverture photos et/ou vidéos des évènements\r\nRéaliser les supports vidéo\r\nRéaliser les supports nécessaires à la promotion des produits et services (Visuels, plaquettes commerciales…)');

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_06_20_004048_demandes', 2),
(6, '2022_06_20_144318_create_demandes_table', 3),
(7, '2022_06_22_132142_create_fonctions_table', 4);

-- --------------------------------------------------------

--
-- Structure de la table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenoms` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fonction_id` int(11) NOT NULL,
  `role` tinyint(4) NOT NULL DEFAULT 1,
  `adresse` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `debut` date NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `statut` tinyint(1) NOT NULL DEFAULT 0,
  `avatars` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `prenoms`, `telephone`, `fonction_id`, `role`, `adresse`, `debut`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `statut`, `avatars`, `created_by`) VALUES
(2, 'Ivan2222', 'IVAN22', '080808080822', 6, 3, 'ABIDJAN2', '2022-05-19', 'info@test.com', NULL, '$2y$10$6kmdYw.LAXtUMYQb/L7guOECj81BWr46s1BoCXS3oU7v3npnQuzci', NULL, '2022-06-19 21:22:05', '2022-06-19 21:47:15', 1, '/images/avatars/avatar.png', ' '),
(3, 'Koffi', 'Paul Andre', '0565165109', 8, 3, 'Yopougon', '2022-06-27', 'paul-andre@propulsegroup.com', NULL, '$2y$10$9./HbKZw6Mv4apqtWaqqx.OtJx.YH38grEL8pS2g2AhnhpFsDRJgS', NULL, '2022-06-22 16:14:30', '2022-06-22 16:14:30', 1, '/images/avatars/avatar.png', ' ');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `demandes`
--
ALTER TABLE `demandes`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Index pour la table `fonctions`
--
ALTER TABLE `fonctions`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Index pour la table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `demandes`
--
ALTER TABLE `demandes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `fonctions`
--
ALTER TABLE `fonctions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
