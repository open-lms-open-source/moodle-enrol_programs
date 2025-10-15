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

$string['addprogram'] = 'Aggiungi programma';
$string['addset'] = 'Aggiungi nuovo set';
$string['allocationend'] = 'Fine assegnazione';
$string['allocationend_help'] = 'Il significato della data di fine assegnazione dipende dalle origini di assegnazione abilitate. Di solito non è possibile effettuare nuove assegnazioni dopo questa data, se specificata.';
$string['allocation'] = 'Assegnazione';
$string['allocations'] = 'Assegnazioni';
$string['programallocations'] = 'Assegnazioni programmi';
$string['allocationdate'] = 'Data assegnazione';
$string['allocationsources'] = 'Origini assegnazione';
$string['allocationstart'] = 'Inizio assegnazione';
$string['allocationstart_help'] = 'Il significato della data di inizio assegnazione dipende dalle origini di assegnazione abilitate. Di solito è possibile effettuare nuove assegnazioni solo dopo questa data, se specificata.';
$string['allprograms'] = 'Tutti i programmi';
$string['appenditem'] = 'Aggiungi elemento';
$string['appendinto'] = 'Aggiungi nell\'elemento';
$string['archive'] = 'Archivia';
$string['archived'] = 'Archiviato';
$string['benefitname'] = '{$a}: assegnazione programmi';
$string['calendarprogramend'] = '{$a} termina';
$string['calendarprogramdue'] = '{$a} è in scadenza';
$string['calendarprogramstart'] = '{$a} inizia';
$string['catalogue'] = 'Catalogo programmi';
$string['catalogue_dofilter'] = 'Ricerca';
$string['catalogue_resetfilter'] = 'Cancella';
$string['catalogue_searchtext'] = 'Cerca testo';
$string['catalogue_tag'] = 'Filtra per tag';
$string['certificatetemplatechoose'] = 'Scegli un modello...';
$string['cohorts'] = 'Visibile per le coorti';
$string['cohorts_help'] = 'I programmi non pubblici possono essere resi visibili a determinati membri della coorte.

Lo stato di visibilità non influisce sui programmi già assegnati.';
$string['columnusedalready'] = 'La colonna è già in uso';
$string['completepercent'] = '{$a}% completato';
$string['completion'] = 'Completamento';
$string['completiondate'] = 'Data di completamento';
$string['completiondelay'] = 'Ritardo nel completamento';
$string['completionoverride'] = 'Ignora completamento';
$string['creategroups'] = 'Gruppi del corso';
$string['creategroups_help'] = 'Se questa funzione è abilitata, verrà creato un gruppo per ogni corso aggiunto al programma e tutti gli utenti assegnati verranno aggiunti come membri del gruppo.';
$string['customfields'] = 'Campi personalizzati dei programmi';
$string['customfieldsettings'] = 'Impostazioni comuni dei campi personalizzati dei programmi';
$string['customfieldvisibleto'] = 'Il contenuto del campo è visibile a';
$string['customfieldvisible:allocated'] = 'Utenti assegnati ai programmi';
$string['customfieldvisible:everyone'] = 'Tutti coloro che possono vedere altri dettagli del programma';
$string['customfieldvisible:viewcapability'] = 'Utenti che possono visualizzare i programmi';
$string['deleteallocation'] = 'Elimina assegnazione programma';
$string['deletecourse'] = 'Rimuovi corso';
$string['deleteprogram'] = 'Elimina programma';
$string['deleteset'] = 'Elimina set';
$string['deletetraining'] = 'Rimuovi formazione';
$string['documentation'] = 'Programmi per documentazione Moodle';
$string['duedate'] = 'Data di scadenza';
$string['enrolrole'] = 'Ruolo di corso';
$string['enrolrole_desc'] = 'Seleziona il ruolo che verrà utilizzato dai programmi per l\'iscrizione al corso';
$string['errorcontentproblem'] = 'Problema rilevato nella struttura dei contenuti del programma, il completamento del programma non verrà monitorato correttamente!';
$string['errorcoursemissing'] = 'Il corso è mancante';
$string['errorcoursesmissing'] = 'Corsi mancanti: {$a}';
$string['errorinvalidoverridedates'] = 'Sostituzioni delle date non valide';
$string['errordifferenttenant'] = 'Impossibile accedere al programma da un altro tenant';
$string['errorduplicateprogramid'] = 'Il numero ID del programma è già stato utilizzato per un altro programma; utilizza un numero ID univoco per il programma.';
$string['errornoallocations'] = 'Nessuna assegnazione di utenti trovata';
$string['errornoallocation'] = 'Il programma non è assegnato';
$string['errornomyprograms'] = 'Non si è assegnati a nessun programma.';
$string['errornoprograms'] = 'Nessun programma trovato.';
$string['errornorequests'] = 'Nessuna richiesta di programmi trovata';
$string['errornotenabled'] = 'Il plugin dei programmi non è abilitato';
$string['event_program_completed'] = 'Programma completato';
$string['event_program_created'] = 'Programma creato';
$string['event_program_deleted'] = 'Programma eliminato';
$string['event_program_updated'] = 'Programma aggiornato';
$string['event_program_viewed'] = 'Programma visualizzato';
$string['event_user_allocated'] = 'Utente assegnato al programma';
$string['event_user_deallocated'] = 'Utente non più assegnato al programma';
$string['evidence'] = 'Altre prove';
$string['evidencedate'] = 'Data di completamento prova';
$string['evidenceupdate'] = 'Aggiorna un\'altra prova';
$string['evidenceupload'] = 'Carica prove di completamento';
$string['evidenceupload_csvfile'] = 'File CSV';
$string['evidenceupload_errors'] = '{$a} righe non valide rilevate';
$string['evidenceupload_skipped'] = '{$a} righe ignorate';
$string['evidenceupload_updated'] = 'Prova di completamento aggiornata per {$a} utenti';
$string['evidence_details'] = 'Dettagli';
$string['evidence_detailsdefault'] = 'Dettagli predefiniti';
$string['export'] = 'Esporta programmi';
$string['exportfile_info'] = 'info';
$string['exportfile_programs'] = 'programmi';
$string['exportformat'] = 'Formato file';
$string['exportformat_csv'] = 'CSV';
$string['exportformat_json'] = 'JSON';
$string['extra_menu_management_index'] = 'Azioni programmi';
$string['extra_menu_management_program_general'] = 'Azioni programma';
$string['extra_menu_management_program_users'] = 'Azioni utenti';
$string['extra_menu_management_program_allocation'] = 'Azioni assegnazione';
$string['fixeddate'] = 'A una data fissa';
$string['idnumbersymbol'] = 'N. ID:';
$string['importallocationend'] = 'Fine assegnazione ({$a})';
$string['importallocationstart'] = 'Inizio assegnazione ({$a})';
$string['importprogramallocation'] = 'Importa assegnazione programma';
$string['importprogramallocationconfirmation'] = 'Stai importando le impostazioni di assegnazione dal programma __{$a->fullname} / {$a->idnumber} / {$a->category}__.

Seleziona tutte le impostazioni che vuoi importare.';
$string['importprogramcontent'] = 'Importa contenuti programma';
$string['importprogramcontentconfirmation'] = 'Stai importando contenuti dal programma __{$a->fullname} / {$a->idnumber} / {$a->category}__.';
$string['importprogramdue'] = 'Programma in scadenza ({$a})';
$string['importprogramend'] = 'Fine programma ({$a})';
$string['importprogramstart'] = 'Inizio programma ({$a})';
$string['importselectprogram'] = 'Seleziona programma';
$string['invalidallocationdates'] = 'Date di assegnazione programma non valide';
$string['invalidcompletiondate'] = 'Data di completamento programma non valida';
$string['item'] = 'Elemento';
$string['itemcompletion'] = 'Completamento elemento programma';
$string['itempoints'] = 'Punti';
$string['itemrecalculate'] = 'Ricalcola completamento elemento';
$string['layoutgrid'] = 'Layout della griglia';
$string['layouttable'] = 'Layout della tabella';
$string['management'] = 'Gestione programma';
$string['messageprovider:allocation_notification'] = 'Notifica di assegnazione programma';
$string['messageprovider:approval_request_notification'] = 'Notifica di richiesta approvazione programma';
$string['messageprovider:approval_reject_notification'] = 'Notifica di rifiuto richiesta programma';
$string['messageprovider:completion_notification'] = 'Notifica di completamento programma';
$string['messageprovider:completion_relateduser_notification'] = 'Notifica di completamento programma: utente correlato';
$string['messageprovider:deallocation_notification'] = 'Notifica di rimozione assegnazione programma';
$string['messageprovider:duesoon_notification'] = 'Notifica prossima data di scadenza programma';
$string['messageprovider:duesoon_relateduser_notification'] = 'Notifica data di scadenza programma vicina: utente correlato';
$string['messageprovider:due_notification'] = 'Notifica scadenza programma superata';
$string['messageprovider:due_relateduser_notification'] = 'Notifica scadenza programma superata: utente correlato';
$string['messageprovider:endsoon_notification'] = 'Notifica prossima data di fine programma';
$string['messageprovider:endsoon_relateduser_notification'] = 'Notifica data di fine programma vicina: utente correlato';
$string['messageprovider:endcompleted_notification'] = 'Notifica di programma terminato completato';
$string['messageprovider:endfailed_notification'] = 'Notifica di programma terminato non completato';
$string['messageprovider:endfailed_relateduser_notification'] = 'Notifica di programma terminato non completato: utente correlato';
$string['messageprovider:reset_notification'] = 'Notifica di ripristino programma';
$string['messageprovider:start_notification'] = 'Notifica di inizio programma';
$string['moveitem'] = 'Sposta elemento';
$string['moveitemcancel'] = 'Annulla spostamento';
$string['moveafter'] = 'Sposta "{$a->item}" dopo "{$a->target}"';
$string['movebefore'] = 'Sposta "{$a->item}" prima di "{$a->target}"';
$string['moveinto'] = 'Sposta "{$a->item}" in "{$a->target}"';
$string['myprograms'] = 'I miei programmi';
$string['notification_allocation'] = 'Utente assegnato';
$string['notification_allocation_subject'] = 'Notifica di assegnazione programma';
$string['notification_allocation_body'] = 'Ciao {$a->user_fullname},

ti confermiamo l\'assegnazione al programma "{$a->program_fullname}", la cui data di inizio è {$a->program_startdate}.
';
$string['notification_allocation_description'] = 'Notifica inviata agli utenti quando sono assegnati al programma.';
$string['notification_completion'] = 'Programma completato';
$string['notification_completion_subject'] = 'Programma completato';
$string['notification_completion_body'] = 'Ciao {$a->user_fullname},

hai completato il programma "{$a->program_fullname}".
';
$string['notification_completion_description'] = 'Notifica inviata agli utenti quando completano il programma.';
$string['notification_completion_relateduser'] = 'Programma completato: utente correlato';
$string['notification_completion_relateduser_subject'] = 'L\'utente {$a->user_fullname} ha completato il programma';
$string['notification_completion_relateduser_body'] = 'Ciao {$a->relateduser_fullname},

l\'utente {$a->user_fullname} ha completato il programma "{$a->program_fullname}".
';
$string['notification_completion_relateduser_description'] = 'Notifica inviata agli utenti correlati all\'utente quando quest\'ultimo completa il programma.';
$string['notification_deallocation'] = 'Utente non più assegnato';
$string['notification_deallocation_subject'] = 'Notifica di rimozione assegnazione programma';
$string['notification_deallocation_body'] = 'Ciao {$a->user_fullname},

la tua assegnazione al programma "{$a->program_fullname}" è stata rimossa.
';
$string['notification_deallocation_description'] = 'Notifica inviata agli utenti quando la loro assegnazione al programma viene rimossa.';
$string['notification_duesoon'] = 'Data di scadenza programma vicina';
$string['notification_duesoon_subject'] = 'Il completamento del programma è previsto a breve';
$string['notification_duesoon_body'] = 'Ciao {$a->user_fullname},

il completamento del programma "{$a->program_fullname}" è previsto per il {$a->program_duedate}.
';
$string['notification_duesoon_description'] = 'Notifica inviata agli utenti prima della data di completamento del programma, a meno che il programma non sia già stato completato.';
$string['notification_duesoon_relateduser'] = 'Data di scadenza programma vicina: utente correlato';
$string['notification_duesoon_relateduser_subject'] = 'L\'utente {$a->user_fullname} dovrebbe completare il programma a breve';
$string['notification_duesoon_relateduser_body'] = 'Ciao {$a->relateduser_fullname},

l\'utente {$a->user_fullname} dovrebbe completare il programma "{$a->program_fullname}" il {$a->program_duedate}.
';
$string['notification_duesoon_relateduser_description'] = 'Notifica inviata agli utenti correlati all\'utente prima della data prevista per il completamento del programma da parte di quest\'ultimo, a meno che il programma non sia già stato completato.';
$string['notification_due'] = 'Scadenza programma superata';
$string['notification_due_subject'] = 'Era previsto il completamento del programma';
$string['notification_due_body'] = 'Ciao {$a->user_fullname},

il completamento del programma "{$a->program_fullname}" era previsto per il {$a->program_duedate}.
';
$string['notification_due_description'] = 'Notifica inviata agli utenti quando la scadenza per il completamento del programma è stata superata.';
$string['notification_due_relateduser'] = 'Scadenza programma superata: utente correlato';
$string['notification_due_relateduser_subject'] = 'L\'utente {$a->user_fullname} avrebbe dovuto completare il programma';
$string['notification_due_relateduser_body'] = 'Ciao {$a->relateduser_fullname},

l\'utente {$a->user_fullname} avrebbe dovuto completare il programma "{$a->program_fullname}" il {$a->program_duedate}.
';
$string['notification_due_relateduser_description'] = 'Notifica inviata agli utenti correlati all\'utente quando la data prevista per il completamento del programma da parte di quest\'ultimo è stata superata.';
$string['notification_endsoon'] = 'Data di fine programma vicina';
$string['notification_endsoon_subject'] = 'Il programma terminerà a breve';
$string['notification_endsoon_body'] = 'Ciao, {$a->user_fullname},

il programma "{$a->program_fullname}" terminerà il {$a->program_enddate}.
';
$string['notification_endsoon_description'] = 'Notifica inviata agli utenti prima della data di fine del programma, a meno che il programma non sia già stato completato.';
$string['notification_endsoon_relateduser'] = 'Data di fine del programma vicina: utente correlato';
$string['notification_endsoon_relateduser_subject'] = 'Il programma terminerà a breve per l\'utente {$a->user_fullname}';
$string['notification_endsoon_relateduser_body'] = 'Ciao {$a->relateduser_fullname},

il programma "{$a->program_fullname}" terminerà il {$a->program_enddate} per l\'utente {$a->user_fullname}.
';
$string['notification_endsoon_relateduser_description'] = 'Notifica inviata agli utenti correlati all\'utente prima della data prevista per la fine del programma per quest\'ultimo, a meno che il programma non sia già stato completato.';
$string['notification_endcompleted'] = 'Programma terminato completato';
$string['notification_endcompleted_subject'] = 'Programma terminato completato';
$string['notification_endcompleted_body'] = 'Ciao {$a->user_fullname},

il programma "{$a->program_fullname}" è terminato. L\'hai completato in anticipo.
';
$string['notification_endcompleted_description'] = 'Notifica inviata agli utenti quando termina il programma che hanno completato.';
$string['notification_endfailed'] = 'Programma terminato non completato';
$string['notification_endfailed_subject'] = 'Programma terminato non completato';
$string['notification_endfailed_body'] = 'Ciao {$a->user_fullname},

il programma "{$a->program_fullname}" è terminato. Non sei riuscito a completarlo.
';
$string['notification_endfailed_description'] = 'Notifica inviata agli utenti quando termina il programma che non sono riusciti a completare.';
$string['notification_endfailed_relateduser'] = 'Programma terminato non completato: utente correlato';
$string['notification_endfailed_relateduser_subject'] = 'Programma terminato non completato per l\'utente {$a->user_fullname}';
$string['notification_endfailed_relateduser_body'] = 'Ciao {$a->relateduser_fullname},

il programma "{$a->program_fullname}" è terminato. L\'utente {$a->user_fullname} non è riuscito a completarlo.
';
$string['notification_endfailed_relateduser_description'] = 'Notifica inviata agli utenti correlati all\'utente quando termina il programma che quest\'ultimo non è riuscito a completare.';
$string['notification_relateduserfield'] = 'Campo notifica utente correlato';
$string['notification_relateduserfield_desc'] = 'Seleziona il campo del profilo degli utenti correlati da utilizzare per la notifica agli utenti correlati.';
$string['notification_reset'] = 'Ripristino dell\'avanzamento dell\'utente';
$string['notification_reset_subject'] = 'Notifica di ripristino programma';
$string['notification_reset_body'] = 'Ciao, {$a->user_fullname},

il tuo avanzamento nel programma "{$a->program_fullname}" è stato ripristinato.
';
$string['notification_reset_description'] = 'Notifica inviata agli utenti quando il loro avanzamento nel programma è stato ripristinato.';
$string['notification_start'] = 'Programma iniziato';
$string['notification_start_subject'] = 'Programma iniziato';
$string['notification_start_body'] = 'Ciao {$a->user_fullname},

il programma "{$a->program_fullname}" è iniziato.
';
$string['notification_start_description'] = 'Notifica inviata agli utenti quando il loro programma è iniziato.';
$string['notificationdates'] = 'Date di notifica';
$string['notset'] = 'Non impostato';
$string['plugindisabled'] = 'Il plugin per l\'iscrizione ai programmi è disabilitato, i programmi non funzionano.

[Enable plugin now] ({$a->url})';
$string['pluginname'] = 'Programmi';
$string['pluginname_desc'] = 'I programmi sono progettati per consentire la creazione di set di corsi.';
$string['privacy:metadata:field:programid'] = 'ID programma';
$string['privacy:metadata:field:userid'] = 'ID utente';
$string['privacy:metadata:field:allocationid'] = 'ID assegnazione programma';
$string['privacy:metadata:field:sourceid'] = 'Origine di assegnazione';
$string['privacy:metadata:field:itemid'] = 'ID elemento';
$string['privacy:metadata:field:timecreated'] = 'Data di creazione';
$string['privacy:metadata:field:timecompleted'] = 'Data di completamento';

$string['privacy:metadata:table:enrol_programs_allocations'] = 'Informazioni sulle assegnazioni dei programmi';
$string['privacy:metadata:field:archived'] = 'È il record archiviato';
$string['privacy:metadata:field:sourcedatajson'] = 'Informazioni sull\'origine dell\'assegnazione';
$string['privacy:metadata:field:timeallocated'] = 'Data di assegnazione programma';
$string['privacy:metadata:field:timestart'] = 'Data di inizio';
$string['privacy:metadata:field:timedue'] = 'Data di scadenza';
$string['privacy:metadata:field:timeend'] = 'Data di fine';

$string['privacy:metadata:table:enrol_programs_certs_issues'] = 'Problemi con il certificato di assegnazione programma';
$string['privacy:metadata:field:issueid'] = 'ID problema';

$string['privacy:metadata:table:enrol_programs_completions'] = 'Completamenti assegnazioni programmi';

$string['privacy:metadata:table:enrol_programs_evidences'] = 'Informazioni su altre prove di completamento';
$string['privacy:metadata:field:evidencejson'] = 'Informazioni sulla prova di completamento';
$string['privacy:metadata:field:createdby'] = 'Prova creata da';

$string['privacy:metadata:table:enrol_programs_requests'] = 'Informazioni sulla richiesta di assegnazione';
$string['privacy:metadata:field:datajson'] = 'Informazioni sulla richiesta';
$string['privacy:metadata:field:timerequested'] = 'Data richiesta';
$string['privacy:metadata:field:timerejected'] = 'Data rifiuto';
$string['privacy:metadata:field:rejectedby'] = 'Richiesta respinta da';


$string['privacy:metadata:table:enrol_programs_usr_snapshots'] = 'Istantanee assegnazioni programmi';
$string['privacy:metadata:field:reason'] = 'Motivo';
$string['privacy:metadata:field:timesnapshot'] = 'Data istantanea';
$string['privacy:metadata:field:snapshotby'] = 'Istantanea creata da';
$string['privacy:metadata:field:explanation'] = 'Spiegazione';
$string['privacy:metadata:field:completionsjson'] = 'Informazioni sul completamento';
$string['privacy:metadata:field:evidencesjson'] = 'Informazioni sulla prova di completamento';

$string['privacy:metadata:table:enrol_programs_src_commholds'] = 'Prenotazioni delle assegnazioni Commerce';
$string['privacy:metadata:field:quantity'] = 'Quantità';

$string['program'] = 'Programma';
$string['programautofix'] = 'Programma di autoriparazione';
$string['programdue'] = 'Programma in scadenza';
$string['programdue_help'] = 'La data di scadenza del programma indica entro quando gli utenti devono completare il programma.';
$string['programdue_delay'] = 'Scadenza dopo l\'inizio';
$string['programdue_date'] = 'Data di scadenza';
$string['programend'] = 'Fine programma';
$string['programend_help'] = 'Gli utenti non possono accedere ai corsi del programma dopo la sua conclusione.';
$string['programend_delay'] = 'Fine dopo l\'inizio';
$string['programend_date'] = 'Data di fine programma';
$string['programcompletion'] = 'Data di completamento programma';
$string['programcompletionoverride'] = 'Ignora completamento programma';
$string['programidnumber'] = 'Numero ID programma';
$string['programimage'] = 'Immagine programma';
$string['programname'] = 'Nome programma';
$string['programurl'] = 'URL programma';
$string['programs'] = 'Programmi';
$string['programsactive'] = 'Attivo';
$string['programsarchived'] = 'Archiviato';
$string['programsarchived_help'] = 'I programmi archiviati sono nascosti agli utenti e il loro avanzamento è bloccato.';
$string['programslayout'] = 'Layout dettagliato della pagina dei programmi';
$string['programslayout_desc'] = 'Controlla il layout dei programmi - visualizzazione a tabella o a griglia per la pagina my/programs.';
$string['programslayoutallowuserswitch'] = 'Consenti agli utenti di cambiare il layout dei programmi';
$string['programslayoutallowuserswitch_desc'] = 'Consenti agli utenti di cambiare il layout dei programmi';
$string['programslayout_desc'] = 'Controlla il layout dei programmi - visualizzazione a tabella o a griglia per la pagina my/programs.';
$string['programsblocklayout'] = 'I miei programmi bloccano il layout';
$string['programsblocklayout_desc'] = 'Controlla il layout dei programmi - visualizzazione a tabella o a griglia per il blocco myprograms.';

$string['programstart'] = 'Inizio programma';
$string['programstart_help'] = 'Gli utenti non possono accedere ai corsi del programma prima del suo inizio.';
$string['programstart_allocation'] = 'Inizia immediatamente dopo l\'assegnazione';
$string['programstart_delay'] = 'Ritardo nell\'avvio dopo l\'assegnazione';
$string['programstart_date'] = 'Data di inizio programma';
$string['programstatus'] = 'Stato programma';
$string['programstatus_completed'] = 'Completato';
$string['programstatus_any'] = 'Qualsiasi stato del programma';
$string['programstatus_archived'] = 'Archiviato';
$string['programstatus_archivedcompleted'] = 'Completato archiviato';
$string['programstatus_overdue'] = 'Fuori tempo massimo';
$string['programstatus_open'] = 'Apri';
$string['programstatus_future'] = 'Non ancora aperto';
$string['programstatus_failed'] = 'Non completato';
$string['programs:addcourse'] = 'Aggiungi corso ai programmi';
$string['programs:addtocertifications'] = 'Aggiungi programma alle certificazioni';
$string['programs:addtoplan'] = 'Aggiungi programma ai piani';
$string['programs:allocate'] = 'Assegna studenti ai programmi';
$string['programs:archive'] = 'Archivia le assegnazioni dei programmi';
$string['programs:clone'] = 'Consenti la clonazione del contenuto e delle impostazioni del programma';
$string['programs:configframeworks'] = 'Configura la disponibilità del programma nei framework dei piani';
$string['programs:configurecustomfields'] = 'Configura i campi personalizzati dei programmi';
$string['programs:delete'] = 'Elimina programmi';
$string['programs:edit'] = 'Aggiungi e aggiorna programmi';
$string['programs:export'] = 'Esporta programmi';
$string['programs:admin'] = 'Amministrazione avanzata programmi';
$string['programs:manageallocation'] = 'Gestisci le assegnazioni degli utenti';
$string['programs:manageevidence'] = 'Gestisci altre prove di completamento';
$string['programs:reset'] = 'Ripristina l\'avanzamento nel programma';
$string['programs:upload'] = 'Carica programmi';
$string['programs:view'] = 'Visualizza gestione dei programmi';
$string['programs:viewcatalogue'] = 'Accedi al catalogo programmi';
$string['public'] = 'Pubblico';
$string['public_help'] = 'I programmi pubblici sono visibili a tutti gli utenti.

Lo stato di visibilità non influisce sui programmi già assegnati.';
$string['purchaseaccess'] = 'Acquista accesso';
$string['resetallocation'] = 'Ripristina l\'avanzamento nel programma';
$string['resettype'] = 'Tipo di ripristino';
$string['resettype_deallocate'] = 'Solo la rimozione delle assegnazioni del programma';
$string['resettype_full'] = 'Svuotamento completo del corso';
$string['resettype_none'] = 'Nessuno';
$string['resettype_standard'] = 'Svuotamento standard del corso';
$string['sequencetype'] = 'Tipo di completamento';
$string['sequencetype_allinorder'] = 'Tutti nell\'ordine';
$string['sequencetype_allinanyorder'] = 'Tutti in qualunque ordine';
$string['sequencetype_atleast'] = 'Almeno {$a->min}';
$string['sequencetype_minpoints'] = 'Minimo {$a->minpoints} punti';
$string['selectcategory'] = 'Seleziona categoria';
$string['sortbyprogramname'] = 'Ordina per nome del programma';
$string['sortbyprogramid'] = 'Ordina per ID del programma';
$string['sortbyprogramstart'] = 'Ordina per data di inizio del programma';
$string['sortbyprogramdue'] = 'Ordina per data di scadenza del programma';
$string['sortbyprogramend'] = 'Ordina per data di fine programma';
$string['source'] = 'Origine';
$string['source_approval'] = 'Richieste con approvazione';
$string['source_approval_allownew'] = 'Consenti approvazioni';
$string['source_approval_allownew_desc'] = 'Consenti l\'aggiunta ai programmi di nuove origini di _richieste con approvazione_';
$string['source_approval_allowrequest'] = 'Consenti nuove richieste';
$string['source_approval_confirm'] = 'Confermare che si desidera richiedere l\'assegnazione al programma.';
$string['source_approval_daterequested'] = 'Dati richiesti';
$string['source_approval_daterejected'] = 'Data di rifiuto';
$string['source_approval_makerequest'] = 'Richiedi accesso';
$string['source_approval_notification_approval_request_subject'] = 'Notifica di richiesta programma';
$string['source_approval_notification_approval_request_body'] = '
L\'utente {$a->user_fullname} ha presentato richiesta di accesso al programma "{$a->program_fullname}".
';
$string['source_approval_notification_approval_reject_subject'] = 'Notifica di rifiuto richiesta programma';
$string['source_approval_notification_approval_reject_body'] = 'Ciao {$a->user_fullname},

la tua richiesta di accesso al programma "{$a->program_fullname}" è stata respinta.

{$a->reason}
';
$string['source_approval_requestallowed'] = 'Le richieste sono consentite';
$string['source_approval_requestnotallowed'] = 'Le richieste non sono consentite';
$string['source_approval_requests'] = 'Richieste';
$string['source_approval_requestpending'] = 'Richiesta di accesso in attesa di risposta';
$string['source_approval_requestrejected'] = 'La richiesta di accesso è stata respinta';
$string['source_approval_requestapprove'] = 'Approva richiesta';
$string['source_approval_requestreject'] = 'Rifiuta richiesta';
$string['source_approval_requestdelete'] = 'Elimina richiesta';
$string['source_approval_rejectionreason'] = 'Motivo rifiuto';
$string['source_certify'] = 'Certificazioni';
$string['source_certify_allownew'] = 'Consenti assegnazione certificazioni';
$string['source_certify_allownew_desc'] = 'Consenti l\'aggiunta di nuove origini di _certificazione_ ai programmi';
$string['source_cohort'] = 'Assegnazione automatica coorte';
$string['source_cohort_allownew'] = 'Consenti assegnazione coorte';
$string['source_cohort_allownew_desc'] = 'Consenti l\'aggiunta ai programmi di nuove origini di _assegnazione automatica coorte_';
$string['source_cohort_cohortstoallocate'] = 'Assegna coorti';
$string['source_ecommerce'] = 'Assegnazione E-Commerce';
$string['source_ecommerce_allownew'] = 'Consenti assegnazione e-commerce';
$string['source_ecommerce_allownew_desc'] = 'Consenti l\'aggiunta di nuove origini di assegnazione automatica e-commerce ai programmi';
$string['source_ecommerce_allowsignup'] = 'Consenti nuove assegnazioni';
$string['source_ecommerce_cohortmembershiprequirement'] = 'Gli utenti devono essere membri di una delle seguenti coorti: {$a}';
$string['source_ecommerce_maxusers'] = 'Numero max di utenti';
$string['source_ecommerce_nocapacity'] = 'Questo programma ha esaurito la capienza';
$string['source_manual'] = 'Assegnazione manuale';
$string['source_manual_allocateusers'] = 'Assegna utenti';
$string['source_manual_csvfile'] = 'File CSV';
$string['source_manual_hasheaders'] = 'La prima riga è l\'intestazione';
$string['source_manual_potusersmatching'] = 'Candidati all\'assegnazione corrispondenti';
$string['source_manual_potusers'] = 'Candidati all\'assegnazione';
$string['source_manual_result_assigned'] = '{$a} utenti sono stati assegnati al programma.';
$string['source_manual_result_errors'] = '{$a} errori rilevati durante l\'assegnazione dei programmi.';
$string['source_manual_result_skipped'] = '{$a} utenti sono già stati assegnati al programma.';
$string['source_manual_timeduecolumn'] = 'Colonna orario di scadenza';
$string['source_manual_timeendcolumn'] = 'Colonna orario di fine';
$string['source_manual_timestartcolumn'] = 'Colonna orario di inizio';
$string['source_manual_uploadusers'] = 'Aggiorna assegnazioni';
$string['source_manual_usercolumn'] = 'Colonna di identificazione utente';
$string['source_manual_usermapping'] = 'Mappatura utente tramite';
$string['source_manual_userupload_allocated'] = 'Assegnato a \'{$a}\'';
$string['source_manual_userupload_alreadyallocated'] = 'Già assegnato a \'{$a}\'';
$string['source_manual_userupload_invalidprogram'] = 'Impossibile assegnare a \'{$a}\'';
$string['source_selfallocation'] = 'Auto-assegnazione';
$string['source_selfallocation_allocate'] = 'Iscriviti';
$string['source_selfallocation_allownew'] = 'Consenti auto-assegnazione';
$string['source_selfallocation_allownew_desc'] = 'Consenti l\'aggiunta ai programmi di nuove origini di _auto-assegnazione_';
$string['source_selfallocation_allowsignup'] = 'Consenti nuove iscrizioni';
$string['source_selfallocation_confirm'] = 'Confermare che si desidera essere assegnati al programma.';
$string['source_selfallocation_enable'] = 'Abilita auto-assegnazione';
$string['source_selfallocation_key'] = 'Tasto di iscrizione';
$string['source_selfallocation_keyrequired'] = 'La chiave di iscrizione è obbligatoria';
$string['source_selfallocation_maxusers'] = 'Numero max di utenti';
$string['source_selfallocation_maxusersreached'] = 'Numero massimo di utenti già auto-assegnati';
$string['source_selfallocation_maxusers_status'] = 'Utenti {$a->count}/{$a->max}';
$string['source_selfallocation_signupallowed'] = 'Le iscrizioni sono consentite';
$string['source_selfallocation_signupnotallowed'] = 'Le iscrizioni non sono consentite';
$string['source_udplans'] = 'Piani di sviluppo degli utenti';
$string['source_udplans_allownew'] = 'Piani di sviluppo degli utenti';
$string['source_udplans_allownew_desc'] = 'Consenti l\'aggiunta di nuove origini di _piani di sviluppo degli utenti_ ai programmi';
$string['source_udplans_allowed'] = 'Consentito';
$string['source_udplans_noframeworks'] = 'Impossibile aggiungere ai piani';
$string['source_udplans_notallowed'] = 'Non consentito';
$string['source_udplans_requirecap'] = 'Aggiungi capacità richiesta';
$string['set'] = 'Set di corsi';
$string['settings'] = 'Impostazioni programma';
$string['scheduling'] = 'Pianificazione';
$string['taballocation'] = 'Impostazioni assegnazione';
$string['tabcontent'] = 'Contenuto';
$string['tabgeneral'] = 'Introduzione';
$string['tabusers'] = 'Utenti';
$string['tabvisibility'] = 'Impostazioni visibilità';
$string['tagarea_enrol_programs_programs'] = 'Programmi';
$string['taskcertificate'] = 'Cron di rilascio certificati programmi';
$string['taskcron'] = 'Cron plugin programmi';
$string['training'] = 'Formazione';
$string['trainingcompletion'] = 'Formazione richiesta: {$a}';
$string['trainingprogress'] = 'Progressi della formazione: {$a->current}/{$a->total}';
$string['unarchive'] = 'Ripristina';
$string['unlinkeditems'] = 'Elementi non collegati';
$string['updateprogram'] = 'Aggiorna programma';
$string['updateallocation'] = 'Aggiorna assegnazione';
$string['updateallocations'] = 'Aggiorna assegnazioni';
$string['updatecourse'] = 'Aggiorna corso';
$string['updateset'] = 'Aggiorna set';
$string['updatescheduling'] = 'Aggiorna pianificazione';
$string['updatesource'] = 'Aggiorna {$a}';
$string['updatetraining'] = 'Aggiorna formazione';
$string['upload'] = 'Carica programmi';
$string['upload_invalidcount'] = 'Record non validi';
$string['upload_files'] = 'File';
$string['upload_files_error'] = 'Sono previsti più file CSV, un file JSON o un archivio zip';
$string['upload_preview'] = 'Anteprima dati';
$string['upload_status'] = 'Stato';
$string['upload_status_invalid'] = 'Non valido';
$string['upload_targetcontext'] = 'Aggiungi programmi al contesto';
$string['upload_uploadcount'] = 'Programmi da caricare';
$string['upload_usecategory'] = 'Utilizza la colonna della categoria per i contesti';
$string['userupload_completion_error'] = 'Impossibile aggiornare il completamento del programma';
$string['userupload_completion_updated'] = 'Il completamento del programma è stato aggiornato';

$string['rb_allocatedprograms'] = 'Programmi assegnati';
$string['rb_complete'] = 'Completo';
$string['rb_completiondate'] = 'Data di completamento';
$string['rb_completionstatus'] = 'Stato di completamento';
$string['rb_datecompleted'] = 'Data di completamento';
$string['rb_dateallocated'] = 'Data di assegnazione';
$string['rb_datestarted'] = 'Data di inizio';
$string['rb_coursesall'] = 'Corso/i - Tutti';
$string['rb_incomplete'] = 'Incompleto';
$string['rb_isallocated'] = 'È assegnato';
$string['rb_iscomplete'] = 'È completo?';
$string['rb_iscompleteany'] = 'È completo? (qualsiasi metodo)';
$string['rb_isinprogress'] = 'È in corso?';
$string['rb_isnotcomplete'] = 'Non è completo?';
$string['rb_isnotyetstarted'] = 'Non ancora iniziato?';
$string['rb_notstarted'] = 'Non iniziato';
$string['rb_officewhencompletedbasic'] = 'Ufficio una volta completato (base)';
$string['rb_privacy:metadata'] = 'Il plugin non memorizza dati personali.';
$string['rb_programcategory'] = 'Categoria programma (o sito)';
$string['rb_programcategoryid'] = 'ID categoria programma (N/D se sito)';
$string['rb_programcategoryidnumber'] = 'Numero ID categoria programma (N/D se sito)';
$string['rb_programcategorymultichoice'] = 'Categoria programma (scelta multipla)';
$string['rb_programedatecreated'] = 'Data di creazione programma';
$string['rb_programduedate'] = 'Data di scadenza programma';
$string['rb_programenddate'] = 'Data di fine assegnazione programma';
$string['rb_programallocationtype'] = 'Tipo di assegnazione';
$string['rb_programallocationtypes'] = 'Tipi di assegnazione';
$string['rb_programexpandlink'] = 'Nome programma (dettagli espandibili)';
$string['rb_programid'] = 'ID programma';
$string['rb_programidnumber'] = 'Numero ID programma';
$string['rb_programname'] = 'Nome programma';
$string['rb_programnameandsummary'] = 'Nome e descrizione programma';
$string['rb_programnamelinked'] = 'Nome programma (collegato alla pagina del programma)';
$string['rb_programmultiitem'] = 'Programma (elementi multipli)';
$string['rb_programsingleitem'] = 'Programma';
$string['rb_programstartdate'] = 'Data di inizio assegnazione programma';
$string['rb_programsummary'] = 'Descrizione programma';
$string['rb_programvisible'] = 'Il programma è pubblico';
$string['rb_programvisibledisabled'] = 'Programma visibile (non applicabile)';
$string['rb_progress'] = 'Avanzamento';
$string['rb_progressnumeric'] = 'Avanzamento (numerico)';
$string['rb_progresspercent'] = 'Avanzamento (percentuale di completamento)';
$string['rb_source_allocation'] = 'Assegnazioni programmi';
$string['rb_timetocompletesinceenrol'] = 'Tempo di completamento (dalla data di assegnazione)';
$string['rb_timetocompletesincestart'] = 'Tempo di completamento (dalla data di inizio)';
$string['rb_type_program'] = 'Programma';
$string['rb_type_program_category'] = 'Categoria';
$string['rb_type_program_completion'] = 'Assegnazione programmi';
$string['rb_type_program_customfields'] = 'Campi personalizzati programma';
$string['rb_user'] = 'Utente';
$string['rb_viewprogram'] = 'Visualizza programma';
$string['rb_visiblecohorts'] = 'Coorti con visibilità';
