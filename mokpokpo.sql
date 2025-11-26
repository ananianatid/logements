CREATE TABLE `etudiants` (
  `id` SERIAL PRIMARY KEY,
  `nom` VARCHAR(100) NOT NULL,
  `prenoms` VARCHAR(150) NOT NULL,
  `email` VARCHAR(150) UNIQUE NOT NULL,
  `telephone` VARCHAR(20),
  `sexe` VARCHAR(10) CHECK (sexe IN ('Masculin', 'Féminin', 'Autre')),
  `situation_familiale` VARCHAR(50) CHECK (situation_familiale IN ('Célibataire', 'Marié(e)', 'Avec enfants')),
  `date_obtention_baccalaureat` DATE NOT NULL,
  `matricule` VARCHAR(50) UNIQUE NOT NULL,
  `handicap` VARCHAR(100),
  `photo_profil` VARCHAR(255),
  `created_at` TIMESTAMP DEFAULT (CURRENT_TIMESTAMP),
  `updated_at` TIMESTAMP DEFAULT (CURRENT_TIMESTAMP)
);

CREATE TABLE `justificatifs` (
  `id` SERIAL PRIMARY KEY,
  `etudiant_id` INTEGER NOT NULL,
  `type_justificatif` VARCHAR(100) NOT NULL CHECK (type_justificatif IN ('Preuve de revenus', 'Certificat inscription', 'Autres')),
  `fichier_path` VARCHAR(255) NOT NULL,
  `date_depot` TIMESTAMP DEFAULT (CURRENT_TIMESTAMP),
  `statut` VARCHAR(50) CHECK (statut IN ('En attente', 'Validé', 'Rejeté')) DEFAULT 'En attente'
);

CREATE TABLE `antecedents_logement` (
  `id` SERIAL PRIMARY KEY,
  `etudiant_id` INTEGER NOT NULL,
  `annee_universitaire` VARCHAR(20) NOT NULL,
  `regularite_paiements` VARCHAR(50) CHECK (regularite_paiements IN ('Excellent', 'Bon', 'Moyen', 'Mauvais')),
  `troubles_colocation` BOOLEAN DEFAULT false,
  `description_troubles` TEXT,
  `created_at` TIMESTAMP DEFAULT (CURRENT_TIMESTAMP)
);

CREATE TABLE `batiments` (
  `id` SERIAL PRIMARY KEY,
  `nom` VARCHAR(100) UNIQUE NOT NULL,
  `type_batiment` VARCHAR(50) CHECK (type_batiment IN ('Résidence', 'Cité universitaire', 'Bloc')),
  `capacite_totale` INTEGER NOT NULL,
  `disponibilite` INTEGER NOT NULL DEFAULT 0,
  `adresse` VARCHAR(255),
  `description` TEXT,
  `created_at` TIMESTAMP DEFAULT (CURRENT_TIMESTAMP),
  `updated_at` TIMESTAMP DEFAULT (CURRENT_TIMESTAMP)
);

CREATE TABLE `appartements` (
  `id` SERIAL PRIMARY KEY,
  `batiment_id` INTEGER NOT NULL,
  `numero` VARCHAR(20) NOT NULL,
  `etage` INTEGER NOT NULL CHECK (etage >= 0),
  `type_appartement` VARCHAR(50) CHECK (type_appartement IN ('Studio', 'T1', 'T2', 'Chambre partagée')),
  `capacite_personnes` INTEGER DEFAULT 1,
  `disponibilite` BOOLEAN DEFAULT true,
  `etat` VARCHAR(50) CHECK (etat IN ('Neuf', 'Bon', 'Moyen', 'Nécessite réparations', 'Hors service')) DEFAULT 'Bon',
  `superficie` DECIMAL(6,2),
  `loyer_mensuel` DECIMAL(10,2) NOT NULL,
  `created_at` TIMESTAMP DEFAULT (CURRENT_TIMESTAMP),
  `updated_at` TIMESTAMP DEFAULT (CURRENT_TIMESTAMP)
);

CREATE TABLE `equipements_appartement` (
  `id` SERIAL PRIMARY KEY,
  `appartement_id` INTEGER NOT NULL,
  `nom_equipement` VARCHAR(100) NOT NULL,
  `quantite` INTEGER DEFAULT 1,
  `etat` VARCHAR(50) CHECK (etat IN ('Neuf', 'Bon', 'Usé', 'Défectueux'))
);

CREATE TABLE `dossiers_candidature` (
  `id` SERIAL PRIMARY KEY,
  `etudiant_id` INTEGER NOT NULL,
  `annee_universitaire` VARCHAR(20) NOT NULL,
  `date_soumission` TIMESTAMP DEFAULT (CURRENT_TIMESTAMP),
  `statut` VARCHAR(50) CHECK (statut IN ('En cours', 'Validé', 'Rejeté', 'En attente paiement', 'Attribué')) DEFAULT 'En cours',
  `score_selection` DECIMAL(5,2),
  `commentaire_admin` TEXT,
  `created_at` TIMESTAMP DEFAULT (CURRENT_TIMESTAMP),
  `updated_at` TIMESTAMP DEFAULT (CURRENT_TIMESTAMP)
);

CREATE TABLE `attributions_logement` (
  `id` SERIAL PRIMARY KEY,
  `dossier_candidature_id` INTEGER NOT NULL,
  `appartement_id` INTEGER NOT NULL,
  `date_attribution` DATE NOT NULL,
  `date_debut_contrat` DATE NOT NULL,
  `date_fin_contrat` DATE NOT NULL,
  `statut_attribution` VARCHAR(50) CHECK (statut_attribution IN ('Actif', 'Terminé', 'Résilié')) DEFAULT 'Actif',
  `created_at` TIMESTAMP DEFAULT (CURRENT_TIMESTAMP),
  `updated_at` TIMESTAMP DEFAULT (CURRENT_TIMESTAMP)
);

CREATE TABLE `contrats_habitation` (
  `id` SERIAL PRIMARY KEY,
  `attribution_id` INTEGER NOT NULL,
  `numero_contrat` VARCHAR(50) UNIQUE NOT NULL,
  `fichier_contrat_path` VARCHAR(255),
  `date_signature` DATE,
  `caution_montant` DECIMAL(10,2) NOT NULL,
  `caution_payee` BOOLEAN DEFAULT false,
  `reglement_signe` BOOLEAN DEFAULT false,
  `created_at` TIMESTAMP DEFAULT (CURRENT_TIMESTAMP)
);

CREATE TABLE `etats_lieux` (
  `id` SERIAL PRIMARY KEY,
  `attribution_id` INTEGER NOT NULL,
  `type_etat` VARCHAR(20) NOT NULL CHECK (type_etat IN ('Entrée', 'Sortie')),
  `date_etat` DATE NOT NULL,
  `observation_generale` TEXT,
  `agent_responsable` VARCHAR(100),
  `signature_etudiant_path` VARCHAR(255),
  `signature_agent_path` VARCHAR(255),
  `created_at` TIMESTAMP DEFAULT (CURRENT_TIMESTAMP)
);

CREATE TABLE `details_etat_lieux` (
  `id` SERIAL PRIMARY KEY,
  `etat_lieu_id` INTEGER NOT NULL,
  `element` VARCHAR(100) NOT NULL,
  `etat` VARCHAR(50) CHECK (etat IN ('Neuf', 'Bon', 'Moyen', 'Dégradé', 'Détérioré')),
  `observations` TEXT,
  `photo_path` VARCHAR(255)
);

CREATE TABLE `paiements` (
  `id` SERIAL PRIMARY KEY,
  `etudiant_id` INTEGER NOT NULL,
  `attribution_id` INTEGER,
  `type_paiement` VARCHAR(50) NOT NULL CHECK (type_paiement IN ('Caution', 'Loyer', 'Pénalité', 'Réparation')),
  `montant` DECIMAL(10,2) NOT NULL,
  `methode_paiement` VARCHAR(50) CHECK (methode_paiement IN ('Flooz', 'Mixx', 'Xpress', 'Virement bancaire', 'Espèces')),
  `reference_transaction` VARCHAR(100) UNIQUE,
  `statut_paiement` VARCHAR(50) CHECK (statut_paiement IN ('En attente', 'Validé', 'Échoué', 'Remboursé')) DEFAULT 'En attente',
  `date_paiement` TIMESTAMP DEFAULT (CURRENT_TIMESTAMP),
  `mois_concerne` VARCHAR(20),
  `recu_path` VARCHAR(255),
  `created_at` TIMESTAMP DEFAULT (CURRENT_TIMESTAMP)
);

CREATE TABLE `incidents_maintenance` (
  `id` SERIAL PRIMARY KEY,
  `appartement_id` INTEGER NOT NULL,
  `etudiant_id` INTEGER,
  `type_incident` VARCHAR(100) NOT NULL,
  `description` TEXT NOT NULL,
  `priorite` VARCHAR(20) CHECK (priorite IN ('Faible', 'Moyenne', 'Haute', 'Urgente')),
  `statut` VARCHAR(50) CHECK (statut IN ('Signalé', 'En cours', 'Résolu', 'Clôturé')) DEFAULT 'Signalé',
  `date_signalement` TIMESTAMP DEFAULT (CURRENT_TIMESTAMP),
  `date_resolution` TIMESTAMP,
  `technicien_assigne` VARCHAR(100),
  `cout_reparation` DECIMAL(10,2),
  `created_at` TIMESTAMP DEFAULT (CURRENT_TIMESTAMP),
  `updated_at` TIMESTAMP DEFAULT (CURRENT_TIMESTAMP)
);

CREATE TABLE `exclusions` (
  `id` SERIAL PRIMARY KEY,
  `etudiant_id` INTEGER NOT NULL,
  `attribution_id` INTEGER,
  `motif` VARCHAR(100) NOT NULL,
  `description_motif` TEXT,
  `date_decision` DATE NOT NULL,
  `statut_exclusion` VARCHAR(50) CHECK (statut_exclusion IN ('En cours', 'Effective', 'Annulée')) DEFAULT 'En cours',
  `date_effective` DATE,
  `agent_responsable` VARCHAR(100),
  `created_at` TIMESTAMP DEFAULT (CURRENT_TIMESTAMP)
);

CREATE TABLE `utilisateurs` (
  `id` SERIAL PRIMARY KEY,
  `nom` VARCHAR(100) NOT NULL,
  `prenoms` VARCHAR(150) NOT NULL,
  `email` VARCHAR(150) UNIQUE NOT NULL,
  `password_hash` VARCHAR(255) NOT NULL,
  `role` VARCHAR(50) NOT NULL CHECK (role IN ('Admin', 'Agent', 'Technicien', 'Comptable')),
  `actif` BOOLEAN DEFAULT true,
  `derniere_connexion` TIMESTAMP,
  `created_at` TIMESTAMP DEFAULT (CURRENT_TIMESTAMP),
  `updated_at` TIMESTAMP DEFAULT (CURRENT_TIMESTAMP)
);

CREATE TABLE `logs_activite` (
  `id` SERIAL PRIMARY KEY,
  `utilisateur_id` INTEGER,
  `action` VARCHAR(100) NOT NULL,
  `table_concernee` VARCHAR(50),
  `enregistrement_id` INTEGER,
  `details` TEXT,
  `ip_address` VARCHAR(50),
  `created_at` TIMESTAMP DEFAULT (CURRENT_TIMESTAMP)
);

CREATE INDEX `idx_etudiants_email` ON `etudiants` (`email`);

CREATE INDEX `idx_etudiants_matricule` ON `etudiants` (`matricule`);

CREATE UNIQUE INDEX `appartements_index_2` ON `appartements` (`batiment_id`, `numero`);

CREATE INDEX `idx_appartements_disponibilite` ON `appartements` (`disponibilite`);

CREATE INDEX `idx_dossiers_statut` ON `dossiers_candidature` (`statut`);

CREATE INDEX `idx_attributions_appartement` ON `attributions_logement` (`appartement_id`);

CREATE INDEX `idx_paiements_etudiant` ON `paiements` (`etudiant_id`);

CREATE INDEX `idx_paiements_statut` ON `paiements` (`statut_paiement`);

CREATE INDEX `idx_incidents_statut` ON `incidents_maintenance` (`statut`);

ALTER TABLE `justificatifs` ADD FOREIGN KEY (`etudiant_id`) REFERENCES `etudiants` (`id`) ON DELETE CASCADE;

ALTER TABLE `antecedents_logement` ADD FOREIGN KEY (`etudiant_id`) REFERENCES `etudiants` (`id`) ON DELETE CASCADE;

ALTER TABLE `appartements` ADD FOREIGN KEY (`batiment_id`) REFERENCES `batiments` (`id`) ON DELETE CASCADE;

ALTER TABLE `equipements_appartement` ADD FOREIGN KEY (`appartement_id`) REFERENCES `appartements` (`id`) ON DELETE CASCADE;

ALTER TABLE `dossiers_candidature` ADD FOREIGN KEY (`etudiant_id`) REFERENCES `etudiants` (`id`) ON DELETE CASCADE;

ALTER TABLE `attributions_logement` ADD FOREIGN KEY (`dossier_candidature_id`) REFERENCES `dossiers_candidature` (`id`) ON DELETE CASCADE;

ALTER TABLE `attributions_logement` ADD FOREIGN KEY (`appartement_id`) REFERENCES `appartements` (`id`);

ALTER TABLE `contrats_habitation` ADD FOREIGN KEY (`attribution_id`) REFERENCES `attributions_logement` (`id`) ON DELETE CASCADE;

ALTER TABLE `etats_lieux` ADD FOREIGN KEY (`attribution_id`) REFERENCES `attributions_logement` (`id`) ON DELETE CASCADE;

ALTER TABLE `details_etat_lieux` ADD FOREIGN KEY (`etat_lieu_id`) REFERENCES `etats_lieux` (`id`) ON DELETE CASCADE;

ALTER TABLE `paiements` ADD FOREIGN KEY (`etudiant_id`) REFERENCES `etudiants` (`id`) ON DELETE CASCADE;

ALTER TABLE `paiements` ADD FOREIGN KEY (`attribution_id`) REFERENCES `attributions_logement` (`id`);

ALTER TABLE `incidents_maintenance` ADD FOREIGN KEY (`appartement_id`) REFERENCES `appartements` (`id`) ON DELETE CASCADE;

ALTER TABLE `incidents_maintenance` ADD FOREIGN KEY (`etudiant_id`) REFERENCES `etudiants` (`id`);

ALTER TABLE `exclusions` ADD FOREIGN KEY (`etudiant_id`) REFERENCES `etudiants` (`id`) ON DELETE CASCADE;

ALTER TABLE `exclusions` ADD FOREIGN KEY (`attribution_id`) REFERENCES `attributions_logement` (`id`);

ALTER TABLE `logs_activite` ADD FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateurs` (`id`);
