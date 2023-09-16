<?php
/***************************************************************************
 *                      lang_prillian_faq.php [German]
 *                            -------------------
 *   begin                : Friday, May 30, 2003
 *   version              : 1.1.0
 *   date                 : 2003/12/23 23:23
 ***************************************************************************/

// 
// To add an entry to your FAQ simply add a line to this file in this format:
// $faq[] = array('question', 'answer');
// If you want to separate a section enter
// $faq[] = array('--', 'Block heading goes here if wanted');
// Links will be created automatically
//
// DO NOT forget the ; at the end of the line.
// Do NOT put single quotes (') in your FAQ entries, if you absolutely must then
// escape them i.e.. \'something\' or use double quotes (") at the beginning and end
// of the entries (in which case you'll need to escape any double quotes in the
// entry).
//
// The FAQ items will appear on the FAQ page in the same order they are listed in
// this file
//
// To mention Prillian by the name you've set in lang_prillian.php, use the variable
// $progname as it is used in the defaults
//
//
include_once($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_prillian.' . $phpEx);


$progname = $lang['Prillian'];

$faq[] = array('--', 'Allgemeine Fragen- (FAQ)');
$faq[] = array('Was ist ' . $progname . '?', $progname . ' ist ein Webbasierer Chat- Messenger, der registierete Benutzern voraussetzt, damit kann man leicht und schnell mit anderen in Verbindung treten. Er ist mit anderen Chat- Messengern, die Sie vorher verwendet haben k�nnen, sehr �hnlich, aber die Benutzer werden im Allgemeinen auf andere Mitglieder dieses Forums begrenzt');
$faq[] = array('Muss ich die Software downloaden, um ' . $progname . ' verwenden zu k�nnen?', 'Nein, es gibt keine Software zu downloaden. Die ' . $progname . '- Software l�uft auf dieser Webseite. Sie k�nnen durch ihren Zugang die Software nutzen per Webbrowser, wie jede normale Webseite oder das Forum selbst.');
$faq[] = array('Mu� ich registriert sein in den Foren um ' . $progname . ' verwenden zu k�nnen?', 'Ja. ' . $progname . ' ist ein Teil des Forums und Gebraucht die gleiche Benutzereinstellung. Es benutzt auch Teile des PM- Systems, das in die Foren errichtet wird. Sie k�nnen den Messenger nicht verwenden, wenn Sie nicht eingelogt oder registriert haben.');
$faq[] = array('Mu� ich st�ndig Online mit dem Board bleiben, um ' . $progname . 'verwenden zu k�nnen?', 'Nein, das brauchen Sie nicht. Solange Sie das ' . $progname . '- Fenster ge�ffetist k�nnen Sie normal Ihre Interentt�tigkeiten fortsetzen. Halten Sie den Webbrowser offen, der Messenger arbeitet in Ihrem Webbrowser, wenn Sie Ihren Webbrowser schliessen, ist der Messenger beendet.');
$faq[] = array('Gibt es speziellen Einstellungen, die mein Browser benutzen mu� bei ' . $progname . '?', $progname . ' Steuereigenschaften wie automatisches �ffnen der neuen Fenster zur Verf�gung zu stellen. Es wird empfohlen, da� Sie diese Optionen aktiviert haben, die f�r diese Webseite ben�tigt wird. Wenn Sie diese Option nicht aktiviert haben k�nnen Sie den Messenger trotzdem verwenden. Einige Eigenschaften k�nnen aber m�glicherweise nicht richtig arbeiten.');
$faq[] = array('Wie mache ich mir ' . $progname . 'zug�nglich?', 'Zuerst m�ssen Sie sich registriert und eingeloggt haben auf den Foren. Auf den Foren des Boards kann sich' . $progname . ' automatisch �ffnen, wenn Sie das Forum besuchen\'s auf der Index- Seite. Wenn der Messenger sich nicht automatisch �ffnet, suchen Sie nach dem Link "' . $lang['Launch_phpBB_IM'] . '," "' . $lang['Who_is_Online'] . '," oder �hnlich. Wenn es eine neue Sofortantwort (IM) gibt kann diese Verbindung angeben, da� Sie eine neue IM haben. Klicken Sie diesen Link an, so �ffnet es nun ein neues Browserfenster. Dieses Fenster, genannt "IM Client," erlaubt Ihnen ' . $progname . 'zug�nglich zu machen.');
$faq[] = array('Ich machte alles, aber das Fenster hat irgendeine sonderbare Fehlermeldung. Warum?', 'Es gibt einige m�gliche Antworten. Es kann sein, da� das Board vor�bergehend die Software gesperrt hat (vielleicht f�r ein Upgrade). Es ist auch m�glich, da� der Administrator Sie vom Verwenden der Software gebannt hat. Sie taten nichts schlimmes?<br /><br />Es ist auch m�glich, da� Sie die Software vorher sich sperrten. In diesem Fall der Fehlermeldung sollte Verbindung zum Programmierer aufgenommen werden, damit Sie mit der Software wieder benutzen k�nnen.');
$faq[] = array('O.K., Ich habe den Klienten IM ge�ffnet. Was jetzt?', 'Vom IM- Klientfenster aus k�nnen Sie vieles tun. Sie sollten eine Liste der Benutzer sehen, die z.Z. Online sind. Sie k�nnen diesen Benutzern eine Sofortnachricht schicken. Sie k�nnen Nachrichten auch anderen Benutzern schicken, empfangen Sie Nachrichten, Nachrichtstexte die Sie empfangen haben in der Vergangenheit, machen Sie die Kontaktlisten- Oberfl�che  zug�nglich, und wenn der Administrator gew�hrt, machen Sie sich Ihre Nachrichteneinstellungen zug�nglich.');
$faq[] = array('Wie empfange ich Nachrichten?', 'Der IM- Klient �berpr�ft automatisch Nachrichten regelm��ig. Zu mehr Information lesen Sie den folgenden Abschnitt dieser FAQ.');

$faq[] = array('--', 'Verwendung des IM- Klienten');
$faq[] = array('Ich sehe eine Menge Bilder in diesem Fenster. Was bedeuten sie?', 'Die Kontrolloberfl�che des IM- Klienten erlaubt Ihnen �ber die Eigenschaften des Messenger Anpassungen vorzunehmen. Darunter ist eine Auflistung von Bildern, die Sie in den IM- Klienten sehen k�nnen und was sie darstellen. Merken Sie sich die Bedeutung der Bilder wenn Sie das Theme �ndern, das Standart verwendet wird von ' . $progname . '. Sie k�nnen auch erlernen, was ein Bild darstellt indem Sie die Maus �ber das Bild bewegen. Es kann auch im Satz Textverbindungen geben, die �hnliche Funktionen zu diesen Bildern haben, abh�ngig von Ihren Eigenschaften.<br /><br /><table border="1" width="100%" cellpadding="5" cellspacing="0"><tr><td width="15%" align="center"><img src="' . $images['prill_buddies'] . '"></td><td class="gen">' . $lang['Alt_Contact_Man'] . '</td><td class="gen">Dieses �ffnet die Kontakt-Management- Oberfl�che in einem anderen Browserfenster.</td></tr><tr><td align="center"><img src="' . $images['prill_closewin'] . '"></td><td class="gen">' . $lang['Alt_Close_Windows'] . '</td><td class="gen">Kleine Fenster k�nnen ge�ffnete, gelesene Nachrichten, Nachrichten senden, und Nachrichtenprotokollfenster erm�glichen.</td></tr><tr><td align="center"><img src="' . $images['prill_home'] . '"></td><td class="gen">' . $lang['Alt_Home'] . '</td><td class="gen">�ffnen Sie den Forumindex dieser Webseite in einer Browserfenster.</td></tr><tr><td align="center"><img src="' . $images['prill_prefs'] . '"></td><td class="gen">' . $lang['Alt_Prefs'] . '</td><td class="gen">�ndern Sie Einstellungen, die beeinflussen, wie der Messenger funktioniert. Der Board- Administrator kann diese Einstellungen �ndern, in diesem Fall erscheint dieses Bild nicht.</td></tr><tr><td align="center"><img src="' . $images['prill_message'] . '"></td><td class="gen">' . $lang['Send_Message'] . '</td><td class="gen">Klicken Sie hier an, um das Nachrichtenversende- Fenster zu �ffnen.</td></tr><tr><td align="center"><img src="' . $images['prill_refresh'] . '"></td><td class="gen">' . $lang['Check_IMs'] . '</td><td class="gen">Laden Sie neu oder erneuern Sie den IM- Klienten. Das �berpr�ft auf neue Nachrichten und aktualisiert die Liste der Online- Benutzer.</td></tr><tr><td align="center"><img src="' . $images['prill_logout'] . '"></td><td class="gen">' . $lang['Alt_Logout'] . '</td><td class="gen">Zus�tzlich zudem schlie�t der IM- Klient und das kleine Fenster.</td></tr><tr><td align="center"><img src="' . $images['prill_log'] . '"></td><td class="gen">' . $lang['Alt_Message_Log'] . '</td><td class="gen">Sehen Sie eine Liste der Nachrichten, die Sie empfangen oder gesendet haben. Sie k�nnen einzelne Nachrichten vom Nachrichtenprotokoll auch ansehen.</td></tr><tr><td align="center"><img src="' . $images['prill_offsite'] . '"></td><td class="gen">Off-Site Benutzer</td><td class="gen">Dieser Benutzer ist von einem anderen Ort. In einigen Browsern k�nnen Sie mit Ihrer Maus �ber dem Bild schweben, um vom den Ursprung des Benutzers festzustellen.</td></tr><tr><td align="center"><img src="' . $images['prill_onsite'] . '"></td><td class="gen">On-Site User</td><td class="gen">Dieser Benutzer ist von diesem Ort wie Sie.</td></tr><tr><td align="center"><img src="' . $images['prill_help'] . '"></td><td class="gen">Help</td><td class="gen">Machen Sie diese FAQ- Seite zug�nglich.</td></tr></table><br /><br />Zu mehr Information �ber On-Sitee und Off-Sitee Benutzer, sehen Sie den Abschnitt dieser FAQ erlaubten "Site-to-Site Nachrichten�bermittlung."');
$faq[] = array('Was sind andere Sachen im IM- Klienten?', 'Abh�ngig von, wie der Board-Administrator die Software aufgestellt hat, k�nnen Sie eine Reihe von Informationen �ber die Benutzer auf den Foren und dem Messenger z.Z. sehen. Dies kann die Zahl aN Online- Benutzern einschlie�en, versteckte Benutzer und Gastbenutzer.<br /><br />Es gibt wahrscheinlich ein oder zwei Bl�cke der Benutzernamen nahe bei Off-Site oder Awesend Benutzer- Icons und gesendet- Anzeige- Icons. Diese sind Benutzer, die z.Z. Online sind. Wenn ein anwensender Benutzername wird <em>so</em> angezeigt, dann verwendet dieser Benutzer auch den Messenger zur Zeit. Alle m�gliche angezeigten Off-Site Benutzer verwenden auch den Messenger zur Zeit. Wenn die Moderatoren oder die Admins dieser Webseite verzeichnet werden, so erscheinen ihre Namen in den unterschiedlichen Farben, anders wie von den normalen Benutzern zu erkennen. Wenn Sie die Absendenanzeige- Icons nahe bei dem Namen eines Benutzers klicken, das absenden- Fenster �ffnet sich mit dem Namen dieses Benutzers, der in dem "Benutzername" eingetragen ist, empfangen. Sie k�nnen Namen jedes m�glichen Benutzers anklicken, um dieses Benutzerforumprofil anzusehen.');
$faq[] = array('Wie empfange ich neue Nachrichten?', 'Regelm��ig l�dt der IM- Klient IM automatisch neu, um auf neue Nachrichten zu �berpr�fen und die Liste der Online-Benutzer zu aktualisieren. Wenn das beim IM- Klient geschieht, nach v�llig neu laden, kann Ihre Anzeige abh�ngig von Ihren Benutzereinstellungen und Javascripteinstellungen des Browser anzeigen. Der IM- Klient kann neue Nachrichten automatisch �ffnen, klein im Nachrichten- Fenster. Auch der IM- Klient kann neue und ungelesene Nachrichten im IM- Klient- Fenster selbst verzeichnen. Wenn Nachrichten im IM- Klienten verzeichnet werden, sehen Sie eine verk�rzte Version der  Themenanzeige und des Namens vom Absender. Klicken Sie zur Anzeige abh�ngig von ge�ffnetem eine Anzeige in einem neuen gelesenen Nachrichten- Fenster.<br /><br />Abh�ngig von Ihren Benutzereinstellungen des IM- Klienten kann auf nur neue sofortige Anzeigen oder auf sofortige Anzeigen und private Anzeigen �berpr�fen. Wenn, aus irgendeinem Grund der IM- Klient nicht automatisch neu laden kann, k�nnen Sie die �berpr�fung anklicken, damit IM- Links oder Icons den IM- Klienten manuell neu geladen werden k�nnen.');
$faq[] = array('Wie l�sche ich alte Nachrichten?', 'Abh�ngig von Ihren Benutzereinstellungen k�nnen sofortige Anzeigen automatisch gel�scht werden, sobald sie im IM-Klient gelesen worden sind. Sie k�nnen neue und ungelesene, sofortige oder private Nachrichten aus der Liste im IM- Klienten auch l�schen. PM`s die Sie bereits gelesen haben k�nnen nicht aus dem IM- Klienten gel�scht werden (es seidenn im IM-Klienten und vor den neuladen des IM- Klienten gel�scht worden).');

$faq[] = array('--', 'Benutzerpr�ferenzen');
$faq[] = array('Wie �ndere ich meine Einstellungen?', 'Alle Ihre Einstellungen werden in der Datenbank gespeichert. Zum �ndern Klicken Sie <u>Einstellungen</u> Link oder Icon (im allgemeinen an der Unterseite oder an der Oberseite des Messenger- Klienten aber dieser kann m�glicherweise nicht der Fall sein). Dieses erlaubt Ihnen alle Ihre Einstellungen zu �ndern.');
$faq[] = array('Ich klickte die Link an, aber es sagt etwas �ber den Administrator, der etwas �ndert. Was?', 'Boardadministratoren haben die Wahl die Benutzerpr�ferenzen zu �ndern. Wenn diese Wahl erm�glicht wird, Benutzerpr�ferenzen k�nnen nicht ge�ndert werden ausgenommen einen Boardadministrator. Sie Sind nicht in der Lage, die Pr�ferenzen Ihre Einstellungen dann zu �ndern.');
$faq[] = array('Es gibt eine Menge Einstellungen hier. Was ist alles m�glich?', 'Viele der Benutzerpr�ferenzen sollten selbsterk�rend sein. Unten ist eine Zusammenfassung von einigen Auswahlen, die mehr Details erfordern k�nnen.<br /><br /><table border="1" width="100%" cellpadding="5" cellspacing="0"><tr><td class="gen" width="25%">Verzeichnis der Sounddatein</td><td class="gen">Die Sounddatein- Optionen erlauben Ihnen, einen neuen Ton zu spielen, wenn Sie neue Nachrichten empfangen. Sie k�nnen beschlie�en, irgendeinen Ton  abspielen zu lassen, der von dieser Webseite bereitgestellt werden oder ein Ton auf Ihrem eigenen Computer. Klicken Sie "Browse..." - Button an, um eine Sounddatei auf Ihrem Computer zu spezifizieren. Die Position dieser Sounddatei wird in dieser Webseitendatenbank gespeichert. Wenn Sie die Sounddatei zu einem sp�teren Zeitpunkt verschieben, vergessen Sie nicht, diese Einstellung zu aktualisieren.</td></tr><tr><td class="gen">Listen Sie die Benutzer im Hauptfenster</td><td class="gen">Die Optionen hier erlauben Ihnen �ndernungen  welche Benutzer im IM- Klienten angezeigt werden. Sie k�nnen beschlie�en, alle Benutzer auf den Foren zu verzeichnen, alle Benutzer auf dem Messenger, nur Freunde auf den Foren, oder nur Freunde auf dem Messenger.</td></tr><tr><td class="gen">W�hlen Sie eine Methode f�r Online- Benutzer anzeigen an anderen Aufstellungsorten</td><td class="gen">Diese Optionen erlauben Ihnen, zu spezifizieren, wie Abwsende Benutzer im IM- Klienten angezeigt werden. Sie k�nnen beschlie�en, sich nicht allen anzuzeigen, sie in einem unterschiedlichen Kasten von den On-Site- Benutzern anzeigen, oder innen gemischt mit den On-Site- Benutzern. Erinnern Sie sich, die verzeichneten Off-Site- Benutzer sind immer Benutzer auf dem Messenger.</td></tr></table>');
$faq[] = array('Wichtiges zu denEinstellungen', 'Es gibt einige Sachen die wichtig f�r Sie sind in den Benutzerpr�ferenzen und -einstellungen. Zuerst geben Sie acht, wenn Sie die m�gliche Einstellungen �ndern. Das das �ndern von Einstellungen kann Sie am Verwenden der Teile des Messngers hindern. Zweitens wenn Sie einen Ton auf das empfangen der neuen Nachrichten nutzen es ist besser einen Ton auf Ihrem eigenen Computer abspielen zu lassen. Der Ton l�dt (und folglich spielt) schneller, als wenn der Messenger ihn von der Web site downloaden mu�.');


$faq[] = array('--', 'Posting- Ausgaben');
$faq[] = array('Wie sende ich Nachrichten?', 'Das ist ganz einfach. Klicken Sie den "Absenden"- Button oder den Link (entweder nahe bei einem Benutzernamen oder in den Kontrollen) an um das Absenden- Fenster zu �ffnen. Hier Sind Sie in der Lage, eine Nachricht zu schreiben um sie einem anderen Benutzer zu schicken. W�nschen Sie eine Nachricht einem anderen Benutzer schicken m�chten dann �ndern sie den Namen im Benutzerfeld.<br /><br />Merken Sie bitte, da� Sie eine Nachricht durch das klicken auf der Icon oder Link nahe bei dem Namen eines Off-Site- Benutzers vom gleichen Webseite nur schicken k�nnen einem Off-Site- Benutzer auf einem bestimmten Webseite. Ebenso k�nnen Sie eine Nachricht nur schicken einem On-Site- Benutzer, indem Sie den Link oder das Ikone in den Kontrollen oder nahe bei einem On-Site- Benutzer anklicken. Das Antworten auf eine Nachricht erlaubt Ihnen, eine Nachricht der gleichen Art auch zu senden.');
$faq[] = array('Ich bin im "Nachricht absenden"- Fenster. Was kann ich dort alles machen?', 'Das absenden- Fenster hat viele Eigenschaften. Nahe bei dem Benutzername haben Sie zwei Button, die Ihnen erlauben einen Benutzer oder einen Freund schnell zu finden, wo Sie denen eine Nachricht schicken k�nnen. Das Thema ist selbst w�hlbar. Es gibt BB- Code und Schriftarten, die jenen vorhandenen �hnlich sind, wenn man ein Thema bekanntgibt, sowie die Option Post zuspeichern und anderes zu deaktivieren. Es kann eine Liste von Smilies auch unten geben. Schlie�lich gibt es ein "Nachrichten speichern"- Checkbox, welches eine Kopie der Nachricht in Ihrem PM-Fach abspeichert, wenn es erfolgreich gesendet wird.<br /><br />Einige Eigenschaften k�nnen deaktiviert sein, wenn sie einem Off-Site- Benutzer eine Nachricht schicken.');
$faq[] = array('Kann ich BB-Code, Smiley, HTML, Signaturen, und Bilder verwenden in einer Sofortnachricht?', 'Sie k�nnen, wenn es der Boardadministrator erlaubt. Die Einstellungen f�r diese Optionen sind dieselben wie die auf dem Board (z.B. wenn Sie BB- Code auf dem Board verwenden k�nnen, k�nnen Sie es in den Sofortnachrichten verwenden).');

$faq[] = array('--', 'Nachrichten lesen');
$faq[] = array('Ich lese eine Nachricht. Was kann ich dort alles machen?', 'Es gibt zwei Optionen im Nachrichten lesen-  Fenster, die erkl�rt werden m�ssen, man kann: "speichern und schlie�en" und "speichern und antworten" Tasten nutzen. Das Anklicken irgendeiner dieser Tasten speichert eine Kopie in Ihrem PM- Postfach. Es ist n�tzlich, wenn automatische Auslassung der gelesenen Nachrichten eingeschaltet wird. "schlie�en" und "Antwort"- Teile dieser Buttons sollten einfach zu verstehen sein.<br /><br />abh�ngig vom Aufstellungsort des Forums kann es eine schnelle Antwortform in diesem Fenster auch geben.');
$faq[] = array('Ich erhalte unerw�nschte Nachrichten!', $progname . 'schlie�t ein Ignorieren- System ein. Sie k�nnen Benutzer ignorieren die Nachrichten senden oder mit dem Boardadministrator in Verbindung treten, der dem Benutzer bannen kann und/oder private Nachrichten�bermittlung Systeme.');

$faq[] = array('--', 'Seite-zu-Seite Nachrichten�bermittlung');
$faq[] = array('Was ist Site-to-Site Nachrichten�bermittlung?', 'Site-to-Site Nachrichten�bermittlungen ist ein spezielles System, das der Messenger hat Benutzern auf mehrfachen Websits zu kommunizieren. Alle Off-Site Benutzer die im IM- Klienten verzeichnet werden, sind wirklich Leute mit einem �hnlichen Messenger auf einem anderen Webseite. Diese Benutzer k�nnen in der Lage Sein, zu sehen, wenn Sie auf dieser Webseite Online sein. Sie k�nnen auch in der Lage Sein Ihnen eine sofortige Nachrichten �ber Site-to-Site Nachrichten�bermittlung zu schicken. Sie k�nnen ihnen eine Nachrichten au�erdem schicken.');
$faq[] = array('Das klingt recht gut, aber ich m�chte nicht ein Teil von dem sein.', 'Sie k�nnen Site-to-Site Nachrichten�bermittlung in Ihren Benutzerpr�ferenzen sperren.');
$faq[] = array('Wie schicke ich jemand auf einem anderen Webseite eine Nachricht?', 'Klicken Sie das "absenden"- Icon oder den Link nahe ihrem Namen im IM- Klienten. Wenn das absenden- Fenster sich �ffnet, tippe abwesend! Einige Eigenschaften k�nnen deaktiviert sein in den Site-to-Site Nachrichten. Auch obwohl Sie sehen k�nnen, wer auf einer anderen Webseite Online ist, Sie k�nnen nicht in der Lage Sein ihnen Nachrichten zu schicken. Sie k�nnen Nachrichten zu einer anderen Webseite nur schicken, wenn diese Webseite in der Site-to-Site Datenbank hinzugef�gt wurde.');
$faq[] = array('Warum werden diese Eigenschaften deaktiviert?', 'Das Site-to-Site- Nachrichten�bermittlung System ist noch unter Entwicklung. In der Tat die gesamte Messenger-Software ist noch unter Entwicklung.');

//
// These entries should remain in all languages and for all modifications
//
$faq[] = array('--', $progname . ' Ausgaben');
$faq[] = array('Wer schrieb diese Sofort- Messenger-Software?', 'Diese Software (in seiner unver�nderten Form) wird produziert, freigegeben, und ist Copyrighted by <a href="http://darkmods.sourceforge.net/" target="_blank">Thoul</a>. Es basiert an und schlie�t im Code von der phpBB- Forum-Software ein, welches (in seiner unver�nderten Form) produziert wird, freigegeben, und ist Copyrighted by <a href="http://www.phpbb.com/" target="_blank">phpBB Group</a>. Beide werden unter der GNU General Public Lizenz zur Verf�gung gestellt und k�nnen frei verteilt werden; besuchen Sie die Links f�r mehr Details.');
$faq[] = array('Warum ist nicht das X- Feature vorhanden?', 'Diese Software wurde geschrieben und genehmigt durch die phpBB- Gruppe (im Fall von der Forum- Software) und Thoul (im Fall des sofort- Messengers). Wenn Sie glauben, da� eine Eigenschaft im sofort- Messenger- Software hinzugef�gt werden mu�, dann bitte besucht die darkmods.sourceforge.net - Webseite und schaut dort ob dar�ber was in den Foren gesagt worden ist. Wenn nicht, geben Sie einen Eigenschafts- Antrag in dem Foren oder �ber die Sourceforge- Schnittstelle ab.');
$faq[] = array('Wem trete ich �ber bei mi�br�uchliches in Verbindung und/oder Rechtssachen bezogen auf diesem Sofortmessenger?', 'Sie sollten mit dem Administrator dieses Boards in Verbindung treten. Wenn Sie nicht wissen wer das ist, k�nnen Sie sich einem mit einem der Forummoderatoren zuerst in Verbindung treten und fragen mit wem Sie sich der Reihe nach in Verbindung treten sollten. Wenn Sie noch immer keine Antwort erhalten, sollten Sie sich mit dem Inhaber der Domain in Verbindung setzen (mit einem WHOIS nach zuschlagen) oder, wenn es auf einen freien Service l�uft,  (z.B. yahoo, free.fr, f2s.com, etc.), die Management- oder Mi�brauchsabteilung dieses Services. Merken Sie sich bitte, da� Thoul absolut keine Kontrolle hat und in keiner Weise gehaltener verantwortlicher �berschu� sein kann wie, wo oder durch wen dieses Board verwendet wird. Es ist absolut sinnlos in Verbindung tretendes Thoul in Beziehung zu irgendwie zugelassenem (h�ren Sie auf und h�ren Sie, verantwortliche, verleumderische Anmerkung, usw..) Angelegenheit nicht direkt bezogen auf den darkmods.sourceforge.net Webseite oder die getrennte Software des Sofortmessengers selbst. Wenn Sie email Thoul �ber irgendeinen Gebrauch des dritten Beteiligten von dieser Software dann tun, sollten Sie nicht eine Antwort erwarten.');

//
// This ends the FAQ entries
//

?>