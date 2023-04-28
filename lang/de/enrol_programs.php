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

$string['addprogram'] = 'Programm hinzufügen';
$string['addset'] = 'Neuen Satz hinzufügen';
$string['allocationend'] = 'Zuordnungsende';
$string['allocationend_help'] = 'Die Bedeutung des Enddatums der Zuordnung hängt von den aktivierten Zuordnungsquellen ab. In der Regel ist eine Neuordnung nach diesem Datum nicht mehr möglich, falls angegeben.';
$string['allocation'] = 'Zuordnung';
$string['allocations'] = 'Zuordnungen';
$string['programallocations'] = 'Programmzuordnungen';
$string['allocationdate'] = 'Zuordnungsdatum';
$string['allocationsources'] = 'Zuordnungsquellen';
$string['allocationstart'] = 'Zuordnungsbeginn';
$string['allocationstart_help'] = 'Die Bedeutung des Startdatums der Zuordnung hängt von den aktivierten Zuordnungsquellen ab. In der Regel ist eine Neuordnung nur nach diesem Datum möglich, falls angegeben.';
$string['allprograms'] = 'Alle Programme';
$string['appenditem'] = 'Element anhängen';
$string['appendinto'] = 'An Element anhängen';
$string['archived'] = 'Archiviert';
$string['catalogue'] = 'Programmkatalog';
$string['catalogue_dofilter'] = 'Suche';
$string['catalogue_resetfilter'] = 'Löschen';
$string['catalogue_searchtext'] = 'Suchtext';
$string['catalogue_tag'] = 'Nach Schlagwort filtern';
$string['certificatetemplatechoose'] = 'Vorlage auswählen...';
$string['cohorts'] = 'Für Gruppen sichtbar';
$string['cohorts_help'] = 'Nicht öffentliche Programme können für bestimmte Gruppenmitglieder sichtbar gemacht werden.

Der Sichtbarkeitsstatus wirkt sich nicht auf bereits zugeordnete Programme aus.';
$string['completiondate'] = 'Datum des Abschlusses';
$string['creategroups'] = 'Kursgruppen';
$string['creategroups_help'] = 'Wenn diese Option aktiviert ist, wird in jedem Kurs, der dem Programm hinzugefügt wird, eine Gruppe erstellt, und alle zugeordneten Nutzer/innen werden als Gruppenmitglieder hinzugefügt.';
$string['deleteallocation'] = 'Programmzuordnung löschen';
$string['deletecourse'] = 'Kurs entfernen';
$string['deleteprogram'] = 'Programm löschen';
$string['deleteset'] = 'Satz löschen';
$string['documentation'] = 'Programme für Moodle-Dokumentation';
$string['duedate'] = 'Fälligkeitsdatum';
$string['enrolrole'] = 'Kurs-Rolle';
$string['enrolrole_desc'] = 'Wählen Sie eine Rolle aus, die von Programmen für die Kursanmeldung verwendet wird';
$string['errorcontentproblem'] = 'Problem in der Programminhaltsstruktur erkannt, Programmabschluss wird nicht korrekt nachverfolgt!';
$string['errordifferenttenant'] = 'Auf das Programm eines anderen Mandanten kann nicht zugegriffen werden';
$string['errornoallocations'] = 'Keine Nutzer/innen-Zuordnungen gefunden';
$string['errornoallocation'] = 'Programm ist nicht zugeordnet';
$string['errornomyprograms'] = 'Sie sind keinen Programmen zugeordnet.';
$string['errornoprograms'] = 'Keine Programme gefunden.';
$string['errornorequests'] = 'Keine Programmanforderungen gefunden';
$string['errornotenabled'] = 'Programm-Plugin ist nicht aktiviert';
$string['event_program_completed'] = 'Programm abgeschlossen';
$string['event_program_created'] = 'Programm erstellt';
$string['event_program_deleted'] = 'Programm gelöscht';
$string['event_program_updated'] = 'Programm aktualisiert';
$string['event_program_viewed'] = 'Programm angezeigt';
$string['event_user_allocated'] = 'Dem Programm zugeordnete/r Nutzer/in';
$string['event_user_deallocated'] = 'Nutzer/in hat Zuordnung von Programm aufgehoben';
$string['evidence'] = 'Andere Hinweise';
$string['evidence_details'] = 'Details';
$string['fixeddate'] = 'Zu einem bestimmten Datum';
$string['item'] = 'Aspekt';
$string['itemcompletion'] = 'Abschluss des Programmelements';
$string['management'] = 'Programmverwaltung';
$string['messageprovider:allocation_notification'] = 'Benachrichtigung über Programmzuordnung';
$string['messageprovider:approval_request_notification'] = 'Benachrichtigung zur Anforderung einer Programmgenehmigung';
$string['messageprovider:approval_reject_notification'] = 'Benachrichtigung über Ablehnung der Programmanforderung';
$string['messageprovider:completion_notification'] = 'Benachrichtigung zum Programmabschluss';
$string['messageprovider:deallocation_notification'] = 'Benachrichtigung über die Aufhebung der Programmzuordnung';
$string['messageprovider:duesoon_notification'] = 'Benachrichtigung über das bald bevorstehende Fälligkeitsdatum des Programms';
$string['messageprovider:due_notification'] = 'Benachrichtigung über überfällige Programme';
$string['messageprovider:endsoon_notification'] = 'Benachrichtigung über das bald bevorstehende Enddatum des Programms';
$string['messageprovider:endcompleted_notification'] = 'Benachrichtigung zum erfolgreichen Abschluss eines beendeten Programms';
$string['messageprovider:endfailed_notification'] = 'Benachrichtigung zum fehlgeschlagenen Abschluss eines beendeten Programms';
$string['messageprovider:start_notification'] = 'Benachrichtigung über Programmstart';
$string['moveitem'] = 'Element verschieben';
$string['moveitemcancel'] = 'Verschieben abbrechen';
$string['moveafter'] = '"{$a->item}" verschieben nach "{$a->target}"';
$string['movebefore'] = '"{$a->item}" verschieben vor "{$a->target}"';
$string['moveinto'] = '"{$a->item}" verschieben nach "{$a->target}"';
$string['myprograms'] = 'Meine Programme';
$string['notification_allocation'] = 'Nutzer/in zugeordnet';
$string['notification_completion'] = 'Programm abgeschlossen';
$string['notification_completion_subject'] = 'Programm abgeschlossen';
$string['notification_completion_body'] = 'Hallo {$a->user_fullname},

Sie haben das Programm "{$a->program_fullname}" abgeschlossen.
';
$string['notification_deallocation'] = 'Zuordnung durch Nutzer/in rückgängig gemacht';
$string['notification_duesoon'] = 'Programm bald fällig';
$string['notification_duesoon_subject'] = 'Programm sollte bald abgeschlossen werden';
$string['notification_duesoon_body'] = 'Hallo {$a->user_fullname},

der Abschluss des Programms "{$a->program_fullname}" ist vorgesehen bis zum {$a->program_duedate}.
';
$string['notification_due'] = 'Programm überfällig';
$string['notification_due_subject'] = 'Programm hätte abgeschlossen werden müssen';
$string['notification_due_body'] = 'Hallo {$a->user_fullname},

der Abschluss des Programms "{$a->program_fullname}" vor dem {$a->program_duedate} wurde erwartet.
';
$string['notification_endsoon'] = 'Enddatum des Programms steht bevor';
$string['notification_endsoon_subject'] = 'Programm endet bald';
$string['notification_endsoon_body'] = 'Hallo {$a->user_fullname},

das Programm "{$a->program_fullname}" endet am {$a->program_enddate}.
';
$string['notification_endcompleted'] = 'Abgeschlossenes Programm beendet';
$string['notification_endcompleted_subject'] = 'Abgeschlossenes Programm beendet';
$string['notification_endcompleted_body'] = 'Hallo {$a->user_fullname},

das Programm "{$a->program_fullname}" ist beendet, Sie haben es bereits abgeschlossen.
';
$string['notification_endfailed'] = 'Fehlgeschlagener Abschluss eines beendeten Programms';
$string['notification_endfailed_subject'] = 'Fehlgeschlagener Abschluss eines beendeten Programms';
$string['notification_endfailed_body'] = 'Hallo {$a->user_fullname},

das Programm "{$a->program_fullname}" ist beendet, Sie haben es nicht abgeschlossen.
';
$string['notification_start'] = 'Programm gestartet';
$string['notification_start_subject'] = 'Programm gestartet';
$string['notification_start_body'] = 'Hallo {$a->user_fullname},

das Programm "{$a->program_fullname}" wurde gestartet.
';
$string['notificationdates'] = 'Benachrichtigungsdaten';
$string['notset'] = 'Nicht festgelegt';
$string['plugindisabled'] = 'Programmregistrierungs-Plugin ist deaktiviert, Programme sind nicht funktionsfähig.

[Enable plugin now]({$a->url})';
$string['pluginname'] = 'Programme';
$string['pluginname_desc'] = 'Programme sind so konzipiert, dass sie die Erstellung von Kursgruppen ermöglichen.';
$string['privacy:metadata:field:programid'] = 'Programm-ID';
$string['privacy:metadata:field:userid'] = 'Nutzer/innen-ID';
$string['privacy:metadata:field:allocationid'] = 'Programmzuordnungs-ID';
$string['privacy:metadata:field:sourceid'] = 'Quelle der Zuordnung';
$string['privacy:metadata:field:itemid'] = 'Aspekt-ID';
$string['privacy:metadata:field:timecreated'] = 'Erstellungsdatum';
$string['privacy:metadata:field:timecompleted'] = 'Datum des Abschlusses';

$string['privacy:metadata:table:enrol_programs_allocations'] = 'Informationen zu Programmzuordnungen';
$string['privacy:metadata:field:archived'] = 'Wird der Datensatz archiviert';
$string['privacy:metadata:field:sourcedatajson'] = 'Informationen zur Quelle der Zuordnung';
$string['privacy:metadata:field:timeallocated'] = 'Datum der Programmzuordnung';
$string['privacy:metadata:field:timestart'] = 'Startdatum';
$string['privacy:metadata:field:timedue'] = 'Fälligkeitsdatum';
$string['privacy:metadata:field:timeend'] = 'Enddatum';

$string['privacy:metadata:table:enrol_programs_certs_issues'] = 'Probleme mit Programmzuordnungszertifikat';
$string['privacy:metadata:field:issueid'] = 'Problem-ID';

$string['privacy:metadata:table:enrol_programs_completions'] = 'Programmzuordnungen abgeschlossen';

$string['privacy:metadata:table:enrol_programs_evidences'] = 'Informationen über sonstige Nachweise für den Abschluss';
$string['privacy:metadata:field:evidencejson'] = 'Informationen über Abschlussnachweise';
$string['privacy:metadata:field:createdby'] = 'Nachweis erstellt durch';

$string['privacy:metadata:table:enrol_programs_requests'] = 'Informationen zur Zuordnungsanforderung';
$string['privacy:metadata:field:datajson'] = 'Informationen zur Anforderung';
$string['privacy:metadata:field:timerequested'] = 'Anforderungsdatum';
$string['privacy:metadata:field:timerejected'] = 'Ablehnungsdatum';
$string['privacy:metadata:field:rejectedby'] = 'Anforderung abgelehnt von';


$string['privacy:metadata:table:enrol_programs_usr_snapshots'] = 'Programmzuordnungs-Snapshots';
$string['privacy:metadata:field:reason'] = 'Grund';
$string['privacy:metadata:field:timesnapshot'] = 'Snapshot-Datum';
$string['privacy:metadata:field:snapshotby'] = 'Snapshot von';
$string['privacy:metadata:field:explanation'] = 'Erläuterung';
$string['privacy:metadata:field:completionsjson'] = 'Informationen zum Abschluss';
$string['privacy:metadata:field:evidencesjson'] = 'Informationen über Abschlussnachweise';

$string['program'] = 'Programm';
$string['programautofix'] = 'Auto-Reparaturprogramm';
$string['programdue'] = 'Programm fällig';
$string['programdue_help'] = 'Das Fälligkeitsdatum des Programms gibt an, wann Nutzer/innen das Programm abschließen müssen.';
$string['programdue_delay'] = 'Fällig nach Start';
$string['programdue_date'] = 'Fälligkeitsdatum';
$string['programend'] = 'Programmende';
$string['programend_help'] = 'Nutzer/innen können nach Programmende keine Programmkurse mehr aufrufen';
$string['programend_delay'] = 'Ende nach Start';
$string['programend_date'] = 'Enddatum des Programms';
$string['programcompletion'] = 'Datum des Programmabschlusses';
$string['programidnumber'] = 'Programm-ID-Nummer';
$string['programimage'] = 'Programmbild';
$string['programname'] = 'Programmname';
$string['programurl'] = 'Programm-URL';
$string['programs'] = 'Programme';
$string['programsactive'] = 'Aktiv';
$string['programsarchived'] = 'Archiviert';
$string['programsarchived_help'] = 'Archivierte Programme werden für die Nutzer/innen ausgeblendet und ihr Fortschritt wird gesperrt.';
$string['programstart'] = 'Programmstart';
$string['programstart_help'] = 'Nutzer/innen können vor dem Programmstart keine Programmkurse aufrufen.';
$string['programstart_allocation'] = 'Sofort nach Zuordnung starten';
$string['programstart_delay'] = 'Verzögerter Start nach Zuordnung';
$string['programstart_date'] = 'Startdatum des Programms';
$string['programstatus'] = 'Programmstatus';
$string['programstatus_completed'] = 'Abgeschlossen';
$string['programstatus_any'] = 'Beliebiger Programmstatus';
$string['programstatus_archived'] = 'Archiviert';
$string['programstatus_archivedcompleted'] = 'Archivierung abgeschlossen';
$string['programstatus_overdue'] = 'Überfällig';
$string['programstatus_open'] = 'Öffnen';
$string['programstatus_future'] = 'Noch nicht geöffnet';
$string['programstatus_failed'] = 'Fehlgeschlagen';
$string['programs:addcourse'] = 'Kurs zu Programmen hinzufügen';
$string['programs:allocate'] = 'Kursteilnehmer/innen Programmen zuordnen';
$string['programs:delete'] = 'Programme löschen';
$string['programs:edit'] = 'Hinzufügen und Aktualisieren von Programmen';
$string['programs:admin'] = 'Erweiterte Programmverwaltung';
$string['programs:manageevidence'] = 'Andere Abschlussnachweise verwalten';
$string['programs:view'] = 'Programmverwaltung anzeigen';
$string['programs:viewcatalogue'] = 'Auf Programmkatalog zugreifen';
$string['public'] = 'Öffentlich';
$string['public_help'] = 'Öffentliche Programme sind für alle Nutzer/innen sichtbar.

Der Sichtbarkeitsstatus wirkt sich nicht auf bereits zugeordnete Programme aus.';
$string['sequencetype'] = 'Fertigstellungstyp';
$string['sequencetype_allinorder'] = 'Alles nach Reihenfolge';
$string['sequencetype_allinanyorder'] = 'Alles in beliebiger Reihenfolge';
$string['sequencetype_atleast'] = 'Mindestens {$a->min}';
$string['selectcategory'] = 'Wählen Sie eine Kategorie';
$string['source'] = 'Quelle';
$string['source_approval'] = 'Anforderungen mit Genehmigung';
$string['source_approval_allownew'] = 'Genehmigungen zulassen';
$string['source_approval_allownew_desc'] = 'Hinzufügen neuer Quellen für _Anforderungen mit Genehmigung_ zu Programmen zulassen';
$string['source_approval_allowrequest'] = 'Neue Anforderungen erlauben';
$string['source_approval_confirm'] = 'Bestätigen Sie, dass Sie die Zuordnung zum Programm anfordern möchten.';
$string['source_approval_daterequested'] = 'Angefragte Daten';
$string['source_approval_daterejected'] = 'Datum der Ablehnung';
$string['source_approval_makerequest'] = 'Zugang anfordern';
$string['source_approval_notification_allocation_subject'] = 'Benachrichtigung über die Programmgenehmigung';
$string['source_approval_notification_allocation_body'] = 'Hallo {$a->user_fullname},

Ihre Anmeldung für das Programm "{$a->program_fullname}" wurde genehmigt. Das Startdatum ist der {$a->program_startdate}.
';
$string['source_approval_notification_approval_request_subject'] = 'Benachrichtigung über Programmanforderung';
$string['source_approval_notification_approval_request_body'] = '
Nutzer {$a->user_fullname} hat Zugriff auf das Programm "{$a->program_fullname}" angefordert.
';
$string['source_approval_notification_approval_reject_subject'] = 'Benachrichtigung über Ablehnung der Programmanforderung';
$string['source_approval_notification_approval_reject_body'] = 'Hallo {$a->user_fullname},

Ihre Anforderung des Zugriffs auf das Programm "{$a->program_fullname}" wurde abgelehnt.

{$a->reason}
';
$string['source_approval_requestallowed'] = 'Anforderungen sind zulässig';
$string['source_approval_requestnotallowed'] = 'Anforderungen sind nicht zulässig';
$string['source_approval_requests'] = 'Anfragen';
$string['source_approval_requestpending'] = 'Zugriffsanforderung ausstehend';
$string['source_approval_requestrejected'] = 'Zugriffsanforderung wurde abgelehnt';
$string['source_approval_requestapprove'] = 'Anfrage genehmigen';
$string['source_approval_requestreject'] = 'Anforderung ablehnen';
$string['source_approval_requestdelete'] = 'Anforderung löschen';
$string['source_approval_rejectionreason'] = 'Ablehnungsgrund';
$string['notification_allocation_subject'] = 'Benachrichtigung über Programmzuordnung';
$string['notification_allocation_body'] = 'Hallo {$a->user_fullname},

Sie wurden dem Programm "{$a->program_fullname}" zugeordnet. Das Startdatum ist der {$a->program_startdate}.
';
$string['notification_deallocation_subject'] = 'Benachrichtigung über die Aufhebung der Programmzuordnung';
$string['notification_deallocation_body'] = 'Hallo {$a->user_fullname},

Ihre Zuordnung zum Programm "{$a->program_fullname}" wurde aufgehoben.
';
$string['source_cohort'] = 'Automatische Gruppenzuordnung';
$string['source_cohort_allownew'] = 'Gruppenzuordnung zulassen';
$string['source_cohort_allownew_desc'] = 'Hinzufügen neuer Quellen für die _automatische Gruppenzuordnung_ zu Programmen zulassen';
$string['source_manual'] = 'Manuelle Zuordnung';
$string['source_manual_allocateusers'] = 'Nutzer/innen zuordnen';
$string['source_manual_csvfile'] = 'CSV-Datei';
$string['source_manual_hasheaders'] = 'Erste Zeile ist Kopfzeile';
$string['source_manual_potusersmatching'] = 'Übereinstimmende Zuordnungskandidaten';
$string['source_manual_potusers'] = 'Zuordnungskandidaten';
$string['source_manual_result_assigned'] = '{$a} Nutzer/innen wurden dem Programm zugeordnet.';
$string['source_manual_result_errors'] = '{$a} Fehler bei der Programmzuordnung erkannt.';
$string['source_manual_result_skipped'] = '{$a} Nutzer/innen wurden dem Programm bereits zugeordnet.';
$string['source_manual_uploadusers'] = 'Zuordnungen hochladen';
$string['source_manual_usercolumn'] = 'Nutzer/innen-Identifikations-Spalte';
$string['source_manual_usermapping'] = 'Nutzer/innen-Zuordnung über';
$string['source_manual_userupload_allocated'] = 'Zugeordnet zu \'\'{$a}\'\'';
$string['source_manual_userupload_alreadyallocated'] = 'Bereits zugeordnet zu \'\'{$a}\'\'';
$string['source_manual_userupload_invalidprogram'] = 'Zuordnung nicht möglich zu \'\'{$a}\'\'';
$string['source_selfallocation'] = 'Selbstzuordnung';
$string['source_selfallocation_allocate'] = 'Anmeldung';
$string['source_selfallocation_allownew'] = 'Selbstzuordnung zulassen';
$string['source_selfallocation_allownew_desc'] = 'Hinzufügen neuer Quellen für die _Selbstzuordnung_ zu Programmen zulassen';
$string['source_selfallocation_allowsignup'] = 'Neue Anmeldungen zulassen';
$string['source_selfallocation_confirm'] = 'Bestätigen Sie, dass Sie dem Programm zugeordnet werden möchten.';
$string['source_selfallocation_enable'] = 'Selbstzuordnung aktivieren';
$string['source_selfallocation_key'] = 'Anmeldeschlüssel';
$string['source_selfallocation_keyrequired'] = 'Anmeldeschlüssel ist erforderlich';
$string['source_selfallocation_maxusers'] = 'Maximale Nutzer/innen-Zahl';
$string['source_selfallocation_maxusersreached'] = 'Maximale Anzahl an Nutzer/innen, die sich bereits selbst zugeordnet haben';
$string['source_selfallocation_maxusers_status'] = 'Nutzer/innen {$a->count}/{$a->max}';
$string['source_selfallocation_notification_allocation_subject'] = 'Benachrichtigung über Programmzuordnung';
$string['source_selfallocation_notification_allocation_body'] = 'Hallo {$a->user_fullname},

Sie haben sich für das Programm "{$a->program_fullname}" angemeldet. Das Startdatum ist der {$a->program_startdate}.
';
$string['source_selfallocation_signupallowed'] = 'Anmeldungen sind zulässig';
$string['source_selfallocation_signupnotallowed'] = 'Anmeldungen sind nicht zulässig';
$string['set'] = 'Kursset';
$string['settings'] = 'Programmeinstellungen';
$string['scheduling'] = 'Zeitplanung';
$string['taballocation'] = 'Einstellungen \'Zuordnungen\'';
$string['tabcontent'] = 'Inhalt';
$string['tabgeneral'] = 'Allgemein';
$string['tabusers'] = 'Nutzer/innen';
$string['tabvisibility'] = 'Sichtbarkeitseinstellungen';
$string['tagarea_program'] = 'Programme';
$string['taskcertificate'] = 'Programm-Zertifikat stellt Cron aus';
$string['taskcron'] = 'Programm-Plugin Cron';
$string['unlinkeditems'] = 'Nicht verknüpfte Elemente';
$string['updateprogram'] = 'Programm aktualisieren';
$string['updateallocation'] = 'Zuordnung aktualisieren';
$string['updateallocations'] = 'Zuordnungen aktualisieren';
$string['updateset'] = 'Satz aktualisieren';
$string['updatescheduling'] = 'Planung aktualisieren';
$string['updatesource'] = '{$a} aktualisieren';
