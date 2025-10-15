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
$string['archive'] = 'Archiv';
$string['archived'] = 'Archiviert';
$string['benefitname'] = '{$a}: Programmzuordnung';
$string['calendarprogramend'] = '{$a} endet';
$string['calendarprogramdue'] = '{$a} ist fällig';
$string['calendarprogramstart'] = '{$a} beginnt';
$string['catalogue'] = 'Programmkatalog';
$string['catalogue_dofilter'] = 'Suche';
$string['catalogue_resetfilter'] = 'Löschen';
$string['catalogue_searchtext'] = 'Suchtext';
$string['catalogue_tag'] = 'Nach Schlagwort filtern';
$string['certificatetemplatechoose'] = 'Vorlage auswählen...';
$string['cohorts'] = 'Für Gruppen sichtbar';
$string['cohorts_help'] = 'Nicht öffentliche Programme können für bestimmte Mitglieder der globalen Gruppe sichtbar gemacht werden.

Der Sichtbarkeitsstatus wirkt sich nicht auf bereits zugewiesene Programme aus.';
$string['columnusedalready'] = 'Spalte wird bereits verwendet';
$string['completepercent'] = '{$a} % abgeschlossen';
$string['completion'] = 'Abschluss';
$string['completiondate'] = 'Datum des Abschlusses';
$string['completiondelay'] = 'Abschlussverzögerung';
$string['completionoverride'] = 'Abschluss überschreiben';
$string['creategroups'] = 'Kursgruppen';
$string['creategroups_help'] = 'Wenn diese Option aktiviert ist, wird in jedem Kurs, der dem Programm hinzugefügt wird, eine Gruppe erstellt, und alle zugeordneten Nutzer/innen werden als Gruppenmitglieder hinzugefügt.';
$string['customfields'] = 'Nutzer/innendefinierte Programmfelder';
$string['customfieldsettings'] = 'Allgemeine Einstellungen für nutzer/innendefinierte Programmfelder';
$string['customfieldvisibleto'] = 'Feldinhalt ist sichtbar für';
$string['customfieldvisible:allocated'] = 'Dem Programm zugeordnete Nutzer/innen';
$string['customfieldvisible:everyone'] = 'Alle, die andere Programmdetails sehen können';
$string['customfieldvisible:viewcapability'] = 'Nutzer/innen mit der Fähigkeit "Programme anzeigen"';
$string['deleteallocation'] = 'Programmzuordnung löschen';
$string['deletecourse'] = 'Kurs entfernen';
$string['deleteprogram'] = 'Programm löschen';
$string['deleteset'] = 'Satz löschen';
$string['deletetraining'] = 'Schulung entfernen';
$string['documentation'] = 'Programme für Moodle-Dokumentation';
$string['duedate'] = 'Fälligkeitsdatum';
$string['enrolrole'] = 'Kurs-Rolle';
$string['enrolrole_desc'] = 'Wählen Sie eine Rolle aus, die von Programmen für die Kursanmeldung verwendet wird';
$string['errorcontentproblem'] = 'Problem in der Programminhaltsstruktur erkannt, Programmabschluss wird nicht korrekt nachverfolgt!';
$string['errorcoursemissing'] = 'Kurs fehlt';
$string['errorcoursesmissing'] = 'Fehlende Kurse: {$a}';
$string['errorinvalidoverridedates'] = 'Ungültige Datumsüberschreibungen';
$string['errordifferenttenant'] = 'Auf das Programm eines anderen Mandanten kann nicht zugegriffen werden';
$string['errorduplicateprogramid'] = 'Die Programm-ID-Nummer wird bereits für ein anderes Programm genutzt. Bitte verwenden Sie eine eindeutige Programm-ID-Nummer.';
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
$string['evidencedate'] = 'Abschlussnachweis-Datum';
$string['evidenceupdate'] = 'Weitere Nachweise aktualisieren';
$string['evidenceupload'] = 'Abschlussnachweise hochladen';
$string['evidenceupload_csvfile'] = 'CSV-Datei';
$string['evidenceupload_errors'] = '{$a} ungültige Zeilen erkannt';
$string['evidenceupload_skipped'] = '{$a} Zeilen übersprungen';
$string['evidenceupload_updated'] = 'Abschlussnachweis für {$a} Nutzer/innen aktualisiert';
$string['evidence_details'] = 'Details';
$string['evidence_detailsdefault'] = 'Standarddetails';
$string['export'] = 'Programme exportieren';
$string['exportfile_info'] = 'Info';
$string['exportfile_programs'] = 'Programme';
$string['exportformat'] = 'Dateiformat';
$string['exportformat_csv'] = 'CSV';
$string['exportformat_json'] = 'JSON';
$string['extra_menu_management_index'] = 'Programmaktionen';
$string['extra_menu_management_program_general'] = 'Programmaktionen';
$string['extra_menu_management_program_users'] = 'Nutzer/innenaktionen';
$string['extra_menu_management_program_allocation'] = 'Zuordnungsaktionen';
$string['fixeddate'] = 'Zu einem bestimmten Datum';
$string['idnumbersymbol'] = 'ID-Nr.:';
$string['importallocationend'] = 'Zuordnungsende ({$a})';
$string['importallocationstart'] = 'Zuordnungsbeginn ({$a})';
$string['importprogramallocation'] = 'Programmzuordnung importieren';
$string['importprogramallocationconfirmation'] = 'Sie importieren Zuordnungseinstellungen aus dem Programm __{$a->fullname} / {$a->idnumber} / {$a->category}__.

Wählen Sie alle Einstellungen aus, die Sie importieren möchten.';
$string['importprogramcontent'] = 'Programminhalt importieren';
$string['importprogramcontentconfirmation'] = 'Sie importieren Inhalt aus dem Programm __{$a->fullname} / {$a->idnumber} / {$a->category}__.';
$string['importprogramdue'] = 'Programm fällig ({$a})';
$string['importprogramend'] = 'Programmende ({$a})';
$string['importprogramstart'] = 'Programmstart ({$a})';
$string['importselectprogram'] = 'Programm auswählen';
$string['invalidallocationdates'] = 'Ungültige Datumsangaben für Programmzuordnung';
$string['invalidcompletiondate'] = 'Ungültiges Programmabschluss-Datum';
$string['item'] = 'Aspekt';
$string['itemcompletion'] = 'Abschluss des Programmelements';
$string['itempoints'] = 'Punkte';
$string['itemrecalculate'] = 'Abschluss des Elements neu berechnen';
$string['layoutgrid'] = 'Rasterlayout';
$string['layouttable'] = 'Tabellenlayout';
$string['management'] = 'Programmverwaltung';
$string['messageprovider:allocation_notification'] = 'Benachrichtigung über Programmzuordnung';
$string['messageprovider:approval_request_notification'] = 'Benachrichtigung zur Anforderung einer Programmgenehmigung';
$string['messageprovider:approval_reject_notification'] = 'Benachrichtigung über Ablehnung der Programmanforderung';
$string['messageprovider:completion_notification'] = 'Benachrichtigung zum Programmabschluss';
$string['messageprovider:completion_relateduser_notification'] = 'Benachrichtigung zum Programmabschluss – zugehörige/r Nutzer/in';
$string['messageprovider:deallocation_notification'] = 'Benachrichtigung über die Aufhebung der Programmzuordnung';
$string['messageprovider:duesoon_notification'] = 'Benachrichtigung über das bald bevorstehende Fälligkeitsdatum des Programms';
$string['messageprovider:duesoon_relateduser_notification'] = 'Benachrichtigung über das bald bevorstehende Fälligkeitsdatum des Programms – zugehörige/r Nutzer/in';
$string['messageprovider:due_notification'] = 'Benachrichtigung über überfällige Programme';
$string['messageprovider:due_relateduser_notification'] = 'Benachrichtigung über überfällige Programme – zugehörige/r Nutzer/in';
$string['messageprovider:endsoon_notification'] = 'Benachrichtigung über das bald bevorstehende Enddatum des Programms';
$string['messageprovider:endsoon_relateduser_notification'] = 'Benachrichtigung über das bald bevorstehende Enddatum des Programms – zugehörige/r Nutzer/in';
$string['messageprovider:endcompleted_notification'] = 'Benachrichtigung zum erfolgreichen Abschluss eines beendeten Programms';
$string['messageprovider:endfailed_notification'] = 'Benachrichtigung zum fehlgeschlagenen Abschluss eines beendeten Programms';
$string['messageprovider:endfailed_relateduser_notification'] = 'Benachrichtigung zum fehlgeschlagenen Abschluss eines beendeten Programms – zugehörige/r Nutzer/in';
$string['messageprovider:reset_notification'] = 'Benachrichtigung über Programmrücksetzung';
$string['messageprovider:start_notification'] = 'Benachrichtigung über Programmstart';
$string['moveitem'] = 'Element verschieben';
$string['moveitemcancel'] = 'Verschieben abbrechen';
$string['moveafter'] = '"{$a->item}" nach " "{$a->target}" verschieben';
$string['movebefore'] = '"{$a->item}" vor "{$a->target}" verschieben';
$string['moveinto'] = '"{$a->item}" in "{$a->target}" verschieben';
$string['myprograms'] = 'Meine Programme';
$string['notification_allocation'] = 'Nutzer/in zugeordnet';
$string['notification_allocation_subject'] = 'Benachrichtigung über Programmzuordnung';
$string['notification_allocation_body'] = 'Hallo {$a->user_fullname},

Sie wurden dem Programm "{$a->program_fullname}" zugeordnet; das Startdatum ist der {$a->program_startdate}.
';
$string['notification_allocation_description'] = 'Benachrichtigung, die an Nutzer/innen gesendet wird, wenn sie dem Programm zugeordnet werden.';
$string['notification_completion'] = 'Programm abgeschlossen';
$string['notification_completion_subject'] = 'Programm abgeschlossen';
$string['notification_completion_body'] = 'Hallo {$a->user_fullname},

Sie haben das Programm "{$a->program_fullname}" abgeschlossen.
';
$string['notification_completion_description'] = 'Benachrichtigung, die an Nutzer/innen gesendet wird, wenn sie ihr Programm abgeschlossen haben.';
$string['notification_completion_relateduser'] = 'Programm abgeschlossen – zugehörige/r Nutzer/in';
$string['notification_completion_relateduser_subject'] = 'Nutzer/in {$a->user_fullname} hat Programm abgeschlossen';
$string['notification_completion_relateduser_body'] = 'Hallo {$a->relateduser_fullname},

Nutzer/in {$a->user_fullname} hat das Programm "{$a->program_fullname}" abgeschlossen.
';
$string['notification_completion_relateduser_description'] = 'Benachrichtigung, die an Nutzer/innen gesendet wird und sich auf eine/n Nutzer/in bezieht, der/die sein/ihr Programm abgeschlossen hat.';
$string['notification_deallocation'] = 'Zuordnung durch Nutzer/in rückgängig gemacht';
$string['notification_deallocation_subject'] = 'Benachrichtigung über die Aufhebung der Programmzuordnung';
$string['notification_deallocation_body'] = 'Hallo {$a->user_fullname},

Sie wurden aus dem Programm "{$a->program_fullname}" entfernt.
';
$string['notification_deallocation_description'] = 'Benachrichtigung, die an Nutzer/innen gesendet wird, wenn sie aus einem Programm entfernt werden.';
$string['notification_duesoon'] = 'Programm bald fällig';
$string['notification_duesoon_subject'] = 'Programm sollte bald abgeschlossen werden';
$string['notification_duesoon_body'] = 'Hallo {$a->user_fullname},

der Abschluss des Programms "{$a->program_fullname}" wird am {$a->program_duedate} erwartet.
';
$string['notification_duesoon_description'] = 'Benachrichtigung, die vor dem Abschlussdatum des Programms an Nutzer/innen gesendet wird, sofern das Programm nicht bereits abgeschlossen wurde.';
$string['notification_duesoon_relateduser'] = 'Programm bald fällig – zugehörige/r Nutzer/in';
$string['notification_duesoon_relateduser_subject'] = 'Programm sollte bald von Nutzer/in {$a->user_fullname} abgeschlossen werden';
$string['notification_duesoon_relateduser_body'] = 'Hallo {$a->relateduser_fullname},

der Abschluss des Programms "{$a->program_fullname}" durch Nutzer/in {$a->user_fullname} wird am {$a->program_duedate} erwartet.
';
$string['notification_duesoon_relateduser_description'] = 'Benachrichtigung, die vor dem Abschlussdatum des Programms an Nutzer/innen gesendet wird, sofern das Programm nicht bereits abgeschlossen wurde.';
$string['notification_due'] = 'Programm überfällig';
$string['notification_due_subject'] = 'Programm hätte abgeschlossen werden müssen';
$string['notification_due_body'] = 'Hallo {$a->user_fullname},

der Abschluss des Programms "{$a->program_fullname}" wurde vor dem {$a->program_duedate} erwartet.
';
$string['notification_due_description'] = 'Benachrichtigung, die an Nutzer/innen gesendet wird, wenn der Abschluss des Programms überfällig ist.';
$string['notification_due_relateduser'] = 'Programm überfällig – zugehörige/r Nutzer/in';
$string['notification_due_relateduser_subject'] = 'Programmabschluss von Nutzer/in {$a->user_fullname} wurde erwartet';
$string['notification_due_relateduser_body'] = 'Hallo {$a->relateduser_fullname},

der Abschluss des Programms "{$a->program_fullname}" durch Nutzer/in {$a->user_fullname} wurde vor dem {$a->program_duedate} erwartet.
';
$string['notification_due_relateduser_description'] = 'Benachrichtigung, die an Nutzer/innen gesendet wird, wenn der Abschluss des Programms durch eine/n Nutzer/in überfällig ist.';
$string['notification_endsoon'] = 'Enddatum des Programms steht bevor';
$string['notification_endsoon_subject'] = 'Programm endet bald';
$string['notification_endsoon_body'] = 'Hallo {$a->user_fullname},

das Programm "{$a->program_fullname}" endet am {$a->program_enddate}.
';
$string['notification_endsoon_description'] = 'Benachrichtigung, die vor dem Enddatum des Programms an Nutzer/innen gesendet wird, sofern das Programm nicht bereits abgeschlossen wurde.';
$string['notification_endsoon_relateduser'] = 'Programm endet bald – zugehörige/r Nutzer/in';
$string['notification_endsoon_relateduser_subject'] = 'Das Programm endet bald für Nutzer/in {$a->user_fullname}';
$string['notification_endsoon_relateduser_body'] = 'Hallo {$a->relateduser_fullname},

das Programm "{$a->program_fullname}" für Nutzer/in {$a->user_fullname} endet am {$a->program_enddate}.
';
$string['notification_endsoon_relateduser_description'] = 'Benachrichtigung, die vor dem Enddatum des Programms an Nutzer/innen gesendet wird, sofern das Programm nicht bereits abgeschlossen wurde.';
$string['notification_endcompleted'] = 'Abgeschlossenes Programm beendet';
$string['notification_endcompleted_subject'] = 'Abgeschlossenes Programm beendet';
$string['notification_endcompleted_body'] = 'Hallo {$a->user_fullname},

das Programm "{$a->program_fullname}" ist beendet; Sie haben es bereits abgeschlossen.
';
$string['notification_endcompleted_description'] = 'Benachrichtigung, die an Nutzer/innen gesendet wird, wenn ihr abgeschlossenes Programm endet.';
$string['notification_endfailed'] = 'Fehlgeschlagener Abschluss eines beendeten Programms';
$string['notification_endfailed_subject'] = 'Fehlgeschlagener Abschluss eines beendeten Programms';
$string['notification_endfailed_body'] = 'Hallo {$a->user_fullname},

das Programm "{$a->program_fullname}" ist beendet; Sie haben es nicht abgeschlossen.
';
$string['notification_endfailed_description'] = 'Benachrichtigung, die an Nutzer/innen gesendet wird, wenn ein nicht abgeschlossenes Programm endet.';
$string['notification_endfailed_relateduser'] = 'Ende eines nicht abgeschlossenen Programms – zugehörige/r Nutzer/in';
$string['notification_endfailed_relateduser_subject'] = 'Nicht abgeschlossenes Programm für Nutzer/in {$a->user_fullname} beendet';
$string['notification_endfailed_relateduser_body'] = 'Hallo {$a->relateduser_fullname},

das Programm "{$a->program_fullname}" wurde beendet, und Nutzer/in {$a->user_fullname} hat es nicht abgeschlossen.
';
$string['notification_endfailed_relateduser_description'] = 'Benachrichtigung, die an Nutzer/innen gesendet wird und sich auf eine/n Nutzer/in bezieht, dessen/deren nicht abgeschlossenes Programm beendet wurde.';
$string['notification_relateduserfield'] = 'Benachrichtigungsfeld "Zugehörige/r Nutzer/in"';
$string['notification_relateduserfield_desc'] = 'Wählen Sie das Profilfeld "Zugehörige/r Nutzer/in" aus, das für die Benachrichtigung zugehöriger Nutzer/innen verwendet werden soll.';
$string['notification_reset'] = 'Nutzer/innen-Fortschritt zurückgesetzt';
$string['notification_reset_subject'] = 'Benachrichtigung über Programmrücksetzung';
$string['notification_reset_body'] = 'Hallo {$a->user_fullname},

Ihr Fortschritt im Programm "{$a->program_fullname}" wurde zurückgesetzt.
';
$string['notification_reset_description'] = 'Benachrichtigung, die an Nutzer/innen gesendet wird, wenn ihr Programmfortschritt zurückgesetzt wird.';
$string['notification_start'] = 'Programm gestartet';
$string['notification_start_subject'] = 'Programm gestartet';
$string['notification_start_body'] = 'Hallo {$a->user_fullname},

das Programm "{$a->program_fullname}" hat begonnen.
';
$string['notification_start_description'] = 'Benachrichtigung, die an Nutzer/innen gesendet wird, wenn ihr Programm begonnen hat.';
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

$string['privacy:metadata:table:enrol_programs_src_commholds'] = 'Handelszuordnung – Reservierungen';
$string['privacy:metadata:field:quantity'] = 'Menge';

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
$string['programcompletionoverride'] = 'Programmabschluss überschreiben';
$string['programidnumber'] = 'Programm-ID-Nummer';
$string['programimage'] = 'Programmbild';
$string['programname'] = 'Programmname';
$string['programurl'] = 'Programm-URL';
$string['programs'] = 'Programme';
$string['programsactive'] = 'Aktiv';
$string['programsarchived'] = 'Archiviert';
$string['programsarchived_help'] = 'Archivierte Programme werden für die Nutzer/innen ausgeblendet und ihr Fortschritt wird gesperrt.';
$string['programslayout'] = 'Detailliertes Seitenlayout des Programms';
$string['programslayout_desc'] = 'Steuert das Programmlayout – Tabellen- oder Rasteransicht für die Seite „Meine Programme“.';
$string['programslayoutallowuserswitch'] = 'Nutzer/innen erlauben, das Programmlayout zu wechseln';
$string['programslayoutallowuserswitch_desc'] = 'Nutzer/innen erlauben, das Programmlayout zu wechseln';
$string['programslayout_desc'] = 'Steuert das Programmlayout – Tabellen- oder Rasteransicht für die Seite „Meine Programme“.';
$string['programsblocklayout'] = 'Layout für „Meine Programme“-Block';
$string['programsblocklayout_desc'] = 'Steuert das Programmlayout – Tabellen- oder Rasteransicht für den Block „Meine Programme“.';

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
$string['programs:addtocertifications'] = 'Programm zu Zertifizierungen hinzufügen';
$string['programs:addtoplan'] = 'Programm zu Plänen hinzufügen';
$string['programs:allocate'] = 'Kursteilnehmer/innen Programmen zuordnen';
$string['programs:archive'] = 'Programmzuordnungen archivieren';
$string['programs:clone'] = 'Klonen von Programminhalten und -einstellungen erlauben';
$string['programs:configframeworks'] = 'Programmverfügbarkeit in Plan-Frameworks konfigurieren';
$string['programs:configurecustomfields'] = 'Nutzer/innendefinierte Programmfelder konfigurieren';
$string['programs:delete'] = 'Programme löschen';
$string['programs:edit'] = 'Hinzufügen und Aktualisieren von Programmen';
$string['programs:export'] = 'Programme exportieren';
$string['programs:admin'] = 'Erweiterte Programmverwaltung';
$string['programs:manageallocation'] = 'Nutzer/innen-Zuordnungen verwalten';
$string['programs:manageevidence'] = 'Andere Abschlussnachweise verwalten';
$string['programs:reset'] = 'Programmfortschritt zurücksetzen';
$string['programs:upload'] = 'Programme hochladen';
$string['programs:view'] = 'Programmverwaltung anzeigen';
$string['programs:viewcatalogue'] = 'Auf Programmkatalog zugreifen';
$string['public'] = 'Öffentlich';
$string['public_help'] = 'Öffentliche Programme sind für alle Nutzer/innen sichtbar.

Der Sichtbarkeitsstatus wirkt sich nicht auf bereits zugeordnete Programme aus.';
$string['purchaseaccess'] = 'Zugriff erwerben';
$string['resetallocation'] = 'Programmfortschritt zurücksetzen';
$string['resettype'] = 'Art der Zurücksetzung';
$string['resettype_deallocate'] = 'Nur Aufheben der Programmzuordnung';
$string['resettype_full'] = 'Vollständiges Löschen des Kurses';
$string['resettype_none'] = 'Keine';
$string['resettype_standard'] = 'Standardkurs löschen';
$string['sequencetype'] = 'Fertigstellungstyp';
$string['sequencetype_allinorder'] = 'Alles nach Reihenfolge';
$string['sequencetype_allinanyorder'] = 'Alles in beliebiger Reihenfolge';
$string['sequencetype_atleast'] = 'Mindestens {$a->min}';
$string['sequencetype_minpoints'] = 'Mindestens {$a->minpoints} Punkte';
$string['selectcategory'] = 'Wählen Sie eine Kategorie';
$string['sortbyprogramname'] = 'Sortieren nach Programmname';
$string['sortbyprogramid'] = 'Sortieren nach Programm-ID';
$string['sortbyprogramstart'] = 'Sortieren nach Startdatum des Programms';
$string['sortbyprogramdue'] = 'Sortieren nach Fälligkeitsdatum des Programms';
$string['sortbyprogramend'] = 'Sortieren nach Enddatum des Programms';
$string['source'] = 'Quelle';
$string['source_approval'] = 'Anforderungen mit Genehmigung';
$string['source_approval_allownew'] = 'Genehmigungen zulassen';
$string['source_approval_allownew_desc'] = 'Hinzufügen neuer Quellen für _Anforderungen mit Genehmigung_ zu Programmen zulassen';
$string['source_approval_allowrequest'] = 'Neue Anforderungen erlauben';
$string['source_approval_confirm'] = 'Bestätigen Sie, dass Sie die Zuordnung zum Programm anfordern möchten.';
$string['source_approval_daterequested'] = 'Angefragte Daten';
$string['source_approval_daterejected'] = 'Datum der Ablehnung';
$string['source_approval_makerequest'] = 'Zugang anfordern';
$string['source_approval_notification_approval_request_subject'] = 'Benachrichtigung über Programmanforderung';
$string['source_approval_notification_approval_request_body'] = '
Nutzer/in {$a->user_fullname} hat Zugriff auf das Programm "{$a->program_fullname}" angefordert.
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
$string['source_certify'] = 'Zertifizierungen';
$string['source_certify_allownew'] = 'Zertifizierungszuordnung zulassen';
$string['source_certify_allownew_desc'] = 'Hinzufügen neuer Quellen für die _Zertifizierung_ zu Programmen zulassen';
$string['source_cohort'] = 'Automatische Gruppenzuordnung';
$string['source_cohort_allownew'] = 'Gruppenzuordnung zulassen';
$string['source_cohort_allownew_desc'] = 'Hinzufügen neuer Quellen für die _automatische Gruppenzuordnung_ zu Programmen zulassen';
$string['source_cohort_cohortstoallocate'] = 'Globale Gruppen zuordnen';
$string['source_ecommerce'] = 'E-Commerce-Zuordnung';
$string['source_ecommerce_allownew'] = 'E-Commerce-Zuordnung zulassen';
$string['source_ecommerce_allownew_desc'] = 'Hinzufügen neuer Quellen für die _automatische E-Commerce-Zuordnung_ zu Programmen zulassen';
$string['source_ecommerce_allowsignup'] = 'Neue Zuordnungen erlauben';
$string['source_ecommerce_cohortmembershiprequirement'] = 'Nutzer/innen müssen Mitglied einer der folgenden globalen Gruppen sein: {$a}';
$string['source_ecommerce_maxusers'] = 'Maximale Nutzer/innen-Zahl';
$string['source_ecommerce_nocapacity'] = 'Es gibt keine verbleibende Kapazität in diesem Programm.';
$string['source_manual'] = 'Manuelle Zuordnung';
$string['source_manual_allocateusers'] = 'Nutzer/innen zuordnen';
$string['source_manual_csvfile'] = 'CSV-Datei';
$string['source_manual_hasheaders'] = 'Erste Zeile ist Kopfzeile';
$string['source_manual_potusersmatching'] = 'Übereinstimmende Zuordnungskandidaten';
$string['source_manual_potusers'] = 'Zuordnungskandidaten';
$string['source_manual_result_assigned'] = '{$a} Nutzer/innen wurden dem Programm zugewiesen.';
$string['source_manual_result_errors'] = '{$a} Fehler bei der Programmzuweisung erkannt.';
$string['source_manual_result_skipped'] = '{$a} Nutzer/innen wurden dem Programm bereits zugewiesen.';
$string['source_manual_timeduecolumn'] = 'Spalte "Zeitpunkt der Fälligkeit"';
$string['source_manual_timeendcolumn'] = 'Spalte "Startzeitpunkt"';
$string['source_manual_timestartcolumn'] = 'Spalte "Endzeitpunkt"';
$string['source_manual_uploadusers'] = 'Zuordnungen hochladen';
$string['source_manual_usercolumn'] = 'Nutzer/innen-Identifikations-Spalte';
$string['source_manual_usermapping'] = 'Nutzer/innen-Zuordnung über';
$string['source_manual_userupload_allocated'] = 'Zugeordnet zu "{$a}"';
$string['source_manual_userupload_alreadyallocated'] = 'Bereits zugeordnet zu "{$a}"';
$string['source_manual_userupload_invalidprogram'] = 'Zuordnung nicht möglich zu "{$a}"';
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
$string['source_selfallocation_signupallowed'] = 'Anmeldungen sind zulässig';
$string['source_selfallocation_signupnotallowed'] = 'Anmeldungen sind nicht zulässig';
$string['source_udplans'] = 'Nutzer/innen-Entwicklungspläne';
$string['source_udplans_allownew'] = 'Nutzer/innen-Entwicklungspläne';
$string['source_udplans_allownew_desc'] = 'Hinzufügen neuer Quellen für _Nutzer/innen-Entwicklungspläne_ zu Programmen zulassen';
$string['source_udplans_allowed'] = 'Erlaubt';
$string['source_udplans_noframeworks'] = 'Kann keinem Plan hinzugefügt werden';
$string['source_udplans_notallowed'] = 'Nicht zugelassen';
$string['source_udplans_requirecap'] = 'erforderliche Fähigkeit hinzufügen';
$string['set'] = 'Kursset';
$string['settings'] = 'Programmeinstellungen';
$string['scheduling'] = 'Zeitplanung';
$string['taballocation'] = 'Einstellungen \'Zuordnungen\'';
$string['tabcontent'] = 'Inhalt';
$string['tabgeneral'] = 'Allgemein';
$string['tabusers'] = 'Nutzer/innen';
$string['tabvisibility'] = 'Sichtbarkeitseinstellungen';
$string['tagarea_enrol_programs_programs'] = 'Programme';
$string['taskcertificate'] = 'Programm-Zertifikat stellt Cron aus';
$string['taskcron'] = 'Programm-Plugin Cron';
$string['training'] = 'Schulung';
$string['trainingcompletion'] = 'Erforderliche Schulung: {$a}';
$string['trainingprogress'] = 'Schulungsfortschritt: {$a->current}/{$a->total}';
$string['unarchive'] = 'Wiederherstellen';
$string['unlinkeditems'] = 'Nicht verknüpfte Elemente';
$string['updateprogram'] = 'Programm aktualisieren';
$string['updateallocation'] = 'Zuordnung aktualisieren';
$string['updateallocations'] = 'Zuordnungen aktualisieren';
$string['updatecourse'] = 'Kurs aktualisieren';
$string['updateset'] = 'Satz aktualisieren';
$string['updatescheduling'] = 'Planung aktualisieren';
$string['updatesource'] = '{$a} aktualisieren';
$string['updatetraining'] = 'Schulung aktualisieren';
$string['upload'] = 'Programme hochladen';
$string['upload_invalidcount'] = 'Ungültige Datensätze';
$string['upload_files'] = 'Dateien';
$string['upload_files_error'] = 'Es werden mehrere CSV-Dateien, eine JSON-Datei oder ein ZIP-Archiv erwartet.';
$string['upload_preview'] = 'Datenvorschau';
$string['upload_status'] = 'Status';
$string['upload_status_invalid'] = 'Ungültig';
$string['upload_targetcontext'] = 'Programme in Kontext einfügen';
$string['upload_uploadcount'] = 'Hochzuladende Programme';
$string['upload_usecategory'] = 'Kategoriespalte für Kontexte verwenden';
$string['userupload_completion_error'] = 'Programmabschluss kann nicht aktualisiert werden';
$string['userupload_completion_updated'] = 'Programmabschluss wurde aktualisiert';

$string['rb_allocatedprograms'] = 'Zugeordnete Programme';
$string['rb_complete'] = 'Abgeschlossen';
$string['rb_completiondate'] = 'Datum des Abschlusses';
$string['rb_completionstatus'] = 'Abschlussstatus';
$string['rb_datecompleted'] = 'Abschlussdatum';
$string['rb_dateallocated'] = 'Zuordnungsdatum';
$string['rb_datestarted'] = 'Startdatum';
$string['rb_coursesall'] = 'Kurs(e) – alle';
$string['rb_incomplete'] = 'Unvollständig';
$string['rb_isallocated'] = 'Ist zugeordnet';
$string['rb_iscomplete'] = 'Ist abgeschlossen?';
$string['rb_iscompleteany'] = 'Ist abgeschlossen? (beliebige Methode)';
$string['rb_isinprogress'] = 'Ist in Bearbeitung?';
$string['rb_isnotcomplete'] = 'Ist nicht abgeschlossen?';
$string['rb_isnotyetstarted'] = 'Wurde noch nicht begonnen?';
$string['rb_notstarted'] = 'Nicht begonnen';
$string['rb_officewhencompletedbasic'] = 'Büro bei Abschluss (Basis)';
$string['rb_privacy:metadata'] = 'Das Plugin speichert keine personenbezogenen Daten.';
$string['rb_programcategory'] = 'Programmkategorie (oder Website)';
$string['rb_programcategoryid'] = 'Programmkategorie-ID (keine Angabe, wenn Website)';
$string['rb_programcategoryidnumber'] = 'Programmkategorie-ID-Nummer (keine Angabe, wenn Website)';
$string['rb_programcategorymultichoice'] = 'Programmkategorie (Mehrfachauswahl)';
$string['rb_programedatecreated'] = 'Erstellungsdatum des Programms';
$string['rb_programduedate'] = 'Fälligkeitsdatum des Programms';
$string['rb_programenddate'] = 'Enddatum der Programmzuordnung';
$string['rb_programallocationtype'] = 'Zuordnungstyp';
$string['rb_programallocationtypes'] = 'Zuordnungstypen';
$string['rb_programexpandlink'] = 'Programmname (Details erweitern)';
$string['rb_programid'] = 'Programm-ID';
$string['rb_programidnumber'] = 'Programm-ID-Nummer';
$string['rb_programname'] = 'Programmname';
$string['rb_programnameandsummary'] = 'Programmname und -beschreibung';
$string['rb_programnamelinked'] = 'Programmname (verlinkt mit Programmseite)';
$string['rb_programmultiitem'] = 'Programm (mehrere Antworten)';
$string['rb_programsingleitem'] = 'Programm';
$string['rb_programstartdate'] = 'Startdatum der Programmzuordnung';
$string['rb_programsummary'] = 'Programmbeschreibung';
$string['rb_programvisible'] = 'Programm ist öffentlich';
$string['rb_programvisibledisabled'] = 'Programm sichtbar (nicht zutreffend)';
$string['rb_progress'] = 'Fortschritt';
$string['rb_progressnumeric'] = 'Fortschritt (numerisch)';
$string['rb_progresspercent'] = 'Fortschritt (% abgeschlossen)';
$string['rb_source_allocation'] = 'Programmzuordnungen';
$string['rb_timetocompletesinceenrol'] = 'Zeit bis Abschluss (seit Zuordnungsdatum)';
$string['rb_timetocompletesincestart'] = 'Zeit bis Abschluss (seit Startdatum)';
$string['rb_type_program'] = 'Programm';
$string['rb_type_program_category'] = 'Kategorie';
$string['rb_type_program_completion'] = 'Programmzuordnung';
$string['rb_type_program_customfields'] = 'Nutzer/innendefinierte Programmfelder';
$string['rb_user'] = 'Nutzer/in';
$string['rb_viewprogram'] = 'Programm anzeigen';
$string['rb_visiblecohorts'] = 'Globale Gruppen mit Sichtbarkeit';
