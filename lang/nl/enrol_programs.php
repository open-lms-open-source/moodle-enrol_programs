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

$string['addprogram'] = 'Programma toevoegen';
$string['addset'] = 'Nieuwe set toevoegen';
$string['allocationend'] = 'Einde toekenning';
$string['allocationend_help'] = 'Wat de einddatum van toekenningen inhoudt, is afhankelijk van ingeschakelde toekenningsbronnen. Gewoonlijk zijn nieuwe toekenningen, indien gespecificeerd, na deze datum niet mogelijk.';
$string['allocation'] = 'Toekenning';
$string['allocations'] = 'Toekenningen';
$string['programallocations'] = 'Programmatoekenningen';
$string['allocationdate'] = 'Toekenningsdatum';
$string['allocationsources'] = 'Toekenningsbronnen';
$string['allocationstart'] = 'Start toekenning';
$string['allocationstart_help'] = 'Wat de begindatum van toekenningen inhoudt, is afhankelijk van ingeschakelde toekenningsbronnen. Gewoonlijk zijn nieuwe toekenningen, indien gespecificeerd, alleen mogelijk na deze datum.';
$string['allprograms'] = 'Alle programma\'s';
$string['appenditem'] = 'Nieuw item toevoegen';
$string['appendinto'] = 'In item toevoegen';
$string['archived'] = 'Gearchiveerd';
$string['catalogue'] = 'Programmacatalogus';
$string['catalogue_dofilter'] = 'Zoeken';
$string['catalogue_resetfilter'] = 'Wissen';
$string['catalogue_searchtext'] = 'Tekst zoeken';
$string['catalogue_tag'] = 'Filteren op basis van tag';
$string['certificatetemplatechoose'] = 'Een sjabloon kiezen...';
$string['cohorts'] = 'Zichtbaar voor sitegroepen';
$string['cohorts_help'] = 'Niet-openbare programma\'s kunnen zichtbaar worden gemaakt voor bepaalde sitegroepleden.

De zichtbaarheidsstatus heeft geen invloed op reeds toegekende programma\'s.';
$string['completiondate'] = 'Voltooiingsdatum';
$string['creategroups'] = 'Cursusgroepen';
$string['creategroups_help'] = 'Als deze optie is ingeschakeld, wordt een groep gemaakt in elke cursus die aan het programma is toegevoegd en worden alle toegekende gebruikers als groepsleden toegevoegd.';
$string['deleteallocation'] = 'Programmatoekenning verwijderen';
$string['deletecourse'] = 'Cursus verwijderen';
$string['deleteprogram'] = 'Programma verwijderen';
$string['deleteset'] = 'Set verwijderen';
$string['documentation'] = 'Programma\'s voor Moodle-documentatie';
$string['duedate'] = 'Deadline';
$string['enrolrole'] = 'Cursusrol';
$string['enrolrole_desc'] = 'Selecteer de rol die wordt gebruikt door programma\'s voor cursusinschrijving';
$string['errorcontentproblem'] = 'Probleem gedetecteerd in de structuur van de programma-inhoud, de voltooiing van het programma wordt niet correct gevolgd!';
$string['errordifferenttenant'] = 'Programma van een andere tenant kan niet worden geopend';
$string['errornoallocations'] = 'Geen gebruikerstoekenningen gevonden';
$string['errornoallocation'] = 'Programma is niet toegekend';
$string['errornomyprograms'] = 'U bent aan geen enkel programma toegekend.';
$string['errornoprograms'] = 'Geen programma\'s gevonden.';
$string['errornorequests'] = 'Geen programma-aanvragen gevonden';
$string['errornotenabled'] = 'Programmaplugin is niet ingeschakeld';
$string['event_program_completed'] = 'Programma voltooid';
$string['event_program_created'] = 'Programma aangemaakt';
$string['event_program_deleted'] = 'Programma verwijderd';
$string['event_program_updated'] = 'Programma bijgewerkt';
$string['event_program_viewed'] = 'Programma bekeken';
$string['event_user_allocated'] = 'Gebruiker toegekend aan programma';
$string['event_user_deallocated'] = 'Gebruiker uitgeschreven uit programma';
$string['evidence'] = 'Ander bewijs';
$string['evidence_details'] = 'Details';
$string['fixeddate'] = 'Op een vaste datum';
$string['item'] = 'Item';
$string['itemcompletion'] = 'Voltooiing programma-item';
$string['management'] = 'Programmabeheer';
$string['messageprovider:allocation_notification'] = 'Melding programmatoekenning';
$string['messageprovider:approval_request_notification'] = 'Melding aanvraag goedkeuring programma';
$string['messageprovider:approval_reject_notification'] = 'Melding weigering aanvraag programma';
$string['messageprovider:completion_notification'] = 'Melding voltooiing programma';
$string['messageprovider:deallocation_notification'] = 'Melding uitschrijving programma';
$string['messageprovider:duesoon_notification'] = 'Melding binnenkort deadline programma';
$string['messageprovider:due_notification'] = 'Melding programma te laat';
$string['messageprovider:endsoon_notification'] = 'Melding binnenkort einddatum programma';
$string['messageprovider:endcompleted_notification'] = 'Melding beëindiging voltooid programma';
$string['messageprovider:endfailed_notification'] = 'Melding beëindiging mislukt programma';
$string['messageprovider:start_notification'] = 'Melding gestart programma';
$string['moveitem'] = 'Item verplaatsen';
$string['moveitemcancel'] = 'Verplaatsing annuleren';
$string['moveafter'] = '"{$a->item}" verplaatsen na "{$a->target}"';
$string['movebefore'] = '"{$a->item}" verplaatsen vóór "{$a->target}"';
$string['moveinto'] = '"{$a->item}" verplaatsen naar "{$a->target}"';
$string['myprograms'] = 'Mijn programma\'s';
$string['notification_allocation'] = 'Gebruiker toegekend';
$string['notification_completion'] = 'Programma voltooid';
$string['notification_completion_subject'] = 'Programma voltooid';
$string['notification_completion_body'] = 'Hallo {$a->user_fullname},

u hebt het programma "{$a->program_fullname}" voltooid.
';
$string['notification_deallocation'] = 'Gebruiker uitgeschreven';
$string['notification_duesoon'] = 'Binnenkort deadline programma';
$string['notification_duesoon_subject'] = 'Voltooiing van het programma wordt binnenkort verwacht';
$string['notification_duesoon_body'] = 'Hallo {$a->user_fullname},

Voltooiing van het programma {$a->program_fullname} wordt verwacht op {$a->program_duedate}.
';
$string['notification_due'] = 'Programma te laat';
$string['notification_due_subject'] = 'Voltooiing van het programma werd verwacht';
$string['notification_due_body'] = 'Hallo {$a->user_fullname},

Voltooiing van het programma {$a->program_fullname} werd verwacht vóór {$a->program_duedate}.
';
$string['notification_endsoon'] = 'Binnenkort einddatum programma';
$string['notification_endsoon_subject'] = 'Programma eindigt binnenkort';
$string['notification_endsoon_body'] = 'Hallo {$a->user_fullname},

Programma {$a->program_fullname} eindigt op {$a->program_enddate}.
';
$string['notification_endcompleted'] = 'Voltooid programma beëindigd';
$string['notification_endcompleted_subject'] = 'Voltooid programma beëindigd';
$string['notification_endcompleted_body'] = 'Hallo {$a->user_fullname},

Programma {$a->program_fullname} is beëindigd, u hebt het eerder voltooid.
';
$string['notification_endfailed'] = 'Mislukt programma beëindigd';
$string['notification_endfailed_subject'] = 'Mislukt programma beëindigd';
$string['notification_endfailed_body'] = 'Hallo {$a->user_fullname},

Programma {$a->program_fullname} is beëindigd, u hebt het niet voltooid.
';
$string['notification_start'] = 'Programma gestart';
$string['notification_start_subject'] = 'Programma gestart';
$string['notification_start_body'] = 'Hallo {$a->user_fullname},

Programma {$a->program_fullname} is gestart.
';
$string['notificationdates'] = 'Meldingsdatums';
$string['notset'] = 'Niet ingesteld';
$string['plugindisabled'] = 'De plugin van de programma-inschrijving is uitgeschakeld, programma\'s zullen niet functioneel zijn.

[Enable plugin now]({$a->url})';
$string['pluginname'] = 'Programma\'s';
$string['pluginname_desc'] = 'Programma\'s zijn ontworpen om het maken van cursussets mogelijk te maken.';
$string['privacy:metadata:field:programid'] = 'Programma-ID';
$string['privacy:metadata:field:userid'] = 'Gebruikers-ID';
$string['privacy:metadata:field:allocationid'] = 'ID programmatoekenning';
$string['privacy:metadata:field:sourceid'] = 'Bron van toekenning';
$string['privacy:metadata:field:itemid'] = 'Item-ID';
$string['privacy:metadata:field:timecreated'] = 'Aanmaakdatum';
$string['privacy:metadata:field:timecompleted'] = 'Voltooiingsdatum';

$string['privacy:metadata:table:enrol_programs_allocations'] = 'Informatie over programmatoekenningen';
$string['privacy:metadata:field:archived'] = 'Is de record gearchiveerd';
$string['privacy:metadata:field:sourcedatajson'] = 'Informatie over de bron van de toekenning';
$string['privacy:metadata:field:timeallocated'] = 'Datum programmatoekenning';
$string['privacy:metadata:field:timestart'] = 'Begindatum';
$string['privacy:metadata:field:timedue'] = 'Deadline';
$string['privacy:metadata:field:timeend'] = 'Einddatum';

$string['privacy:metadata:table:enrol_programs_certs_issues'] = 'Problemen met certificaten voor programmatoekenningen';
$string['privacy:metadata:field:issueid'] = 'Probleem-ID';

$string['privacy:metadata:table:enrol_programs_completions'] = 'Voltooiingen programmatoekenning';

$string['privacy:metadata:table:enrol_programs_evidences'] = 'Informatie over andere bewijzen van voltooiing';
$string['privacy:metadata:field:evidencejson'] = 'Informatie over bewijs van voltooiing';
$string['privacy:metadata:field:createdby'] = 'Bewijs gemaakt door';

$string['privacy:metadata:table:enrol_programs_requests'] = 'Informatie over toekenningsaanvraag';
$string['privacy:metadata:field:datajson'] = 'Informatie over de aanvraag';
$string['privacy:metadata:field:timerequested'] = 'Aanvraagdatum';
$string['privacy:metadata:field:timerejected'] = 'Afwijzingsdatum';
$string['privacy:metadata:field:rejectedby'] = 'Aanvraag afgewezen door';


$string['privacy:metadata:table:enrol_programs_usr_snapshots'] = 'Snapshots programmatoekenning';
$string['privacy:metadata:field:reason'] = 'Reden';
$string['privacy:metadata:field:timesnapshot'] = 'Snapshotdatum';
$string['privacy:metadata:field:snapshotby'] = 'Snapshot door';
$string['privacy:metadata:field:explanation'] = 'Verklaring';
$string['privacy:metadata:field:completionsjson'] = 'Informatie over voltooiing';
$string['privacy:metadata:field:evidencesjson'] = 'Informatie over bewijs van voltooiing';

$string['program'] = 'Programma';
$string['programautofix'] = 'Autom. reparatieprogramma';
$string['programdue'] = 'Programma-deadline';
$string['programdue_help'] = 'De programma-deadline geeft aan wanneer gebruikers het programma moeten voltooien.';
$string['programdue_delay'] = 'Deadline na start';
$string['programdue_date'] = 'Deadline';
$string['programend'] = 'Programma-einde';
$string['programend_help'] = 'Gebruikers kunnen na afloop van het programma geen programmacursussen meer openen.';
$string['programend_delay'] = 'Einde na start';
$string['programend_date'] = 'Einddatum programma';
$string['programcompletion'] = 'Voltooiingsdatum programma';
$string['programidnumber'] = 'Programma-ID-nummer';
$string['programimage'] = 'Programma-afbeelding';
$string['programname'] = 'Programmanaam';
$string['programurl'] = 'Programma-URL';
$string['programs'] = 'Programma\'s';
$string['programsactive'] = 'Actief';
$string['programsarchived'] = 'Gearchiveerd';
$string['programsarchived_help'] = 'Gearchiveerde programma\'s zijn verborgen voor gebruikers en hun voortgang is vergrendeld.';
$string['programstart'] = 'Start programma';
$string['programstart_help'] = 'Gebruikers kunnen geen programmacursussen openen voordat het programma start.';
$string['programstart_allocation'] = 'Onmiddellijk starten na toekenning';
$string['programstart_delay'] = 'Start vertragen na toekenning';
$string['programstart_date'] = 'Begindatum programma';
$string['programstatus'] = 'Programmastatus';
$string['programstatus_completed'] = 'Voltooid';
$string['programstatus_any'] = 'Elke programmastatus';
$string['programstatus_archived'] = 'Gearchiveerd';
$string['programstatus_archivedcompleted'] = 'Gearchiveerd voltooid';
$string['programstatus_overdue'] = 'Te laat';
$string['programstatus_open'] = 'Open';
$string['programstatus_future'] = 'Nog niet open';
$string['programstatus_failed'] = 'Mislukt';
$string['programs:addcourse'] = 'Cursus toevoegen aan programma\'s';
$string['programs:allocate'] = 'Studenten toekennen aan programma\'s';
$string['programs:delete'] = 'Programma\'s verwijderen';
$string['programs:edit'] = 'Programma\'s toevoegen en bijwerken';
$string['programs:admin'] = 'Geavanceerd programmabeheer';
$string['programs:manageevidence'] = 'Ander bewijs van voltooiing beheren';
$string['programs:view'] = 'Programmabeheer weergeven';
$string['programs:viewcatalogue'] = 'Programmacatalogus openen';
$string['public'] = 'Openbaar';
$string['public_help'] = 'Openbare programma\'s zijn zichtbaar voor alle gebruikers.

De zichtbaarheidsstatus heeft geen invloed op reeds toegekende programma\'s.';
$string['sequencetype'] = 'Voltooiingstype';
$string['sequencetype_allinorder'] = 'Alles op volgorde';
$string['sequencetype_allinanyorder'] = 'Alles in elke volgorde';
$string['sequencetype_atleast'] = 'Ten minste {$a->min}';
$string['selectcategory'] = 'Categorie selecteren';
$string['source'] = 'Bron';
$string['source_approval'] = 'Aanvragen met goedkeuring';
$string['source_approval_allownew'] = 'Goedkeuringen toestaan';
$string['source_approval_allownew_desc'] = 'Toevoegen van nieuwe bronnen van _aanvragen met goedkeuring_ aan programma\'s toestaan';
$string['source_approval_allowrequest'] = 'Nieuwe aanvragen toestaan';
$string['source_approval_confirm'] = 'Bevestig dat u toekenning aan het programma wilt aanvragen.';
$string['source_approval_daterequested'] = 'Datum van aanvraag';
$string['source_approval_daterejected'] = 'Datum afgewezen';
$string['source_approval_makerequest'] = 'Toegang aanvragen';
$string['source_approval_notification_allocation_subject'] = 'Melding goedkeuring programma';
$string['source_approval_notification_allocation_body'] = 'Hallo {$a->user_fullname},

Uw aanmelding voor programma {$a->program_fullname} is goedgekeurd, de begindatum is {$a->program_startdate}.
';
$string['source_approval_notification_approval_request_subject'] = 'Melding programma-aanvraag';
$string['source_approval_notification_approval_request_body'] = '
Gebruiker {$a->user_fullname} heeft toegang tot programma {$a->program_fullname} aangevraagd.
';
$string['source_approval_notification_approval_reject_subject'] = 'Melding weigering aanvraag programma';
$string['source_approval_notification_approval_reject_body'] = 'Hallo {$a->user_fullname},

Uw verzoek om toegang te krijgen tot het programma {$a->program_fullname} is afgewezen.

{$a->reason}
';
$string['source_approval_requestallowed'] = 'Aanvragen zijn toegestaan';
$string['source_approval_requestnotallowed'] = 'Aanvragen zijn niet toegestaan';
$string['source_approval_requests'] = 'Aanvragen';
$string['source_approval_requestpending'] = 'Toegangsaanvraag in behandeling';
$string['source_approval_requestrejected'] = 'Toegangsaanvraag is afgewezen';
$string['source_approval_requestapprove'] = 'Aanvraag goedkeuren';
$string['source_approval_requestreject'] = 'Aanvraag afwijzen';
$string['source_approval_requestdelete'] = 'Aanvraag verwijderen';
$string['source_approval_rejectionreason'] = 'Reden afwijzing';
$string['notification_allocation_subject'] = 'Melding programmatoekenning';
$string['notification_allocation_body'] = 'Hallo {$a->user_fullname},

U bent toegekend aan programma "{$a->program_fullname}", de begindatum is {$a->program_startdate}.
';
$string['notification_deallocation_subject'] = 'Melding uitschrijving programma';
$string['notification_deallocation_body'] = 'Hallo {$a->user_fullname},

U bent uitgeschreven uit programma "{$a->program_fullname}".
';
$string['source_cohort'] = 'Automatische sitegroeptoekenning';
$string['source_cohort_allownew'] = 'Sitegroeptoekenning toestaan';
$string['source_cohort_allownew_desc'] = 'Toevoegen van nieuwe bronnen van _automatische sitegroeptoekenning_ aan programma\'s toestaan';
$string['source_manual'] = 'Manueel toewijzen';
$string['source_manual_allocateusers'] = 'Gebruikers toekennen';
$string['source_manual_csvfile'] = 'CSV-bestand';
$string['source_manual_hasheaders'] = 'Eerste regel is koptekst';
$string['source_manual_potusersmatching'] = 'Overeenkomende toekenningskandidaten';
$string['source_manual_potusers'] = 'Toekenningskandidaten';
$string['source_manual_result_assigned'] = '{$a} gebruikers zijn toegewezen aan programma.';
$string['source_manual_result_errors'] = '{$a} fouten gedetecteerd bij toewijzing programma\'s.';
$string['source_manual_result_skipped'] = '{$a} gebruikers zijn al toegewezen aan programma.';
$string['source_manual_uploadusers'] = 'Toekenningen uploaden';
$string['source_manual_usercolumn'] = 'Kolom gebruikersidentificatie';
$string['source_manual_usermapping'] = 'Mapping van gebruikers via';
$string['source_manual_userupload_allocated'] = 'Toegekend aan \'{$a}\'';
$string['source_manual_userupload_alreadyallocated'] = 'Al toegekend aan \'{$a}\'';
$string['source_manual_userupload_invalidprogram'] = 'Kan niet toekennen aan \'{$a}\'';
$string['source_selfallocation'] = 'Zelftoekenning';
$string['source_selfallocation_allocate'] = 'Aanmelden';
$string['source_selfallocation_allownew'] = 'Zelftoekenning toestaan';
$string['source_selfallocation_allownew_desc'] = 'Toevoegen van nieuwe bronnen van _zelftoekenning_ aan programma\'s toestaan';
$string['source_selfallocation_allowsignup'] = 'Nieuwe aanmeldingen toestaan';
$string['source_selfallocation_confirm'] = 'Bevestig dat u wilt worden toegekend aan het programma.';
$string['source_selfallocation_enable'] = 'Zelftoekenning inschakelen';
$string['source_selfallocation_key'] = 'Aanmeldsleutel';
$string['source_selfallocation_keyrequired'] = 'Aanmeldsleutel is vereist';
$string['source_selfallocation_maxusers'] = 'Maximale aantal gebruikers';
$string['source_selfallocation_maxusersreached'] = 'Maximumaantal van zelftoegekende gebruikers is al bereikt';
$string['source_selfallocation_maxusers_status'] = 'Gebruikers {$a->count}/{$a->max}';
$string['source_selfallocation_notification_allocation_subject'] = 'Melding programmatoekenning';
$string['source_selfallocation_notification_allocation_body'] = 'Hallo {$a->user_fullname},

U hebt zich aangemeld voor programma "{$a->program_fullname}", de begindatum is {$a->program_startdate}.
';
$string['source_selfallocation_signupallowed'] = 'Aanmeldingen zijn toegestaan';
$string['source_selfallocation_signupnotallowed'] = 'Aanmeldingen zijn niet toegestaan';
$string['set'] = 'Cursusset';
$string['settings'] = 'Programma-instellingen';
$string['scheduling'] = 'Planning';
$string['taballocation'] = 'Toekenningsinstellingen';
$string['tabcontent'] = 'Inhoud';
$string['tabgeneral'] = 'Algemeen';
$string['tabusers'] = 'Gebruikers';
$string['tabvisibility'] = 'Zichtbaarheidsinstellingen';
$string['tagarea_program'] = 'Programma\'s';
$string['taskcertificate'] = 'Cron afgifte programmacertificaat';
$string['taskcron'] = 'Cron plugin programma\'s';
$string['unlinkeditems'] = 'Niet-gekoppelde items';
$string['updateprogram'] = 'Programma bijwerken';
$string['updateallocation'] = 'Toekenning bijwerken';
$string['updateallocations'] = 'Toekenningen bijwerken';
$string['updateset'] = 'Set bijwerken';
$string['updatescheduling'] = 'Planning bijwerken';
$string['updatesource'] = '{$a} bijwerken';
