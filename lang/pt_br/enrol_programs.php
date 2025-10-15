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
$string['archive'] = 'Arquivar';
$string['archived'] = 'Arquivada';
$string['benefitname'] = '{$a}: alocação do programa';
$string['calendarprogramend'] = '{$a} termina';
$string['calendarprogramdue'] = '{$a} está vencido';
$string['calendarprogramstart'] = '{$a} inicia';
$string['catalogue'] = 'Catálogo de programas';
$string['catalogue_dofilter'] = 'Busca';
$string['catalogue_resetfilter'] = 'Limpar';
$string['catalogue_searchtext'] = 'Buscar texto';
$string['catalogue_tag'] = 'Filtrar por tags';
$string['certificatetemplatechoose'] = 'Escolha um modelo...';
$string['cohorts'] = 'Visível para séries';
$string['cohorts_help'] = 'Programas não públicos podem ser visíveis para membros da série especificados.

O status de visibilidade não afeta os programas já alocados.';
$string['columnusedalready'] = 'A coluna já está sendo usada';
$string['completepercent'] = '{$a}% concluído';
$string['completion'] = 'Conclusão';
$string['completiondate'] = 'Data de conclusão';
$string['completiondelay'] = 'Atraso na conclusão';
$string['completionoverride'] = 'Substituir conclusão';
$string['creategroups'] = 'Grupos de cursos';
$string['creategroups_help'] = 'Se ativado, um grupo será criado em cada curso adicionado ao programa e todos os usuários alocados serão adicionados como membros do grupo.';
$string['customfields'] = 'Campos personalizados dos programas';
$string['customfieldsettings'] = 'Configurações dos campos personalizados dos programas comuns';
$string['customfieldvisibleto'] = 'O conteúdo do campo está visível para';
$string['customfieldvisible:allocated'] = 'Usuários alocados aos programas';
$string['customfieldvisible:everyone'] = 'Todos que podem ver outros detalhes do programa';
$string['customfieldvisible:viewcapability'] = 'Usuários com recursos para exibir programas';
$string['deleteallocation'] = 'Excluir alocação de programa';
$string['deletecourse'] = 'Remover curso';
$string['deleteprogram'] = 'Excluir programa';
$string['deleteset'] = 'Excluir conjunto';
$string['deletetraining'] = 'Remover treinamento';
$string['documentation'] = 'Programas para a documentação Moodle';
$string['duedate'] = 'Data de encerramento';
$string['enrolrole'] = 'Função do curso';
$string['enrolrole_desc'] = 'Selecionar a função que será usada por programas para inscrição no curso';
$string['errorcontentproblem'] = 'Problema detectado na estrutura de conteúdo do programa, a conclusão do programa não será rastreada corretamente!';
$string['errorcoursemissing'] = 'Curso ausente';
$string['errorcoursesmissing'] = 'Cursos ausentes: {$a}';
$string['errorinvalidoverridedates'] = 'Substituições de data inválidas';
$string['errordifferenttenant'] = 'O programa de outro locatário não pode ser acessado';
$string['errorduplicateprogramid'] = 'O número de ID do programa já está sendo usado para outro programa. Use um número de ID exclusivo do programa.';
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
$string['evidencedate'] = 'Data de conclusão da evidência';
$string['evidenceupdate'] = 'Atualizar outras evidências';
$string['evidenceupload'] = 'Carregar evidências de conclusão';
$string['evidenceupload_csvfile'] = 'Arquivo CSV';
$string['evidenceupload_errors'] = '{$a} linhas inválidas detectadas';
$string['evidenceupload_skipped'] = '{$a} linhas ignoradas';
$string['evidenceupload_updated'] = 'Evidência de conclusão atualizada para {$a} usuários';
$string['evidence_details'] = 'Detalhes';
$string['evidence_detailsdefault'] = 'Detalhes padrão';
$string['export'] = 'Exportar programas';
$string['exportfile_info'] = 'info';
$string['exportfile_programs'] = 'programas';
$string['exportformat'] = 'Formato do documento';
$string['exportformat_csv'] = 'CSV';
$string['exportformat_json'] = 'JSON';
$string['extra_menu_management_index'] = 'Ações de programas';
$string['extra_menu_management_program_general'] = 'Ações do programa';
$string['extra_menu_management_program_users'] = 'Ações dos usuários';
$string['extra_menu_management_program_allocation'] = 'Ações de alocação';
$string['fixeddate'] = 'Na data fixa';
$string['idnumbersymbol'] = 'Número do código:';
$string['importallocationend'] = 'Término da alocação ({$a})';
$string['importallocationstart'] = 'Início da alocação ({$a})';
$string['importprogramallocation'] = 'Importar alocação de programa';
$string['importprogramallocationconfirmation'] = 'Você está importando configurações de alocação do programa __{$a->fullname} / {$a->idnumber} {$a->category}__.

Selecione todas as configurações que deseja importar.';
$string['importprogramcontent'] = 'Importar conteúdo do programa';
$string['importprogramcontentconfirmation'] = 'Você está importando conteúdo do programa __{$a->fullname} / {$a->idnumber} / {$a->category}__.';
$string['importprogramdue'] = 'Vencimento do programa ({$a})';
$string['importprogramend'] = 'Término do programa ({$a})';
$string['importprogramstart'] = 'Início do programa ({$a})';
$string['importselectprogram'] = 'Selecionar programa';
$string['invalidallocationdates'] = 'Datas de alocação do programa inválidas';
$string['invalidcompletiondate'] = 'Data de conclusão do programa inválida';
$string['item'] = 'Item';
$string['itemcompletion'] = 'Conclusão do item do programa';
$string['itempoints'] = 'Pontos';
$string['itemrecalculate'] = 'Recalcular conclusão do item';
$string['layoutgrid'] = 'Layout da grade';
$string['layouttable'] = 'Layout da tabela';
$string['management'] = 'Gerenciamento de programa';
$string['messageprovider:allocation_notification'] = 'Notificação de alocação de programa';
$string['messageprovider:approval_request_notification'] = 'Notificação de solicitação de aprovação de programa';
$string['messageprovider:approval_reject_notification'] = 'Notificação de rejeição de solicitação de programa';
$string['messageprovider:completion_notification'] = 'Notificação de programa concluído';
$string['messageprovider:completion_relateduser_notification'] = 'Notificação de programa concluído – usuário relacionado';
$string['messageprovider:deallocation_notification'] = 'Notificação de desalocação de programa';
$string['messageprovider:duesoon_notification'] = 'Notificação de data de entrega do programa muito próxima';
$string['messageprovider:duesoon_relateduser_notification'] = 'Notificação de data de entrega do programa muito próxima – usuário relacionado';
$string['messageprovider:due_notification'] = 'Notificação de atraso do programa';
$string['messageprovider:due_relateduser_notification'] = 'Notificação de atraso do programa – usuário relacionado';
$string['messageprovider:endsoon_notification'] = 'Notificação de data de término do programa muito próxima';
$string['messageprovider:endsoon_relateduser_notification'] = 'Notificação de data de término do programa muito próxima – usuário relacionado';
$string['messageprovider:endcompleted_notification'] = 'Notificação de programa concluído encerrado';
$string['messageprovider:endfailed_notification'] = 'Falha na notificação de programa encerrado';
$string['messageprovider:endfailed_relateduser_notification'] = 'Falha na notificação de programa encerrado – usuário relacionado';
$string['messageprovider:reset_notification'] = 'Notificação de redefinição de programa';
$string['messageprovider:start_notification'] = 'Notificação de programa iniciado';
$string['moveitem'] = 'Mover item';
$string['moveitemcancel'] = 'Cancelar movimentação';
$string['moveafter'] = 'Mover "{$a->item}" após "{$a->target}"';
$string['movebefore'] = 'Mover "{$a->item}" antes de "{$a->target}"';
$string['moveinto'] = 'Mover "{$a->item}" para "{$a->target}"';
$string['myprograms'] = 'Meus programas';
$string['notification_allocation'] = 'Usuário alocado';
$string['notification_allocation_subject'] = 'Notificação de alocação de programa';
$string['notification_allocation_body'] = 'Olá {$a->user_fullname},

você foi alocado para o programa "{$a->program_fullname}", a data de início é {$a->program_startdate}.
';
$string['notification_allocation_description'] = 'Notificação enviada aos usuários quando são alocados ao programa.';
$string['notification_completion'] = 'Programa concluído';
$string['notification_completion_subject'] = 'Programa concluído';
$string['notification_completion_body'] = 'Olá {$a->user_fullname},

você concluiu o programa "{$a->program_fullname}".
';
$string['notification_completion_description'] = 'Notificação enviada aos usuários quando concluem os respectivos programas.';
$string['notification_completion_relateduser'] = 'Programa concluído – usuário relacionado';
$string['notification_completion_relateduser_subject'] = 'O usuário {$a->user_fullname} concluiu o programa';
$string['notification_completion_relateduser_body'] = 'Olá {$a->relateduser_fullname},

o usuário {$a->user_fullname} concluiu o programa "{$a->program_fullname}".
';
$string['notification_completion_relateduser_description'] = 'Notificação enviada aos usuários relacionados quando eles concluem os respectivos programas.';
$string['notification_deallocation'] = 'Usuário desalocado';
$string['notification_deallocation_subject'] = 'Notificação de desalocação de programa';
$string['notification_deallocation_body'] = 'Olá {$a->user_fullname},

você foi desalocado do programa "{$a->program_fullname}".
';
$string['notification_deallocation_description'] = 'Notificação enviada aos usuários quando eles são desalocados do programa.';
$string['notification_duesoon'] = 'A data de entrega do programa é muito próxima';
$string['notification_duesoon_subject'] = 'A conclusão do programa é esperada em breve';
$string['notification_duesoon_body'] = 'Olá {$a->user_fullname},

a conclusão do programa "{$a->program_fullname}" está prevista para {$a->program_duedate}.
';
$string['notification_duesoon_description'] = 'Notificação enviada aos usuários antes da data de conclusão do programa, a menos que o programa já esteja concluído.';
$string['notification_duesoon_relateduser'] = 'Data de entrega do programa muito em breve – usuário relacionado';
$string['notification_duesoon_relateduser_subject'] = 'A conclusão do programa está prevista para ocorrer muito em breve para o usuário {$a->user_fullname}';
$string['notification_duesoon_relateduser_body'] = 'Olá {$a->relateduser_fullname},

a conclusão do programa "{$a->program_fullname}" para o usuário {$a->user_fullname} está prevista para ocorrer em {$a->program_duedate}.
';
$string['notification_duesoon_relateduser_description'] = 'Notificação enviada aos usuários relacionados antes da data de conclusão do programa, a menos que o programa já esteja concluído.';
$string['notification_due'] = 'Programa vencido';
$string['notification_due_subject'] = 'A conclusão do programa era esperada';
$string['notification_due_body'] = 'Olá {$a->user_fullname},

a conclusão do programa "{$a->program_fullname}" estava prevista para ocorrer antes de {$a->program_duedate}.
';
$string['notification_due_description'] = 'Notificação enviada aos usuários quando a conclusão do programa está vencida.';
$string['notification_due_relateduser'] = 'Programa vencido – usuário relacionado';
$string['notification_due_relateduser_subject'] = 'A conclusão do programa estava prevista para o usuário {$a->user_fullname}';
$string['notification_due_relateduser_body'] = 'Olá {$a->relateduser_fullname},

a conclusão do programa "{$a->program_fullname}" para o usuário {$a->user_fullname} era esperada que ocorresse antes de {$a->program_duedate}.
';
$string['notification_due_relateduser_description'] = 'Notificação enviada aos usuários relacionados quando a conclusão do programa estiver atrasada.';
$string['notification_endsoon'] = 'Data de término do programa muito próxima';
$string['notification_endsoon_subject'] = 'O programa termina em breve';
$string['notification_endsoon_body'] = 'Olá {$a->user_fullname},

o programa "{$a->program_fullname}" terminará em {$a->program_enddate}.
';
$string['notification_endsoon_description'] = 'Notificação enviada aos usuários antes da data de término do programa, a menos que o programa já tenha sido concluído.';
$string['notification_endsoon_relateduser'] = 'Data de término do programa muito em breve – usuário relacionado';
$string['notification_endsoon_relateduser_subject'] = 'O programa termina em breve para o usuário {$a->user_fullname}';
$string['notification_endsoon_relateduser_body'] = 'Olá {$a->relateduser_fullname},

o programa "{$a->program_fullname}" para o usuário {$a->user_fullname} terminará em {$a->program_enddate}.
';
$string['notification_endsoon_relateduser_description'] = 'Notificação enviada aos usuários relacionados antes da data final do programa, a menos que o programa já esteja concluído.';
$string['notification_endcompleted'] = 'Programa encerrado';
$string['notification_endcompleted_subject'] = 'Programa encerrado';
$string['notification_endcompleted_body'] = 'Olá {$a->user_fullname},

o programa "{$a->program_fullname}" terminou, você o concluiu antecipadamente.
';
$string['notification_endcompleted_description'] = 'Notificação enviada aos usuários quando a conclusão de seu programa ocorre.';
$string['notification_endfailed'] = 'Programa encerrado com falha';
$string['notification_endfailed_subject'] = 'Programa encerrado com falha';
$string['notification_endfailed_body'] = 'Olá {$a->user_fullname},

o programa "{$a->program_fullname}" terminou, você não conseguiu concluí-lo.
';
$string['notification_endfailed_description'] = 'Notificação enviada aos usuários ao término do programa que eles não conseguiram concluir.';
$string['notification_endfailed_relateduser'] = 'Falha na conclusão do programa – usuário relacionado';
$string['notification_endfailed_relateduser_subject'] = 'Falha na conclusão do programa para o usuário {$a->user_fullname}';
$string['notification_endfailed_relateduser_body'] = 'Olá {$a->relateduser_fullname},

o programa "{$a->program_fullname}" foi encerrado e o usuário {$a->user_fullname} não conseguiu concluí-lo.
';
$string['notification_endfailed_relateduser_description'] = 'Notificação enviada aos usuários relacionados quando o programa que eles não conseguiram concluir termina.';
$string['notification_relateduserfield'] = 'Campo de usuário relacionado da notificação';
$string['notification_relateduserfield_desc'] = 'Selecione o campo de perfil de usuários relacionados a ser usado para notificação de usuários relacionados.';
$string['notification_reset'] = 'Redefinição do progresso do usuário';
$string['notification_reset_subject'] = 'Notificação de redefinição de programa';
$string['notification_reset_body'] = 'Olá {$a->user_fullname},

seu progresso no programa "{$a->program_fullname}" foi redefinido.
';
$string['notification_reset_description'] = 'Notificação enviada aos usuários quando o progresso do programa é redefinido.';
$string['notification_start'] = 'Programa iniciado';
$string['notification_start_subject'] = 'Programa iniciado';
$string['notification_start_body'] = 'Olá {$a->user_fullname},

o programa "{$a->program_fullname}" foi iniciado.
';
$string['notification_start_description'] = 'Notificação enviada aos usuários quando o programa é iniciado.';
$string['notificationdates'] = 'Datas de notificação';
$string['notset'] = 'Não definido';
$string['plugindisabled'] = 'O plug-in de inscrição no programa está desabilitado, os programas não estão funcionais. [Enable plugin now]({$a->url})';
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

$string['privacy:metadata:table:enrol_programs_src_commholds'] = 'Reservas de alocação por comércio';
$string['privacy:metadata:field:quantity'] = 'Quantidade';

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
$string['programcompletionoverride'] = 'Substituir a conclusão do programa';
$string['programidnumber'] = 'Idnumber do programa';
$string['programimage'] = 'Imagem do programa';
$string['programname'] = 'Nome do programa';
$string['programurl'] = 'URL do programa';
$string['programs'] = 'Programas';
$string['programsactive'] = 'Ativos';
$string['programsarchived'] = 'Arquivada';
$string['programsarchived_help'] = 'Os programas arquivados ficam ocultos para os usuários e seu progresso é bloqueado.';
$string['programslayout'] = 'Programa o layout detalhado da página';
$string['programslayout_desc'] = 'Controla o layout dos programas – exibição de tabela ou grade para a página Meus/programas.';
$string['programslayoutallowuserswitch'] = 'Permitir que os usuários alternem o layout do programa';
$string['programslayoutallowuserswitch_desc'] = 'Permitir que os usuários alternem o layout do programa';
$string['programslayout_desc'] = 'Controla o layout dos programas – exibição de tabela ou grade para a página Meus/programas.';
$string['programsblocklayout'] = 'Layout do bloco Meus programas';
$string['programsblocklayout_desc'] = 'Controla o layout dos programas – exibição de tabela ou grade para o bloco myprograms.';

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
$string['programs:addtocertifications'] = 'Adicionar programa a certificações';
$string['programs:addtoplan'] = 'Adicionar programa aos planos';
$string['programs:allocate'] = 'Alocar alunos aos programas';
$string['programs:archive'] = 'Arquivar alocações de programa';
$string['programs:clone'] = 'Permitir clonagem de conteúdo e configurações do programa';
$string['programs:configframeworks'] = 'Configurar a disponibilidade do programa em estruturas de plano';
$string['programs:configurecustomfields'] = 'Configurar campos personalizados do programa';
$string['programs:delete'] = 'Excluir programas';
$string['programs:edit'] = 'Adicionar e atualizar programas';
$string['programs:export'] = 'Exportar programas';
$string['programs:admin'] = 'Administração avançada de programas';
$string['programs:manageallocation'] = 'Gerenciar alocações de usuários';
$string['programs:manageevidence'] = 'Gerenciar outras evidências de conclusão';
$string['programs:reset'] = 'Redefinir o progresso do programa';
$string['programs:upload'] = 'Carregar programas';
$string['programs:view'] = 'Visualizar gerenciamento de programas';
$string['programs:viewcatalogue'] = 'Acessar catálogo de programas';
$string['public'] = 'Público';
$string['public_help'] = 'Os programas públicos são visíveis para todos os usuários.

O status de visibilidade não afeta os programas já alocados.';
$string['purchaseaccess'] = 'Adquirir acesso';
$string['resetallocation'] = 'Redefinir o progresso do programa';
$string['resettype'] = 'Redefinir tipo';
$string['resettype_deallocate'] = 'Apenas desalocação de programa';
$string['resettype_full'] = 'Eliminação completa do curso';
$string['resettype_none'] = 'Nenhum';
$string['resettype_standard'] = 'Eliminação padrão do curso';
$string['sequencetype'] = 'Tipo de conclusão';
$string['sequencetype_allinorder'] = 'Tudo em ordem';
$string['sequencetype_allinanyorder'] = 'Todos em qualquer ordem';
$string['sequencetype_atleast'] = 'Pelo menos {$a->min}';
$string['sequencetype_minpoints'] = 'Mínimo de {$a->minpoints} pontos';
$string['selectcategory'] = 'Selecionar categoria';
$string['sortbyprogramname'] = 'Ordenar por sobrenome';
$string['sortbyprogramid'] = 'Classificar por ID do programa';
$string['sortbyprogramstart'] = 'Classificar por data de início do programa';
$string['sortbyprogramdue'] = 'Classificar por data de vencimento do programa';
$string['sortbyprogramend'] = 'Classificar por data final do programa';
$string['source'] = 'Fonte';
$string['source_approval'] = 'Solicitações com aprovação';
$string['source_approval_allownew'] = 'Permitir aprovações';
$string['source_approval_allownew_desc'] = 'Permitir a adição de novas fontes de _requests with approval_ aos programas';
$string['source_approval_allowrequest'] = 'Permitir novas solicitações';
$string['source_approval_confirm'] = 'Confirme se você deseja solicitar alocação para o programa.';
$string['source_approval_daterequested'] = 'Data solicitada';
$string['source_approval_daterejected'] = 'Data rejeitada';
$string['source_approval_makerequest'] = 'Solicitar acesso';
$string['source_approval_notification_approval_request_subject'] = 'Notificação de solicitação do programa';
$string['source_approval_notification_approval_request_body'] = '
O usuário {$a->user_fullname} solicitou acesso ao programa "{$a->program_fullname}".
';
$string['source_approval_notification_approval_reject_subject'] = 'Notificação de rejeição de solicitação de programa';
$string['source_approval_notification_approval_reject_body'] = 'Olá {$a->user_fullname},

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
$string['source_certify'] = 'Certificados';
$string['source_certify_allownew'] = 'Permitir alocação de certificados';
$string['source_certify_allownew_desc'] = 'Permitir a adição de novas fontes de _certification_ aos programas';
$string['source_cohort'] = 'Alocação automática da série';
$string['source_cohort_allownew'] = 'Permitir alocação de série';
$string['source_cohort_allownew_desc'] = 'Permitir a adição de novas fontes de _cohort auto allocation_ aos programas';
$string['source_cohort_cohortstoallocate'] = 'Alocar séries';
$string['source_ecommerce'] = 'Alocação de e-commerce';
$string['source_ecommerce_allownew'] = 'Permitir alocação de e-commerce';
$string['source_ecommerce_allownew_desc'] = 'Permitir a adição de novas fontes de alocação automática de e-commerce aos programas';
$string['source_ecommerce_allowsignup'] = 'Permitir novas alocações';
$string['source_ecommerce_cohortmembershiprequirement'] = 'Os usuários devem ser membros de uma das seguintes séries: {$a}';
$string['source_ecommerce_maxusers'] = 'Máximo de usuários';
$string['source_ecommerce_nocapacity'] = 'Não restam vagas neste programa';
$string['source_manual'] = 'Alocação manual';
$string['source_manual_allocateusers'] = 'Alocar usuários';
$string['source_manual_csvfile'] = 'Arquivo CSV';
$string['source_manual_hasheaders'] = 'A primeira linha é cabeçalho';
$string['source_manual_potusersmatching'] = 'Candidatos de alocação correspondentes';
$string['source_manual_potusers'] = 'Candidatos de alocação';
$string['source_manual_result_assigned'] = '{$a} usuários foram atribuídos ao programa.';
$string['source_manual_result_errors'] = '{$a} erros detectados ao atribuir programas.';
$string['source_manual_result_skipped'] = '{$a} usuários já foram atribuídos ao programa.';
$string['source_manual_timeduecolumn'] = 'Coluna de hora de entrega';
$string['source_manual_timeendcolumn'] = 'Coluna de hora de término';
$string['source_manual_timestartcolumn'] = 'Coluna de hora de início';
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
$string['source_selfallocation_signupallowed'] = 'Inscrições são permitidas';
$string['source_selfallocation_signupnotallowed'] = 'Inscrições não são permitidas';
$string['source_udplans'] = 'Planos de desenvolvimento do usuário';
$string['source_udplans_allownew'] = 'Planos de desenvolvimento do usuário';
$string['source_udplans_allownew_desc'] = 'Permitir a adição de novas fontes de _user development plans_ aos programas';
$string['source_udplans_allowed'] = 'Permitido';
$string['source_udplans_noframeworks'] = 'Não pode ser adicionado a nenhum plano';
$string['source_udplans_notallowed'] = 'Não permitido';
$string['source_udplans_requirecap'] = 'Adicionar o recurso necessário';
$string['set'] = 'Conjunto do curso';
$string['settings'] = 'Configurações do programa';
$string['scheduling'] = 'Agendamento';
$string['taballocation'] = 'Configurações da alocação';
$string['tabcontent'] = 'Conteúdo';
$string['tabgeneral'] = 'Geral';
$string['tabusers'] = 'Usuários';
$string['tabvisibility'] = 'Configurações de visibilidade';
$string['tagarea_enrol_programs_programs'] = 'Programas';
$string['taskcertificate'] = 'Certificado de programas emitindo cron';
$string['taskcron'] = 'Programa plug-in cron';
$string['training'] = 'Treinamento';
$string['trainingcompletion'] = 'Treinamento necessário: {$a}';
$string['trainingprogress'] = 'Progresso do treinamento: {$a->current}/{$a->total}';
$string['unarchive'] = 'Restaurar';
$string['unlinkeditems'] = 'Itens não vinculados';
$string['updateprogram'] = 'Atualizar programa';
$string['updateallocation'] = 'Atualizar alocação';
$string['updateallocations'] = 'Atualizar alocações';
$string['updatecourse'] = 'Atualizar curso';
$string['updateset'] = 'Atualizar conjunto';
$string['updatescheduling'] = 'Atualizar agendamento';
$string['updatesource'] = 'Atualizar {$a}';
$string['updatetraining'] = 'Atualizar treinamento';
$string['upload'] = 'Carregar programas';
$string['upload_invalidcount'] = 'Registros inválidos';
$string['upload_files'] = 'Arquivos';
$string['upload_files_error'] = 'São esperados vários arquivos CSV, um arquivo JSON ou um arquivo Zip';
$string['upload_preview'] = 'Visualização de dados';
$string['upload_status'] = 'Status';
$string['upload_status_invalid'] = 'Inválido';
$string['upload_targetcontext'] = 'Adicionar programas ao contexto';
$string['upload_uploadcount'] = 'Programas a serem carregados';
$string['upload_usecategory'] = 'Usar a coluna de categoria para contextos';
$string['userupload_completion_error'] = 'A conclusão do programa não pode ser atualizada';
$string['userupload_completion_updated'] = 'A conclusão do programa foi atualizada';

$string['rb_allocatedprograms'] = 'Programas alocados';
$string['rb_complete'] = 'Concluído';
$string['rb_completiondate'] = 'Data de conclusão';
$string['rb_completionstatus'] = 'Status de conclusão';
$string['rb_datecompleted'] = 'Data de conclusão';
$string['rb_dateallocated'] = 'Data de alocação';
$string['rb_datestarted'] = 'Data de início';
$string['rb_coursesall'] = 'Cursos – Todos';
$string['rb_incomplete'] = 'Incompleto';
$string['rb_isallocated'] = 'Está alocado';
$string['rb_iscomplete'] = 'Está concluído?';
$string['rb_iscompleteany'] = 'Está concluído? (qualquer método)';
$string['rb_isinprogress'] = 'Está em andamento?';
$string['rb_isnotcomplete'] = 'Não está concluído?';
$string['rb_isnotyetstarted'] = 'Ainda não foi iniciado?';
$string['rb_notstarted'] = 'Não iniciado';
$string['rb_officewhencompletedbasic'] = 'Office quando concluído (básico)';
$string['rb_privacy:metadata'] = 'O plug-in não armazena dados pessoais.';
$string['rb_programcategory'] = 'Categoria do programa (ou local)';
$string['rb_programcategoryid'] = 'Id da categoria do programa (N/D se local)';
$string['rb_programcategoryidnumber'] = 'Número de id da categoria do programa (N/D, se local)';
$string['rb_programcategorymultichoice'] = 'Categoria do programa (múltipla escolha)';
$string['rb_programedatecreated'] = 'Data de criação do programa';
$string['rb_programduedate'] = 'Data de entrega do programa';
$string['rb_programenddate'] = 'Data de término de alocação do programa';
$string['rb_programallocationtype'] = 'Tipo de alocação';
$string['rb_programallocationtypes'] = 'Tipos de alocação';
$string['rb_programexpandlink'] = 'Nome do programa (detalhes em expansão)';
$string['rb_programid'] = 'ID do programa';
$string['rb_programidnumber'] = 'Número de ID do programa';
$string['rb_programname'] = 'Nome do programa';
$string['rb_programnameandsummary'] = 'Nome e descrição do programa';
$string['rb_programnamelinked'] = 'Nome do programa (vinculado à página do programa)';
$string['rb_programmultiitem'] = 'Programa (vários itens)';
$string['rb_programsingleitem'] = 'Programa';
$string['rb_programstartdate'] = 'Data inicial de alocação do programa';
$string['rb_programsummary'] = 'Descrição do programa';
$string['rb_programvisible'] = 'O programa é público';
$string['rb_programvisibledisabled'] = 'Programa visível (não aplicável)';
$string['rb_progress'] = 'Progresso';
$string['rb_progressnumeric'] = 'Progresso (numérico)';
$string['rb_progresspercent'] = 'Progresso (% concluído)';
$string['rb_source_allocation'] = 'Alocações do programa';
$string['rb_timetocompletesinceenrol'] = 'Tempo para conclusão (desde a data de alocação)';
$string['rb_timetocompletesincestart'] = 'Tempo para conclusão (desde a data de início)';
$string['rb_type_program'] = 'Programa';
$string['rb_type_program_category'] = 'Categoria';
$string['rb_type_program_completion'] = 'Alocação do programa';
$string['rb_type_program_customfields'] = 'Campos personalizados do programa';
$string['rb_user'] = 'O usuário';
$string['rb_viewprogram'] = 'Exibir programa';
$string['rb_visiblecohorts'] = 'Séries com visibilidade';
