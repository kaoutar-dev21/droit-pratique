<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Category;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Model::unguard();

        // ---------- Utilisateurs ----------
        $admin = User::create([
            'name' => 'Administrateur',
            'email' => 'admin@droitpratique.ma',
            'password' => 'Admin@12345',
            'role' => 'admin',
        ]);

        $member = User::create([
            'name' => 'Sara Alaoui',
            'email' => 'user@droitpratique.ma',
            'password' => 'User@12345',
            'role' => 'user',
        ]);

        // ---------- Domaines ----------
        $famille = Category::create([
            'name' => 'Droit de la famille',
            'slug' => 'droit-de-la-famille',
            'icon' => '👨‍👩‍👧',
            'description' => 'Mariage, divorce, garde des enfants, pension alimentaire : comprendre vos droits et vos démarches.',
        ]);

        $travail = Category::create([
            'name' => 'Droit du travail',
            'slug' => 'droit-du-travail',
            'icon' => '💼',
            'description' => 'Contrat de travail, congés, licenciement, salaire : les règles essentielles pour les salariés.',
        ]);

        $immobilier = Category::create([
            'name' => 'Droit immobilier',
            'slug' => 'droit-immobilier',
            'icon' => '🏠',
            'description' => 'Location, achat, vente, bail : sécuriser vos opérations liées au logement.',
        ]);

        $conso = Category::create([
            'name' => 'Droit de la consommation',
            'slug' => 'droit-de-la-consommation',
            'icon' => '🛒',
            'description' => 'Achats, garanties, achats en ligne, réclamations : faire valoir vos droits de consommateur.',
        ]);

        // ---------- Articles ----------
        $articles = [
            [
                'category' => $famille,
                'title' => 'Les conditions du mariage au Maroc',
                'summary' => "Âge, consentement, témoins, dot et documents à fournir : les points essentiels à connaître avant de vous marier.",
                'days' => 2,
                'content' => <<<'TXT'
Le mariage est encadré par le Code de la famille (Moudawana). Avant d'engager les démarches, il est utile de connaître les conditions de fond et les formalités à accomplir.

## Les conditions principales
- La capacité matrimoniale : en principe, chacun des futurs époux doit avoir atteint l'âge de 18 ans révolus.
- Le consentement : il doit être donné librement et clairement par les deux futurs époux.
- La dot (sadaq) : elle est fixée d'un commun accord et appartient à l'épouse.
- La présence de deux témoins lors de la conclusion de l'acte.
- L'absence d'empêchements légaux (liens de parenté ou autres cas prévus par la loi).

## Les documents généralement demandés
- Les pièces d'identité (CIN) des futurs époux.
- Un extrait d'acte de naissance de chacun.
- Un certificat administratif ou une attestation de célibat, selon la situation.
- Un certificat médical et des photographies d'identité.
- Le dossier est déposé auprès du tribunal de la famille compétent, qui autorise ensuite l'établissement de l'acte de mariage.

## Bon à savoir
Les listes de pièces peuvent varier selon la situation de chacun (divorcé, veuf, nationalité étrangère, etc.). Renseignez-vous toujours auprès du tribunal de la famille de votre lieu de résidence avant de constituer votre dossier.

Le Code de la famille peut évoluer : vérifiez la version en vigueur et, en cas de doute, consultez un avocat ou un notaire.
TXT,
            ],
            [
                'category' => $famille,
                'title' => 'Les différents types de divorce : lequel choisir ?',
                'summary' => "Consentement mutuel, discorde, divorce sous contrôle judiciaire ou moyennant compensation : comprendre chaque procédure.",
                'days' => 5,
                'content' => <<<'TXT'
Le Code de la famille prévoit plusieurs formes de dissolution du mariage. Toutes passent par le tribunal de la famille, qui tente d'abord de concilier les époux.

## Le divorce par consentement mutuel
Les deux époux s'accordent sur le principe du divorce et sur ses conséquences : garde des enfants, pension, partage des biens, droits de l'épouse. Ils déposent une demande commune devant le tribunal, qui vérifie les conditions et prononce le divorce.

## Le divorce pour discorde (chiqaq)
Il peut être demandé par l'un ou l'autre des époux lorsque la vie commune est devenue impossible. Le tribunal tente une conciliation, puis statue si elle échoue.

## Le divorce sous contrôle judiciaire (tatlîq)
C'est la dissolution à l'initiative de l'époux, mais elle est soumise à l'autorisation du tribunal, qui fixe notamment les droits dus à l'épouse et aux enfants.

## Le divorce moyennant compensation (khul')
L'épouse propose à son époux une contrepartie financière en échange de la dissolution du mariage, avec l'accord du tribunal.

## Les points à anticiper
- La garde et le droit de visite des enfants.
- La pension alimentaire et le logement.
- Le sort des biens acquis pendant le mariage.
- Les documents à réunir : acte de mariage, livret de famille, actes de naissance des enfants.

Chaque situation est particulière. Un avocat pourra vous indiquer la procédure la plus adaptée à votre cas.
TXT,
            ],
            [
                'category' => $travail,
                'title' => 'Contrat de travail : CDI, CDD et période d\'essai',
                'summary' => "Quelle différence entre un CDI et un CDD ? Quelle est la durée de la période d'essai ? Les repères essentiels pour signer en connaissance de cause.",
                'days' => 1,
                'content' => <<<'TXT'
Le Code du travail (loi n° 65-99) encadre la relation entre l'employeur et le salarié. Le contrat de travail peut être à durée indéterminée ou déterminée.

## Le contrat à durée indéterminée (CDI)
C'est la forme normale du contrat de travail. Il n'a pas de date de fin prévue et ne peut être rompu que dans le respect des règles légales.

## Le contrat à durée déterminée (CDD)
Il n'est possible que dans des cas limitativement prévus par la loi, par exemple :
- le remplacement temporaire d'un salarié absent ;
- un accroissement temporaire de l'activité de l'entreprise ;
- un travail saisonnier.

En règle générale, sa durée ne peut pas dépasser un an, renouvelable une fois.

## La période d'essai
Elle permet à chaque partie de vérifier si le poste ou le salarié convient. Sa durée varie selon la catégorie du salarié (cadres, employés, ouvriers) et peut être renouvelée une fois. Pendant cette période, chacune des parties peut en principe mettre fin au contrat en respectant les règles prévues.

## Nos conseils
- Exigez toujours un contrat écrit et conservez-en un exemplaire.
- Vérifiez le poste, la rémunération, la durée du travail et le lieu d'exercice.
- Gardez vos bulletins de paie : ils servent de preuve.

Les durées exactes et les règles précises dépendent de votre situation et des textes en vigueur. En cas de litige, rapprochez-vous de l'inspection du travail ou d'un avocat.
TXT,
            ],
            [
                'category' => $travail,
                'title' => 'Congé annuel et congé de maternité : vos droits',
                'summary' => "Combien de jours de congé acquiert-on chaque mois ? Quelle est la durée du congé de maternité ? Les réponses claires et pratiques.",
                'days' => 8,
                'content' => <<<'TXT'
Le Code du travail garantit aux salariés un repos annuel payé ainsi que des protections spécifiques pour les mères.

## Le congé annuel payé
Le salarié acquiert un droit à congé payé en fonction de son temps de service effectif. Pour un salarié âgé d'au moins 18 ans, la durée est d'un jour et demi ouvrable par mois de service. Elle est plus favorable pour les salariés plus jeunes et augmente avec l'ancienneté.

## Comment poser ses congés ?
- Les dates sont fixées en tenant compte des nécessités du service et, autant que possible, des souhaits du salarié.
- Il est préférable de formuler la demande par écrit et d'en garder une trace.
- Le salarié ne peut pas renoncer à son congé annuel.

## Le congé de maternité
La salariée a droit à un congé de maternité de 14 semaines. Pendant cette période, la salariée bénéficie d'une protection : l'employeur ne peut pas rompre son contrat en raison de la grossesse.

## Démarches utiles
- Informez votre employeur par écrit et transmettez le certificat médical.
- Renseignez-vous sur les indemnités journalières auprès de la CNSS.
- Conservez tous les justificatifs.

Les conventions collectives ou le contrat peuvent prévoir des avantages supplémentaires. Pour un cas précis, demandez conseil à l'inspection du travail ou à un avocat.
TXT,
            ],
            [
                'category' => $immobilier,
                'title' => 'Le contrat de bail d\'habitation : les points essentiels',
                'summary' => "Contrat écrit, loyer, dépôt de garantie, état des lieux : ce qu'il faut vérifier avant de louer un logement.",
                'days' => 3,
                'content' => <<<'TXT'
La location d'un logement est encadrée notamment par la loi n° 67-12 relative aux relations contractuelles entre bailleurs et locataires. Un contrat bien rédigé protège les deux parties.

## Ce que doit contenir le contrat
- L'identité complète du bailleur et du locataire.
- La description précise du logement et de ses dépendances.
- Le montant du loyer, la date et le mode de paiement.
- La durée du bail et les conditions de son renouvellement.
- Le montant du dépôt de garantie, s'il y en a un.

## Le dépôt de garantie
Il sert à couvrir d'éventuels impayés ou dégradations. Son montant est encadré par la loi. Il doit être restitué à la fin du bail, après déduction éventuelle des sommes justifiées.

## L'état des lieux
Réalisez un état des lieux écrit, signé par les deux parties, à l'entrée comme à la sortie. Prenez des photos datées : elles évitent la plupart des litiges.

## Les obligations de chacun
- Le bailleur remet un logement en bon état d'usage et assure les grosses réparations.
- Le locataire paie le loyer, utilise le logement paisiblement et assure l'entretien courant.

## En cas de problème
Commencez par un échange écrit avec l'autre partie. Si le désaccord persiste, vous pouvez saisir le tribunal compétent. Gardez toujours une copie du contrat, des quittances et de vos échanges.
TXT,
            ],
            [
                'category' => $immobilier,
                'title' => 'Acheter un bien immobilier : les vérifications avant de signer',
                'summary' => "Titre foncier, hypothèques, promesse de vente, frais : une checklist pour sécuriser votre achat.",
                'days' => 12,
                'content' => <<<'TXT'
L'achat d'un bien immobilier est souvent l'investissement le plus important d'une vie. Quelques vérifications simples permettent d'éviter de nombreux risques.

## Avant la promesse de vente
- Demandez le titre foncier et vérifiez l'identité du propriétaire.
- Consultez la situation du bien auprès de la Conservation foncière : charges, hypothèques ou saisies éventuelles.
- Vérifiez la conformité du bien (autorisation de construire, permis d'habiter, surface réelle).

## La promesse de vente
Elle fixe le prix, le délai de réalisation de la vente et les conditions suspensives. Lisez-la attentivement et faites-vous conseiller avant de verser un acompte.

## La signature de l'acte
Faites établir l'acte de vente par un professionnel habilité, par exemple un notaire. Il vérifie les documents, rédige l'acte et accomplit les formalités.

## Les frais à prévoir
- Les droits d'enregistrement et de conservation foncière.
- Les honoraires du professionnel qui rédige l'acte.
- Les éventuels frais de crédit si vous financez l'achat avec un prêt.

## Après l'achat
Assurez-vous que l'inscription au nom de l'acquéreur est bien effectuée à la Conservation foncière et conservez précieusement tous les documents.

Les règles fiscales et administratives évoluent régulièrement : faites vérifier votre dossier par un notaire ou un avocat avant tout engagement.
TXT,
            ],
            [
                'category' => $conso,
                'title' => 'Vos droits de consommateur : ce que dit la loi 31-08',
                'summary' => "Information, garantie, réclamation, rétractation : les droits fondamentaux du consommateur expliqués simplement.",
                'days' => 4,
                'content' => <<<'TXT'
La loi n° 31-08 édictant des mesures de protection du consommateur reconnaît plusieurs droits fondamentaux à toute personne qui achète un bien ou un service pour son usage personnel.

## Le droit à l'information
Le vendeur doit fournir une information claire sur le produit : prix, caractéristiques essentielles, conditions de vente et de garantie. Les prix doivent être affichés de manière visible.

## Le droit à la sécurité et à la conformité
Un produit doit être conforme à ce qui est annoncé et ne pas présenter de danger dans des conditions normales d'utilisation.

## La garantie
Si un produit présente un défaut, vous pouvez demander sa réparation, son remplacement ou, selon les cas, son remboursement. Conservez toujours votre facture ou votre ticket de caisse.

## La vente à distance et la rétractation
Pour certains contrats conclus à distance, le consommateur dispose d'un délai de rétractation de quelques jours pour renoncer à son achat. Vérifiez les conditions exactes avant d'acheter.

## Comment faire valoir vos droits ?
- Adressez d'abord une réclamation écrite au vendeur et gardez une preuve de l'envoi.
- Contactez une association de protection des consommateurs.
- En dernier recours, saisissez le tribunal compétent.

Les délais et les modalités dépendent de chaque situation. Pour un litige important, demandez conseil à un avocat ou à une association spécialisée.
TXT,
            ],
            [
                'category' => $conso,
                'title' => 'Acheter en ligne : les bons réflexes pour éviter les arnaques',
                'summary' => "Vérifier le vendeur, sécuriser le paiement, conserver les preuves : 7 réflexes simples avant de valider votre commande.",
                'days' => 15,
                'content' => <<<'TXT'
Les achats en ligne sont pratiques, mais ils exposent aussi à des risques : faux sites, produits non conformes, livraisons qui n'arrivent jamais. Voici les bons réflexes.

## Avant d'acheter
- Vérifiez l'identité du vendeur : nom, adresse, numéro de téléphone, mentions légales.
- Lisez les conditions générales de vente, les délais de livraison et la politique de retour.
- Méfiez-vous des prix anormalement bas et des offres qui vous mettent la pression.

## Au moment du paiement
- Privilégiez un paiement sécurisé et évitez de communiquer vos codes confidentiels.
- Ne transmettez jamais le code reçu par SMS à une personne qui vous le demande.

## Après la commande
- Gardez les captures d'écran de l'annonce, la confirmation de commande et la facture.
- Vérifiez le colis à la livraison et signalez immédiatement tout problème par écrit.

## En cas de litige
Contactez d'abord le vendeur par écrit. Sans réponse, sollicitez une association de protection des consommateurs. En cas d'escroquerie, conservez les preuves et signalez les faits aux autorités compétentes.

Un achat prudent reste la meilleure protection : en cas de doute, renoncez.
TXT,
            ],
        ];

        $created = [];
        foreach ($articles as $data) {
            $created[] = Article::create([
                'category_id' => $data['category']->id,
                'user_id' => $admin->id,
                'title' => $data['title'],
                'slug' => Str::slug($data['title']),
                'summary' => $data['summary'],
                'content' => $data['content'],
                'is_published' => true,
                'views' => random_int(40, 480),
                'created_at' => now()->subDays($data['days']),
                'updated_at' => now()->subDays($data['days']),
            ]);
        }

        // ---------- Commentaires ----------
        Comment::create([
            'article_id' => $created[0]->id,
            'user_id' => $member->id,
            'body' => "Merci pour cet article très clair ! Est-ce que la liste des documents est la même dans toutes les villes ?",
            'created_at' => now()->subDay(),
            'updated_at' => now()->subDay(),
        ]);

        Comment::create([
            'article_id' => $created[0]->id,
            'user_id' => $admin->id,
            'body' => "Merci Sara. Les pièces demandées peuvent varier légèrement d'un tribunal à l'autre : le mieux est de vous renseigner auprès du tribunal de la famille de votre ville.",
            'created_at' => now()->subHours(20),
            'updated_at' => now()->subHours(20),
        ]);

        Comment::create([
            'article_id' => $created[2]->id,
            'user_id' => $member->id,
            'body' => "Très utile, surtout la partie sur la période d'essai. Je recommande de toujours demander un contrat écrit.",
            'created_at' => now()->subHours(6),
            'updated_at' => now()->subHours(6),
        ]);

        Model::reguard();
    }
}
