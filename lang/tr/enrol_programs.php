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

$string['addprogram'] = 'Program ekle';
$string['addset'] = 'Yeni küme ekle';
$string['allocationend'] = 'Atama sonu';
$string['allocationend_help'] = 'Atama sonu tarihi, etkinleştirilmiş atama kaynaklarına bağlıdır. Belirtilmişse genellikle bu tarihten sonra yeni atama yapılamaz.';
$string['allocation'] = 'Atama';
$string['allocations'] = 'Atamalar';
$string['programallocations'] = 'Program Atamaları';
$string['allocationdate'] = 'Atama tarihi';
$string['allocationsources'] = 'Atama kaynakları';
$string['allocationstart'] = 'Atama başlangıcı';
$string['allocationstart_help'] = 'Atama başlangıcı tarihi, etkinleştirilmiş atama kaynaklarına bağlıdır. Belirtilmişse genellikle yeni atamalar sadece bu tarihten sonra yapılabilir.';
$string['allprograms'] = 'Tüm programlar';
$string['appenditem'] = 'Öğe ekle';
$string['appendinto'] = 'Öğeye ekle';
$string['archive'] = 'Arşivle';
$string['archived'] = 'Arşivlenmiş';
$string['benefitname'] = '{$a}: Program ataması';
$string['calendarprogramend'] = '{$a} bitişi';
$string['calendarprogramdue'] = '{$a} için son tarih';
$string['calendarprogramstart'] = '{$a} başlangıcı';
$string['catalogue'] = 'Program kataloğu';
$string['catalogue_dofilter'] = 'Ara';
$string['catalogue_resetfilter'] = 'Temizle';
$string['catalogue_searchtext'] = 'Metin ara';
$string['catalogue_tag'] = 'Etikete göre filtrele';
$string['certificatetemplatechoose'] = 'Bir şablon seç...';
$string['cohorts'] = 'Kurs kümelerine görünür';
$string['cohorts_help'] = 'Herkese açık olmayan programlar, belirtilen kurs kümesi üyelerine görünür hale getirilebilir.

Görünürlük durumu zaten atanmış programları etkilemez.';
$string['columnusedalready'] = 'Sütun zaten kullanılıyor';
$string['completepercent'] = '%{$a} tamamlandı';
$string['completion'] = 'Tamamlama';
$string['completiondate'] = 'Tamamlanma tarihi';
$string['completiondelay'] = 'Tamamlama gecikmesi';
$string['completionoverride'] = 'Tamamlamayı geçersiz kıl';
$string['creategroups'] = 'Kurs grupları';
$string['creategroups_help'] = 'Etkinleştirilmesi halinde programa eklenen her kursta bir grup oluşturulur ve atanan tüm kullanıcılar grup üyesi olarak eklenir.';
$string['customfields'] = 'Programlar özel alanları';
$string['customfieldsettings'] = 'Ortak programlar özel alanları ayarları';
$string['customfieldvisibleto'] = 'Alan içeriği şunlar tarafından görülebilir:';
$string['customfieldvisible:allocated'] = 'Programlara atanan kullanıcılar';
$string['customfieldvisible:everyone'] = 'Diğer program ayrıntılarını görüntüleyebilen herkes';
$string['customfieldvisible:viewcapability'] = 'Programları görüntüleme özelliğine sahip kullanıcılar';
$string['deleteallocation'] = 'Program atamalarını sil';
$string['deletecourse'] = 'Kursu kaldır';
$string['deleteprogram'] = 'Programı sil';
$string['deleteset'] = 'Kümeyi sil';
$string['deletetraining'] = 'Eğitimi kaldır';
$string['documentation'] = 'Moodle belgelerine yönelik programlar';
$string['duedate'] = 'Son tarih';
$string['enrolrole'] = 'Kurs rolü';
$string['enrolrole_desc'] = 'Kurs kaydı için programlar tarafından kullanılacak rolü seçin';
$string['errorcontentproblem'] = 'Program içerik yapısında sorun algılandı, program tamamlama doğru şekilde izlenmeyecek!';
$string['errorcoursemissing'] = 'Kurs eksik';
$string['errorcoursesmissing'] = 'Eksik kurslar: {$a}';
$string['errorinvalidoverridedates'] = 'Geçersiz tarih iptalleri';
$string['errordifferenttenant'] = 'Başka bir kiracıdaki programa erişilemiyor';
$string['errorduplicateprogramid'] = 'Program kimlik numarası zaten başka bir program için kullanılıyor; lütfen benzersiz bir program kimlik numarası kullanın.';
$string['errornoallocations'] = 'Kullanıcı ataması bulunamadı';
$string['errornoallocation'] = 'Program atanmadı';
$string['errornomyprograms'] = 'Hiçbir bir programa atanmadınız.';
$string['errornoprograms'] = 'Program bulunamadı.';
$string['errornorequests'] = 'Hiçbir program isteği bulunamadı';
$string['errornotenabled'] = 'Program eklentisi etkin değil';
$string['event_program_completed'] = 'Program tamamlandı';
$string['event_program_created'] = 'Program oluşturuldu';
$string['event_program_deleted'] = 'Program silindi';
$string['event_program_updated'] = 'Program güncelleştirildi';
$string['event_program_viewed'] = 'Program görüntülendi';
$string['event_user_allocated'] = 'Kullanıcı programa atandı';
$string['event_user_deallocated'] = 'Kullanıcının program ataması kaldırıldı';
$string['evidence'] = 'Diğer kanıt';
$string['evidencedate'] = 'Kanıt tamamlama tarihi';
$string['evidenceupdate'] = 'Diğer kanıtı güncelleştir';
$string['evidenceupload'] = 'Tamamlama kanıtlarını karşıya yükle';
$string['evidenceupload_csvfile'] = 'CSV dosyası';
$string['evidenceupload_errors'] = '{$a} geçersiz satır algılandı';
$string['evidenceupload_skipped'] = '{$a} satır atlandı';
$string['evidenceupload_updated'] = '{$a} kullanıcıları için tamamlama kanıtı güncelleştirildi';
$string['evidence_details'] = 'Ayrıntılar';
$string['evidence_detailsdefault'] = 'Varsayılan ayrıntılar';
$string['export'] = 'Programları dışa aktar';
$string['exportfile_info'] = 'bilgi';
$string['exportfile_programs'] = 'programlar';
$string['exportformat'] = 'Dosya biçimi';
$string['exportformat_csv'] = 'CSV';
$string['exportformat_json'] = 'JSON';
$string['extra_menu_management_index'] = 'Programlar eylemleri';
$string['extra_menu_management_program_general'] = 'Program eylemleri';
$string['extra_menu_management_program_users'] = 'Kullanıcılar eylemleri';
$string['extra_menu_management_program_allocation'] = 'Atama eylemleri';
$string['fixeddate'] = 'Sabit tarihte';
$string['idnumbersymbol'] = 'Kimlik no.';
$string['importallocationend'] = 'Atama sonu ({$a})';
$string['importallocationstart'] = 'Atama başlangıcı ({$a})';
$string['importprogramallocation'] = 'Program atamasını içe aktar';
$string['importprogramallocationconfirmation'] = 'Atama ayarlarını __{$a->fullname} / {$a->idnumber} / {$a->category}__ programından içe aktarıyorsunuz.

Lütfen içe aktarmak istediğiniz tüm ayarları seçin.';
$string['importprogramcontent'] = 'Program içeriğini içe aktar';
$string['importprogramcontentconfirmation'] = 'İçeriği __{$a->fullname} / {$a->idnumber} / {$a->category}__ programından içe aktarıyorsunuz.';
$string['importprogramdue'] = 'Program süresi geçme tarihi ({$a})';
$string['importprogramend'] = 'Program bitiş tarihi ({$a})';
$string['importprogramstart'] = 'Program başlangıç tarihi ({$a})';
$string['importselectprogram'] = 'Program seç';
$string['invalidallocationdates'] = 'Geçersiz program atama tarihleri';
$string['invalidcompletiondate'] = 'Geçersiz program tamamlama tarihi';
$string['item'] = 'Öğe';
$string['itemcompletion'] = 'Program öğesi tamamlama';
$string['itempoints'] = 'Puanlar';
$string['itemrecalculate'] = 'Öğe tamamlamasını yeniden hesapla';
$string['layoutgrid'] = 'Izgara düzeni';
$string['layouttable'] = 'Tablo düzeni';
$string['management'] = 'Program yönetimi';
$string['messageprovider:allocation_notification'] = 'Program atama bildirimi';
$string['messageprovider:approval_request_notification'] = 'Program onay isteği bildirimi';
$string['messageprovider:approval_reject_notification'] = 'Program isteği reddi bildirimi';
$string['messageprovider:completion_notification'] = 'Program tamamlama bildirimi';
$string['messageprovider:completion_relateduser_notification'] = 'Program tamamlandı bildirimi - ilgili kullanıcı';
$string['messageprovider:deallocation_notification'] = 'Program ataması kaldırma bildirimi';
$string['messageprovider:duesoon_notification'] = 'Program sonu tarihi yakın bildirimi';
$string['messageprovider:duesoon_relateduser_notification'] = 'Program sonu tarihi yakın bildirimi - ilgili kullanıcı';
$string['messageprovider:due_notification'] = 'Program süresi geçti bildirimi';
$string['messageprovider:due_relateduser_notification'] = 'Program süresi geçti bildirimi - ilgili kullanıcı';
$string['messageprovider:endsoon_notification'] = 'Program bitiş tarihi bildirimi';
$string['messageprovider:endsoon_relateduser_notification'] = 'Program bitiş tarihi yakın bildirimi - ilgili kullanıcı';
$string['messageprovider:endcompleted_notification'] = 'Tamamlanan program sona erdi bildirimi';
$string['messageprovider:endfailed_notification'] = 'Başarısız program sona erdi bildirimi';
$string['messageprovider:endfailed_relateduser_notification'] = 'Başarısız program sona erdi bildirimi - ilgili kullanıcı';
$string['messageprovider:reset_notification'] = 'Program sıfırlama bildirimi';
$string['messageprovider:start_notification'] = 'Program başlatıldı bildirimi';
$string['moveitem'] = 'Öğeyi taşı';
$string['moveitemcancel'] = 'Taşımayı iptal et';
$string['moveafter'] = '"{$a->item}" öğesini "{$a->target}" sonrasına taşı';
$string['movebefore'] = '“{$a->item}" öğesini "{$a->target}" öncesine taşı';
$string['moveinto'] = '"{$a->item}" öğesini "{$a->target}" içine taşı';
$string['myprograms'] = 'Programlarım';
$string['notification_allocation'] = 'Kullanıcı atandı';
$string['notification_allocation_subject'] = 'Program atama bildirimi';
$string['notification_allocation_body'] = 'Merhaba {$a->user_fullname},

"{$a->program_fullname}" programına atandınız, başlangıç tarihi: {$a->program_startdate}.
';
$string['notification_allocation_description'] = 'Programa atandıklarında kullanıcılara bildirim gönderilir.';
$string['notification_completion'] = 'Program tamamlandı';
$string['notification_completion_subject'] = 'Program tamamlandı';
$string['notification_completion_body'] = 'Merhaba {$a->user_fullname},

"{$a->program_fullname}" programını tamamladınız.
';
$string['notification_completion_description'] = 'Programlarını tamamladıklarında kullanıcılara bildirim gönderilir.';
$string['notification_completion_relateduser'] = 'Program tamamlandı - ilgili kullanıcı';
$string['notification_completion_relateduser_subject'] = '{$a->user_fullname} kullanıcısı programı tamamladı';
$string['notification_completion_relateduser_body'] = 'Merhaba {$a->relateduser_fullname},

{$a->user_fullname} kullanıcısı "{$a->program_fullname}" programını tamamladı.
';
$string['notification_completion_relateduser_description'] = 'Programlarını tamamladıklarında ilgili kullanıcılara bildirim gönderilir.';
$string['notification_deallocation'] = 'Kullanıcının ataması kaldırıldı';
$string['notification_deallocation_subject'] = 'Program ataması kaldırma bildirimi';
$string['notification_deallocation_body'] = 'Merhaba {$a->user_fullname},

"{$a->program_fullname}" programından atamanız kaldırıldı.
';
$string['notification_deallocation_description'] = 'Programdan atamaları kaldırıldığında kullanıcılara bildirim gönderilir.';
$string['notification_duesoon'] = 'Program sonu tarihi yakın';
$string['notification_duesoon_subject'] = 'Programın yakında tamamlanması bekleniyor';
$string['notification_duesoon_body'] = 'Merhaba {$a->user_fullname},

"{$a->program_fullname}" programının {$a->program_duedate} tarihinden önce tamamlanması gerekiyor.
';
$string['notification_duesoon_description'] = 'Program tamamlanmadan önce program tamamlama tarihinin ötesinde olan kullanıcılara bildirim gönderilir.';
$string['notification_duesoon_relateduser'] = 'Program sonu tarihi yakın - ilgili kullanıcı';
$string['notification_duesoon_relateduser_subject'] = 'Programın {$a->user_fullname} kullanıcısı için yakında tamamlanması bekleniyor';
$string['notification_duesoon_relateduser_body'] = 'Merhaba {$a->relateduser_fullname},

"{$a->program_fullname}" programının {$a->user_fullname} kullanıcısı için {$a->program_duedate} tarihinden önce tamamlanması gerekiyordu.
';
$string['notification_duesoon_relateduser_description'] = 'Program tamamlanmadan önce program tamamlama tarihinin ötesinde olan ilgili kullanıcılara bildirim gönderilir.';
$string['notification_due'] = 'Program süresi geçti';
$string['notification_due_subject'] = 'Programın tamamlanması gerekiyordu';
$string['notification_due_body'] = 'Merhaba {$a->user_fullname},

"{$a->program_fullname}" programının {$a->program_duedate} tarihinden önce tamamlanması gerekiyordu.
';
$string['notification_due_description'] = 'Program tamamlama süresi geçtiğinde kullanıcılara bildirim gönderilir.';
$string['notification_due_relateduser'] = 'Program süresi geçti - ilgili kullanıcı';
$string['notification_due_relateduser_subject'] = 'Programın {$a->user_fullname} kullanıcısı için tamamlanması gerekiyordu';
$string['notification_due_relateduser_body'] = 'Merhaba {$a->relateduser_fullname},

"{$a->program_fullname}" programının {$a->user_fullname} kullanıcısı için {$a->program_duedate} tarihinden önce tamamlanması gerekiyordu.
';
$string['notification_due_relateduser_description'] = 'Program tamamlama süresi geçtiğinde ilgili kullanıcılara bildirim gönderilir.';
$string['notification_endsoon'] = 'Program bitiş tarihi yaklaşıyor';
$string['notification_endsoon_subject'] = 'Program yakında bitiyor';
$string['notification_endsoon_body'] = 'Merhaba {$a->user_fullname},

"{$a->program_fullname}" programı {$a->program_enddate} tarihinde sona eriyor.
';
$string['notification_endsoon_description'] = 'Program tamamlanmadan önce program bitiş tarihinin ötesinde olan kullanıcılara bildirim gönderilir.';
$string['notification_endsoon_relateduser'] = 'Program bitiş tarihi yakın - ilgili kullanıcı';
$string['notification_endsoon_relateduser_subject'] = '{$a->user_fullname} kullanıcısı için program yakında bitiyor';
$string['notification_endsoon_relateduser_body'] = 'Merhaba {$a->relateduser_fullname},

"{$a->program_fullname}" programı {$a->user_fullname} kullanıcısı için {$a->program_enddate} tarihinde sona eriyor.
';
$string['notification_endsoon_relateduser_description'] = 'Program tamamlanmadan önce program bitiş tarihinin ötesinde olan ilgili kullanıcılara bildirim gönderilir.';
$string['notification_endcompleted'] = 'Tamamlanan program sona erdi';
$string['notification_endcompleted_subject'] = 'Tamamlanan program sona erdi';
$string['notification_endcompleted_body'] = 'Merhaba {$a->user_fullname},

"{$a->program_fullname}" programı sona erdi, programı daha önce tamamladınız.
';
$string['notification_endcompleted_description'] = 'Tamamlanan programları sona erdiğinde kullanıcılara bildirim gönderilir.';
$string['notification_endfailed'] = 'Başarısız program sona erdi';
$string['notification_endfailed_subject'] = 'Başarısız program sona erdi';
$string['notification_endfailed_body'] = 'Merhaba {$a->user_fullname},

"{$a->program_fullname}" programı sona erdi, programı tamamlayamadınız.
';
$string['notification_endfailed_description'] = 'Tamamlayamadıkları program sona erdiğinde kullanıcılara bildirim gönderilir.';
$string['notification_endfailed_relateduser'] = 'Tamamlanamayan program sona erdi - ilgili kullanıcı';
$string['notification_endfailed_relateduser_subject'] = '{$a->user_fullname} kullanıcısı için tamamlanamayan program sona erdi';
$string['notification_endfailed_relateduser_body'] = 'Merhaba {$a->relateduser_fullname},

"{$a->program_fullname}" programı sona erdi ve {$a->user_fullname} kullanıcısı programı tamamlayamadı.
';
$string['notification_endfailed_relateduser_description'] = 'Tamamlayamadıkları program sona erdiğinde ilgili kullanıcılara bildirim gönderilir.';
$string['notification_relateduserfield'] = 'İlgili kullanıcı bildirimi alanı';
$string['notification_relateduserfield_desc'] = 'İlgili kullanıcıların bildirimi için kullanılacak ilgili kullanıcı profili alanını seçin.';
$string['notification_reset'] = 'Kullanıcı ilerleme durumu sıfırlaması';
$string['notification_reset_subject'] = 'Program sıfırlama bildirimi';
$string['notification_reset_body'] = 'Merhaba {$a->user_fullname},

"{$a->program_fullname}" programınızdaki ilerleme durumunuz sıfırlandı.
';
$string['notification_reset_description'] = 'Program ilerleme durumları sıfırlandığında kullanıcılara bildirim gönderilir.';
$string['notification_start'] = 'Program başladı';
$string['notification_start_subject'] = 'Program başladı';
$string['notification_start_body'] = 'Merhaba {$a->user_fullname},

"{$a->program_fullname}" programı başladı.
';
$string['notification_start_description'] = 'Programları başladığında kullanıcılara bildirim gönderilir.';
$string['notificationdates'] = 'Bildirim tarihleri';
$string['notset'] = 'Belirlenmedi';
$string['plugindisabled'] = 'Programa kayıt eklentisi devre dışı; programlar çalışmayacak.

[Enable plugin now]({$a->url})';
$string['pluginname'] = 'Programlar';
$string['pluginname_desc'] = 'Programlar, kurs kümelerinin oluşturulmasına imkan tanıyacak şekilde tasarlanmıştır.';
$string['privacy:metadata:field:programid'] = 'Program kimliği';
$string['privacy:metadata:field:userid'] = 'Kullanıcı kimliği';
$string['privacy:metadata:field:allocationid'] = 'Program atama kimliği';
$string['privacy:metadata:field:sourceid'] = 'Atama kaynağı';
$string['privacy:metadata:field:itemid'] = 'Öğe Kimliği';
$string['privacy:metadata:field:timecreated'] = 'Oluşturma tarihi';
$string['privacy:metadata:field:timecompleted'] = 'Tamamlanma tarihi';

$string['privacy:metadata:table:enrol_programs_allocations'] = 'Program atamalarıyla ilgili bilgiler';
$string['privacy:metadata:field:archived'] = 'Kayıt arşivlenmiş mi?';
$string['privacy:metadata:field:sourcedatajson'] = 'Atamanın kaynağı hakkında bilgi';
$string['privacy:metadata:field:timeallocated'] = 'Program atama tarihi';
$string['privacy:metadata:field:timestart'] = 'Başlangıç tarihi';
$string['privacy:metadata:field:timedue'] = 'Son tarih';
$string['privacy:metadata:field:timeend'] = 'Bitiş tarihi';

$string['privacy:metadata:table:enrol_programs_certs_issues'] = 'Program atama sertifikası sorunları';
$string['privacy:metadata:field:issueid'] = 'Sorun kimliği';

$string['privacy:metadata:table:enrol_programs_completions'] = 'Tamamlanan program atamaları';

$string['privacy:metadata:table:enrol_programs_evidences'] = 'Diğer tamamlama kanıtları hakkında bilgiler';
$string['privacy:metadata:field:evidencejson'] = 'Tamamlama kanıtları hakkında bilgi';
$string['privacy:metadata:field:createdby'] = 'Kanıtı oluşturan';

$string['privacy:metadata:table:enrol_programs_requests'] = 'Atama isteği hakkında bilgi';
$string['privacy:metadata:field:datajson'] = 'İstek hakkında bilgi';
$string['privacy:metadata:field:timerequested'] = 'İstek tarihi';
$string['privacy:metadata:field:timerejected'] = 'Ret tarihi';
$string['privacy:metadata:field:rejectedby'] = 'İsteği reddeden';


$string['privacy:metadata:table:enrol_programs_usr_snapshots'] = 'Program atama anlık görüntüleri';
$string['privacy:metadata:field:reason'] = 'Neden';
$string['privacy:metadata:field:timesnapshot'] = 'Anlık görüntü tarihi';
$string['privacy:metadata:field:snapshotby'] = 'Anlık görüntü oluşturan';
$string['privacy:metadata:field:explanation'] = 'Açıklama';
$string['privacy:metadata:field:completionsjson'] = 'Tamamlama hakkında bilgi';
$string['privacy:metadata:field:evidencesjson'] = 'Tamamlama kanıtları hakkında bilgi';

$string['privacy:metadata:table:enrol_programs_src_commholds'] = 'Ticaret ataması rezervasyonları';
$string['privacy:metadata:field:quantity'] = 'Miktar';

$string['program'] = 'Program';
$string['programautofix'] = 'Program otomatik onarma';
$string['programdue'] = 'Program sonu';
$string['programdue_help'] = 'Program sonu tarihi, kullanıcıların programı ne zaman tamamlaması gerektiğini belirtir.';
$string['programdue_delay'] = 'Başlangıç sonrası sona erme';
$string['programdue_date'] = 'Son tarih';
$string['programend'] = 'Program sonu';
$string['programend_help'] = 'Kullanıcılar program sona erdikten sonra program kurslarına giremez.';
$string['programend_delay'] = 'Başlangıç sonrası bitiş';
$string['programend_date'] = 'Program bitiş tarihi';
$string['programcompletion'] = 'Program tamamlanma tarihi';
$string['programcompletionoverride'] = 'Program tamamlamasını geçersiz kıl';
$string['programidnumber'] = 'Program kimliği numarası';
$string['programimage'] = 'Program görüntüsü';
$string['programname'] = 'Program adı';
$string['programurl'] = 'Program URL\'si';
$string['programs'] = 'Programlar';
$string['programsactive'] = 'Etkin';
$string['programsarchived'] = 'Arşivlenmiş';
$string['programsarchived_help'] = 'Arşivlenen programlar kullanıcılardan gizlenir ve ilerleme durumları kilitlenir.';
$string['programslayout'] = 'Programlar ayrıntılı sayfa düzeni';
$string['programslayout_desc'] = 'Programlarım sayfasının program düzenini (tablo veya ızgara görünümü) kontrol eder.';
$string['programslayoutallowuserswitch'] = 'Kullanıcıların program düzenini değiştirmesine izin ver';
$string['programslayoutallowuserswitch_desc'] = 'Kullanıcıların program düzenini değiştirmesine izin ver';
$string['programslayout_desc'] = 'Programlarım sayfasının program düzenini (tablo veya ızgara görünümü) kontrol eder.';
$string['programsblocklayout'] = 'Programlarım blok düzeni';
$string['programsblocklayout_desc'] = 'Programlarım blokunun program düzenini (tablo veya ızgara görünümü) kontrol eder.';

$string['programstart'] = 'Program başlangıcı';
$string['programstart_help'] = 'Kullanıcılar program başlamadan önce program kurslarına giremez.';
$string['programstart_allocation'] = 'Atama sonrasında hemen başlat';
$string['programstart_delay'] = 'Atama sonrasında başlatmayı geciktir';
$string['programstart_date'] = 'Program başlangıç tarihi';
$string['programstatus'] = 'Program durumu';
$string['programstatus_completed'] = 'Tamamlandı';
$string['programstatus_any'] = 'Herhangi bir program durumu';
$string['programstatus_archived'] = 'Arşivlenmiş';
$string['programstatus_archivedcompleted'] = 'Arşivleme tamamlandı';
$string['programstatus_overdue'] = 'Süresi geçmiş';
$string['programstatus_open'] = 'Açık';
$string['programstatus_future'] = 'Henüz açık değil';
$string['programstatus_failed'] = 'Başarısız';
$string['programs:addcourse'] = 'Programlara kurs ekle';
$string['programs:addtocertifications'] = 'Sertifikalara program ekle';
$string['programs:addtoplan'] = 'Planlara program ekle';
$string['programs:allocate'] = 'Programlara öğrenci ata';
$string['programs:archive'] = 'Program atamalarını arşivle';
$string['programs:clone'] = 'Program içeriğinin ve ayarların kopyalanmasına izin ver';
$string['programs:configframeworks'] = 'Plan çerçevelerinde program erişilebilirliğini yapılandır';
$string['programs:configurecustomfields'] = 'Program özel alanlarını yapılandır';
$string['programs:delete'] = 'Programları sil';
$string['programs:edit'] = 'Programları ekle ve güncelleştir';
$string['programs:export'] = 'Programları dışa aktar';
$string['programs:admin'] = 'Gelişmiş program yönetimi';
$string['programs:manageallocation'] = 'Kullanıcı atamalarını yönet';
$string['programs:manageevidence'] = 'Diğer tamamlama kanıtlarını yönet';
$string['programs:reset'] = 'Program ilerleme durumunu sıfırla';
$string['programs:upload'] = 'Programları karşıya yükle';
$string['programs:view'] = 'Program yönetimini görüntüle';
$string['programs:viewcatalogue'] = 'Program kataloğuna eriş';
$string['public'] = 'Herkese Açık';
$string['public_help'] = 'Herkese açık programlar tüm kullanıcılara açıktır.

Görünürlük durumu, önceden atanmış olan programları etkilemez.';
$string['purchaseaccess'] = 'Erişim satın al';
$string['resetallocation'] = 'Program ilerleme durumunu sıfırla';
$string['resettype'] = 'Sıfırlama türü';
$string['resettype_deallocate'] = 'Yalnızca program ataması kaldırma';
$string['resettype_full'] = 'Tam kurs temizleme';
$string['resettype_none'] = 'Yok';
$string['resettype_standard'] = 'Standart kurs temizleme';
$string['sequencetype'] = 'Tamamlama türü';
$string['sequencetype_allinorder'] = 'Tümü sırayla';
$string['sequencetype_allinanyorder'] = 'Tümü herhangi bir sırada';
$string['sequencetype_atleast'] = 'En az {$a->min} dakika';
$string['sequencetype_minpoints'] = 'Minimum {$a->minpoints} puan';
$string['selectcategory'] = 'Kategori seç';
$string['sortbyprogramname'] = 'Program adına göre sırala';
$string['sortbyprogramid'] = 'Program kimliğine göre sırala';
$string['sortbyprogramstart'] = 'Program başlangıç tarihine göre sırala';
$string['sortbyprogramdue'] = 'Program son tarihine göre sırala';
$string['sortbyprogramend'] = 'Program bitiş tarihine göre sırala';
$string['source'] = 'Kaynak';
$string['source_approval'] = 'Onay gerektiren istekler';
$string['source_approval_allownew'] = 'Onaylara izin ver';
$string['source_approval_allownew_desc'] = 'Yeni _requests with approval_ kaynaklarını programlara eklemeye izin ver';
$string['source_approval_allowrequest'] = 'Yeni isteklere izin ver';
$string['source_approval_confirm'] = 'Lütfen programa atanma isteğinizi onaylayın.';
$string['source_approval_daterequested'] = 'Veri istendi';
$string['source_approval_daterejected'] = 'Tarih reddedildi';
$string['source_approval_makerequest'] = 'İstek erişimi';
$string['source_approval_notification_approval_request_subject'] = 'Program isteği bildirimi';
$string['source_approval_notification_approval_request_body'] = '
{$a->user_fullname} kullanıcısı, "{$a->program_fullname}" programına erişim istedi.
';
$string['source_approval_notification_approval_reject_subject'] = 'Program isteği reddi bildirimi';
$string['source_approval_notification_approval_reject_body'] = 'Merhaba {$a->user_fullname},

"{$a->program_fullname}" programına erişim isteğiniz reddedildi.

{$a->reason}
';
$string['source_approval_requestallowed'] = 'İsteklere izin verilir';
$string['source_approval_requestnotallowed'] = 'İsteklere izin verilmez';
$string['source_approval_requests'] = 'İstekler';
$string['source_approval_requestpending'] = 'Erişim isteği beklemede';
$string['source_approval_requestrejected'] = 'Erişim isteği reddedildi';
$string['source_approval_requestapprove'] = 'İsteği onayla';
$string['source_approval_requestreject'] = 'İsteği reddet';
$string['source_approval_requestdelete'] = 'İsteği sil';
$string['source_approval_rejectionreason'] = 'Ret nedeni';
$string['source_certify'] = 'Sertifikalar';
$string['source_certify_allownew'] = 'Sertifikaları atamaya izin ver';
$string['source_certify_allownew_desc'] = 'Programlara yeni _sertifika_ kaynakları eklemeye izin ver';
$string['source_cohort'] = 'Otomatik kurs kümesi atama';
$string['source_cohort_allownew'] = 'Kurs kümesi atamasına izin ver';
$string['source_cohort_allownew_desc'] = 'Programlara yeni _cohort auto allocation_ kaynakları eklemeye izin ver';
$string['source_cohort_cohortstoallocate'] = 'Kurs kümeleri ata';
$string['source_ecommerce'] = 'E-Ticaret ataması';
$string['source_ecommerce_allownew'] = 'E-ticaret atamasına izin ver';
$string['source_ecommerce_allownew_desc'] = 'Programlara yeni e-ticaret otomatik atama kaynakları eklemeye izin ver';
$string['source_ecommerce_allowsignup'] = 'Yeni atamalara izin ver';
$string['source_ecommerce_cohortmembershiprequirement'] = 'Kullanıcının aşağıdaki kurs kümelerinin en az birinin üyesi olması gerekir: {$a}';
$string['source_ecommerce_maxusers'] = 'Maksimum kullanıcı';
$string['source_ecommerce_nocapacity'] = 'Bu programda boş yer yok';
$string['source_manual'] = 'Manuel atama';
$string['source_manual_allocateusers'] = 'Kullanıcı ata';
$string['source_manual_csvfile'] = 'CSV dosyası';
$string['source_manual_hasheaders'] = 'İlk satır başlıktır';
$string['source_manual_potusersmatching'] = 'Eşleşen atama adayları';
$string['source_manual_potusers'] = 'Atama adayları';
$string['source_manual_result_assigned'] = '{$a} kullanıcı programa atandı.';
$string['source_manual_result_errors'] = 'Programlar atanırken {$a} hata algılandı.';
$string['source_manual_result_skipped'] = '{$a} kullanıcı zaten programa atanmış.';
$string['source_manual_timeduecolumn'] = 'Sona erme saati sütunu';
$string['source_manual_timeendcolumn'] = 'Bitiş saati sütunu';
$string['source_manual_timestartcolumn'] = 'Başlangıç saati sütunu';
$string['source_manual_uploadusers'] = 'Atamaları karşıya yükle';
$string['source_manual_usercolumn'] = 'Kullanıcı kimliği sütunu';
$string['source_manual_usermapping'] = 'Şunun aracılığıyla kullanıcı eşleme:';
$string['source_manual_userupload_allocated'] = 'Şuraya atandı: \'{$a}\'';
$string['source_manual_userupload_alreadyallocated'] = 'Önceden şuraya atandı: \'{$a}\'';
$string['source_manual_userupload_invalidprogram'] = 'Şuraya atanamıyor: \'{$a}\'';
$string['source_selfallocation'] = 'Kendi kendine atama';
$string['source_selfallocation_allocate'] = 'Kaydol';
$string['source_selfallocation_allownew'] = 'Kendi kendine atamaya izin ver';
$string['source_selfallocation_allownew_desc'] = 'Programlara yeni _self allocation_ kaynakları eklemeye izin ver';
$string['source_selfallocation_allowsignup'] = 'Yeni kayıtlara izin ver';
$string['source_selfallocation_confirm'] = 'Lütfen programa atanmak istediğinizi onaylayın.';
$string['source_selfallocation_enable'] = 'Kendi kendine atamayı etkinleştir';
$string['source_selfallocation_key'] = 'Kayıt anahtarı';
$string['source_selfallocation_keyrequired'] = 'Kayıt anahtarı gereklidir';
$string['source_selfallocation_maxusers'] = 'Maksimum kullanıcı';
$string['source_selfallocation_maxusersreached'] = 'Kendi kendine atama maksimum kullanıcı sayısına zaten ulaşıldı';
$string['source_selfallocation_maxusers_status'] = '{$a->count}/{$a->max} kullanıcı';
$string['source_selfallocation_signupallowed'] = 'Kayıtlara izin veriliyor';
$string['source_selfallocation_signupnotallowed'] = 'Kayıtlara izin verilmiyor';
$string['source_udplans'] = 'Kullanıcı gelişim planları';
$string['source_udplans_allownew'] = 'Kullanıcı gelişim planları';
$string['source_udplans_allownew_desc'] = 'Programlara yeni _kullanıcı gelişim planları_ kaynakları eklemeye izin ver';
$string['source_udplans_allowed'] = 'İzin verildi';
$string['source_udplans_noframeworks'] = 'Herhangi bir plana eklenemez';
$string['source_udplans_notallowed'] = 'İzin verilmez';
$string['source_udplans_requirecap'] = 'Gerekli özelliği ekle';
$string['set'] = 'Kurs ayarı';
$string['settings'] = 'Program ayarları';
$string['scheduling'] = 'Planlama';
$string['taballocation'] = 'Atama ayarları';
$string['tabcontent'] = 'İçerik';
$string['tabgeneral'] = 'Genel';
$string['tabusers'] = 'Kullanıcılar';
$string['tabvisibility'] = 'Görünürlük ayarları';
$string['tagarea_enrol_programs_programs'] = 'Programlar';
$string['taskcertificate'] = 'Program sertifika oluşturma cron\'u';
$string['taskcron'] = 'Program eklentisi cron\'u';
$string['training'] = 'Eğitim';
$string['trainingcompletion'] = 'Gerekli eğitim: {$a}';
$string['trainingprogress'] = 'Eğitim ilerleme durumu: {$a->current}/{$a->total}';
$string['unarchive'] = 'Geri yükle';
$string['unlinkeditems'] = 'Bağlantısı olmayan öğeler';
$string['updateprogram'] = 'Programı güncelleştir';
$string['updateallocation'] = 'Atamayı güncelleştir';
$string['updateallocations'] = 'Atamaları güncelleştir';
$string['updatecourse'] = 'Kursu güncelleştir';
$string['updateset'] = 'Kümeyi güncelleştir';
$string['updatescheduling'] = 'Planlamayı güncelleştir';
$string['updatesource'] = '{$a} öğesini güncelleştir';
$string['updatetraining'] = 'Eğitimi güncelleştir';
$string['upload'] = 'Programları karşıya yükle';
$string['upload_invalidcount'] = 'Geçersiz kayıtlar';
$string['upload_files'] = 'Dosyalar';
$string['upload_files_error'] = 'Birden fazla CSV dosyası, bir JSON dosyası veya bir Zip arşivi bekleniyor';
$string['upload_preview'] = 'Veri önizlemesi';
$string['upload_status'] = 'Durum';
$string['upload_status_invalid'] = 'Geçersiz';
$string['upload_targetcontext'] = 'Programları içeriğe ekle';
$string['upload_uploadcount'] = 'Karşıya yüklenecek programlar';
$string['upload_usecategory'] = 'İçerikler için kategori sütunu kullan';
$string['userupload_completion_error'] = 'Program tamamlaması güncelleştirilemez';
$string['userupload_completion_updated'] = 'Program tamamlaması güncelleştirildi';

$string['rb_allocatedprograms'] = 'Atanan programlar';
$string['rb_complete'] = 'Tamamlandı';
$string['rb_completiondate'] = 'Tamamlanma Tarihi';
$string['rb_completionstatus'] = 'Tamamlanma Durumu';
$string['rb_datecompleted'] = 'Tamamlanma Tarihi';
$string['rb_dateallocated'] = 'Atama Tarihi';
$string['rb_datestarted'] = 'Başlama Tarihi';
$string['rb_coursesall'] = 'Kurslar - Tümü';
$string['rb_incomplete'] = 'Tamamlanmadı';
$string['rb_isallocated'] = 'Atandı';
$string['rb_iscomplete'] = 'Tamamlandı mı?';
$string['rb_iscompleteany'] = 'Tamamlandı mı? (herhangi bir yöntem)';
$string['rb_isinprogress'] = 'Devam ediyor mu?';
$string['rb_isnotcomplete'] = 'Tamamlanmadı mı?';
$string['rb_isnotyetstarted'] = 'Henüz başlamadı mı?';
$string['rb_notstarted'] = 'Başlamadı';
$string['rb_officewhencompletedbasic'] = 'Tamamlandığında ofis (temel)';
$string['rb_privacy:metadata'] = 'Eklentiye, kişisel veriler depolanmaz.';
$string['rb_programcategory'] = 'Program Kategorisi (veya Sitesi)';
$string['rb_programcategoryid'] = 'Program Kategorisi Kimliği (Site ise geçersiz)';
$string['rb_programcategoryidnumber'] = 'Program Kategorisi Kimlik Numarası (Site ise geçersiz)';
$string['rb_programcategorymultichoice'] = 'Program Kategorisi (çoktan seçmeli)';
$string['rb_programedatecreated'] = 'Program Oluşturulma Tarihi';
$string['rb_programduedate'] = 'Program Süresi Geçme Tarihi';
$string['rb_programenddate'] = 'Program Ataması Bitiş Tarihi';
$string['rb_programallocationtype'] = 'Atama Türü';
$string['rb_programallocationtypes'] = 'Atama Türleri';
$string['rb_programexpandlink'] = 'Program Adı (ayrıntıları genişletme)';
$string['rb_programid'] = 'Program Kimliği';
$string['rb_programidnumber'] = 'Program Kimliği Numarası';
$string['rb_programname'] = 'Program Adı';
$string['rb_programnameandsummary'] = 'Program Adı ve Açıklaması';
$string['rb_programnamelinked'] = 'Program Adı (program sayfasına bağlı)';
$string['rb_programmultiitem'] = 'Program (çoklu öğe)';
$string['rb_programsingleitem'] = 'Program';
$string['rb_programstartdate'] = 'Program Ataması Başlangıç Tarihi';
$string['rb_programsummary'] = 'Program Açıklaması';
$string['rb_programvisible'] = 'Program Herkese Açık';
$string['rb_programvisibledisabled'] = 'Program Görünür (geçerli değil)';
$string['rb_progress'] = 'İlerleme';
$string['rb_progressnumeric'] = 'İlerleme Durumu (sayısal)';
$string['rb_progresspercent'] = 'İlerleme Durumu (% tamamlandı)';
$string['rb_source_allocation'] = 'Program Atamaları';
$string['rb_timetocompletesinceenrol'] = 'Tamamlama saati (atama tarihinden itibaren)';
$string['rb_timetocompletesincestart'] = 'Tamamlama saati (başlangıç tarihinden itibaren)';
$string['rb_type_program'] = 'Program';
$string['rb_type_program_category'] = 'Kategori';
$string['rb_type_program_completion'] = 'Program Ataması';
$string['rb_type_program_customfields'] = 'Program özel alanları';
$string['rb_user'] = 'Kullanıcı';
$string['rb_viewprogram'] = 'Programı Görüntüle';
$string['rb_visiblecohorts'] = 'Görünürlüğe sahip kurs kümeleri';
