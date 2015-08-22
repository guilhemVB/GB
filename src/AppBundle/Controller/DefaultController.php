<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{

    public function contactAction()
    {
        return $this->render('AppBundle:Default:contact.html.twig');
    }

    public function sendEmailAction(Request $request)
    {
        $email = $request->get('email');
        $name = $request->get('name');
        $core = $request->get('core');
        $subject = $request->get('subject');

        $message = \Swift_Message::newInstance()
            ->setSubject($subject)
            ->setFrom($email)
            ->setTo('contact@guilhembourgoin.com')
            ->setBody($this->renderView('AppBundle:Default:email.html.twig', array('name' => $name, 'core' => $core)))
            ->setContentType('text/html');
        $result = $this->get('mailer')->send($message);
        return new JsonResponse(['result' => $result]);
    }

    public function homepageAction()
    {
        return $this->render('AppBundle:Default:homepage.html.twig', array('age' => $this->extractAge()));
    }

    public function cvAction()
    {
        return $this->render('AppBundle:Default:cv.html.twig', array('age' => $this->extractAge()));
    }

    public function travelsAction()
    {
        return $this->render('AppBundle:Default:travels.html.twig');
    }

    public function travelAction($nameTravel)
    {
        $data = array();
        switch ($nameTravel) {
            case "turkey":
                $data = $this->getTurkey();
                break;

            case "prague":
                $data = $this->getPrague();
                break;

            case "newyork":
                $data = $this->getNewyork();
                break;

            case "egypte":
                $data = $this->getEgypte();
                break;

            case "rome":
                $data = $this->getRome();
                break;

            case "islande":
                $data = $this->getIslande();
                break;

            default:
                $data = $this->getPrague();
                break;
        }
        return $this->render('AppBundle:Default:travel_content.html.twig', $data);
    }

    private function extractAge()
    {
        $date_naissance = '09/04/1990';
        $arr = explode('/', $date_naissance);
        $age = date('Y', time() - strtotime($arr[2] . '-' . $arr[1] . '-' . $arr[0])) - 1970;
        return $age;
    }

    private function getIslande()
    {
        $data = array();

        $data['date'] = 2005;
        $data['lieu'] = "Islande";
        $data['description'] = "<p>Prague est la capitale et la plus grande ville de la République tchèque. Situé en plein cur de l'Europe centrale, Prague se trouve à 300km de Vienne, 350 km de Berlin et 630 km de Varsovie. Elle fut par le passé capitale du Royaume de Bohême, du Saint-Empire romain germanique et de la Tchécoslovaquie.</p>" .
            "<p>Traversée par le fleuve Vltava, on recense 18 ponts dans la ville. Les monuments les plus célèbres de la ville sont le pont Charles, la place de la Vieille Ville et le château de Prague.</p>" .
            "<p>La ville aux <i>mille tours et mille clochers</i> (qui est encore la caractéristique architecturale de la ville) a miraculeusement échappé aux destructions de la Seconde Guerre mondiale et offre une architecture mêlant les styles préroman, roman, gothique, baroque, rococo, Art nouveau et cubiste.</p>";

        $photos = array();
        array_push($photos, new Photo("La capitale : Reykjavik", "photoIslande/islReykjavik.jpg", "Elle se situe à environ 250 km au sud du cercle polaire arctique, ce qui en fait la capitale la plus septentrionale du monde. Elle s'étale entre deux fjords, dans une zone comptant de nombreuses sources chaudes. C'est la ville la plus peuplée du pays, avec environ 120 000 habitants."));
        array_push($photos, new Photo("", "photoIslande/islmontagne.jpg", "Paysages lunaires, deltas sablonneux, volcans ténébreux, falaises de glace, innombrables sources chaudes... L'Islande est une destination définitivement hors du commun."));

        $data['photos'] = $photos;

        return $data;
    }

    private function getRome()
    {
        $data = array();

        $data['date'] = 2006;
        $data['lieu'] = "Rome";
        $data['description'] = "<p>Ville berceau de la civilisation occidentale après Athènes, Rome a une histoire qui s'étend sur plus de 2500 ans.</p>" .
            "<p>Selon la légende, Rome aurait été fondée le 21 avril 753 avant J.-C. par Romulus, qui aurait tué son frère jumeau Remus lors de la création de la ville. Ces deux frères sont les descendants du dieu Mars et de Rhéa Silvia, fille de Numitor. La généalogie légendaire de Romulus permet de donner une origine divine à Rome : la Ville aurait été créée, car les dieux le voulaient ainsi.</p>" .
            "<p>Elle était le centre de l'Empire romain, qui a dominé l'Europe, l'Afrique du Nord et le Moyen-Orient pendant plus de cinq cents ans à partir du Ier siècle av. J.-C..</p>" .
            "<p>Aujourd'hui, Rome occupe une place capitale dans le christianisme et abrite le siège de l'Église catholique romaine et la Cité du Vatican, un État souverain.</p>";

        $photos = array();
        array_push($photos, new Photo("Le Forum", "photoRome/itaforum.jpg", "Le Forum Romanum (ou Forum de Rome) est resté pendant longtemps la principale place de Rome. Il avait une importance historique, religieuse, et politique. C'est la place autour de laquelle toute la vie politique romaine s'articulait (Sénat romain, Comice, Curie)."));
        array_push($photos, new Photo("Fontaine de Trevi", "photoRome/itafontaine.jpg", "la fontaine de Trevi est la fontaine la plus connue de Rome et un lieu de passage obligé ! Construite à la demande du Pape Benoit XIV, elle est l'oeuvre de Nicolas Salvi qui l'achève en 1762."));
        array_push($photos, new Photo("La place Saint-Pierre", "photoRome/itaplaceStP.jpg", "La place Saint-Pierre vue depuis la basilique Saint-Pierre de Rome. Construite après la basilique, elle a conçue comme un espace composé de deux bras qui accueille la foule des pèlerins."));

        $data['photos'] = $photos;

        return $data;
    }

    private function getEgypte()
    {
        $data = array();

        $data['date'] = 2008;
        $data['lieu'] = "L'Égypte";
        $data['description'] = "<p>LÉgypte, officiellement la République arabe d'Égypte, est un pays d'Afrique du nord-est. La partie nord-est du pays constituée par la péninsule du Sinaï se situe cependant en Asie.</p>" .
            "<p>Durant près de trois millénaires, la vallée du Nil vit prospérer une des civilisations les plus brillantes de l'Histoire. LÉgypte des pharaons s'est largement épanouie pour atteindre son apogée au XIIIe siècle avant notre ère, laissant une uvre monumentale au patrimoine mondial.</p>" .
            "<p>De nos jours, l'Égypte s'inscrit dans un cadre politique moyen-oriental imprégné par ses nombreux conflits avec Israël. Outre ses ouvrages monumentaux tels que le canal de Suez ou le haut barrage d'Assouan, elle demeure mondialement connue pour ses richesses archéologiques.</p>";

        $photos = array();
        array_push($photos, new Photo("Le Sphinx et les Pyramides de Gizeh", "photoEgypte/egyPyramide.jpg", "Le Sphinx de Gizeh est la statue qui se dresse devant les grandes pyramides du plateau de Gizeh, en amont du delta du Nil, dans la Basse-Égypte. A droite, la pyramide de Khéops, 137 m de hauteur, tombeau du pharaon Khéops, elle fut édifiée il y a plus de 4 500 ans"));
        array_push($photos, new Photo("Le Nil à Assouan", "photoEgypte/egyNil.jpg", "Le Nil (6500km) est la voie qu'empruntaient les Égyptiens pour se déplacer. Il joua un rôle très important dans l'Égypte antique, du point de vue économique, social, agricole et religieux."));
        array_push($photos, new Photo("Un Souk d'Assouan", "photoEgypte/egySouk.jpg", "Toutes sortes d'épices sont à vendre !"));
        array_push($photos, new Photo("Pyramide à degrés de Djéser", "photoEgypte/135_3567.JPG", "Le complexe funéraire de Djéser, édifié vers -2600 avant JC, sous le règne du pharaon Djéser se situe à Saqqarah. C'est, dans l'histoire de l'architecture égyptienne, la première pyramide."));
        array_push($photos, new Photo("Fabrication du pain dans la banlieue du Caire", "photoEgypte/135_3591.JPG", ""));
        array_push($photos, new Photo("Porte des remparts du Caire", "photoEgypte/136_3645.JPG", ""));
        array_push($photos, new Photo("Cour dune mosquée du Caire", "photoEgypte/136_3654.JPG", ""));
        array_push($photos, new Photo("Une rue commerçante du Caire", "photoEgypte/136_3673.JPG", ""));
        array_push($photos, new Photo("Mosquée Al-Azhar", "photoEgypte/136_3687.JPG", "Fondée en 970, est une des plus anciennes mosquées du Caire et le siège de l'université al-Azhar, l'un des plus ancienne université encore active au monde. La mosquée possède trois minarets."));
        array_push($photos, new Photo("Temple d'Isis", "photoEgypte/137_3717.JPG", "Situé sur l'île de Philæ, Le temple d'Isis est l'un des sanctuaires majeurs de la déesse en Égypte. Il commence a être édifié au IVème siècle avant notre ère par Nectanébo Ier et est terminé sous l'époque Romaine."));
        array_push($photos, new Photo("Façade du temple d'Isis", "photoEgypte/Egypte 001.jpg", "Le temple compte parmi les temples sauvés des eaux lors de la construction du barrage d'Assouan. il a été déplacé de 300m, sur l'île de Philæ."));
        array_push($photos, new Photo("Temple de Kom ombo", "photoEgypte/Egypte 064.jpg", "Situé sur l'île de Philæ, la construction a commencé sous Ptolémée VI (-180/-145) au début de son règne et s'acheva au IIIe siècle. Le temple est situé à 40 Km d'Assouan. Il est consacré au dieu faucon Horus et au dieu crocodile Sobeck."));
        array_push($photos, new Photo("Hiéroglyphe d'un temple de Kom ombo", "photoEgypte/Egypte 080.jpg", "Apparue à la fin du IVe millénaire avant notre ère en Haute-Égypte? (sud du pays), l'écriture hiéroglyphique est utilisée jusquà l'époque romaine, soit pendant plus de trois mille ans."));
        array_push($photos, new Photo("Grand temple d'Abou Simbel", "photoEgypte/Egypte 044.jpg", "Voué au culte d'Amon, de Rê, de Ptah et de Ramsès II. Il est taillé dans la roche pour sa majeure partie, y compris la façade composée de quatre statues colossales de Ramsès II. Le temple a été déplacé afin de le sauver de la montée des eaux provoquée par la construction du haut barrage d'Assouan dans les années 1960."));
        array_push($photos, new Photo("Temple d'Edfou", "photoEgypte/Egypte 112.jpg", "Le temple d'Edfou est dédié principalement à deux divinités, la déesse Neith, et le dieu Khnoum, le dieu à tête de bélier. C'est le temple le mieux conservé d'Egypte."));
        array_push($photos, new Photo("Les calèches d'Edfou", "photoEgypte/Egypte 122.jpg", ""));
        array_push($photos, new Photo("Berges du Nil", "photoEgypte/Egypte 126.jpg", "Contraste entre les berges verdoyantes et fertiles du Nil et des montagnes arides juste derrière."));
        array_push($photos, new Photo("Vallée des Rois", "photoEgypte/Egypte 132.jpg", "Composée de 64 tombeaux, la vallée des Rois est connue pour abriter les hypogées de nombreux pharaons du Nouvel Empire (1500 à 1000 av. J.-C.). L'un des rares tombeaux à avoir (en partie) échappé aux pilleurs, est celui de Toutânkhamon."));
        array_push($photos, new Photo("Complexe religieux de Karnak", "photoEgypte/Egypte 159.jpg", "Karnak n'était pas un temple mais un véritable complexe religieux composé de plusieurs temples."));
        array_push($photos, new Photo("Piliers du temple de Karnak", "photoEgypte/Egypte 186.jpg", "La salle hypostyle est soutenue par 134 colonnes papyriformes. Les proportions sont pharaoniques !"));
        array_push($photos, new Photo("Temple d'Amon (Louxor)", "photoEgypte/Egypte 219.jpg", "La construction de ce temple commença il y a 3500 ans, le déclin du temple commencé à cause de l'invasion romaine. L'obélisque de la place de la Concorde à Paris vient de ce temple."));

        $data['photos'] = $photos;

        return $data;
    }

    private function getNewyork()
    {
        $data = array();

        $data['date'] = 2012;
        $data['lieu'] = "New-York";
        $data['description'] = "<p>New York  est la plus grande ville des Etats-Unis et l'une des plus importantes du continent américain. La ville de New York se compose de cinq arrondissements : Manhattan, Brooklyn, Queens, le Bronx et Staten Island.</p>" .
            "<p>The Big Apple, comme on la surnome souvent, exerce un impact significatif sur le commerce mondial, la finance, les médias, l'art, la mode, la recherche, la technologie, l'éducation et le divertissement.</p>" .
            "<p>C'est l'une des villes les plus cosmopolites du monde, en effet il existe de nombreux quartiers ethniques où résident de nombreuses communautés. Les quartiers les plus connus sont sans conteste Little Italy, ou encore Chinatown.</p>" .
            "<p>Siège de nombreuses institutions d'importance mondiale, et de nombreux monuments mondialement connus, New-York est parfois considérée comme « la capitale du monde ».</p>";

        $photos = array();
        array_push($photos, new Photo("Lower Manhattan", "photoNewYork/DSCN0662.jpg", "Vue depuis Ellis Islande sur la presque île de Manhattan et le quartier de « Lower Manhattan » qui est le centre financier de la ville. Les deux tours en construction font parties du nouveau complexe construit a l'emplacement du World Trade Center, détruit lors des attentats du 11 septembre 2001."));
        array_push($photos, new Photo("Manhattan", "photoNewYork/DSCN0594.jpg", "Vue depuis le haut de l'Empire State Bulding."));
        array_push($photos, new Photo("L'Empire State Bulding", "photoNewYork/DSCN0592.jpg", "Situé dans le quartier de Midtown, il mesure 381 mètres (443,2 m avec lantenne) et compte 102 étages. Inauguré le 1er mai 1931, il a fallu seulement 1 an et 45 jours pour le construire."));
        array_push($photos, new Photo("Central Park", "photoNewYork/DSCN0690.jpg", "Central Park vue depuis le haut du Rockefeller Center. Le Parc mesure 4 km de long sur 800 m de large, il représente une oasis de verdure au milieu de la forêt de gratte-ciels."));
        array_push($photos, new Photo("Central Park", "photoNewYork/DSCN0726.jpg", "Très prisé de New-Korkais, il est emprunté par les piétons, les coureurs, les cyclistes ou encore les adeptes du roller, surtout le week-end. De nombreux terrains de baseball et de volleyball sont libre d'accès au public."));
        array_push($photos, new Photo("Central Park", "photoNewYork/DSCN0741.jpg", "Le Parc contient des forets, des lacs et des collines mais tout est artificiel ! Il accueille de nombreuses espèces animales et végétale."));
        array_push($photos, new Photo("Flatiron Building", "photoNewYork/DSCN0816.jpg", "le Flatiron Building est un immeuble situé dans le quartier de Midtown, au carrefour entre la 5e avenue et Broadway. Cet immeuble a donné son nom au quartier qui l'entoure, le Flatiron District."));
        array_push($photos, new Photo("Les rues de New-York", "photoNewYork/DSCN0764.jpg", "Toujours très fréquentés quelque soit l'heure de la journée ou de la nuit, les rue sont principalement utilisé par la police et les taxis New-Yorkais, reconnaissables à leur couleur jaune."));
        array_push($photos, new Photo("Times Square", "photoNewYork/IMG276.jpg", "Times Square, nommé d'après l'ancien emplacement du siège du New York Times, est l'un des endroits les plus célèbres et les plus animés au monde."));
        array_push($photos, new Photo("L'Eglise Saint Thomas", "photoNewYork/DSCN0715.jpg", "Les églises et cathédrales sont aujourdhui les plus vieux bâtiments de la ville."));
        array_push($photos, new Photo("Un bus scolaire", "photoNewYork/DSCN0704.jpg", "Un bus scolaire et son chauffeur, au pied du Rockfeller Center, sur la 50ème rue."));
        array_push($photos, new Photo("La police New-Yorkaise", "photoNewYork/IMG257.jpg", "Une voiture de la New York City Police Department ou NYPD, au pied de l'Empire State Building."));
        array_push($photos, new Photo("Une rue de Harlem", "photoNewYork/IMG295.jpg", "Situé au nord de Manhattan, Harlem a longtemps été et demeure encore aujourd'hui un lieu où se concentrent les Afro-américains. Après plusieurs décennies de crise et de délabrement, Harlem se transforme aujourd'hui en un quartier dynamique et attrayant."));
        array_push($photos, new Photo("Théâtre Apollo", "photoNewYork/IMG293.jpg", "L'Apollo Theater est une illustre salle de spectacle très réputée du quartier de Harlem qui deviendra à partir des années quarante un des symboles de la musique noire américaine. Duke Ellington, Ella Fitzgeral, Stevie Wonder, Aretha Franklin, Mariah Carey, The Jackson Five, James Brown et bien d'autres encore sont passés par ce théâtre."));
        array_push($photos, new Photo("La Statue de la Liberté", "photoNewYork/DSCN0637.jpg", "Offerte par la France, en signe d'amitié entre les deux nations, elle a été innogurée le 28 octobre 1886, elle mesure 93 m de haut, socle compris. Située à lentré de New-York, sur l'île de Liberty Island, elle est l'un des symboles des États-Unis, elle représente la liberté et l'émancipation."));
        array_push($photos, new Photo("Le Pont de Brooklyn", "photoNewYork/DSCN0844.jpg", "Le pont de Brooklyn est l'un des plus anciens ponts suspendus des États-Unis. Il traverse l'East River pour relier l'île de Manhattan à l'arrondissement de Brooklyn. Long de 1,825 km, il a été ouvert à la circulation le 24 mai 1883, après 14 ans de travaux."));

        $data['photos'] = $photos;

        return $data;
    }

    private function getPrague()
    {
        $data = array();

        $data['date'] = 2013;
        $data['lieu'] = "Prague";
        $data['description'] = "<p>Prague est la capitale et la plus grande ville de la République tchèque. Situé en plein c?ur de l'Europe centrale, Prague se trouve à 300km de Vienne, 350 km de Berlin et 630 km de Varsovie. Elle fut par le passé capitale du Royaume de Bohême, du Saint-Empire romain germanique et de la Tchécoslovaquie.</p>" .
            "<p>Traversée par le fleuve Vltava, on recense 18 ponts dans la ville. Les monuments les plus célèbres de la ville sont le pont Charles, la place de la Vieille Ville et le château de Prague.</p>" .
            "<p>La ville aux mille tours et mille clochers (qui est encore la caractéristique architecturale de la ville) a miraculeusement échappé aux destructions de la Seconde Guerre mondiale et offre une architecture mêlant les styles préroman, roman, gothique, baroque, rococo, Art nouveau et cubiste.</p>";

        $photos = array();
        array_push($photos, new Photo("Tour Poudrière de Prague", "photoPrague/tourPoudriere.JPG", ""));
        array_push($photos, new Photo("Maison municipale", "photoPrague/maisonMunicipale.JPG", ""));
        array_push($photos, new Photo("Vierge Noire", "photoPrague/viergeNoire.JPG", ""));
        array_push($photos, new Photo("Place de la Vieille-Ville", "photoPrague/placeVieilleVille.JPG", ""));
        array_push($photos, new Photo("La Tour de l'Hôtel de Ville", "photoPrague/tourHotelDeVille.JPG", ""));
        array_push($photos, new Photo("Horloge astronomique", "photoPrague/horlogeAstronomique.JPG", ""));
        array_push($photos, new Photo("Église de Notre-Dame de Týn", "photoPrague/egliseDeNotreDameDeTyn.JPG", ""));
        array_push($photos, new Photo("Pont Charles et château de Prague", "photoPrague/pontCharles.JPG", ""));
        array_push($photos, new Photo("Une des statue du pont Charles", "photoPrague/statuePontCharles.JPG", ""));
        array_push($photos, new Photo("Une des extrémité du pont Charles", "photoPrague/portePontCharles.JPG", ""));
        array_push($photos, new Photo("Cathédrale St-Guy", "photoPrague/cathedrale1.JPG", ""));
        array_push($photos, new Photo("Choeur de la cathédrale St-Guy", "photoPrague/cathedrale2.JPG", ""));
        array_push($photos, new Photo("Salle de réception du palais royal", "photoPrague/palais.JPG", ""));
        array_push($photos, new Photo("Cours intérieur du palais royal", "photoPrague/palais2.JPG", ""));
        array_push($photos, new Photo("Habitations traditionnelles", "photoPrague/village.JPG", ""));
        array_push($photos, new Photo("Quartier de Josefov", "photoPrague/quartierJuif.JPG", "Le quartier de Josefov fait partie de la vieille ville de Prague. Il constituait le ghetto juif de la ville."));
        array_push($photos, new Photo("Cimetière juif", "photoPrague/cimetiereJuif.JPG", ""));
        array_push($photos, new Photo("Musiciens sur le pont Charles", "photoPrague/musiciens.JPG", "La musique tchèque a une histoire qui remonte au Moyen Âge. Elle a des liens particuliers avec la musique traditionnelle de Bohême, de Moravie (anciennes régions austro-hongroises) et de Slovaquie. Malgré des frontières changeantes, son caractère central européen s'est toujours affirmé."));
        array_push($photos, new Photo("Place Venceslas (dans la nouvelle ville)", "photoPrague/nouvelleVille.JPG", "Aménagé au 14è siècle par l'empereur Charles IV, la structure d'ensemble et des grands axes du quaier de la nouvelle ville sont conservés jusqu'à nos jours. Les réalisations architecturales du tournant des 19è et 20è siècle autour de la place Venceslas en font un vrai musée à ciel ouvert."));
        array_push($photos, new Photo("Château de Prague et Église de Notre-Dame de Týn", "photoPrague/hautPoudriere.JPG", "Vue depuis le haut de la tour Poudrière."));

        $data['photos'] = $photos;

        return $data;
    }

    private function getTurkey()
    {

        $data = array();

        $data['date'] = 2014;
        $data['lieu'] = "Turquie (Bodum, Pamukkale, Éphèse)";
        $data['description'] = "<p>La ville de Bodrum, est situé au sud-ouest de la Turquie, la ville fut fondée par les Grecs sous le nom d’Halicarnasse. Port bordé par la mer Égée, la ville compte un peu plus de 88 000 habitants. Aujourd'hui, il s'agit d'une station balnéaire touristique très fréquentée et particulièrement prisée par la bourgeoisie d'Istanbul et les touristes étrangers.</p>" .
            "<p>Pamukkale ( ou \"château de coton\" en turc) est un site naturel composé de sources formant une tufière entièrement élaborée par les eaux chaudes qui s'écoulent des entrailles de la montagne.</p>" .
            "<p>Éphèse est l'une des plus anciennes et plus importantes cités grecques d'Asie Mineure, la première de l'Ionie. Éphèse était dans l'Antiquité l'un des ports les plus actifs de la mer Égée</p>";

        $photos = array();
        array_push($photos, new Photo("Château Saint-Pierre de Bodum", "photoTurquie/bodrum1.JPG", ""));
        array_push($photos, new Photo("Baie de Bodum", "photoTurquie/bodrum2.JPG", ""));
        array_push($photos, new Photo("Vue du château Saint-Pierre", "photoTurquie/bodrum3.JPG", ""));
        array_push($photos, new Photo("Dolmuş (minibus) de la région de Bodrum", "photoTurquie/dolmus.JPG", ""));
        array_push($photos, new Photo("Tombeaux rupestres de Dalyan", "photoTurquie/dalyan.JPG", ""));
        array_push($photos, new Photo("Bibliothèque de Celsus à Éphèse", "photoTurquie/ephese1.jpg", ""));
        array_push($photos, new Photo("Amphithéatre d'Éphèse", "photoTurquie/ephese2.jpg", ""));
        array_push($photos, new Photo("Théâtre d'Hiérapolis", "photoTurquie/pamukkale1.JPG", ""));
        array_push($photos, new Photo("Couché de soleil sur les bassins de Pamukkale", "photoTurquie/pamukkale2.JPG", ""));
        array_push($photos, new Photo("Touriste asiatique à Pamukkale", "photoTurquie/pamukkale3.JPG", ""));

        $data['photos'] = $photos;

        return $data;
    }

}

class Photo
{

    public $title;
    public $link;
    public $description;

    public function __construct($title, $link, $description)
    {
        $this->description = $description;
        $this->title = $title;
        $this->link = 'bundles/app/photo_travel/' . $link;
    }

}
