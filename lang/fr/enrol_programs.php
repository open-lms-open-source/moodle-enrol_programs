<?php
// This file is part of Moodle - https://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <https://www.gnu.org/licenses/>.

/**
 * Program enrolment plugin language file.
 *
 * @package    enrol_programs
 * @copyright  2022 Open LMS (https://www.openlms.net/)
 * @author     Petr Skoda
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['addprogram'] = 'Ajouter un programme';
$string['addset'] = 'Ajouter un nouvel ensemble';
$string['allocationend'] = 'Fin de l\'attribution';
$string['allocationend_help'] = 'La date de fin de l\'attribution dépend des sources d\'attribution activées. En général, une nouvelle attribution n\'est pas possible après cette date.';
$string['allocation'] = 'Attribution';
$string['allocations'] = 'Attributions';
$string['programallocations'] = 'Attributions du programme';
$string['allocationdate'] = 'Date d\'attribution';
$string['allocationsources'] = 'Sources d\'attribution';
$string['allocationstart'] = 'Début de l\'attribution';
$string['allocationstart_help'] = 'La date de début de l\'attribution dépend des sources d\'attribution activées. En général, une nouvelle attribution est possible uniquement après cette date.';
$string['allprograms'] = 'Tous les programmes';
$string['appenditem'] = 'Ajouter un élément';
$string['appendinto'] = 'Ajouter à l\'élément';
$string['archive'] = 'Archiver';
$string['archived'] = 'Archivé';
$string['benefitname'] = '{$a} : attribution du programme';
$string['calendarprogramend'] = '{$a} se termine';
$string['calendarprogramdue'] = '{$a} arrive à échéance';
$string['calendarprogramstart'] = '{$a} commence';
$string['catalogue'] = 'Catalogue des programmes';
$string['catalogue_dofilter'] = 'Rechercher';
$string['catalogue_resetfilter'] = 'Effacer';
$string['catalogue_searchtext'] = 'Texte de recherche';
$string['catalogue_tag'] = 'Filtrer par balise';
$string['certificatetemplatechoose'] = 'Choisissez un modèle...';
$string['cohorts'] = 'Visible par les promotions';
$string['cohorts_help'] = 'Les programmes non publics peuvent être rendus visibles pour les membres de la promotion spécifiée.

Le statut de visibilité n\'affecte pas les programmes déjà attribués.';
$string['columnusedalready'] = 'La colonne est déjà utilisée';
$string['completepercent'] = '{$a} % terminé';
$string['completion'] = 'Achèvement';
$string['completiondate'] = 'Date d\'achèvement';
$string['completiondelay'] = 'Délai d\'achèvement';
$string['completionoverride'] = 'Écraser l\'achèvement';
$string['creategroups'] = 'Groupes de cours';
$string['creategroups_help'] = 'Si cette option est activée, un groupe sera créé dans chaque cours ajouté au programme et tous les utilisateurs affectés seront ajoutés comme membres du groupe.';
$string['customfields'] = 'Champs personnalisés du programme';
$string['customfieldsettings'] = 'Paramètres des champs personnalisés des programmes classiques';
$string['customfieldvisibleto'] = 'Le contenu du champ est visible pour';
$string['customfieldvisible:allocated'] = 'Utilisateurs affectés aux programmes';
$string['customfieldvisible:everyone'] = 'Tous ceux qui peuvent voir d\'autres détails du programme';
$string['customfieldvisible:viewcapability'] = 'Utilisateurs avec capacité d\'affichage des programmes';
$string['deleteallocation'] = 'Supprimer l\'attribution du programme';
$string['deletecourse'] = 'Supprimer le cours';
$string['deleteprogram'] = 'Supprimer le programme';
$string['deleteset'] = 'Supprimer l\'ensemble';
$string['deletetraining'] = 'Supprimer la formation';
$string['documentation'] = 'Programmes pour la documentation Moodle';
$string['duedate'] = 'Date d\'échéance';
$string['enrolrole'] = 'Rôle dans le cours';
$string['enrolrole_desc'] = 'Sélectionnez le rôle qui sera utilisé par les programmes pour l\'inscription aux cours';
$string['errorcontentproblem'] = 'Problème détecté dans la structure du contenu du programme, l\'achèvement du programme ne sera pas suivi correctement !';
$string['errorcoursemissing'] = 'Le cours est manquant';
$string['errorcoursesmissing'] = 'Cours manquants : {$a}';
$string['errorinvalidoverridedates'] = 'Remplacements de date non valide';
$string['errordifferenttenant'] = 'Impossible d\'accéder au programme d\'un autre client';
$string['errorduplicateprogramid'] = 'Le numéro d\'ID de programme est déjà utilisé pour un autre programme, veuillez utiliser un numéro d\'ID de programme unique.';
$string['errornoallocations'] = 'Aucune attribution d\'utilisateur trouvée';
$string['errornoallocation'] = 'Le programme n\'est pas attribué';
$string['errornomyprograms'] = 'Vous n\'êtes affecté(e) à aucun programme.';
$string['errornoprograms'] = 'Aucun programme trouvé.';
$string['errornorequests'] = 'Aucune demande de programme trouvée';
$string['errornotenabled'] = 'Le plug-in Programmes n\'est pas activé';
$string['event_program_completed'] = 'Programme terminé';
$string['event_program_created'] = 'Programme créé';
$string['event_program_deleted'] = 'Programme supprimé';
$string['event_program_updated'] = 'Programme mis à jour';
$string['event_program_viewed'] = 'Programme affiché';
$string['event_user_allocated'] = 'Utilisateur affecté au programme';
$string['event_user_deallocated'] = 'Utilisateur retiré du programme';
$string['evidence'] = 'Autres preuves';
$string['evidencedate'] = 'Date de preuve d\'achèvement';
$string['evidenceupdate'] = 'Mettre à jour les autres preuves';
$string['evidenceupload'] = 'Charger les preuves d\'achèvement';
$string['evidenceupload_csvfile'] = 'Fichier CSV';
$string['evidenceupload_errors'] = '{$a} lignes non valides détectées';
$string['evidenceupload_skipped'] = '{$a} lignes ignorées';
$string['evidenceupload_updated'] = 'Preuve d\'achèvement mise à jour pour {$a} utilisateurs';
$string['evidence_details'] = 'Détails';
$string['evidence_detailsdefault'] = 'Détails par défaut';
$string['export'] = 'Exporter des programmes';
$string['exportfile_info'] = 'info';
$string['exportfile_programs'] = 'programmes';
$string['exportformat'] = 'Format de fichier';
$string['exportformat_csv'] = 'CSV';
$string['exportformat_json'] = 'JSON';
$string['extra_menu_management_index'] = 'Actions des programmes';
$string['extra_menu_management_program_general'] = 'Actions du programme';
$string['extra_menu_management_program_users'] = 'Actions des utilisateurs';
$string['extra_menu_management_program_allocation'] = 'Actions de l\'attribution';
$string['fixeddate'] = 'À date fixe';
$string['idnumbersymbol'] = 'ID n° :';
$string['importallocationend'] = 'Fin de l\'attribution ({$a})';
$string['importallocationstart'] = 'Début de l\'attribution ({$a})';
$string['importprogramallocation'] = 'Importer l\'attribution du programme';
$string['importprogramallocationconfirmation'] = 'Vous importez les paramètres d\'attribution à partir du programme __{$a->fullname} / {$a->idnumber} / {$a->category}__.

Veuillez sélectionner tous les paramètres que vous souhaitez importer.';
$string['importprogramcontent'] = 'Importer le contenu du programme';
$string['importprogramcontentconfirmation'] = 'Vous êtes en train d\'importer le contenu du programme __{$a->fullname} / {$a->idnumber} / {$a->category}__.';
$string['importprogramdue'] = 'Échéance du programme ({$a})';
$string['importprogramend'] = 'Fin du programme ({$a})';
$string['importprogramstart'] = 'Début du programme ({$a})';
$string['importselectprogram'] = 'Sélectionner le programme';
$string['invalidallocationdates'] = 'Dates d\'attribution de programme non valides';
$string['invalidcompletiondate'] = 'Date d\'achèvement de programme non valide';
$string['item'] = 'Élément';
$string['itemcompletion'] = 'Achèvement de l\'élément de programme';
$string['itempoints'] = 'Points';
$string['itemrecalculate'] = 'Recalculer l\'achèvement de l\'élément';
$string['layoutgrid'] = 'Disposition de la grille';
$string['layouttable'] = 'Disposition de la table';
$string['management'] = 'Gestion du programme';
$string['messageprovider:allocation_notification'] = 'Notification d\'attribution du programme';
$string['messageprovider:approval_request_notification'] = 'Notification de demande d\'approbation du programme';
$string['messageprovider:approval_reject_notification'] = 'Notification de rejet de la demande de programme';
$string['messageprovider:completion_notification'] = 'Notification d\'achèvement du programme';
$string['messageprovider:completion_relateduser_notification'] = 'Notification d\'achèvement du programme - utilisateur associé';
$string['messageprovider:deallocation_notification'] = 'Notification de suppression d\'attribution du programme';
$string['messageprovider:duesoon_notification'] = 'Notification de l\'échéance prochaine du programme';
$string['messageprovider:duesoon_relateduser_notification'] = 'Notification de l\'échéance prochaine du programme - utilisateur associé';
$string['messageprovider:due_notification'] = 'Notification de retard du programme';
$string['messageprovider:due_relateduser_notification'] = 'Notification de retard du programme - utilisateur associé';
$string['messageprovider:endsoon_notification'] = 'Notification de la fin prochaine du programme';
$string['messageprovider:endsoon_relateduser_notification'] = 'Notification de la fin prochaine du programme - utilisateur associé';
$string['messageprovider:endcompleted_notification'] = 'Notification de fin de programme';
$string['messageprovider:endfailed_notification'] = 'Notification d\'échec de fin de programme';
$string['messageprovider:endfailed_relateduser_notification'] = 'Notification d\'échec de fin de programme - utilisateur associé';
$string['messageprovider:reset_notification'] = 'Notification de réinitialisation de programme';
$string['messageprovider:start_notification'] = 'Notification de démarrage du programme';
$string['moveitem'] = 'Déplacer l\'élément';
$string['moveitemcancel'] = 'Annuler le déplacement';
$string['moveafter'] = 'Déplacer « {$a->item} » après « {$a->target} »';
$string['movebefore'] = 'Déplacer « {$a->item} » avant « {$a->target} »';
$string['moveinto'] = 'Déplacer « {$a->item} » dans « {$a->target} »';
$string['myprograms'] = 'Mes programmes';
$string['notification_allocation'] = 'Utilisateur affecté';
$string['notification_allocation_subject'] = 'Notification d\'attribution du programme';
$string['notification_allocation_body'] = 'Bonjour {$a->user_fullname},

Vous avez été affecté(e) au programme « {$a->program_fullname} ». La date de début est fixée au {$a->program_startdate}.
';
$string['notification_allocation_description'] = 'Notification envoyée aux utilisateurs affectés au programme.';
$string['notification_completion'] = 'Programme terminé';
$string['notification_completion_subject'] = 'Programme terminé';
$string['notification_completion_body'] = 'Bonjour {$a->user_fullname},

Vous avez terminé le programme « {$a->program_fullname} ».
';
$string['notification_completion_description'] = 'Notification envoyée aux utilisateurs qui ont terminé leur programme.';
$string['notification_completion_relateduser'] = 'Programme terminé - utilisateur associé';
$string['notification_completion_relateduser_subject'] = 'L\'utilisateur {$a->user_fullname} a terminé le programme';
$string['notification_completion_relateduser_body'] = 'Bonjour {$a->relateduser_fullname},

L\'utilisateur {$a->user_fullname} a terminé le programme « {$a->program_fullname} ».
';
$string['notification_completion_relateduser_description'] = 'Notification envoyée aux utilisateurs associés à l\'utilisateur et qui ont terminé leur programme.';
$string['notification_deallocation'] = 'Utilisateur retiré';
$string['notification_deallocation_subject'] = 'Notification de suppression d\'attribution du programme';
$string['notification_deallocation_body'] = 'Bonjour {$a->user_fullname},

Vous avez été retiré(e) du programme « {$a->program_fullname} ».
';
$string['notification_deallocation_description'] = 'Notification envoyée aux utilisateurs qui ont été retirés du programme.';
$string['notification_duesoon'] = 'La date d\'échéance du programme approche';
$string['notification_duesoon_subject'] = 'Fin du programme proche';
$string['notification_duesoon_body'] = 'Bonjour {$a->user_fullname},

La fin du programme « {$a->program_fullname} » est prévue le {$a->program_duedate}.
';
$string['notification_duesoon_description'] = 'Notification envoyée aux utilisateurs avant la date de fin de leur programme, sauf si le programme est déjà terminé.';
$string['notification_duesoon_relateduser'] = 'Échéance prochaine du programme - utilisateur associé';
$string['notification_duesoon_relateduser_subject'] = 'Fin du programme proche pour l\'utilisateur {$a->user_fullname}';
$string['notification_duesoon_relateduser_body'] = 'Bonjour {$a->relateduser_fullname},

La fin du programme « {$a->program_fullname} » de l\'utilisateur {$a->user_fullname} est prévue le {$a->program_duedate}.
';
$string['notification_duesoon_relateduser_description'] = 'Notification envoyée aux utilisateurs associés à l\'utilisateur avant la date de fin de leur programme, sauf si le programme est déjà terminé.';
$string['notification_due'] = 'Programme en retard';
$string['notification_due_subject'] = 'Fin du programme reportée';
$string['notification_due_body'] = 'Bonjour {$a->user_fullname},

le programme « {$a->program_fullname} » était censé être achevé avant le {$a->program_duedate}.
';
$string['notification_due_description'] = 'Notification envoyée aux utilisateurs qui ont pris du retard dans l\'exécution du programme.';
$string['notification_due_relateduser'] = 'Retard du programme - utilisateur associé';
$string['notification_due_relateduser_subject'] = 'Le programme était censé être achevé pour l\'utilisateur {$a->user_fullname}';
$string['notification_due_relateduser_body'] = 'Bonjour {$a->relateduser_fullname},

La fin du programme « {$a->program_fullname} » de l\'utilisateur {$a->user_fullname} est prévue avant le {$a->program_duedate}.
';
$string['notification_due_relateduser_description'] = 'Notification envoyée aux utilisateurs associés à l\'utilisateur qui ont pris du retard dans l\'exécution du programme.';
$string['notification_endsoon'] = 'Fin prochaine du programme';
$string['notification_endsoon_subject'] = 'Le programme se termine bientôt';
$string['notification_endsoon_body'] = 'Bonjour {$a->user_fullname},

Le programme « {$a->program_fullname} » se termine le {$a->program_enddate}.
';
$string['notification_endsoon_description'] = 'Notification envoyée aux utilisateurs avant la date de fin de leur programme, sauf si le programme est déjà terminé.';
$string['notification_endsoon_relateduser'] = 'Fin prochaine du programme - utilisateur associé';
$string['notification_endsoon_relateduser_subject'] = 'Le programme se termine bientôt pour l\'utilisateur {$a->user_fullname}';
$string['notification_endsoon_relateduser_body'] = 'Bonjour {$a->relateduser_fullname},

Le programme « {$a->program_fullname} » de l\'utilisateur {$a->user_fullname} se termine le {$a->program_enddate}.
';
$string['notification_endsoon_relateduser_description'] = 'Notification envoyée aux utilisateurs associés à l\'utilisateur avant la date de fin de leur programme, sauf si le programme est déjà terminé.';
$string['notification_endcompleted'] = 'Programme terminé';
$string['notification_endcompleted_subject'] = 'Programme terminé';
$string['notification_endcompleted_body'] = 'Bonjour {$a->user_fullname},

Le programme « {$a->program_fullname} » est terminé, vous l\'avez achevé plus tôt.
';
$string['notification_endcompleted_description'] = 'Notification envoyée aux utilisateurs qui ont terminé le programme.';
$string['notification_endfailed'] = 'Échec de fin de programme';
$string['notification_endfailed_subject'] = 'Échec de fin de programme';
$string['notification_endfailed_body'] = 'Bonjour {$a->user_fullname},

Le programme « {$a->program_fullname} » est terminé, vous n\'avez pas réussi à l\'achever.
';
$string['notification_endfailed_description'] = 'Notification envoyée aux utilisateurs qui n\'ont pas réussi à terminer le programme.';
$string['notification_endfailed_relateduser'] = 'Échec de fin de programme - utilisateur associé';
$string['notification_endfailed_relateduser_subject'] = 'Échec de fin de programme de l\'utilisateur {$a->user_fullname}';
$string['notification_endfailed_relateduser_body'] = 'Bonjour {$a->relateduser_fullname},

Le programme « {$a->program_fullname} » est terminé et l\'utilisateur {$a->user_fullname} n\'a pas réussi à l\'achever.
';
$string['notification_endfailed_relateduser_description'] = 'Notification envoyée aux utilisateurs associés à l\'utilisateur quand le programme qu\'ils n\'ont pas réussi à achever se termine.';
$string['notification_relateduserfield'] = 'Champ de l\'utilisateur associé à la notification';
$string['notification_relateduserfield_desc'] = 'Sélectionnez le champ de profil des utilisateurs associés à utiliser pour la notification des utilisateurs associés.';
$string['notification_reset'] = 'Réinitialisation de la progression de l\'utilisateur';
$string['notification_reset_subject'] = 'Notification de réinitialisation de programme';
$string['notification_reset_body'] = 'Bonjour {$a->user_fullname},

Votre progression dans le programme « {$a->program_fullname} » a été réinitialisée.
';
$string['notification_reset_description'] = 'Notification envoyée aux utilisateurs dont la progression du programme est réinitialisée.';
$string['notification_start'] = 'Programme démarré';
$string['notification_start_subject'] = 'Programme démarré';
$string['notification_start_body'] = 'Bonjour {$a->user_fullname},

Le programme « {$a->program_fullname} » a démarré.
';
$string['notification_start_description'] = 'Notification envoyée aux utilisateurs dont le programme a démarré.';
$string['notificationdates'] = 'Dates de notification';
$string['notset'] = 'Non défini';
$string['plugindisabled'] = 'Le plug-in Inscription au programme est désactivé, les programmes ne seront pas fonctionnels.

[Enable plugin now]({$a->url})';
$string['pluginname'] = 'Programmes';
$string['pluginname_desc'] = 'Les programmes sont conçus pour permettre la création d\'ensembles de cours.';
$string['privacy:metadata:field:programid'] = 'ID du programme';
$string['privacy:metadata:field:userid'] = 'ID utilisateur';
$string['privacy:metadata:field:allocationid'] = 'ID d\'attribution du programme';
$string['privacy:metadata:field:sourceid'] = 'Source d\'attribution';
$string['privacy:metadata:field:itemid'] = 'Identifiant d\'élément';
$string['privacy:metadata:field:timecreated'] = 'Date de création';
$string['privacy:metadata:field:timecompleted'] = 'Date d\'achèvement';

$string['privacy:metadata:table:enrol_programs_allocations'] = 'Informations sur les attributions de programme';
$string['privacy:metadata:field:archived'] = 'Enregistrement archivé';
$string['privacy:metadata:field:sourcedatajson'] = 'Informations sur la source de l\'attribution';
$string['privacy:metadata:field:timeallocated'] = 'Date d\'attribution du programme';
$string['privacy:metadata:field:timestart'] = 'Date de début';
$string['privacy:metadata:field:timedue'] = 'Date d\'échéance';
$string['privacy:metadata:field:timeend'] = 'Date de fin';

$string['privacy:metadata:table:enrol_programs_certs_issues'] = 'Problèmes de certificat d\'attribution de programme';
$string['privacy:metadata:field:issueid'] = 'ID du problème';

$string['privacy:metadata:table:enrol_programs_completions'] = 'Attributions de programme terminées';

$string['privacy:metadata:table:enrol_programs_evidences'] = 'Informations sur d\'autres preuves d\'achèvement';
$string['privacy:metadata:field:evidencejson'] = 'Informations sur les preuves d\'achèvement';
$string['privacy:metadata:field:createdby'] = 'Preuve créée par';

$string['privacy:metadata:table:enrol_programs_requests'] = 'Informations sur la demande d\'attribution';
$string['privacy:metadata:field:datajson'] = 'Informations sur la demande';
$string['privacy:metadata:field:timerequested'] = 'Date de la demande';
$string['privacy:metadata:field:timerejected'] = 'Date de rejet';
$string['privacy:metadata:field:rejectedby'] = 'Demande rejetée par';


$string['privacy:metadata:table:enrol_programs_usr_snapshots'] = 'Instantanés d\'attribution de programme';
$string['privacy:metadata:field:reason'] = 'Motif';
$string['privacy:metadata:field:timesnapshot'] = 'Date de l\'instantané';
$string['privacy:metadata:field:snapshotby'] = 'Instantané créé par';
$string['privacy:metadata:field:explanation'] = 'Explication';
$string['privacy:metadata:field:completionsjson'] = 'Informations sur l\'achèvement';
$string['privacy:metadata:field:evidencesjson'] = 'Informations sur les preuves d\'achèvement';

$string['privacy:metadata:table:enrol_programs_src_commholds'] = 'Réservations d\'affectations commerciales';
$string['privacy:metadata:field:quantity'] = 'Quantité';

$string['program'] = 'Programme';
$string['programautofix'] = 'Programme de réparation automatique';
$string['programdue'] = 'Échéance du programme';
$string['programdue_help'] = 'La date d\'échéance du programme indique la date à laquelle les utilisateurs sont censés terminer le programme.';
$string['programdue_delay'] = 'Échéance après le début';
$string['programdue_date'] = 'Date d\'échéance';
$string['programend'] = 'Fin du programme';
$string['programend_help'] = 'Les utilisateurs ne peuvent pas accéder aux cours du programme après la fin du programme';
$string['programend_delay'] = 'Fin après le début';
$string['programend_date'] = 'Date de fin du programme';
$string['programcompletion'] = 'Date d\'achèvement du programme';
$string['programcompletionoverride'] = 'Écraser l\'achèvement du programme';
$string['programidnumber'] = 'Identifiant du programme';
$string['programimage'] = 'Image du programme';
$string['programname'] = 'Nom du programme';
$string['programurl'] = 'URL du programme';
$string['programs'] = 'Programmes';
$string['programsactive'] = 'Actif';
$string['programsarchived'] = 'Archivé';
$string['programsarchived_help'] = 'Les programmes archivés sont masqués pour les utilisateurs et leur progression est verrouillée.';
$string['programslayout'] = 'Disposition de la page des détails du programme';
$string['programslayout_desc'] = 'Contrôle la disposition des programmes ; vue table ou grille pour la page Mes programmes.';
$string['programslayoutallowuserswitch'] = 'Autoriser les utilisateurs à changer la disposition du programme';
$string['programslayoutallowuserswitch_desc'] = 'Autoriser les utilisateurs à changer la disposition du programme';
$string['programslayout_desc'] = 'Contrôle la disposition des programmes ; vue table ou grille pour la page Mes programmes.';
$string['programsblocklayout'] = 'Disposition du bloc Mes programmes';
$string['programsblocklayout_desc'] = 'Contrôle la disposition des programmes ; vue table ou grille pour le bloc Mes Programmes.';

$string['programstart'] = 'Démarrage du programme';
$string['programstart_help'] = 'Les utilisateurs ne peuvent pas accéder aux cours du programme avant le début du programme.';
$string['programstart_allocation'] = 'Démarrage immédiat après l\'attribution';
$string['programstart_delay'] = 'Démarrage différé après l\'attribution';
$string['programstart_date'] = 'Date de début du programme';
$string['programstatus'] = 'Statut du programme';
$string['programstatus_completed'] = 'Terminé';
$string['programstatus_any'] = 'Tout statut de programme';
$string['programstatus_archived'] = 'Archivé';
$string['programstatus_archivedcompleted'] = 'Archivage terminé';
$string['programstatus_overdue'] = 'En retard';
$string['programstatus_open'] = 'Ouvert';
$string['programstatus_future'] = 'Pas encore ouvert';
$string['programstatus_failed'] = 'Échec';
$string['programs:addcourse'] = 'Ajouter un cours aux programmes';
$string['programs:addtocertifications'] = 'Ajouter un programme aux certifications';
$string['programs:addtoplan'] = 'Ajouter un programme aux plans';
$string['programs:allocate'] = 'Affecter des étudiants aux programmes';
$string['programs:archive'] = 'Archiver des attributions de programme';
$string['programs:clone'] = 'Autoriser le clonage du contenu et des paramètres du programme';
$string['programs:configframeworks'] = 'Configurer la disponibilité du programme dans les cadres de plan';
$string['programs:configurecustomfields'] = 'Configurer les champs personnalisés du programme';
$string['programs:delete'] = 'Supprimer des programmes';
$string['programs:edit'] = 'Ajouter et mettre à jour des programmes';
$string['programs:export'] = 'Exporter des programmes';
$string['programs:admin'] = 'Administration avancée des programmes';
$string['programs:manageallocation'] = 'Gérer les attributions d\'utilisateur';
$string['programs:manageevidence'] = 'Gérer d\'autres preuves d\'achèvement';
$string['programs:reset'] = 'Réinitialiser la progression du programme';
$string['programs:upload'] = 'Charger les programmes';
$string['programs:view'] = 'Afficher la gestion des programmes';
$string['programs:viewcatalogue'] = 'Accéder au catalogue de programmes';
$string['public'] = 'Public';
$string['public_help'] = 'Les programmes publics sont visibles pour tous les utilisateurs.

Le statut de visibilité n\'affecte pas les programmes déjà attribués.';
$string['purchaseaccess'] = 'Acheter l\'accès';
$string['resetallocation'] = 'Réinitialiser la progression du programme';
$string['resettype'] = 'Type de réinitialisation';
$string['resettype_deallocate'] = 'Annulation de l\'attribution de programme';
$string['resettype_full'] = 'Purge complète du cours';
$string['resettype_none'] = 'Aucune';
$string['resettype_standard'] = 'Purge standard du cours';
$string['sequencetype'] = 'Type d\'achèvement';
$string['sequencetype_allinorder'] = 'Tout dans l\'ordre';
$string['sequencetype_allinanyorder'] = 'Tout dans n\'importe quel ordre';
$string['sequencetype_atleast'] = 'Au moins {$a->min}';
$string['sequencetype_minpoints'] = '{$a->minpoints} points minimum';
$string['selectcategory'] = 'Choisir une catégorie';
$string['sortbyprogramname'] = 'Trier par nom de programme';
$string['sortbyprogramid'] = 'Trier par ID de programme';
$string['sortbyprogramstart'] = 'Trier par date de début du programme';
$string['sortbyprogramdue'] = 'Trier par date d\'échéance du programme';
$string['sortbyprogramend'] = 'Trier par date de fin du programme';
$string['source'] = 'Source';
$string['source_approval'] = 'Demandes avec approbation';
$string['source_approval_allownew'] = 'Autoriser les approbations';
$string['source_approval_allownew_desc'] = 'Autoriser l\'ajout de nouvelles sources de _requests with approval_ aux programmes';
$string['source_approval_allowrequest'] = 'Autoriser les nouvelles demandes';
$string['source_approval_confirm'] = 'Confirmez si vous souhaitez demander l\'attribution du programme.';
$string['source_approval_daterequested'] = 'Date de la demande';
$string['source_approval_daterejected'] = 'Date de rejet';
$string['source_approval_makerequest'] = 'Demander l\'accès';
$string['source_approval_notification_approval_request_subject'] = 'Notification de demande de programme';
$string['source_approval_notification_approval_request_body'] = '
L\'utilisateur {$a->user_fullname} a demandé l\'accès au programme « {$a->program_fullname} ».
';
$string['source_approval_notification_approval_reject_subject'] = 'Notification de rejet de la demande de programme';
$string['source_approval_notification_approval_reject_body'] = 'Bonjour {$a->user_fullname},

Votre demande d\'accès au programme « {$a->program_fullname} » a été rejetée.

{$a->reason}
';
$string['source_approval_requestallowed'] = 'Demandes autorisées';
$string['source_approval_requestnotallowed'] = 'Demandes non autorisées';
$string['source_approval_requests'] = 'Demandes';
$string['source_approval_requestpending'] = 'Demande d\'accès en attente';
$string['source_approval_requestrejected'] = 'La demande d\'accès rejetée';
$string['source_approval_requestapprove'] = 'Approuver la demande';
$string['source_approval_requestreject'] = 'Rejeter la demande';
$string['source_approval_requestdelete'] = 'Supprimer la demande';
$string['source_approval_rejectionreason'] = 'Motif du rejet';
$string['source_certify'] = 'Certifications';
$string['source_certify_allownew'] = 'Autoriser l\'attribution de certifications';
$string['source_certify_allownew_desc'] = 'Autoriser l\'ajout de nouvelles sources _certification_ aux programmes';
$string['source_cohort'] = 'Attribution automatique de promotion';
$string['source_cohort_allownew'] = 'Autoriser l\'attribution de promotion';
$string['source_cohort_allownew_desc'] = 'Autoriser l\'ajout de nouvelles sources _cohort auto allocation_ aux programmes';
$string['source_cohort_cohortstoallocate'] = 'Attribuer des promotions';
$string['source_ecommerce'] = 'Affectations e-commerce';
$string['source_ecommerce_allownew'] = 'Autoriser l\'affectation e-commerce';
$string['source_ecommerce_allownew_desc'] = 'Autoriser l\'ajout de nouvelles sources d\'auto-affectation e-commerce aux programmes';
$string['source_ecommerce_allowsignup'] = 'Autoriser de nouvelles affectations';
$string['source_ecommerce_cohortmembershiprequirement'] = 'Les utilisateurs doivent être membres de l\'une des promotions suivantes : {$a}';
$string['source_ecommerce_maxusers'] = 'Nombre max d\'utilisateurs';
$string['source_ecommerce_nocapacity'] = 'Aucune capacité restante sur ce programme';
$string['source_manual'] = 'Attribution manuelle';
$string['source_manual_allocateusers'] = 'Attribuer des utilisateurs';
$string['source_manual_csvfile'] = 'Fichier CSV';
$string['source_manual_hasheaders'] = 'La première ligne correspond à l\'en-tête';
$string['source_manual_potusersmatching'] = 'Candidats à l\'attribution correspondants';
$string['source_manual_potusers'] = 'Candidats à l\'attribution';
$string['source_manual_result_assigned'] = '{$a} utilisateurs ont été affectés au programme.';
$string['source_manual_result_errors'] = '{$a} erreurs détectées lors de l\'attribution de programmes.';
$string['source_manual_result_skipped'] = '{$a} utilisateurs ont déjà été affectés au programme.';
$string['source_manual_timeduecolumn'] = 'Colonne de l\'heure d\'échéance';
$string['source_manual_timeendcolumn'] = 'Colonne de l\'heure de fin';
$string['source_manual_timestartcolumn'] = 'Colonne de l\'heure de début';
$string['source_manual_uploadusers'] = 'Charger les attributions';
$string['source_manual_usercolumn'] = 'Colonne d\'ID de l\'utilisateur';
$string['source_manual_usermapping'] = 'Mappage des utilisateurs via';
$string['source_manual_userupload_allocated'] = 'Attribué à \'{$a}\'';
$string['source_manual_userupload_alreadyallocated'] = 'Déjà attribué à \'{$a}\'';
$string['source_manual_userupload_invalidprogram'] = 'Attribution à \'{$a}\' impossible';
$string['source_selfallocation'] = 'Auto-attribution';
$string['source_selfallocation_allocate'] = 'S\'inscrire';
$string['source_selfallocation_allownew'] = 'Autoriser l\'auto-attribution';
$string['source_selfallocation_allownew_desc'] = 'Autoriser l\'ajout de nouvelles sources _self allocation_ aux programmes';
$string['source_selfallocation_allowsignup'] = 'Autoriser les nouvelles inscriptions';
$string['source_selfallocation_confirm'] = 'Confirmez si vous souhaitez être affecté(e) au programme.';
$string['source_selfallocation_enable'] = 'Activer l\'auto-attribution';
$string['source_selfallocation_key'] = 'Clé d\'inscription';
$string['source_selfallocation_keyrequired'] = 'La clé d\'inscription est requise';
$string['source_selfallocation_maxusers'] = 'Nombre max d\'utilisateurs';
$string['source_selfallocation_maxusersreached'] = 'Nombre maximum d\'utilisateurs déjà auto-attribués';
$string['source_selfallocation_maxusers_status'] = 'Utilisateurs {$a->count}/{$a->max}';
$string['source_selfallocation_signupallowed'] = 'Inscriptions autorisées';
$string['source_selfallocation_signupnotallowed'] = 'Inscriptions non autorisées';
$string['source_udplans'] = 'Plans de développement de l\'utilisateur';
$string['source_udplans_allownew'] = 'Plans de développement de l\'utilisateur';
$string['source_udplans_allownew_desc'] = 'Autoriser l\'ajout de nouvelles sources _user development plans_ aux programmes';
$string['source_udplans_allowed'] = 'Autorisé';
$string['source_udplans_noframeworks'] = 'Impossible de les ajouter aux plans';
$string['source_udplans_notallowed'] = 'Interdit';
$string['source_udplans_requirecap'] = 'Ajouter la capacité requise';
$string['set'] = 'Ensemble de cours';
$string['settings'] = 'Paramètres du programme';
$string['scheduling'] = 'Planification';
$string['taballocation'] = 'Réglages des attributions';
$string['tabcontent'] = 'Contenu';
$string['tabgeneral'] = 'Général';
$string['tabusers'] = 'Utilisateurs';
$string['tabvisibility'] = 'Paramètres de visibilité';
$string['tagarea_enrol_programs_programs'] = 'Programmes';
$string['taskcertificate'] = 'Certificat des programmes qui émettent une tâche Cron';
$string['taskcron'] = 'Tâche Cron du plug-in Programmes';
$string['training'] = 'Formation';
$string['trainingcompletion'] = 'Formation requise : {$a}';
$string['trainingprogress'] = 'Progression de la formation : {$a->current}/{$a->total}';
$string['unarchive'] = 'Restaurer';
$string['unlinkeditems'] = 'Éléments dissociés';
$string['updateprogram'] = 'Mettre à jour le programme';
$string['updateallocation'] = 'Mettre à jour l\'attribution';
$string['updateallocations'] = 'Mettre à jour les attributions';
$string['updatecourse'] = 'Mettre à jour le cours';
$string['updateset'] = 'Mettre à jour l\'ensemble';
$string['updatescheduling'] = 'Mettre à jour la planification';
$string['updatesource'] = 'Mettre à jour {$a}';
$string['updatetraining'] = 'Mettre à jour la formation';
$string['upload'] = 'Charger les programmes';
$string['upload_invalidcount'] = 'Enregistrements non valides';
$string['upload_files'] = 'Fichiers';
$string['upload_files_error'] = 'Plusieurs fichiers CSV, un fichier JSON ou une archive Zip sont attendus';
$string['upload_preview'] = 'Aperçu des données';
$string['upload_status'] = 'État';
$string['upload_status_invalid'] = 'Non valide';
$string['upload_targetcontext'] = 'Ajouter des programmes dans le contexte';
$string['upload_uploadcount'] = 'Programmes à télécharger';
$string['upload_usecategory'] = 'Utiliser la colonne de catégorie pour les contextes';
$string['userupload_completion_error'] = 'Impossible de mettre à jour l\'achèvement du programme';
$string['userupload_completion_updated'] = 'L\'achèvement du programme a été mis à jour';

$string['rb_allocatedprograms'] = 'Programmes attribués';
$string['rb_complete'] = 'Terminer';
$string['rb_completiondate'] = 'Date d\'achèvement';
$string['rb_completionstatus'] = 'État d\'achèvement';
$string['rb_datecompleted'] = 'Date de fin';
$string['rb_dateallocated'] = 'Date d\'attribution';
$string['rb_datestarted'] = 'Date de début';
$string['rb_coursesall'] = 'Cours - Tous';
$string['rb_incomplete'] = 'Incomplet';
$string['rb_isallocated'] = 'Est attribué';
$string['rb_iscomplete'] = 'Est terminé ?';
$string['rb_iscompleteany'] = 'Terminé ? (toute méthode)';
$string['rb_isinprogress'] = 'Est en cours ?';
$string['rb_isnotcomplete'] = 'N\'est pas achevé ?';
$string['rb_isnotyetstarted'] = 'N\'est pas encore commencé ?';
$string['rb_notstarted'] = 'Pas commencé';
$string['rb_officewhencompletedbasic'] = 'Bureau une fois terminé (basique)';
$string['rb_privacy:metadata'] = 'Le plug-in ne stocke aucune donnée personnelle.';
$string['rb_programcategory'] = 'Catégorie de programme (ou site)';
$string['rb_programcategoryid'] = 'ID de catégorie de programme (sans objet s\'il s\'agit d\'un site)';
$string['rb_programcategoryidnumber'] = 'Numéro d\'ID de catégorie de programme (sans objet s\'il s\'agit d\'un site)';
$string['rb_programcategorymultichoice'] = 'Catégorie de programme (choix multiple)';
$string['rb_programedatecreated'] = 'Date de création du programme';
$string['rb_programduedate'] = 'Date d\'échéance du programme';
$string['rb_programenddate'] = 'Date de fin d\'attribution du programme';
$string['rb_programallocationtype'] = 'Type d\'attribution';
$string['rb_programallocationtypes'] = 'Types d\'attribution';
$string['rb_programexpandlink'] = 'Nom du programme (développer les détails)';
$string['rb_programid'] = 'ID du programme';
$string['rb_programidnumber'] = 'Numéro d\'ID du programme';
$string['rb_programname'] = 'Nom du programme';
$string['rb_programnameandsummary'] = 'Nom et description du programme';
$string['rb_programnamelinked'] = 'Nom du programme (lié à la page du programme)';
$string['rb_programmultiitem'] = 'Programme (plusieurs éléments)';
$string['rb_programsingleitem'] = 'Programme';
$string['rb_programstartdate'] = 'Date de début de l\'attribution du programme';
$string['rb_programsummary'] = 'Description du programme';
$string['rb_programvisible'] = 'Le programme est-il public ?';
$string['rb_programvisibledisabled'] = 'Programme visible (non applicable)';
$string['rb_progress'] = 'Progression';
$string['rb_progressnumeric'] = 'Progression (numérique)';
$string['rb_progresspercent'] = 'Progression (% effectué)';
$string['rb_source_allocation'] = 'Attributions du programme';
$string['rb_timetocompletesinceenrol'] = 'Durée d\'exécution (depuis la date d\'attribution)';
$string['rb_timetocompletesincestart'] = 'Durée d\'exécution (depuis la date de début)';
$string['rb_type_program'] = 'Programme';
$string['rb_type_program_category'] = 'Catégorie';
$string['rb_type_program_completion'] = 'Attribution du programme';
$string['rb_type_program_customfields'] = 'Champs de programme personnalisés';
$string['rb_user'] = 'L\'utilisateur';
$string['rb_viewprogram'] = 'Afficher le programme';
$string['rb_visiblecohorts'] = 'Promotions avec visibilité';
