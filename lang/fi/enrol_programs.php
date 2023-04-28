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
$string['archived'] = 'Arkistoitu';
$string['catalogue'] = 'Ohjelmakatalogi';
$string['catalogue_dofilter'] = 'Haku';
$string['catalogue_resetfilter'] = 'Nollaus';
$string['catalogue_searchtext'] = 'Tekstihaku';
$string['catalogue_tag'] = 'Suodata tunnisteella';
$string['certificatetemplatechoose'] = 'Käytä mallipohjaa...';
$string['cohorts'] = 'Näkyvissä kohorteille';
$string['cohorts_help'] = 'Ei-julkiset ohjelmat voi tuoda määritettyjen kohorttien jäsenten näkyville.

Näkyvyyden tila ei vaikuta jo kohdistettuihin ohjelmiin.';
$string['completiondate'] = 'Suorituspäivämäärä';
$string['creategroups'] = 'Kurssiryhmät';
$string['creategroups_help'] = 'Jos käytössä, ryhmä luodaan kuhunkin ohjelmaan lisättyyn kurssiin, ja kohdistetut käyttäjät lisätään ryhmän jäseniksi.';
$string['deleteallocation'] = 'Poista kurssin kohdistus';
$string['deletecourse'] = 'Poista kurssi';
$string['deleteprogram'] = 'Poista ohjelma';
$string['deleteset'] = 'Poista kokoelma';
$string['documentation'] = 'Ohjelmat Moodlen dokumentaatiolle';
$string['duedate'] = 'Määräpäivä';
$string['enrolrole'] = 'Rooli kurssilla';
$string['enrolrole_desc'] = 'Valitse rooli, jota ohjelmat käyttävät kurssille rekisteröintiin';
$string['errorcontentproblem'] = 'Ongelma havaittu ohjelman sisältörakenteessa, ohjelman suoritusta ei seurata oikein!';
$string['errordifferenttenant'] = 'Toisen asiakkaan ohjelmaa ei voi käyttää';
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
$string['evidence_details'] = 'Yksityiskohdat';
$string['fixeddate'] = 'Kiinteänä päivämääränä';
$string['item'] = 'Kohde';
$string['itemcompletion'] = 'Ohjelmakohteen suoritus';
$string['management'] = 'Ohjelmanhallinta';
$string['messageprovider:allocation_notification'] = 'Ilmoitus ohjelman kohdistuksesta';
$string['messageprovider:approval_request_notification'] = 'Ilmoitus ohjelman hyväksyntäpyynnöstä';
$string['messageprovider:approval_reject_notification'] = 'Ilmoitus ohjelmapyynnön hylkäyksestä';
$string['messageprovider:completion_notification'] = 'Ilmoitus ohjelman suorituksesta';
$string['messageprovider:deallocation_notification'] = 'Ilmoitus ohjelman kohdistuksen poistosta';
$string['messageprovider:duesoon_notification'] = 'Ilmoitus ohjelman lähenevästä määräpäivästä';
$string['messageprovider:due_notification'] = 'Ilmoitus ohjelman myöhästymisestä';
$string['messageprovider:endsoon_notification'] = 'Ilmoitus ohjelman lähenevästä päättymispäivästä';
$string['messageprovider:endcompleted_notification'] = 'Ilmoitus suoritetun ohjelman päättymisestä';
$string['messageprovider:endfailed_notification'] = 'Ilmoitus hylätyn ohjelman päättymisestä';
$string['messageprovider:start_notification'] = 'Ilmoitus ohjelman aloituksesta';
$string['moveitem'] = 'Siirrä kohde';
$string['moveitemcancel'] = 'Peruuta siirto';
$string['moveafter'] = 'Siirrä "{$a->item}" kohteen "{$a->target}” perään';
$string['movebefore'] = 'Siirrä "{$a->item}" kohteen "{$a->target}” eteen';
$string['moveinto'] = 'Siirrä "{$a->item}" kohteeseen "{$a->target}”';
$string['myprograms'] = 'Omat ohjelmat';
$string['notification_allocation'] = 'Käyttäjä kohdistettu';
$string['notification_completion'] = 'Ohjelma suoritettu';
$string['notification_completion_subject'] = 'Ohjelma suoritettu';
$string['notification_completion_body'] = 'Hei {$a->user_fullname}!

Olet suorittanut ohjelman "{$a->program_fullname}".
';
$string['notification_deallocation'] = 'Käyttäjän kohdistus poistettu';
$string['notification_duesoon'] = 'Ohjelman määräpäivä lähenee';
$string['notification_duesoon_subject'] = 'Ohjelman suoritusta odotetaan pian';
$string['notification_duesoon_body'] = 'Hei {$a->user_fullname}!

Ohjelman "{$a->program_fullname}" suoritusta odotetaan {$a->program_duedate}.
';
$string['notification_due'] = 'Ohjelma myöhässä';
$string['notification_due_subject'] = 'Ohjelman suoritusta odotettiin';
$string['notification_due_body'] = 'Hei {$a->user_fullname}!

Ohjelman "{$a->program_fullname}" suoritusta odotettiin ennen {$a->program_duedate}.
';
$string['notification_endsoon'] = 'Ohjelman päättymispäivä lähenee';
$string['notification_endsoon_subject'] = 'Ohjelma päättyy pian';
$string['notification_endsoon_body'] = 'Hei {$a->user_fullname}!

Ohjelma "{$a->program_fullname}" päättyy {$a->program_enddate}.
';
$string['notification_endcompleted'] = 'Suoritettu ohjelma päättyi';
$string['notification_endcompleted_subject'] = 'Suoritettu ohjelma päättyi';
$string['notification_endcompleted_body'] = 'Hei {$a->user_fullname}!

Ohjelma "{$a->program_fullname}" päättyi, olet suorittanut sen aiemmin.
';
$string['notification_endfailed'] = 'Hylätty ohjelma päättyi';
$string['notification_endfailed_subject'] = 'Hylätty ohjelma päättyi';
$string['notification_endfailed_body'] = 'Hei {$a->user_fullname}!

Ohjelma "{$a->program_fullname}" päättyi, et ole suorittanut sitä.
';
$string['notification_start'] = 'Ohjelma alkoi';
$string['notification_start_subject'] = 'Ohjelma alkoi';
$string['notification_start_body'] = 'Hei {$a->user_fullname}!

Ohjelma "{$a->program_fullname}" on alkanut.
';
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
$string['programidnumber'] = 'Ohjelman idnumber';
$string['programimage'] = 'Ohjelman kuva';
$string['programname'] = 'Ohjelman nimi';
$string['programurl'] = 'Ohjelman URL';
$string['programs'] = 'Ohjelmat';
$string['programsactive'] = 'Aktiiviset';
$string['programsarchived'] = 'Arkistoitu';
$string['programsarchived_help'] = 'Arkistoidut ohjelmat on piilotettu käyttäjiltä ja niiden edistyminen on lukittu.';
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
$string['programs:allocate'] = 'Kohdista opiskelijat ohjelmiin';
$string['programs:delete'] = 'Poista ohjelmat';
$string['programs:edit'] = 'Lisää ja päivitä ohjelmat';
$string['programs:admin'] = 'Ohjelmien ylläpidon lisäasetukset';
$string['programs:manageevidence'] = 'Hallinnoi muita suoritustodisteita';
$string['programs:view'] = 'Näytä ohjelmanhallinta';
$string['programs:viewcatalogue'] = 'Käytä ohjelmakatalogia';
$string['public'] = 'Julkinen';
$string['public_help'] = 'Julkiset ohjelmat näkyvät kaikille käyttäjille.

Näkyvyyden tila ei vaikuta jo kohdistettuihin ohjelmiin.';
$string['sequencetype'] = 'Suoritustyyppi';
$string['sequencetype_allinorder'] = 'Kaikki järjestyksessä';
$string['sequencetype_allinanyorder'] = 'Kaikki missä tahansa järjestyksessä';
$string['sequencetype_atleast'] = 'Vähintään {$a->min}';
$string['selectcategory'] = 'Valitse kategoria';
$string['source'] = 'Lähde';
$string['source_approval'] = 'Pyynnöt ja hyväksynnät';
$string['source_approval_allownew'] = 'Salli hyväksynnät';
$string['source_approval_allownew_desc'] = 'Salli uusien _requests with approval_ -lähteiden lisääminen ohjelmiin';
$string['source_approval_allowrequest'] = 'Salli uudet pyynnöt';
$string['source_approval_confirm'] = 'Vahvista, että haluat pyytää kohdistusta ohjelmaan.';
$string['source_approval_daterequested'] = 'Pyyntöpäivämäärä';
$string['source_approval_daterejected'] = 'Hylkäyspäivämäärä';
$string['source_approval_makerequest'] = 'Pyydä pääsyä';
$string['source_approval_notification_allocation_subject'] = 'Ilmoitus hyväksynnästä ohjelmaan';
$string['source_approval_notification_allocation_body'] = 'Hei {$a->user_fullname}!

Rekisteröitymisesi ohjelmaan "{$a->program_fullname}" hyväksyttiin, aloituspäivä on {$a->program_startdate}.
';
$string['source_approval_notification_approval_request_subject'] = 'Ilmoitus ohjelmapyynnöstä';
$string['source_approval_notification_approval_request_body'] = '
Käyttäjä {$a->user_fullname} pyysi pääsyä ohjelmaan "{$a->program_fullname}".
';
$string['source_approval_notification_approval_reject_subject'] = 'Ilmoitus ohjelmapyynnön hylkäyksestä';
$string['source_approval_notification_approval_reject_body'] = 'Hei {$a->user_fullname}!

Pyyntösi päästä ohjelmaan "{$a->program_fullname}" hylättiin.

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
$string['notification_allocation_subject'] = 'Ilmoitus ohjelman kohdistuksesta';
$string['notification_allocation_body'] = 'Hei {$a->user_fullname}!

Sinut on kohdistettu ohjelmaan "{$a->program_fullname}", alkamispäivä on {$a->program_startdate}.
';
$string['notification_deallocation_subject'] = 'Ilmoitus ohjelman kohdistuksen poistosta';
$string['notification_deallocation_body'] = 'Hei {$a->user_fullname}!

Kohdistuksesi on poistettu ohjelmasta "{$a->program_fullname}".
';
$string['source_cohort'] = 'Automaattinen kohorttikohdistus';
$string['source_cohort_allownew'] = 'Salli kohorttikohdistus';
$string['source_cohort_allownew_desc'] = 'Salli uusien _cohort auto allocation_ -lähteiden lisääminen ohjelmiin';
$string['source_manual'] = 'Jaa vertaisarviointivuorot käsin';
$string['source_manual_allocateusers'] = 'Kohdista käyttäjät';
$string['source_manual_csvfile'] = 'CSV-tiedosto';
$string['source_manual_hasheaders'] = 'Ensimmäinen rivi on otsikko';
$string['source_manual_potusersmatching'] = 'Täsmäävät kohdistusehdokkaat';
$string['source_manual_potusers'] = 'Kohdistusehdokkaat';
$string['source_manual_result_assigned'] = '{$a} käyttäjää määritettiin ohjelmaan.';
$string['source_manual_result_errors'] = '{$a} virhettä havaittiin ohjelmien määrityksessä.';
$string['source_manual_result_skipped'] = '{$a} käyttäjää oli jo määritetty ohjelmaan.';
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
$string['source_selfallocation_maxusers_status'] = 'Käyttäjiä {$a->count}/{$a->max}';
$string['source_selfallocation_notification_allocation_subject'] = 'Ilmoitus ohjelman kohdistuksesta';
$string['source_selfallocation_notification_allocation_body'] = 'Hei {$a->user_fullname}!

Olet rekisteröitynyt ohjelmaan "{$a->program_fullname}", alkamispäivä on {$a->program_startdate}.
';
$string['source_selfallocation_signupallowed'] = 'Rekisteröitymiset sallitaan';
$string['source_selfallocation_signupnotallowed'] = 'Rekisteröitymisiä ei sallita';
$string['set'] = 'Kurssikokoelma';
$string['settings'] = 'Ohjelman asetukset';
$string['scheduling'] = 'Ajoitus';
$string['taballocation'] = 'Kohdistusasetukset';
$string['tabcontent'] = 'Sisältö';
$string['tabgeneral'] = 'Yleiset';
$string['tabusers'] = 'Käyttäjät';
$string['tabvisibility'] = 'Näkyvyysasetukset';
$string['tagarea_program'] = 'Ohjelmat';
$string['taskcertificate'] = 'Ohjelmien todistusten myönnön cron';
$string['taskcron'] = 'Ohjelmat-lisäosan cron';
$string['unlinkeditems'] = 'Linkittämättömät kohteet';
$string['updateprogram'] = 'Päivitä ohjelma';
$string['updateallocation'] = 'Päivitä kohdistus';
$string['updateallocations'] = 'Päivitä kohdistukset';
$string['updateset'] = 'Päivitä kokoelma';
$string['updatescheduling'] = 'Päivitä ajoitus';
$string['updatesource'] = 'Päivitä {$a}';
