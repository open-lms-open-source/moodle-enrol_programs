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
$string['archive'] = 'Arkivér';
$string['archived'] = 'Arkiveret';
$string['benefitname'] = '{$a}: Programallokering';
$string['calendarprogramend'] = '{$a} slutter';
$string['calendarprogramdue'] = '{$a} skal afsluttes';
$string['calendarprogramstart'] = '{$a} starter';
$string['catalogue'] = 'Programkatalog';
$string['catalogue_dofilter'] = 'Søg';
$string['catalogue_resetfilter'] = 'Ryd';
$string['catalogue_searchtext'] = 'Søgningstekst';
$string['catalogue_tag'] = 'Filtrer efter tag';
$string['certificatetemplatechoose'] = 'Vælg en skabelon...';
$string['cohorts'] = 'Synlig for kohorter';
$string['cohorts_help'] = 'Programmer, der ikke er offentlige, kan gøres synlige for specificerede kohortemedlemmer.

Synlighedsstatus påvirker ikke allerede allokerede programmer.';
$string['columnusedalready'] = 'Kolonnen er allerede i brug';
$string['completepercent'] = '{$a} % gennemført';
$string['completion'] = 'Udført';
$string['completiondate'] = 'Fuldførelsesdato';
$string['completiondelay'] = 'Forsinkelse af færdiggørelse';
$string['completionoverride'] = 'Tilsidesæt færdiggørelse';
$string['creategroups'] = 'Kursusgrupper';
$string['creategroups_help'] = 'Hvis funktionen er aktiveret, oprettes der en gruppe til hvert kursus, der er føjet til programmet, og alle de allokerede brugere tilføjes som gruppemedlemmer.';
$string['customfields'] = 'Brugerdefinerede felter i programmer';
$string['customfieldsettings'] = 'Almindelige indstillinger for brugerdefinerede programfelter';
$string['customfieldvisibleto'] = 'Feltets indhold kan ses af';
$string['customfieldvisible:allocated'] = 'Brugere allokeret til programmer';
$string['customfieldvisible:everyone'] = 'Alle, der kan se andre programoplysninger';
$string['customfieldvisible:viewcapability'] = 'Brugere, der kan se programmers kapacitet';
$string['deleteallocation'] = 'Slet programallokering';
$string['deletecourse'] = 'Fjern kursus';
$string['deleteprogram'] = 'Slet program';
$string['deleteset'] = 'Slet sæt';
$string['deletetraining'] = 'Fjern undervisning';
$string['documentation'] = 'Programmer til Moodle-dokumentation';
$string['duedate'] = 'Frist';
$string['enrolrole'] = 'Kursusrolle';
$string['enrolrole_desc'] = 'Vælg den rolle, der skal bruges af programmerne med henblik på kursustilmelding';
$string['errorcontentproblem'] = 'Der er registreret et problem i programmets indholdsstruktur, som gør, at programfærdiggørelsen ikke bliver sporet korrekt!';
$string['errorcoursemissing'] = 'Kurset mangler';
$string['errorcoursesmissing'] = 'Manglende kurser: {$a}';
$string['errorinvalidoverridedates'] = 'Tilsidesættelser af ugyldig dato';
$string['errordifferenttenant'] = 'Der er ikke adgang til programmet fra en anden lejer';
$string['errorduplicateprogramid'] = 'Program-id-nummer bruges allerede til et andet program, brug venligst et unikt program-id-nummer';
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
$string['evidencedate'] = 'Dato for færdiggørelse af bevis';
$string['evidenceupdate'] = 'Opdater andre beviser';
$string['evidenceupload'] = 'Upload beviser for færdiggørelse';
$string['evidenceupload_csvfile'] = 'CSV-fil';
$string['evidenceupload_errors'] = 'Der blev registreret {$a} ugyldige rækker';
$string['evidenceupload_skipped'] = '{$a} rækker blev sprunget over';
$string['evidenceupload_updated'] = 'Bevis for færdiggørelse blev opdateret for {$a} bruger';
$string['evidence_details'] = 'Detaljer';
$string['evidence_detailsdefault'] = 'Oplysninger om standard';
$string['export'] = 'Eksportér programmer';
$string['exportfile_info'] = 'info';
$string['exportfile_programs'] = 'programmer';
$string['exportformat'] = 'Filformat';
$string['exportformat_csv'] = 'CSV';
$string['exportformat_json'] = 'JSON';
$string['extra_menu_management_index'] = 'Handlinger for programmer';
$string['extra_menu_management_program_general'] = 'Handlinger for program';
$string['extra_menu_management_program_users'] = 'Brugerhandlinger';
$string['extra_menu_management_program_allocation'] = 'Allokeringshandlinger';
$string['fixeddate'] = 'På en fastsat dato';
$string['idnumbersymbol'] = 'Id-nummer:';
$string['importallocationend'] = 'Allokeringsafslutning ({$a})';
$string['importallocationstart'] = 'Allokeringsstart ({$a})';
$string['importprogramallocation'] = 'Importér programallokering';
$string['importprogramallocationconfirmation'] = 'Du er i færd med at importere allokeringsindstillinger fra program __{$a->fullname} / {$a->idnumber} / {$a->category}__.

Vælg alle de indstillinger, du ønsker at importere.';
$string['importprogramcontent'] = 'Importér programindhold';
$string['importprogramcontentconfirmation'] = 'Du er ved at importere indhold fra program __{$a->fullname} / {$a->idnumber} / {$a->category}__.';
$string['importprogramdue'] = 'Programfrist nået ({$a})';
$string['importprogramend'] = 'Programafslutning ({$a})';
$string['importprogramstart'] = 'Programstart ({$a})';
$string['importselectprogram'] = 'Vælg program';
$string['invalidallocationdates'] = 'Ugyldige datoer for programallokering';
$string['invalidcompletiondate'] = 'Ugyldig dato for programfærdiggørelse';
$string['item'] = 'Element';
$string['itemcompletion'] = 'Programelement færdiggjort';
$string['itempoints'] = 'Point';
$string['itemrecalculate'] = 'Genberegn færdiggørelse af element';
$string['layoutgrid'] = 'Gitterlayout';
$string['layouttable'] = 'Tabellayout';
$string['management'] = 'Programadministration';
$string['messageprovider:allocation_notification'] = 'Notifikation om programallokering';
$string['messageprovider:approval_request_notification'] = 'Notifikation om anmodning om programgodkendelse';
$string['messageprovider:approval_reject_notification'] = 'Notifikation om anmodning om programafvisning';
$string['messageprovider:completion_notification'] = 'Notifikation om programfærdiggørelse';
$string['messageprovider:completion_relateduser_notification'] = 'Notifikation om programfærdiggørelse – relateret bruger';
$string['messageprovider:deallocation_notification'] = 'Notifikation om programfjernelse';
$string['messageprovider:duesoon_notification'] = 'Notifikation om kort tid til fristdato';
$string['messageprovider:duesoon_relateduser_notification'] = 'Notifikation om kort tid til fristdato – relateret bruger';
$string['messageprovider:due_notification'] = 'Rykkernotifikation for program';
$string['messageprovider:due_relateduser_notification'] = 'Rykkernotifikation for program – relateret bruger';
$string['messageprovider:endsoon_notification'] = 'Notifikation om kort tid til programmets slutdato';
$string['messageprovider:endsoon_relateduser_notification'] = 'Notifikation om kort tid til programmets slutdato – relateret bruger';
$string['messageprovider:endcompleted_notification'] = 'Notifikation om afsluttet programfærdiggørelse';
$string['messageprovider:endfailed_notification'] = 'Notifikation om fejl i programafslutning';
$string['messageprovider:endfailed_relateduser_notification'] = 'Notifikation om fejl i programafslutning – relateret bruger';
$string['messageprovider:reset_notification'] = 'Notifikation om programnulstilling';
$string['messageprovider:start_notification'] = 'Notifikation om start af program';
$string['moveitem'] = 'Flyt element';
$string['moveitemcancel'] = 'Annuller flytning';
$string['moveafter'] = 'Flyt "{$a->item}" til efter "{$a->target}"';
$string['movebefore'] = 'Flyt "{$a->item}" til før "{$a->target}"';
$string['moveinto'] = 'Flyt "{$a->item}" ind i "{$a->target}"';
$string['myprograms'] = 'Mine programmer';
$string['notification_allocation'] = 'Bruger allokeret';
$string['notification_allocation_subject'] = 'Notifikation om programallokering';
$string['notification_allocation_body'] = 'Hej {$a->user_fullname}

Du er allokeret til programmet "{$a->program_fullname}". Startdatoen er {$a->program_startdate}.
';
$string['notification_allocation_description'] = 'Notifikation sendt til brugere, når de er allokeret til programmet.';
$string['notification_completion'] = 'Program færdiggjort';
$string['notification_completion_subject'] = 'Program færdiggjort';
$string['notification_completion_body'] = 'Hej {$a->user_fullname}

Du har færdiggjort programmet "{$a->program_fullname}".
';
$string['notification_completion_description'] = 'Notifikation sendt til brugere, når de har færdiggjort deres program.';
$string['notification_completion_relateduser'] = 'Dato for programfærdiggørelse – relateret bruger';
$string['notification_completion_relateduser_subject'] = 'Bruger {$a->user_fullname} har gennemført programmet';
$string['notification_completion_relateduser_body'] = 'Hej {$a->relateduser_fullname}

Bruger {$a->user_fullname} har gennemført programmet "{$a->program_fullname}".
';
$string['notification_completion_relateduser_description'] = 'Notifikation sendt til brugere, der er relateret til brugeren, når vedkommende er færdig med sit program.';
$string['notification_deallocation'] = 'Bruger fjernet';
$string['notification_deallocation_subject'] = 'Notifikation om programfjernelse';
$string['notification_deallocation_body'] = 'Hej {$a->user_fullname}

Du er blevet fjernet fra programmet "{$a->program_fullname}".
';
$string['notification_deallocation_description'] = 'Notifikation sendt til brugere, når deres allokering til programmet er trukket tilbage.';
$string['notification_duesoon'] = 'Kort tid til fristdato for programmet';
$string['notification_duesoon_subject'] = 'Programfærdiggørelse forventes om kort tid';
$string['notification_duesoon_body'] = 'Hej {$a->user_fullname}

Færdiggørelse af programmet "{$a->program_fullname}" forventes den {$a->program_duedate}.
';
$string['notification_duesoon_description'] = 'Notifikation sendt til brugere forud for programmets slutdato, medmindre programmet allerede er gennemført.';
$string['notification_duesoon_relateduser'] = 'Kort tid til fristdato for programmet – relateret bruger';
$string['notification_duesoon_relateduser_subject'] = 'Bruger {$a->user_fullname} forventes at færdiggøre programmet om kort tid';
$string['notification_duesoon_relateduser_body'] = 'Hej {$a->relateduser_fullname}

Bruger {$a->user_fullname} forventes at færdiggøre programmet "{$a->program_fullname}" den {$a->program_duedate}.
';
$string['notification_duesoon_relateduser_description'] = 'Notifikation sendt til brugere med relation til brugeren forud for programmets slutdato, medmindre programmet allerede er gennemført.';
$string['notification_due'] = 'Programfrist overskredet';
$string['notification_due_subject'] = 'Programfærdiggørelsen var forventet';
$string['notification_due_body'] = 'Hej {$a->user_fullname}

Programmet "{$a->program_fullname}" var forventet gennemført før {$a->program_duedate}.
';
$string['notification_due_description'] = 'Notifikation sendt til brugere, når vedkommendes programfrist er overskredet.';
$string['notification_due_relateduser'] = 'Programfrist overskredet – relateret bruger';
$string['notification_due_relateduser_subject'] = 'Bruger {$a->user_fullname} var forventet at færdiggøre programmet';
$string['notification_due_relateduser_body'] = 'Hej {$a->relateduser_fullname}

Bruger {$a->user_fullname} var forventet at færdiggøre programmet "{$a->program_fullname}" før {$a->program_duedate}.
';
$string['notification_due_relateduser_description'] = 'Notifikation sendt til brugere, der er relateret til brugeren, når vedkommendes programfrist er overskredet.';
$string['notification_endsoon'] = 'Kort tid til programmets slutdato';
$string['notification_endsoon_subject'] = 'Programmet slutter snart';
$string['notification_endsoon_body'] = 'Hej {$a->user_fullname}

Program "{$a->program_fullname}" slutter den {$a->program_enddate}.
';
$string['notification_endsoon_description'] = 'Notifikation sendt til brugere forud for programmets slutdato, medmindre programmet allerede er gennemført.';
$string['notification_endsoon_relateduser'] = 'Kort tid til programmets slutdato – relateret bruger';
$string['notification_endsoon_relateduser_subject'] = 'Programmet slutter snart for bruger {$a->user_fullname}';
$string['notification_endsoon_relateduser_body'] = 'Hej {$a->relateduser_fullname}

Program "{$a->program_fullname}” for bruger {$a->user_fullname} slutter den {$a->program_enddate}.
';
$string['notification_endsoon_relateduser_description'] = 'Notifikation sendt til brugere med relation til brugeren forud for programmets slutdato, medmindre programmet allerede er gennemført.';
$string['notification_endcompleted'] = 'Færdiggjort program afsluttet';
$string['notification_endcompleted_subject'] = 'Færdiggjort program afsluttet';
$string['notification_endcompleted_body'] = 'Hej {$a->user_fullname}

Program "{$a->program_fullname}" er afsluttet. Du har tidligere gennemført det.
';
$string['notification_endcompleted_description'] = 'Notifikation sendt til brugere, når deres gennemførte program afsluttes.';
$string['notification_endfailed'] = 'Afslutning af program, der ikke er bestået';
$string['notification_endfailed_subject'] = 'Afslutning af program, der ikke er bestået';
$string['notification_endfailed_body'] = 'Hej {$a->user_fullname}

Program "{$a->program_fullname}" er afsluttet. Du har ikke bestået.
';
$string['notification_endfailed_description'] = 'Notifikation sendt til brugere, når det program, vedkommende ikke har færdiggjort, slutter.';
$string['notification_endfailed_relateduser'] = 'Afslutning af program, der ikke er bestået – relateret bruger';
$string['notification_endfailed_relateduser_subject'] = 'Afslutning af program, der ikke er bestået af bruger {$a->user_fullname}';
$string['notification_endfailed_relateduser_body'] = 'Hej {$a->relateduser_fullname}

Program "{$a->program_fullname}" er afsluttet. Bruger {$a->user_fullname} har ikke bestået det.
';
$string['notification_endfailed_relateduser_description'] = 'Notifikation sendt til brugere med relation til brugeren, når det program, vedkommende ikke har færdiggjort, slutter.';
$string['notification_relateduserfield'] = 'Notifikation for feltet Relateret bruger';
$string['notification_relateduserfield_desc'] = 'Vælg det profilfelt for relaterede brugere, der skal bruges til notifikation af relaterede brugere.';
$string['notification_reset'] = 'Nulstilling af brugerstatus';
$string['notification_reset_subject'] = 'Notifikation om programnulstilling';
$string['notification_reset_body'] = 'Hej {$a->user_fullname}

Din status for programmet "{$a->program_fullname}" blev nulstillet.
';
$string['notification_reset_description'] = 'Notifikation sendt til brugere, når deres programstatus nulstilles.';
$string['notification_start'] = 'Program startet';
$string['notification_start_subject'] = 'Program startet';
$string['notification_start_body'] = 'Hej {$a->user_fullname}

Program "{$a->program_fullname}" er startet.
';
$string['notification_start_description'] = 'Notifikation sendt til brugere, når deres program er startet.';
$string['notificationdates'] = 'Notifikationsdatoer';
$string['notset'] = 'Ikke angivet';
$string['plugindisabled'] = 'Plugin’et til programtilmelding er deaktiveret. Programmerne vil ikke fungere.

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

$string['privacy:metadata:table:enrol_programs_src_commholds'] = 'Reservation af handelsallokering';
$string['privacy:metadata:field:quantity'] = 'Kvantitet';

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
$string['programcompletionoverride'] = 'Tilsidesæt gennemførelse af program';
$string['programidnumber'] = 'Id-nummer for program';
$string['programimage'] = 'Programbillede';
$string['programname'] = 'Programnavn';
$string['programurl'] = 'URL til program';
$string['programs'] = 'Programmer';
$string['programsactive'] = 'Aktiv';
$string['programsarchived'] = 'Arkiveret';
$string['programsarchived_help'] = 'Arkiverede programmer er skjult for brugere, og deres status er låst.';
$string['programslayout'] = 'Programmets detaljerede sidelayout';
$string['programslayout_desc'] = 'Styrer programmernes layout – tabel- eller gittervisning for min/program-siden.';
$string['programslayoutallowuserswitch'] = 'Tillad brugere at skifte programlayout';
$string['programslayoutallowuserswitch_desc'] = 'Tillad brugere at skifte programlayout';
$string['programslayout_desc'] = 'Styrer programmernes layout – tabel- eller gittervisning for min/program-siden.';
$string['programsblocklayout'] = 'Mit programs bloklayout';
$string['programsblocklayout_desc'] = 'Styrer programmernes layout – tabel- eller gittervisning for myprograms-blokken.';

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
$string['programs:addtocertifications'] = 'Føj program til certificeringer';
$string['programs:addtoplan'] = 'Føj program til planer';
$string['programs:allocate'] = 'Alloker studerende til programmer';
$string['programs:archive'] = 'Arkivér programallokeringer';
$string['programs:clone'] = 'Tillad kloning af programindhold og -indstillinger';
$string['programs:configframeworks'] = 'Konfigurer programtilgængelighed i planrammeværk';
$string['programs:configurecustomfields'] = 'Konfigurer brugerdefinerede programfelter';
$string['programs:delete'] = 'Slet programmer';
$string['programs:edit'] = 'Tilføj og opdater programmer';
$string['programs:export'] = 'Eksportér programmer';
$string['programs:admin'] = 'Avanceret programadministration';
$string['programs:manageallocation'] = 'Administrer allokering af brugere';
$string['programs:manageevidence'] = 'Administrer andre færdiggørelsesbeviser';
$string['programs:reset'] = 'Nulstil programstatus';
$string['programs:upload'] = 'Upload programmer';
$string['programs:view'] = 'Vis programadministration';
$string['programs:viewcatalogue'] = 'Få adgang til programkataloget';
$string['public'] = 'Offentlig';
$string['public_help'] = 'Offentlige programmer er synlige for alle brugere.

Synlighedsstatus påvirker ikke allerede allokerede programmer.';
$string['purchaseaccess'] = 'Tilkøb adgang';
$string['resetallocation'] = 'Nulstil programstatus';
$string['resettype'] = 'Nulstillingstype';
$string['resettype_deallocate'] = 'Kun til tilbagetrækning af programallokering';
$string['resettype_full'] = 'Komplet rydning af kurser';
$string['resettype_none'] = 'Ingen';
$string['resettype_standard'] = 'Standardrydning af kurser';
$string['sequencetype'] = 'Gennemførelsestype';
$string['sequencetype_allinorder'] = 'Alt i rækkefølge';
$string['sequencetype_allinanyorder'] = 'Alt i enhver rækkefølge';
$string['sequencetype_atleast'] = 'Mindst {$a->min}';
$string['sequencetype_minpoints'] = 'Mindst {$a->minpoints} point';
$string['selectcategory'] = 'Vælg kategori';
$string['sortbyprogramname'] = 'Sortér efter programnavn';
$string['sortbyprogramid'] = 'Sortér efter program-id';
$string['sortbyprogramstart'] = 'Sortér efter programmets startdato';
$string['sortbyprogramdue'] = 'Sortér efter programmets forfaldsdato';
$string['sortbyprogramend'] = 'Sortér efter programmets slutdato';
$string['source'] = 'Kilde';
$string['source_approval'] = 'Anmodninger med godkendelse';
$string['source_approval_allownew'] = 'Tillad godkendelser';
$string['source_approval_allownew_desc'] = 'Tillad tilføjelse af nye _requests with approval_-kilder til programmer';
$string['source_approval_allowrequest'] = 'Tillad nye anmodninger';
$string['source_approval_confirm'] = 'Bekræft venligst, at du ønsker at anmode om allokering til programmet.';
$string['source_approval_daterequested'] = 'Dato for anmodning';
$string['source_approval_daterejected'] = 'Dato afvist';
$string['source_approval_makerequest'] = 'Anmod om adgang';
$string['source_approval_notification_approval_request_subject'] = 'Notifikation om programanmodning';
$string['source_approval_notification_approval_request_body'] = '
Bruger {$a->user_fullname} har anmodet om adgang til programmet "{$a->program_fullname}".
';
$string['source_approval_notification_approval_reject_subject'] = 'Notifikation om anmodning om programafvisning';
$string['source_approval_notification_approval_reject_body'] = 'Hej {$a->user_fullname}

Din anmodning om adgang til programmet "{$a->program_fullname}" blev afvist.

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
$string['source_certify'] = 'Certifikater';
$string['source_certify_allownew'] = 'Tillad allokering af certificeringer';
$string['source_certify_allownew_desc'] = 'Tillad tilføjelse af nye _certification_-kilder til programmer';
$string['source_cohort'] = 'Automatisk kohorteallokering';
$string['source_cohort_allownew'] = 'Tillad kohorteallokering';
$string['source_cohort_allownew_desc'] = 'Tillad tilføjelse af ny _cohort auto allocation_-kilder til programmer';
$string['source_cohort_cohortstoallocate'] = 'Allokering af kohorter';
$string['source_ecommerce'] = 'Allokering af e-handel';
$string['source_ecommerce_allownew'] = 'Tillad allokering af e-handel';
$string['source_ecommerce_allownew_desc'] = 'Tillad tilføjelse af nye automatisk allokering af e-handel-kilder til programmer';
$string['source_ecommerce_allowsignup'] = 'Tillad nye allokeringer';
$string['source_ecommerce_cohortmembershiprequirement'] = 'Brugere skal være medlem af én af følgende kohorter: {$a}';
$string['source_ecommerce_maxusers'] = 'Maks. brugere';
$string['source_ecommerce_nocapacity'] = 'Der er ikke mere plads i dette program';
$string['source_manual'] = 'Manuel tildeling';
$string['source_manual_allocateusers'] = 'Alloker brugere';
$string['source_manual_csvfile'] = 'CSV-fil';
$string['source_manual_hasheaders'] = 'Første linje er en overskrift';
$string['source_manual_potusersmatching'] = 'Matchende allokeringskandidater';
$string['source_manual_potusers'] = 'Allokeringskandidater';
$string['source_manual_result_assigned'] = '{$a} brugere blev tildelt til programmet.';
$string['source_manual_result_errors'] = 'Der blev registreret {$a} fejl under tildeling af programmer.';
$string['source_manual_result_skipped'] = '{$a} brugere var allerede tildelt til programmet.';
$string['source_manual_timeduecolumn'] = 'Kolonnen Tidsfrist';
$string['source_manual_timeendcolumn'] = 'Kolonnen Sluttidspunkt';
$string['source_manual_timestartcolumn'] = 'Kolonnen Starttidspunkt';
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
$string['source_selfallocation_signupallowed'] = 'Tilmeldinger er tilladt';
$string['source_selfallocation_signupnotallowed'] = 'Tilmeldinger er ikke tilladt';
$string['source_udplans'] = 'Brugerudviklingsplaner';
$string['source_udplans_allownew'] = 'Brugerudviklingsplaner';
$string['source_udplans_allownew_desc'] = 'Tillad tilføjelse af nye _user development plans_-kilder til programmer';
$string['source_udplans_allowed'] = 'Tilladt';
$string['source_udplans_noframeworks'] = 'Kan ikke føjes til nogen plan';
$string['source_udplans_notallowed'] = 'Ikke tilladt';
$string['source_udplans_requirecap'] = 'Tilføj påkrævet kompetence';
$string['set'] = 'Kursussæt';
$string['settings'] = 'Programindstillinger';
$string['scheduling'] = 'Planlægning';
$string['taballocation'] = 'Tildelingsindstillinger';
$string['tabcontent'] = 'Indhold';
$string['tabgeneral'] = 'Generelt';
$string['tabusers'] = 'Brugere';
$string['tabvisibility'] = 'Synlighedsindstillinger';
$string['tagarea_enrol_programs_programs'] = 'Programmer';
$string['taskcertificate'] = 'Cron til udstedelse af programcertifikater';
$string['taskcron'] = 'Cron til programplugin';
$string['training'] = 'Undervisning';
$string['trainingcompletion'] = 'Obligatorisk undervisning: {$a}';
$string['trainingprogress'] = 'Undervisningsstatus: {$a->current}/{$a->total}';
$string['unarchive'] = 'Gendan';
$string['unlinkeditems'] = 'Uforbundne elementer';
$string['updateprogram'] = 'Opdater program';
$string['updateallocation'] = 'Opdater allokering';
$string['updateallocations'] = 'Opdater allokeringer';
$string['updatecourse'] = 'Opdater kursus';
$string['updateset'] = 'Opdater sæt';
$string['updatescheduling'] = 'Opdater tidsplan';
$string['updatesource'] = 'Opdaterer {$a}';
$string['updatetraining'] = 'Opdater undervisning';
$string['upload'] = 'Upload programmer';
$string['upload_invalidcount'] = 'Ugyldige poster';
$string['upload_files'] = 'Filer';
$string['upload_files_error'] = 'Der forventes flere CSV-filer, én JSON-fil eller ét zip-arkiv';
$string['upload_preview'] = 'Eksempelvisning af data';
$string['upload_status'] = 'Status';
$string['upload_status_invalid'] = 'Ugyldig';
$string['upload_targetcontext'] = 'Føj programmer til kontekst';
$string['upload_uploadcount'] = 'Programmer, der skal uploades';
$string['upload_usecategory'] = 'Brug kategorikolonne til kontekster';
$string['userupload_completion_error'] = 'Programgennemførelse kan ikke opdateres';
$string['userupload_completion_updated'] = 'Programgennemførelse blev opdateret';

$string['rb_allocatedprograms'] = 'Allokerede programmer';
$string['rb_complete'] = 'Udført';
$string['rb_completiondate'] = 'Færdiggørelsesdato';
$string['rb_completionstatus'] = 'Færdiggørelsesstatus';
$string['rb_datecompleted'] = 'Færdiggørelsesdato';
$string['rb_dateallocated'] = 'Dato for allokering';
$string['rb_datestarted'] = 'Startdato';
$string['rb_coursesall'] = 'Kursus eller kurser – Alle';
$string['rb_incomplete'] = 'Ikke fuldført';
$string['rb_isallocated'] = 'Er allokeret';
$string['rb_iscomplete'] = 'Er gennemført?';
$string['rb_iscompleteany'] = 'Er gennemført? (vilkårlig metode)';
$string['rb_isinprogress'] = 'Er i gang?';
$string['rb_isnotcomplete'] = 'Er ikke gennemført?';
$string['rb_isnotyetstarted'] = 'Er endnu ikke påbegyndt?';
$string['rb_notstarted'] = 'Ikke påbegyndt';
$string['rb_officewhencompletedbasic'] = 'Kontor, når gennemført (grundlæggende)';
$string['rb_privacy:metadata'] = 'Plugin\'et gemmer ingen personlige oplysninger.';
$string['rb_programcategory'] = 'Programkategori (eller websted)';
$string['rb_programcategoryid'] = 'Programkategoriens id (I/R hvis websted)';
$string['rb_programcategoryidnumber'] = 'Programkategoriens id-nummer (I/R hvis websted)';
$string['rb_programcategorymultichoice'] = 'Programkategori (flere valgmuligheder)';
$string['rb_programedatecreated'] = 'Dato for oprettelse af program';
$string['rb_programduedate'] = 'Programmets forfaldsdato';
$string['rb_programenddate'] = 'Slutdato for programallokering';
$string['rb_programallocationtype'] = 'Allokeringstype';
$string['rb_programallocationtypes'] = 'Allokeringstyper';
$string['rb_programexpandlink'] = 'Programnavn (oplysninger udvides)';
$string['rb_programid'] = 'Program-id';
$string['rb_programidnumber'] = 'Program-id-nummer';
$string['rb_programname'] = 'Programnavn';
$string['rb_programnameandsummary'] = 'Programnavn og -beskrivelse';
$string['rb_programnamelinked'] = 'Programnavn (link til programside)';
$string['rb_programmultiitem'] = 'Program (flere elementer)';
$string['rb_programsingleitem'] = 'Program';
$string['rb_programstartdate'] = 'Startdato for programallokering';
$string['rb_programsummary'] = 'Programbeskrivelse';
$string['rb_programvisible'] = 'Programmet er offentligt tilgængeligt';
$string['rb_programvisibledisabled'] = 'Programmet er synligt (ikke relevant)';
$string['rb_progress'] = 'Fremskridt';
$string['rb_progressnumeric'] = 'Status (talværdi)';
$string['rb_progresspercent'] = 'Status (% gennemført)';
$string['rb_source_allocation'] = 'Programallokering';
$string['rb_timetocompletesinceenrol'] = 'Færdiggørelsestid (siden allokeringsdato)';
$string['rb_timetocompletesincestart'] = 'Færdiggørelsestid (siden startdato)';
$string['rb_type_program'] = 'Program';
$string['rb_type_program_category'] = 'Kategori';
$string['rb_type_program_completion'] = 'Programallokering';
$string['rb_type_program_customfields'] = 'Brugerdefinerede programfelter';
$string['rb_user'] = 'Brugeren';
$string['rb_viewprogram'] = 'Vis program';
$string['rb_visiblecohorts'] = 'Kohorter, der kan få vist programmet';
