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

$string['addprogram'] = 'Afegeix un programa';
$string['addset'] = 'Afegeix un conjunt nou';
$string['allocationend'] = 'Final de l\'assignació';
$string['allocationend_help'] = 'El significat de la data de finalització de l\'assignació depèn dels orígens d\'assignació activats. Normalment, no poden fer-se assignacions noves després d\'aquesta data si s\'especifica.';
$string['allocation'] = 'Assignació';
$string['allocations'] = 'Assignacions';
$string['programallocations'] = 'Assignacions de programes';
$string['allocationdate'] = 'Data d\'assignació';
$string['allocationsources'] = 'Orígens d\'assignació';
$string['allocationstart'] = 'Inici de l\'assignació';
$string['allocationstart_help'] = 'El significat de la data d\'inici de l\'assignació depèn dels orígens d\'assignació activats. Normalment, només poden fer-se assignacions noves després d\'aquesta data si s\'especifica.';
$string['allprograms'] = 'Tots els programes';
$string['appenditem'] = 'Annexa l\'element';
$string['appendinto'] = 'Annexa a l\'element';
$string['archive'] = 'Arxiu';
$string['archived'] = 'Arxivat';
$string['benefitname'] = '{$a}: assignació de programes';
$string['calendarprogramend'] = '{$a} finalitza';
$string['calendarprogramdue'] = '{$a} ha vençut';
$string['calendarprogramstart'] = '{$a} comença';
$string['catalogue'] = 'Catàleg de programes';
$string['catalogue_dofilter'] = 'Cerca';
$string['catalogue_resetfilter'] = 'Esborra';
$string['catalogue_searchtext'] = 'Text de cerca';
$string['catalogue_tag'] = 'Filtra per etiqueta';
$string['certificatetemplatechoose'] = 'Trieu una plantilla...';
$string['cohorts'] = 'Visible per a les cohorts';
$string['cohorts_help'] = 'Els programes que no són públics es poden fer visibles per als membres de la cohort especificada.

L\'estat de visibilitat no afecta els programes que ja s\'han assignat.';
$string['columnusedalready'] = 'La columna ja s\'ha fet servir';
$string['completepercent'] = '{$a} % completat';
$string['completion'] = 'Compleció';
$string['completiondate'] = 'Data de compleció';
$string['completiondelay'] = 'Retard de compleció';
$string['completionoverride'] = 'Sobreescriu la compleció';
$string['creategroups'] = 'Grups del curs';
$string['creategroups_help'] = 'Si l\'opció està activada, es crearà un grup en cada curs que s\'afegeix al programa i tots els usuaris assignats s\'afegiran com a membres del grup.';
$string['customfields'] = 'Camps personalitzats dels programes';
$string['customfieldsettings'] = 'Configuració dels camps personalitzats dels programes habituals';
$string['customfieldvisibleto'] = 'El contingut del camp és visible per a';
$string['customfieldvisible:allocated'] = 'Usuaris assignats als programes';
$string['customfieldvisible:everyone'] = 'Tothom que pugui veure altres detalls del programa';
$string['customfieldvisible:viewcapability'] = 'Usuaris que puguin veure els programes';
$string['deleteallocation'] = 'Suprimeix l\'assignació de programes';
$string['deletecourse'] = 'Suprimeix el curs';
$string['deleteprogram'] = 'Suprimeix el programa';
$string['deleteset'] = 'Suprimeix el conjunt';
$string['deletetraining'] = 'Suprimeix la formació';
$string['documentation'] = 'Programes per a la documentació del Moodle';
$string['duedate'] = 'Data límit';
$string['enrolrole'] = 'Rol al curs';
$string['enrolrole_desc'] = 'Seleccioneu el rol que utilitzaran els programes per a la inscripció al curs';
$string['errorcontentproblem'] = 'S\'ha detectat un problema a l\'estructura de continguts del programa. El seguiment de la compleció del programa no es podrà realitzar correctament.';
$string['errorcoursemissing'] = 'Falta el curs';
$string['errorcoursesmissing'] = 'Falten cursos: {$a}';
$string['errorinvalidoverridedates'] = 'Sobreescriptura de dates no vàlides';
$string['errordifferenttenant'] = 'No es pot accedir a un programa d\'un altre inquilí';
$string['errorduplicateprogramid'] = 'El número d\'ID del programa ja s\'utilitza per a un altre programa. Feu servir un número d\'ID del programa únic.';
$string['errornoallocations'] = 'No s\'han trobat assignacions d\'usuaris';
$string['errornoallocation'] = 'El programa no està assignat';
$string['errornomyprograms'] = 'No se us ha assignat a cap programa.';
$string['errornoprograms'] = 'No s\'ha trobat cap programa.';
$string['errornorequests'] = 'No s\'han trobat sol·licituds de programes';
$string['errornotenabled'] = 'El connector Programes no està activat';
$string['event_program_completed'] = 'S\'ha completat el programa';
$string['event_program_created'] = 'S\'ha creat el programa';
$string['event_program_deleted'] = 'S\'ha suprimit el programa';
$string['event_program_updated'] = 'S\'ha actualitzat el programa';
$string['event_program_viewed'] = 'S\'ha visualitzat el programa';
$string['event_user_allocated'] = 'L\'usuari s\'ha assignat al programa';
$string['event_user_deallocated'] = 'L\'usuari s\'ha desassignat del programa';
$string['evidence'] = 'Altres proves';
$string['evidencedate'] = 'Data de compleció de la prova';
$string['evidenceupdate'] = 'Actualitza l\'altra prova';
$string['evidenceupload'] = 'Carrega les proves de compleció';
$string['evidenceupload_csvfile'] = 'Fitxer CSV';
$string['evidenceupload_errors'] = 'S\'han detectat {$a} files no vàlides';
$string['evidenceupload_skipped'] = 'S\'han omès {$a} files';
$string['evidenceupload_updated'] = 'S\'ha actualitzat la prova de compleció per a {$a} usuaris';
$string['evidence_details'] = 'Detalls';
$string['evidence_detailsdefault'] = 'Detalls predeterminats';
$string['export'] = 'Exporta els programes';
$string['exportfile_info'] = 'informació';
$string['exportfile_programs'] = 'programes';
$string['exportformat'] = 'Format del fitxer';
$string['exportformat_csv'] = 'CSV';
$string['exportformat_json'] = 'JSON';
$string['extra_menu_management_index'] = 'Accions dels programes';
$string['extra_menu_management_program_general'] = 'Accions del programa';
$string['extra_menu_management_program_users'] = 'Accions dels usuaris';
$string['extra_menu_management_program_allocation'] = 'Accions d\'assignació';
$string['fixeddate'] = 'En una data fixa';
$string['idnumbersymbol'] = 'Núm. d\'ID:';
$string['importallocationend'] = 'Final de l\'assignació ({$a})';
$string['importallocationstart'] = 'Inici de l\'assignació ({$a})';
$string['importprogramallocation'] = 'Importa l\'assignació de programes';
$string['importprogramallocationconfirmation'] = 'Esteu important la configuració de l\'assignació des del programa __{$a->fullname} / {$a->idnumber} / {$a->category}__.

Seleccioneu totes les opcions de configuració que vulgueu importar.';
$string['importprogramcontent'] = 'Importa el contingut del programa';
$string['importprogramcontentconfirmation'] = 'Esteu important contingut des del programa __{$a->fullname} / {$a->idnumber} / {$a->category}__.';
$string['importprogramdue'] = 'Venciment del programa ({$a})';
$string['importprogramend'] = 'Final del programa ({$a})';
$string['importprogramstart'] = 'Inici del programa ({$a})';
$string['importselectprogram'] = 'Selecciona un programa';
$string['invalidallocationdates'] = 'Dates d\'assignació del programa no vàlides';
$string['invalidcompletiondate'] = 'Data de compleció del programa no vàlides';
$string['item'] = 'Element';
$string['itemcompletion'] = 'Compleció d\'elements del programa';
$string['itempoints'] = 'Punts';
$string['itemrecalculate'] = 'Torna a calcular la compleció d\'elements';
$string['layoutgrid'] = 'Aspecte de graella';
$string['layouttable'] = 'Aspecte de taula';
$string['management'] = 'Gestió de programes';
$string['messageprovider:allocation_notification'] = 'Notificació de l\'assignació del programa';
$string['messageprovider:approval_request_notification'] = 'Notificació de la sol·licitud d\'aprovació del programa';
$string['messageprovider:approval_reject_notification'] = 'Notificació del rebuig de la sol·licitud del programa';
$string['messageprovider:completion_notification'] = 'Notificació de programa completat';
$string['messageprovider:completion_relateduser_notification'] = 'Notificació de programa completat: usuari relacionat';
$string['messageprovider:deallocation_notification'] = 'Notificació de la desassignació del programa';
$string['messageprovider:duesoon_notification'] = 'Notificació d\'apropament a la data límit del programa';
$string['messageprovider:duesoon_relateduser_notification'] = 'Notificació d\'apropament a la data límit del programa: usuari relacionat';
$string['messageprovider:due_notification'] = 'Notificació de programa vençut';
$string['messageprovider:due_relateduser_notification'] = 'Notificació de programa vençut: usuari relacionat';
$string['messageprovider:endsoon_notification'] = 'Notificació d\'apropament a la data de finalització del programa';
$string['messageprovider:endsoon_relateduser_notification'] = 'Notificació d\'apropament a la data de finalització del programa: usuari relacionat';
$string['messageprovider:endcompleted_notification'] = 'Notificació de programa finalitzat i completat';
$string['messageprovider:endfailed_notification'] = 'Notificació de programa finalitzat, però no completat';
$string['messageprovider:endfailed_relateduser_notification'] = 'Notificació de programa finalitzat, però no completat: usuari relacionat';
$string['messageprovider:reset_notification'] = 'Notificació de restabliment del programa';
$string['messageprovider:start_notification'] = 'Notificació de programa iniciat';
$string['moveitem'] = 'Mou l\'element';
$string['moveitemcancel'] = 'Cancel·la el moviment';
$string['moveafter'] = 'Mou "{$a->item}" després de "{$a->target}"';
$string['movebefore'] = 'Mou "{$a->item}" abans de "{$a->target}"';
$string['moveinto'] = 'Mou "{$a->item}" dins de "{$a->target}"';
$string['myprograms'] = 'Els meus programes';
$string['notification_allocation'] = 'Usuari assignat';
$string['notification_allocation_subject'] = 'Notificació de l\'assignació del programa';
$string['notification_allocation_body'] = 'Hola, {$a->user_fullname},

Se us ha assignat al programa "{$a->program_fullname}", que comença el {$a->program_startdate}.
';
$string['notification_allocation_description'] = 'La notificació que s\'envia als usuaris quan se\'ls assigna al programa.';
$string['notification_completion'] = 'S\'ha completat el programa';
$string['notification_completion_subject'] = 'S\'ha completat el programa';
$string['notification_completion_body'] = 'Hola, {$a->user_fullname},

Heu completat el programa "{$a->program_fullname}".
';
$string['notification_completion_description'] = 'La notificació que s\'envia als usuaris quan completen el programa.';
$string['notification_completion_relateduser'] = 'Programa completat: usuari relacionat';
$string['notification_completion_relateduser_subject'] = 'L\'usuari {$a->user_fullname} ha completat el programa';
$string['notification_completion_relateduser_body'] = 'Hola, {$a->relateduser_fullname},

L\'usuari {$a->user_fullname} ha completat el programa "{$a->program_fullname}".
';
$string['notification_completion_relateduser_description'] = 'La notificació que s\'envia als usuaris en relació amb l\'usuari quan completen el programa.';
$string['notification_deallocation'] = 'Usuari desassignat';
$string['notification_deallocation_subject'] = 'Notificació de la desassignació del programa';
$string['notification_deallocation_body'] = 'Hola, {$a->user_fullname},

Se us ha desassignat del programa "{$a->program_fullname}".
';
$string['notification_deallocation_description'] = 'La notificació que s\'envia als usuaris quan se\'ls desassigna del programa.';
$string['notification_duesoon'] = 'S\'apropa la data límit del programa';
$string['notification_duesoon_subject'] = 'El programa hauria de completar-se aviat';
$string['notification_duesoon_body'] = 'Hola, {$a->user_fullname},

El programa "{$a->program_fullname}" s\'hauria de completar abans del {$a->program_duedate}.
';
$string['notification_duesoon_description'] = 'La notificació que s\'envia als usuaris abans de la data de compleció del programa, tret que el programa ja s\'hagi completat.';
$string['notification_duesoon_relateduser'] = 'Apropament a la data límit del programa: usuari relacionat';
$string['notification_duesoon_relateduser_subject'] = 'L\'usuari {$a->user_fullname} hauria de completar el programa aviat';
$string['notification_duesoon_relateduser_body'] = 'Hola, {$a->relateduser_fullname},

L\'usuari {$a->user_fullname} hauria de completar el programa "{$a->program_fullname}" abans del {$a->program_duedate}.
';
$string['notification_duesoon_relateduser_description'] = 'La notificació que s\'envia als usuaris en relació amb l\'usuari abans de la data de compleció del programa, tret que el programa ja s\'hagi completat.';
$string['notification_due'] = 'Programa vençut';
$string['notification_due_subject'] = 'El programa ja s\'hauria d\'haver completat';
$string['notification_due_body'] = 'Hola, {$a->user_fullname},

El programa "{$a->program_fullname}" s\'hauria d\'haver completat abans del {$a->program_duedate}.
';
$string['notification_due_description'] = 'La notificació que s\'envia als usuaris quan ha passat la data de compleció del programa.';
$string['notification_due_relateduser'] = 'Programa vençut: usuari relacionat';
$string['notification_due_relateduser_subject'] = 'L\'usuari {$a->user_fullname} hauria d\'haver completat el programa';
$string['notification_due_relateduser_body'] = 'Hola, {$a->relateduser_fullname},

L\'usuari {$a->user_fullname} hauria d\'haver completat el programa "{$a->program_fullname}" abans del {$a->program_duedate}.
';
$string['notification_due_relateduser_description'] = 'La notificació que s\'envia als usuaris en relació amb l\'usuari quan ha passat la data de compleció del programa.';
$string['notification_endsoon'] = 'Apropament a la data de finalització del programa';
$string['notification_endsoon_subject'] = 'El programa finalitzarà aviat';
$string['notification_endsoon_body'] = 'Hola, {$a->user_fullname},

El programa "{$a->program_fullname}" finalitzarà el {$a->program_enddate}.
';
$string['notification_endsoon_description'] = 'La notificació que s\'envia als usuaris abans de la data de finalització del programa, tret que el programa ja s\'hagi completat.';
$string['notification_endsoon_relateduser'] = 'Apropament a la data de finalització del programa: usuari relacionat';
$string['notification_endsoon_relateduser_subject'] = 'El programa finalitzarà aviat per a l\'usuari {$a->user_fullname}';
$string['notification_endsoon_relateduser_body'] = 'Hola, {$a->relateduser_fullname},

El programa "{$a->program_fullname}" finalitzarà el {$a->program_enddate} per a l\'usuari {$a->user_fullname} .
';
$string['notification_endsoon_relateduser_description'] = 'La notificació que s\'envia als usuaris en relació amb l\'usuari abans de la data de finalització del programa, tret que el programa ja s\'hagi completat.';
$string['notification_endcompleted'] = 'Programa finalitzat i completat';
$string['notification_endcompleted_subject'] = 'Programa finalitzat i completat';
$string['notification_endcompleted_body'] = 'Hola, {$a->user_fullname},

El programa "{$a->program_fullname}" ha finalitzat, però l\'havíeu completat abans.
';
$string['notification_endcompleted_description'] = 'La notificació que s\'envia als usuaris quan finalitza el programa que han completat.';
$string['notification_endfailed'] = 'Programa finalitzat, però no completat';
$string['notification_endfailed_subject'] = 'Programa finalitzat, però no completat';
$string['notification_endfailed_body'] = 'Hola, {$a->user_fullname},

El programa "{$a->program_fullname}" ha finalitzat i no l\'heu completat.
';
$string['notification_endfailed_description'] = 'La notificació que s\'envia als usuaris quan finalitza el programa que no han completat.';
$string['notification_endfailed_relateduser'] = 'Programa finalitzat, però no completat: usuari relacionat';
$string['notification_endfailed_relateduser_subject'] = 'El programa ha finalitzat, però l\'usuari {$a->user_fullname} no l\'ha completat';
$string['notification_endfailed_relateduser_body'] = 'Hola, {$a->relateduser_fullname},

El programa "{$a->program_fullname}" ha finalitzat i l\'usuari {$a->user_fullname} no l\'ha completat.
';
$string['notification_endfailed_relateduser_description'] = 'La notificació que s\'envia als usuaris en relació amb l\'usuari quan finalitza el programa, però no l\'han completat.';
$string['notification_relateduserfield'] = 'Camp d\'usuari relacionat de la notificació';
$string['notification_relateduserfield_desc'] = 'Seleccioneu el camp del perfil dels usuaris relacionats que es farà servir per enviar notificacions als usuaris relacionats.';
$string['notification_reset'] = 'Restabliment del progrés de l\'usuari';
$string['notification_reset_subject'] = 'Notificació de restabliment del programa';
$string['notification_reset_body'] = 'Hola, {$a->user_fullname},

S\'ha restablert el vostre progrés al programa "{$a->program_fullname}".
';
$string['notification_reset_description'] = 'La notificació que s\'envia als usuaris quan es restableix el seu progrés en un programa.';
$string['notification_start'] = 'Programa iniciat';
$string['notification_start_subject'] = 'Programa iniciat';
$string['notification_start_body'] = 'Hola, {$a->user_fullname},

El programa "{$a->program_fullname}" ha començat.
';
$string['notification_start_description'] = 'La notificació que s\'envia als usuaris quan comença el programa.';
$string['notificationdates'] = 'Dates de notificació';
$string['notset'] = 'No definit';
$string['plugindisabled'] = 'Els programes no funcionaran perquè el connector d\'inscripció dels programes està desactivat.

[Enable plugin now]({$a->url})';
$string['pluginname'] = 'Programes';
$string['pluginname_desc'] = 'Els programes estan dissenyats per permetre que es creïn conjunts de cursos.';
$string['privacy:metadata:field:programid'] = 'ID del programa';
$string['privacy:metadata:field:userid'] = 'ID d\'usuari';
$string['privacy:metadata:field:allocationid'] = 'ID de l\'assignació del programa';
$string['privacy:metadata:field:sourceid'] = 'Origen de l\'assignació';
$string['privacy:metadata:field:itemid'] = 'ID d\'element';
$string['privacy:metadata:field:timecreated'] = 'Data de creació';
$string['privacy:metadata:field:timecompleted'] = 'Data de compleció';

$string['privacy:metadata:table:enrol_programs_allocations'] = 'Informació sobre les assignacions de programes';
$string['privacy:metadata:field:archived'] = 'És el registre arxivat';
$string['privacy:metadata:field:sourcedatajson'] = 'Informació sobre l\'origen de l\'assignació';
$string['privacy:metadata:field:timeallocated'] = 'Data d\'assignació del programa';
$string['privacy:metadata:field:timestart'] = 'Data d\'inici';
$string['privacy:metadata:field:timedue'] = 'Data límit';
$string['privacy:metadata:field:timeend'] = 'Data de finalització';

$string['privacy:metadata:table:enrol_programs_certs_issues'] = 'Emissions de certificats d\'assignació de programes';
$string['privacy:metadata:field:issueid'] = 'ID d\'emissió';

$string['privacy:metadata:table:enrol_programs_completions'] = 'Complecions d\'assignacions de programes';

$string['privacy:metadata:table:enrol_programs_evidences'] = 'Informació sobre altres proves de compleció';
$string['privacy:metadata:field:evidencejson'] = 'Informació sobre la prova de compleció';
$string['privacy:metadata:field:createdby'] = 'Prova creada per';

$string['privacy:metadata:table:enrol_programs_requests'] = 'Informació sobre la sol·licitud d\'assignació';
$string['privacy:metadata:field:datajson'] = 'Informació sobre la sol·licitud';
$string['privacy:metadata:field:timerequested'] = 'Data de sol·licitud';
$string['privacy:metadata:field:timerejected'] = 'Data de rebuig';
$string['privacy:metadata:field:rejectedby'] = 'Sol·licitud rebutjada per';


$string['privacy:metadata:table:enrol_programs_usr_snapshots'] = 'Instantànies d\'assignacions de programes';
$string['privacy:metadata:field:reason'] = 'Motiu';
$string['privacy:metadata:field:timesnapshot'] = 'Data de la instantània';
$string['privacy:metadata:field:snapshotby'] = 'Instantània creada per';
$string['privacy:metadata:field:explanation'] = 'Explicació';
$string['privacy:metadata:field:completionsjson'] = 'Informació sobre la compleció';
$string['privacy:metadata:field:evidencesjson'] = 'Informació sobre la prova de compleció';

$string['privacy:metadata:table:enrol_programs_src_commholds'] = 'Reserves de l\'assignació comercial';
$string['privacy:metadata:field:quantity'] = 'Quantitat';

$string['program'] = 'Programa';
$string['programautofix'] = 'Reparació automàtica del programa';
$string['programdue'] = 'Venciment del programa';
$string['programdue_help'] = 'La data límit del programa indica la data en què els usuaris haurien d\'haver completat el programa.';
$string['programdue_delay'] = 'Venciment després de l\'inici';
$string['programdue_date'] = 'Data límit';
$string['programend'] = 'Final del programa';
$string['programend_help'] = 'Els usuaris no poden accedir als cursos del programa un cop que aquest ha finalitzat.';
$string['programend_delay'] = 'Final després de l\'inici';
$string['programend_date'] = 'Data de finalització del programa';
$string['programcompletion'] = 'Data de compleció del programa';
$string['programcompletionoverride'] = 'Sobreescriu la compleció del programa';
$string['programidnumber'] = 'Número d\'ID del programa';
$string['programimage'] = 'Imatge del programa';
$string['programname'] = 'Nom del programa';
$string['programurl'] = 'URL del programa';
$string['programs'] = 'Programes';
$string['programsactive'] = 'Actiu';
$string['programsarchived'] = 'Arxivat';
$string['programsarchived_help'] = 'Els programes arxivats estan ocults per als usuaris i tenen el progrés bloquejat.';
$string['programslayout'] = 'Aspecte de pàgina detallada dels programes';
$string['programslayout_desc'] = 'Controla el disseny dels programes: visualització de taula o graella per a la pàgina my/programs.';
$string['programslayoutallowuserswitch'] = 'Permet als usuaris canviar l\'aspecte del programa';
$string['programslayoutallowuserswitch_desc'] = 'Permet als usuaris canviar l\'aspecte del programa';
$string['programslayout_desc'] = 'Controla el disseny dels programes: visualització de taula o graella per a la pàgina my/programs.';
$string['programsblocklayout'] = 'Aspecte del bloc d\'Els meus programes';
$string['programsblocklayout_desc'] = 'Controla el disseny dels programes: visualització de taula o graella per al bloc d\'Els meus programes.';

$string['programstart'] = 'Inici del programa';
$string['programstart_help'] = 'Els usuaris no poden accedir als cursos del programa abans que comenci.';
$string['programstart_allocation'] = 'Comença immediatament després de l\'assignació';
$string['programstart_delay'] = 'Retarda l\'inici després de l\'assignació';
$string['programstart_date'] = 'Data d\'inici del programa';
$string['programstatus'] = 'Estat del programa';
$string['programstatus_completed'] = 'Completat';
$string['programstatus_any'] = 'Qualsevol estat del programa';
$string['programstatus_archived'] = 'Arxivat';
$string['programstatus_archivedcompleted'] = 'Arxivat completat';
$string['programstatus_overdue'] = 'Vençut';
$string['programstatus_open'] = 'Obert';
$string['programstatus_future'] = 'Encara no està obert';
$string['programstatus_failed'] = 'Fallat';
$string['programs:addcourse'] = 'Afegeix el curs als programes';
$string['programs:addtocertifications'] = 'Afegeix el programa a les certificacions';
$string['programs:addtoplan'] = 'Afegeix el programa als plans';
$string['programs:allocate'] = 'Assigna estudiants als programes';
$string['programs:archive'] = 'Arxiva les assignacions de programes';
$string['programs:clone'] = 'Permet la clonació del contingut i la configuració del programa';
$string['programs:configframeworks'] = 'Configura la disponibilitat del programa en marcs planificats';
$string['programs:configurecustomfields'] = 'Configura els camps personalitzats del programa';
$string['programs:delete'] = 'Suprimeix programes';
$string['programs:edit'] = 'Afegeix i actualitza programes';
$string['programs:export'] = 'Exporta els programes';
$string['programs:admin'] = 'Administració avançada dels programes';
$string['programs:manageallocation'] = 'Gestiona les assignacions d\'usuaris';
$string['programs:manageevidence'] = 'Gestiona altres proves de compleció';
$string['programs:reset'] = 'Restableix el progrés del programa';
$string['programs:upload'] = 'Carrega programes';
$string['programs:view'] = 'Visualitza la gestió de programes';
$string['programs:viewcatalogue'] = 'Accedeix al catàleg de programes';
$string['public'] = 'Públic';
$string['public_help'] = 'Els programes públics són visibles per a tots els usuaris.

L\'estat de visibilitat no afecta els programes que ja s\'han assignat.';
$string['purchaseaccess'] = 'Compra l\'accés';
$string['resetallocation'] = 'Restableix el progrés del programa';
$string['resettype'] = 'Tipus de restabliment';
$string['resettype_deallocate'] = 'Només desassignació de programes';
$string['resettype_full'] = 'Purga completa del curs';
$string['resettype_none'] = 'Cap';
$string['resettype_standard'] = 'Purga estàndard del curs';
$string['sequencetype'] = 'Tipus de compleció';
$string['sequencetype_allinorder'] = 'Tot en ordre';
$string['sequencetype_allinanyorder'] = 'Tot en qualsevol ordre';
$string['sequencetype_atleast'] = 'Almenys {$a->min}';
$string['sequencetype_minpoints'] = '{$a->minpoints} punts com a mínim';
$string['selectcategory'] = 'Selecciona la categoria';
$string['sortbyprogramname'] = 'Ordena per nom del programa';
$string['sortbyprogramid'] = 'Ordena per ID del programa';
$string['sortbyprogramstart'] = 'Ordena per data d\'inici del programa';
$string['sortbyprogramdue'] = 'Ordena per data de venciment del programa';
$string['sortbyprogramend'] = 'Ordena per data de finalització del programa';
$string['source'] = 'Font';
$string['source_approval'] = 'Sol·licituds amb aprovació';
$string['source_approval_allownew'] = 'Permet les aprovacions';
$string['source_approval_allownew_desc'] = 'Permet l\'addició d\'orígens nous de _sol·licituds amb aprovació_ als programes';
$string['source_approval_allowrequest'] = 'Permet les sol·licituds noves';
$string['source_approval_confirm'] = 'Confirmeu que voleu sol·licitar l\'assignació al programa.';
$string['source_approval_daterequested'] = 'Data de sol·licitud';
$string['source_approval_daterejected'] = 'Data de rebuig';
$string['source_approval_makerequest'] = 'Sol·licita accés';
$string['source_approval_notification_approval_request_subject'] = 'Notificació de sol·licitud de programa';
$string['source_approval_notification_approval_request_body'] = '
L\'usuari {$a->user_fullname} ha sol·licitat accés per al programa "{$a->program_fullname}".
';
$string['source_approval_notification_approval_reject_subject'] = 'Notificació del rebuig de la sol·licitud del programa';
$string['source_approval_notification_approval_reject_body'] = 'Hola, {$a->user_fullname},

S\'ha rebutjat la vostra sol·licitud d\'accés al programa "{$a->program_fullname}".

{$a->reason}
';
$string['source_approval_requestallowed'] = 'Es permeten sol·licituds';
$string['source_approval_requestnotallowed'] = 'No es permeten sol·licituds';
$string['source_approval_requests'] = 'Sol·licituds';
$string['source_approval_requestpending'] = 'Sol·licitud d\'accés pendent';
$string['source_approval_requestrejected'] = 'S\'ha rebutjat la sol·licitud d\'accés';
$string['source_approval_requestapprove'] = 'Aprova la sol·licitud';
$string['source_approval_requestreject'] = 'Rebutja la sol·licitud';
$string['source_approval_requestdelete'] = 'Suprimeix la sol·licitud';
$string['source_approval_rejectionreason'] = 'Motiu del rebuig';
$string['source_certify'] = 'Certificacions';
$string['source_certify_allownew'] = 'Permet l\'assignació de certificacions';
$string['source_certify_allownew_desc'] = 'Permet l\'addició d\'orígens de _certificació_ nous als programes';
$string['source_cohort'] = 'Assignació automàtica de cohorts';
$string['source_cohort_allownew'] = 'Permet l\'assignació de cohorts';
$string['source_cohort_allownew_desc'] = 'Permet l\'addició d\'orígens nous d\'_assignació automàtica de cohorts_ als programes';
$string['source_cohort_cohortstoallocate'] = 'Assigna cohorts';
$string['source_ecommerce'] = 'Assignació de comerç electrònic';
$string['source_ecommerce_allownew'] = 'Permet l\'assignació de comerç electrònic';
$string['source_ecommerce_allownew_desc'] = 'Permet l\'addició d\'orígens nous d\'assignació automàtica de comerç electrònic als programes';
$string['source_ecommerce_allowsignup'] = 'Permet les assignacions noves';
$string['source_ecommerce_cohortmembershiprequirement'] = 'Els usuaris han de pertànyer a una de les cohorts següents: {$a}';
$string['source_ecommerce_maxusers'] = 'Nombre màxim d\'usuaris';
$string['source_ecommerce_nocapacity'] = 'La capacitat d\'aquest programa s\'ha exhaurit';
$string['source_manual'] = 'Assignació manual';
$string['source_manual_allocateusers'] = 'Assigna usuaris';
$string['source_manual_csvfile'] = 'Fitxer CSV';
$string['source_manual_hasheaders'] = 'La primera línia és la capçalera';
$string['source_manual_potusersmatching'] = 'Candidats d\'assignació coincidents';
$string['source_manual_potusers'] = 'Candidats d\'assignació';
$string['source_manual_result_assigned'] = 'S\'han assignat {$a} usuaris al programa.';
$string['source_manual_result_errors'] = 'S\'han detectat {$a} errors durant l\'assignació de programes.';
$string['source_manual_result_skipped'] = '{$a} usuaris ja estaven assignats al programa.';
$string['source_manual_timeduecolumn'] = 'Columna d\'hora de venciment';
$string['source_manual_timeendcolumn'] = 'Columna d\'hora de finalització';
$string['source_manual_timestartcolumn'] = 'Columna d\'hora d\'inici';
$string['source_manual_uploadusers'] = 'Carrega assignacions';
$string['source_manual_usercolumn'] = 'Columna d\'identificació de l\'usuari';
$string['source_manual_usermapping'] = 'Assignació d\'usuari mitjançant';
$string['source_manual_userupload_allocated'] = 'S\'ha assignat a "{$a}"';
$string['source_manual_userupload_alreadyallocated'] = 'Ja s\'ha assignat a "{$a}"';
$string['source_manual_userupload_invalidprogram'] = 'No es pot assignar a "{$a}"';
$string['source_selfallocation'] = 'Assignació per compte propi';
$string['source_selfallocation_allocate'] = 'Registra\'t';
$string['source_selfallocation_allownew'] = 'Permet l\'assignació per compte propi';
$string['source_selfallocation_allownew_desc'] = 'Permet l\'addició d\'orígens nous d\'_assignació per compte propi_ als programes';
$string['source_selfallocation_allowsignup'] = 'Permet registres nous';
$string['source_selfallocation_confirm'] = 'Confirmeu que voleu que se us assigni al programa.';
$string['source_selfallocation_enable'] = 'Activa l\'assignació per compte propi';
$string['source_selfallocation_key'] = 'Clau de registre';
$string['source_selfallocation_keyrequired'] = 'Cal la clau de registre';
$string['source_selfallocation_maxusers'] = 'Nombre màxim d\'usuaris';
$string['source_selfallocation_maxusersreached'] = 'Ja s\'ha assolit el nombre màxim d\'usuaris que es poden assignar per compte propi';
$string['source_selfallocation_maxusers_status'] = 'Usuaris {$a->count}/{$a->max}';
$string['source_selfallocation_signupallowed'] = 'Es permeten els registres';
$string['source_selfallocation_signupnotallowed'] = 'No es permeten els registres';
$string['source_udplans'] = 'Plans de desenvolupament de l\'usuari';
$string['source_udplans_allownew'] = 'Plans de desenvolupament de l\'usuari';
$string['source_udplans_allownew_desc'] = 'Permet l\'addició d\'orígens nous de _plans de desenvolupament de l\'usuari_ als programes';
$string['source_udplans_allowed'] = 'Permès';
$string['source_udplans_noframeworks'] = 'No es pot afegir a cap pla';
$string['source_udplans_notallowed'] = 'No es permet';
$string['source_udplans_requirecap'] = 'Afegeix la capacitat requerida';
$string['set'] = 'Conjunt de cursos';
$string['settings'] = 'Configuració del programa';
$string['scheduling'] = 'S\'està planificant';
$string['taballocation'] = 'Configuració de l\'assignació';
$string['tabcontent'] = 'Contingut';
$string['tabgeneral'] = 'General';
$string['tabusers'] = 'Usuaris';
$string['tabvisibility'] = 'Configuració de visibilitat';
$string['tagarea_enrol_programs_programs'] = 'Programes';
$string['taskcertificate'] = 'Cron d\'emissió de certificats de programes';
$string['taskcron'] = 'Cron del connector de programes';
$string['training'] = 'Formació';
$string['trainingcompletion'] = 'Formació necessària: {$a}';
$string['trainingprogress'] = 'Progrés de la formació: {$a->current}/{$a->total}';
$string['unarchive'] = 'Restaura';
$string['unlinkeditems'] = 'Elements no vinculats';
$string['updateprogram'] = 'Actualitza el programa';
$string['updateallocation'] = 'Actualitza l\'assignació';
$string['updateallocations'] = 'Actualitza les assignacions';
$string['updatecourse'] = 'Actualitza el curs';
$string['updateset'] = 'Actualitza el conjunt';
$string['updatescheduling'] = 'Actualitza la programació';
$string['updatesource'] = 'Actualitza {$a}';
$string['updatetraining'] = 'Actualitza la formació';
$string['upload'] = 'Carrega programes';
$string['upload_invalidcount'] = 'Registres no vàlids';
$string['upload_files'] = 'Fitxers';
$string['upload_files_error'] = 'S\'esperen múltiples fitxers CSV, un fitxer JSON o un fitxer comprimit';
$string['upload_preview'] = 'Previsualització de dades';
$string['upload_status'] = 'Estat';
$string['upload_status_invalid'] = 'No vàlid';
$string['upload_targetcontext'] = 'Afegeix programes al context';
$string['upload_uploadcount'] = 'Programes per carregar';
$string['upload_usecategory'] = 'Utilitza la columna de categoria per als contexts';
$string['userupload_completion_error'] = 'No es pot actualitzar la compleció del programa';
$string['userupload_completion_updated'] = 'S\'ha actualitzat la compleció del programa';

$string['rb_allocatedprograms'] = 'Programes assignats';
$string['rb_complete'] = 'Completat';
$string['rb_completiondate'] = 'Data de compleció';
$string['rb_completionstatus'] = 'Estat de compleció';
$string['rb_datecompleted'] = 'Data de compleció';
$string['rb_dateallocated'] = 'Data d\'assignació';
$string['rb_datestarted'] = 'Data d\'inici';
$string['rb_coursesall'] = 'Cursos: tots';
$string['rb_incomplete'] = 'Incomplet';
$string['rb_isallocated'] = 'S\'ha assignat';
$string['rb_iscomplete'] = 'Ha finalitzat?';
$string['rb_iscompleteany'] = 'Ha finalitzat? (Qualsevol mètode)';
$string['rb_isinprogress'] = 'Està en progrés?';
$string['rb_isnotcomplete'] = 'No s\'ha completat?';
$string['rb_isnotyetstarted'] = 'Encara no ha començat?';
$string['rb_notstarted'] = 'No ha començat';
$string['rb_officewhencompletedbasic'] = 'Oficina de compleció (bàsica)';
$string['rb_privacy:metadata'] = 'El connector no emmagatzema dades personals.';
$string['rb_programcategory'] = 'Categoria del programa (o lloc)';
$string['rb_programcategoryid'] = 'ID de la categoria del programa (N/A si és un lloc)';
$string['rb_programcategoryidnumber'] = 'Número d\'ID de la categoria del programa (N/A si és un lloc)';
$string['rb_programcategorymultichoice'] = 'Categoria del programa (elecció múltiple)';
$string['rb_programedatecreated'] = 'Data de creació del programa';
$string['rb_programduedate'] = 'Data de venciment del programa';
$string['rb_programenddate'] = 'Data de finalització de l\'assignació de programes';
$string['rb_programallocationtype'] = 'Tipus d\'assignació';
$string['rb_programallocationtypes'] = 'Tipus d\'assignacions';
$string['rb_programexpandlink'] = 'Nom del programa (detalls ampliats)';
$string['rb_programid'] = 'ID del programa';
$string['rb_programidnumber'] = 'Número d\'ID del programa';
$string['rb_programname'] = 'Nom del programa';
$string['rb_programnameandsummary'] = 'Nom i descripció del programa';
$string['rb_programnamelinked'] = 'Nom del programa (enllaç a la pàgina del programa)';
$string['rb_programmultiitem'] = 'Programa (diversos elements)';
$string['rb_programsingleitem'] = 'Programa';
$string['rb_programstartdate'] = 'Data d\'inici de l\'assignació de programes';
$string['rb_programsummary'] = 'Descripció del programa';
$string['rb_programvisible'] = 'El programa és públic';
$string['rb_programvisibledisabled'] = 'Programa visible (no aplicable)';
$string['rb_progress'] = 'Progrés';
$string['rb_progressnumeric'] = 'Progrés (numèric)';
$string['rb_progresspercent'] = 'Progrés (% de compleció)';
$string['rb_source_allocation'] = 'Assignacions de programes';
$string['rb_timetocompletesinceenrol'] = 'Temps per completar (des de la data d\'assignació)';
$string['rb_timetocompletesincestart'] = 'Temps per completar (des de la data d\'inici)';
$string['rb_type_program'] = 'Programa';
$string['rb_type_program_category'] = 'Categoria';
$string['rb_type_program_completion'] = 'Assignació de programes';
$string['rb_type_program_customfields'] = 'Camps personalitzats del programa';
$string['rb_user'] = 'L\'usuari';
$string['rb_viewprogram'] = 'Mostra el programa';
$string['rb_visiblecohorts'] = 'Cohorts amb visibilitat';
