<?php
function wsa_zoho_individual_webinar_register_2_form_sc($atts)
{

    $atts = shortcode_atts(array(
        'submit_text' => 'Register Now !',
    ), $atts, 'bartag');
    extract($atts);

    ob_start();
?>
    <div class="wsa-zoho-individual-webinar-register-form emertze-zoho-individual-webinar-register-form">

        <div id='zmWebToEntityForm' style="">
            <META HTTP-EQUIV='content-type' CONTENT='text/html;charset = UTF-8' />
            <form action='https://webinar.zoho.com/meeting/WebForm' name=WebForm4248645000000321016 method='POST'
                onSubmit='javascript:document.charset="UTF-8"; return checkMandatory4248645000000321016()'
                accept-charset='UTF-8'>
                <input type='text' style='display:none;' name='xnQsjsdp'
                    value='498f2fd450affc28dba0cb2263c25f93ff44b7aa426c3615e20989661cde641a' />
                <input type='hidden' name='zc_gad' id='zc_gad' value='' />
                <input type='text' style='display:none;' name='xmIwtLD'
                    value='a17d48009f36a4000053e3d24f8c5b01202b50d39da9e54a8a1ddaf3091ce477ea067adf08cc2f9fd27c330f43a314e7' />
                <input type='text' style='display:none;' name='actionType' value='UmVnaXN0cmF0aW9ucw==' /> <input type='text'
                    style='display:none;' name='returnURL' value='https://webinar.zoho.com/postregister' /> <input type='text'
                    style='display:none;' name='sysId' value='4248645000000321006' /> <input type='text' style='display:none;'
                    name='isEmbedForm' value='true' />
                <table border=0 cellspacing=0 cellpadding='6'  style='background-color:#ffffff;background-color:white;color:black'>
                    <tr style="display: none;">
                        <td style='width:100%;'><select id='timezone' name='timezone' style='width: inherit;'>
                                <option value='America/Cuiaba'>( GMT -04:00 ) Amazon Standard Time (America/Cuiaba)</option>
                                <option value='Asia/Aqtobe'>( GMT +05:00 ) West Kazakhstan Time (Asia/Aqtobe)</option>
                                <option value='America/Sitka'>( GMT -08:00 ) Alaska Daylight Time (America/Sitka)</option>
                                <option value='Asia/Vladivostok'>( GMT +10:00 ) Vladivostok Standard Time (Asia/Vladivostok)
                                </option>
                                <option value='Africa/Nairobi'>( GMT +03:00 ) East Africa Time (Africa/Nairobi)</option>
                                <option value='Africa/Maputo'>( GMT +02:00 ) Central Africa Time (Africa/Maputo)</option>
                                <option value='Asia/Aqtau'>( GMT +05:00 ) West Kazakhstan Time (Asia/Aqtau)</option>
                                <option value='Pacific/Kwajalein'>( GMT +12:00 ) Marshall Islands Time (Pacific/Kwajalein)
                                </option>
                                <option value='America/El_Salvador'>( GMT -06:00 ) Central Standard Time (America/El_Salvador)
                                </option>
                                <option value='America/Kentucky/Monticello'>( GMT -04:00 ) Eastern Daylight Time
                                    (America/Kentucky/Monticello)</option>
                                <option value='Pacific/Marquesas'>( GMT -09:30 ) Marquesas Time (Pacific/Marquesas)</option>
                                <option value='Africa/El_Aaiun'>( GMT +01:00 ) Western European Summer Time (Africa/El_Aaiun)
                                </option>
                                <option value='Asia/Pontianak'>( GMT +07:00 ) Western Indonesia Time (Asia/Pontianak)</option>
                                <option value='Africa/Cairo'>( GMT +03:00 ) Eastern European Summer Time (Africa/Cairo)</option>
                                <option value='Pacific/Pago_Pago'>( GMT -11:00 ) Samoa Standard Time (Pacific/Pago_Pago)
                                </option>
                                <option value='Pacific/Honolulu'>( GMT -10:00 ) Hawaii-Aleutian Standard Time (Pacific/Honolulu)
                                </option>
                                <option value='Pacific/Rarotonga'>( GMT -10:00 ) Cook Islands Standard Time (Pacific/Rarotonga)
                                </option>
                                <option value='Asia/Kuching'>( GMT +08:00 ) Malaysia Time (Asia/Kuching)</option>
                                <option value='America/North_Dakota/Center'>( GMT -05:00 ) Central Daylight Time
                                    (America/North_Dakota/Center)</option>
                                <option value='America/Guatemala'>( GMT -06:00 ) Central Standard Time (America/Guatemala)
                                </option>
                                <option value='Australia/Hobart'>( GMT +10:00 ) Australian Eastern Standard Time
                                    (Australia/Hobart)</option>
                                <option value='Europe/London'>( GMT +01:00 ) British Summer Time (Europe/London)</option>
                                <option value='Asia/Ulaanbaatar'>( GMT +08:00 ) Ulaanbaatar Standard Time (Asia/Ulaanbaatar)
                                </option>
                                <option value='America/Belize'>( GMT -06:00 ) Central Standard Time (America/Belize)</option>
                                <option value='America/Panama'>( GMT -05:00 ) Eastern Standard Time (America/Panama)</option>
                                <option value='Asia/Baghdad'>( GMT +03:00 ) Arabian Standard Time (Asia/Baghdad)</option>
                                <option value='America/Indiana/Tell_City'>( GMT -05:00 ) Central Daylight Time
                                    (America/Indiana/Tell_City)</option>
                                <option value='America/Tijuana'>( GMT -07:00 ) Pacific Daylight Time (America/Tijuana)</option>
                                <option value='America/Managua'>( GMT -06:00 ) Central Standard Time (America/Managua)</option>
                                <option value='America/Indiana/Petersburg'>( GMT -04:00 ) Eastern Daylight Time
                                    (America/Indiana/Petersburg)</option>
                                <option value='Europe/Brussels'>( GMT +02:00 ) Central European Summer Time (Europe/Brussels)
                                </option>
                                <option value='Asia/Yerevan'>( GMT +04:00 ) Armenia Standard Time (Asia/Yerevan)</option>
                                <option value='America/Chihuahua'>( GMT -06:00 ) Central Standard Time (America/Chihuahua)
                                </option>
                                <option value='America/Ojinaga'>( GMT -05:00 ) Central Daylight Time (America/Ojinaga)</option>
                                <option value='Asia/Hovd'>( GMT +07:00 ) Hovd Standard Time (Asia/Hovd)</option>
                                <option value='GMT'>( GMT +00:00 ) Greenwich Mean Time (GMT)</option>
                                <option value='America/Anchorage'>( GMT -08:00 ) Alaska Daylight Time (America/Anchorage)
                                </option>
                                <option value='Europe/Warsaw'>( GMT +02:00 ) Central European Summer Time (Europe/Warsaw)
                                </option>
                                <option value='America/Chicago'>( GMT -05:00 ) Central Daylight Time (America/Chicago)</option>
                                <option value='America/Halifax'>( GMT -03:00 ) Atlantic Daylight Time (America/Halifax)</option>
                                <option value='Antarctica/Rothera'>( GMT -03:00 ) Rothera Time (Antarctica/Rothera)</option>
                                <option value='America/Indiana/Indianapolis'>( GMT -04:00 ) Eastern Daylight Time
                                    (America/Indiana/Indianapolis)</option>
                                <option value='America/Tegucigalpa'>( GMT -06:00 ) Central Standard Time (America/Tegucigalpa)
                                </option>
                                <option value='Asia/Damascus'>( GMT +03:00 ) Eastern European Standard Time (Asia/Damascus)
                                </option>
                                <option value='Europe/Istanbul'>( GMT +03:00 ) Turkey Time (Europe/Istanbul)</option>
                                <option value='America/Eirunepe'>( GMT -05:00 ) Acre Standard Time (America/Eirunepe)</option>
                                <option value='America/Argentina/San_Luis'>( GMT -03:00 ) Western Argentina Standard Time
                                    (America/Argentina/San_Luis)</option>
                                <option value='America/Miquelon'>( GMT -02:00 ) St. Pierre & Miquelon Daylight Time
                                    (America/Miquelon)</option>
                                <option value='America/Santiago'>( GMT -04:00 ) Chile Standard Time (America/Santiago)</option>
                                <option value='America/Argentina/Catamarca'>( GMT -03:00 ) Argentina Standard Time
                                    (America/Argentina/Catamarca)</option>
                                <option value='Asia/Baku'>( GMT +04:00 ) Azerbaijan Standard Time (Asia/Baku)</option>
                                <option value='America/Argentina/Ushuaia'>( GMT -03:00 ) Argentina Standard Time
                                    (America/Argentina/Ushuaia)</option>
                                <option value='America/La_Paz'>( GMT -04:00 ) Bolivia Time (America/La_Paz)</option>
                                <option value='Asia/Taipei'>( GMT +08:00 ) Taipei Standard Time (Asia/Taipei)</option>
                                <option value='Asia/Manila'>( GMT +08:00 ) Philippine Standard Time (Asia/Manila)</option>
                                <option value='Asia/Bangkok'>( GMT +07:00 ) Indochina Time (Asia/Bangkok)</option>
                                <option value='Atlantic/Madeira'>( GMT +01:00 ) Western European Summer Time (Atlantic/Madeira)
                                </option>
                                <option value='Antarctica/Palmer'>( GMT -03:00 ) Chile Time (Antarctica/Palmer)</option>
                                <option value='America/Grand_Turk'>( GMT -04:00 ) Eastern Daylight Time (America/Grand_Turk)
                                </option>
                                <option value='Asia/Samarkand'>( GMT +05:00 ) Uzbekistan Standard Time (Asia/Samarkand)</option>
                                <option value='Asia/Yangon'>( GMT +06:30 ) Myanmar Time (Asia/Yangon)</option>
                                <option value='America/Argentina/Cordoba'>( GMT -03:00 ) Argentina Standard Time
                                    (America/Argentina/Cordoba)</option>
                                <option value='America/Indiana/Marengo'>( GMT -04:00 ) Eastern Daylight Time
                                    (America/Indiana/Marengo)</option>
                                <option value='Asia/Almaty'>( GMT +05:00 ) East Kazakhstan Time (Asia/Almaty)</option>
                                <option value='America/Punta_Arenas'>( GMT -03:00 ) Punta Arenas Standard Time
                                    (America/Punta_Arenas)</option>
                                <option value='Asia/Dubai'>( GMT +04:00 ) Gulf Standard Time (Asia/Dubai)</option>
                                <option value='America/Araguaina'>( GMT -03:00 ) Brasilia Standard Time (America/Araguaina)
                                </option>
                                <option value='America/Mexico_City'>( GMT -06:00 ) Central Standard Time (America/Mexico_City)
                                </option>
                                <option value='Asia/Novosibirsk'>( GMT +07:00 ) Novosibirsk Standard Time (Asia/Novosibirsk)
                                </option>
                                <option value='America/Argentina/Salta'>( GMT -03:00 ) Argentina Standard Time
                                    (America/Argentina/Salta)</option>
                                <option value='Africa/Tunis'>( GMT +01:00 ) Central European Standard Time (Africa/Tunis)
                                </option>
                                <option value='Asia/Jerusalem'>( GMT +03:00 ) Israel Daylight Time (Asia/Jerusalem)</option>
                                <option value='Europe/Andorra'>( GMT +02:00 ) Central European Summer Time (Europe/Andorra)
                                </option>
                                <option value='Pacific/Fakaofo'>( GMT +13:00 ) Tokelau Time (Pacific/Fakaofo)</option>
                                <option value='Africa/Tripoli'>( GMT +02:00 ) Eastern European Standard Time (Africa/Tripoli)
                                </option>
                                <option value='Pacific/Port_Moresby'>( GMT +10:00 ) Papua New Guinea Time (Pacific/Port_Moresby)
                                </option>
                                <option value='Pacific/Kiritimati'>( GMT +14:00 ) Line Islands Time (Pacific/Kiritimati)
                                </option>
                                <option value='America/Matamoros'>( GMT -05:00 ) Central Daylight Time (America/Matamoros)
                                </option>
                                <option value='Pacific/Palau'>( GMT +09:00 ) Palau Time (Pacific/Palau)</option>
                                <option value='Europe/Kaliningrad'>( GMT +02:00 ) Eastern European Standard Time
                                    (Europe/Kaliningrad)</option>
                                <option value='Asia/Riyadh'>( GMT +03:00 ) Arabian Standard Time (Asia/Riyadh)</option>
                                <option value='America/Montevideo'>( GMT -03:00 ) Uruguay Standard Time (America/Montevideo)
                                </option>
                                <option value='Africa/Windhoek'>( GMT +02:00 ) Western African Time (Africa/Windhoek)</option>
                                <option value='Atlantic/South_Georgia'>( GMT -02:00 ) South Georgia Time
                                    (Atlantic/South_Georgia)</option>
                                <option value='Europe/Lisbon'>( GMT +01:00 ) Western European Summer Time (Europe/Lisbon)
                                </option>
                                <option value='PRT'>( GMT -04:00 ) Atlantic Standard Time (PRT)</option>
                                <option value='Asia/Karachi'>( GMT +05:00 ) Pakistan Standard Time (Asia/Karachi)</option>
                                <option value='Asia/Novokuznetsk'>( GMT +07:00 ) Krasnoyarsk Standard Time (Asia/Novokuznetsk)
                                </option>
                                <option value='Australia/Perth'>( GMT +08:00 ) Australian Western Standard Time
                                    (Australia/Perth)</option>
                                <option value='CST6CDT'>( GMT -05:00 ) Central Daylight Time (CST6CDT)</option>
                                <option value='Asia/Chita'>( GMT +09:00 ) Yakutsk Standard Time (Asia/Chita)</option>
                                <option value='Pacific/Easter'>( GMT -06:00 ) Easter Island Standard Time (Pacific/Easter)
                                </option>
                                <option value='Atlantic/Canary'>( GMT +01:00 ) Western European Summer Time (Atlantic/Canary)
                                </option>
                                <option value='Antarctica/Davis'>( GMT +07:00 ) Davis Time (Antarctica/Davis)</option>
                                <option value='Pacific/Efate'>( GMT +11:00 ) Vanuatu Standard Time (Pacific/Efate)</option>
                                <option value='America/Bogota'>( GMT -05:00 ) Colombia Standard Time (America/Bogota)</option>
                                <option value='America/Menominee'>( GMT -05:00 ) Central Daylight Time (America/Menominee)
                                </option>
                                <option value='America/Manaus'>( GMT -04:00 ) Amazon Standard Time (America/Manaus)</option>
                                <option value='America/Adak'>( GMT -09:00 ) Hawaii-Aleutian Daylight Time (America/Adak)
                                </option>
                                <option value='Europe/Bucharest'>( GMT +03:00 ) Eastern European Summer Time (Europe/Bucharest)
                                </option>
                                <option value='Pacific/Norfolk'>( GMT +11:00 ) Norfolk Island Time (Pacific/Norfolk)</option>
                                <option value='Asia/Tomsk'>( GMT +07:00 ) Tomsk Standard Time (Asia/Tomsk)</option>
                                <option value='America/Argentina/Mendoza'>( GMT -03:00 ) Argentina Standard Time
                                    (America/Argentina/Mendoza)</option>
                                <option value='Europe/Malta'>( GMT +02:00 ) Central European Summer Time (Europe/Malta)</option>
                                <option value='Asia/Macau'>( GMT +08:00 ) China Standard Time (Asia/Macau)</option>
                                <option value='Pacific/Tahiti'>( GMT -10:00 ) Tahiti Time (Pacific/Tahiti)</option>
                                <option value='Europe/Kirov'>( GMT +03:00 ) Moscow Standard Time (Europe/Kirov)</option>
                                <option value='America/Resolute'>( GMT -05:00 ) Central Daylight Time (America/Resolute)
                                </option>
                                <option value='Pacific/Tarawa'>( GMT +12:00 ) Gilbert Islands Time (Pacific/Tarawa)</option>
                                <option value='Pacific/Kanton'>( GMT +13:00 ) Kanton Standard Time (Pacific/Kanton)</option>
                                <option value='Asia/Krasnoyarsk'>( GMT +07:00 ) Krasnoyarsk Standard Time (Asia/Krasnoyarsk)
                                </option>
                                <option value='PST'>( GMT -07:00 ) Pacific Daylight Time (PST)</option>
                                <option value='America/Argentina/Rio_Gallegos'>( GMT -03:00 ) Argentina Standard Time
                                    (America/Argentina/Rio_Gallegos)</option>
                                <option value='America/Edmonton'>( GMT -06:00 ) Mountain Daylight Time (America/Edmonton)
                                </option>
                                <option value='America/Santo_Domingo'>( GMT -04:00 ) Atlantic Standard Time
                                    (America/Santo_Domingo)</option>
                                <option value='Europe/Minsk'>( GMT +03:00 ) Moscow Standard Time (Europe/Minsk)</option>
                                <option value='Pacific/Auckland'>( GMT +12:00 ) New Zealand Standard Time (Pacific/Auckland)
                                </option>
                                <option value='America/Glace_Bay'>( GMT -03:00 ) Atlantic Daylight Time (America/Glace_Bay)
                                </option>
                                <option value='Africa/Casablanca'>( GMT +01:00 ) Western European Summer Time
                                    (Africa/Casablanca)</option>
                                <option value='Africa/Lagos'>( GMT +01:00 ) West Africa Standard Time (Africa/Lagos)</option>
                                <option value='Asia/Qatar'>( GMT +03:00 ) Arabian Standard Time (Asia/Qatar)</option>
                                <option value='Europe/Rome'>( GMT +02:00 ) Central European Summer Time (Europe/Rome)</option>
                                <option value='Indian/Mauritius'>( GMT +04:00 ) Mauritius Standard Time (Indian/Mauritius)
                                </option>
                                <option value='Asia/Magadan'>( GMT +11:00 ) Magadan Standard Time (Asia/Magadan)</option>
                                <option value='America/Port-au-Prince'>( GMT -04:00 ) Eastern Daylight Time
                                    (America/Port-au-Prince)</option>
                                <option value='Asia/Ashgabat'>( GMT +05:00 ) Turkmenistan Standard Time (Asia/Ashgabat)</option>
                                <option value='America/Regina'>( GMT -06:00 ) Central Standard Time (America/Regina)</option>
                                <option value='America/Dawson_Creek'>( GMT -07:00 ) Mountain Standard Time
                                    (America/Dawson_Creek)</option>
                                <option value='Africa/Algiers'>( GMT +01:00 ) Central European Standard Time (Africa/Algiers)
                                </option>
                                <option value='America/St_Johns'>( GMT -02:30 ) Newfoundland Daylight Time (America/St_Johns)
                                </option>
                                <option value='Europe/Zurich'>( GMT +02:00 ) Central European Summer Time (Europe/Zurich)
                                </option>
                                <option value='Europe/Vilnius'>( GMT +03:00 ) Eastern European Summer Time (Europe/Vilnius)
                                </option>
                                <option value='America/Fortaleza'>( GMT -03:00 ) Brasilia Standard Time (America/Fortaleza)
                                </option>
                                <option value='Asia/Dili'>( GMT +09:00 ) East Timor Time (Asia/Dili)</option>
                                <option value='America/Denver'>( GMT -06:00 ) Mountain Daylight Time (America/Denver)</option>
                                <option value='America/Hermosillo'>( GMT -07:00 ) Mexican Pacific Standard Time
                                    (America/Hermosillo)</option>
                                <option value='Europe/Saratov'>( GMT +04:00 ) Saratov Standard Time (Europe/Saratov)</option>
                                <option value='America/Cancun'>( GMT -05:00 ) Eastern Standard Time (America/Cancun)</option>
                                <option value='Pacific/Kosrae'>( GMT +11:00 ) Kosrae Time (Pacific/Kosrae)</option>
                                <option value='Europe/Gibraltar'>( GMT +02:00 ) Central European Summer Time (Europe/Gibraltar)
                                </option>
                                <option value='Asia/Kathmandu'>( GMT +05:45 ) Nepal Time (Asia/Kathmandu)</option>
                                <option value='Asia/Seoul'>( GMT +09:00 ) Korean Standard Time (Asia/Seoul)</option>
                                <option value='Australia/Sydney'>( GMT +10:00 ) Australian Eastern Standard Time
                                    (Australia/Sydney)</option>
                                <option value='America/Lima'>( GMT -05:00 ) Peru Standard Time (America/Lima)</option>
                                <option value='Europe/Madrid'>( GMT +02:00 ) Central European Summer Time (Europe/Madrid)
                                </option>
                                <option value='America/Bahia_Banderas'>( GMT -06:00 ) Central Standard Time
                                    (America/Bahia_Banderas)</option>
                                <option value='America/Havana'>( GMT -04:00 ) Cuba Daylight Time (America/Havana)</option>
                                <option value='America/Cambridge_Bay'>( GMT -06:00 ) Mountain Daylight Time
                                    (America/Cambridge_Bay)</option>
                                <option value='Asia/Colombo'  >( GMT +05:30 ) India Standard Time (Asia/Colombo)</option>
                                <option value='Asia/Choibalsan'>( GMT +08:00 ) Choibalsan Standard Time (Asia/Choibalsan)
                                </option>
                                <option value='Asia/Omsk'>( GMT +06:00 ) Omsk Standard Time (Asia/Omsk)</option>
                                <option value='Asia/Dhaka'>( GMT +06:00 ) Bangladesh Standard Time (Asia/Dhaka)</option>
                                <option value='Australia/Brisbane'>( GMT +10:00 ) Australian Eastern Standard Time
                                    (Australia/Brisbane)</option>
                                <option value='America/Barbados'>( GMT -04:00 ) Atlantic Standard Time (America/Barbados)
                                </option>
                                <option value='Asia/Urumqi'>( GMT +06:00 ) Xinjiang Standard Time (Asia/Urumqi)</option>
                                <option value='Atlantic/Cape_Verde'>( GMT -01:00 ) Cape Verde Standard Time
                                    (Atlantic/Cape_Verde)</option>
                                <option value='Europe/Volgograd'>( GMT +03:00 ) Moscow Standard Time (Europe/Volgograd)</option>
                                <option value='Asia/Yekaterinburg'>( GMT +05:00 ) Yekaterinburg Standard Time
                                    (Asia/Yekaterinburg)</option>
                                <option value='America/Vancouver'>( GMT -07:00 ) Pacific Daylight Time (America/Vancouver)
                                </option>
                                <option value='America/Rio_Branco'>( GMT -05:00 ) Acre Standard Time (America/Rio_Branco)
                                </option>
                                <option value='America/Detroit'>( GMT -04:00 ) Eastern Daylight Time (America/Detroit)</option>
                                <option value='America/Danmarkshavn'>( GMT +00:00 ) Greenwich Mean Time (America/Danmarkshavn)
                                </option>
                                <option value='Pacific/Chatham'>( GMT +12:45 ) Chatham Standard Time (Pacific/Chatham)</option>
                                <option value='America/Sao_Paulo'>( GMT -03:00 ) Brasilia Standard Time (America/Sao_Paulo)
                                </option>
                                <option value='America/Thule'>( GMT -03:00 ) Atlantic Daylight Time (America/Thule)</option>
                                <option value='Asia/Jayapura'>( GMT +09:00 ) Eastern Indonesia Time (Asia/Jayapura)</option>
                                <option value='Asia/Dushanbe'>( GMT +05:00 ) Tajikistan Time (Asia/Dushanbe)</option>
                                <option value='Asia/Hong_Kong'>( GMT +08:00 ) Hong Kong Standard Time (Asia/Hong_Kong)</option>
                                <option value='America/Guyana'>( GMT -04:00 ) Guyana Time (America/Guyana)</option>
                                <option value='America/Guayaquil'>( GMT -05:00 ) Ecuador Time (America/Guayaquil)</option>
                                <option value='America/Martinique'>( GMT -04:00 ) Atlantic Standard Time (America/Martinique)
                                </option>
                                <option value='Europe/Berlin'>( GMT +02:00 ) Central European Summer Time (Europe/Berlin)
                                </option>
                                <option value='Europe/Moscow'>( GMT +03:00 ) Moscow Standard Time (Europe/Moscow)</option>
                                <option value='Europe/Chisinau'>( GMT +03:00 ) Eastern European Summer Time (Europe/Chisinau)
                                </option>
                                <option value='America/Rankin_Inlet'>( GMT -05:00 ) Central Daylight Time (America/Rankin_Inlet)
                                </option>
                                <option value='America/Puerto_Rico'>( GMT -04:00 ) Atlantic Standard Time (America/Puerto_Rico)
                                </option>
                                <option value='America/Argentina/La_Rioja'>( GMT -03:00 ) Argentina Standard Time
                                    (America/Argentina/La_Rioja)</option>
                                <option value='Europe/Budapest'>( GMT +02:00 ) Central European Summer Time (Europe/Budapest)
                                </option>
                                <option value='America/Argentina/Jujuy'>( GMT -03:00 ) Argentina Standard Time
                                    (America/Argentina/Jujuy)</option>
                                <option value='America/Porto_Velho'>( GMT -04:00 ) Amazon Standard Time (America/Porto_Velho)
                                </option>
                                <option value='Australia/Eucla'>( GMT +08:45 ) Australian Central Western Standard Time
                                    (Australia/Eucla)</option>
                                <option value='Asia/Sakhalin'>( GMT +11:00 ) Sakhalin Standard Time (Asia/Sakhalin)</option>
                                <option value='Asia/Shanghai'>( GMT +08:00 ) China Standard Time (Asia/Shanghai)</option>
                                <option value='America/Scoresbysund'>( GMT -01:00 ) East Greenland Summer Time
                                    (America/Scoresbysund)</option>
                                <option value='Europe/Helsinki'>( GMT +03:00 ) Eastern European Summer Time (Europe/Helsinki)
                                </option>
                                <option value='Asia/Beirut'>( GMT +03:00 ) Eastern European Summer Time (Asia/Beirut)</option>
                                <option value='Asia/Kamchatka'>( GMT +12:00 ) Petropavlovsk-Kamchatski Standard Time
                                    (Asia/Kamchatka)</option>
                                <option value='Etc/GMT+12'>( GMT -12:00 ) GMT-12:00 (Etc/GMT+12)</option>
                                <option value='Pacific/Bougainville'>( GMT +11:00 ) Bougainville Standard Time
                                    (Pacific/Bougainville)</option>
                                <option value='America/Nome'>( GMT -08:00 ) Alaska Daylight Time (America/Nome)</option>
                                <option value='NST'>( GMT +12:00 ) New Zealand Standard Time (NST)</option>
                                <option value='Africa/Sao_Tome'>( GMT +00:00 ) West Africa Standard Time (Africa/Sao_Tome)
                                </option>
                                <option value='Indian/Chagos'>( GMT +06:00 ) Indian Ocean Time (Indian/Chagos)</option>
                                <option value='America/Cayenne'>( GMT -03:00 ) French Guiana Time (America/Cayenne)</option>
                                <option value='Europe/Tallinn'>( GMT +03:00 ) Eastern European Summer Time (Europe/Tallinn)
                                </option>
                                <option value='Asia/Yakutsk'>( GMT +09:00 ) Yakutsk Standard Time (Asia/Yakutsk)</option>
                                <option value='Pacific/Galapagos'>( GMT -06:00 ) Galapagos Time (Pacific/Galapagos)</option>
                                <option value='Africa/Khartoum'>( GMT +02:00 ) Central Africa Time (Africa/Khartoum)</option>
                                <option value='Africa/Johannesburg'>( GMT +02:00 ) South Africa Standard Time
                                    (Africa/Johannesburg)</option>
                                <option value='Europe/Paris'>( GMT +02:00 ) Central European Summer Time (Europe/Paris)</option>
                                <option value='Africa/Ndjamena'>( GMT +01:00 ) West Africa Standard Time (Africa/Ndjamena)
                                </option>
                                <option value='EAT'>( GMT +03:00 ) East Africa Time (EAT)</option>
                                <option value='Pacific/Fiji'>( GMT +12:00 ) Fiji Standard Time (Pacific/Fiji)</option>
                                <option value='Indian/Maldives'>( GMT +05:00 ) Maldives Time (Indian/Maldives)</option>
                                <option value='Europe/Belgrade'>( GMT +02:00 ) Central European Summer Time (Europe/Belgrade)
                                </option>
                                <option value='Africa/Bissau'>( GMT +00:00 ) Greenwich Mean Time (Africa/Bissau)</option>
                                <option value='Asia/Tehran'>( GMT +03:30 ) Iran Standard Time (Asia/Tehran)</option>
                                <option value='Asia/Oral'>( GMT +05:00 ) West Kazakhstan Time (Asia/Oral)</option>
                                <option value='America/Juneau'>( GMT -08:00 ) Alaska Daylight Time (America/Juneau)</option>
                                <option value='Europe/Astrakhan'>( GMT +04:00 ) Astrakhan Standard Time (Europe/Astrakhan)
                                </option>
                                <option value='America/Indiana/Vevay'>( GMT -04:00 ) Eastern Daylight Time
                                    (America/Indiana/Vevay)</option>
                                <option value='Asia/Tashkent'>( GMT +05:00 ) Uzbekistan Standard Time (Asia/Tashkent)</option>
                                <option value='America/Campo_Grande'>( GMT -04:00 ) Amazon Standard Time (America/Campo_Grande)
                                </option>
                                <option value='Africa/Juba'>( GMT +02:00 ) East Africa Time (Africa/Juba)</option>
                                <option value='Asia/Jakarta'>( GMT +07:00 ) Western Indonesia Time (Asia/Jakarta)</option>
                                <option value='America/Belem'>( GMT -03:00 ) Brasilia Standard Time (America/Belem)</option>
                                <option value='Africa/Ceuta'>( GMT +02:00 ) Central European Summer Time (Africa/Ceuta)</option>
                                <option value='Asia/Barnaul'>( GMT +07:00 ) Barnaul Standard Time (Asia/Barnaul)</option>
                                <option value='America/Recife'>( GMT -03:00 ) Brasilia Standard Time (America/Recife)</option>
                                <option value='America/Bahia'>( GMT -03:00 ) Brasilia Standard Time (America/Bahia)</option>
                                <option value='America/Goose_Bay'>( GMT -03:00 ) Atlantic Daylight Time (America/Goose_Bay)
                                </option>
                                <option value='America/Noronha'>( GMT -02:00 ) Fernando de Noronha Standard Time
                                    (America/Noronha)</option>
                                <option value='America/Swift_Current'>( GMT -06:00 ) Central Standard Time
                                    (America/Swift_Current)</option>
                                <option value='Australia/Adelaide'>( GMT +09:30 ) Australian Central Standard Time
                                    (Australia/Adelaide)</option>
                                <option value='America/Metlakatla'>( GMT -08:00 ) Alaska Daylight Time (America/Metlakatla)
                                </option>
                                <option value='America/Paramaribo'>( GMT -03:00 ) Suriname Time (America/Paramaribo)</option>
                                <option value='Asia/Qostanay'>( GMT +05:00 ) Kostanay Standard Time (Asia/Qostanay)</option>
                                <option value='Europe/Simferopol'>( GMT +03:00 ) Moscow Standard Time (Europe/Simferopol)
                                </option>
                                <option value='America/Phoenix'>( GMT -07:00 ) Mountain Standard Time (America/Phoenix)</option>
                                <option value='MST'>( GMT -07:00 ) Mountain Standard Time (MST)</option>
                                <option value='Europe/Sofia'>( GMT +03:00 ) Eastern European Summer Time (Europe/Sofia)</option>
                                <option value='Europe/Prague'>( GMT +02:00 ) Central European Summer Time (Europe/Prague)
                                </option>
                                <option value='America/Whitehorse'>( GMT -07:00 ) Pacific Standard Time (America/Whitehorse)
                                </option>
                                <option value='America/Indiana/Vincennes'>( GMT -04:00 ) Eastern Daylight Time
                                    (America/Indiana/Vincennes)</option>
                                <option value='Antarctica/Mawson'>( GMT +05:00 ) Mawson Time (Antarctica/Mawson)</option>
                                <option value='Pacific/Noumea'>( GMT +11:00 ) New Caledonia Standard Time (Pacific/Noumea)
                                </option>
                                <option value='Antarctica/Troll'>( GMT +02:00 ) Central European Summer Time (Antarctica/Troll)
                                </option>
                                <option value='Asia/Tbilisi'>( GMT +04:00 ) Georgia Standard Time (Asia/Tbilisi)</option>
                                <option value='Europe/Kyiv'>( GMT +03:00 ) Eastern European Summer Time (Europe/Kyiv)</option>
                                <option value='Europe/Samara'>( GMT +04:00 ) Samara Standard Time (Europe/Samara)</option>
                                <option value='Asia/Makassar'>( GMT +08:00 ) Central Indonesia Time (Asia/Makassar)</option>
                                <option value='Pacific/Gambier'>( GMT -09:00 ) Gambier Time (Pacific/Gambier)</option>
                                <option value='America/Argentina/San_Juan'>( GMT -03:00 ) Argentina Standard Time
                                    (America/Argentina/San_Juan)</option>
                                <option value='America/Inuvik'>( GMT -06:00 ) Mountain Daylight Time (America/Inuvik)</option>
                                <option value='America/Iqaluit'>( GMT -04:00 ) Eastern Daylight Time (America/Iqaluit)</option>
                                <option value='Antarctica/Macquarie'>( GMT +10:00 ) Macquarie Island Time (Antarctica/Macquarie)
                                </option>
                                <option value='Asia/Nicosia'>( GMT +03:00 ) Eastern European Summer Time (Asia/Nicosia)</option>
                                <option value='America/Moncton'>( GMT -03:00 ) Atlantic Daylight Time (America/Moncton)</option>
                                <option value='America/Indiana/Winamac'>( GMT -04:00 ) Eastern Daylight Time
                                    (America/Indiana/Winamac)</option>
                                <option value='Asia/Pyongyang'>( GMT +09:00 ) Pyongyang Time (Asia/Pyongyang)</option>
                                <option value='America/Boa_Vista'>( GMT -04:00 ) Amazon Standard Time (America/Boa_Vista)
                                </option>
                                <option value='Asia/Gaza'>( GMT +03:00 ) Eastern European Summer Time (Asia/Gaza)</option>
                                <option value='Asia/Atyrau'>( GMT +05:00 ) West Kazakhstan Time (Asia/Atyrau)</option>
                                <option value='Australia/Darwin'>( GMT +09:30 ) Australian Central Standard Time
                                    (Australia/Darwin)</option>
                                <option value='Asia/Khandyga'>( GMT +09:00 ) Yakutsk Standard Time (Asia/Khandyga)</option>
                                <option value='Asia/Famagusta'>( GMT +03:00 ) Eastern European Summer Time (Asia/Famagusta)
                                </option>
                                <option value='Asia/Qyzylorda'>( GMT +05:00 ) East Kazakhstan Time (Asia/Qyzylorda)</option>
                                <option value='Asia/Thimphu'>( GMT +06:00 ) Bhutan Time (Asia/Thimphu)</option>
                                <option value='America/Yakutat'>( GMT -08:00 ) Alaska Daylight Time (America/Yakutat)</option>
                                <option value='America/Kentucky/Louisville'>( GMT -04:00 ) Eastern Daylight Time
                                    (America/Kentucky/Louisville)</option>
                                <option value='America/Ciudad_Juarez'>( GMT -06:00 ) Mountain Daylight Time
                                    (America/Ciudad_Juarez)</option>
                                <option value='America/Argentina/Tucuman'>( GMT -03:00 ) Argentina Standard Time
                                    (America/Argentina/Tucuman)</option>
                                <option value='Asia/Kabul'>( GMT +04:30 ) Afghanistan Time (Asia/Kabul)</option>
                                <option value='Asia/Ho_Chi_Minh'>( GMT +07:00 ) Indochina Time (Asia/Ho_Chi_Minh)</option>
                                <option value='Antarctica/Casey'>( GMT +08:00 ) Casey Time (Antarctica/Casey)</option>
                                <option value='Pacific/Tongatapu'>( GMT +13:00 ) Tonga Standard Time (Pacific/Tongatapu)
                                </option>
                                <option value='America/New_York'>( GMT -04:00 ) Eastern Daylight Time (America/New_York)
                                </option>
                                <option value='Atlantic/Azores'>( GMT +00:00 ) Azores Summer Time (Atlantic/Azores)</option>
                                <option value='Europe/Vienna'>( GMT +02:00 ) Central European Summer Time (Europe/Vienna)
                                </option>
                                <option value='America/Nuuk'>( GMT -01:00 ) Western Greenland Summer Time (America/Nuuk)
                                </option>
                                <option value='Europe/Ulyanovsk'>( GMT +04:00 ) Ulyanovsk Standard Time (Europe/Ulyanovsk)
                                </option>
                                <option value='America/Merida'>( GMT -06:00 ) Central Standard Time (America/Merida)</option>
                                <option value='Pacific/Pitcairn'>( GMT -08:00 ) Pitcairn Time (Pacific/Pitcairn)</option>
                                <option value='America/Mazatlan'>( GMT -07:00 ) Mexican Pacific Standard Time (America/Mazatlan)
                                </option>
                                <option value='EET'>( GMT +03:00 ) Eastern European Summer Time (EET)</option>
                                <option value='Pacific/Nauru'>( GMT +12:00 ) Nauru Time (Pacific/Nauru)</option>
                                <option value='Europe/Tirane'>( GMT +02:00 ) Central European Summer Time (Europe/Tirane)
                                </option>
                                <option value='Asia/Kolkata' selected>( GMT +05:30 ) India Standard Time (Asia/Kolkata)</option>
                                <option value='MET'>( GMT +02:00 ) Middle Europe Summer Time (MET)</option>
                                <option value='America/Fort_Nelson'>( GMT -07:00 ) Mountain Standard Time (America/Fort_Nelson)
                                </option>
                                <option value='Australia/Broken_Hill'>( GMT +09:30 ) Australian Central Standard Time
                                    (Australia/Broken_Hill)</option>
                                <option value='Europe/Riga'>( GMT +03:00 ) Eastern European Summer Time (Europe/Riga)</option>
                                <option value='America/Caracas'>( GMT -04:00 ) Venezuela Time (America/Caracas)</option>
                                <option value='Asia/Hebron'>( GMT +03:00 ) Eastern European Summer Time (Asia/Hebron)</option>
                                <option value='Africa/Abidjan'>( GMT +00:00 ) Greenwich Mean Time (Africa/Abidjan)</option>
                                <option value='Africa/Monrovia'>( GMT +00:00 ) Greenwich Mean Time (Africa/Monrovia)</option>
                                <option value='Asia/Ust-Nera'>( GMT +10:00 ) Vladivostok Standard Time (Asia/Ust-Nera)</option>
                                <option value='America/Santarem'>( GMT -03:00 ) Brasilia Standard Time (America/Santarem)
                                </option>
                                <option value='America/Asuncion'>( GMT -04:00 ) Paraguay Standard Time (America/Asuncion)
                                </option>
                                <option value='Asia/Srednekolymsk'>( GMT +11:00 ) Srednekolymsk Time (Asia/Srednekolymsk)
                                </option>
                                <option value='America/Boise'>( GMT -06:00 ) Mountain Daylight Time (America/Boise)</option>
                                <option value='America/North_Dakota/New_Salem'>( GMT -05:00 ) Central Daylight Time
                                    (America/North_Dakota/New_Salem)</option>
                                <option value='Asia/Anadyr'>( GMT +12:00 ) Anadyr Standard Time (Asia/Anadyr)</option>
                                <option value='Australia/Melbourne'>( GMT +10:00 ) Australian Eastern Standard Time
                                    (Australia/Melbourne)</option>
                                <option value='Pacific/Guam'>( GMT +10:00 ) Chamorro Standard Time (Pacific/Guam)</option>
                                <option value='Asia/Irkutsk'>( GMT +08:00 ) Irkutsk Standard Time (Asia/Irkutsk)</option>
                                <option value='Atlantic/Bermuda'>( GMT -03:00 ) Atlantic Daylight Time (Atlantic/Bermuda)
                                </option>
                                <option value='America/Dawson'>( GMT -07:00 ) Pacific Standard Time (America/Dawson)</option>
                                <option value='America/Costa_Rica'>( GMT -06:00 ) Central Standard Time (America/Costa_Rica)
                                </option>
                                <option value='America/Winnipeg'>( GMT -05:00 ) Central Daylight Time (America/Winnipeg)
                                </option>
                                <option value='America/Indiana/Knox'>( GMT -05:00 ) Central Daylight Time (America/Indiana/Knox)
                                </option>
                                <option value='America/North_Dakota/Beulah'>( GMT -05:00 ) Central Daylight Time
                                    (America/North_Dakota/Beulah)</option>
                                <option value='Atlantic/Faroe'>( GMT +01:00 ) Western European Summer Time (Atlantic/Faroe)
                                </option>
                                <option value='Asia/Amman'>( GMT +03:00 ) Eastern European Standard Time (Asia/Amman)</option>
                                <option value='SystemV/AST4ADT'>( GMT -03:00 ) Atlantic Daylight Time (SystemV/AST4ADT)</option>
                                <option value='America/Maceio'>( GMT -03:00 ) Brasilia Standard Time (America/Maceio)</option>
                                <option value='Asia/Tokyo'>( GMT +09:00 ) Japan Standard Time (Asia/Tokyo)</option>
                                <option value='Pacific/Apia'>( GMT +13:00 ) Apia Standard Time (Pacific/Apia)</option>
                                <option value='Pacific/Niue'>( GMT -11:00 ) Niue Time (Pacific/Niue)</option>
                                <option value='Australia/Lord_Howe'>( GMT +10:30 ) Lord Howe Standard Time (Australia/Lord_Howe)
                                </option>
                                <option value='Europe/Dublin'>( GMT +01:00 ) Irish Standard Time (Europe/Dublin)</option>
                                <option value='America/Toronto'>( GMT -04:00 ) Eastern Daylight Time (America/Toronto)</option>
                                <option value='Asia/Singapore'>( GMT +08:00 ) Singapore Standard Time (Asia/Singapore)</option>
                                <option value='Australia/Lindeman'>( GMT +10:00 ) Australian Eastern Standard Time
                                    (Australia/Lindeman)</option>
                                <option value='America/Los_Angeles'>( GMT -07:00 ) Pacific Daylight Time (America/Los_Angeles)
                                </option>
                                <option value='America/Monterrey'>( GMT -06:00 ) Central Standard Time (America/Monterrey)
                                </option>
                                <option value='America/Argentina/Buenos_Aires'>( GMT -03:00 ) Argentina Standard Time
                                    (America/Argentina/Buenos_Aires)</option>
                                <option value='America/Jamaica'>( GMT -05:00 ) Eastern Standard Time (America/Jamaica)</option>
                                <option value='Pacific/Guadalcanal'>( GMT +11:00 ) Solomon Islands Time (Pacific/Guadalcanal)
                                </option>
                                <option value='Europe/Athens'>( GMT +03:00 ) Eastern European Summer Time (Europe/Athens)
                                </option>
                                <option value='Asia/Bishkek'>( GMT +06:00 ) Kyrgyzstan Time (Asia/Bishkek)</option>
                                <option value='Atlantic/Stanley'>( GMT -03:00 ) Falkland Islands Standard Time
                                    (Atlantic/Stanley)</option>
                            </select></td>
                    </tr>
                    <tr>
                        <td style='width:100%;'><input type='text' style='width:100%;' maxlength='40' name='NAME' placeholder="First Name"></input>
                        </td>
                    </tr>
                    <tr>
                        <td style='width:100%;'><input type='text' style='width:100%;' maxlength='100' name='REGISTRATIONCF1' placeholder="Last Name"></input></td>
                    </tr>
                    <tr>
                        <td style='width:100%;'><input type='text' style='width:100%;' maxlength='251' name='EMAIL' placeholder="Email *"></input>
                        </td>
                    </tr>
                    <tr>
                        <td style='width:100%;'><input type='text' style='width:100%;' maxlength='100'
                                name='REGISTRATIONCF7' placeholder="Phone *"></input></td>
                    </tr>
                    <tr>
                        <td style='width:100%;'>
                            <select style='width:100%;' name='REGISTRATIONCF16'>
                                <option value="">Help us identify yourself</option>
                                <option value='4248645000000321033'>I am past &#x2f; current Emertxe Student</option>
                                <option value='4248645000000321035'>I am past &#x2f; current Emertxe Intern</option>
                                <option value='4248645000000321037'>Newbie</option>
                            </select>
                        </td>
                    </tr>
                    <script
                        type='text/javascript'>
                        handleRecurringDateTimeChange(document.querySelector('#recurringAllDateTime'));

                        function handleRecurringDateTimeChange(el) {
                            var selected = document.querySelector('#recurringAllDateTime') && document.querySelector('#recurringAllDateTime').options && document.querySelector('#recurringAllDateTime').options[el.selectedIndex];
                            if (selected) {
                                var entityId = selected.getAttribute('data-campaignid');
                                var sysIdSel = '[name="sysId"]';
                                document.querySelector(sysIdSel).value = entityId;
                            }
                        }
                    </script>
                    <tr>
                        <td colspan='2' align='center' class="buttons"> 
                            <input style='font-size:12px;color:black' type='submit' name='save'
                                value='Submit'></input> 
                                <input type='reset' name='reset' style='font-size:12px;color:black'
                                value='Reset'></input> 
                            </td>
                    </tr>
                </table>
                <script>
                    var mndFileds = new Array('NAME', 'REGISTRATIONCF1', 'EMAIL', 'REGISTRATIONCF7', 'REGISTRATIONCF16');
                    var fldLangVal = new Array('First Name', 'Last Name', 'Email', 'Phone', 'Help us identify yourself');
                    var name = '';
                    var email = '';

                    function reloadImg() {
                        document.getElementById('imgid').src = document.getElementById('imgid').src;
                    }

                    function checkMandatory4248645000000321016() {
                        var emailPattern = /^([^\s@<>]{1,200})@([^\s@<>]{1,300})$/;
                        for (i = 0; i < mndFileds.length; i++) {
                            var fieldObj = document.forms['WebForm4248645000000321016'][mndFileds[i]];
                            if (fieldObj) {
                                if (((fieldObj.value).replace(/^\s+|\s+$/g, '')).length == 0) {
                                    alert(fldLangVal[i] + ' cannot be empty.');
                                    fieldObj.focus();
                                    return false;
                                } else if (fieldObj.nodeName == 'SELECT') {
                                    if (fieldObj.options[fieldObj.selectedIndex].value == '-None-') {
                                        alert(fldLangVal[i] + ' cannot be none.');
                                        fieldObj.focus();
                                        return false;
                                    }
                                } else if (fieldObj.type == 'checkbox') {
                                    if (fieldObj.checked == false) {
                                        alert('Please accept  ' + fldLangVal[i]);
                                        fieldObj.focus();
                                        return false;
                                    }
                                } else if (mndFileds[i] == 'EMAIL' && fieldObj.value && !(emailPattern.test(fieldObj.value))) {
                                    fieldObj.focus();
                                    return false;
                                }
                                if (fieldObj.type == 'text') {
                                    fieldObj.value = fieldObj.value.trim();
                                }
                                try {
                                    if (fieldObj.name == 'Last Name') {
                                        name = fieldObj.value;
                                    }
                                } catch (e) {}
                            }
                        }
                    }
                </script>
            </form>
        </div>

        <div class="wsa-upcoming-webinar-registered">
            <img src="<?php echo get_stylesheet_directory_uri() . '/assets/image/webinar-fire-icon.png' ?>" alt="" class="image-icon">
            <span><?php echo get_field('webinar_registered_people_number'); ?></span>
            <p><?php echo get_field('webinar_registered_people_text'); ?></p>
        </div>

    </div>
    <?php

    $current_post = get_post();

    // Check if it's a webinar post type
    if ($current_post->post_type == 'webinar') {
        // Check if the current post has the term with slug 'upcoming' in 'webinar_category' taxonomy
        $terms = wp_get_post_terms($current_post->ID, 'webinar_category');
        foreach ($terms as $term) {
            if ($term->slug == 'upcoming') {
    ?>
                <div class="wsa-mobile-footer-cta-section wsa-mobile-footer-cta-section-webinar">
                    <div class="wsa-mobile-footer-cta-webinar">
                        <button class="wsa-cta-reginster-button-webinar">Register now!</button>
                    </div>
                </div>
    <?php
            }
        }
    }



    ?>

    <script>
        (function($) {
            "use strict";
            $(document).ready(function() {

                $('.wsa-cta-reginster-button-webinar').click(function() {
                    $('.wsa-webinar-register-form-mobile').addClass('webinar-popup');
                });

                $('.wsa-webinar-register-form-mobile-icon').click(function() {
                    $('.wsa-webinar-register-form-mobile').removeClass('webinar-popup');
                });

            });
        }(jQuery));
    </script>
<?php
    return ob_get_clean();
}
add_shortcode('wsa_zoho_individual_webinar_register_2', 'wsa_zoho_individual_webinar_register_2_form_sc');
