
*------------------------*
* Documentation site TWN *
*------------------------*


I/ Niveaux d'accès
------------------
	Les niveaux d'accès sont appliqués au niveau du serveur HTTP par le biais 
	de fichiers htaccess. Ces niveaux sont définis comme suit :

	PUBLIC:	aucune limitation d'accès.
	ADMIN:	accès restreint aux utilisateurs disposant du login administrateur.
	SERVER: accès interdit.


II/ Arborescence du site
------------------------
	Chemin				Accès		Description
	------				-----		-----------
	/					PUBLIC		interface HTML du site
	/contents			PUBLIC		fichiers
	/css				PUBLIC		feuilles de style CSS
	/images				PUBLIC		images
	/includes			SERVER		mécanique interne du site
	/manage				ADMIN		scripts d'administration
	/setup				SERVER		configuration, scripts d'installation, documentation


III/ Contraintes spécifiques à free.fr
--------------------------------------
	1. les scripts ne sont interprétés en tant que version 5 de PHP que s'ils portent
	   l'extension .php5.
	2. l'utilisation de sessions nécessite la présence d'un répertoire /sessions
	   à la racine du site
	3. la syntaxe des fichiers htaccess est propre à free.fr.
	4. l'encodage des url en utf-8 (défaut sous IE) n'est pas supporté.
