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

$string['addprogram'] = 'Lisää ohjelma';
$string['addset'] = 'Lisää uusi kokoelma';
$string['allocationend'] = 'Kohdistus päättyy';
$string['allocationend_help'] = 'Kohdistuksen päättymispäivän merkitys riippuu käyttöön otetuista kohdistusten lähteistä. Uudet kohdistukset eivät yleensä ole mahdollisia tämän päivämäärän jälkeen, jos se on määritetty.';
$string['allocation'] = 'Kohdistus';
$string['allocations'] = 'Kohdistukset';
$string['programallocations'] = 'Ohjelmien kohdistukset';
$string['allocationdate'] = 'Kohdistuspäivä';
$string['allocationsources'] = 'Kohdistusten lähteet';
$string['allocationstart'] = 'Kohdistus alkaa';
$string['allocationstart_help'] = 'Kohdistuksen alkamispäivän merkitys riippuu käyttöön otetuista kohdistusten lähteistä. Uudet kohdistukset ovat yleensä mahdollisia vain tämän päivämäärän jälkeen, jos se on määritetty.';
$string['allprograms'] = 'Kaikki ohjelmat';
$string['appenditem'] = 'Lisää kohde';
$string['appendinto'] = 'Lisää kohteeseen';
$string['archive'] = 'Arkistoi';
$string['archived'] = 'Arkistoitu';
$string['benefitname'] = '{$a}: ohjelman kohdistus';
$string['calendarprogramend'] = '{$a} päättyy';
$string['calendarprogramdue'] = '{$a}: määräaika umpeutuu';
$string['calendarprogramstart'] = '{$a} alkaa';
$string['catalogue'] = 'Ohjelmakatalogi';
$string['catalogue_dofilter'] = 'Haku';
$string['catalogue_resetfilter'] = 'Tyhjennä';
$string['catalogue_searchtext'] = 'Tekstihaku';
$string['catalogue_tag'] = 'Suodata tunnisteella';
$string['certificatetemplatechoose'] = 'Käytä mallipohjaa...';
$string['cohorts'] = 'Näkyvissä kohorteille';
$string['cohorts_help'] = 'Ei-julkiset ohjelmat voi tuoda määritettyjen kohorttien jäsenten näkyville.

Näkyvyyden tila ei vaikuta jo kohdistettuihin ohjelmiin.';
$string['columnusedalready'] = 'Sarake on jo käytetty';
$string['completepercent'] = '{$a} % valmiina';
$string['completion'] = 'Suoritus';
$string['completiondate'] = 'Suorituspäivämäärä';
$string['completiondelay'] = 'Suorituksen viive';
$string['completionoverride'] = 'Kumoa suoritus';
$string['creategroups'] = 'Kurssiryhmät';
$string['creategroups_help'] = 'Jos käytössä, ryhmä luodaan kuhunkin ohjelmaan lisättyyn kurssiin, ja kohdistetut käyttäjät lisätään ryhmän jäseniksi.';
$string['customfields'] = 'Ohjelmien mukautetut kentät';
$string['customfieldsettings'] = 'Yleisten ohjelmien mukautettujen kenttien asetukset';
$string['customfieldvisibleto'] = 'Kentän sisältö näkyy seuraaville:';
$string['customfieldvisible:allocated'] = 'Ohjelmiin kohdistetut käyttäjät';
$string['customfieldvisible:everyone'] = 'Kaikki, jotka näkevät muiden ohjelmien tiedot';
$string['customfieldvisible:viewcapability'] = 'Käyttäjät, joilla on ohjelmien katseluoikeus';
$string['deleteallocation'] = 'Poista kurssin kohdistus';
$string['deletecourse'] = 'Poista kurssi';
$string['deleteprogram'] = 'Poista ohjelma';
$string['deleteset'] = 'Poista kokoelma';
$string['deletetraining'] = 'Poista koulutus';
$string['documentation'] = 'Ohjelmat Moodlen dokumentaatiolle';
$string['duedate'] = 'Määräpäivä';
$string['enrolrole'] = 'Rooli kurssilla';
$string['enrolrole_desc'] = 'Valitse rooli, jota ohjelmat käyttävät kurssille rekisteröintiin';
$string['errorcontentproblem'] = 'Ongelma havaittu ohjelman sisältörakenteessa, ohjelman suoritusta ei seurata oikein!';
$string['errorcoursemissing'] = 'Kurssi puuttuu';
$string['errorcoursesmissing'] = 'Puuttuvat kurssit: {$a}';
$string['errorinvalidoverridedates'] = 'Virheellisten päivämäärien ohitukset';
$string['errordifferenttenant'] = 'Toisen asiakkaan ohjelmaa ei voi käyttää';
$string['errorduplicateprogramid'] = 'Ohjelman tunniste on jo toisen ohjelman käytössä, käytä yksilöllistä ohjelman tunnistetta.';
$string['errornoallocations'] = 'Käyttäjien kohdistuksia ei löytynyt';
$string['errornoallocation'] = 'Ohjelmaa ei ole kohdistettu';
$string['errornomyprograms'] = 'Sinua ei ole kohdistettu ohjelmiin.';
$string['errornoprograms'] = 'Ohjelmia ei löydy.';
$string['errornorequests'] = 'Ohjelmapyyntöjä ei löydy';
$string['errornotenabled'] = 'Ohjelmat-lisäosa ei ole käytössä';
$string['event_program_completed'] = 'Ohjelma suoritettu';
$string['event_program_created'] = 'Ohjelma luotu';
$string['event_program_deleted'] = 'Ohjelma poistettu';
$string['event_program_updated'] = 'Ohjelma päivitetty';
$string['event_program_viewed'] = 'Ohjelmaa katseltu';
$string['event_user_allocated'] = 'Käyttäjä kohdistettu ohjelmaan';
$string['event_user_deallocated'] = 'Käyttäjän kohdistus poistettu ohjelmasta';
$string['evidence'] = 'Muu todiste';
$string['evidencedate'] = 'Todisteen suorituspäivä';
$string['evidenceupdate'] = 'Päivitä muu todiste';
$string['evidenceupload'] = 'Lataa suoritustodisteet';
$string['evidenceupload_csvfile'] = 'CSV-tiedosto';
$string['evidenceupload_errors'] = '{$a} virheellistä riviä havaittu';
$string['evidenceupload_skipped'] = '{$a} riviä ohitettu';
$string['evidenceupload_updated'] = 'Suoritustodisteet päivitetty {$a} käyttäjälle';
$string['evidence_details'] = 'Tiedot';
$string['evidence_detailsdefault'] = 'Oletustiedot';
$string['export'] = 'Vie ohjelmat';
$string['exportfile_info'] = 'tiedot';
$string['exportfile_programs'] = 'ohjelmat';
$string['exportformat'] = 'Tiedostomuoto';
$string['exportformat_csv'] = 'CSV';
$string['exportformat_json'] = 'JSON';
$string['extra_menu_management_index'] = 'Ohjelmien toiminnot';
$string['extra_menu_management_program_general'] = 'Ohjelman toiminnot';
$string['extra_menu_management_program_users'] = 'Käyttäjien toiminnot';
$string['extra_menu_management_program_allocation'] = 'Kohdistuksen toiminnot';
$string['fixeddate'] = 'Kiinteänä päivämääränä';
$string['idnumbersymbol'] = 'Tunniste:';
$string['importallocationend'] = 'Kohdistus päättyy ({$a})';
$string['importallocationstart'] = 'Kohdistus alkaa ({$a})';
$string['importprogramallocation'] = 'Tuo kurssin kohdistus';
$string['importprogramallocationconfirmation'] = 'Olet tuomassa kohdistusasetuksia ohjelmasta __{$a->fullname} / {$a->idnumber} / {$a->category}__.

Valitse kaikki asetukset, jotka haluat tuoda.';
$string['importprogramcontent'] = 'Tuo ohjelman sisältö';
$string['importprogramcontentconfirmation'] = 'Olet tuomassa sisältöä ohjelmasta __{$a->fullname} / {$a->idnumber} / {$a->category}__.';
$string['importprogramdue'] = 'Ohjelman määräpäivä ({$a})';
$string['importprogramend'] = 'Ohjelma päättyy ({$a})';
$string['importprogramstart'] = 'Ohjelma alkaa ({$a})';
$string['importselectprogram'] = 'Valitse ohjelma';
$string['invalidallocationdates'] = 'Virheelliset ohjelman kohdistuspäivät';
$string['invalidcompletiondate'] = 'Virheellinen ohjelman suorituspäivä';
$string['item'] = 'Kohde';
$string['itemcompletion'] = 'Ohjelmakohteen suoritus';
$string['itempoints'] = 'Pisteet';
$string['itemrecalculate'] = 'Laske kohteen suoritus uudelleen';
$string['layoutgrid'] = 'Ruudukkoasettelu';
$string['layouttable'] = 'Taulukkoasettelu';
$string['management'] = 'Ohjelmanhallinta';
$string['messageprovider:allocation_notification'] = 'Ilmoitus ohjelman kohdistuksesta';
$string['messageprovider:approval_request_notification'] = 'Ilmoitus ohjelman hyväksyntäpyynnöstä';
$string['messageprovider:approval_reject_notification'] = 'Ilmoitus ohjelmapyynnön hylkäyksestä';
$string['messageprovider:completion_notification'] = 'Ilmoitus ohjelman suorituksesta';
$string['messageprovider:completion_relateduser_notification'] = 'Ilmoitus ohjelman suorituksesta – liittyvä käyttäjä';
$string['messageprovider:deallocation_notification'] = 'Ilmoitus ohjelman kohdistuksen poistosta';
$string['messageprovider:duesoon_notification'] = 'Ilmoitus ohjelman lähenevästä määräpäivästä';
$string['messageprovider:duesoon_relateduser_notification'] = 'Ilmoitus ohjelman lähenevästä määräpäivästä – liittyvä käyttäjä';
$string['messageprovider:due_notification'] = 'Ilmoitus ohjelman myöhästymisestä';
$string['messageprovider:due_relateduser_notification'] = 'Ilmoitus ohjelman myöhästymisestä – liittyvä käyttäjä';
$string['messageprovider:endsoon_notification'] = 'Ilmoitus ohjelman lähenevästä päättymispäivästä';
$string['messageprovider:endsoon_relateduser_notification'] = 'Ilmoitus ohjelman lähenevästä päättymispäivästä – liittyvä käyttäjä';
$string['messageprovider:endcompleted_notification'] = 'Ilmoitus suoritetun ohjelman päättymisestä';
$string['messageprovider:endfailed_notification'] = 'Ilmoitus hylätyn ohjelman päättymisestä';
$string['messageprovider:endfailed_relateduser_notification'] = 'Ilmoitus hylätyn ohjelman päättymisestä – liittyvä käyttäjä';
$string['messageprovider:reset_notification'] = 'Ilmoitus ohjelman nollauksesta';
$string['messageprovider:start_notification'] = 'Ilmoitus ohjelman aloituksesta';
$string['moveitem'] = 'Siirrä kohde';
$string['moveitemcancel'] = 'Peruuta siirto';
$string['moveafter'] = 'Siirrä {$a->item} {$a->target} jälkeen';
$string['movebefore'] = 'Siirrä {$a->item} ennen {$a->target}';
$string['moveinto'] = 'Siirrä {$a->item} kohteeseen {$a->target}';
$string['myprograms'] = 'Omat ohjelmat';
$string['notification_allocation'] = 'Käyttäjä kohdistettu';
$string['notification_allocation_subject'] = 'Ilmoitus ohjelman kohdistuksesta';
$string['notification_allocation_body'] = 'Hei {$a->user_fullname}!

Sinut on kohdistettu ohjelmaan {$a->program_fullname}, alkamispäivä on {$a->program_startdate}.
';
$string['notification_allocation_description'] = 'Ilmoitus lähetetään käyttäjille, kun heidät kohdistetaan ohjelmaan.';
$string['notification_completion'] = 'Ohjelma suoritettu';
$string['notification_completion_subject'] = 'Ohjelma suoritettu';
$string['notification_completion_body'] = 'Hei {$a->user_fullname}!

Olet suorittanut ohjelman {$a->program_fullname}.
';
$string['notification_completion_description'] = 'Ilmoitus lähetetään käyttäjille, kun he ovat suorittaneet ohjelman.';
$string['notification_completion_relateduser'] = 'Ohjelma suoritettu – liittyvä käyttäjä';
$string['notification_completion_relateduser_subject'] = 'Käyttäjä {$a->user_fullname} suoritti ohjelman';
$string['notification_completion_relateduser_body'] = 'Hei {$a->relateduser_fullname}!

Käyttäjä {$a->user_fullname} on suorittanut ohjelman {$a->program_fullname}.
';
$string['notification_completion_relateduser_description'] = 'Ilmoitus lähetetään käyttäjään liittyville käyttäjille, kun hän on suorittanut ohjelman.';
$string['notification_deallocation'] = 'Käyttäjän kohdistus poistettu';
$string['notification_deallocation_subject'] = 'Ilmoitus ohjelman kohdistuksen poistosta';
$string['notification_deallocation_body'] = 'Hei {$a->user_fullname}!

Kohdistuksesi on poistettu ohjelmasta {$a->program_fullname}.
';
$string['notification_deallocation_description'] = 'Ilmoitus lähetetään käyttäjille, kun heidän kohdistuksensa on poistettu ohjelmasta.';
$string['notification_duesoon'] = 'Ohjelman määräpäivä lähenee';
$string['notification_duesoon_subject'] = 'Ohjelman suoritusta odotetaan pian';
$string['notification_duesoon_body'] = 'Hei{$a->user_fullname}!

Ohjelman {$a->program_fullname} suoritusta odotetaan {$a->program_duedate}.
';
$string['notification_duesoon_description'] = 'Ilmoitus lähetetään käyttäjille ennen heidän ohjelmansa suorituspäivää ellei ohjelmaa ole jo suoritettu.';
$string['notification_duesoon_relateduser'] = 'Ohjelman määräpäivä lähenee – liittyvä käyttäjä';
$string['notification_duesoon_relateduser_subject'] = 'Ohjelman suoritusta odotetaan pian käyttäjältä {$a->user_fullname}';
$string['notification_duesoon_relateduser_body'] = 'Hei {$a->relateduser_fullname}!

Ohjelman {$a->program_fullname} suoritusta käyttäjältä {$a->user_fullname} odotetaan {$a->program_duedate}.
';
$string['notification_duesoon_relateduser_description'] = 'Ilmoitus lähetetään käyttäjään liittyville käyttäjille ennen hänen ohjelmansa suorituspäivää ellei ohjelmaa ole jo suoritettu.';
$string['notification_due'] = 'Ohjelma myöhässä';
$string['notification_due_subject'] = 'Ohjelman suoritusta odotettiin';
$string['notification_due_body'] = 'Hei {$a->user_fullname}!

Ohjelman {$a->program_fullname} suoritusta odotettiin ennen {$a->program_duedate}.
';
$string['notification_due_description'] = 'Ilmoitus lähetetään käyttäjille, kun heidän suorituksensa on myöhässä.';
$string['notification_due_relateduser'] = 'Ohjelma myöhässä – liittyvä käyttäjä';
$string['notification_due_relateduser_subject'] = 'Ohjelman suoritusta odotettiin käyttäjältä {$a->user_fullname}';
$string['notification_due_relateduser_body'] = 'Hei {$a->relateduser_fullname}!

Ohjelman {$a->program_fullname} suoritusta käyttäjältä {$a->user_fullname} odotettiin ennen {$a->program_duedate}.
';
$string['notification_due_relateduser_description'] = 'Ilmoitus lähetetään käyttäjään liittyville käyttäjille, kun hänen suorituksensa on myöhässä.';
$string['notification_endsoon'] = 'Ohjelman päättymispäivä lähenee';
$string['notification_endsoon_subject'] = 'Ohjelma päättyy pian';
$string['notification_endsoon_body'] = 'Hei {$a->user_fullname}!

Ohjelma {$a->program_fullname} päättyy {$a->program_enddate}.
';
$string['notification_endsoon_description'] = 'Ilmoitus lähetetään käyttäjille ennen heidän ohjelmansa päättymispäivää ellei ohjelmaa ole jo suoritettu.';
$string['notification_endsoon_relateduser'] = 'Ohjelman päättymispäivä lähenee – liittyvä käyttäjä';
$string['notification_endsoon_relateduser_subject'] = 'Ohjelma päättyy pian käyttäjältä {$a->user_fullname}';
$string['notification_endsoon_relateduser_body'] = 'Hei {$a->relateduser_fullname}!

Ohjelma {$a->program_fullname} käyttäjällä {$a->user_fullname} päättyy {$a->program_enddate}.
';
$string['notification_endsoon_relateduser_description'] = 'Ilmoitus lähetetään käyttäjään liittyville käyttäjille ennen hänen ohjelmansa päättymispäivää ellei ohjelmaa ole jo suoritettu.';
$string['notification_endcompleted'] = 'Suoritettu ohjelma päättyi';
$string['notification_endcompleted_subject'] = 'Suoritettu ohjelma päättyi';
$string['notification_endcompleted_body'] = 'Hei {$a->user_fullname}!

Ohjelma {$a->program_fullname} päättyi, olet suorittanut sen aiemmin.
';
$string['notification_endcompleted_description'] = 'Ilmoitus lähetetään käyttäjille, kun heidän suorittamansa ohjelma päättyy.';
$string['notification_endfailed'] = 'Hylätty ohjelma päättyi';
$string['notification_endfailed_subject'] = 'Hylätty ohjelma päättyi';
$string['notification_endfailed_body'] = 'Hei {$a->user_fullname}!

Ohjelma {$a->program_fullname} päättyi, etkä suorittanut sitä.
';
$string['notification_endfailed_description'] = 'Ilmoitus lähetetään käyttäjille, kun ohjelma, jota he eivät suorittaneet, päättyy.';
$string['notification_endfailed_relateduser'] = 'Hylätty ohjelma päättyi – liittyvä käyttäjä';
$string['notification_endfailed_relateduser_subject'] = 'Hylätty ohjelma päättyi käyttäjältä {$a->user_fullname}';
$string['notification_endfailed_relateduser_body'] = 'Hei {$a->relateduser_fullname}!

Ohjelma {$a->program_fullname} päättyi, eikä käyttäjä {$a->user_fullname} suorittanut sitä.
';
$string['notification_endfailed_relateduser_description'] = 'Ilmoitus lähetetään käyttäjään liittyville käyttäjille, kun ohjelma, jota hän ei suorittanut, päättyy.';
$string['notification_relateduserfield'] = 'Ilmoituksen liittyvän käyttäjän kenttä';
$string['notification_relateduserfield_desc'] = 'Valitse liittyvien käyttäjien profiilikenttä, jota käytetään liittyvien käyttäjien ilmoituksessa.';
$string['notification_reset'] = 'Käyttäjän edistymisen nollaus';
$string['notification_reset_subject'] = 'Ilmoitus ohjelman nollauksesta';
$string['notification_reset_body'] = 'Hei {$a->user_fullname}!

Edistymisesi ohjelmassa {$a->program_fullname} nollattiin.
';
$string['notification_reset_description'] = 'Ilmoitus lähetetään käyttäjille, kun heidän ohjelmassa edistymisensä nollataan.';
$string['notification_start'] = 'Ohjelma alkoi';
$string['notification_start_subject'] = 'Ohjelma alkoi';
$string['notification_start_body'] = 'Hei {$a->user_fullname}!

Ohjelma {$a->program_fullname} on alkanut.
';
$string['notification_start_description'] = 'Ilmoitus lähetetään käyttäjille, kun heidän ohjelmansa on alkanut.';
$string['notificationdates'] = 'Ilmoituspäivämäärät';
$string['notset'] = 'Ei asetettu';
$string['plugindisabled'] = 'Ohjelmaan rekisteröityminen -lisäosa on poistettu käytöstä, ohjelmat eivät toimi.

[Enable plugin now]({$a->url})';
$string['pluginname'] = 'Ohjelmat';
$string['pluginname_desc'] = 'Ohjelmat on suunniteltu sallimaan kurssikokoelmien luonti.';
$string['privacy:metadata:field:programid'] = 'Ohjelmatunnus';
$string['privacy:metadata:field:userid'] = 'Käyttäjätunnus';
$string['privacy:metadata:field:allocationid'] = 'Ohjelman kohdistustunnus';
$string['privacy:metadata:field:sourceid'] = 'Kohdistuksen lähde';
$string['privacy:metadata:field:itemid'] = 'Kohteen tunnus';
$string['privacy:metadata:field:timecreated'] = 'Luontipäivä';
$string['privacy:metadata:field:timecompleted'] = 'Suorituspäivämäärä';

$string['privacy:metadata:table:enrol_programs_allocations'] = 'Tietoja ohjelmien kohdistuksista';
$string['privacy:metadata:field:archived'] = 'Onko tietue arkistoitu';
$string['privacy:metadata:field:sourcedatajson'] = 'Tietoja kohdistuksen lähteestä';
$string['privacy:metadata:field:timeallocated'] = 'Ohjelman kohdistuspäivä';
$string['privacy:metadata:field:timestart'] = 'Alkamispäivä';
$string['privacy:metadata:field:timedue'] = 'Määräpäivä';
$string['privacy:metadata:field:timeend'] = 'Päättymispäivä';

$string['privacy:metadata:table:enrol_programs_certs_issues'] = 'Ohjelman kohdistuksen todistusten myönnöt';
$string['privacy:metadata:field:issueid'] = 'Myöntötunnus';

$string['privacy:metadata:table:enrol_programs_completions'] = 'Ohjelman kohdistuksen suoritukset';

$string['privacy:metadata:table:enrol_programs_evidences'] = 'Tietoja muista suoritustodisteista';
$string['privacy:metadata:field:evidencejson'] = 'Tietoja suoritustodisteesta';
$string['privacy:metadata:field:createdby'] = 'Todisteen tekijä';

$string['privacy:metadata:table:enrol_programs_requests'] = 'Tietoja kohdistuspyynnöstä';
$string['privacy:metadata:field:datajson'] = 'Tietoja pyynnöstä';
$string['privacy:metadata:field:timerequested'] = 'Pyyntöpäivä';
$string['privacy:metadata:field:timerejected'] = 'Hylkäyspäivä';
$string['privacy:metadata:field:rejectedby'] = 'Pyynnön hylkääjä';


$string['privacy:metadata:table:enrol_programs_usr_snapshots'] = 'Ohjelman kohdistuksen tilannevedokset';
$string['privacy:metadata:field:reason'] = 'Syy';
$string['privacy:metadata:field:timesnapshot'] = 'Tilannevedoksen päivä';
$string['privacy:metadata:field:snapshotby'] = 'Tilannevedoksen tekijä';
$string['privacy:metadata:field:explanation'] = 'Selitys';
$string['privacy:metadata:field:completionsjson'] = 'Tietoja suorituksesta';
$string['privacy:metadata:field:evidencesjson'] = 'Tietoja suoritustodisteesta';

$string['privacy:metadata:table:enrol_programs_src_commholds'] = 'Kaupallisten kohdistusten varaukset';
$string['privacy:metadata:field:quantity'] = 'Määrä';

$string['program'] = 'Ohjelma';
$string['programautofix'] = 'Korjaa ohjelma automaattisesti';
$string['programdue'] = 'Ohjelman määräpäivä';
$string['programdue_help'] = 'Ohjelman määräpäivä ilmaisee, milloin käyttäjien odotetaan suorittavan ohjelma.';
$string['programdue_delay'] = 'Määräpäivä aloituksen jälkeen';
$string['programdue_date'] = 'Määräpäivä';
$string['programend'] = 'Ohjelma päättyy';
$string['programend_help'] = 'Käyttäjät eivät pääse ohjelman kursseille ohjelman päättymisen jälkeen.';
$string['programend_delay'] = 'Päättyminen aloituksen jälkeen';
$string['programend_date'] = 'Ohjelman päättymispäivä';
$string['programcompletion'] = 'Ohjelman suorituspäivä';
$string['programcompletionoverride'] = 'Ohita ohjelman suoritus';
$string['programidnumber'] = 'Ohjelman idnumber';
$string['programimage'] = 'Ohjelman kuva';
$string['programname'] = 'Ohjelman nimi';
$string['programurl'] = 'Ohjelman URL';
$string['programs'] = 'Ohjelmat';
$string['programsactive'] = 'Aktiiviset';
$string['programsarchived'] = 'Arkistoitu';
$string['programsarchived_help'] = 'Arkistoidut ohjelmat on piilotettu käyttäjiltä ja niiden edistyminen on lukittu.';
$string['programslayout'] = 'Ohjelmien yksityiskohtainen sivuasettelu';
$string['programslayout_desc'] = 'Ohjaa ohjelmien asettelua – Omat ohjelmat -sivun taulukko- tai ruudukkonäkymää.';
$string['programslayoutallowuserswitch'] = 'Salli käyttäjien vaihtaa ohjelman asettelua';
$string['programslayoutallowuserswitch_desc'] = 'Salli käyttäjien vaihtaa ohjelman asettelua';
$string['programslayout_desc'] = 'Ohjaa ohjelmien asettelua – Omat ohjelmat -sivun taulukko- tai ruudukkonäkymää.';
$string['programsblocklayout'] = 'Omat ohjelmat -lohkon asettelu';
$string['programsblocklayout_desc'] = 'Ohjaa ohjelmien asettelua – Omat ohjelmat -lohkon taulukko- tai ruudukkonäkymää.';

$string['programstart'] = 'Ohjelma alkaa';
$string['programstart_help'] = 'Käyttäjät eivät pääse ohjelman kursseille ennen ohjelman alkamista.';
$string['programstart_allocation'] = 'Aloita heti kohdistuksen jälkeen';
$string['programstart_delay'] = 'Viivästä aloitusta kohdistuksen jälkeen';
$string['programstart_date'] = 'Ohjelman alkamispäivä';
$string['programstatus'] = 'Ohjelman tila';
$string['programstatus_completed'] = 'Suoritettu';
$string['programstatus_any'] = 'Mikä tahansa ohjelman tila';
$string['programstatus_archived'] = 'Arkistoitu';
$string['programstatus_archivedcompleted'] = 'Arkistoitu suoritetut';
$string['programstatus_overdue'] = 'Myöhässä';
$string['programstatus_open'] = 'Avoin';
$string['programstatus_future'] = 'Ei vielä avoin';
$string['programstatus_failed'] = 'Epäonnistui';
$string['programs:addcourse'] = 'Lisää kurssi ohjelmiin';
$string['programs:addtocertifications'] = 'Lisää ohjelma sertifiointeihin';
$string['programs:addtoplan'] = 'Lisää ohjelma suunnitelmiin';
$string['programs:allocate'] = 'Kohdista opiskelijat ohjelmiin';
$string['programs:archive'] = 'Arkistoi ohjelmien kohdistukset';
$string['programs:clone'] = 'Salli ohjelman sisällön ja asetusten kloonaus';
$string['programs:configframeworks'] = 'Määritä ohjelman saatavuus suunnitelman rakenteissa';
$string['programs:configurecustomfields'] = 'Määritä ohjelman mukautetut kentät';
$string['programs:delete'] = 'Poista ohjelmat';
$string['programs:edit'] = 'Lisää ja päivitä ohjelmat';
$string['programs:export'] = 'Vie ohjelmat';
$string['programs:admin'] = 'Ohjelmien ylläpidon lisäasetukset';
$string['programs:manageallocation'] = 'Hallinnoi käyttäjien kohdistuksia';
$string['programs:manageevidence'] = 'Hallinnoi muita suoritustodisteita';
$string['programs:reset'] = 'Nollaa ohjelman edistyminen';
$string['programs:upload'] = 'Lataa ohjelmat';
$string['programs:view'] = 'Näytä ohjelmanhallinta';
$string['programs:viewcatalogue'] = 'Käytä ohjelmakatalogia';
$string['public'] = 'Julkinen';
$string['public_help'] = 'Julkiset ohjelmat näkyvät kaikille käyttäjille.

Näkyvyyden tila ei vaikuta jo kohdistettuihin ohjelmiin.';
$string['purchaseaccess'] = 'Osta käyttöoikeus';
$string['resetallocation'] = 'Nollaa ohjelman edistyminen';
$string['resettype'] = 'Nollaustyyppi';
$string['resettype_deallocate'] = 'Vain ohjelman kohdistuksen poisto';
$string['resettype_full'] = 'Koko kurssin tyhjennys';
$string['resettype_none'] = 'Ei mitään';
$string['resettype_standard'] = 'Kurssin vakiotyhjennys';
$string['sequencetype'] = 'Suoritustyyppi';
$string['sequencetype_allinorder'] = 'Kaikki järjestyksessä';
$string['sequencetype_allinanyorder'] = 'Kaikki missä tahansa järjestyksessä';
$string['sequencetype_atleast'] = 'Vähintään {$a->min}';
$string['sequencetype_minpoints'] = 'Vähintään {$a->minpoints} pistettä';
$string['selectcategory'] = 'Valitse kategoria';
$string['sortbyprogramname'] = 'Lajittele ohjelman nimen mukaan';
$string['sortbyprogramid'] = 'Lajittele ohjelman tunnisteen mukaan';
$string['sortbyprogramstart'] = 'Lajittele ohjelman alkamispäivän mukaan';
$string['sortbyprogramdue'] = 'Lajittele ohjelman määräpäivän mukaan';
$string['sortbyprogramend'] = 'Lajittele ohjelman päättymispäivän mukaan';
$string['source'] = 'Lähde';
$string['source_approval'] = 'Pyynnöt ja hyväksynnät';
$string['source_approval_allownew'] = 'Salli hyväksynnät';
$string['source_approval_allownew_desc'] = 'Salli uusien _requests with approval_ -lähteiden lisääminen ohjelmiin';
$string['source_approval_allowrequest'] = 'Salli uudet pyynnöt';
$string['source_approval_confirm'] = 'Vahvista, että haluat pyytää kohdistusta ohjelmaan.';
$string['source_approval_daterequested'] = 'Pyyntöpäivämäärä';
$string['source_approval_daterejected'] = 'Hylkäyspäivämäärä';
$string['source_approval_makerequest'] = 'Pyydä pääsyä';
$string['source_approval_notification_approval_request_subject'] = 'Ilmoitus ohjelmapyynnöstä';
$string['source_approval_notification_approval_request_body'] = '
Käyttäjä {$a->user_fullname} pyysi pääsyä ohjelmaan {$a->program_fullname}.
';
$string['source_approval_notification_approval_reject_subject'] = 'Ilmoitus ohjelmapyynnön hylkäyksestä';
$string['source_approval_notification_approval_reject_body'] = 'Hei {$a->user_fullname}!

Pyyntösi käyttää ohjelmaa {$a->program_fullname} hylättiin.

{$a->reason}
';
$string['source_approval_requestallowed'] = 'Pyynnöt sallitaan';
$string['source_approval_requestnotallowed'] = 'Pyyntöjä ei sallita';
$string['source_approval_requests'] = 'Pyyntö';
$string['source_approval_requestpending'] = 'Käyttöpyyntö odottaa';
$string['source_approval_requestrejected'] = 'Käyttöpyyntö hylättiin';
$string['source_approval_requestapprove'] = 'Hyväksy pyyntö';
$string['source_approval_requestreject'] = 'Hylkää pyyntö';
$string['source_approval_requestdelete'] = 'Poista pyyntö';
$string['source_approval_rejectionreason'] = 'Hylkäyksen syy';
$string['source_certify'] = 'Sertifioinnit';
$string['source_certify_allownew'] = 'Salli sertifiointien kohdennus';
$string['source_certify_allownew_desc'] = 'Salli uusien new _certification_ sources -lähteiden lisääminen ohjelmiin';
$string['source_cohort'] = 'Automaattinen kohorttikohdistus';
$string['source_cohort_allownew'] = 'Salli kohorttikohdistus';
$string['source_cohort_allownew_desc'] = 'Salli uusien _cohort auto allocation_ -lähteiden lisääminen ohjelmiin';
$string['source_cohort_cohortstoallocate'] = 'Kohdista kohortit';
$string['source_ecommerce'] = 'Verkkokaupan kohdistus';
$string['source_ecommerce_allownew'] = 'Salli verkkokaupan kohdistus';
$string['source_ecommerce_allownew_desc'] = 'Salli uusien verkkokaupan automaattisen kohdistuksen lähteiden lisääminen ohjelmiin';
$string['source_ecommerce_allowsignup'] = 'Salli uudet kohdistukset';
$string['source_ecommerce_cohortmembershiprequirement'] = 'Käyttäjien on oltava jäseniä jossakin seuraavista kohorteista: {$a}';
$string['source_ecommerce_maxusers'] = 'Osallistujien enimmäismäärä';
$string['source_ecommerce_nocapacity'] = 'Tällä kurssilla ei ole kapasiteettia jäljellä';
$string['source_manual'] = 'Jaa vertaisarviointivuorot käsin';
$string['source_manual_allocateusers'] = 'Kohdista käyttäjät';
$string['source_manual_csvfile'] = 'CSV-tiedosto';
$string['source_manual_hasheaders'] = 'Ensimmäinen rivi on otsikko';
$string['source_manual_potusersmatching'] = 'Täsmäävät kohdistusehdokkaat';
$string['source_manual_potusers'] = 'Kohdistusehdokkaat';
$string['source_manual_result_assigned'] = '{$a} käyttäjää määritettiin ohjelmaan.';
$string['source_manual_result_errors'] = '{$a} virhettä havaittiin ohjelmien määrityksessä.';
$string['source_manual_result_skipped'] = '{$a} käyttäjää oli jo määritetty ohjelmaan.';
$string['source_manual_timeduecolumn'] = 'Määräajan sarake';
$string['source_manual_timeendcolumn'] = 'Ajan päättymisen sarake';
$string['source_manual_timestartcolumn'] = 'Ajan alkamisen sarake';
$string['source_manual_uploadusers'] = 'Lataa kohdistukset';
$string['source_manual_usercolumn'] = 'Käyttäjätunnussarake';
$string['source_manual_usermapping'] = 'Käyttäjän yhdistämistapa';
$string['source_manual_userupload_allocated'] = 'Kohdistettu kohteeseen {$a}';
$string['source_manual_userupload_alreadyallocated'] = 'Kohdistettu jo kohteeseen {$a}';
$string['source_manual_userupload_invalidprogram'] = 'Ei voi kohdistaa kohteeseen {$a}';
$string['source_selfallocation'] = 'Itsekohdistus';
$string['source_selfallocation_allocate'] = 'Rekisteröidy';
$string['source_selfallocation_allownew'] = 'Salli itsekohdistus';
$string['source_selfallocation_allownew_desc'] = 'Salli uusien _self allocation_-lähteiden lisääminen ohjelmiin';
$string['source_selfallocation_allowsignup'] = 'Salli uudet rekisteröitymiset';
$string['source_selfallocation_confirm'] = 'Vahvista, että haluat tulla kohdistetuksi ohjelmaan.';
$string['source_selfallocation_enable'] = 'Ota itsekohdistus käyttöön';
$string['source_selfallocation_key'] = 'Rekisteröitymisavain';
$string['source_selfallocation_keyrequired'] = 'Rekisteröitymisavain vaaditaan';
$string['source_selfallocation_maxusers'] = 'Osallistujien enimmäismäärä';
$string['source_selfallocation_maxusersreached'] = 'Osallistujien enimmäismäärä on jo itsekohdistanut';
$string['source_selfallocation_maxusers_status'] = 'Käyttäjät {$a->count}/{$a->max}';
$string['source_selfallocation_signupallowed'] = 'Rekisteröitymiset sallitaan';
$string['source_selfallocation_signupnotallowed'] = 'Rekisteröitymisiä ei sallita';
$string['source_udplans'] = 'Käyttäjän kehityssuunnitelmat';
$string['source_udplans_allownew'] = 'Käyttäjän kehityssuunnitelmat';
$string['source_udplans_allownew_desc'] = 'Salli uusien _user development plans_ -lähteiden lisääminen ohjelmiin';
$string['source_udplans_allowed'] = 'Sallittu';
$string['source_udplans_noframeworks'] = 'Ei voi lisätä mihinkään suunnitelmiin';
$string['source_udplans_notallowed'] = 'Ei sallittu';
$string['source_udplans_requirecap'] = 'Lisää vaadittu oikeus';
$string['set'] = 'Kurssikokoelma';
$string['settings'] = 'Ohjelman asetukset';
$string['scheduling'] = 'Ajoitus';
$string['taballocation'] = 'Kohdistusasetukset';
$string['tabcontent'] = 'Sisältö';
$string['tabgeneral'] = 'Yleiset';
$string['tabusers'] = 'Käyttäjät';
$string['tabvisibility'] = 'Näkyvyysasetukset';
$string['tagarea_enrol_programs_programs'] = 'Ohjelmat';
$string['taskcertificate'] = 'Ohjelmien todistusten myönnön cron';
$string['taskcron'] = 'Ohjelmat-lisäosan cron';
$string['training'] = 'Koulutus';
$string['trainingcompletion'] = 'Vaadittu koulutus: {$a}';
$string['trainingprogress'] = 'Koulutuksen eteneminen: {$a->current}/{$a->total}';
$string['unarchive'] = 'Palauta';
$string['unlinkeditems'] = 'Linkittämättömät kohteet';
$string['updateprogram'] = 'Päivitä ohjelma';
$string['updateallocation'] = 'Päivitä kohdistus';
$string['updateallocations'] = 'Päivitä kohdistukset';
$string['updatecourse'] = 'Päivitä kurssi';
$string['updateset'] = 'Päivitä kokoelma';
$string['updatescheduling'] = 'Päivitä ajoitus';
$string['updatesource'] = 'Päivitä {$a}';
$string['updatetraining'] = 'Päivitä koulutus';
$string['upload'] = 'Lataa ohjelmat';
$string['upload_invalidcount'] = 'Virheelliset tietueet';
$string['upload_files'] = 'Tiedostot';
$string['upload_files_error'] = 'Useita CSV-tiedostoja, yhtä JSON-tiedostoa tai yhtä Zip-arkistoa odotetaan';
$string['upload_preview'] = 'Tietojen esikatselu';
$string['upload_status'] = 'Tila';
$string['upload_status_invalid'] = 'Virheellinen';
$string['upload_targetcontext'] = 'Lisää ohjelmia kontekstiin';
$string['upload_uploadcount'] = 'Ladattavat ohjelmat';
$string['upload_usecategory'] = 'Käytä kategoriasaraketta konteksteille';
$string['userupload_completion_error'] = 'Ohjelman suoritusta ei voi päivittää';
$string['userupload_completion_updated'] = 'Ohjelman suoritus päivitettiin';

$string['rb_allocatedprograms'] = 'Kohdistetut ohjelmat';
$string['rb_complete'] = 'Suoritettu';
$string['rb_completiondate'] = 'Suorituspäivämäärä';
$string['rb_completionstatus'] = 'Suorituksen tila';
$string['rb_datecompleted'] = 'Suorituspäivä';
$string['rb_dateallocated'] = 'Kohdistuspäivä';
$string['rb_datestarted'] = 'Aloituspäivä';
$string['rb_coursesall'] = 'Kurssit – kaikki';
$string['rb_incomplete'] = 'Kesken';
$string['rb_isallocated'] = 'On kohdistettu';
$string['rb_iscomplete'] = 'On suoritettu?';
$string['rb_iscompleteany'] = 'On suoritettu? (mikä tahansa menetelmä)';
$string['rb_isinprogress'] = 'On käynnissä?';
$string['rb_isnotcomplete'] = 'Ei ole valmis?';
$string['rb_isnotyetstarted'] = 'Ei ole vielä aloitettu?';
$string['rb_notstarted'] = 'Ei aloitettu';
$string['rb_officewhencompletedbasic'] = 'Toimisto, kun suoritettu (perus)';
$string['rb_privacy:metadata'] = 'Lisäosa ei tallenna henkilökohtaisia tietoja.';
$string['rb_programcategory'] = 'Ohjelmakategoria (tai sivusto)';
$string['rb_programcategoryid'] = 'Ohjelmakategorian tunnus (ei koske sivustoa)';
$string['rb_programcategoryidnumber'] = 'Ohjelmakategorian tunniste (ei koske sivustoa)';
$string['rb_programcategorymultichoice'] = 'Ohjelmakategoria (monivalinta)';
$string['rb_programedatecreated'] = 'Ohjelman luontipäivämäärä';
$string['rb_programduedate'] = 'Ohjelman määräpäivä';
$string['rb_programenddate'] = 'Ohjelman kohdistuksen päättymispäivä';
$string['rb_programallocationtype'] = 'Kohdistustyyppi';
$string['rb_programallocationtypes'] = 'Kohdistustyypit';
$string['rb_programexpandlink'] = 'Ohjelman nimi (laajennettavat tiedot)';
$string['rb_programid'] = 'Ohjelman tunnus';
$string['rb_programidnumber'] = 'Ohjelman tunniste';
$string['rb_programname'] = 'Ohjelman nimi';
$string['rb_programnameandsummary'] = 'Ohjelman nimi ja kuvaus';
$string['rb_programnamelinked'] = 'Ohjelman nimi (linkitetty ohjelman sivulle)';
$string['rb_programmultiitem'] = 'Ohjelma (useita kohteita)';
$string['rb_programsingleitem'] = 'Ohjelma';
$string['rb_programstartdate'] = 'Ohjelman kohdistuksen alkamispäivä';
$string['rb_programsummary'] = 'Ohjelman kuvaus';
$string['rb_programvisible'] = 'Ohjelma on julkinen';
$string['rb_programvisibledisabled'] = 'Ohjelma näkyvissä (ei käytössä)';
$string['rb_progress'] = 'Edistyminen';
$string['rb_progressnumeric'] = 'Edistyminen (numeerinen)';
$string['rb_progresspercent'] = 'Edistyminen (% valmiina)';
$string['rb_source_allocation'] = 'Ohjelmien kohdistukset';
$string['rb_timetocompletesinceenrol'] = 'Aikaa suorittaa (kohdistuspäivästä)';
$string['rb_timetocompletesincestart'] = 'Aikaa suorittaa (alkamispäivästä)';
$string['rb_type_program'] = 'Ohjelma';
$string['rb_type_program_category'] = 'Kategoria';
$string['rb_type_program_completion'] = 'Ohjelman kohdistus';
$string['rb_type_program_customfields'] = 'Ohjelman mukautetut kentät';
$string['rb_user'] = 'Käyttäjä';
$string['rb_viewprogram'] = 'Näytä ohjelma';
$string['rb_visiblecohorts'] = 'Kohortit, joilla on näkyvyys';
