
*------------------------*
* Documentation site TWN *
*------------------------*


I/ Niveaux d'acc�s
------------------
	Les niveaux d'acc�s sont appliqu�s au niveau du serveur HTTP par le biais 
	de fichiers htaccess. Ces niveaux sont d�finis comme suit :

	PUBLIC:	aucune limitation d'acc�s.
	ADMIN:	acc�s restreint aux utilisateurs disposant du login administrateur.
	SERVER: acc�s interdit.


II/ Arborescence du site
------------------------
	Chemin				Acc�s		Description
	------				-----		-----------
	/					PUBLIC		interface HTML du site
	/contents			PUBLIC		fichiers
	/css				PUBLIC		feuilles de style CSS
	/images				PUBLIC		images
	/includes			SERVER		m�canique interne du site
	/manage				ADMIN		scripts d'administration
	/setup				SERVER		configuration, scripts d'installation, documentation


III/ Contraintes sp�cifiques � free.fr
--------------------------------------
	1. les scripts ne sont interpr�t�s en tant que version 5 de PHP que s'ils portent
	   l'extension .php5.
	2. l'utilisation de sessions n�cessite la pr�sence d'un r�pertoire /sessions
	   � la racine du site
	3. la syntaxe des fichiers htaccess est propre � free.fr.
	4. l'encodage des url en utf-8 (d�faut sous IE) n'est pas support�.
