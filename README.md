Facebook App d'importation de données d'un groupe
-------------------------------------------------

Bienvenue dans cette application développé en php avec symfony 2 qui permet de récupérer les données d'un groupe Facebook vers une base de données externe à Facebook. Ce present document décrit comment l'installer sur une platforme Windows. Je tiens à souligner que l'application présent est en mode développement, ainsi l'indexe du projet c'est le fichier app_dev.php. 

Installation de l'application
-------------------------------------------------

1. Avant d'installer cette application pour tester ou développer d'avantage, il faut avoir déjà crée l'application auprès de Facebook. Sur lien [https://developers.facebook.com/apps][1], pour plus de détail sur comment créer l'application et comment configurer, referez vous au [document de l'atelier de création de l'application][2], après vous recuperer l'id de l'application et la clé secrete, vous les enregistrer dans un fichier sur votre PC.

2. Télecharger le format zip de cette application, si vous n'avez pas encore fait en [cliquant ici][3] et placez le sur le dossier de sites web de votre serveur Apache.

3. Assurez vous que vous avez [Composer][4] installé sur votre système, et qu'il est inclut sur votre variable d'environement PATH, si vous n'avez pas il y a une version avec ce projet nommé composer.phar

4. Ouvrez le terminale pour les ligne de commande et placez au dossier racine de votre application , c'est à dire vous retrouver sur le dossier `FbAppGroup/`

    Taper la commande suivante si composer est inclut sur votre PATH:

        composer update 

    Sinon tapez ceci :

        php composer.phar update

    Il va installer toutes les bibliothèque requis pour votre application, les vendor en quelque sorte.

5. Etant donné que mon propre fichier de paramètre je ne l'ai pas committé alors vous copiez le contenu du fichier `parameters.yml.dist` contenu sur `/app/config/`, vous créer un fichier sur le même emplacement nommé `parameters.yml` et vous collez le contenu et vous le parametrez en fonction de vos propres paramètres.

6. Vous ouvrez le fichier `config.yml` contenu sur le repertoire `/app/config/` , vous défilez jusqu'a la fin pour ajouter votre clé secrete et l'id de votre application que vous avez recuperé depuis Facebook, vu qu'on a utilisé un Bundle spécifique déjà installé avec les vendor.

    Vous devez remplacer l'app_id et la clé secrète par ici:

        fos_facebook:
            alias :  facebook
            app_id: 486996558052473
            secret: 573060401ac4899c156f4aacbc683d74
         
7. Vous devez taper les commandes necessaire pour créer votre base de données, tous les sheamas sont bien crées

    Il faut taper la commade suivante:

        php app/console doctrine:schema:create
    
8. Configurez votre serveur apache en creant une machine virtuelle, vous prenez l'alias de votre host et vous créer un nom d'hôte sur votre fichier hosts, referez vous sur le documment de l'atelier pour savoir comment faire celà au cas où vous avez des dfficultés. Supposons que vous avez pu créer le nom d'hôte www.fbgrpdonnees.com qui pointe sur le dossier web alors il faut le mettre comme url de l'application sur les paramètres de votre application, pour voir quelque chose comme ça http//:www.fbgrpdonnees.com/app_dev.php.

9. Il faut cherchez le fichier `/src/FB/groupeBundle/Resources/public/js/threadRecuperation.js` et remplacer l'adresse de de votre serveur web socket.

    Il faut éditer l'emplacement suivant pour correspondre au bon nom que vous avez choisit:

        conn=new WebSocket('ws://www.fbgrpdonnees.com:8080');

10. Pour commencer à tester l'application ouvre le dossier racine et lancer le serveur websocket ceci en cliquant deux fois sur le fichier de ligne de commande `LancerServeurWS.bat`

    Et c'est fini votre application est bien prêt pour travailler, accedez sur votre site/app_dev.php, 

Pour tout probleme contactez moi sur l'adresse bilalsoidik@gmail.com

[1]:  https://developers.facebook.com/apps
[2]:  https://drive.google.com/file/d/0B-QBsa8QywtyZEVwN1JTSFpYcWM/edit?usp=sharing
[3]:  https://github.com/bilaalsoidik/FbAppGroup/archive/master.zip
[4]:  http://getcomposer.org/
