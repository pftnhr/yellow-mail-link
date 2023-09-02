<?php
// Maillink extension, https://github.com/pftnhr/yellow-maillink

class YellowMaillink {
	const VERSION = "0.8.22";
	public $yellow;            //access to API

	// Handle initialisation
	public function onLoad($yellow) {
		$this->yellow = $yellow;
		$this->yellow->system->setDefault("MailAddress", "");
		$this->yellow->language->setDefaults(array(
			"Language: en",
			"MailLinktext: Drop me a line",
			"Language: de",
			"MailLinktext: Schreib mir ein paar Zeilen",
			"Language: fr",
			"MailLinktext: Contactez-moi",
			"Language: it",
			"MailLinktext: Lasciatemi un messaggio",
			"Language: sv",
			"MailLinktext: Skriv till mig"));
	}

	// Handle page content of shortcut
	public function onParseContentShortcut($page, $name, $text, $type) {
		$output = null;
		if ($name=="mailto" && ($type=="block" || $type=="inline")) {
			list($maillinktext, $mailaddress) = $this->yellow->toolbox->getTextArguments($text);
			if (is_string_empty($maillinktext)) $maillinktext = $this->yellow->system->get("MailLinktext");
			if (is_string_empty($mailaddress) && is_string_empty($this->yellow->system->get("MailAddress"))) {
				$mailaddress = $this->yellow->system->get("Email");
			} elseif (is_string_empty($mailaddress)) {
				$mailaddress = $this->yellow->system->get("MailAddress");
			}			
			$output .= "<a href=\"" . $this->no_spam($mailaddress) . "\">" . $maillinktext . "</a>";
		}
		return $output;
	}
	
	public function no_spam($mailaddress) {
		  $str = "";
		  $a = unpack("C*", $mailaddress);
		  foreach ($a as $b)
			 $str .= sprintf("%%%X", $b);
		  return "mailto:" . $str;
	   }
}
