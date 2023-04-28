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

$string['addprogram'] = 'Adicionar programa';
$string['addset'] = 'Adicionar novo conjunto';
$string['allocationend'] = 'Término da alocação';
$string['allocationend_help'] = 'O significado da data final da alocação depende das fontes de alocação habilitadas. Normalmente, não é possível fazer uma nova alocação após essa data, se especificado.';
$string['allocation'] = 'Alocação';
$string['allocations'] = 'Alocações';
$string['programallocations'] = 'Alocações do programa';
$string['allocationdate'] = 'Data de alocação';
$string['allocationsources'] = 'Origens da alocação';
$string['allocationstart'] = 'Início da alocação';
$string['allocationstart_help'] = 'O significado da data de início da alocação depende das fontes de alocação habilitadas. Geralmente, uma nova alocação só é possível após essa data, se especificada.';
$string['allprograms'] = 'Todos os programas';
$string['appenditem'] = 'Anexar item';
$string['appendinto'] = 'Anexar ao item';
$string['archived'] = 'Arquivada';
$string['catalogue'] = 'Catálogo de programas';
$string['catalogue_dofilter'] = 'Busca';
$string['catalogue_resetfilter'] = 'Limpar';
$string['catalogue_searchtext'] = 'Buscar texto';
$string['catalogue_tag'] = 'Filtrar por tags';
$string['certificatetemplatechoose'] = 'Escolha um modelo...';
$string['cohorts'] = 'Visível para séries';
$string['cohorts_help'] = 'Programas não públicos podem ser visíveis para membros da série especificados.

O status de visibilidade não afeta os programas já alocados.';
$string['completiondate'] = 'Data de conclusão';
$string['creategroups'] = 'Grupos de cursos';
$string['creategroups_help'] = 'Se ativado, um grupo será criado em cada curso adicionado ao programa e todos os usuários alocados serão adicionados como membros do grupo.';
$string['deleteallocation'] = 'Excluir alocação de programa';
$string['deletecourse'] = 'Remover curso';
$string['deleteprogram'] = 'Excluir programa';
$string['deleteset'] = 'Excluir conjunto';
$string['documentation'] = 'Programas para a documentação Moodle';
$string['duedate'] = 'Data de encerramento';
$string['enrolrole'] = 'Função do curso';
$string['enrolrole_desc'] = 'Selecionar a função que será usada por programas para inscrição no curso';
$string['errorcontentproblem'] = 'Problema detectado na estrutura de conteúdo do programa, a conclusão do programa não será rastreada corretamente!';
$string['errordifferenttenant'] = 'O programa de outro locatário não pode ser acessado';
$string['errornoallocations'] = 'Nenhuma alocação de usuário encontrada';
$string['errornoallocation'] = 'O programa não está alocado';
$string['errornomyprograms'] = 'Você não está alocado a programa algum.';
$string['errornoprograms'] = 'Nenhum programa encontrado.';
$string['errornorequests'] = 'Nenhuma solicitação de programa encontrada';
$string['errornotenabled'] = 'O plug-in de programas não está habilitado';
$string['event_program_completed'] = 'Programa concluído';
$string['event_program_created'] = 'Programa criado';
$string['event_program_deleted'] = 'Programa excluído';
$string['event_program_updated'] = 'Programa atualizado';
$string['event_program_viewed'] = 'Programa visualizado';
$string['event_user_allocated'] = 'Usuário alocado ao programa';
$string['event_user_deallocated'] = 'Usuário desalocado do programa';
$string['evidence'] = 'Outra evidência';
$string['evidence_details'] = 'Detalhes';
$string['fixeddate'] = 'Na data fixa';
$string['item'] = 'Item';
$string['itemcompletion'] = 'Conclusão do item do programa';
$string['management'] = 'Gerenciamento de programa';
$string['messageprovider:allocation_notification'] = 'Notificação de alocação de programa';
$string['messageprovider:approval_request_notification'] = 'Notificação de solicitação de aprovação de programa';
$string['messageprovider:approval_reject_notification'] = 'Notificação de rejeição de solicitação de programa';
$string['messageprovider:completion_notification'] = 'Notificação de programa concluído';
$string['messageprovider:deallocation_notification'] = 'Notificação de desalocação de programa';
$string['messageprovider:duesoon_notification'] = 'Notificação de data de entrega do programa muito próxima';
$string['messageprovider:due_notification'] = 'Notificação de atraso do programa';
$string['messageprovider:endsoon_notification'] = 'Notificação de data de término do programa muito próxima';
$string['messageprovider:endcompleted_notification'] = 'Notificação de programa concluído encerrado';
$string['messageprovider:endfailed_notification'] = 'Falha na notificação de programa encerrado';
$string['messageprovider:start_notification'] = 'Notificação de programa iniciado';
$string['moveitem'] = 'Mover item';
$string['moveitemcancel'] = 'Cancelar movimentação';
$string['moveafter'] = 'Mover "{$a->item}" após "{$a->target}"';
$string['movebefore'] = 'Mover "{$a->item}" antes "{$a->target}"';
$string['moveinto'] = 'Mover "{$a->item}" para "{$a->target}"';
$string['myprograms'] = 'Meus programas';
$string['notification_allocation'] = 'Usuário alocado';
$string['notification_completion'] = 'Programa concluído';
$string['notification_completion_subject'] = 'Programa concluído';
$string['notification_completion_body'] = 'Olá, {$a->user_fullname},

você concluiu o programa "{$a->program_fullname}".
';
$string['notification_deallocation'] = 'Usuário desalocado';
$string['notification_duesoon'] = 'A data de entrega do programa é muito próxima';
$string['notification_duesoon_subject'] = 'A conclusão do programa é esperada em breve';
$string['notification_duesoon_body'] = 'Olá, {$a->user_fullname},

espera-se que o programa "{$a->program_fullname}" seja concluído em {$a->program_duedate}.
';
$string['notification_due'] = 'Programa vencido';
$string['notification_due_subject'] = 'A conclusão do programa era esperada';
$string['notification_due_body'] = 'Olá, {$a->user_fullname},

a conclusão do programa "{$a->program_fullname}" era esperada antes de {$a->program_duedate}.
';
$string['notification_endsoon'] = 'Data de término do programa muito próxima';
$string['notification_endsoon_subject'] = 'O programa termina em breve';
$string['notification_endsoon_body'] = 'Olá, {$a->user_fullname},

o programa "{$a->program_fullname}" está terminando em {$a->program_enddate}.
';
$string['notification_endcompleted'] = 'Programa encerrado';
$string['notification_endcompleted_subject'] = 'Programa encerrado';
$string['notification_endcompleted_body'] = 'Olá, {$a->user_fullname},

o programa "{$a->program_fullname}" terminou, você o concluiu mais cedo.
';
$string['notification_endfailed'] = 'Programa encerrado com falha';
$string['notification_endfailed_subject'] = 'Programa encerrado com falha';
$string['notification_endfailed_body'] = 'Olá, {$a->user_fullname},

o programa "{$a->program_fullname}" terminou, você não conseguiu concluí-lo.
';
$string['notification_start'] = 'Programa iniciado';
$string['notification_start_subject'] = 'Programa iniciado';
$string['notification_start_body'] = 'Olá, {$a->user_fullname},

o programa "{$a->program_fullname}" foi iniciado.
';
$string['notificationdates'] = 'Datas de notificação';
$string['notset'] = 'Não definido';
$string['plugindisabled'] = 'O plug-in de inscrição no programa está desabilitado, os programas não estão funcionais.

[Enable plugin now]({$a->url})';
$string['pluginname'] = 'Programas';
$string['pluginname_desc'] = 'Os programas são projetados para permitir a criação de conjuntos de cursos.';
$string['privacy:metadata:field:programid'] = 'ID do programa';
$string['privacy:metadata:field:userid'] = 'Código do usuário';
$string['privacy:metadata:field:allocationid'] = 'ID de alocação do programa';
$string['privacy:metadata:field:sourceid'] = 'Origem da alocação';
$string['privacy:metadata:field:itemid'] = 'Código do item';
$string['privacy:metadata:field:timecreated'] = 'Data de criação';
$string['privacy:metadata:field:timecompleted'] = 'Data de conclusão';

$string['privacy:metadata:table:enrol_programs_allocations'] = 'Informações sobre alocações do programa';
$string['privacy:metadata:field:archived'] = 'É o registro arquivado';
$string['privacy:metadata:field:sourcedatajson'] = 'Informações sobre a fonte da alocação';
$string['privacy:metadata:field:timeallocated'] = 'Data de alocação do programa';
$string['privacy:metadata:field:timestart'] = 'Data de início';
$string['privacy:metadata:field:timedue'] = 'Data de encerramento';
$string['privacy:metadata:field:timeend'] = 'Data de encerramento';

$string['privacy:metadata:table:enrol_programs_certs_issues'] = 'Problemas de certificado de alocação do programa';
$string['privacy:metadata:field:issueid'] = 'ID do problema';

$string['privacy:metadata:table:enrol_programs_completions'] = 'Conclusões de alocação do programa';

$string['privacy:metadata:table:enrol_programs_evidences'] = 'Informações sobre outras evidências de conclusão';
$string['privacy:metadata:field:evidencejson'] = 'Informações sobre evidência de conclusão';
$string['privacy:metadata:field:createdby'] = 'Evidência criada por';

$string['privacy:metadata:table:enrol_programs_requests'] = 'Informações sobre solicitação de alocação';
$string['privacy:metadata:field:datajson'] = 'Informações sobre a solicitação';
$string['privacy:metadata:field:timerequested'] = 'Data de solicitação';
$string['privacy:metadata:field:timerejected'] = 'Data de rejeição';
$string['privacy:metadata:field:rejectedby'] = 'Solicitação rejeitada por';


$string['privacy:metadata:table:enrol_programs_usr_snapshots'] = 'Instantâneos de alocação de programa';
$string['privacy:metadata:field:reason'] = 'Motivo';
$string['privacy:metadata:field:timesnapshot'] = 'Data do instantâneo';
$string['privacy:metadata:field:snapshotby'] = 'Instantâneo por';
$string['privacy:metadata:field:explanation'] = 'Explicação';
$string['privacy:metadata:field:completionsjson'] = 'Informações sobre conclusão';
$string['privacy:metadata:field:evidencesjson'] = 'Informações sobre evidência de conclusão';

$string['program'] = 'Programa';
$string['programautofix'] = 'Programa de reparo automático';
$string['programdue'] = 'Programa previsto';
$string['programdue_help'] = 'A data de vencimento do programa indica quando os usuários devem concluir o programa.';
$string['programdue_delay'] = 'Encerrado após o início';
$string['programdue_date'] = 'Data de encerramento';
$string['programend'] = 'Término do programa';
$string['programend_help'] = 'Os usuários não podem entrar nos cursos do programa após o término do programa.';
$string['programend_delay'] = 'Término após o início';
$string['programend_date'] = 'Data de término do programa';
$string['programcompletion'] = 'Data de conclusão do programa';
$string['programidnumber'] = 'Idnumber do programa';
$string['programimage'] = 'Imagem do programa';
$string['programname'] = 'Nome do programa';
$string['programurl'] = 'URL do programa';
$string['programs'] = 'Programas';
$string['programsactive'] = 'Ativos';
$string['programsarchived'] = 'Arquivada';
$string['programsarchived_help'] = 'Os programas arquivados ficam ocultos para os usuários e seu progresso é bloqueado.';
$string['programstart'] = 'Início do programa';
$string['programstart_help'] = 'Os usuários não podem entrar nos cursos do programa antes do início do programa.';
$string['programstart_allocation'] = 'Inicie imediatamente após a alocação';
$string['programstart_delay'] = 'Início do atraso após alocação';
$string['programstart_date'] = 'Data de início do programa';
$string['programstatus'] = 'Status do programa';
$string['programstatus_completed'] = 'Concluídos';
$string['programstatus_any'] = 'Qualquer status do programa';
$string['programstatus_archived'] = 'Arquivada';
$string['programstatus_archivedcompleted'] = 'Arquivados concluídos';
$string['programstatus_overdue'] = 'Vencidos';
$string['programstatus_open'] = 'Abrir';
$string['programstatus_future'] = 'Ainda não abertos';
$string['programstatus_failed'] = 'Falha';
$string['programs:addcourse'] = 'Adicionar curso aos programas';
$string['programs:allocate'] = 'Alocar alunos aos programas';
$string['programs:delete'] = 'Excluir programas';
$string['programs:edit'] = 'Adicionar e atualizar programas';
$string['programs:admin'] = 'Administração avançada de programas';
$string['programs:manageevidence'] = 'Gerenciar outras evidências de conclusão';
$string['programs:view'] = 'Visualizar gerenciamento de programas';
$string['programs:viewcatalogue'] = 'Acessar catálogo de programas';
$string['public'] = 'Público';
$string['public_help'] = 'Programas públicos são visíveis para todos os usuários.

O status de visibilidade não afeta os programas já alocados.';
$string['sequencetype'] = 'Tipo de conclusão';
$string['sequencetype_allinorder'] = 'Tudo em ordem';
$string['sequencetype_allinanyorder'] = 'Todos em qualquer ordem';
$string['sequencetype_atleast'] = 'Pelo menos {$a->min}';
$string['selectcategory'] = 'Selecionar categoria';
$string['source'] = 'Origem';
$string['source_approval'] = 'Solicitações com aprovação';
$string['source_approval_allownew'] = 'Permitir aprovações';
$string['source_approval_allownew_desc'] = 'Permitir a adição de novas fontes de _requests with approval_ aos programas';
$string['source_approval_allowrequest'] = 'Permitir novas solicitações';
$string['source_approval_confirm'] = 'Confirme se você deseja solicitar alocação para o programa.';
$string['source_approval_daterequested'] = 'Data solicitada';
$string['source_approval_daterejected'] = 'Data rejeitada';
$string['source_approval_makerequest'] = 'Solicitar acesso';
$string['source_approval_notification_allocation_subject'] = 'Notificação de aprovação do programa';
$string['source_approval_notification_allocation_body'] = 'Olá, {$a->user_fullname},

a sua inscrição no programa "{$a->program_fullname}" foi aprovada, a data de início é {$a->program_startdate}.
';
$string['source_approval_notification_approval_request_subject'] = 'Notificação de solicitação do programa';
$string['source_approval_notification_approval_request_body'] = '
O usuário {$a->user_fullname} solicitou acesso ao programa "{$a->program_fullname}".
';
$string['source_approval_notification_approval_reject_subject'] = 'Notificação de rejeição de solicitação de programa';
$string['source_approval_notification_approval_reject_body'] = 'Olá, {$a->user_fullname},

sua solicitação de acesso ao programa "{$a->program_fullname}" foi rejeitada.

{$a->reason}
';
$string['source_approval_requestallowed'] = 'Solicitações são permitidas';
$string['source_approval_requestnotallowed'] = 'Solicitações não são permitidas';
$string['source_approval_requests'] = 'Solicitações';
$string['source_approval_requestpending'] = 'Solicitação de acesso pendente';
$string['source_approval_requestrejected'] = 'A solicitação de acesso foi rejeitada';
$string['source_approval_requestapprove'] = 'Aprovar solicitação';
$string['source_approval_requestreject'] = 'Rejeitar solicitação';
$string['source_approval_requestdelete'] = 'Excluir solicitação';
$string['source_approval_rejectionreason'] = 'Motivo da rejeição';
$string['notification_allocation_subject'] = 'Notificação de alocação de programa';
$string['notification_allocation_body'] = 'Olá, {$a->user_fullname},

Você foi alocado para o programa "{$a->program_fullname}", a data de início é {$a->program_startdate}.
';
$string['notification_deallocation_subject'] = 'Notificação de desalocação de programa';
$string['notification_deallocation_body'] = 'Olá, {$a->user_fullname},

você foi desalocado do programa "{$a->program_fullname}".
';
$string['source_cohort'] = 'Alocação automática da série';
$string['source_cohort_allownew'] = 'Permitir alocação de série';
$string['source_cohort_allownew_desc'] = 'Permitir a adição de novas fontes de _cohort auto allocation_ aos programas';
$string['source_manual'] = 'Alocação manual';
$string['source_manual_allocateusers'] = 'Alocar usuários';
$string['source_manual_csvfile'] = 'Arquivo CSV';
$string['source_manual_hasheaders'] = 'A primeira linha é cabeçalho';
$string['source_manual_potusersmatching'] = 'Candidatos de alocação correspondentes';
$string['source_manual_potusers'] = 'Candidatos de alocação';
$string['source_manual_result_assigned'] = '{$a} usuários foram atribuídos ao programa.';
$string['source_manual_result_errors'] = '{$a} erros detectados ao atribuir programas.';
$string['source_manual_result_skipped'] = '{$a} os usuários já foram atribuídos ao programa.';
$string['source_manual_uploadusers'] = 'Carregar alocações';
$string['source_manual_usercolumn'] = 'Coluna de identificação do usuário';
$string['source_manual_usermapping'] = 'Mapeamento de usuário via';
$string['source_manual_userupload_allocated'] = 'Alocado a \'{$a}\'';
$string['source_manual_userupload_alreadyallocated'] = 'Já alocado a \'{$a}\'';
$string['source_manual_userupload_invalidprogram'] = 'Não é possível alocar a \'{$a}\'';
$string['source_selfallocation'] = 'Autoalocação';
$string['source_selfallocation_allocate'] = 'Inscrever-se';
$string['source_selfallocation_allownew'] = 'Permitir autoalocação';
$string['source_selfallocation_allownew_desc'] = 'Permitir a adição de novas fontes de _self allocation_ aos programas';
$string['source_selfallocation_allowsignup'] = 'Permitir novas inscrições';
$string['source_selfallocation_confirm'] = 'Confirme se você deseja ser alocado ao programa.';
$string['source_selfallocation_enable'] = 'Habilitar autoalocação';
$string['source_selfallocation_key'] = 'Chave de inscrição';
$string['source_selfallocation_keyrequired'] = 'A chave de inscrição é obrigatória';
$string['source_selfallocation_maxusers'] = 'Máximo de usuários';
$string['source_selfallocation_maxusersreached'] = 'Número máximo de usuários já autoalocados';
$string['source_selfallocation_maxusers_status'] = 'Usuários {$a->count}/{$a->max}';
$string['source_selfallocation_notification_allocation_subject'] = 'Notificação de alocação de programa';
$string['source_selfallocation_notification_allocation_body'] = 'Olá, {$a->user_fullname},

Você se inscreveu para o programa "{$a->program_fullname}", a data de início é {$a->program_startdate}.
';
$string['source_selfallocation_signupallowed'] = 'Inscrições são permitidas';
$string['source_selfallocation_signupnotallowed'] = 'Inscrições não são permitidas';
$string['set'] = 'Conjunto do curso';
$string['settings'] = 'Configurações do programa';
$string['scheduling'] = 'Agendamento';
$string['taballocation'] = 'Configurações da alocação';
$string['tabcontent'] = 'Conteúdo';
$string['tabgeneral'] = 'Geral';
$string['tabusers'] = 'Usuários';
$string['tabvisibility'] = 'Configurações de visibilidade';
$string['tagarea_program'] = 'Programas';
$string['taskcertificate'] = 'Certificado de programas emitindo cron';
$string['taskcron'] = 'Programa plug-in cron';
$string['unlinkeditems'] = 'Itens não vinculados';
$string['updateprogram'] = 'Atualizar programa';
$string['updateallocation'] = 'Atualizar alocação';
$string['updateallocations'] = 'Atualizar alocações';
$string['updateset'] = 'Atualizar conjunto';
$string['updatescheduling'] = 'Atualizar agendamento';
$string['updatesource'] = 'Atualizar {$a}';
