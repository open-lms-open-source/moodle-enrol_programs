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
$string['archived'] = 'Arşivlenmiş';
$string['catalogue'] = 'Program kataloğu';
$string['catalogue_dofilter'] = 'Ara';
$string['catalogue_resetfilter'] = 'Temizle';
$string['catalogue_searchtext'] = 'Metin ara';
$string['catalogue_tag'] = 'Etikete göre filtrele';
$string['certificatetemplatechoose'] = 'Bir şablon seç...';
$string['cohorts'] = 'Kurs kümelerine görünür';
$string['cohorts_help'] = 'Herkese açık olmayan programlar, belirli kurs kümesi üyeleri için görünür hale getirilebilir.

Görünürlük durumu, zaten atanmış olan programları etkilemez.';
$string['completiondate'] = 'Tamamlanma tarihi';
$string['creategroups'] = 'Kurs grupları';
$string['creategroups_help'] = 'Etkinleştirilmesi halinde programa eklenen her kursta bir grup oluşturulur ve atanan tüm kullanıcılar grup üyesi olarak eklenir.';
$string['deleteallocation'] = 'Program atamalarını sil';
$string['deletecourse'] = 'Kursu kaldır';
$string['deleteprogram'] = 'Programı sil';
$string['deleteset'] = 'Kümeyi sil';
$string['documentation'] = 'Moodle belgelerine yönelik programlar';
$string['duedate'] = 'Son tarih';
$string['enrolrole'] = 'Kurs rolü';
$string['enrolrole_desc'] = 'Kurs kaydı için programlar tarafından kullanılacak rolü seçin';
$string['errorcontentproblem'] = 'Program içerik yapısında sorun algılandı, program tamamlama doğru şekilde izlenmeyecek!';
$string['errordifferenttenant'] = 'Başka bir kiracıdaki programa erişilemiyor';
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
$string['evidence_details'] = 'Ayrıntılar';
$string['fixeddate'] = 'Sabit tarihte';
$string['item'] = 'Öğe';
$string['itemcompletion'] = 'Program öğesi tamamlama';
$string['management'] = 'Program yönetimi';
$string['messageprovider:allocation_notification'] = 'Program atama bildirimi';
$string['messageprovider:approval_request_notification'] = 'Program onay isteği bildirimi';
$string['messageprovider:approval_reject_notification'] = 'Program isteği reddi bildirimi';
$string['messageprovider:completion_notification'] = 'Program tamamlama bildirimi';
$string['messageprovider:deallocation_notification'] = 'Program ataması kaldırma bildirimi';
$string['messageprovider:duesoon_notification'] = 'Program sonu tarihi yakın bildirimi';
$string['messageprovider:due_notification'] = 'Program süresi geçti bildirimi';
$string['messageprovider:endsoon_notification'] = 'Program bitiş tarihi bildirimi';
$string['messageprovider:endcompleted_notification'] = 'Tamamlanan program sona erdi bildirimi';
$string['messageprovider:endfailed_notification'] = 'Başarısız program sona erdi bildirimi';
$string['messageprovider:start_notification'] = 'Program başlatıldı bildirimi';
$string['moveitem'] = 'Öğeyi taşı';
$string['moveitemcancel'] = 'Taşımayı iptal et';
$string['moveafter'] = '"{$a->item}" öğesini, "{$a->target}" öğesinin sonrasına taşı';
$string['movebefore'] = '"{$a->item}" öğesini, "{$a->target}" öğesinin öncesine taşı';
$string['moveinto'] = '"{$a->item}" öğesini, "{$a->target}" öğesinin içine taşı';
$string['myprograms'] = 'Programlarım';
$string['notification_allocation'] = 'Kullanıcı atandı';
$string['notification_completion'] = 'Program tamamlandı';
$string['notification_completion_subject'] = 'Program tamamlandı';
$string['notification_completion_body'] = 'Merhaba {$a->user_fullname},

"{$a->program_fullname}" programını tamamladınız.
';
$string['notification_deallocation'] = 'Kullanıcının ataması kaldırıldı';
$string['notification_duesoon'] = 'Program sonu tarihi yakın';
$string['notification_duesoon_subject'] = 'Programın yakında tamamlanması bekleniyor';
$string['notification_duesoon_body'] = 'Merhaba {$a->user_fullname},

"{$a->program_fullname}" programının {$a->program_duedate} tarihinde tamamlanması bekleniyor.
';
$string['notification_due'] = 'Program süresi geçti';
$string['notification_due_subject'] = 'Programın tamamlanması gerekiyordu';
$string['notification_due_body'] = 'Merhaba {$a->user_fullname},

"{$a->program_fullname}" programının {$a->program_duedate} tarihinden önce tamamlanması gerekiyordu.
';
$string['notification_endsoon'] = 'Program bitiş tarihi yaklaşıyor';
$string['notification_endsoon_subject'] = 'Program yakında bitiyor';
$string['notification_endsoon_body'] = 'Merhaba {$a->user_fullname},

"{$a->program_fullname}" programı {$a->program_enddate} tarihinde sona eriyor.
';
$string['notification_endcompleted'] = 'Tamamlanan program sona erdi';
$string['notification_endcompleted_subject'] = 'Tamamlanan program sona erdi';
$string['notification_endcompleted_body'] = 'Merhaba {$a->user_fullname},

"{$a->program_fullname}" programı sona erdi, programı daha önce tamamladınız.
';
$string['notification_endfailed'] = 'Başarısız program sona erdi';
$string['notification_endfailed_subject'] = 'Başarısız program sona erdi';
$string['notification_endfailed_body'] = 'Merhaba {$a->user_fullname},

"{$a->program_fullname}" programı sona erdi, programı tamamlayamadınız.
';
$string['notification_start'] = 'Program başladı';
$string['notification_start_subject'] = 'Program başladı';
$string['notification_start_body'] = 'Merhaba {$a->user_fullname},

"{$a->program_fullname}" programı başladı.
';
$string['notificationdates'] = 'Bildirim tarihleri';
$string['notset'] = 'Belirlenmedi';
$string['plugindisabled'] = 'Programa kayıt eklentisi devre dışı, programlar çalışmayacak.

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
$string['programidnumber'] = 'Program kimliği numarası';
$string['programimage'] = 'Program görüntüsü';
$string['programname'] = 'Program adı';
$string['programurl'] = 'Program URL\'si';
$string['programs'] = 'Programlar';
$string['programsactive'] = 'Etkin';
$string['programsarchived'] = 'Arşivlenmiş';
$string['programsarchived_help'] = 'Arşivlenen programlar kullanıcılardan gizlenir ve ilerleme durumları kilitlenir.';
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
$string['programs:allocate'] = 'Programlara öğrenci ata';
$string['programs:delete'] = 'Programları sil';
$string['programs:edit'] = 'Programları ekle ve güncelleştir';
$string['programs:admin'] = 'Gelişmiş program yönetimi';
$string['programs:manageevidence'] = 'Diğer tamamlama kanıtlarını yönet';
$string['programs:view'] = 'Program yönetimini görüntüle';
$string['programs:viewcatalogue'] = 'Program kataloğuna eriş';
$string['public'] = 'Herkese Açık';
$string['public_help'] = 'Genel programlar tüm kullanıcılara açık.

Görünürlük durumu, zaten atanmış olan programları etkilemez.';
$string['sequencetype'] = 'Tamamlama türü';
$string['sequencetype_allinorder'] = 'Tümü sırayla';
$string['sequencetype_allinanyorder'] = 'Tümü herhangi bir sırada';
$string['sequencetype_atleast'] = 'En az {$a->min}';
$string['selectcategory'] = 'Kategori seç';
$string['source'] = 'Kaynak';
$string['source_approval'] = 'Onay gerektiren istekler';
$string['source_approval_allownew'] = 'Onaylara izin ver';
$string['source_approval_allownew_desc'] = 'Yeni _requests with approval_ kaynaklarını programlara eklemeye izin ver';
$string['source_approval_allowrequest'] = 'Yeni isteklere izin ver';
$string['source_approval_confirm'] = 'Lütfen programa atanma isteğinizi onaylayın.';
$string['source_approval_daterequested'] = 'Veri istendi';
$string['source_approval_daterejected'] = 'Tarih reddedildi';
$string['source_approval_makerequest'] = 'İstek erişimi';
$string['source_approval_notification_allocation_subject'] = 'Program onay bildirimi';
$string['source_approval_notification_allocation_body'] = 'Merhaba {$a->user_fullname},

"{$a->program_fullname}" programına kaydolma işleminiz onaylandı, başlangıç tarihi: {$a->program_startdate}.
';
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
$string['notification_allocation_subject'] = 'Program atama bildirimi';
$string['notification_allocation_body'] = 'Merhaba {$a->user_fullname},

"{$a->program_fullname}" programına atandınız, başlangıç tarihi: {$a->program_startdate}.
';
$string['notification_deallocation_subject'] = 'Program ataması kaldırma bildirimi';
$string['notification_deallocation_body'] = 'Merhaba {$a->user_fullname},

"{$a->program_fullname}" programından atamanız kaldırıldı.
';
$string['source_cohort'] = 'Otomatik kurs kümesi atama';
$string['source_cohort_allownew'] = 'Kurs kümesi atamasına izin ver';
$string['source_cohort_allownew_desc'] = 'Programlara yeni _cohort auto allocation_ kaynakları eklemeye izin ver';
$string['source_manual'] = 'Manuel atama';
$string['source_manual_allocateusers'] = 'Kullanıcı ata';
$string['source_manual_csvfile'] = 'CSV dosyası';
$string['source_manual_hasheaders'] = 'İlk satır başlıktır';
$string['source_manual_potusersmatching'] = 'Eşleşen atama adayları';
$string['source_manual_potusers'] = 'Atama adayları';
$string['source_manual_result_assigned'] = 'Programa {$a} kullanıcı atandı.';
$string['source_manual_result_errors'] = 'Programlar atanırken {$a} hata algılandı.';
$string['source_manual_result_skipped'] = '{$a} kullanıcı zaten programa atandı.';
$string['source_manual_uploadusers'] = 'Atamaları karşıya yükle';
$string['source_manual_usercolumn'] = 'Kullanıcı kimliği sütunu';
$string['source_manual_usermapping'] = 'Şunun aracılığıyla kullanıcı eşleme:';
$string['source_manual_userupload_allocated'] = 'Şuraya atandı: \'{$a}\'';
$string['source_manual_userupload_alreadyallocated'] = 'Zaten şuraya atandı: \'{$a}\'';
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
$string['source_selfallocation_maxusers_status'] = 'Kullanıcılar {$a->count}/{$a->max}';
$string['source_selfallocation_notification_allocation_subject'] = 'Program atama bildirimi';
$string['source_selfallocation_notification_allocation_body'] = 'Merhaba {$a->user_fullname},

"{$a->program_fullname}" programına kaydoldunuz, başlangıç tarihi: {$a->program_startdate}.
';
$string['source_selfallocation_signupallowed'] = 'Kayıtlara izin veriliyor';
$string['source_selfallocation_signupnotallowed'] = 'Kayıtlara izin verilmiyor';
$string['set'] = 'Kurs ayarı';
$string['settings'] = 'Program ayarları';
$string['scheduling'] = 'Planlama';
$string['taballocation'] = 'Atama ayarları';
$string['tabcontent'] = 'İçerik';
$string['tabgeneral'] = 'Genel';
$string['tabusers'] = 'Kullanıcılar';
$string['tabvisibility'] = 'Görünürlük ayarları';
$string['tagarea_program'] = 'Programlar';
$string['taskcertificate'] = 'Program sertifika oluşturma cron\'u';
$string['taskcron'] = 'Program eklentisi cron\'u';
$string['unlinkeditems'] = 'Bağlantısı olmayan öğeler';
$string['updateprogram'] = 'Programı güncelleştir';
$string['updateallocation'] = 'Atamayı güncelleştir';
$string['updateallocations'] = 'Atamaları güncelleştir';
$string['updateset'] = 'Kümeyi güncelleştir';
$string['updatescheduling'] = 'Planlamayı güncelleştir';
$string['updatesource'] = 'Şunu güncelleştir: {$a}';
