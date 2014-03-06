/* CREATION DE LA STRUCTURE */

CREATE TABLE m5f_categorie
(
	idCat INTEGER NOT NULL IDENTITY(1,1) PRIMARY KEY,
	nomCat VARCHAR(70) NOT NULL
);

CREATE TABLE m5f_document 
(
	idReference VARCHAR(32) NOT NULL PRIMARY KEY,
	intituleDoc VARCHAR(255) NOT NULL,
	date DATE NOT NULL,
	description TEXT NOT NULL,
	validee BIT NOT NULL,
	exemple TEXT NOT NULL,
	idSousCat INTEGER NOT NULL,
	lienTelechargement VARCHAR(255) NOT NULL
);

CREATE TABLE m5f_contact
(
  idFormContact INTEGER NOT NULL IDENTITY(1,1) PRIMARY KEY,
  objet VARCHAR(255) NOT NULL,
  contenu TEXT NOT NULL,
  lu BIT NOT NULL,
  date DATETIME NOT NULL,
  idUser INTEGER NOT NULL
);

CREATE TABLE m5f_tmp
(
  idReferenceTmp VARCHAR(32) NOT NULL PRIMARY KEY,
  intituleTmp VARCHAR(255) NOT NULL,
  descriptionTmp TEXT NOT NULL,
  dateTmp DATE NOT NULL,
  etatTmp VARCHAR(32) NOT NULL,
  exempleTmp TEXT NOT NULL,
  commentaireTmp TEXT,
  lienTelechargementTmp VARCHAR(255) NOT NULL,
  idSousCat INTEGER NOT NULL,
  idUser INTEGER NOT NULL,
);

CREATE TABLE m5f_sous_categorie
(
  idSousCat INTEGER NOT NULL IDENTITY(1,1) PRIMARY KEY,
  nomSousCat VARCHAR(70) NOT NULL,
  idCat INTEGER NOT NULL
);

CREATE TABLE m5f_user (
  idUser INTEGER NOT NULL IDENTITY(1,1) PRIMARY KEY,
  login VARCHAR(70) NOT NULL,
  mdp VARCHAR(255) NOT NULL,
  nom VARCHAR(70) NOT NULL,
  prenom VARCHAR(70) NOT NULL,
  mail VARCHAR(255) NOT NULL,
  fonction VARCHAR(255) NOT NULL
);


/* AFFECTATION DES CLES ETRANGERE */

ALTER TABLE m5f_document 
ADD FOREIGN KEY (idSousCat) REFERENCES m5f_sous_categorie (idSousCat);

ALTER TABLE m5f_contact 
ADD FOREIGN KEY (idUser) REFERENCES m5f_user (idUser);

ALTER TABLE m5f_tmp
ADD FOREIGN KEY (idUser) REFERENCES m5f_user (idUser);

ALTER TABLE m5f_tmp
ADD FOREIGN KEY (idSousCat) REFERENCES m5f_sous_categorie (idSousCat);

ALTER TABLE m5f_sous_categorie
ADD FOREIGN KEY (idCat) REFERENCES m5f_categorie (idCat);

ALTER TABLE m5f_contact
ADD FOREIGN KEY (idUser) REFERENCES m5f_user (idUser);

/* AFFECTION DES DONNEES DANS LA BDD */

/* UTILISATEURS */
	INSERT INTO m5f_user VALUES ('Administrateur','372eeffaba2b5b61fb02513ecb84f1ff','Administrateur','Administrateur','Administrateur@m5f.fr','Administrateur');
	INSERT INTO m5f_user VALUES ('Contributeur','81776c3f1261e1127d603b9f85c9bebe','Contributeur','Contributeur','Contributeur@m5f.fr','Contributeur');
	INSERT INTO m5f_user VALUES ('Accesseur','470a8dee531118e609b7478e7e554fa1','Accesseur','Accesseur','Accesseur@m5f.fr','Accesseur');

/* CATEGORIE */
	INSERT INTO m5f_categorie VALUES ('Réseaux');	/* id = 1 */
	INSERT INTO m5f_categorie VALUES ('Système'); /* id = 2 */
	INSERT INTO m5f_categorie VALUES ('Développement');	/* id = 3 */

	/* SOUS-CATEGORIE */
	INSERT INTO m5f_sous_categorie VALUES ('AdressageIP',1); /* id = 1 */
	INSERT INTO m5f_sous_categorie VALUES ('VLAN',1); /* id = 2 */
	INSERT INTO m5f_sous_categorie VALUES ('Modèle OSI',1); /* id = 3 */
	INSERT INTO m5f_sous_categorie VALUES ('Protocole',1); /* id = 4 */
	INSERT INTO m5f_sous_categorie VALUES ('TCP/IP',1); /* id = 5 */
	INSERT INTO m5f_sous_categorie VALUES ('UDP',1); /* id = 6 */
	INSERT INTO m5f_sous_categorie VALUES ('Paquet',1); /* id = 7 */

	INSERT INTO m5f_sous_categorie VALUES ('CommandeDOS',2); /* id = 8 */
	INSERT INTO m5f_sous_categorie VALUES ('PowerShell',2); /* id = 9 */
	INSERT INTO m5f_sous_categorie VALUES ('Administration',2); /* id = 10 */
	INSERT INTO m5f_sous_categorie VALUES ('Serveur',2); /* id = 11 */
	INSERT INTO m5f_sous_categorie VALUES ('Linux',2); /* id = 12 */
	INSERT INTO m5f_sous_categorie VALUES ('Active directory',2); /* id = 13 */
	INSERT INTO m5f_sous_categorie VALUES ('DHCP',2); /* id = 14 */
	
	INSERT INTO m5f_sous_categorie VALUES ('JAVA',3); /* id = 15 */
	INSERT INTO m5f_sous_categorie VALUES ('C#',3); /* id = 16 */
	INSERT INTO m5f_sous_categorie VALUES ('C++',3); /* id = 17 */
	INSERT INTO m5f_sous_categorie VALUES ('C',3); /* id = 18 */
	INSERT INTO m5f_sous_categorie VALUES ('Delphi',3); /* id = 19 */
	INSERT INTO m5f_sous_categorie VALUES ('COBOL',3); /* id = 20 */
	INSERT INTO m5f_sous_categorie VALUES ('Javascript',3); /* id = 21 */
	INSERT INTO m5f_sous_categorie VALUES ('Perl',3); /* id = 22 */
	INSERT INTO m5f_sous_categorie VALUES ('VB',3); /* id = 23 */
	INSERT INTO m5f_sous_categorie VALUES ('Fortran',3); /* id = 24 */
	INSERT INTO m5f_sous_categorie VALUES ('PHP',3); /* id = 25 */
	INSERT INTO m5f_sous_categorie VALUES ('MySQL',3); /* id = 26 */
	INSERT INTO m5f_sous_categorie VALUES ('maxDB',3); /* id = 27 */
	INSERT INTO m5f_sous_categorie VALUES ('PostgreSQL',3); /* id = 28 */


/* DOCUMENT */
	INSERT INTO m5f_document VALUES(1,'UDP','02-24-2014','A quoi sert un UDP?', 'TRUE', 'Le paquet UDP est encapsulé dans un paquet IP. Il comporte un en-tête suivi des données proprement dites à transporter[...].', 6,'UDP.zip');
	
	INSERT INTO m5f_document VALUES(2,'Paquet','01-13-2014', 'Qu''est ce qu''un paquet?', 'TRUE','Afin de transmettre un message d''une machine à une autre sur un réseau, celui-ci est découpé en plusieurs paquets transmis séparément[...].', 7, 'Paquet.zip');
	
	INSERT INTO m5f_document VALUES(3,'VLAN', '02-14-2014', 'Qu''est ce qu''un VLAN', 'TRUE', 'Un réseau local virtuel, communément appelé VLAN, est un réseau informatique logique indépendant. De nombreux VLAN peuvent coexister sur un même commutateur réseau[...].', 2, 'VLAN.zip');
	
	INSERT INTO m5f_document VALUES(4,'Modèle OSI', '04-06-2013', 'Le modèle OSI', 'TRUE', ' C''est un modèle de communications entre ordinateurs proposé par l''ISO qui décrit les fonctionnalités nécessaires à la communication et l''organisation de ces fonctions[...].', 3, 'OSI.zip');

	INSERT INTO m5f_document VALUES(5,'DHCP', '02-15-2014', 'Configuration d''un DHCP', 'TRUE', 'Pour qu’un serveur DHCP puisse servir des adresses IP, il est nécessaire de lui donner un « réservoir » d’adresses dans lequel il pourra puiser : c’est la plage d’adresses (address range).
										Il est possible de définir plusieurs plages, disjointes ou contiguës.
										Les adresses du segment qui ne figurent dans aucune plage mise à la disposition du serveur DHCP ne seront en aucun cas distribuées,
										et peuvent faire l’objet d’affectations statiques (couramment : pour les serveurs nécessitant une adresse IP fixe, les routeurs, les imprimantes réseau…).[...]',
									14, 'DHCP.zip');

	INSERT INTO m5f_document VALUES(6,'CommandeDOS', '10-18-2013', 'Quelles sont les differentes commande DOS?', 'TRUE', 'Les principales commandes MS DOS sont :
										- CD Changer de répertoire
										- COPY Copier des fichiers
										- DEL Effacer un fichier
										- DELTREE Effacer un répertoire
										- DIR Afficher la liste des dossiers et fichiers
										- EDIT Editer un fichier texte ou batch
										- FDISK Créer et afficher les partitions
										- FORMAT Formater un disque
										- HELP liste les commandes disponibles et les paramètres
										- KEYB Changer le type de clavier (KEYB US ou KEYB FR)
										- MD Créer un répertoire
										- TYPE Afficher un fichier texte
										- XCOPY Copier des fichiers et des répertoires',
									 8, 'DOS.zip');

	INSERT INTO m5f_document VALUES(7,'Commande Linux', '02-23-2014', 'Quelles sont les commandes Linux?', 'TRUE',
										'Les principales commande linux sont:
										 - ls --> liste le contenu d''un répertoire
										 - cd --> change de répertoire
										 - cd .. --> répertoire parent
										 - mkdir --> crée un nouveau répertoire
										 - rmdir --> supprime un répertoire
										 - cp --> copie le fichier
										 - mv --> déplace le fichier
										 - rm --> supprime le fichier',
									12, 'Linux.zip');

	INSERT INTO m5f_document VALUES(8,'Active directory', '02-25-2014', 'Mettre en place un AD', 'TRUE',
										'Active Directory (AD) est la mise en œuvre par Microsoft des services d''annuaire LDAP pour les systèmes d''exploitation Windows.
										 L''objectif principal d''Active Directory est de fournir des services centralisés d''identification 
										 et d''authentification à un réseau d''ordinateurs utilisant le système Windows.',
									13, 'AD.zip');

	INSERT INTO m5f_document VALUES(9,'HelloWorld', '01-02-2014', '1er fonction en C++', 'TRUE',
										'#include <iostream>
										using namespace std;

										int main ()
										{
											cout << "Hello World!";
											return 0;
										}',
									17, 'hello.zip');

	INSERT INTO m5f_document VALUES(10,'TriBulle', '02-01-2014', 'Fonction tri bulle', 'TRUE',
										'public class Mtab2
										{
												// remplir
												// disp
												//méthode tri à bulles
												public static void tribulles(int t[])
												{
														for (int i=0 ;i<=(t.length-2);i++)
																for (int j=(t.length-1);i < j;j--)
																		if (t[j] < t[j-1])
																		{
																				int x=t[j-1];
																				t[j-1]=t[j];
																				t[j]=x;
																		}
												} // fin tri
												// recherche
												public static void main(String  args[])
												{
														TextWindow.print("Entrer la taille du tableau");
														int taille=TextWindow.readInt();
														TextWindow.printLine("\n\n taille="+taille+"\n");
														int []t ;
														t=new int[taille] ;
														remplir(t) ;
														TextWindow.printLine("Avant le tri");
														disp(t) ;
														tribulles(t) ;
														TextWindow.printLine("Après le tri");
														disp(t) ;
														TextWindow.print("Entrer le nb x à chercher");
														int x=TextWindow.readInt() ;
														if(recherche(t,x)) TextWindow.pintLine(x+"est ds t");
														else TextWindow.printLine(x+"n’est pas ds t");
												} // fin main
										} // fin class',
									15, 'TriBulle.zip');
	
	INSERT INTO m5f_document VALUES(11,);
	
	INSERT INTO m5f_document VALUES(12,);
