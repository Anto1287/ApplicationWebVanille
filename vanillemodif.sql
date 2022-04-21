-- TABLES A INTEGRER DANS LA BASE VANILLE
--
-- Structure de la table `commande`
--

CREATE TABLE  commande (
  CDE_id int(3) NOT NULL,
  datecommande date DEFAULT NULL,
  nomPrenomClient varchar(50) DEFAULT NULL,
  adresseRueClient varchar(50) DEFAULT NULL,
  cpClient char(5) DEFAULT NULL,
  villeClient varchar(40) DEFAULT NULL,
  mailClient varchar(50) DEFAULT NULL,
  PRIMARY KEY (`CDE_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `contenir`
--

CREATE TABLE  contenir (
  idcommande int(3) NOT NULL,
  idProduit char(5) NOT NULL,
  PRIMARY KEY (idcommande,idProduit),
  KEY `I_FK_CONTENIR_Commande` (idcommande),
  KEY `I_FK_CONTENIR_Produit` (idProduit)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Contraintes pour la table `contenir`
--
ALTER TABLE contenir
  ADD CONSTRAINT `contenir_fk_1` FOREIGN KEY (idcommande) REFERENCES commande (CDE_id),
  ADD CONSTRAINT `contenir_fk_2` FOREIGN KEY (idProduit) REFERENCES produit (PDT_id);


