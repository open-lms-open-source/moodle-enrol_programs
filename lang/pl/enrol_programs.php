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

$string['addprogram'] = 'Dodaj program';
$string['addset'] = 'Dodaj nowy zestaw';
$string['allocationend'] = 'Koniec przydziału';
$string['allocationend_help'] = 'Data zakończenia przydziału zależy od włączonych źródeł przydziału. Zazwyczaj nowe przydziały nie są możliwe po tej dacie, jeżeli została określona.';
$string['allocation'] = 'Przydział';
$string['allocations'] = 'Przydziały';
$string['programallocations'] = 'Przydziały programów';
$string['allocationdate'] = 'Data przydziału';
$string['allocationsources'] = 'Źródła przydziału';
$string['allocationstart'] = 'Początek przydziału';
$string['allocationstart_help'] = 'Data rozpoczęcia przydziału zależy od włączonych źródeł przydziału. Zazwyczaj nowe przydziały są możliwe tylko po tej dacie, jeżeli została określona.';
$string['allprograms'] = 'Wszystkie programy';
$string['appenditem'] = 'Dodaj element';
$string['appendinto'] = 'Dodaj do elementu';
$string['archived'] = 'Zarchiwizowany';
$string['catalogue'] = 'Katalog programów';
$string['catalogue_dofilter'] = 'Wyszukaj';
$string['catalogue_resetfilter'] = 'Wyczyść';
$string['catalogue_searchtext'] = 'Wyszukaj tekst';
$string['catalogue_tag'] = 'Filtruj według znacznika';
$string['certificatetemplatechoose'] = 'Wybierz szablon...';
$string['cohorts'] = 'Widoczne dla kohort';
$string['cohorts_help'] = 'Programy niepubliczne mogą być widoczne dla określonych członków kohorty.

Status widoczności nie ma wpływu na już przydzielone programy.';
$string['completiondate'] = 'Data ukończenia';
$string['creategroups'] = 'Grupy kursów';
$string['creategroups_help'] = 'Jeśli ta opcja zostanie włączona, w każdym kursie dodanym do programu zostanie utworzona grupa, a wszyscy przypisani do niej użytkownicy zostaną dodani jako członkowie grupy.';
$string['deleteallocation'] = 'Usuń przydział programu';
$string['deletecourse'] = 'Usuń kurs';
$string['deleteprogram'] = 'Usuń program';
$string['deleteset'] = 'Usuń zestaw';
$string['documentation'] = 'Programy do dokumentacji Moodle';
$string['duedate'] = 'Data zakończenia';
$string['enrolrole'] = 'Rola na kursie';
$string['enrolrole_desc'] = 'Wybierz rolę, która będzie używana przez programy do zapisów na kursy';
$string['errorcontentproblem'] = 'Wykryto problem w strukturze zawartości programu. Ukończenie programu nie będzie prawidłowo śledzone!';
$string['errordifferenttenant'] = 'Brak dostępu do programu innego klienta';
$string['errornoallocations'] = 'Nie znaleziono przydziałów użytkownika';
$string['errornoallocation'] = 'Program nie jest przydzielony';
$string['errornomyprograms'] = 'Nie przydzielono Cię do żadnego programu.';
$string['errornoprograms'] = 'Nie znaleziono programów.';
$string['errornorequests'] = 'Nie znaleziono żądań dostępu do programu';
$string['errornotenabled'] = 'Wtyczka programów nie jest włączona';
$string['event_program_completed'] = 'Program ukończony';
$string['event_program_created'] = 'Program utworzony';
$string['event_program_deleted'] = 'Program usunięty';
$string['event_program_updated'] = 'Program zaktualizowany';
$string['event_program_viewed'] = 'Program wyświetlony';
$string['event_user_allocated'] = 'Użytkownik przydzielony do programu';
$string['event_user_deallocated'] = 'Użytkownik wypisany z programu';
$string['evidence'] = 'Inne świadectwa';
$string['evidence_details'] = 'Szczegóły';
$string['fixeddate'] = 'W określonym terminie';
$string['item'] = 'Pozycja';
$string['itemcompletion'] = 'Ukończenie elementu programu';
$string['management'] = 'Zarządzanie programem';
$string['messageprovider:allocation_notification'] = 'Powiadomienie o przydziale do programu';
$string['messageprovider:approval_request_notification'] = 'Powiadomienie o żądaniu zatwierdzenia programu';
$string['messageprovider:approval_reject_notification'] = 'Powiadomienie o odrzuceniu żądania dostępu do programu';
$string['messageprovider:completion_notification'] = 'Powiadomienie o ukończeniu programu';
$string['messageprovider:deallocation_notification'] = 'Powiadomienie o wypisaniu z programu';
$string['messageprovider:duesoon_notification'] = 'Powiadomienie o zbliżającym się terminie programu';
$string['messageprovider:due_notification'] = 'Powiadomienie o zaległym programie';
$string['messageprovider:endsoon_notification'] = 'Powiadomienie o zbliżającej się dacie zakończenia programu';
$string['messageprovider:endcompleted_notification'] = 'Powiadomienie o zakończeniu ukończonego programu';
$string['messageprovider:endfailed_notification'] = 'Powiadomienie o zakończeniu nieukończonego programu';
$string['messageprovider:start_notification'] = 'Powiadomienie o rozpoczęciu programu';
$string['moveitem'] = 'Przenieś element';
$string['moveitemcancel'] = 'Anuluj przenoszenie';
$string['moveafter'] = 'Przenieś element „{$a->item}” za „{$a->target}”';
$string['movebefore'] = 'Przenieś element „{$a->item}” przed „{$a->target}”';
$string['moveinto'] = 'Przenieś element „{$a->item}” do „{$a->target}”';
$string['myprograms'] = 'Moje programy';
$string['notification_allocation'] = 'Użytkownik przydzielony';
$string['notification_completion'] = 'Program ukończony';
$string['notification_completion_subject'] = 'Program ukończony';
$string['notification_completion_body'] = 'Witaj {$a->user_fullname}!

masz już ukończony program „{$a->program_fullname}”.
';
$string['notification_deallocation'] = 'Użytkownik wypisany';
$string['notification_duesoon'] = 'Zbliża się termin końcowy programu';
$string['notification_duesoon_subject'] = 'Ukończenie programu oczekiwane jest wkrótce';
$string['notification_duesoon_body'] = 'Witaj {$a->user_fullname}!

Ukończenie programu „{$a->program_fullname}” jest oczekiwane w dniu {$a->program_duedate}.
';
$string['notification_due'] = 'Zaległy program';
$string['notification_due_subject'] = 'Oczekiwano ukończenia programu';
$string['notification_due_body'] = 'Witaj {$a->user_fullname}!

Ukończenie programu „{$a->program_fullname}” było oczekiwane przed dniem {$a->program_duedate}.
';
$string['notification_endsoon'] = 'Zbliża się data zakończenia programu';
$string['notification_endsoon_subject'] = 'Program wkrótce się zakończy';
$string['notification_endsoon_body'] = 'Witaj {$a->user_fullname}!

Program „{$a->program_fullname}” kończy się w dniu {$a->program_enddate}.
';
$string['notification_endcompleted'] = 'Ukończony program został zakończony';
$string['notification_endcompleted_subject'] = 'Ukończony program został zakończony';
$string['notification_endcompleted_body'] = 'Witaj {$a->user_fullname}!

Program „{$a->program_fullname}” zakończył się. Udało Ci się go ukończyć wcześniej.
';
$string['notification_endfailed'] = 'Nieukończony program został zakończony';
$string['notification_endfailed_subject'] = 'Nieukończony program został zakończony';
$string['notification_endfailed_body'] = 'Witaj {$a->user_fullname}!

Program „{$a->program_fullname}” zakończył się. Nie udało Ci się go ukończyć.
';
$string['notification_start'] = 'Program rozpoczął się';
$string['notification_start_subject'] = 'Program rozpoczął się';
$string['notification_start_body'] = 'Witaj {$a->user_fullname}!

Program „{$a->program_fullname}” już się rozpoczął.
';
$string['notificationdates'] = 'Daty powiadomień';
$string['notset'] = 'Nie ustawione';
$string['plugindisabled'] = 'Wtyczka zapisów do programu jest wyłączona, programy nie będą funkcjonować.

[Enable plugin now]({$a->url})';
$string['pluginname'] = 'Programy';
$string['pluginname_desc'] = 'Programy zaprojektowano tak, aby umożliwić tworzenie zestawów kursów.';
$string['privacy:metadata:field:programid'] = 'Identyfikator programu';
$string['privacy:metadata:field:userid'] = 'Identyfikator użytkownika';
$string['privacy:metadata:field:allocationid'] = 'Identyfikator przydziału programu';
$string['privacy:metadata:field:sourceid'] = 'Źródło przydziału';
$string['privacy:metadata:field:itemid'] = 'ID pozycji';
$string['privacy:metadata:field:timecreated'] = 'Data utworzenia';
$string['privacy:metadata:field:timecompleted'] = 'Data ukończenia';

$string['privacy:metadata:table:enrol_programs_allocations'] = 'Informacje na temat przydziałów programów';
$string['privacy:metadata:field:archived'] = 'Czy rekord został zarchiwizowany';
$string['privacy:metadata:field:sourcedatajson'] = 'Informacja o źródle przydziału';
$string['privacy:metadata:field:timeallocated'] = 'Data przydziału programu';
$string['privacy:metadata:field:timestart'] = 'Data początkowa';
$string['privacy:metadata:field:timedue'] = 'Data zakończenia';
$string['privacy:metadata:field:timeend'] = 'Data końcowa';

$string['privacy:metadata:table:enrol_programs_certs_issues'] = 'Problemy z certyfikatem przydział programów';
$string['privacy:metadata:field:issueid'] = 'Identyfikator problemu';

$string['privacy:metadata:table:enrol_programs_completions'] = 'Ukończone przydzielanie programów';

$string['privacy:metadata:table:enrol_programs_evidences'] = 'Informacje o innych świadectwach ukończenia';
$string['privacy:metadata:field:evidencejson'] = 'Informacje o świadectwach ukończenia';
$string['privacy:metadata:field:createdby'] = 'Świadectwo zostało utworzone przez';

$string['privacy:metadata:table:enrol_programs_requests'] = 'Informacje o żądaniu przydzielenia';
$string['privacy:metadata:field:datajson'] = 'Informacje o żądaniu';
$string['privacy:metadata:field:timerequested'] = 'Data żądania';
$string['privacy:metadata:field:timerejected'] = 'Data odmowy';
$string['privacy:metadata:field:rejectedby'] = 'Żądanie odrzucone przez';


$string['privacy:metadata:table:enrol_programs_usr_snapshots'] = 'Migawki przydziału programów';
$string['privacy:metadata:field:reason'] = 'Powód';
$string['privacy:metadata:field:timesnapshot'] = 'Data migawki';
$string['privacy:metadata:field:snapshotby'] = 'Migawka wykonana przez';
$string['privacy:metadata:field:explanation'] = 'Wyjaśnienie';
$string['privacy:metadata:field:completionsjson'] = 'Informacje o ukończeniu';
$string['privacy:metadata:field:evidencesjson'] = 'Informacje o świadectwach ukończenia';

$string['program'] = 'Program';
$string['programautofix'] = 'Automatycznie napraw program';
$string['programdue'] = 'Wymagany program';
$string['programdue_help'] = 'Termin realizacji programu wskazuje, kiedy użytkownicy mają ukończyć program.';
$string['programdue_delay'] = 'Termin po rozpoczęciu';
$string['programdue_date'] = 'Data zakończenia';
$string['programend'] = 'Zakończenie programu';
$string['programend_help'] = 'Użytkownicy nie mogą wejść do kursy programu po zakończeniu programu.';
$string['programend_delay'] = 'Zakończenie po rozpoczęciu';
$string['programend_date'] = 'Data zakończenia programu';
$string['programcompletion'] = 'Data ukończenia programu';
$string['programidnumber'] = 'Numer identyfikacyjny programu';
$string['programimage'] = 'Obraz programu';
$string['programname'] = 'Nazwa programu';
$string['programurl'] = 'Adres URL programu';
$string['programs'] = 'Programy';
$string['programsactive'] = 'Aktywn.';
$string['programsarchived'] = 'Zarchiwizow.';
$string['programsarchived_help'] = 'Programy zarchiwizowane są ukryte przed użytkownikami, a ich postęp jest zablokowany.';
$string['programstart'] = 'Początek programu';
$string['programstart_help'] = 'Użytkownicy nie mogą wprowadzać kursów programu przed jego rozpoczęciem.';
$string['programstart_allocation'] = 'Rozpocznij natychmiast po przydziale';
$string['programstart_delay'] = 'Opóźnij rozpoczęcie po przydziale';
$string['programstart_date'] = 'Data rozpoczęcia programu';
$string['programstatus'] = 'Status programu';
$string['programstatus_completed'] = 'Ukończony';
$string['programstatus_any'] = 'Dowolny stan programu';
$string['programstatus_archived'] = 'Zarchiwizowany';
$string['programstatus_archivedcompleted'] = 'Zarchiwizowany ukończony';
$string['programstatus_overdue'] = 'Zaległy';
$string['programstatus_open'] = 'Otwarty';
$string['programstatus_future'] = 'Jeszcze nie otwarty';
$string['programstatus_failed'] = 'Nieukończony';
$string['programs:addcourse'] = 'Dodaj kurs do programów';
$string['programs:allocate'] = 'Przydziel uczniów do programów';
$string['programs:delete'] = 'Usuń programy';
$string['programs:edit'] = 'Dodaj i zaktualizuj programy';
$string['programs:admin'] = 'Zaawansowana administracja programem';
$string['programs:manageevidence'] = 'Zarządzaj innymi świadectwami ukończenia';
$string['programs:view'] = 'Wyświetl zarządzanie programem';
$string['programs:viewcatalogue'] = 'Otwórz katalog programów';
$string['public'] = 'Publiczne';
$string['public_help'] = 'Programy publiczne są widoczne dla wszystkich użytkowników.

Status widoczności nie ma wpływu na już przydzielone programy.';
$string['sequencetype'] = 'Typ ukończenia';
$string['sequencetype_allinorder'] = 'Wszystkie w kolejności';
$string['sequencetype_allinanyorder'] = 'Wszystkie w dowolnej kolejności';
$string['sequencetype_atleast'] = 'Co najmniej {$a->min}';
$string['selectcategory'] = 'Wybierz kategorię';
$string['source'] = 'Źródło';
$string['source_approval'] = 'Wnioski z akceptacją';
$string['source_approval_allownew'] = 'Zezwalaj na akceptację';
$string['source_approval_allownew_desc'] = 'Zezwalaj na dodawanie do programów nowych _requests with approval_';
$string['source_approval_allowrequest'] = 'Zezwalaj na nowe wnioski';
$string['source_approval_confirm'] = 'Potwierdź zamiar wystąpienia z wnioskiem o przydział do programu.';
$string['source_approval_daterequested'] = 'Data żądania';
$string['source_approval_daterejected'] = 'Data odrzucenia';
$string['source_approval_makerequest'] = 'Zawnioskuj o dostępu';
$string['source_approval_notification_allocation_subject'] = 'Powiadomienie o zatwierdzeniu programu';
$string['source_approval_notification_allocation_body'] = 'Witaj {$a->user_fullname}!

Twoja rejestracja w programie „{$a->program_fullname}” została zatwierdzona. Data rozpoczęcia to {$a->program_startdate}.
';
$string['source_approval_notification_approval_request_subject'] = 'Powiadomienie o żądaniu dostępu do programu';
$string['source_approval_notification_approval_request_body'] = '
Użytkownik {$a->user_fullname} zażądał dostępu do programu „{$a->program_fullname}”
';
$string['source_approval_notification_approval_reject_subject'] = 'Powiadomienie o odrzuceniu żądania dostępu do programu';
$string['source_approval_notification_approval_reject_body'] = 'Witaj {$a->user_fullname}!

Twoje żądanie dostępu do programu „{$a->program_fullname}” zostało odrzucone.

{$a->reason}
';
$string['source_approval_requestallowed'] = 'Żądania są dozwolone';
$string['source_approval_requestnotallowed'] = 'Żądania nie są dozwolone';
$string['source_approval_requests'] = 'Żądania';
$string['source_approval_requestpending'] = 'Oczekujące żądanie dostępu';
$string['source_approval_requestrejected'] = 'Żądanie dostępu zostało odrzucone';
$string['source_approval_requestapprove'] = 'Zatwierdź żądanie';
$string['source_approval_requestreject'] = 'Odrzuć żądanie';
$string['source_approval_requestdelete'] = 'Usuń żądanie';
$string['source_approval_rejectionreason'] = 'Przyczyna odrzucenia';
$string['notification_allocation_subject'] = 'Powiadomienie o przydziale do programu';
$string['notification_allocation_body'] = 'Witaj {$a->user_fullname}!

Przydzielono Cię do programu „{$a->program_fullname}”. Data rozpoczęcia to {$a->program_startdate}.
';
$string['notification_deallocation_subject'] = 'Powiadomienie o wypisaniu z programu';
$string['notification_deallocation_body'] = 'Witaj {$a->user_fullname}!

Wypisano Cię z programu „{$a->program_fullname}”.
';
$string['source_cohort'] = 'Automatyczne przydzielanie kohort';
$string['source_cohort_allownew'] = 'Zezwól na przydzielanie kohort';
$string['source_cohort_allownew_desc'] = 'Zezwól na dodawanie do programów nowych źródeł _cohort auto allocation_';
$string['source_manual'] = 'Ręczny przydział';
$string['source_manual_allocateusers'] = 'Przydziel użytkowników';
$string['source_manual_csvfile'] = 'Plik CSV';
$string['source_manual_hasheaders'] = 'Pierwszy wiersz to nagłówek';
$string['source_manual_potusersmatching'] = 'Dopasowani kandydaci do przydziału';
$string['source_manual_potusers'] = 'Kandydaci do przydziału';
$string['source_manual_result_assigned'] = 'Do programu przypisano {$a} użytkowników.';
$string['source_manual_result_errors'] = 'Podczas przypisywania programów wykryto błędy ({$a}).';
$string['source_manual_result_skipped'] = 'Do programu przypisano już {$a} użytkowników.';
$string['source_manual_uploadusers'] = 'Prześlij przydziały';
$string['source_manual_usercolumn'] = 'Kolumna identyfikacji użytkownika';
$string['source_manual_usermapping'] = 'Mapowanie użytkownika poprzez';
$string['source_manual_userupload_allocated'] = 'Przydzielono do \'{$a}\'';
$string['source_manual_userupload_alreadyallocated'] = 'Już przydzielono do \'{$a}\'';
$string['source_manual_userupload_invalidprogram'] = 'Nie można przydzielić do \'{$a}\'';
$string['source_selfallocation'] = 'Samodzielny przydział';
$string['source_selfallocation_allocate'] = 'Zarejestruj się';
$string['source_selfallocation_allownew'] = 'Zezwól na samodzielny przydział';
$string['source_selfallocation_allownew_desc'] = 'Zezwól na dodawanie do programów nowych źródeł _self allocation_';
$string['source_selfallocation_allowsignup'] = 'Zezwól na nowe rejestracje';
$string['source_selfallocation_confirm'] = 'Potwierdź chęć przydziału do programu.';
$string['source_selfallocation_enable'] = 'Włącz samodzielny przydział';
$string['source_selfallocation_key'] = 'Klucz rejestracji';
$string['source_selfallocation_keyrequired'] = 'Wymagany jest klucz rejestracji';
$string['source_selfallocation_maxusers'] = 'Maksymalna liczba użytkowników';
$string['source_selfallocation_maxusersreached'] = 'Maksymalna liczba użytkowników, którzy już dokonali samodzielnego przydziału.';
$string['source_selfallocation_maxusers_status'] = 'Użytkownicy {$a->count}/{$a->max}';
$string['source_selfallocation_notification_allocation_subject'] = 'Powiadomienie o przydziale do programu';
$string['source_selfallocation_notification_allocation_body'] = 'Witaj {$a->user_fullname}!

Zarejestrowano Cię do programu „{$a->program_fullname}”. Data rozpoczęcia to {$a->program_startdate}.
';
$string['source_selfallocation_signupallowed'] = 'Rejestracja jest dozwolona';
$string['source_selfallocation_signupnotallowed'] = 'Rejestracja nie jest dozwolona';
$string['set'] = 'Zestaw kursu';
$string['settings'] = 'Ustawienia programu';
$string['scheduling'] = 'Planowanie';
$string['taballocation'] = 'Ustawienia przydziału prac';
$string['tabcontent'] = 'Treść';
$string['tabgeneral'] = 'Główna';
$string['tabusers'] = 'Użytkownicy';
$string['tabvisibility'] = 'Ustawienia widoczności';
$string['tagarea_program'] = 'Programy';
$string['taskcertificate'] = 'Cron wystawiający certyfikaty programów';
$string['taskcron'] = 'Cron wtyczki programów';
$string['unlinkeditems'] = 'Niepowiązane elementy';
$string['updateprogram'] = 'Aktualizuj program';
$string['updateallocation'] = 'Aktualizuj przydział';
$string['updateallocations'] = 'Aktualizuj przydziały';
$string['updateset'] = 'Aktualizuj zestaw';
$string['updatescheduling'] = 'Aktualizuj planowanie';
$string['updatesource'] = 'Aktualizuj {$a}';
