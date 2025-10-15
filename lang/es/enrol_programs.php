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
$string['archive'] = 'Archivar';
$string['archived'] = 'Archivado';
$string['benefitname'] = '{$a}: Asignación de programa';
$string['calendarprogramend'] = '{$a} finaliza';
$string['calendarprogramdue'] = '{$a} ha vencido';
$string['calendarprogramstart'] = '{$a} comienza';
$string['catalogue'] = 'Catálogo de programas';
$string['catalogue_dofilter'] = 'Buscar';
$string['catalogue_resetfilter'] = 'Borrar';
$string['catalogue_searchtext'] = 'Buscar texto';
$string['catalogue_tag'] = 'Filtrar por etiqueta';
$string['certificatetemplatechoose'] = 'Elegir una plantilla...';
$string['cohorts'] = 'Visible para las cohortes';
$string['cohorts_help'] = 'Los programas no públicos se pueden hacer visibles para los miembros de la cohorte especificados.

El estado de visibilidad no afecta a los programas ya asignados.';
$string['columnusedalready'] = 'La columna ya está en uso';
$string['completepercent'] = '{$a} % completado';
$string['completion'] = 'Finalización';
$string['completiondate'] = 'Fecha de finalización';
$string['completiondelay'] = 'Retraso de finalización';
$string['completionoverride'] = 'Anular finalización';
$string['creategroups'] = 'Grupos de cursos';
$string['creategroups_help'] = 'Si se habilita, se creará un grupo en cada curso agregado al programa y todos los usuarios asignados se agregarán como miembros del grupo.';
$string['customfields'] = 'Campos personalizados de programas';
$string['customfieldsettings'] = 'Configuración de campos personalizados de programas comunes';
$string['customfieldvisibleto'] = 'El contenido del campo es visible para';
$string['customfieldvisible:allocated'] = 'Usuarios asignados a programas';
$string['customfieldvisible:everyone'] = 'Todos los que puedan ver otros detalles del programa';
$string['customfieldvisible:viewcapability'] = 'Los usuarios con capacidad para ver programas';
$string['deleteallocation'] = 'Eliminar asignación de programa';
$string['deletecourse'] = 'Quitar curso';
$string['deleteprogram'] = 'Eliminar programa';
$string['deleteset'] = 'Eliminar conjunto';
$string['deletetraining'] = 'Eliminar formación';
$string['documentation'] = 'Programas para documentación de Moodle';
$string['duedate'] = 'Fecha de vencimiento';
$string['enrolrole'] = 'Rol de curso';
$string['enrolrole_desc'] = 'Seleccione la función que utilizarán los programas para la inscripción en los cursos';
$string['errorcontentproblem'] = 'Se ha detectado un problema en la estructura de contenido del programa. No se realizará un seguimiento correcto de la finalización del programa.';
$string['errorcoursemissing'] = 'Falta el curso';
$string['errorcoursesmissing'] = 'Cursos que faltan: {$a}';
$string['errorinvalidoverridedates'] = 'Anulación de fecha inválida';
$string['errordifferenttenant'] = 'No se puede acceder al programa de otro abonado';
$string['errorduplicateprogramid'] = 'El número de ID de programa ya se está utilizando para otro programa, utilice un número de ID de programa único.';
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
$string['evidencedate'] = 'Fecha de finalización de evidencia';
$string['evidenceupdate'] = 'Actualizar otra evidencia';
$string['evidenceupload'] = 'Cargar evidencias de finalización';
$string['evidenceupload_csvfile'] = 'Archivo CSV';
$string['evidenceupload_errors'] = '{$a} filas no válidas detectadas';
$string['evidenceupload_skipped'] = '{$a} filas omitidas';
$string['evidenceupload_updated'] = 'Se ha actualizado la evidencia de finalización para {$a} usuarios';
$string['evidence_details'] = 'Detalles';
$string['evidence_detailsdefault'] = 'Detalles predeterminados';
$string['export'] = 'Exportar programas';
$string['exportfile_info'] = 'info';
$string['exportfile_programs'] = 'programas';
$string['exportformat'] = 'Formato de archivo';
$string['exportformat_csv'] = 'CSV';
$string['exportformat_json'] = 'JSON';
$string['extra_menu_management_index'] = 'Acciones de programas';
$string['extra_menu_management_program_general'] = 'Acciones de programa';
$string['extra_menu_management_program_users'] = 'Acciones de usuarios';
$string['extra_menu_management_program_allocation'] = 'Acciones de asignación';
$string['fixeddate'] = 'En una fecha fija';
$string['idnumbersymbol'] = 'Número de ID:';
$string['importallocationend'] = 'Fin de asignación ({$a})';
$string['importallocationstart'] = 'Inicio de asignación ({$a})';
$string['importprogramallocation'] = 'Importar asignación de programa';
$string['importprogramallocationconfirmation'] = 'Está importando la configuración de asignación del programa __{$a->fullname} {$a->idnumber} / {$a->category}__.

Seleccione todos los ajustes que desea importar.';
$string['importprogramcontent'] = 'Importar contenido del programa';
$string['importprogramcontentconfirmation'] = 'Está importando contenido del programa __{$a->fullname}/{$a->idnumber}/{$a->category}__.';
$string['importprogramdue'] = 'Vencimiento del programa ({$a})';
$string['importprogramend'] = 'Fin del programa ({$a})';
$string['importprogramstart'] = 'Inicio del programa ({$a})';
$string['importselectprogram'] = 'Seleccionar programa';
$string['invalidallocationdates'] = 'Fechas de asignación del programa no válidas';
$string['invalidcompletiondate'] = 'Fecha de finalización del programa no válida';
$string['item'] = 'Elemento';
$string['itemcompletion'] = 'Finalización del elemento del programa';
$string['itempoints'] = 'Puntos';
$string['itemrecalculate'] = 'Recalcular finalización del elemento';
$string['layoutgrid'] = 'Diseño de cuadrícula';
$string['layouttable'] = 'Diseño de tabla';
$string['management'] = 'Gestión del programa';
$string['messageprovider:allocation_notification'] = 'Notificación de asignación del programa';
$string['messageprovider:approval_request_notification'] = 'Notificación de solicitud de aprobación del programa';
$string['messageprovider:approval_reject_notification'] = 'Notificación de rechazo de solicitud del programa';
$string['messageprovider:completion_notification'] = 'Notificación de finalización del programa';
$string['messageprovider:completion_relateduser_notification'] = 'Notificación de finalización del programa - usuario relacionado';
$string['messageprovider:deallocation_notification'] = 'Notificación de desasignación del programa';
$string['messageprovider:duesoon_notification'] = 'Notificación de fecha de vencimiento del programa';
$string['messageprovider:duesoon_relateduser_notification'] = 'Notificación de próxima fecha de vencimiento del programa - usuario relacionado';
$string['messageprovider:due_notification'] = 'Notificación de programa vencido';
$string['messageprovider:due_relateduser_notification'] = 'Notificación de programa vencido - usuario relacionado';
$string['messageprovider:endsoon_notification'] = 'Notificación de próxima fecha de finalización del programa';
$string['messageprovider:endsoon_relateduser_notification'] = 'Notificación de próxima fecha de finalización del programa - usuario relacionado';
$string['messageprovider:endcompleted_notification'] = 'Notificación de finalización del programa';
$string['messageprovider:endfailed_notification'] = 'Notificación de finalización del programa sin completar';
$string['messageprovider:endfailed_relateduser_notification'] = 'Notificación de finalización del programa sin completar - usuario relacionado';
$string['messageprovider:reset_notification'] = 'Notificación de restablecimiento del programa';
$string['messageprovider:start_notification'] = 'Notificación de inicio de programa';
$string['moveitem'] = 'Mover elemento';
$string['moveitemcancel'] = 'Cancelar movimiento';
$string['moveafter'] = 'Mover "{$a->item}" después de "{$a->target}"';
$string['movebefore'] = 'Mover "{$a->item}" antes de "{$a->target}"';
$string['moveinto'] = 'Mover "{$a->item}" a "{$a->target}"';
$string['myprograms'] = 'Mis programas';
$string['notification_allocation'] = 'Usuario asignado';
$string['notification_allocation_subject'] = 'Notificación de asignación del programa';
$string['notification_allocation_body'] = 'Hola, {$a->user_fullname}:

Se le ha asignado al programa "{$a->program_fullname}"; la fecha de inicio es {$a->program_startdate}.
';
$string['notification_allocation_description'] = 'Notificación que se envía a los usuarios cuando se les asigna al programa.';
$string['notification_completion'] = 'Programa completado';
$string['notification_completion_subject'] = 'Programa completado';
$string['notification_completion_body'] = 'Hola, {$a->user_fullname}:

Ha completado el programa "{$a->program_fullname}".
';
$string['notification_completion_description'] = 'Notificación que se envía a los usuarios cuando han completado su programa.';
$string['notification_completion_relateduser'] = 'Programa finalizado - usuario relacionado';
$string['notification_completion_relateduser_subject'] = 'El usuario {$a->user_fullname} ha finalizado el programa';
$string['notification_completion_relateduser_body'] = 'Hola, {$a->relateduser_fullname}:

El usuario {$a->user_fullname} ha completado el programa "{$a->program_fullname}".
';
$string['notification_completion_relateduser_description'] = 'Notificación que se envía a los usuarios relacionados con el usuario cuando han completado su programa.';
$string['notification_deallocation'] = 'Usuario desasignado';
$string['notification_deallocation_subject'] = 'Notificación de desasignación del programa';
$string['notification_deallocation_body'] = 'Hola, {$a->user_fullname}:

Se le ha desasignado del programa "{$a->program_fullname}".
';
$string['notification_deallocation_description'] = 'Notificación que se envía a los usuarios cuando se les desasigna del programa.';
$string['notification_duesoon'] = 'La fecha de vencimiento del programa está próxima';
$string['notification_duesoon_subject'] = 'La finalización del programa está próxima';
$string['notification_duesoon_body'] = 'Hola, {$a->user_fullname}:

La finalización del programa "{$a->program_fullname}" está prevista para el {$a->program_duedate}.
';
$string['notification_duesoon_description'] = 'Notificación que se envía a los usuarios antes de la fecha de finalización del programa, a menos que el programa ya se haya completado.';
$string['notification_duesoon_relateduser'] = 'Próxima fecha de vencimiento del programa - usuario relacionado';
$string['notification_duesoon_relateduser_subject'] = 'La finalización del programa está próxima para el usuario {$a->user_fullname}';
$string['notification_duesoon_relateduser_body'] = 'Hola, {$a->relateduser_fullname}:

La finalización del programa "{$a->program_fullname}" para el usuario {$a->user_fullname} está prevista para el {$a->program_duedate}.
';
$string['notification_duesoon_relateduser_description'] = 'Notificación que se envía a los usuarios relacionados con el usuario antes de la fecha de finalización del programa, a menos que el programa ya se haya completado.';
$string['notification_due'] = 'Programa vencido';
$string['notification_due_subject'] = 'La finalización del programa estaba prevista';
$string['notification_due_body'] = 'Hola, {$a->user_fullname}:

La finalización del programa "{$a->program_fullname}" estaba prevista para antes del {$a->program_duedate}.
';
$string['notification_due_description'] = 'Notificación que se envía a los usuarios cuando la fecha de finalización de su programa ha vencido.';
$string['notification_due_relateduser'] = 'Programa vencido - usuario relacionado';
$string['notification_due_relateduser_subject'] = 'La finalización del programa se esperaba para el usuario {$a->user_fullname}';
$string['notification_due_relateduser_body'] = 'Hola, {$a->relateduser_fullname}:

La finalización del programa "{$a->program_fullname}" para el usuario {$a->user_fullname} estaba prevista antes del {$a->program_duedate}.
';
$string['notification_due_relateduser_description'] = 'Notificación que se envía a los usuarios relacionados con el usuario cuando la fecha de finalización de su programa ha vencido.';
$string['notification_endsoon'] = 'La fecha de finalización del programa está próxima';
$string['notification_endsoon_subject'] = 'El programa finaliza pronto';
$string['notification_endsoon_body'] = 'Hola {$a->user_fullname}:

El programa "{$a->program_fullname}" finaliza el {$a->program_enddate}.
';
$string['notification_endsoon_description'] = 'Notificación que se envía a los usuarios antes de la fecha de finalización del programa, a menos que el programa ya se haya completado.';
$string['notification_endsoon_relateduser'] = 'Próxima fecha de finalización del programa - usuario relacionado';
$string['notification_endsoon_relateduser_subject'] = 'El programa finaliza pronto para el usuario {$a->user_fullname}';
$string['notification_endsoon_relateduser_body'] = 'Hola, {$a->relateduser_fullname}:

El programa "{$a->program_fullname}" para el usuario {$a->user_fullname} finaliza el {$a->program_enddate}.
';
$string['notification_endsoon_relateduser_description'] = 'Notificación que se envía a los usuarios relacionados con el usuario antes de la fecha de finalización del programa, a menos que el programa ya se haya completado.';
$string['notification_endcompleted'] = 'Programa finalizado';
$string['notification_endcompleted_subject'] = 'Programa finalizado';
$string['notification_endcompleted_body'] = 'Hola, {$a->user_fullname}:

El programa "{$a->program_fullname}" ha finalizado; ya lo ha completado anteriormente.
';
$string['notification_endcompleted_description'] = 'Notificación que se envía a los usuarios cuando finaliza un programa que han completado.';
$string['notification_endfailed'] = 'Finalización del programa sin completar';
$string['notification_endfailed_subject'] = 'Finalización del programa sin completar';
$string['notification_endfailed_body'] = 'Hola, {$a->user_fullname}:

El programa "{$a->program_fullname}" ha finalizado; no lo ha completado.
';
$string['notification_endfailed_description'] = 'Notificación que se envía a los usuarios cuando finaliza un programa que no han completado.';
$string['notification_endfailed_relateduser'] = 'Finalización del programa sin completar - usuario relacionado';
$string['notification_endfailed_relateduser_subject'] = 'Finalización del programa sin completar para el usuario {$a->user_fullname}';
$string['notification_endfailed_relateduser_body'] = 'Hola, {$a->relateduser_fullname}:

El programa "{$a->program_fullname}" ha finalizado y el usuario {$a->user_fullname} no lo ha completado.
';
$string['notification_endfailed_relateduser_description'] = 'Notificación que se envía a los usuarios relacionados con el usuario cuando finaliza un programa que no han completado.';
$string['notification_relateduserfield'] = 'Campo de notificación de usuario relacionado';
$string['notification_relateduserfield_desc'] = 'Seleccione el campo de perfil de usuarios relacionados que se usará para notificar a los usuarios relacionados.';
$string['notification_reset'] = 'Restablecimiento del progreso del usuario';
$string['notification_reset_subject'] = 'Notificación de restablecimiento del programa';
$string['notification_reset_body'] = 'Hola, {$a->user_fullname}:

Su progreso en el programa "{$a->program_fullname}" se ha restablecido.
';
$string['notification_reset_description'] = 'Notificación que se envía a los usuarios cuando se restablece el progreso de su programa.';
$string['notification_start'] = 'Programa iniciado';
$string['notification_start_subject'] = 'Programa iniciado';
$string['notification_start_body'] = 'Hola, {$a->user_fullname}:

Se ha iniciado el programa "{$a->program_fullname}".
';
$string['notification_start_description'] = 'Notificación que se envía a los usuarios cuando se inicia su programa.';
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

$string['privacy:metadata:table:enrol_programs_src_commholds'] = 'Reservas de asignación de comercio';
$string['privacy:metadata:field:quantity'] = 'Cantidad';

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
$string['programcompletionoverride'] = 'Anular finalización del programa';
$string['programidnumber'] = 'Número de identificación del programa';
$string['programimage'] = 'Imagen del programa';
$string['programname'] = 'Nombre del programa';
$string['programurl'] = 'URL del programa';
$string['programs'] = 'Programas';
$string['programsactive'] = 'Activo';
$string['programsarchived'] = 'Archivado';
$string['programsarchived_help'] = 'Los programas archivados se ocultan a los usuarios y se bloquea su progreso.';
$string['programslayout'] = 'Programa el diseño detallado de la página';
$string['programslayout_desc'] = 'Controla el diseño de los programas: vista de tabla o cuadrícula para la página Mis/programas.';
$string['programslayoutallowuserswitch'] = 'Permite a los usuarios cambiar el diseño del programa';
$string['programslayoutallowuserswitch_desc'] = 'Permite a los usuarios cambiar el diseño del programa';
$string['programslayout_desc'] = 'Controla el diseño de los programas: vista de tabla o cuadrícula para la página Mis/programas.';
$string['programsblocklayout'] = 'Diseño de bloques de Mis programas';
$string['programsblocklayout_desc'] = 'Controla la disposición de los programas: Vista de tabla o cuadrícula para el bloque de Mis programas.';

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
$string['programs:addtocertifications'] = 'Agregar programa a certificaciones';
$string['programs:addtoplan'] = 'Agregar programa a planes';
$string['programs:allocate'] = 'Asignar estudiantes a los programas';
$string['programs:archive'] = 'Archivar asignaciones de programa';
$string['programs:clone'] = 'Permitir la clonación del contenido y la configuración del programa';
$string['programs:configframeworks'] = 'Configurar la disponibilidad del programa en los marcos del plan';
$string['programs:configurecustomfields'] = 'Configurar campos personalizados del programa';
$string['programs:delete'] = 'Eliminar programas';
$string['programs:edit'] = 'Agregar y actualizar programas';
$string['programs:export'] = 'Exportar programas';
$string['programs:admin'] = 'Administración avanzada de programas';
$string['programs:manageallocation'] = 'Gestionar asignaciones de usuarios';
$string['programs:manageevidence'] = 'Gestionar otras evidencias de finalización';
$string['programs:reset'] = 'Restablecer progreso del programa';
$string['programs:upload'] = 'Cargar programas';
$string['programs:view'] = 'Ver la gestión de programas';
$string['programs:viewcatalogue'] = 'Acceder al catálogo de programas';
$string['public'] = 'Público';
$string['public_help'] = 'Los programas públicos son visibles para todos los usuarios.

El estado de visibilidad no afecta a los programas ya asignados.';
$string['purchaseaccess'] = 'Comprar acceso';
$string['resetallocation'] = 'Restablecer progreso del programa';
$string['resettype'] = 'Tipo de restablecimiento';
$string['resettype_deallocate'] = 'Solo desasignación del programa';
$string['resettype_full'] = 'Depuración completa del curso';
$string['resettype_none'] = 'Ninguna';
$string['resettype_standard'] = 'Purga estándar del curso';
$string['sequencetype'] = 'Tipo de finalización';
$string['sequencetype_allinorder'] = 'Todos en orden';
$string['sequencetype_allinanyorder'] = 'Todos en cualquier orden';
$string['sequencetype_atleast'] = 'Al menos {$a->min}';
$string['sequencetype_minpoints'] = 'Mínimo {$a->minpoints} puntos';
$string['selectcategory'] = 'Seleccionar categoría';
$string['sortbyprogramname'] = 'Ordenar por nombre de programa';
$string['sortbyprogramid'] = 'Ordenar por ID de programa';
$string['sortbyprogramstart'] = 'Ordenar por fecha de inicio del programa';
$string['sortbyprogramdue'] = 'Ordenar por fecha de vencimiento del programa';
$string['sortbyprogramend'] = 'Ordenar por fecha de finalización del programa';
$string['source'] = 'Fuente';
$string['source_approval'] = 'Solicitudes con aprobación';
$string['source_approval_allownew'] = 'Permitir aprobaciones';
$string['source_approval_allownew_desc'] = 'Permitir agregar nuevas fuentes de _solicitudes con aprobación_ a los programas';
$string['source_approval_allowrequest'] = 'Permitir nuevas solicitudes';
$string['source_approval_confirm'] = 'Confirme que desea solicitar la asignación al programa.';
$string['source_approval_daterequested'] = 'Fecha de solicitud';
$string['source_approval_daterejected'] = 'Fecha de rechazo';
$string['source_approval_makerequest'] = 'Solicitar acceso';
$string['source_approval_notification_approval_request_subject'] = 'Notificación de solicitud de programa';
$string['source_approval_notification_approval_request_body'] = '
El usuario {$a->user_fullname} ha solicitado acceso al programa "{$a->program_fullname}".
';
$string['source_approval_notification_approval_reject_subject'] = 'Notificación de rechazo de solicitud del programa';
$string['source_approval_notification_approval_reject_body'] = 'Hola, {$a->user_fullname}:

Se ha rechazado su solicitud de acceso al programa "{$a->program_fullname}".

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
$string['source_certify'] = 'Certificaciones';
$string['source_certify_allownew'] = 'Permitir asignación de certificaciones';
$string['source_certify_allownew_desc'] = 'Permitir agregar nuevas fuentes de _certificación_ a los programas';
$string['source_cohort'] = 'Asignación automática de cohortes';
$string['source_cohort_allownew'] = 'Permitir asignación de cohortes';
$string['source_cohort_allownew_desc'] = 'Permitir agregar nuevas fuentes de _asignación automática de cohortes_ a los programas';
$string['source_cohort_cohortstoallocate'] = 'Asignar cohortes';
$string['source_ecommerce'] = 'Asignación de comercio electrónico';
$string['source_ecommerce_allownew'] = 'Permitir asignación de comercio electrónico';
$string['source_ecommerce_allownew_desc'] = 'Permitir agregar nuevas fuentes de asignación automática de comercio electrónico a los programas';
$string['source_ecommerce_allowsignup'] = 'Permitir nuevas asignaciones';
$string['source_ecommerce_cohortmembershiprequirement'] = 'Los usuarios deben ser miembros de una de las siguientes cohortes: {$a}';
$string['source_ecommerce_maxusers'] = 'Número máximo de usuarios';
$string['source_ecommerce_nocapacity'] = 'No queda capacidad en este programa';
$string['source_manual'] = 'Asignación manual';
$string['source_manual_allocateusers'] = 'Asignar usuarios';
$string['source_manual_csvfile'] = 'Archivo CSV';
$string['source_manual_hasheaders'] = 'La primera línea es el encabezado';
$string['source_manual_potusersmatching'] = 'Correspondencia de candidatos a la asignación';
$string['source_manual_potusers'] = 'Asignación de candidatos';
$string['source_manual_result_assigned'] = 'Se han asignado {$a} usuarios al programa.';
$string['source_manual_result_errors'] = 'Se han detectado {$a} errores al asignar programas.';
$string['source_manual_result_skipped'] = 'Ya se han asignado {$a} usuarios al programa.';
$string['source_manual_timeduecolumn'] = 'Columna Hora de vencimiento';
$string['source_manual_timeendcolumn'] = 'Columna Hora de finalización';
$string['source_manual_timestartcolumn'] = 'Columna Hora de inicio';
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
$string['source_selfallocation_maxusers_status'] = 'Usuarios {$a->count}/{$a->max}';
$string['source_selfallocation_signupallowed'] = 'Se permiten inscripciones';
$string['source_selfallocation_signupnotallowed'] = 'No se permiten inscripciones';
$string['source_udplans'] = 'Planes de desarrollo de usuario';
$string['source_udplans_allownew'] = 'Planes de desarrollo de usuario';
$string['source_udplans_allownew_desc'] = 'Permitir agregar nuevas fuentes de _planes de desarrollo de usuario_ a los programas';
$string['source_udplans_allowed'] = 'Permitido';
$string['source_udplans_noframeworks'] = 'No se puede agregar a ningún plan';
$string['source_udplans_notallowed'] = 'No permitido';
$string['source_udplans_requirecap'] = 'Agregar capacidad necesaria';
$string['set'] = 'Conjunto de cursos';
$string['settings'] = 'Ajustes del programa';
$string['scheduling'] = 'Programación';
$string['taballocation'] = 'Ajustes de la asignación';
$string['tabcontent'] = 'Contenido';
$string['tabgeneral'] = 'General';
$string['tabusers'] = 'Usuarios';
$string['tabvisibility'] = 'Ajustes de visibilidad';
$string['tagarea_enrol_programs_programs'] = 'Programas';
$string['taskcertificate'] = 'Cron de emisión de certificados del programa';
$string['taskcron'] = 'Cron de complemento del programa';
$string['training'] = 'Capacitación';
$string['trainingcompletion'] = 'Formación obligatoria: {$a}';
$string['trainingprogress'] = 'Progreso de formación: {$a->current}/{$a->total}';
$string['unarchive'] = 'Restaurar';
$string['unlinkeditems'] = 'Elementos desvinculados';
$string['updateprogram'] = 'Actualizar programa';
$string['updateallocation'] = 'Actualizar asignación';
$string['updateallocations'] = 'Actualizar asignaciones';
$string['updatecourse'] = 'Actualizar curso';
$string['updateset'] = 'Actualizar conjunto';
$string['updatescheduling'] = 'Actualizar programación';
$string['updatesource'] = 'Actualizar {$a}';
$string['updatetraining'] = 'Actualizar formación';
$string['upload'] = 'Cargar programas';
$string['upload_invalidcount'] = 'Registros no válidos';
$string['upload_files'] = 'Archivos';
$string['upload_files_error'] = 'Se esperan varios archivos CSV, un archivo JSON o un archivo Zip';
$string['upload_preview'] = 'Vista previa de los datos';
$string['upload_status'] = 'Estado';
$string['upload_status_invalid'] = 'Sin validez';
$string['upload_targetcontext'] = 'Agregar programas al contexto';
$string['upload_uploadcount'] = 'Programas para cargar';
$string['upload_usecategory'] = 'Utilice la columna de categoría para los contextos';
$string['userupload_completion_error'] = 'No se puede actualizar la finalización del programa';
$string['userupload_completion_updated'] = 'La finalización del programa se ha actualizado';

$string['rb_allocatedprograms'] = 'Programas asignados';
$string['rb_complete'] = 'Completado';
$string['rb_completiondate'] = 'Fecha de finalización';
$string['rb_completionstatus'] = 'Estado de finalización';
$string['rb_datecompleted'] = 'Fecha de finalización';
$string['rb_dateallocated'] = 'Fecha de asignación';
$string['rb_datestarted'] = 'Fecha de inicio';
$string['rb_coursesall'] = 'Curso(s) - Todos';
$string['rb_incomplete'] = 'Incompleto';
$string['rb_isallocated'] = 'Está asignado';
$string['rb_iscomplete'] = '¿Se ha completado?';
$string['rb_iscompleteany'] = '¿Se ha completado? (cualquier método)';
$string['rb_isinprogress'] = '¿Está en curso?';
$string['rb_isnotcomplete'] = '¿No se ha completado?';
$string['rb_isnotyetstarted'] = '¿Aún no ha comenzado?';
$string['rb_notstarted'] = 'No iniciado';
$string['rb_officewhencompletedbasic'] = 'Oficina una vez completado (básico)';
$string['rb_privacy:metadata'] = 'El complemento no almacena datos personales.';
$string['rb_programcategory'] = 'Categoría de programa (o sitio)';
$string['rb_programcategoryid'] = 'ID de categoría de programa (N/A si es sitio)';
$string['rb_programcategoryidnumber'] = 'Número de ID de categoría de programa (N/A si es sitio)';
$string['rb_programcategorymultichoice'] = 'Categoría del programa (selección múltiple)';
$string['rb_programedatecreated'] = 'Fecha de creación del programa';
$string['rb_programduedate'] = 'Fecha de vencimiento del programa';
$string['rb_programenddate'] = 'Fecha de fin de asignación del programa';
$string['rb_programallocationtype'] = 'Tipo de asignación';
$string['rb_programallocationtypes'] = 'Tipos de asignación';
$string['rb_programexpandlink'] = 'Nombre del programa (ampliar detalles)';
$string['rb_programid'] = 'ID de programa';
$string['rb_programidnumber'] = 'Número de ID del programa';
$string['rb_programname'] = 'Nombre del programa';
$string['rb_programnameandsummary'] = 'Nombre y descripción del programa';
$string['rb_programnamelinked'] = 'Nombre del programa (vinculado a la página del programa)';
$string['rb_programmultiitem'] = 'Programa (varios elementos)';
$string['rb_programsingleitem'] = 'Programa';
$string['rb_programstartdate'] = 'Fecha de inicio de asignación del programa';
$string['rb_programsummary'] = 'Descripción del programa';
$string['rb_programvisible'] = 'El programa es público';
$string['rb_programvisibledisabled'] = 'Programa visible (no aplicable)';
$string['rb_progress'] = 'Progreso';
$string['rb_progressnumeric'] = 'Progreso (numérico)';
$string['rb_progresspercent'] = 'Progreso (% de finalización)';
$string['rb_source_allocation'] = 'Asignaciones de programas';
$string['rb_timetocompletesinceenrol'] = 'Hora de finalización (desde la fecha de asignación)';
$string['rb_timetocompletesincestart'] = 'Hora de finalización (desde la fecha de inicio)';
$string['rb_type_program'] = 'Programa';
$string['rb_type_program_category'] = 'Categoría';
$string['rb_type_program_completion'] = 'Asignación de programa';
$string['rb_type_program_customfields'] = 'Campos personalizados de programa';
$string['rb_user'] = 'El usuario';
$string['rb_viewprogram'] = 'Ver programa';
$string['rb_visiblecohorts'] = 'Cohortes con visibilidad';
