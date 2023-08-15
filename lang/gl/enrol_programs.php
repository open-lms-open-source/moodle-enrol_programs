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
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['addprogram'] = 'Engadir programa';
$string['addset'] = 'Engadir novo conxunto';
$string['allocationend'] = 'Fin da asignación';
$string['allocationend_help'] = 'O significado da data límite da asignación depende das fontes de asignación activadas. Normalmente, non é posible realizar novas asignacións despois de especificar esta data.';
$string['allocation'] = 'Asignación';
$string['allocations'] = 'Asignacións';
$string['programallocations'] = 'Asignacións de programas';
$string['allocationdate'] = 'Data de asignación';
$string['allocationsources'] = 'Fontes de asignación';
$string['allocationstart'] = 'Comezo da asignación';
$string['allocationstart_help'] = 'O significado da data de comezo da asignación depende das fontes de asignación activadas. Normalmente, só se poden realizar novas asignacións despois desta data se se especifica concretamente.';
$string['allprograms'] = 'Tódolos programas';
$string['appenditem'] = 'Anexar elemento';
$string['appendinto'] = 'Anexar ó elemento';
$string['archived'] = 'Arquivado';
$string['catalogue'] = 'Catálogo de programas';
$string['catalogue_dofilter'] = 'Buscar';
$string['catalogue_resetfilter'] = 'Borrar';
$string['catalogue_searchtext'] = 'Buscar texto';
$string['catalogue_tag'] = 'Filtrar por etiqueta';
$string['certificatetemplatechoose'] = 'Elixe un modelo...';
$string['cohorts'] = 'Visible para as cohortes';
$string['cohorts_help'] = 'Os programas privados poden facerse visibles para certos membros da cohorte.

O estado da visibilidade non afecta ós programas que xa foron asignados.';
$string['completiondate'] = 'Data de finalización';
$string['creategroups'] = 'Grupos do curso';
$string['creategroups_help'] = 'En caso de activarse, crearase un grupo en cada curso engadido ó programa e tódolos usuarios asignados serán engadidos como membros do grupo.';
$string['deleteallocation'] = 'Borrar asignación do programa';
$string['deletecourse'] = 'Eliminar curso';
$string['deleteprogram'] = 'Borrar programa';
$string['deleteset'] = 'Eliminar conxunto';
$string['documentation'] = 'Programas para a documentación de Moodle';
$string['duedate'] = 'Prazo de entrega';
$string['enrolrole'] = 'Rol no curso';
$string['enrolrole_desc'] = 'Selecciona o rol que usarán os programas para inscribirte no curso';
$string['errorcontentproblem'] = 'Detectouse un problema na estrutura do contido do programa. Non se poderá seguir correctamente a finalización do programa.';
$string['errordifferenttenant'] = 'Non se pode acceder ó programa doutro arrendatario';
$string['errornoallocations'] = 'Non se atoparon asignacións de usuarios';
$string['errornoallocation'] = 'O programa non está asignado';
$string['errornomyprograms'] = 'Non estás asignado a ningún programa.';
$string['errornoprograms'] = 'Non se atopou ningún programa.';
$string['errornorequests'] = 'Non se atoparon solicitudes de programas';
$string['errornotenabled'] = 'O complemento de programas non está activado';
$string['event_program_completed'] = 'Programa completado';
$string['event_program_created'] = 'Programa creado';
$string['event_program_deleted'] = 'Programa eliminado';
$string['event_program_updated'] = 'Programa actualizado';
$string['event_program_viewed'] = 'Programa visto';
$string['event_user_allocated'] = 'Usuario asignado ó programa';
$string['event_user_deallocated'] = 'Usuario desasignado do programa';
$string['evidence'] = 'Outras probas';
$string['evidence_details'] = 'Detalles';
$string['fixeddate'] = 'Nunha data fixa';
$string['item'] = 'Elemento';
$string['itemcompletion'] = 'Finalización de elementos do programa';
$string['management'] = 'Xestión de programas';
$string['messageprovider:allocation_notification'] = 'Notificación de asignación do programa';
$string['messageprovider:approval_request_notification'] = 'Notificación de solicitude de aprobación do programa';
$string['messageprovider:approval_reject_notification'] = 'Notificación de rexeitamento de solicitude de programa';
$string['messageprovider:completion_notification'] = 'Notificación de finalización do programa';
$string['messageprovider:deallocation_notification'] = 'Notificación de desasignación do programa';
$string['messageprovider:duesoon_notification'] = 'Notificación de aproximación do prazo do programa';
$string['messageprovider:due_notification'] = 'Notificación de prazo do programa superado';
$string['messageprovider:endsoon_notification'] = 'Notificación de aproximación da data límite do programa';
$string['messageprovider:endcompleted_notification'] = 'Notificación de finalización do programa completado';
$string['messageprovider:endfailed_notification'] = 'Notificación de finalización do programa con erros';
$string['messageprovider:start_notification'] = 'Notificación de programa comezado';
$string['moveitem'] = 'Mover elemento';
$string['moveitemcancel'] = 'Cancelar movemento';
$string['moveafter'] = 'Mover "{$a->item}" despois de "{$a->target}"';
$string['movebefore'] = 'Mover "{$a->item}" antes de "{$a->target}"';
$string['moveinto'] = 'Mover "{$a->item}" a "{$a->target}"';
$string['myprograms'] = 'Os meus programas';
$string['notification_allocation'] = 'Usuario asignado';
$string['notification_completion'] = 'Programa completado';
$string['notification_completion_subject'] = 'Programa completado';
$string['notification_completion_body'] = 'Ola, {$a->user_fullname}:

Completaches o programa "{$a->program_fullname}".'
;
$string['notification_deallocation'] = 'Usuario desasignado';
$string['notification_duesoon'] = 'O prazo de entrega do programa está próximo';
$string['notification_duesoon_subject'] = 'Non deberías tardar en finalizar o programa';
$string['notification_duesoon_body'] = 'Ola, {$a->user_fullname}:

Espérase que o programa "{$a->program_fullname}" estea completado o {$a->program_duedate}.'
;
$string['notification_due'] = 'Superouse o prazo de entrega do programa';
$string['notification_due_subject'] = 'Esperábase que o programa xa estivese completado.';
$string['notification_due_body'] = 'Ola, {$a->user_fullname}:

Esperábase que o programa "{$a->program_fullname}" se completase o {$a->program_duedate}.'
;
$string['notification_endsoon'] = 'A data límite do programa está próxima';
$string['notification_endsoon_subject'] = 'O programa finalizará axiña';
$string['notification_endsoon_body'] = 'Ola, {$a->user_fullname}:

o programa "{$a->program_fullname}" finaliza o {$a->program_enddate}.'
;
$string['notification_endcompleted'] = 'O programa completado finalizou.';
$string['notification_endcompleted_subject'] = 'O programa completado finalizou.';
$string['notification_endcompleted_body'] = 'Ola, {$a->user_fullname}:

O programa "{$a->program_fullname}" finalizou e completáchelo antes do prazo.'
;
$string['notification_endfailed'] = 'O programa finalizou con erros';
$string['notification_endfailed_subject'] = 'O programa finalizou con erros';
$string['notification_endfailed_body'] = 'Ola, {$a->user_fullname}:

O programa "{$a->program_fullname}" finalizou e non conseguiches completalo.'
;
$string['notification_start'] = 'O programa comezou';
$string['notification_start_subject'] = 'O programa comezou';
$string['notification_start_body'] = 'Ola, {$a->user_fullname}:

O programa "{$a->program_fullname}" xa comezou.'
;
$string['notificationdates'] = 'Datas de notificación';
$string['notset'] = 'Non establecido';
$string['plugindisabled'] = 'O complemento de inscrición nos programas está desactivado, polo que os programas non funcionarán.

[Activa agora o complemento]({$a->url})';
$string['pluginname'] = 'Programas';
$string['pluginname_desc'] = 'Os programas están deseñados para permitir a creación de conxuntos de cursos.';
$string['privacy:metadata:field:programid'] = 'ID do programa';
$string['privacy:metadata:field:userid'] = 'ID do usuario';
$string['privacy:metadata:field:allocationid'] = 'ID da asignación do programa';
$string['privacy:metadata:field:sourceid'] = 'Fonte da asignación';
$string['privacy:metadata:field:itemid'] = 'ID do elemento';
$string['privacy:metadata:field:timecreated'] = 'Data de creación';
$string['privacy:metadata:field:timecompleted'] = 'Data de finalización';

$string['privacy:metadata:table:enrol_programs_allocations'] = 'Información sobre as asignacións do programa';
$string['privacy:metadata:field:archived'] = 'O rexistro está arquivado';
$string['privacy:metadata:field:sourcedatajson'] = 'Información sobre a fonte da asignación';
$string['privacy:metadata:field:timeallocated'] = 'Data de asignación do programa';
$string['privacy:metadata:field:timestart'] = 'Data de comezo';
$string['privacy:metadata:field:timedue'] = 'Prazo de entrega';
$string['privacy:metadata:field:timeend'] = 'Data límite';
$string['privacy:metadata:field:timenotifiedallocation'] = 'Hora na que se notificou a asignación do programa';
$string['privacy:metadata:field:timenotifiedstart'] = 'Hora na que se notificou a data de comezo';
$string['privacy:metadata:field:timenotifiedcompleted'] = 'Hora na que se notificou a data de finalización';
$string['privacy:metadata:field:timenotifiedduesoon'] = 'Hora na que se notificou a proximidade do prazo de entrega';
$string['privacy:metadata:field:timenotifieddue'] = 'Hora na que se notificou a chegada do prazo de entrega';
$string['privacy:metadata:field:timenotifiedendsoon'] = 'Hora na que se notificou a proximidade da data límite';
$string['privacy:metadata:field:timenotifiedendcompleted'] = 'Hora na que se notificou a finalización do programa';
$string['privacy:metadata:field:timenotifiedendfailed'] = 'Hora na que se notificou que non se completou o programa';
$string['privacy:metadata:field:timenotifieddeallocation'] = 'Hora na que se notificou a desasignación do programa';

$string['privacy:metadata:table:enrol_programs_certs_issues'] = 'Emisións de certificados de asignación do programa';
$string['privacy:metadata:field:issueid'] = 'ID da emisión';

$string['privacy:metadata:table:enrol_programs_completions'] = 'Finalizacións de asignacións do programa';

$string['privacy:metadata:table:enrol_programs_evidences'] = 'Información sobre outras probas de finalización';
$string['privacy:metadata:field:evidencejson'] = 'Información sobre probas de finalización';
$string['privacy:metadata:field:createdby'] = 'Proba creada por';

$string['privacy:metadata:table:enrol_programs_requests'] = 'Información sobre as solicitudes de asignación';
$string['privacy:metadata:field:datajson'] = 'Información sobre a solicitude';
$string['privacy:metadata:field:timerequested'] = 'Data de solicitude';
$string['privacy:metadata:field:timerejected'] = 'Data de rexeitamento';
$string['privacy:metadata:field:rejectedby'] = 'Solicitude rexeitada por';


$string['privacy:metadata:table:enrol_programs_usr_snapshots'] = 'Capturas da asignacións do programa';
$string['privacy:metadata:field:reason'] = 'Motivo';
$string['privacy:metadata:field:timesnapshot'] = 'Data da captura';
$string['privacy:metadata:field:snapshotby'] = 'Captura feita por';
$string['privacy:metadata:field:explanation'] = 'Explicación';
$string['privacy:metadata:field:completionsjson'] = 'Información sobre a finalización';
$string['privacy:metadata:field:evidencesjson'] = 'Información sobre probas de finalización';

$string['program'] = 'Programa';
$string['programautofix'] = 'Programa de autorreparación';
$string['programdue'] = 'Prazo de entrega do programa';
$string['programdue_help'] = 'O prazo de entrega do programa indica cando deben completalo os usuarios.';
$string['programdue_delay'] = 'Prazo despois do comezo';
$string['programdue_date'] = 'Prazo de entrega';
$string['programend'] = 'Fin do programa';
$string['programend_help'] = 'Os usuarios non poden entrar nos cursos do programa unha vez finalizados.';
$string['programend_delay'] = 'Finalizar despois do comezo';
$string['programend_date'] = 'Data límite do programa';
$string['programcompletion'] = 'Data de finalización do programa';
$string['programidnumber'] = 'Número de ID do programa';
$string['programimage'] = 'Imaxe do programa';
$string['programname'] = 'Nome do programa';
$string['programurl'] = 'URL do programa';
$string['programs'] = 'Programas';
$string['programsactive'] = 'Activo';
$string['programsarchived'] = 'Arquivado';
$string['programsarchived_help'] = 'Os usuarios non poden ver os programas arquivados e o seu progreso queda bloqueado.';
$string['programstart'] = 'Comezo do programa';
$string['programstart_help'] = 'Os usuarios non poden entrar nos cursos do programa antes do seu comezo.';
$string['programstart_allocation'] = 'Comezar inmediatamente despois da asignación';
$string['programstart_delay'] = 'Atrasar o comezo ata despois da asignación';
$string['programstart_date'] = 'Data de comezo do programa';
$string['programstatus'] = 'Estado do programa';
$string['programstatus_completed'] = 'Completado';
$string['programstatus_any'] = 'Calquera estado de programa';
$string['programstatus_archived'] = 'Arquivado';
$string['programstatus_archivedcompleted'] = 'Completouse o arquivamento';
$string['programstatus_overdue'] = 'Fóra de prazo';
$string['programstatus_open'] = 'Aberto';
$string['programstatus_future'] = 'Aínda non está aberto';
$string['programstatus_failed'] = 'Non completado';
$string['programs:addcourse'] = 'Engadir curso ós programas';
$string['programs:allocate'] = 'Asignar estudantes ós programas';
$string['programs:delete'] = 'Borrar programas';
$string['programs:edit'] = 'Engadir e actualizar programas';
$string['programs:admin'] = 'Administración avanzada de programas';
$string['programs:manageevidence'] = 'Xestionar outras probas de finalización';
$string['programs:view'] = 'Ver xestión de programas';
$string['programs:viewcatalogue'] = 'Acceso ó catálogo de programas';
$string['public'] = 'Público';
$string['public_help'] = 'Os programas públicos son visibles para tódolos usuarios.

O estado da visibilidade non afecta ós programas que xa foron asignados.';
$string['sequencetype'] = 'Tipo de finalización';
$string['sequencetype_allinorder'] = 'Todos en orde';
$string['sequencetype_allinanyorder'] = 'Todos en calquera orde';
$string['sequencetype_atleast'] = '{$a->min} como mínimo';
$string['selectcategory'] = 'Seleccionar categoría';
$string['source'] = 'Fonte';
$string['source_approval'] = 'Solicitudes con aprobación';
$string['source_approval_allownew'] = 'Permitir aprobacións';
$string['source_approval_allownew_desc'] = 'Permite engadir novas fontes de _solicitudes con aprobación_ ós programas';
$string['source_approval_allowrequest'] = 'Permitir novas solicitudes';
$string['source_approval_confirm'] = 'Por favor, confirma que queres solicitar que te asignen ó programa.';
$string['source_approval_daterequested'] = 'Data solicitada';
$string['source_approval_daterejected'] = 'Data rexeitada';
$string['source_approval_makerequest'] = 'Solicitar acceso';
$string['source_approval_notification_allocation_subject'] = 'Notificación de aprobación do programa';
$string['source_approval_notification_allocation_body'] = 'Ola, {$a->user_fullname}:

aprobouse a túa inscrición no programa "{$a->program_fullname}" e a súa data de comezo é o {$a->program_startdate}.'
;
$string['source_approval_notification_approval_request_subject'] = 'Notificación de solicitude de programa';
$string['source_approval_notification_approval_request_body'] = '
O usuario {$a->user_fullname} solicitou acceso ó programa "{$a->program_fullname}".'
;
$string['source_approval_notification_approval_reject_subject'] = 'Notificación de rexeitamento de solicitude de programa';
$string['source_approval_notification_approval_reject_body'] = 'Ola, {$a->user_fullname}:

rexeitouse a túa solicitude de acceso ó programa "{$a->program_fullname}".

{$a->reason}
';
$string['source_approval_requestallowed'] = 'Admítense solicitudes';
$string['source_approval_requestnotallowed'] = 'Non se admiten solicitudes';
$string['source_approval_requests'] = 'Solicitudes';
$string['source_approval_requestpending'] = 'Solicitude de acceso pendente';
$string['source_approval_requestrejected'] = 'Rexeitouse a solicitude de acceso';
$string['source_approval_requestapprove'] = 'Aprobar solicitude';
$string['source_approval_requestreject'] = 'Rexeitar solicitude';
$string['source_approval_requestdelete'] = 'Eliminar solicitude';
$string['source_approval_rejectionreason'] = 'Motivo do rexeitamento';
$string['source_base_notification_allocation_subject'] = 'Notificación de asignación do programa';
$string['source_base_notification_allocation_body'] = 'Ola, {$a->user_fullname}:

Estás asignado ó programa "{$a->program_fullname}", que comeza o {$a->program_startdate}.'
;
$string['source_base_notification_deallocation_subject'] = 'Notificación de desasignación do programa';
$string['source_base_notification_deallocation_body'] = 'Ola, {$a->user_fullname}:

Desasignáronte do programa "{$a->program_fullname}".
';
$string['source_cohort'] = 'Asignación automática de cohortes';
$string['source_cohort_allownew'] = 'Permitir a asignación de cohortes';
$string['source_cohort_allownew_desc'] = 'Permitir que se engadan novas fontes de _autoasignación de cohortes_ ós programas';
$string['source_manual'] = 'Asignación manual';
$string['source_manual_allocateusers'] = 'Asignar usuarios';
$string['source_manual_csvfile'] = 'Ficheiro CSV';
$string['source_manual_hasheaders'] = 'A primeira liña é o encabezamento';
$string['source_manual_potusersmatching'] = 'Candidatos de asignación compatibles';
$string['source_manual_potusers'] = 'Candidatos de asignación';
$string['source_manual_result_assigned'] = 'Asignáronse {$a} usuarios ó programa.';
$string['source_manual_result_errors'] = 'Detectáronse {$a} erros ó asignar os programas.';
$string['source_manual_result_skipped'] = 'Xa había {$a} usuarios asignados ó programa.';
$string['source_manual_uploadusers'] = 'Cargar asignacións';
$string['source_manual_usercolumn'] = 'Columna de identificación de usuarios';
$string['source_manual_usermapping'] = 'Mapeo de usuarios mediante';
$string['source_manual_userupload_allocated'] = 'Asignado a \'{$a}\'';
$string['source_manual_userupload_alreadyallocated'] = 'Xa estaba asignado a \'{$a}\'';
$string['source_manual_userupload_invalidprogram'] = 'Non se pode asignar a \'{$a}\'';
$string['source_selfallocation'] = 'Autoasignación';
$string['source_selfallocation_allocate'] = 'Inscrición';
$string['source_selfallocation_allownew'] = 'Permitir autoasignación';
$string['source_selfallocation_allownew_desc'] = 'Permitir que se engadan novas fontes de _asignación automática_ ós programas';
$string['source_selfallocation_allowsignup'] = 'Permitir novas inscricións';
$string['source_selfallocation_confirm'] = 'Por favor, confirma que queres que te asignen ó programa.';
$string['source_selfallocation_enable'] = 'Activar autoasignación';
$string['source_selfallocation_key'] = 'Clave de inscrición';
$string['source_selfallocation_keyrequired'] = 'Requírese a clave de inscrición';
$string['source_selfallocation_maxusers'] = 'Número máximo de usuarios';
$string['source_selfallocation_maxusersreached'] = 'Número máximo de usuarios que xa se autoasignaron';
$string['source_selfallocation_maxusers_status'] = 'Usuarios {$a->count}/{$a->max}';
$string['source_selfallocation_notification_allocation_subject'] = 'Notificación de asignación do programa';
$string['source_selfallocation_notification_allocation_body'] = 'Ola, {$a->user_fullname}:

inscribícheste no programa "{$a->program_fullname}", a súa data de comezo é o {$a->program_startdate}.'
;
$string['source_selfallocation_signupallowed'] = 'Admítense rexistros';
$string['source_selfallocation_signupnotallowed'] = 'Non se admiten rexistros';
$string['set'] = 'Conxunto de cursos';
$string['settings'] = 'Configuración do programa';
$string['scheduling'] = 'Planificación';
$string['taballocation'] = 'Configuración de asignación';
$string['tabcontent'] = 'Contido';
$string['tabgeneral'] = 'Xeral';
$string['tabusers'] = 'Usuarios';
$string['tabvisibility'] = 'Configuración de visibilidade';
$string['tagarea_program'] = 'Programas';
$string['taskcertificate'] = 'Cron de emisión de certificados dos programas';
$string['taskcron'] = 'Cron de complemento de programas';
$string['unlinkeditems'] = 'Elementos desvinculados';
$string['updateprogram'] = 'Actualizar programa';
$string['updateallocation'] = 'Actualizar asignación';
$string['updateallocations'] = 'Actualizar asignacións';
$string['updateset'] = 'Actualizar conxunto';
$string['updatescheduling'] = 'Actualizar planificación';
$string['updatesource'] = 'Actualizar {$a}';
