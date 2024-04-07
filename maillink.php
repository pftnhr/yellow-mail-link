<?php
// Maillink extension, https://github.com/pftnhr/yellow-maillink

class YellowMaillink {
	const VERSION = "0.9.1";
	public $yellow;            //access to API

	// Handle initialisation
	public function onLoad($yellow) {
		$this->yellow = $yellow;
		$this->yellow->system->setDefault("MaillinkAddress", "Insert your desired email address or remove this string");
		$this->yellow->language->setDefaults([
			"Language: en",
            "MaillinkText: Drop me a line",
			"Language: de",
			"MaillinkText: Schreib mir ein paar Zeilen",
            "Language: sv",
            "MaillinkText: Hör av dig",
            "Language: fr",
            "MaillinkText: Contactez-moi",
			"Language: it",
			"MaillinkText: Lasciatemi un messaggio",
		]);
	}

	// Handle page content of shortcut
	public function onParseContentElement($page, $name, $text, $attributes, $type) {
		$output = null;
		if ($name=="mailto" && ($type=="block" || $type=="inline")) {
			list($maillinktext, $maillinkimage) = $this->yellow->toolbox->getTextArguments($text);
			$mailaddress = $this->yellow->system->get("MailAddress");
			if (is_string_empty($maillinktext)) $maillinktext = $this->yellow->language->getText("MaillinkText");
			if (is_string_empty($mailaddress)) $mailaddress = $this->yellow->system->get("Email");
			if (preg_match("/\.(jpg|jpeg|png|gif|svg)$/i", $maillinkimage)){
				$output .= "<a href=\"" . $this->no_spam($mailaddress) . "\"><img src=\"/media/images/" . $maillinkimage . "\" title=\"" . $maillinktext . "\" alt=\"" . $maillinktext . "\" /></a>";
			} elseif (is_string_empty($maillinkimage)) {
				$output .= "<a href=\"" . $this->no_spam($mailaddress) . "\">" . $maillinktext . "</a>";
			}
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