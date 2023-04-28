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

$string['addprogram'] = 'Tilføj program';
$string['addset'] = 'Tilføj nyt sæt';
$string['allocationend'] = 'Allokeringsafslutning';
$string['allocationend_help'] = 'Betydningen af slutdatoen for allokering afhænger af de aktiverede allokeringskilder. Det er normalt ikke muligt at foretage en ny allokering efter denne dato, hvis den er specificeret.';
$string['allocation'] = 'Allokering';
$string['allocations'] = 'Allokeringer';
$string['programallocations'] = 'Programallokering';
$string['allocationdate'] = 'Allokeringsdato';
$string['allocationsources'] = 'Allokeringskilder';
$string['allocationstart'] = 'Allokeringsstart';
$string['allocationstart_help'] = 'Betydningen af startdatoen for allokering afhænger af de aktiverede allokeringskilder. Det er normalt kun muligt at foretage nye allokeringer efter denne dato, hvis den er specificeret.';
$string['allprograms'] = 'Alle programmer';
$string['appenditem'] = 'Vedhæft element';
$string['appendinto'] = 'Vedhæft i element';
$string['archived'] = 'Arkiveret';
$string['catalogue'] = 'Programkatalog';
$string['catalogue_dofilter'] = 'Søg';
$string['catalogue_resetfilter'] = 'Ryd';
$string['catalogue_searchtext'] = 'Søgningstekst';
$string['catalogue_tag'] = 'Filtrer efter tag';
$string['certificatetemplatechoose'] = 'Vælg en skabelon...';
$string['cohorts'] = 'Synlig for kohorter';
$string['cohorts_help'] = 'Programmer, der ikke er offentlige, kan gøres synlige for specificerede kohortemedlemmer.

Synlighedsstatus påvirker ikke allerede allokerede programmer.';
$string['completiondate'] = 'Fuldførelsesdato';
$string['creategroups'] = 'Kursusgrupper';
$string['creategroups_help'] = 'Hvis funktionen er aktiveret, oprettes der en gruppe til hvert kursus, der er føjet til programmet, og alle de allokerede brugere tilføjes som gruppemedlemmer.';
$string['deleteallocation'] = 'Slet programallokering';
$string['deletecourse'] = 'Fjern kursus';
$string['deleteprogram'] = 'Slet program';
$string['deleteset'] = 'Slet sæt';
$string['documentation'] = 'Programmer til Moodle-dokumentation';
$string['duedate'] = 'Frist';
$string['enrolrole'] = 'Kursusrolle';
$string['enrolrole_desc'] = 'Vælg den rolle, der skal bruges af programmerne med henblik på kursustilmelding';
$string['errorcontentproblem'] = 'Der er registreret et problem i programmets indholdsstruktur, som gør, at programfærdiggørelsen ikke bliver sporet korrekt!';
$string['errordifferenttenant'] = 'Der er ikke adgang til programmet fra en anden lejer';
$string['errornoallocations'] = 'Ingen brugerallokeringer blev fundet';
$string['errornoallocation'] = 'Programmet er ikke allokeret';
$string['errornomyprograms'] = 'Du er ikke allokeret til nogen programmer.';
$string['errornoprograms'] = 'Der blev ikke fundet nogen programmer.';
$string['errornorequests'] = 'Der blev ikke fundet nogen programanmodninger';
$string['errornotenabled'] = 'Programpluginet er ikke aktiveret';
$string['event_program_completed'] = 'Program færdiggjort';
$string['event_program_created'] = 'Program oprettet';
$string['event_program_deleted'] = 'Program slettet';
$string['event_program_updated'] = 'Program opdateret';
$string['event_program_viewed'] = 'Program blev vist';
$string['event_user_allocated'] = 'Bruger allokeret til programmet';
$string['event_user_deallocated'] = 'Bruger fjernet fra programmet';
$string['evidence'] = 'Andet bevis';
$string['evidence_details'] = 'Detaljer';
$string['fixeddate'] = 'På en fastsat dato';
$string['item'] = 'Element';
$string['itemcompletion'] = 'Programelement færdiggjort';
$string['management'] = 'Programadministration';
$string['messageprovider:allocation_notification'] = 'Notifikation om programallokering';
$string['messageprovider:approval_request_notification'] = 'Notifikation om anmodning om programgodkendelse';
$string['messageprovider:approval_reject_notification'] = 'Notifikation om anmodning om programafvisning';
$string['messageprovider:completion_notification'] = 'Notifikation om programfærdiggørelse';
$string['messageprovider:deallocation_notification'] = 'Notifikation om programfjernelse';
$string['messageprovider:duesoon_notification'] = 'Notifikation om kort tid til fristdato';
$string['messageprovider:due_notification'] = 'Rykkernotifikation for program';
$string['messageprovider:endsoon_notification'] = 'Notifikation om kort tid til programmets slutdato';
$string['messageprovider:endcompleted_notification'] = 'Notifikation om afsluttet programfærdiggørelse';
$string['messageprovider:endfailed_notification'] = 'Notifikation om fejl i programafslutning';
$string['messageprovider:start_notification'] = 'Notifikation om start af program';
$string['moveitem'] = 'Flyt element';
$string['moveitemcancel'] = 'Annuller flytning';
$string['moveafter'] = 'Flyt "{$a->item}" efter "{$a->target}"';
$string['movebefore'] = 'Flyt "{$a->item}" før "{$a->target}"';
$string['moveinto'] = 'Flyt "{$a->item}" til "{$a->target}"';
$string['myprograms'] = 'Mine programmer';
$string['notification_allocation'] = 'Bruger allokeret';
$string['notification_completion'] = 'Program færdiggjort';
$string['notification_completion_subject'] = 'Program færdiggjort';
$string['notification_completion_body'] = 'Hej {$a->user_fullname},

du har færdiggjort programmet "{$a->program_fullname}".
';
$string['notification_deallocation'] = 'Bruger fjernet';
$string['notification_duesoon'] = 'Kort tid til fristdato for programmet';
$string['notification_duesoon_subject'] = 'Programfærdiggørelse forventes om kort tid';
$string['notification_duesoon_body'] = 'Hej {$a->user_fullname},

programfærdiggørelse "{$a->program_fullname}" forventes den {$a->program_duedate}.
';
$string['notification_due'] = 'Programfrist overskredet';
$string['notification_due_subject'] = 'Programfærdiggørelsen var forventet';
$string['notification_due_body'] = 'Hej {$a->user_fullname},

programfærdiggørelse "{$a->program_fullname}" var forventet før {$a->program_duedate}.
';
$string['notification_endsoon'] = 'Kort tid til programmets slutdato';
$string['notification_endsoon_subject'] = 'Programmet slutter snart';
$string['notification_endsoon_body'] = 'Hej {$a->user_fullname},

program "{$a->program_fullname}" slutter den {$a->program_enddate}.
';
$string['notification_endcompleted'] = 'Færdiggjort program afsluttet';
$string['notification_endcompleted_subject'] = 'Færdiggjort program afsluttet';
$string['notification_endcompleted_body'] = 'Hej {$a->user_fullname},

program "{$a->program_fullname}" er afsluttet. Du har færdiggjort det tidligere.
';
$string['notification_endfailed'] = 'Afslutning af program, der ikke er bestået';
$string['notification_endfailed_subject'] = 'Afslutning af program, der ikke er bestået';
$string['notification_endfailed_body'] = 'Hej {$a->user_fullname},

program "{$a->program_fullname}" er afsluttet. Du har ikke været i stand til at færdiggøre det.
';
$string['notification_start'] = 'Program startet';
$string['notification_start_subject'] = 'Program startet';
$string['notification_start_body'] = 'Hej {$a->user_fullname},

program "{$a->program_fullname}" er startet.
';
$string['notificationdates'] = 'Notifikationsdatoer';
$string['notset'] = 'Ikke angivet';
$string['plugindisabled'] = 'Pluginet til programtilmelding er deaktiveret. Programmerne vil ikke virke.

[Enable plugin now]({$a->url})';
$string['pluginname'] = 'Programmer';
$string['pluginname_desc'] = 'Programmerne er designet til at tillade oprettelse af kursussæt.';
$string['privacy:metadata:field:programid'] = 'Program-id';
$string['privacy:metadata:field:userid'] = 'Bruger-id';
$string['privacy:metadata:field:allocationid'] = 'Id for programallokering';
$string['privacy:metadata:field:sourceid'] = 'Allokeringskilde';
$string['privacy:metadata:field:itemid'] = 'Element-id';
$string['privacy:metadata:field:timecreated'] = 'Oprettelsesdato';
$string['privacy:metadata:field:timecompleted'] = 'Fuldførelsesdato';

$string['privacy:metadata:table:enrol_programs_allocations'] = 'Oplysninger om programallokeringer';
$string['privacy:metadata:field:archived'] = 'Er posten arkiveret';
$string['privacy:metadata:field:sourcedatajson'] = 'Oplysninger om allokeringskilden';
$string['privacy:metadata:field:timeallocated'] = 'Dato for programallokering';
$string['privacy:metadata:field:timestart'] = 'Startdato';
$string['privacy:metadata:field:timedue'] = 'Frist';
$string['privacy:metadata:field:timeend'] = 'Slutdato';

$string['privacy:metadata:table:enrol_programs_certs_issues'] = 'Certifikatudstedelser for programallokeringer';
$string['privacy:metadata:field:issueid'] = 'Udstedelses-id';

$string['privacy:metadata:table:enrol_programs_completions'] = 'Gennemførelse af programallokeringer';

$string['privacy:metadata:table:enrol_programs_evidences'] = 'Oplysninger om andre beviser for færdiggørelser';
$string['privacy:metadata:field:evidencejson'] = 'Oplysninger om færdiggørelsesbeviser';
$string['privacy:metadata:field:createdby'] = 'Bevis oprettet af';

$string['privacy:metadata:table:enrol_programs_requests'] = 'Oplysninger om allokeringsanmodning';
$string['privacy:metadata:field:datajson'] = 'Oplysninger om anmodningen';
$string['privacy:metadata:field:timerequested'] = 'Anmodningsdato';
$string['privacy:metadata:field:timerejected'] = 'Afvisningsdato';
$string['privacy:metadata:field:rejectedby'] = 'Anmodning afvist af';


$string['privacy:metadata:table:enrol_programs_usr_snapshots'] = 'Snapshots af programallokering';
$string['privacy:metadata:field:reason'] = 'Årsag';
$string['privacy:metadata:field:timesnapshot'] = 'Snapshotdato';
$string['privacy:metadata:field:snapshotby'] = 'Snapshot taget af';
$string['privacy:metadata:field:explanation'] = 'Forklaring';
$string['privacy:metadata:field:completionsjson'] = 'Oplysninger om færdiggørelse';
$string['privacy:metadata:field:evidencesjson'] = 'Oplysninger om færdiggørelsesbeviser';

$string['program'] = 'Program';
$string['programautofix'] = 'Reparer program automatisk';
$string['programdue'] = 'Programfrist nået';
$string['programdue_help'] = 'Programmets fristdato angiver, hvornår brugerne forventes at færdiggøre programmet.';
$string['programdue_delay'] = 'Fristen efter start';
$string['programdue_date'] = 'Frist';
$string['programend'] = 'Programafslutning';
$string['programend_help'] = 'Brugere kan ikke indtaste programkurser efter programmets afslutning.';
$string['programend_delay'] = 'Afsluttes efter start';
$string['programend_date'] = 'Slutdato for programmet';
$string['programcompletion'] = 'Dato for programgennemførelse';
$string['programidnumber'] = 'Id-nummer for program';
$string['programimage'] = 'Programbillede';
$string['programname'] = 'Programnavn';
$string['programurl'] = 'URL til program';
$string['programs'] = 'Programmer';
$string['programsactive'] = 'Aktiv';
$string['programsarchived'] = 'Arkiveret';
$string['programsarchived_help'] = 'Arkiverede programmer er skjult for brugere, og deres status er låst.';
$string['programstart'] = 'Programstart';
$string['programstart_help'] = 'Brugere kan ikke indtaste programkurser før programstart.';
$string['programstart_allocation'] = 'Øjeblikkelig start efter allokering';
$string['programstart_delay'] = 'Udsæt start efter allokering';
$string['programstart_date'] = 'Startdato for program';
$string['programstatus'] = 'Programstatus';
$string['programstatus_completed'] = 'Gennemført';
$string['programstatus_any'] = 'Enhver programstatus';
$string['programstatus_archived'] = 'Arkiveret';
$string['programstatus_archivedcompleted'] = 'Arkivering gennemført';
$string['programstatus_overdue'] = 'Overskredet';
$string['programstatus_open'] = 'Åbn';
$string['programstatus_future'] = 'Ikke åben endnu';
$string['programstatus_failed'] = 'Mislykkedes';
$string['programs:addcourse'] = 'Føj kursus til programmer';
$string['programs:allocate'] = 'Alloker studerende til programmer';
$string['programs:delete'] = 'Slet programmer';
$string['programs:edit'] = 'Tilføj og opdater programmer';
$string['programs:admin'] = 'Avanceret programadministration';
$string['programs:manageevidence'] = 'Administrer andre færdiggørelsesbeviser';
$string['programs:view'] = 'Vis programadministration';
$string['programs:viewcatalogue'] = 'Få adgang til programkataloget';
$string['public'] = 'Offentlig';
$string['public_help'] = 'De offentlige programmer er synlige for alle brugere.

Synlighedsstatus påvirker ikke allerede allokerede programmer.';
$string['sequencetype'] = 'Gennemførelsestype';
$string['sequencetype_allinorder'] = 'Alt i rækkefølge';
$string['sequencetype_allinanyorder'] = 'Alt i enhver rækkefølge';
$string['sequencetype_atleast'] = 'Mindst {$a->min}';
$string['selectcategory'] = 'Vælg kategori';
$string['source'] = 'Kilde';
$string['source_approval'] = 'Anmodninger med godkendelse';
$string['source_approval_allownew'] = 'Tillad godkendelser';
$string['source_approval_allownew_desc'] = 'Tillad tilføjelse af nye _requests with approval_-kilder til programmer';
$string['source_approval_allowrequest'] = 'Tillad nye anmodninger';
$string['source_approval_confirm'] = 'Bekræft venligst, at du ønsker at anmode om allokering til programmet.';
$string['source_approval_daterequested'] = 'Dato for anmodning';
$string['source_approval_daterejected'] = 'Dato afvist';
$string['source_approval_makerequest'] = 'Anmod om adgang';
$string['source_approval_notification_allocation_subject'] = 'Notifikation om programgodkendelse';
$string['source_approval_notification_allocation_body'] = 'Hej {$a->user_fullname},

din tilmelding til programmet "{$a->program_fullname}" blev godkendt, startdatoen er {$a->program_startdate}.
';
$string['source_approval_notification_approval_request_subject'] = 'Notifikation om programanmodning';
$string['source_approval_notification_approval_request_body'] = '
Bruger {$a->user_fullname} har anmodet om adgang til programmet "{$a->program_fullname}".
';
$string['source_approval_notification_approval_reject_subject'] = 'Notifikation om anmodning om programafvisning';
$string['source_approval_notification_approval_reject_body'] = 'Hej {$a->user_fullname},

din anmodning om adgang til "{$a->program_fullname}" programmet blev afvist.

{$a->reason}
';
$string['source_approval_requestallowed'] = 'Anmodninger er tilladt';
$string['source_approval_requestnotallowed'] = 'Anmodninger er ikke tilladt';
$string['source_approval_requests'] = 'Anmodninger';
$string['source_approval_requestpending'] = 'Afventer adgangsanmodning';
$string['source_approval_requestrejected'] = 'Adgangsanmodning blev afvist';
$string['source_approval_requestapprove'] = 'Godkend anmodning';
$string['source_approval_requestreject'] = 'Afvis anmodning';
$string['source_approval_requestdelete'] = 'Slet anmodning';
$string['source_approval_rejectionreason'] = 'Afvisningsårsag';
$string['notification_allocation_subject'] = 'Notifikation om programallokering';
$string['notification_allocation_body'] = 'Hej {$a->user_fullname},

du er allokeret til programmet "{$a->program_fullname}". Startdatoen er {$a->program_startdate}.
';
$string['notification_deallocation_subject'] = 'Notifikation om programfjernelse';
$string['notification_deallocation_body'] = 'Hej {$a->user_fullname},

du er fjernet fra programmet "{$a->program_fullname}".
';
$string['source_cohort'] = 'Automatisk kohorteallokering';
$string['source_cohort_allownew'] = 'Tillad kohorteallokering';
$string['source_cohort_allownew_desc'] = 'Tillad tilføjelse af ny _cohort auto allocation_-kilder til programmer';
$string['source_manual'] = 'Manuel tildeling';
$string['source_manual_allocateusers'] = 'Alloker brugere';
$string['source_manual_csvfile'] = 'CSV-fil';
$string['source_manual_hasheaders'] = 'Første linje er en overskrift';
$string['source_manual_potusersmatching'] = 'Matchende allokeringskandidater';
$string['source_manual_potusers'] = 'Allokeringskandidater';
$string['source_manual_result_assigned'] = '{$a} brugere blev tildelt programmet.';
$string['source_manual_result_errors'] = '{$a} der blev registreret fejl under tildeling af programmer.';
$string['source_manual_result_skipped'] = '{$a} brugere var allerede tildelt programmet.';
$string['source_manual_uploadusers'] = 'Upload allokeringer';
$string['source_manual_usercolumn'] = 'Kolonne til brugeridentificering';
$string['source_manual_usermapping'] = 'Brugermapping gennem';
$string['source_manual_userupload_allocated'] = 'Allokeret til \'{$a}\'';
$string['source_manual_userupload_alreadyallocated'] = 'Allerede allokeret til \'{$a}\'';
$string['source_manual_userupload_invalidprogram'] = 'Kan ikke allokere til \'{$a}\'';
$string['source_selfallocation'] = 'Selvallokering';
$string['source_selfallocation_allocate'] = 'Tilmeld dig';
$string['source_selfallocation_allownew'] = 'Tillad selvallokering';
$string['source_selfallocation_allownew_desc'] = 'Tillad tilføjelse af nye _selvallokering_ kilder til programmer';
$string['source_selfallocation_allowsignup'] = 'Tillad nye tilmeldinger';
$string['source_selfallocation_confirm'] = 'Bekræft venligst, at du ønsker at blive allokeret til programmet.';
$string['source_selfallocation_enable'] = 'Aktivér selvallokering';
$string['source_selfallocation_key'] = 'Tilmeldingsnøgle';
$string['source_selfallocation_keyrequired'] = 'Tilmeldingsnøgle er påkrævet';
$string['source_selfallocation_maxusers'] = 'Maks. brugere';
$string['source_selfallocation_maxusersreached'] = 'Det maksimale antal selvallokerede brugere er allerede nået';
$string['source_selfallocation_maxusers_status'] = 'Brugere {$a->count}/{$a->max}';
$string['source_selfallocation_notification_allocation_subject'] = 'Notifikation om programallokering';
$string['source_selfallocation_notification_allocation_body'] = 'Hej {$a->user_fullname},

du har tilmeldt dig programmet "{$a->program_fullname}", startdatoen er {$a->program_startdate}.
';
$string['source_selfallocation_signupallowed'] = 'Tilmeldinger er tilladt';
$string['source_selfallocation_signupnotallowed'] = 'Tilmeldinger er ikke tilladt';
$string['set'] = 'Kursussæt';
$string['settings'] = 'Programindstillinger';
$string['scheduling'] = 'Planlægning';
$string['taballocation'] = 'Tildelingsindstillinger';
$string['tabcontent'] = 'Indhold';
$string['tabgeneral'] = 'Generelt';
$string['tabusers'] = 'Brugere';
$string['tabvisibility'] = 'Synlighedsindstillinger';
$string['tagarea_program'] = 'Programmer';
$string['taskcertificate'] = 'Cron til udstedelse af programcertifikater';
$string['taskcron'] = 'Cron til programplugin';
$string['unlinkeditems'] = 'Uforbundne elementer';
$string['updateprogram'] = 'Opdater program';
$string['updateallocation'] = 'Opdater allokering';
$string['updateallocations'] = 'Opdater allokeringer';
$string['updateset'] = 'Opdater sæt';
$string['updatescheduling'] = 'Opdater tidsplan';
$string['updatesource'] = 'Opdater {$a}';
