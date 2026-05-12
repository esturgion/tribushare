# Architecture

### Patron de conception
>L'application suit une architecture en multicouche classique (c'est à dire avec le front, back et bdd séparés mais qui communiquent entre eux) car c'est pour développer un micro Saas, donc un projet relativement petit. De plus, c'est une architecture avec laquelle j'ai l'habitude de travailler et compatible avec les frameworks.

### Les couches back
Je développerai le back avec Symfony, l'organisation des couches est donc proche du modèle MVC. Elle se déclinent en 5 couches :
>- **Contrôleurs** : avec Symfony, il a aussi le rôle de routeur. C'est lui qui ressoit les requêtes du front, appel les services et retourne une réponse au front.
>- **Services** : ils contiennent toutes la logique métier (traitement, appel aux repositories ... ).
>- **Repository**: c'est là que se font toutes les requêtes liés à la base de données (récupérer des données, en ajouter, les modifier ...).
>- **Entity**: Les entités sont les objets qui correspondent aux tables de la base de données.
>- **BDD**: C'est l'endroit où seront stocker les données liés à l'applications (info utilisateur et biens principalement).

### Sécurité
Plusieurs règles de sécurité vont être mis en place.
- *Validation des entrées* :
    >* une vérification systématique de toutes données provenant de l'extérieur
    >* une double vérification à la fois au front et dans le back et des sécurités dans la bdd
    >* une vérification que les règles des champs sont bien respecté (le type, le format, les persmissions, la taille ...) et utiliser les validations DTO dans le back
    >* traitement des données si besoin (hasher un mot de passe, transformer les caractères indésirables ...)
    >* ne jamais envoyer directement les données dans les requêtes SQL et utiliser des contraintes SQL
- *Authentification* :
    >* authentification par un système de login (mail + mot de passe). L'identité de l'utilisateur est vérifié par l'envois d'un mail et le mot de passe stocké en bdd est hashé.
    >* déconnexion automatique après un temps d'innactivité (5 min).
    >* utilisation de tocken pour contrôler l'identité de l'utilisateur.
- *Secret* :
    >* lors du développement, les données sensibles sont conservés dans des .env qui ne sont pas visible depuis le répository
    >* au déploiement, les données sont stockés dans les gestionnaires de variables d'environnement sécurisés et prévu à cet effet.
- *Persmission* :
    >* application de la politique du moindre privilège
    >* Un accès limité et contrôlé en fonction du rôle de l'utilisateur
    >* cloisement des données (l'utilisateur n'a accès qu'à ses données)
    >* cloisement des api (des appels API réservé à un rôle ou un service)

### Sobriété concept

> En matière d'éco-conception, comme le coeur de l'application consiste essentiellement à parcourir une liste fournit par la bdd, je vais mettre un système de pagination pour ne pas charger des données inutilement.<br>
Comme il y aura des images qui accompagneront les biens, réduire le poids des images.<br>
Utiliser un système de cache pour les données non sensible qui peuvent être appeler régulièrement.<br>
Le système d'envois de mail est réduit au strict minimum, c'est-à-dire uniquement pour des raisons de sécurités (vérifier l'identité de l'utilisateur, changer le mot de passe).<br>
Nettoyer régulièrement la base de données : que ce soit des comptes ou des groupes inactif depuis longtemps, des 

### Stack
>En front, je choisis **React** et en back **Symfony** car se sont deux stacks que j'ai l'habitude d'utiliser et qui sont parfaitement adapté à un micro Saas en multicouche.