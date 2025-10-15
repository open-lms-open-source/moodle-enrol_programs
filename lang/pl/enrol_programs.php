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
$string['archive'] = 'Archiwizuj';
$string['archived'] = 'Zarchiwizowane';
$string['benefitname'] = '{$a}: Przydział programu';
$string['calendarprogramend'] = '{$a} kończy się';
$string['calendarprogramdue'] = '{$a} jest wymagany';
$string['calendarprogramstart'] = '{$a} rozpoczyna się';
$string['catalogue'] = 'Katalog programów';
$string['catalogue_dofilter'] = 'Wyszukaj';
$string['catalogue_resetfilter'] = 'Wyczyść';
$string['catalogue_searchtext'] = 'Wyszukaj tekst';
$string['catalogue_tag'] = 'Filtruj według znacznika';
$string['certificatetemplatechoose'] = 'Wybierz szablon...';
$string['cohorts'] = 'Widoczne dla kohort';
$string['cohorts_help'] = 'Programy niepubliczne mogą być widoczne dla określonych członków kohorty.

Status widoczności nie ma wpływu na już przydzielone programy.';
$string['columnusedalready'] = 'Kolumna jest już użyta';
$string['completepercent'] = '{$a}% ukończono';
$string['completion'] = 'Ukończenie';
$string['completiondate'] = 'Data ukończenia';
$string['completiondelay'] = 'Opóźnienie ukończenia';
$string['completionoverride'] = 'Nadpisz ukończenie';
$string['creategroups'] = 'Grupy kursów';
$string['creategroups_help'] = 'Jeśli ta opcja zostanie włączona, w każdym kursie dodanym do programu zostanie utworzona grupa, a wszyscy przypisani do niej użytkownicy zostaną dodani jako członkowie grupy.';
$string['customfields'] = 'Pola niestandardowe programów';
$string['customfieldsettings'] = 'Wspólne ustawienia pól niestandardowych programów';
$string['customfieldvisibleto'] = 'Zawartość pól jest widoczna dla';
$string['customfieldvisible:allocated'] = 'Użytkowników przypisanych do programów';
$string['customfieldvisible:everyone'] = 'Każdego, kto może zobaczyć inne szczegóły programu';
$string['customfieldvisible:viewcapability'] = 'Użytkowników posiadających możliwość przeglądania programów';
$string['deleteallocation'] = 'Usuń przydział programu';
$string['deletecourse'] = 'Usuń kurs';
$string['deleteprogram'] = 'Usuń program';
$string['deleteset'] = 'Usuń zestaw';
$string['deletetraining'] = 'Usuń szkolenie';
$string['documentation'] = 'Programy do dokumentacji Moodle';
$string['duedate'] = 'Data zakończenia';
$string['enrolrole'] = 'Rola na kursie';
$string['enrolrole_desc'] = 'Wybierz rolę, która będzie używana przez programy do zapisów na kursy';
$string['errorcontentproblem'] = 'Wykryto problem w strukturze zawartości programu. Ukończenie programu nie będzie prawidłowo śledzone!';
$string['errorcoursemissing'] = 'Brakuje kursu';
$string['errorcoursesmissing'] = 'Brakujące kursy: {$a}';
$string['errorinvalidoverridedates'] = 'Nadpisanie nieprawidłowej daty';
$string['errordifferenttenant'] = 'Brak dostępu do programu innego klienta';
$string['errorduplicateprogramid'] = 'Identyfikator programu jest już wykorzystywany przez inny program. Użyj unikalnego identyfikatora programu.';
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
$string['evidencedate'] = 'Data ukończenia na świadectwie';
$string['evidenceupdate'] = 'Zaktualizuj inne świadectwa';
$string['evidenceupload'] = 'Prześlij świadectwa ukończenia';
$string['evidenceupload_csvfile'] = 'Plik CSV';
$string['evidenceupload_errors'] = 'Liczba wykrytych nieprawidłowych wierszy: {$a}';
$string['evidenceupload_skipped'] = 'Liczba pominiętych wierszy: {$a}';
$string['evidenceupload_updated'] = 'Zaktualizowano świadectwa ukończenia dla {$a} użytkowników';
$string['evidence_details'] = 'Szczegóły';
$string['evidence_detailsdefault'] = 'Szczegóły domyślne';
$string['export'] = 'Eksportuj programy';
$string['exportfile_info'] = 'informacje';
$string['exportfile_programs'] = 'programy';
$string['exportformat'] = 'Format pliku';
$string['exportformat_csv'] = 'CSV';
$string['exportformat_json'] = 'JSON';
$string['extra_menu_management_index'] = 'Akcje programów';
$string['extra_menu_management_program_general'] = 'Akcje programu';
$string['extra_menu_management_program_users'] = 'Akcje użytkowników';
$string['extra_menu_management_program_allocation'] = 'Akcje przydziału';
$string['fixeddate'] = 'W określonym terminie';
$string['idnumbersymbol'] = 'Identyfikator:';
$string['importallocationend'] = 'Koniec przydziału ({$a})';
$string['importallocationstart'] = 'Początek przydziału ({$a})';
$string['importprogramallocation'] = 'Importuj przydział programu';
$string['importprogramallocationconfirmation'] = 'Importujesz ustawienia przydziału z programu __{$a->fullname} / {$a->idnumber} / {$a->category}__.

Wybierz wszystkie ustawienia, które chcesz zaimportować.';
$string['importprogramcontent'] = 'Importuj zawartość programu';
$string['importprogramcontentconfirmation'] = 'Importujesz zawartość z programu __{$a->fullname} / {$a->idnumber} / {$a->category}__.';
$string['importprogramdue'] = 'Termin realizacji programu ({$a})';
$string['importprogramend'] = 'Zakończenie programu ({$a})';
$string['importprogramstart'] = 'Początek programu ({$a})';
$string['importselectprogram'] = 'Wybierz program';
$string['invalidallocationdates'] = 'Nieprawidłowe daty przydziału programu';
$string['invalidcompletiondate'] = 'Nieprawidłowa data zakończenia programu';
$string['item'] = 'Pozycja';
$string['itemcompletion'] = 'Ukończenie elementu programu';
$string['itempoints'] = 'Punkty';
$string['itemrecalculate'] = 'Ponowne obliczanie ukończenia elementu';
$string['layoutgrid'] = 'Układ siatki';
$string['layouttable'] = 'Układ tabeli';
$string['management'] = 'Zarządzanie programem';
$string['messageprovider:allocation_notification'] = 'Powiadomienie o przydziale do programu';
$string['messageprovider:approval_request_notification'] = 'Powiadomienie o żądaniu zatwierdzenia programu';
$string['messageprovider:approval_reject_notification'] = 'Powiadomienie o odrzuceniu żądania dostępu do programu';
$string['messageprovider:completion_notification'] = 'Powiadomienie o ukończeniu programu';
$string['messageprovider:completion_relateduser_notification'] = 'Powiadomienie o ukończeniu programu – powiązany użytkownik';
$string['messageprovider:deallocation_notification'] = 'Powiadomienie o wypisaniu z programu';
$string['messageprovider:duesoon_notification'] = 'Powiadomienie o zbliżającym się terminie programu';
$string['messageprovider:duesoon_relateduser_notification'] = 'Powiadomienie o zbliżającym się terminie programu – powiązany użytkownik';
$string['messageprovider:due_notification'] = 'Powiadomienie o zaległym programie';
$string['messageprovider:due_relateduser_notification'] = 'Powiadomienie o zaległym programie – powiązany użytkownik';
$string['messageprovider:endsoon_notification'] = 'Powiadomienie o zbliżającej się dacie zakończenia programu';
$string['messageprovider:endsoon_relateduser_notification'] = 'Powiadomienie o zbliżającej się dacie zakończenia programu – powiązany użytkownik';
$string['messageprovider:endcompleted_notification'] = 'Powiadomienie o zakończeniu ukończonego programu';
$string['messageprovider:endfailed_notification'] = 'Powiadomienie o zakończeniu nieukończonego programu';
$string['messageprovider:endfailed_relateduser_notification'] = 'Powiadomienie o zakończeniu nieukończonego programu – powiązany użytkownik';
$string['messageprovider:reset_notification'] = 'Powiadomienie o resecie programu';
$string['messageprovider:start_notification'] = 'Powiadomienie o rozpoczęciu programu';
$string['moveitem'] = 'Przenieś element';
$string['moveitemcancel'] = 'Anuluj przenoszenie';
$string['moveafter'] = 'Przenieś „{$a->item}” po „{$a->target}”';
$string['movebefore'] = 'Przenieś „{$a->item}” przed „{$a->target}”';
$string['moveinto'] = 'Przenieś „{$a->item}” do „{$a->target}”';
$string['myprograms'] = 'Moje programy';
$string['notification_allocation'] = 'Użytkownik przydzielony';
$string['notification_allocation_subject'] = 'Powiadomienie o przydziale do programu';
$string['notification_allocation_body'] = 'Witaj {$a->user_fullname}!

Przydzielono Cię do programu „{$a->program_fullname}”. Data rozpoczęcia to {$a->program_startdate}.
';
$string['notification_allocation_description'] = 'Powiadomienie wysyłane do użytkowników, gdy zostaną przydzieleni do programu.';
$string['notification_completion'] = 'Program ukończony';
$string['notification_completion_subject'] = 'Program ukończony';
$string['notification_completion_body'] = 'Witaj {$a->user_fullname}!

Masz już ukończony program „{$a->program_fullname}”.
';
$string['notification_completion_description'] = 'Powiadomienie wysyłane do użytkowników po ukończeniu programu.';
$string['notification_completion_relateduser'] = 'Program ukończony – powiązany użytkownik';
$string['notification_completion_relateduser_subject'] = 'Użytkownik {$a->user_fullname} ukończył program';
$string['notification_completion_relateduser_body'] = 'Cześć {$a->relateduser_fullname}!

Użytkownik {$a->user_fullname} ukończył program „{$a->program_fullname}”.
';
$string['notification_completion_relateduser_description'] = 'Powiadomienie wysyłane do użytkowników powiązanych z danym użytkownikiem, gdy ukończą oni swój program.';
$string['notification_deallocation'] = 'Użytkownik wypisany';
$string['notification_deallocation_subject'] = 'Powiadomienie o wypisaniu z programu';
$string['notification_deallocation_body'] = 'Witaj {$a->user_fullname}!

Wypisano Cię z programu „{$a->program_fullname}”.
';
$string['notification_deallocation_description'] = 'Powiadomienie wysyłane do użytkowników po wypisaniu ich z programu.';
$string['notification_duesoon'] = 'Zbliża się termin końcowy programu';
$string['notification_duesoon_subject'] = 'Ukończenie programu oczekiwane jest wkrótce';
$string['notification_duesoon_body'] = 'Witaj {$a->user_fullname}!

Ukończenie programu „{$a->program_fullname}” jest oczekiwane w dniu {$a->program_duedate}.
';
$string['notification_duesoon_description'] = 'Powiadomienie wysyłane do użytkowników przed datą ukończenia programu, chyba że ukończono już program.';
$string['notification_duesoon_relateduser'] = 'Powiadomienie o zbliżającym się terminie programu – powiązany użytkownik';
$string['notification_duesoon_relateduser_subject'] = 'Ukończenie programu oczekiwane jest wkrótce dla użytkownika {$a->user_fullname}';
$string['notification_duesoon_relateduser_body'] = 'Witaj {$a->relateduser_fullname}!

Ukończenie programu „{$a->program_fullname}” dla użytkownika {$a->user_fullname} jest oczekiwane w dniu {$a->program_duedate}.
';
$string['notification_duesoon_relateduser_description'] = 'Powiadomienie wysyłane do użytkowników powiązanych przed datą ukończenia programu, chyba że ukończono już program.';
$string['notification_due'] = 'Zaległy program';
$string['notification_due_subject'] = 'Oczekiwano ukończenia programu';
$string['notification_due_body'] = 'Witaj {$a->user_fullname}!

Ukończenie programu „{$a->program_fullname}” było oczekiwane przed dniem {$a->program_duedate}.
';
$string['notification_due_description'] = 'Powiadomienie wysyłane do użytkowników, gdy ukończenie programu jest opóźnione.';
$string['notification_due_relateduser'] = 'Zaległy program – powiązany użytkownik';
$string['notification_due_relateduser_subject'] = 'Ukończenie programu było oczekiwane dla użytkownika {$a->user_fullname}';
$string['notification_due_relateduser_body'] = 'Witaj {$a->relateduser_fullname}!

Ukończenie programu „{$a->program_fullname}” dla użytkownika {$a->user_fullname} było oczekiwane przed dniem {$a->program_duedate}.
';
$string['notification_due_relateduser_description'] = 'Powiadomienie wysyłane do użytkowników powiązanych z użytkownikiem, gdy ukończenie przez nich programu jest opóźnione.';
$string['notification_endsoon'] = 'Zbliża się data zakończenia programu';
$string['notification_endsoon_subject'] = 'Program wkrótce się zakończy';
$string['notification_endsoon_body'] = 'Witaj {$a->user_fullname}!

Program „{$a->program_fullname}” kończy się w dniu {$a->program_enddate}.
';
$string['notification_endsoon_description'] = 'Powiadomienie wysyłane do użytkowników przed datą ukończenia programu, chyba że ukończono już program.';
$string['notification_endsoon_relateduser'] = 'Zbliżająca się dat ukończenia programu – powiązany użytkownik';
$string['notification_endsoon_relateduser_subject'] = 'Program kończy się wkrótce dla użytkownika {$a->user_fullname}';
$string['notification_endsoon_relateduser_body'] = 'Witaj {$a->relateduser_fullname}!

Program „{$a->program_fullname}” dla użytkownika {$a->user_fullname} kończy się w dniu {$a->program_enddate}.
';
$string['notification_endsoon_relateduser_description'] = 'Powiadomienie wysyłane do użytkowników powiązanych z użytkownikiem przed datą ukończenia programu, chyba że ukończono już program.';
$string['notification_endcompleted'] = 'Ukończony program został zakończony';
$string['notification_endcompleted_subject'] = 'Ukończony program został zakończony';
$string['notification_endcompleted_body'] = 'Witaj {$a->user_fullname}!

Program „{$a->program_fullname}” zakończył się. Udało Ci się go ukończyć wcześniej.
';
$string['notification_endcompleted_description'] = 'Powiadomienie wysyłane do użytkowników, kiedy ukończony przez nich program zakończy się.';
$string['notification_endfailed'] = 'Nieukończony program został zakończony';
$string['notification_endfailed_subject'] = 'Nieukończony program został zakończony';
$string['notification_endfailed_body'] = 'Witaj {$a->user_fullname}!

Program „{$a->program_fullname}” zakończył się. Nie udało Ci się go ukończyć.
';
$string['notification_endfailed_description'] = 'Powiadomienie wysyłane do użytkowników po zakończeniu programu, którego nie udało im się ukończyć.';
$string['notification_endfailed_relateduser'] = 'Zakończenie nieukończonego programu – powiązany użytkownik';
$string['notification_endfailed_relateduser_subject'] = 'Nieukończony program zakończył się dla użytkownika {$a->user_fullname}';
$string['notification_endfailed_relateduser_body'] = 'Witaj {$a->relateduser_fullname}!

Program „{$a->program_fullname}” zakończył się, a użytkownikowi {$a->user_fullname} nie udało się go ukończyć.
';
$string['notification_endfailed_relateduser_description'] = 'Powiadomienie wysyłane do użytkowników powiązanych z użytkownikiem po zakończeniu programu, którego nie udało im się ukończyć.';
$string['notification_relateduserfield'] = 'Pole użytkownika powiązanego z powiadomieniem';
$string['notification_relateduserfield_desc'] = 'Wybierz pole profilu powiązanych użytkowników, które będzie używane do powiadamiania powiązanych użytkowników.';
$string['notification_reset'] = 'Resetowanie postępu użytkownika';
$string['notification_reset_subject'] = 'Powiadomienie o resecie programu';
$string['notification_reset_body'] = 'Witaj {$a->user_fullname}!

Twój postęp w programie „{$a->program_fullname}” został zresetowany.
';
$string['notification_reset_description'] = 'Powiadomienie wysyłane do użytkowników po zresetowaniu postępu w programie programu.';
$string['notification_start'] = 'Program rozpoczął się';
$string['notification_start_subject'] = 'Program rozpoczął się';
$string['notification_start_body'] = 'Witaj {$a->user_fullname}!

Program „{$a->program_fullname}” już się rozpoczął.
';
$string['notification_start_description'] = 'Powiadomienie wysyłane do użytkowników po rozpoczęciu programu.';
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

$string['privacy:metadata:table:enrol_programs_src_commholds'] = 'Rezerwacje przydziału komercyjnego';
$string['privacy:metadata:field:quantity'] = 'Ilość';

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
$string['programcompletionoverride'] = 'Zastąp ukończenie programu';
$string['programidnumber'] = 'Numer identyfikacyjny programu';
$string['programimage'] = 'Obraz programu';
$string['programname'] = 'Nazwa programu';
$string['programurl'] = 'Adres URL programu';
$string['programs'] = 'Programy';
$string['programsactive'] = 'Aktywn.';
$string['programsarchived'] = 'Zarchiwizow.';
$string['programsarchived_help'] = 'Programy zarchiwizowane są ukryte przed użytkownikami, a ich postęp jest zablokowany.';
$string['programslayout'] = 'Szczegółowy układ strony programów';
$string['programslayout_desc'] = 'Kontroluje układ programów – widok tabelaryczny lub siatkowy strony „moje programy”.';
$string['programslayoutallowuserswitch'] = 'Zezwalaj użytkownikom na przełączanie układu programów';
$string['programslayoutallowuserswitch_desc'] = 'Zezwalaj użytkownikom na przełączanie układu programów';
$string['programslayout_desc'] = 'Kontroluje układ programów – widok tabelaryczny lub siatkowy strony „moje programy”.';
$string['programsblocklayout'] = 'Układ bloku Moje programy';
$string['programsblocklayout_desc'] = 'Kontroluje układ programów – widok tabelaryczny lub siatkowy dla bloku „moje programy”.';

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
$string['programs:addtocertifications'] = 'Dodaj program do certyfikacji';
$string['programs:addtoplan'] = 'Dodaj program do planów';
$string['programs:allocate'] = 'Przydziel uczniów do programów';
$string['programs:archive'] = 'Archiwizuj przydziały programu';
$string['programs:clone'] = 'Zezwalaj na klonowanie zawartości i ustawień programu';
$string['programs:configframeworks'] = 'Skonfiguruj dostępność programu w ramach planu';
$string['programs:configurecustomfields'] = 'Skonfiguruj pola niestandardowe programu';
$string['programs:delete'] = 'Usuń programy';
$string['programs:edit'] = 'Dodaj i zaktualizuj programy';
$string['programs:export'] = 'Eksportuj programy';
$string['programs:admin'] = 'Zaawansowana administracja programem';
$string['programs:manageallocation'] = 'Zarządzaj przydziałami użytkowników';
$string['programs:manageevidence'] = 'Zarządzaj innymi świadectwami ukończenia';
$string['programs:reset'] = 'Resetuj postęp programu';
$string['programs:upload'] = 'Prześlij programy';
$string['programs:view'] = 'Wyświetl zarządzanie programem';
$string['programs:viewcatalogue'] = 'Otwórz katalog programów';
$string['public'] = 'Publiczne';
$string['public_help'] = 'Programy publiczne są widoczne dla wszystkich użytkowników.

Status widoczności nie ma wpływu na już przydzielone programy.';
$string['purchaseaccess'] = 'Kup dostęp';
$string['resetallocation'] = 'Resetuj postęp programu';
$string['resettype'] = 'Resetuj typ';
$string['resettype_deallocate'] = 'Tylko wypisanie z programu';
$string['resettype_full'] = 'Pełne czyszczenie kursu';
$string['resettype_none'] = 'Brak';
$string['resettype_standard'] = 'Standardowe czyszczenie kursu';
$string['sequencetype'] = 'Typ ukończenia';
$string['sequencetype_allinorder'] = 'Wszystkie w kolejności';
$string['sequencetype_allinanyorder'] = 'Wszystkie w dowolnej kolejności';
$string['sequencetype_atleast'] = 'Co najmniej {$a->min}';
$string['sequencetype_minpoints'] = 'Minimum {$a->minpoints} punktów';
$string['selectcategory'] = 'Wybierz kategorię';
$string['sortbyprogramname'] = 'Sortuj wg nazwy programu';
$string['sortbyprogramid'] = 'Sortuj wg identyfikatora programu';
$string['sortbyprogramstart'] = 'Sortuj wg daty rozpoczęcia programu';
$string['sortbyprogramdue'] = 'Sortuj wg terminu realizacji programu';
$string['sortbyprogramend'] = 'Sortuj wg daty zakończenia programu';
$string['source'] = 'Źródło';
$string['source_approval'] = 'Wnioski z akceptacją';
$string['source_approval_allownew'] = 'Zezwalaj na akceptację';
$string['source_approval_allownew_desc'] = 'Zezwól na dodawanie do programów nowych źródeł _requests with approval_';
$string['source_approval_allowrequest'] = 'Zezwalaj na nowe wnioski';
$string['source_approval_confirm'] = 'Potwierdź zamiar wystąpienia z wnioskiem o przydział do programu.';
$string['source_approval_daterequested'] = 'Data żądania';
$string['source_approval_daterejected'] = 'Data odrzucenia';
$string['source_approval_makerequest'] = 'Zawnioskuj o dostępu';
$string['source_approval_notification_approval_request_subject'] = 'Powiadomienie o żądaniu dostępu do programu';
$string['source_approval_notification_approval_request_body'] = '
Użytkownik {$a->user_fullname} zażądał dostępu do programu „{$a->program_fullname}”.
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
$string['source_certify'] = 'Certyfikacje';
$string['source_certify_allownew'] = 'Zezwól na przydzielanie certyfikatów';
$string['source_certify_allownew_desc'] = 'Zezwól na dodawanie do programów nowych źródeł _certification_';
$string['source_cohort'] = 'Automatyczne przydzielanie kohort';
$string['source_cohort_allownew'] = 'Zezwól na przydzielanie kohort';
$string['source_cohort_allownew_desc'] = 'Zezwól na dodawanie do programów nowych źródeł _cohort auto allocation_';
$string['source_cohort_cohortstoallocate'] = 'Przydziel kohorty';
$string['source_ecommerce'] = 'Przydział e-commerce';
$string['source_ecommerce_allownew'] = 'Zezwól na przydział e-commerce';
$string['source_ecommerce_allownew_desc'] = 'Zezwól na dodawanie nowych źródeł automatycznego przydziału e-commerce do programów';
$string['source_ecommerce_allowsignup'] = 'Zezwól na nowe przydziały';
$string['source_ecommerce_cohortmembershiprequirement'] = 'Użytkownicy muszą być członkami jednej z następujących kohort: {$a}';
$string['source_ecommerce_maxusers'] = 'Maksymalna liczba użytkowników';
$string['source_ecommerce_nocapacity'] = 'W tym programie nie ma już wolnych miejsc';
$string['source_manual'] = 'Ręczny przydział';
$string['source_manual_allocateusers'] = 'Przydziel użytkowników';
$string['source_manual_csvfile'] = 'Plik CSV';
$string['source_manual_hasheaders'] = 'Pierwszy wiersz to nagłówek';
$string['source_manual_potusersmatching'] = 'Dopasowani kandydaci do przydziału';
$string['source_manual_potusers'] = 'Kandydaci do przydziału';
$string['source_manual_result_assigned'] = 'Do programu przypisano {$a} użytkowników.';
$string['source_manual_result_errors'] = 'Podczas przypisywania programów wykryto {$a} błędy/błędów.';
$string['source_manual_result_skipped'] = 'Do programu przypisano już {$a} użytkowników.';
$string['source_manual_timeduecolumn'] = 'Kolumna czasu realizacji';
$string['source_manual_timeendcolumn'] = 'Kolumna czasu zakończenia';
$string['source_manual_timestartcolumn'] = 'Kolumna czasu rozpoczęcia';
$string['source_manual_uploadusers'] = 'Prześlij przydziały';
$string['source_manual_usercolumn'] = 'Kolumna identyfikacji użytkownika';
$string['source_manual_usermapping'] = 'Mapowanie użytkownika poprzez';
$string['source_manual_userupload_allocated'] = 'Przydzielono do \'{$a}\'';
$string['source_manual_userupload_alreadyallocated'] = 'Przydzielono już do \'{$a}\'';
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
$string['source_selfallocation_signupallowed'] = 'Rejestracja jest dozwolona';
$string['source_selfallocation_signupnotallowed'] = 'Rejestracja nie jest dozwolona';
$string['source_udplans'] = 'Plany rozwojowe użytkownika';
$string['source_udplans_allownew'] = 'Plany rozwojowe użytkownika';
$string['source_udplans_allownew_desc'] = 'Zezwól na dodawanie do programów nowych źródeł _user development plans_';
$string['source_udplans_allowed'] = 'Uprawnienie';
$string['source_udplans_noframeworks'] = 'Nie można dodać do żadnych planów';
$string['source_udplans_notallowed'] = 'Niedozwolone';
$string['source_udplans_requirecap'] = 'Wymagane dodanie możliwości';
$string['set'] = 'Zestaw kursu';
$string['settings'] = 'Ustawienia programu';
$string['scheduling'] = 'Planowanie';
$string['taballocation'] = 'Ustawienia przydziału prac';
$string['tabcontent'] = 'Treść';
$string['tabgeneral'] = 'Główna';
$string['tabusers'] = 'Użytkownicy';
$string['tabvisibility'] = 'Ustawienia widoczności';
$string['tagarea_enrol_programs_programs'] = 'Programy';
$string['taskcertificate'] = 'Cron wystawiający certyfikaty programów';
$string['taskcron'] = 'Cron wtyczki programów';
$string['training'] = 'Szkolenie';
$string['trainingcompletion'] = 'Wymagane szkolenie: {$a}';
$string['trainingprogress'] = 'Postęp szkolenia: {$a->current}/{$a->total}';
$string['unarchive'] = 'Przywróć';
$string['unlinkeditems'] = 'Niepowiązane elementy';
$string['updateprogram'] = 'Aktualizuj program';
$string['updateallocation'] = 'Aktualizuj przydział';
$string['updateallocations'] = 'Aktualizuj przydziały';
$string['updatecourse'] = 'Aktualizuj kurs';
$string['updateset'] = 'Aktualizuj zestaw';
$string['updatescheduling'] = 'Aktualizuj planowanie';
$string['updatesource'] = 'Aktualizuj {$a}';
$string['updatetraining'] = 'Aktualizuj szkolenie';
$string['upload'] = 'Prześlij programy';
$string['upload_invalidcount'] = 'Nieprawidłowe rekordy';
$string['upload_files'] = 'Pliki';
$string['upload_files_error'] = 'Oczekuje się wielu plików CSV, jednego pliku JSON lub jednego archiwum Zip';
$string['upload_preview'] = 'Podgląd danych';
$string['upload_status'] = 'Status';
$string['upload_status_invalid'] = 'Nieprawidłowy';
$string['upload_targetcontext'] = 'Dodaj programy do kontekstu';
$string['upload_uploadcount'] = 'Programy do przesłania';
$string['upload_usecategory'] = 'Użyj kolumny kategorii dla kontekstów';
$string['userupload_completion_error'] = 'Nie można zaktualizować ukończenia programu';
$string['userupload_completion_updated'] = 'Zaktualizowano ukończenie programu';

$string['rb_allocatedprograms'] = 'Przypisane programy';
$string['rb_complete'] = 'Ukończono';
$string['rb_completiondate'] = 'Data ukończenia';
$string['rb_completionstatus'] = 'Status ukończenia';
$string['rb_datecompleted'] = 'Data ukończenia';
$string['rb_dateallocated'] = 'Data przypisania';
$string['rb_datestarted'] = 'Data rozpoczęcia';
$string['rb_coursesall'] = 'Kursy – wszystkie';
$string['rb_incomplete'] = 'Nieukończone';
$string['rb_isallocated'] = 'Jest przypisany';
$string['rb_iscomplete'] = 'Jest ukończony?';
$string['rb_iscompleteany'] = 'Jest ukończony? (dowolna metoda)';
$string['rb_isinprogress'] = 'Jest w toku?';
$string['rb_isnotcomplete'] = 'Jest nieukończony?';
$string['rb_isnotyetstarted'] = 'Jeszcze się nie rozpoczął?';
$string['rb_notstarted'] = 'Nierozpoczęty';
$string['rb_officewhencompletedbasic'] = 'Biuro po ukończeniu (podstawowe)';
$string['rb_privacy:metadata'] = 'Wtyczka nie przechowuje żadnych danych osobowych.';
$string['rb_programcategory'] = 'Kategoria programu (lub ośrodek)';
$string['rb_programcategoryid'] = 'ID kategorii programu (nd. jeśli ośrodek)';
$string['rb_programcategoryidnumber'] = 'Numer ID kategorii programu (nd. jeśli ośrodek)';
$string['rb_programcategorymultichoice'] = 'Kategoria programu (wybór wielokrotny)';
$string['rb_programedatecreated'] = 'Data utworzenia programu';
$string['rb_programduedate'] = 'Termin realizacji programu';
$string['rb_programenddate'] = 'Data zakończenia przydziału programu';
$string['rb_programallocationtype'] = 'Typ przydziału';
$string['rb_programallocationtypes'] = 'Typy przydziału';
$string['rb_programexpandlink'] = 'Nazwa programu (rozwinięcie szczegółów)';
$string['rb_programid'] = 'Identyfikator programu';
$string['rb_programidnumber'] = 'Numer identyfikatora programu';
$string['rb_programname'] = 'Nazwa programu';
$string['rb_programnameandsummary'] = 'Nazwa i opis programu';
$string['rb_programnamelinked'] = 'Nazwa programu (powiązana ze stroną kursu)';
$string['rb_programmultiitem'] = 'Program (wieloelementowy)';
$string['rb_programsingleitem'] = 'Program';
$string['rb_programstartdate'] = 'Data rozpoczęcia przydziału programu';
$string['rb_programsummary'] = 'Opis programu';
$string['rb_programvisible'] = 'Program jest publiczny';
$string['rb_programvisibledisabled'] = 'Program widoczny (nie dotyczy)';
$string['rb_progress'] = 'Postęp';
$string['rb_progressnumeric'] = 'Postęp (liczbowy)';
$string['rb_progresspercent'] = 'Postęp (% ukończenia)';
$string['rb_source_allocation'] = 'Przydziały programów';
$string['rb_timetocompletesinceenrol'] = 'Czas do ukończenia (od daty przydziału)';
$string['rb_timetocompletesincestart'] = 'Czas do ukończenia (od daty rozpoczęcia)';
$string['rb_type_program'] = 'Program';
$string['rb_type_program_category'] = 'Kategoria';
$string['rb_type_program_completion'] = 'Przydział programu';
$string['rb_type_program_customfields'] = 'Pola niestandardowe programu';
$string['rb_user'] = 'Użytkownik';
$string['rb_viewprogram'] = 'Wyświetl program';
$string['rb_visiblecohorts'] = 'Kohorty z widocznością';
