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
$string['archived'] = 'Archiviato';
$string['catalogue'] = 'Catalogo programmi';
$string['catalogue_dofilter'] = 'Ricerca';
$string['catalogue_resetfilter'] = 'Pulisci';
$string['catalogue_searchtext'] = 'Cerca testo';
$string['catalogue_tag'] = 'Filtra per tag';
$string['certificatetemplatechoose'] = 'Scegli un modello...';
$string['cohorts'] = 'Visibile per le coorti';
$string['cohorts_help'] = 'I programmi non pubblici possono essere resi visibili a specifici membri di una coorte.

Lo stato di visibilità non influisce sui programmi già assegnati.';
$string['completiondate'] = 'Data di completamento';
$string['creategroups'] = 'Gruppi del corso';
$string['creategroups_help'] = 'Se questa funzione è abilitata, verrà creato un gruppo per ogni corso aggiunto al programma e tutti gli utenti assegnati verranno aggiunti come membri del gruppo.';
$string['deleteallocation'] = 'Elimina assegnazione programma';
$string['deletecourse'] = 'Rimuovi corso';
$string['deleteprogram'] = 'Elimina programma';
$string['deleteset'] = 'Elimina set';
$string['documentation'] = 'Programmi per documentazione Moodle';
$string['duedate'] = 'Data di scadenza';
$string['enrolrole'] = 'Ruolo di corso';
$string['enrolrole_desc'] = 'Seleziona il ruolo che verrà utilizzato dai programmi per l\'iscrizione al corso';
$string['errorcontentproblem'] = 'Problema rilevato nella struttura dei contenuti del programma, il completamento del programma non verrà monitorato correttamente!';
$string['errordifferenttenant'] = 'Impossibile accedere al programma da un altro tenant';
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
$string['evidence_details'] = 'Dettagli';
$string['fixeddate'] = 'A una data fissa';
$string['item'] = 'Elemento';
$string['itemcompletion'] = 'Completamento elemento programma';
$string['management'] = 'Gestione programma';
$string['messageprovider:allocation_notification'] = 'Notifica di assegnazione programma';
$string['messageprovider:approval_request_notification'] = 'Notifica di richiesta approvazione programma';
$string['messageprovider:approval_reject_notification'] = 'Notifica di rifiuto richiesta programma';
$string['messageprovider:completion_notification'] = 'Notifica di completamento programma';
$string['messageprovider:deallocation_notification'] = 'Notifica di rimozione assegnazione programma';
$string['messageprovider:duesoon_notification'] = 'Notifica prossima data di scadenza programma';
$string['messageprovider:due_notification'] = 'Notifica scadenza programma superata';
$string['messageprovider:endsoon_notification'] = 'Notifica prossima data di fine programma';
$string['messageprovider:endcompleted_notification'] = 'Notifica di programma terminato completato';
$string['messageprovider:endfailed_notification'] = 'Notifica di programma terminato non completato';
$string['messageprovider:start_notification'] = 'Notifica di inizio programma';
$string['moveitem'] = 'Sposta elemento';
$string['moveitemcancel'] = 'Annulla spostamento';
$string['moveafter'] = 'Sposta "{$a->item}" dopo "{$a->target}"';
$string['movebefore'] = 'Sposta "{$a->item}" prima di "{$a->target}"';
$string['moveinto'] = 'Sposta "{$a->item}" in "{$a->target}"';
$string['myprograms'] = 'I miei programmi';
$string['notification_allocation'] = 'Utente assegnato';
$string['notification_completion'] = 'Programma completato';
$string['notification_completion_subject'] = 'Programma completato';
$string['notification_completion_body'] = 'Salve {$a->user_fullname},

hai completato il programma "{$a->program_fullname}".
';
$string['notification_deallocation'] = 'Utente non più assegnato';
$string['notification_duesoon'] = 'Data di scadenza programma vicina';
$string['notification_duesoon_subject'] = 'Il completamento del programma è previsto a breve';
$string['notification_duesoon_body'] = 'Salve {$a->user_fullname},

il completamento del programma "{$a->program_fullname}" è previsto per il {$a->program_duedate}.
';
$string['notification_due'] = 'Scadenza programma superata';
$string['notification_due_subject'] = 'Era previsto il completamento del programma';
$string['notification_due_body'] = 'Salve {$a->user_fullname},

il completamento del programma "{$a->program_fullname}" era previsto entro il {$a->program_duedate}.
';
$string['notification_endsoon'] = 'Data di fine programma vicina';
$string['notification_endsoon_subject'] = 'Il programma terminerà a breve';
$string['notification_endsoon_body'] = 'Salve {$a->user_fullname},

il programma "{$a->program_fullname}" terminerà il {$a->program_enddate}.
';
$string['notification_endcompleted'] = 'Programma terminato completato';
$string['notification_endcompleted_subject'] = 'Programma terminato completato';
$string['notification_endcompleted_body'] = 'Salve {$a->user_fullname},

il programma "{$a->program_fullname}" è terminato, lo hai completato in precedenza.
';
$string['notification_endfailed'] = 'Programma terminato non completato';
$string['notification_endfailed_subject'] = 'Programma terminato non completato';
$string['notification_endfailed_body'] = 'Salve {$a->user_fullname},

il programma "{$a->program_fullname}" è terminato, non lo hai completato.
';
$string['notification_start'] = 'Programma iniziato';
$string['notification_start_subject'] = 'Programma iniziato';
$string['notification_start_body'] = 'Salve {$a->user_fullname},

il programma "{$a->program_fullname}" è iniziato.
';
$string['notificationdates'] = 'Date di notifica';
$string['notset'] = 'Non impostato';
$string['plugindisabled'] = 'Il plugin per l\'iscrizione ai programmi è disabilitato, i programmi non funzionano.

[Enable plugin now]({$a->url})';
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
$string['programidnumber'] = 'Numero ID programma';
$string['programimage'] = 'Immagine programma';
$string['programname'] = 'Nome programma';
$string['programurl'] = 'URL programma';
$string['programs'] = 'Programmi';
$string['programsactive'] = 'Attivi';
$string['programsarchived'] = 'Archiviato';
$string['programsarchived_help'] = 'I programmi archiviati sono nascosti agli utenti e il loro avanzamento è bloccato.';
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
$string['programstatus_overdue'] = 'Scadenza superata';
$string['programstatus_open'] = 'Aperto';
$string['programstatus_future'] = 'Non ancora aperto';
$string['programstatus_failed'] = 'Non completato';
$string['programs:addcourse'] = 'Aggiungi corso ai programmi';
$string['programs:allocate'] = 'Assegna studenti ai programmi';
$string['programs:delete'] = 'Elimina programmi';
$string['programs:edit'] = 'Aggiungi e aggiorna programmi';
$string['programs:admin'] = 'Amministrazione avanzata programmi';
$string['programs:manageevidence'] = 'Gestisci altre prove di completamento';
$string['programs:view'] = 'Visualizza gestione dei programmi';
$string['programs:viewcatalogue'] = 'Accedi al catalogo programmi';
$string['public'] = 'Pubblico';
$string['public_help'] = 'I programmi pubblici sono visibili per tutti gli utenti.

Lo stato di visibilità non influisce sui programmi già assegnati.';
$string['sequencetype'] = 'Tipo di completamento';
$string['sequencetype_allinorder'] = 'Tutti nell\'ordine';
$string['sequencetype_allinanyorder'] = 'Tutti in qualunque ordine';
$string['sequencetype_atleast'] = 'Almeno {$a->min}';
$string['selectcategory'] = 'Seleziona categoria';
$string['source'] = 'Origine';
$string['source_approval'] = 'Richieste con approvazione';
$string['source_approval_allownew'] = 'Consenti approvazioni';
$string['source_approval_allownew_desc'] = 'Consenti l\'aggiunta ai programmi di nuove origini di _richieste con approvazione_';
$string['source_approval_allowrequest'] = 'Consenti nuove richieste';
$string['source_approval_confirm'] = 'Confermare che si desidera richiedere l\'assegnazione al programma.';
$string['source_approval_daterequested'] = 'Dati richiesti';
$string['source_approval_daterejected'] = 'Data di rifiuto';
$string['source_approval_makerequest'] = 'Richiedi accesso';
$string['source_approval_notification_allocation_subject'] = 'Notifica di approvazione programma';
$string['source_approval_notification_allocation_body'] = 'Salve {$a->user_fullname},

la tua iscrizione al programma "{$a->program_fullname}" è stata approvata, la data di inizio è {$a->program_startdate}.
';
$string['source_approval_notification_approval_request_subject'] = 'Notifica di richiesta programma';
$string['source_approval_notification_approval_request_body'] = '
L\'utente {$a->user_fullname} ha presentato richiesta di accesso al programma "{$a->program_fullname}".
';
$string['source_approval_notification_approval_reject_subject'] = 'Notifica di rifiuto richiesta programma';
$string['source_approval_notification_approval_reject_body'] = 'Salve {$a->user_fullname},

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
$string['notification_allocation_subject'] = 'Notifica di assegnazione programma';
$string['notification_allocation_body'] = 'Salve {$a->user_fullname},

sei stato/a assegnato/a al programma "{$a->program_fullname}", la data di inizio è {$a->program_startdate}.
';
$string['notification_deallocation_subject'] = 'Notifica di rimozione assegnazione programma';
$string['notification_deallocation_body'] = 'Salve {$a->user_fullname},

la tua assegnazione al programma "{$a->program_fullname}" è stata rimossa.
';
$string['source_cohort'] = 'Assegnazione automatica coorte';
$string['source_cohort_allownew'] = 'Consenti assegnazione coorte';
$string['source_cohort_allownew_desc'] = 'Consenti l\'aggiunta ai programmi di nuove origini di _assegnazione automatica coorte_';
$string['source_manual'] = 'Assegnazione manuale';
$string['source_manual_allocateusers'] = 'Assegna utenti';
$string['source_manual_csvfile'] = 'File CSV';
$string['source_manual_hasheaders'] = 'La prima riga è l\'intestazione';
$string['source_manual_potusersmatching'] = 'Candidati all\'assegnazione corrispondenti';
$string['source_manual_potusers'] = 'Candidati all\'assegnazione';
$string['source_manual_result_assigned'] = '{$a} sono stati assegnati utenti al programma.';
$string['source_manual_result_errors'] = '{$a} errori rilevati durante l\'assegnazione dei programmi.';
$string['source_manual_result_skipped'] = '{$a} sono già stati assegnati utenti al programma.';
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
$string['source_selfallocation_notification_allocation_subject'] = 'Notifica di assegnazione programma';
$string['source_selfallocation_notification_allocation_body'] = 'Salve {$a->user_fullname},

ti sei iscritto/a al programma "{$a->program_fullname}", la data di inizio è {$a->program_startdate}.
';
$string['source_selfallocation_signupallowed'] = 'Le iscrizioni sono consentite';
$string['source_selfallocation_signupnotallowed'] = 'Le iscrizioni non sono consentite';
$string['set'] = 'Set di corsi';
$string['settings'] = 'Impostazioni programma';
$string['scheduling'] = 'Pianificazione';
$string['taballocation'] = 'Impostazioni assegnazione';
$string['tabcontent'] = 'Contenuto';
$string['tabgeneral'] = 'Introduzione';
$string['tabusers'] = 'Utenti';
$string['tabvisibility'] = 'Impostazioni visibilità';
$string['tagarea_program'] = 'Programmi';
$string['taskcertificate'] = 'Cron di rilascio certificati programmi';
$string['taskcron'] = 'Cron plugin programmi';
$string['unlinkeditems'] = 'Elementi non collegati';
$string['updateprogram'] = 'Aggiorna programma';
$string['updateallocation'] = 'Aggiorna assegnazione';
$string['updateallocations'] = 'Aggiorna assegnazioni';
$string['updateset'] = 'Aggiorna set';
$string['updatescheduling'] = 'Aggiorna pianificazione';
$string['updatesource'] = 'Aggiorna {$a}';
