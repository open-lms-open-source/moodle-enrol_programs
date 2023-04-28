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

$string['addprogram'] = 'Přidat program';
$string['addset'] = 'Přidat novou sadu';
$string['allocationend'] = 'Konec přidělení';
$string['allocationend_help'] = 'Význam data konce přidělení závisí na povolených zdrojích přidělení. Obvykle po zadání tohoto data již není možné provádět nová přidělení.';
$string['allocation'] = 'Přidělení';
$string['allocations'] = 'Přidělení';
$string['programallocations'] = 'Přidělení programu';
$string['allocationdate'] = 'Datum přidělení';
$string['allocationsources'] = 'Zdroje přidělení';
$string['allocationstart'] = 'Zahájení přidělení';
$string['allocationstart_help'] = 'Význam data zahájení přidělení závisí na povolených zdrojích přidělení. Obvykle je možné provádět nová přidělení jen po zadání tohoto data.';
$string['allprograms'] = 'Všechny programy';
$string['appenditem'] = 'Připojit položku';
$string['appendinto'] = 'Připojit do položky';
$string['archived'] = 'Archivováno';
$string['catalogue'] = 'Katalog programů';
$string['catalogue_dofilter'] = 'Hledat';
$string['catalogue_resetfilter'] = 'Vymazat';
$string['catalogue_searchtext'] = 'Vyhledat text';
$string['catalogue_tag'] = 'Filtrovat podle štítků';
$string['certificatetemplatechoose'] = 'Zvolit šablonu...';
$string['cohorts'] = 'Viditelné pro skupiny';
$string['cohorts_help'] = 'Neveřejné programy mohou být viditelné pro členy určené skupiny.

Stav viditelnosti nemá vliv na již přidělené programy.';
$string['completiondate'] = 'Datum ukončení';
$string['creategroups'] = 'Skupiny kurzů';
$string['creategroups_help'] = 'Pokud je tato možnost povolena, bude v každém kurzu přidaném do programu vytvořena skupina a všichni přidělení uživatelé budou přidáni jako členové skupiny.';
$string['deleteallocation'] = 'Odstranit přidělení programu';
$string['deletecourse'] = 'Odebrat kurz';
$string['deleteprogram'] = 'Odstranit program';
$string['deleteset'] = 'Odstranit sadu';
$string['documentation'] = 'Programy pro dokumentaci Moodlu';
$string['duedate'] = 'Termín';
$string['enrolrole'] = 'Role v kurzu';
$string['enrolrole_desc'] = 'Vyberte roli, kterou budou programy používat pro registraci do kurzů';
$string['errorcontentproblem'] = 'Zjištěn problém ve struktuře obsahu programu, dokončení programu se nebude správně sledovat!';
$string['errordifferenttenant'] = 'Nelze přistupovat k programu z jiného klienta';
$string['errornoallocations'] = 'Nenalezena žádná přidělení uživatelů';
$string['errornoallocation'] = 'Program není přidělen';
$string['errornomyprograms'] = 'Nejste přiděleni k žádným programům.';
$string['errornoprograms'] = 'Nebyly nalezeny žádné programy.';
$string['errornorequests'] = 'Nebyly nalezeny žádné požadavky na programy.';
$string['errornotenabled'] = 'Modul plug-in programů není povolen';
$string['event_program_completed'] = 'Program dokončen';
$string['event_program_created'] = 'Program vytvořen';
$string['event_program_deleted'] = 'Program odstraněn';
$string['event_program_updated'] = 'Program aktualizován';
$string['event_program_viewed'] = 'Program zobrazen';
$string['event_user_allocated'] = 'Přidělení uživatele do programu';
$string['event_user_deallocated'] = 'Přidělení uživatele do programu zrušeno';
$string['evidence'] = 'Jiný důkaz';
$string['evidence_details'] = 'Podrobnosti';
$string['fixeddate'] = 'Jako pevné datum';
$string['item'] = 'Položka';
$string['itemcompletion'] = 'Dokončení položky programu';
$string['management'] = 'Správa programu';
$string['messageprovider:allocation_notification'] = 'Oznámení o přidělení programu';
$string['messageprovider:approval_request_notification'] = 'Oznámení o požadavku na schválení programu';
$string['messageprovider:approval_reject_notification'] = 'Oznámení o zamítnutí požadavku na program';
$string['messageprovider:completion_notification'] = 'Oznámení o dokončení programu';
$string['messageprovider:deallocation_notification'] = 'Oznámení o zrušení přidělení programu';
$string['messageprovider:duesoon_notification'] = 'Oznámení o blížícím se termínu splnění programu';
$string['messageprovider:due_notification'] = 'Oznámení o zpoždění programu';
$string['messageprovider:endsoon_notification'] = 'Oznámení o blížícím se datu ukončení programu';
$string['messageprovider:endcompleted_notification'] = 'Oznámení o ukončení dokončeného programu';
$string['messageprovider:endfailed_notification'] = 'Oznámení o ukončení neúspěšného programu';
$string['messageprovider:start_notification'] = 'Oznámení o zahájeném programu';
$string['moveitem'] = 'Přesunout položku';
$string['moveitemcancel'] = 'Zrušit přesouvání';
$string['moveafter'] = 'Přesunout „{$a->item}“ po „{$a->target}“';
$string['movebefore'] = 'Přesunout „{$a->item}“ před „{$a->target}“';
$string['moveinto'] = 'Přesunout „{$a->item}“ do „{$a->target}“';
$string['myprograms'] = 'Moje programy';
$string['notification_allocation'] = 'Přidělení uživatelů';
$string['notification_completion'] = 'Program dokončen';
$string['notification_completion_subject'] = 'Program dokončen';
$string['notification_completion_body'] = 'Dobrý den, {$a->user_fullname},

dokončil(a) jste program „{$a->program_fullname}“.
';
$string['notification_deallocation'] = 'Přidělení uživatele zrušeno';
$string['notification_duesoon'] = 'Blíží se termín splnění programu';
$string['notification_duesoon_subject'] = 'Dokončení programu se očekává brzy';
$string['notification_duesoon_body'] = 'Dobrý den, {$a->user_fullname},

dokončení programu „{$a->program_fullname}“ se očekává dne {$a->program_duedate}.
';
$string['notification_due'] = 'Zpoždění programu';
$string['notification_due_subject'] = 'Očekávalo se dokončení programu';
$string['notification_due_body'] = 'Dobrý den, {$a->user_fullname},

dokončení programu „{$a->program_fullname}“ se očekávalo do {$a->program_duedate}.
';
$string['notification_endsoon'] = 'Blíží se datum ukončení programu';
$string['notification_endsoon_subject'] = 'Program brzy končí';
$string['notification_endsoon_body'] = 'Dobrý den, {$a->user_fullname},

program „{$a->program_fullname}" končí dne {$a->program_enddate}.
';
$string['notification_endcompleted'] = 'Dokončený program skončil';
$string['notification_endcompleted_subject'] = 'Dokončený program skončil';
$string['notification_endcompleted_body'] = 'Dobrý den, {$a->user_fullname},

program „{$a->program_fullname}“ skončil, už dříve jste ho dokončili.
';
$string['notification_endfailed'] = 'Neúspěšný program skončil';
$string['notification_endfailed_subject'] = 'Neúspěšný program skončil';
$string['notification_endfailed_body'] = 'Dobrý den, {$a->user_fullname},

program „{$a->program_fullname}“ skončil, nepodařilo se vám ho dokončit.
';
$string['notification_start'] = 'Program zahájen';
$string['notification_start_subject'] = 'Program zahájen';
$string['notification_start_body'] = 'Dobrý den, {$a->user_fullname},

program „{$a->program_fullname}“ začal.
';
$string['notificationdates'] = 'Data oznámení';
$string['notset'] = 'Nenastaveno';
$string['plugindisabled'] = 'Modul plug-in pro registraci programů je zakázán, programy nebudou fungovat.

[Enable plugin now]({$a->url})';
$string['pluginname'] = 'Programy';
$string['pluginname_desc'] = 'Programy jsou navrženy tak, aby umožňovaly vytváření sad kurzů.';
$string['privacy:metadata:field:programid'] = 'ID programu';
$string['privacy:metadata:field:userid'] = 'ID uživatele';
$string['privacy:metadata:field:allocationid'] = 'ID přidělení programu';
$string['privacy:metadata:field:sourceid'] = 'Zdroj přidělení';
$string['privacy:metadata:field:itemid'] = 'ID položky';
$string['privacy:metadata:field:timecreated'] = 'Datum vytvoření';
$string['privacy:metadata:field:timecompleted'] = 'Datum ukončení';

$string['privacy:metadata:table:enrol_programs_allocations'] = 'Informace o přiřazení programu';
$string['privacy:metadata:field:archived'] = 'Je záznam archivován';
$string['privacy:metadata:field:sourcedatajson'] = 'Informace o zdroji přidělení';
$string['privacy:metadata:field:timeallocated'] = 'Datum přidělení programu';
$string['privacy:metadata:field:timestart'] = 'Počáteční datum';
$string['privacy:metadata:field:timedue'] = 'Termín';
$string['privacy:metadata:field:timeend'] = 'Koncové datum';

$string['privacy:metadata:table:enrol_programs_certs_issues'] = 'Problémy s osvědčením o přidělení programu';
$string['privacy:metadata:field:issueid'] = 'ID problému';

$string['privacy:metadata:table:enrol_programs_completions'] = 'Dokončení přidělování programu';

$string['privacy:metadata:table:enrol_programs_evidences'] = 'Informace o dalších důkazech o dokončení';
$string['privacy:metadata:field:evidencejson'] = 'Informace o důkazu o dokončení';
$string['privacy:metadata:field:createdby'] = 'Důkaz vytvořil(a)';

$string['privacy:metadata:table:enrol_programs_requests'] = 'Informace o požadavku na přiřazení';
$string['privacy:metadata:field:datajson'] = 'Informace o požadavku';
$string['privacy:metadata:field:timerequested'] = 'Datum požadavku';
$string['privacy:metadata:field:timerejected'] = 'Datum zamítnutí';
$string['privacy:metadata:field:rejectedby'] = 'Požadavek zamítl(a)';


$string['privacy:metadata:table:enrol_programs_usr_snapshots'] = 'Snímky přidělení programu';
$string['privacy:metadata:field:reason'] = 'Důvod';
$string['privacy:metadata:field:timesnapshot'] = 'Datum snímku';
$string['privacy:metadata:field:snapshotby'] = 'Snímek vytvořil(a)';
$string['privacy:metadata:field:explanation'] = 'Vysvětlení';
$string['privacy:metadata:field:completionsjson'] = 'Informace o dokončení';
$string['privacy:metadata:field:evidencesjson'] = 'Informace o důkazu o dokončení';

$string['program'] = 'Program';
$string['programautofix'] = 'Program automatické opravy';
$string['programdue'] = 'Blížící se termín programu';
$string['programdue_help'] = 'Blížící se termín programu značí, kdy se od uživatelů očekává dokončení programu.';
$string['programdue_delay'] = 'Termín po zahájení';
$string['programdue_date'] = 'Termín';
$string['programend'] = 'Konec programu';
$string['programend_help'] = 'Uživatelé nemohou vstupovat do kurzů programu po jeho ukončení.';
$string['programend_delay'] = 'Konec po zahájení';
$string['programend_date'] = 'Datum ukončení programu';
$string['programcompletion'] = 'Datum dokončení programu';
$string['programidnumber'] = 'Číslo ID programu';
$string['programimage'] = 'Obrázek programu';
$string['programname'] = 'Název programu';
$string['programurl'] = 'Adresa URL programu';
$string['programs'] = 'Programy';
$string['programsactive'] = 'Aktivní';
$string['programsarchived'] = 'Archivováno';
$string['programsarchived_help'] = 'Archivované programy jsou uživatelům skryty a jejich průběh je uzamčen.';
$string['programstart'] = 'Začátek programu';
$string['programstart_help'] = 'Uživatelé nemohou vstupovat do kurzů programu před jeho zahájením.';
$string['programstart_allocation'] = 'Spustit ihned po přidělení';
$string['programstart_delay'] = 'Odložit zahájení po přidělení';
$string['programstart_date'] = 'Datum zahájení programu';
$string['programstatus'] = 'Stav programu';
$string['programstatus_completed'] = 'Dokončeno';
$string['programstatus_any'] = 'Jakýkoli stav programu';
$string['programstatus_archived'] = 'Archivováno';
$string['programstatus_archivedcompleted'] = 'Archivování dokončeno';
$string['programstatus_overdue'] = 'Překročen časový limit';
$string['programstatus_open'] = 'Otevřeno';
$string['programstatus_future'] = 'Dosud neotevřeno';
$string['programstatus_failed'] = 'Nezdařilo se';
$string['programs:addcourse'] = 'Přidat kurz do programů';
$string['programs:allocate'] = 'Přidělit studenty do programů';
$string['programs:delete'] = 'Odstranit programy';
$string['programs:edit'] = 'Přidat a aktualizovat programy';
$string['programs:admin'] = 'Pokročilá správa programu';
$string['programs:manageevidence'] = 'Spravovat další důkazy o dokončení';
$string['programs:view'] = 'Zobrazit správu programu';
$string['programs:viewcatalogue'] = 'Přejít do katalogu programů';
$string['public'] = 'Veřejný';
$string['public_help'] = 'Veřejné programy jsou viditelné pro všechny uživatele.

Stav viditelnosti nemá vliv na již přidělené programy.';
$string['sequencetype'] = 'Typ dokončení';
$string['sequencetype_allinorder'] = 'Vše v pořadí';
$string['sequencetype_allinanyorder'] = 'Vše v libovolném pořadí';
$string['sequencetype_atleast'] = 'Nejméně {$a->min}';
$string['selectcategory'] = 'Vyberte kategorii';
$string['source'] = 'Zdroj';
$string['source_approval'] = 'Požadavky se schválením';
$string['source_approval_allownew'] = 'Povolit schválení';
$string['source_approval_allownew_desc'] = 'Povolit přidávání nových zdrojů _requests with approval_ do programů';
$string['source_approval_allowrequest'] = 'Povolit nové požadavky';
$string['source_approval_confirm'] = 'Potvrďte, že chcete požádat o přidělení do programu.';
$string['source_approval_daterequested'] = 'Datum požadavku';
$string['source_approval_daterejected'] = 'Datum zamítnutí';
$string['source_approval_makerequest'] = 'Požádat o přístup';
$string['source_approval_notification_allocation_subject'] = 'Oznámení o schválení programu';
$string['source_approval_notification_allocation_body'] = 'Dobrý den, {$a->user_fullname},

váš zápis do programu „{$a->program_fullname}“ byl schválen, datum zahájení je {$a->program_startdate}.
';
$string['source_approval_notification_approval_request_subject'] = 'Oznámení o požadavku na program';
$string['source_approval_notification_approval_request_body'] = '
Uživatel {$a->user_fullname} požádal o přístup do programu „{$a->program_fullname}“.
';
$string['source_approval_notification_approval_reject_subject'] = 'Oznámení o zamítnutí požadavku na program';
$string['source_approval_notification_approval_reject_body'] = 'Dobrý den, {$a->user_fullname},

Váš požadavek na přístup do programu „{$a->program_fullname}“ byl zamítnut.

{$a->reason}
';
$string['source_approval_requestallowed'] = 'Požadavky jsou povoleny';
$string['source_approval_requestnotallowed'] = 'Požadavky nejsou povoleny';
$string['source_approval_requests'] = 'Požadavky';
$string['source_approval_requestpending'] = 'Požadavek na přístup není vyřízen';
$string['source_approval_requestrejected'] = 'Požadavek na přístup byl zamítnut';
$string['source_approval_requestapprove'] = 'Schválit požadavek';
$string['source_approval_requestreject'] = 'Zamítnout požadavek';
$string['source_approval_requestdelete'] = 'Odstranit požadavek';
$string['source_approval_rejectionreason'] = 'Důvod zamítnutí';
$string['notification_allocation_subject'] = 'Oznámení o přidělení programu';
$string['notification_allocation_body'] = 'Dobrý den, {$a->user_fullname},

byli jste přiděleni do programu „{$a->program_fullname}“, datum začátku je {$a->program_startdate}.
';
$string['notification_deallocation_subject'] = 'Oznámení o zrušení přidělení programu';
$string['notification_deallocation_body'] = 'Dobrý den, {$a->user_fullname},

vaše přiřazeni do programu „{$a->program_fullname}“ bylo zrušeno.
';
$string['source_cohort'] = 'Automatické přidělení skupiny';
$string['source_cohort_allownew'] = 'Povolit přidělení skupiny';
$string['source_cohort_allownew_desc'] = 'Povolit přidávání nových zdrojů _cohort auto allocation_ do programů';
$string['source_manual'] = 'Ruční přidělování';
$string['source_manual_allocateusers'] = 'Přidělit uživatele';
$string['source_manual_csvfile'] = 'Soubor CSV';
$string['source_manual_hasheaders'] = 'První řádek je záhlaví';
$string['source_manual_potusersmatching'] = 'Odpovídající kandidáti přidělení';
$string['source_manual_potusers'] = 'Kandidáti přidělení';
$string['source_manual_result_assigned'] = 'Počet uživatelů přiřazených do programu: {$a}.';
$string['source_manual_result_errors'] = 'Počet chyb zjištěných při přiřazování programů: {$a}.';
$string['source_manual_result_skipped'] = 'Počet uživatelů již přiřazených do programu: {$a}.';
$string['source_manual_uploadusers'] = 'Nahrát přidělení';
$string['source_manual_usercolumn'] = 'Sloupec identifikace uživatele';
$string['source_manual_usermapping'] = 'Mapování uživatelů prostřednictvím';
$string['source_manual_userupload_allocated'] = 'Přiděleno pro ,{$a}‘';
$string['source_manual_userupload_alreadyallocated'] = 'Již přiděleno pro ,{$a}‘';
$string['source_manual_userupload_invalidprogram'] = 'Nelze přidělit pro ,{$a}‘';
$string['source_selfallocation'] = 'Vlastní přidělení';
$string['source_selfallocation_allocate'] = 'Zapsat se';
$string['source_selfallocation_allownew'] = 'Povolit vlastní přidělení';
$string['source_selfallocation_allownew_desc'] = 'Povolit přidávání nových zdrojů _self allocation_ do programů';
$string['source_selfallocation_allowsignup'] = 'Povolit nové zápisy';
$string['source_selfallocation_confirm'] = 'Potvrďte, že chcete být přiděleni do programu.';
$string['source_selfallocation_enable'] = 'Aktivovat vlastní přidělení';
$string['source_selfallocation_key'] = 'Klíč zápisu';
$string['source_selfallocation_keyrequired'] = 'Klíč zápisu je povinný';
$string['source_selfallocation_maxusers'] = 'Maximum uživatelů';
$string['source_selfallocation_maxusersreached'] = 'Již bylo dosaženo maximálního počtu uživatelů s vlastním přidělením';
$string['source_selfallocation_maxusers_status'] = 'Uživatelé {$a->count}/{$a->max}';
$string['source_selfallocation_notification_allocation_subject'] = 'Oznámení o přidělení programu';
$string['source_selfallocation_notification_allocation_body'] = 'Dobrý den, {$a->user_fullname},

byli jste zapsáni do programu „{$a->program_fullname}“, datum začátku je {$a->program_startdate}.
';
$string['source_selfallocation_signupallowed'] = 'Zápisy jsou povoleny';
$string['source_selfallocation_signupnotallowed'] = 'Zápisy nejsou povoleny';
$string['set'] = 'Sada kurzů';
$string['settings'] = 'Nastavení programu';
$string['scheduling'] = 'Plánování';
$string['taballocation'] = 'Nastavení přidělování';
$string['tabcontent'] = 'Obsah';
$string['tabgeneral'] = 'Obecné';
$string['tabusers'] = 'Uživatelé';
$string['tabvisibility'] = 'Nastavení viditelnosti';
$string['tagarea_program'] = 'Programy';
$string['taskcertificate'] = 'Cron vydávající osvědčení pro programy';
$string['taskcron'] = 'Cron modulů plug-in programů';
$string['unlinkeditems'] = 'Položky se zrušeným propojením';
$string['updateprogram'] = 'Aktualizovat program';
$string['updateallocation'] = 'Aktualizovat přidělení';
$string['updateallocations'] = 'Aktualizovat přidělení';
$string['updateset'] = 'Aktualizovat sadu';
$string['updatescheduling'] = 'Aktualizovat plánování';
$string['updatesource'] = 'Aktualizovat {$a}';
