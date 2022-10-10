<?php

require 'src/autoloader.php';

use App\Classes\Contact;
use App\Classes\Project;
use App\Classes\Environment;
use App\Classes\Host;
use App\Classes\Customer;

use App\Forms\Validator;

// création objets

$host = new Host(1, 'codeHost', 'Johnatan', 'ceci est un hébergeur');
$customer = new Customer(1, 'codeCustomer', 'Jean', 'ceci est un client');

$contact = new Contact(1, 'johnatan@gmail.com', '0612345678', 'role', host: $host);
$contact1 = new Contact(2, 'jean@gmail.com', '0612345678' , 'role2', customer: $customer);

$projet = new Project(1, 'ProjetPhp', '1', 'dossierPHP', 'lien1', 1, 'ceci est un poc en php', $host, $customer);
$environment = new Environment(1, 'EnvironmentPHP', 'lien1', '172.00.00.00', 22, 'ssh1', 'phpmyadmin_local', 1, $projet);

//affichage test : jeu d'essai

//hébergeur
echo 'Hébergeur : ';
echo $host->getId().PHP_EOL;
echo '- ';
echo $host->getCode().PHP_EOL;
echo '- ';
echo $host->getName().PHP_EOL;
echo '- ';
echo $host->getNotes().PHP_EOL;
echo'<br>';
echo'<br>';

//client
echo 'Client : ';
echo $customer->getId().PHP_EOL;
echo '- ';
echo $customer->getCode().PHP_EOL;
echo '- ';
echo $customer->getName().PHP_EOL;
echo '- ';
echo $customer->getNotes().PHP_EOL;
echo'<br>';
echo'<br>';

//contact - hébergeur
echo 'Contact - hébergeur : ';
echo $contact->getID().PHP_EOL;
echo '- ';
echo $contact->getEmail().PHP_EOL;
echo '- ';
echo $contact->getPhone().PHP_EOL;
echo '- ';
echo $contact->getRole().PHP_EOL;
echo '- ';
echo $contact->getHost()->getId();
echo'<br>';
echo'<br>';

//contact - client
echo 'Contact - client : ';
echo $contact1->getID().PHP_EOL;
echo '- ';
echo $contact1->getEmail().PHP_EOL;
echo '- ';
echo $contact1->getPhone().PHP_EOL;
echo '- ';
echo $contact1->getRole().PHP_EOL;
echo '- ';
echo $contact1->getCustomer()->getId();
echo'<br>';
echo'<br>';

//projet
echo 'Projet : ';
echo $projet->getId().PHP_EOL;
echo '- ';
echo $projet->getName().PHP_EOL;
echo '- ';
echo $projet->getCode().PHP_EOL;
echo '- ';
echo $projet->getLastpast_folder().PHP_EOL;
echo '- ';
echo $projet->getLink_mock_ups().PHP_EOL;
echo '- ';
echo $projet->getManaged_server().PHP_EOL;
echo '- ';
echo $projet->getNotes().PHP_EOL;
echo '- ';
echo $projet->getHost_id()->getId().PHP_EOL;
echo '- ';
echo $projet->getCustomer_id()->getId().PHP_EOL;
echo'<br>';
echo'<br>';

//environment
echo 'Environment : ';
echo $environment->getId().PHP_EOL;
echo '- ';
echo $environment->getName().PHP_EOL;
echo '- ';
echo $environment->getLink().PHP_EOL;
echo '- ';
echo $environment->getIp_address().PHP_EOL;
echo '- ';
echo $environment->getSsh_port().PHP_EOL;
echo '- ';
echo $environment->getSsh_username().PHP_EOL;
echo '- ';
echo $environment->getPhpmyadmin_link().PHP_EOL;
echo '- ';
echo $environment->getIp_address().PHP_EOL;
echo '- ';
echo $environment->getProject_id()->getName();