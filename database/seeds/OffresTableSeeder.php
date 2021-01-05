<?php

use Illuminate\Database\Seeder;

class OffresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('offres')->insert([
            'titre' => 'Administrateur réseaux informatique F/H - Exploitation, maintenance informatique (H/F)',
            'description' => 'Au sein de la Direction des S.I (100 personnes), rattaché(e) au Responsable Infrastructure et Réseaux, au sein d\'une équipe de 6 personnes, vous assurez l\'exploitation de l\'infrastructure réseau du groupe, le support niveau 2/3 et participez au projet de modernisation du SI. Vos principales missions seront les suivantes : EXPLOITATIONExploiter les réseaux (Switch HP, Firewall Fortinet, Plateforme de management IMC HP, supervision)Réaliser des rapports d\'exploitation mensuels,Exploitation indirecte via un partenaire de la sécurité périmétrique (LoadBalancer F5, Netscaler Citrix, Firewall Fortinet),Gérer au travers d\'un catalogue de service et suivre des SLAs avec ce partenaire,Exploiter les Wifi (Borne et contrôleur wifi Extrem Network). ADMINISTRATIONAdministrer quotidiennement l\'infrastructure LAN, WLAN, SDWAN et sécurité de l\'entreprise, en garantissant notamment son maintien en condition opérationnelle,Opérer un support technique de niveau 3 auprès des établissements et des équipes supports,Suivre la résolution des incidents opérateurs sur un VPN MPLS opérateur de 400 établissements,Rédaction de notes techniques et de tutoriels,Favoriser le rapprochement des différents systèmes informatiques et assurer conjointement avec d\'autres personnels la maintenance au quotidien. GESTION DES EVOLUTIONSÊtre force de propositions pour faire évoluer les infrastructures,Piloter les mises en place de ces évolutions - gestion de projets. - De formation supérieure informatique, vous avez une première expérience acquise dans l\'administration réseaux, vous avez une certaine aisance relationnelle et un fort esprit d\'initiatives. Vous êtes reconnu(e) pour vos capacités de synthèse dans l\'analyse des besoins utilisateurs, vos capacités à gérer les priorités et les risques, votre rigueur de pilotage, et votre sens du service interne.Vous souhaitez intégrer une structure à taille humaine avec une délégation importante et une obligation de résultats.  Poste à pourvoir en CDI, basé à Lyon (69) - .Notre client, Groupe français de santé, recherche dans le cadre de la croissance de son Système d\'Information : Un(e) Administrateur réseaux.',
            'niveau' => 'BAC + 3',
            'pdf' => 'NULL',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}