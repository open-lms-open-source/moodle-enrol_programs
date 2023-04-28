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
 * @copyright  2023 Open LMS (https://www.openlms.net/)
 * @author     Chris Tranel
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['addprogram'] = 'Ajouter un programme';
$string['addset'] = 'Ajouter un nouvel ensemble';
$string['allocationend'] = 'Fin de l\'attribution';
$string['allocationend_help'] = 'La date de fin de l\'attribution dépend des sources d\'allocation activées. En général, une nouvelle attribution n\'est pas possible après cette date.';
$string['allocation'] = 'Attribution';
$string['allocations'] = 'Attributions';
$string['programallocations'] = 'Attributions du programme';
$string['allocationdate'] = 'Date d\'attribution';
$string['allocationsources'] = 'Sources d\'attribution';
$string['allocationstart'] = 'Début de l\'attribution';
$string['allocationstart_help'] = 'La date de fin de l\'attribution dépend des sources d\'allocation activées. En général, une nouvelle attribution n\'est possible qu\'après cette date.';
$string['allprograms'] = 'Tous les programmes';
$string['appenditem'] = 'Ajouter un élément';
$string['appendinto'] = 'Ajouter à l\'élément';
$string['archived'] = 'Archivé';
$string['catalogue'] = 'Catalogue des programmes';
$string['catalogue_dofilter'] = 'Rechercher';
$string['catalogue_resetfilter'] = 'Effacer';
$string['catalogue_searchtext'] = 'Texte de recherche';
$string['catalogue_tag'] = 'Filtrer par balise';
$string['certificatetemplatechoose'] = 'Choisissez un modèle...';
$string['cohorts'] = 'Visible par les promotions';
$string['cohorts_help'] = 'Les programmes non publics peuvent être rendus visibles pour certains membres de la promotion.

Le statut de visibilité n\'affecte pas les programmes déjà attribués.';
$string['completiondate'] = 'Date d\'achèvement';
$string['creategroups'] = 'Groupes de cours';
$string['creategroups_help'] = 'Si cette option est activée, un groupe sera créé dans chaque cours ajouté au programme et tous les utilisateurs affectés seront ajoutés comme membres du groupe.';
$string['deleteallocation'] = 'Supprimer l\'attribution du programme';
$string['deletecourse'] = 'Supprimer le cours';
$string['deleteprogram'] = 'Supprimer le programme';
$string['deleteset'] = 'Supprimer l\'ensemble';
$string['documentation'] = 'Programmes pour la documentation Moodle';
$string['duedate'] = 'Date d\'échéance';
$string['enrolrole'] = 'Rôle dans le cours';
$string['enrolrole_desc'] = 'Sélectionnez le rôle qui sera utilisé par les programmes pour l\'inscription aux cours';
$string['errorcontentproblem'] = 'Problème détecté dans la structure du contenu du programme, l\'achèvement du programme ne sera pas suivi correctement !';
$string['errordifferenttenant'] = 'Impossible d\'accéder au programme d\'un autre client';
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
$string['evidence_details'] = 'Détails';
$string['fixeddate'] = 'À date fixe';
$string['item'] = 'Élément';
$string['itemcompletion'] = 'Achèvement de l\'élément de programme';
$string['management'] = 'Gestion du programme';
$string['messageprovider:allocation_notification'] = 'Notification d\'attribution du programme';
$string['messageprovider:approval_request_notification'] = 'Notification de demande d\'approbation du programme';
$string['messageprovider:approval_reject_notification'] = 'Notification de rejet de la demande de programme';
$string['messageprovider:completion_notification'] = 'Notification d\'achèvement du programme';
$string['messageprovider:deallocation_notification'] = 'Notification de suppression d\'attribution du programme';
$string['messageprovider:duesoon_notification'] = 'Notification de l\'échéance prochaine du programme';
$string['messageprovider:due_notification'] = 'Notification de retard du programme';
$string['messageprovider:endsoon_notification'] = 'Notification de la fin prochaine du programme';
$string['messageprovider:endcompleted_notification'] = 'Notification de fin de programme';
$string['messageprovider:endfailed_notification'] = 'Notification d\'échec de fin de programme';
$string['messageprovider:start_notification'] = 'Notification de démarrage du programme';
$string['moveitem'] = 'Déplacer l\'élément';
$string['moveitemcancel'] = 'Annuler le déplacement';
$string['moveafter'] = 'Déplacer « {$a->item} » après « {$a->target} »';
$string['movebefore'] = 'Déplacer « {$a->item} » avant « {$a->target} »';
$string['moveinto'] = 'Déplacer « {$a->item} » vers « {$a->target} »';
$string['myprograms'] = 'Mes programmes';
$string['notification_allocation'] = 'Utilisateur affecté';
$string['notification_completion'] = 'Programme terminé';
$string['notification_completion_subject'] = 'Programme terminé';
$string['notification_completion_body'] = 'Bonjour {$a->user_fullname},

vous avez terminé le programme « {$a->program_fullname} ».
';
$string['notification_deallocation'] = 'Utilisateur retiré';
$string['notification_duesoon'] = 'La date d\'échéance du programme approche';
$string['notification_duesoon_subject'] = 'Fin du programme proche';
$string['notification_duesoon_body'] = 'Bonjour {$a->user_fullname},

la fin du programme « {$a->program_fullname} » est prévue le {$a->program_duedate}.
';
$string['notification_due'] = 'Programme en retard';
$string['notification_due_subject'] = 'Fin du programme reportée';
$string['notification_due_body'] = 'Bonjour {$a->user_fullname},

le programme « {$a->program_fullname} » était censé être achevé avant le {$a->program_duedate}.
';
$string['notification_endsoon'] = 'Fin prochaine du programme';
$string['notification_endsoon_subject'] = 'Le programme se termine bientôt';
$string['notification_endsoon_body'] = 'Bonjour {$a->user_fullname},

le programme « {$a->program_fullname} » se termine le {$a->program_enddate}.
';
$string['notification_endcompleted'] = 'Programme terminé';
$string['notification_endcompleted_subject'] = 'Programme terminé';
$string['notification_endcompleted_body'] = 'Bonjour {$a->user_fullname},

le programme « {$a->program_fullname} » est terminé, vous l\'avez achevé plus tôt.
';
$string['notification_endfailed'] = 'Échec de fin de programme';
$string['notification_endfailed_subject'] = 'Échec de fin de programme';
$string['notification_endfailed_body'] = 'Bonjour {$a->user_fullname},

le programme « {$a->program_fullname} » est terminé, vous n\'avez pas réussi à l\'achever.
';
$string['notification_start'] = 'Programme démarré';
$string['notification_start_subject'] = 'Programme démarré';
$string['notification_start_body'] = 'Bonjour {$a->user_fullname},

le programme « {$a->program_fullname} » a démarré.
';
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
$string['programidnumber'] = 'Identifiant du programme';
$string['programimage'] = 'Image du programme';
$string['programname'] = 'Nom du programme';
$string['programurl'] = 'URL du programme';
$string['programs'] = 'Programmes';
$string['programsactive'] = 'Actif';
$string['programsarchived'] = 'Archivé';
$string['programsarchived_help'] = 'Les programmes archivés sont masqués pour les utilisateurs et leur progression est verrouillée.';
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
$string['programs:allocate'] = 'Affecter des étudiants aux programmes';
$string['programs:delete'] = 'Supprimer des programmes';
$string['programs:edit'] = 'Ajouter et mettre à jour des programmes';
$string['programs:admin'] = 'Administration avancée des programmes';
$string['programs:manageevidence'] = 'Gérer d\'autres preuves d\'achèvement';
$string['programs:view'] = 'Afficher la gestion des programmes';
$string['programs:viewcatalogue'] = 'Accéder au catalogue de programmes';
$string['public'] = 'Public';
$string['public_help'] = 'Les programmes publics sont visibles par tous les utilisateurs.

Le statut de visibilité n\'affecte pas les programmes déjà attribués.';
$string['sequencetype'] = 'Type d\'achèvement';
$string['sequencetype_allinorder'] = 'Tout dans l\'ordre';
$string['sequencetype_allinanyorder'] = 'Tout dans n\'importe quel ordre';
$string['sequencetype_atleast'] = 'Au moins {$a->min}';
$string['selectcategory'] = 'Choisir une catégorie';
$string['source'] = 'Source';
$string['source_approval'] = 'Demandes avec approbation';
$string['source_approval_allownew'] = 'Autoriser les approbations';
$string['source_approval_allownew_desc'] = 'Autoriser l\'ajout de nouvelles sources de _requests with approval_ aux programmes';
$string['source_approval_allowrequest'] = 'Autoriser les nouvelles demandes';
$string['source_approval_confirm'] = 'Confirmez si vous souhaitez demander l\'attribution du programme.';
$string['source_approval_daterequested'] = 'Date de la demande';
$string['source_approval_daterejected'] = 'Date de rejet';
$string['source_approval_makerequest'] = 'Demander l\'accès';
$string['source_approval_notification_allocation_subject'] = 'Notification d\'approbation du programme';
$string['source_approval_notification_allocation_body'] = 'Bonjour {$a->user_fullname},

votre inscription au programme « {$a->program_fullname} » a été approuvée. La date de début est fixée au {$a->program_startdate}.
';
$string['source_approval_notification_approval_request_subject'] = 'Notification de demande de programme';
$string['source_approval_notification_approval_request_body'] = '
L\'utilisateur {$a->user_fullname} a demandé l\'accès au programme « {$a->program_fullname} ».
';
$string['source_approval_notification_approval_reject_subject'] = 'Notification de rejet de la demande de programme';
$string['source_approval_notification_approval_reject_body'] = 'Bonjour {$a->user_fullname},

votre demande d\'accès au programme « {$a->program_fullname} » a été rejetée.

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
$string['notification_allocation_subject'] = 'Notification d\'attribution du programme';
$string['notification_allocation_body'] = 'Bonjour {$a->user_fullname},

vous avez été affecté(e) au programme « {$a->program_fullname} ». La date de début est fixée au {$a->program_startdate}.
';
$string['notification_deallocation_subject'] = 'Notification de suppression d\'attribution du programme';
$string['notification_deallocation_body'] = 'Bonjour {$a->user_fullname},

vous avez été retiré(e) du programme « {$a->program_fullname} ».
';
$string['source_cohort'] = 'Attribution automatique de promotion';
$string['source_cohort_allownew'] = 'Autoriser l\'attribution de promotion';
$string['source_cohort_allownew_desc'] = 'Autoriser l\'ajout de nouvelles sources _cohort auto allocation_ aux programmes';
$string['source_manual'] = 'Attribution manuelle';
$string['source_manual_allocateusers'] = 'Attribuer des utilisateurs';
$string['source_manual_csvfile'] = 'Fichier CSV';
$string['source_manual_hasheaders'] = 'La première ligne correspond à l\'en-tête';
$string['source_manual_potusersmatching'] = 'Candidats à l\'attribution correspondants';
$string['source_manual_potusers'] = 'Candidats à l\'attribution';
$string['source_manual_result_assigned'] = '{$a} utilisateurs ont été affectés au programme.';
$string['source_manual_result_errors'] = '{$a} erreurs détectées lors de l\'attribution de programmes.';
$string['source_manual_result_skipped'] = '{$a} utilisateurs ont déjà été affectés au programme.';
$string['source_manual_uploadusers'] = 'Charger les attributions';
$string['source_manual_usercolumn'] = 'Colonne d\'ID de l\'utilisateur';
$string['source_manual_usermapping'] = 'Mappage des utilisateurs via';
$string['source_manual_userupload_allocated'] = 'Attribué à « {$a} »';
$string['source_manual_userupload_alreadyallocated'] = 'Déjà attribué à « {$a} »';
$string['source_manual_userupload_invalidprogram'] = 'Attribution à « {$a} » impossible';
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
$string['source_selfallocation_notification_allocation_subject'] = 'Notification d\'attribution du programme';
$string['source_selfallocation_notification_allocation_body'] = 'Bonjour {$a->user_fullname},

vous vous êtes inscrit(e) au programme « {$a->program_fullname} ». La date de début est fixée au {$a->program_startdate}.
';
$string['source_selfallocation_signupallowed'] = 'Inscriptions autorisées';
$string['source_selfallocation_signupnotallowed'] = 'Inscriptions non autorisées';
$string['set'] = 'Ensemble de cours';
$string['settings'] = 'Paramètres du programme';
$string['scheduling'] = 'Planification';
$string['taballocation'] = 'Réglages des attributions';
$string['tabcontent'] = 'Contenu';
$string['tabgeneral'] = 'Général';
$string['tabusers'] = 'Utilisateurs';
$string['tabvisibility'] = 'Paramètres de visibilité';
$string['tagarea_program'] = 'Programmes';
$string['taskcertificate'] = 'Certificat des programmes qui émettent une tâche Cron';
$string['taskcron'] = 'Tâche Cron du plug-in Programmes';
$string['unlinkeditems'] = 'Éléments dissociés';
$string['updateprogram'] = 'Mettre à jour le programme';
$string['updateallocation'] = 'Mettre à jour l\'attribution';
$string['updateallocations'] = 'Mettre à jour les attributions';
$string['updateset'] = 'Mettre à jour l\'ensemble';
$string['updatescheduling'] = 'Mettre à jour la planification';
$string['updatesource'] = 'Mettre à jour {$a}';
