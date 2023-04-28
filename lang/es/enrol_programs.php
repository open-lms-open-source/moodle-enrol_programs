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

$string['addprogram'] = 'Agregar programa';
$string['addset'] = 'Agregar un nuevo conjunto';
$string['allocationend'] = 'Fin de asignación';
$string['allocationend_help'] = 'El significado de la fecha de finalización de la asignación depende de las fuentes de asignación habilitadas. Por lo general, no es posible realizar una nueva asignación después de esta fecha si se especifica.';
$string['allocation'] = 'Asignación';
$string['allocations'] = 'Asignaciones';
$string['programallocations'] = 'Asignaciones de programas';
$string['allocationdate'] = 'Fecha de asignación';
$string['allocationsources'] = 'Fuentes de asignación';
$string['allocationstart'] = 'Inicio de asignación';
$string['allocationstart_help'] = 'El significado de la fecha de inicio de la asignación depende de las fuentes de asignación habilitadas. Por lo general, solo es posible realizar una nueva asignación después de esta fecha si se especifica.';
$string['allprograms'] = 'Todos los programas';
$string['appenditem'] = 'Anexar elemento';
$string['appendinto'] = 'Anexar a elemento';
$string['archived'] = 'Archivado';
$string['catalogue'] = 'Catálogo de programas';
$string['catalogue_dofilter'] = 'Buscar';
$string['catalogue_resetfilter'] = 'Borrar';
$string['catalogue_searchtext'] = 'Buscar texto';
$string['catalogue_tag'] = 'Filtrar por etiqueta';
$string['certificatetemplatechoose'] = 'Elegir una plantilla...';
$string['cohorts'] = 'Visible para las cohortes';
$string['cohorts_help'] = 'Los programas no públicos pueden hacerse visibles para los miembros de la cohorte especificados.

El estado de visibilidad no afecta a los programas ya asignados.';
$string['completiondate'] = 'Fecha de finalización';
$string['creategroups'] = 'Grupos de cursos';
$string['creategroups_help'] = 'Si se habilita, se creará un grupo en cada curso agregado al programa y todos los usuarios asignados se agregarán como miembros del grupo.';
$string['deleteallocation'] = 'Eliminar asignación de programa';
$string['deletecourse'] = 'Quitar curso';
$string['deleteprogram'] = 'Eliminar programa';
$string['deleteset'] = 'Eliminar conjunto';
$string['documentation'] = 'Programas para documentación de Moodle';
$string['duedate'] = 'Fecha de vencimiento';
$string['enrolrole'] = 'Rol de curso';
$string['enrolrole_desc'] = 'Seleccione la función que utilizarán los programas para la inscripción en los cursos';
$string['errorcontentproblem'] = 'Se ha detectado un problema en la estructura de contenido del programa. No se realizará un seguimiento correcto de la finalización del programa.';
$string['errordifferenttenant'] = 'No se puede acceder al programa de otro abonado';
$string['errornoallocations'] = 'No se han encontrado asignaciones de usuario';
$string['errornoallocation'] = 'El programa no está asignado';
$string['errornomyprograms'] = 'No está asignado a ningún programa.';
$string['errornoprograms'] = 'No se han encontrado programas.';
$string['errornorequests'] = 'No se han encontrado solicitudes de programa';
$string['errornotenabled'] = 'El complemento de programas no está habilitado';
$string['event_program_completed'] = 'Programa completado';
$string['event_program_created'] = 'Programa creado';
$string['event_program_deleted'] = 'Programa eliminado';
$string['event_program_updated'] = 'Programa actualizado';
$string['event_program_viewed'] = 'Programa visualizado';
$string['event_user_allocated'] = 'Usuario asignado al programa';
$string['event_user_deallocated'] = 'Usuario desasignado del programa';
$string['evidence'] = 'Otras evidencias';
$string['evidence_details'] = 'Detalles';
$string['fixeddate'] = 'En una fecha fija';
$string['item'] = 'Elemento';
$string['itemcompletion'] = 'Finalización del elemento del programa';
$string['management'] = 'Gestión del programa';
$string['messageprovider:allocation_notification'] = 'Notificación de asignación del programa';
$string['messageprovider:approval_request_notification'] = 'Notificación de solicitud de aprobación del programa';
$string['messageprovider:approval_reject_notification'] = 'Notificación de rechazo de solicitud del programa';
$string['messageprovider:completion_notification'] = 'Notificación de finalización del programa';
$string['messageprovider:deallocation_notification'] = 'Notificación de desasignación del programa';
$string['messageprovider:duesoon_notification'] = 'Notificación de fecha de vencimiento del programa';
$string['messageprovider:due_notification'] = 'Notificación de programa vencido';
$string['messageprovider:endsoon_notification'] = 'Notificación de próxima fecha de finalización del programa';
$string['messageprovider:endcompleted_notification'] = 'Notificación de finalización del programa';
$string['messageprovider:endfailed_notification'] = 'Notificación de finalización de programa con error';
$string['messageprovider:start_notification'] = 'Notificación de inicio de programa';
$string['moveitem'] = 'Mover elemento';
$string['moveitemcancel'] = 'Cancelar movimiento';
$string['moveafter'] = 'Mover "{$a->item}" después de "{$a->target}"';
$string['movebefore'] = 'Mover "{$a->item}" antes de "{$a->target}"';
$string['moveinto'] = 'Mover "{$a->item}" a "{$a->target}"';
$string['myprograms'] = 'Mis programas';
$string['notification_allocation'] = 'Usuario asignado';
$string['notification_completion'] = 'Programa completado';
$string['notification_completion_subject'] = 'Programa completado';
$string['notification_completion_body'] = 'Hola, {$a->user_fullname}:

ha completado el programa "{$a->program_fullname}".
';
$string['notification_deallocation'] = 'Usuario desasignado';
$string['notification_duesoon'] = 'La fecha de vencimiento del programa está próxima';
$string['notification_duesoon_subject'] = 'La finalización del programa está próxima';
$string['notification_duesoon_body'] = 'Hola, {$a->user_fullname}:

la finalización del programa "{$a->program_fullname}" está prevista para el {$a->program_duedate}.
';
$string['notification_due'] = 'Programa vencido';
$string['notification_due_subject'] = 'La finalización del programa estaba prevista';
$string['notification_due_body'] = 'Hola, {$a->user_fullname}:

la finalización del programa {$a->program_fullname} estaba prevista para antes del {$a->program_duedate}.
';
$string['notification_endsoon'] = 'La fecha de finalización del programa está próxima';
$string['notification_endsoon_subject'] = 'El programa finaliza pronto';
$string['notification_endsoon_body'] = 'Hola, {$a->user_fullname}:

el programa "{$a->program_fullname}" finaliza el {$a->program_enddate}.
';
$string['notification_endcompleted'] = 'Programa finalizado';
$string['notification_endcompleted_subject'] = 'Programa finalizado';
$string['notification_endcompleted_body'] = 'Hola, {$a->user_fullname}:

el programa "{$a->program_fullname}" ha finalizado. Ya lo había completado anteriormente.
';
$string['notification_endfailed'] = 'Finalización del programa con error';
$string['notification_endfailed_subject'] = 'Finalización del programa con error';
$string['notification_endfailed_body'] = 'Hola, {$a->user_fullname}:

el programa "{$a->program_fullname}" ha finalizado. No lo ha completado.
';
$string['notification_start'] = 'Programa iniciado';
$string['notification_start_subject'] = 'Programa iniciado';
$string['notification_start_body'] = 'Hola, {$a->user_fullname}:

se ha iniciado el programa "{$a->program_fullname}".
';
$string['notificationdates'] = 'Fechas de notificación';
$string['notset'] = 'Sin establecer';
$string['plugindisabled'] = 'El complemento de inscripción en programas está desactivado, los programas no funcionarán.

[Enable plugin now]({$a->url})';
$string['pluginname'] = 'Programas';
$string['pluginname_desc'] = 'Los programas están diseñados para permitir la creación de conjuntos de cursos.';
$string['privacy:metadata:field:programid'] = 'ID de programa';
$string['privacy:metadata:field:userid'] = 'ID de usuario';
$string['privacy:metadata:field:allocationid'] = 'ID de asignación de programa';
$string['privacy:metadata:field:sourceid'] = 'Fuente de asignación';
$string['privacy:metadata:field:itemid'] = 'ID de elemento';
$string['privacy:metadata:field:timecreated'] = 'Fecha de creación';
$string['privacy:metadata:field:timecompleted'] = 'Fecha de finalización';

$string['privacy:metadata:table:enrol_programs_allocations'] = 'Información sobre las asignaciones de programas';
$string['privacy:metadata:field:archived'] = '¿Está archivado el registro?';
$string['privacy:metadata:field:sourcedatajson'] = 'Información sobre la fuente de la asignación';
$string['privacy:metadata:field:timeallocated'] = 'Fecha de asignación del programa';
$string['privacy:metadata:field:timestart'] = 'Fecha de inicio';
$string['privacy:metadata:field:timedue'] = 'Fecha de vencimiento';
$string['privacy:metadata:field:timeend'] = 'Fecha final';

$string['privacy:metadata:table:enrol_programs_certs_issues'] = 'Emisiones de certificados de asignación de programas';
$string['privacy:metadata:field:issueid'] = 'ID de emisión';

$string['privacy:metadata:table:enrol_programs_completions'] = 'Finalización de la asignación del programa';

$string['privacy:metadata:table:enrol_programs_evidences'] = 'Información sobre otras evidencias de la finalización';
$string['privacy:metadata:field:evidencejson'] = 'Información sobre evidencias de finalización';
$string['privacy:metadata:field:createdby'] = 'Evidencia creada por';

$string['privacy:metadata:table:enrol_programs_requests'] = 'Información sobre la solicitud de asignación';
$string['privacy:metadata:field:datajson'] = 'Información sobre la solicitud';
$string['privacy:metadata:field:timerequested'] = 'Fecha de solicitud';
$string['privacy:metadata:field:timerejected'] = 'Fecha de rechazo';
$string['privacy:metadata:field:rejectedby'] = 'Solicitud rechazada por';


$string['privacy:metadata:table:enrol_programs_usr_snapshots'] = 'Instantáneas de asignación del programa';
$string['privacy:metadata:field:reason'] = 'Motivo';
$string['privacy:metadata:field:timesnapshot'] = 'Fecha de la instantánea';
$string['privacy:metadata:field:snapshotby'] = 'Instantánea por';
$string['privacy:metadata:field:explanation'] = 'Explicación';
$string['privacy:metadata:field:completionsjson'] = 'Información sobre la finalización';
$string['privacy:metadata:field:evidencesjson'] = 'Información sobre evidencias de finalización';

$string['program'] = 'Programa';
$string['programautofix'] = 'Reparación automática de programas';
$string['programdue'] = 'Vencimiento del programa';
$string['programdue_help'] = 'La fecha de vencimiento del programa indica cuándo se espera que los usuarios completen el programa.';
$string['programdue_delay'] = 'Vencimiento después del inicio';
$string['programdue_date'] = 'Fecha de vencimiento';
$string['programend'] = 'Fin del programa';
$string['programend_help'] = 'Los usuarios no pueden acceder a los cursos del programa una vez finalizado el programa.';
$string['programend_delay'] = 'Finalizar después del inicio';
$string['programend_date'] = 'Fecha de fin del programa';
$string['programcompletion'] = 'Fecha de finalización del programa';
$string['programidnumber'] = 'Número de identificación del programa';
$string['programimage'] = 'Imagen del programa';
$string['programname'] = 'Nombre del programa';
$string['programurl'] = 'URL del programa';
$string['programs'] = 'Programas';
$string['programsactive'] = 'Activo';
$string['programsarchived'] = 'Archivado';
$string['programsarchived_help'] = 'Los programas archivados se ocultan a los usuarios y se bloquea su progreso.';
$string['programstart'] = 'Inicio del programa';
$string['programstart_help'] = 'Los usuarios no pueden acceder a los cursos del programa antes de su inicio.';
$string['programstart_allocation'] = 'Iniciar inmediatamente después de la asignación';
$string['programstart_delay'] = 'Inicio diferido después de la asignación';
$string['programstart_date'] = 'Fecha de inicio del programa';
$string['programstatus'] = 'Estado del programa';
$string['programstatus_completed'] = 'Finalizado';
$string['programstatus_any'] = 'Cualquier estado de programa';
$string['programstatus_archived'] = 'Archivado';
$string['programstatus_archivedcompleted'] = 'Archivado completado';
$string['programstatus_overdue'] = 'Vencido';
$string['programstatus_open'] = 'Abrir';
$string['programstatus_future'] = 'Pendiente de abrir';
$string['programstatus_failed'] = 'Error';
$string['programs:addcourse'] = 'Agregar curso a los programas';
$string['programs:allocate'] = 'Asignar estudiantes a los programas';
$string['programs:delete'] = 'Eliminar programas';
$string['programs:edit'] = 'Agregar y actualizar programas';
$string['programs:admin'] = 'Administración avanzada de programas';
$string['programs:manageevidence'] = 'Gestionar otras evidencias de finalización';
$string['programs:view'] = 'Ver la gestión de programas';
$string['programs:viewcatalogue'] = 'Acceder al catálogo de programas';
$string['public'] = 'Público';
$string['public_help'] = 'Los programas públicos son visibles para todos los usuarios.

El estado de visibilidad no afecta a los programas ya asignados.';
$string['sequencetype'] = 'Tipo de finalización';
$string['sequencetype_allinorder'] = 'Todos en orden';
$string['sequencetype_allinanyorder'] = 'Todos en cualquier orden';
$string['sequencetype_atleast'] = 'Al menos {$a->min}';
$string['selectcategory'] = 'Seleccionar categoría';
$string['source'] = 'Fuente';
$string['source_approval'] = 'Solicitudes con aprobación';
$string['source_approval_allownew'] = 'Permitir aprobaciones';
$string['source_approval_allownew_desc'] = 'Permitir agregar nuevas fuentes de _solicitudes con aprobación_ a los programas';
$string['source_approval_allowrequest'] = 'Permitir nuevas solicitudes';
$string['source_approval_confirm'] = 'Confirme que desea solicitar la asignación al programa.';
$string['source_approval_daterequested'] = 'Fecha de solicitud';
$string['source_approval_daterejected'] = 'Fecha de rechazo';
$string['source_approval_makerequest'] = 'Solicitar acceso';
$string['source_approval_notification_allocation_subject'] = 'Notificación de aprobación del programa';
$string['source_approval_notification_allocation_body'] = 'Hola, {$a->user_fullname}:

se ha aprobado su inscripción en el programa "{$a->program_fullname}". La fecha de inicio es {$a->program_startdate}.
';
$string['source_approval_notification_approval_request_subject'] = 'Notificación de solicitud de programa';
$string['source_approval_notification_approval_request_body'] = '
El usuario {$a->user_fullname} ha solicitado acceso al programa "{$a->program_fullname}".
';
$string['source_approval_notification_approval_reject_subject'] = 'Notificación de rechazo de solicitud del programa';
$string['source_approval_notification_approval_reject_body'] = 'Hola, {$a->user_fullname}:

se ha rechazado su solicitud de acceso al programa "{$a->program_fullname}".

{$a->reason}
';
$string['source_approval_requestallowed'] = 'Se permiten solicitudes';
$string['source_approval_requestnotallowed'] = 'No se permiten solicitudes';
$string['source_approval_requests'] = 'Solicitudes';
$string['source_approval_requestpending'] = 'Solicitud de acceso pendiente';
$string['source_approval_requestrejected'] = 'Se ha rechazado la solicitud de acceso';
$string['source_approval_requestapprove'] = 'Aprobar solicitud';
$string['source_approval_requestreject'] = 'Rechazar solicitud';
$string['source_approval_requestdelete'] = 'Eliminar solicitud';
$string['source_approval_rejectionreason'] = 'Motivo del rechazo';
$string['notification_allocation_subject'] = 'Notificación de asignación del programa';
$string['notification_allocation_body'] = 'Hola, {$a->user_fullname}:

se le ha asignado al programa "{$a->program_fullname}". La fecha de inicio es {$a->program_startdate}.
';
$string['notification_deallocation_subject'] = 'Notificación de desasignación del programa';
$string['notification_deallocation_body'] = 'Hola, {$a->user_fullname}:

se le ha desasignado del programa "{$a->program_fullname}".
';
$string['source_cohort'] = 'Asignación automática de cohortes';
$string['source_cohort_allownew'] = 'Permitir asignación de cohortes';
$string['source_cohort_allownew_desc'] = 'Permitir agregar nuevas fuentes de _asignación automática de cohortes_ a los programas';
$string['source_manual'] = 'Asignación manual';
$string['source_manual_allocateusers'] = 'Asignar usuarios';
$string['source_manual_csvfile'] = 'Archivo CSV';
$string['source_manual_hasheaders'] = 'La primera línea es el encabezado';
$string['source_manual_potusersmatching'] = 'Correspondencia de candidatos a la asignación';
$string['source_manual_potusers'] = 'Asignación de candidatos';
$string['source_manual_result_assigned'] = 'Se han asignado {$a} usuarios al programa.';
$string['source_manual_result_errors'] = 'Se han detectado {$a} errores al asignar programas.';
$string['source_manual_result_skipped'] = 'Ya estaban asignados {$a} usuarios al programa.';
$string['source_manual_uploadusers'] = 'Cargar asignaciones';
$string['source_manual_usercolumn'] = 'Columna de identificación de usuario';
$string['source_manual_usermapping'] = 'Asignación de usuarios mediante';
$string['source_manual_userupload_allocated'] = 'Asignado a "{$a}"';
$string['source_manual_userupload_alreadyallocated'] = 'Ya está asignado a "{$a}"';
$string['source_manual_userupload_invalidprogram'] = 'No se puede asignar a "{$a}"';
$string['source_selfallocation'] = 'Autoasignación';
$string['source_selfallocation_allocate'] = 'Inscripción';
$string['source_selfallocation_allownew'] = 'Permitir autoasignación';
$string['source_selfallocation_allownew_desc'] = 'Permitir agregar nuevas fuentes de _autoasignación_ a los programas';
$string['source_selfallocation_allowsignup'] = 'Permitir nuevas inscripciones';
$string['source_selfallocation_confirm'] = 'Confirme que desea ser asignado al programa.';
$string['source_selfallocation_enable'] = 'Habilitar autoasignación';
$string['source_selfallocation_key'] = 'Clave de inscripción';
$string['source_selfallocation_keyrequired'] = 'La clave de inscripción es obligatoria';
$string['source_selfallocation_maxusers'] = 'Número máximo de usuarios';
$string['source_selfallocation_maxusersreached'] = 'Ya se ha alcanzado el número máximo de usuarios autoasignados';
$string['source_selfallocation_maxusers_status'] = '{$a->count}/{$a->max} usuarios';
$string['source_selfallocation_notification_allocation_subject'] = 'Notificación de asignación del programa';
$string['source_selfallocation_notification_allocation_body'] = 'Hola, {$a->user_fullname}:

se ha inscrito en el programa "{$a->program_fullname}". La fecha de inicio es {$a->program_startdate}.
';
$string['source_selfallocation_signupallowed'] = 'Se permiten inscripciones';
$string['source_selfallocation_signupnotallowed'] = 'No se permiten inscripciones';
$string['set'] = 'Conjunto de cursos';
$string['settings'] = 'Ajustes del programa';
$string['scheduling'] = 'Programación';
$string['taballocation'] = 'Ajustes de la asignación';
$string['tabcontent'] = 'Contenido';
$string['tabgeneral'] = 'General';
$string['tabusers'] = 'Usuarios';
$string['tabvisibility'] = 'Ajustes de visibilidad';
$string['tagarea_program'] = 'Programas';
$string['taskcertificate'] = 'Cron de emisión de certificados del programa';
$string['taskcron'] = 'Cron de complemento del programa';
$string['unlinkeditems'] = 'Elementos desvinculados';
$string['updateprogram'] = 'Actualizar programa';
$string['updateallocation'] = 'Actualizar asignación';
$string['updateallocations'] = 'Actualizar asignaciones';
$string['updateset'] = 'Actualizar conjunto';
$string['updatescheduling'] = 'Actualizar programación';
$string['updatesource'] = 'Actualizar {$a}';
