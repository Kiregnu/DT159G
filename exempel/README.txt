# Några enkla exempel som kan vara till hjälp vid visualisering av öppna data.
* Rev 2022-04-04 janjon *

Fokus har varit på tydlighet och enkelhet för att visa på principerna.
För att hålla exemplen enkla så:

 - är de inte alltid i validerad HTML-kod.
 - innehåller de flesta html-filerna även js-koden.
 - använders onclick="..." istället för koppla händelselyssnare med ...addEventListener("click"..., trots att addEventListener är det som rekommenderas.


Lämplig ordning att kolla igenom dessa är:

- plott_JS			// Visualisera data hårdkodat i JS.
  - Innehåller några varianter. (Den 3:e är väl den mest rekommenderade.)
- plott_PHP		// ----------- " -------------- PHP.
  - Innehåller många olika varianter på html-koder som alla hämtar datat från samma php-fil.
  - Glöm inte att även kolla direkt på php-filen i webbläsaren, inte bara via html-koden.

och slutligen:

- tabell_kommun_CSV				//	Hämta data och visa i en tabell.
- plott_kommun, CSV och JSON	//	Hämta data (CSV eller JSON) , anpassa data, visualisera.
									Hämtning och anpassning av datat sker i PHP (körs på webbservern).
									Visualiseringen sker i JS (körs i webbläsaren).
									Observera att php-filen körs först när JS begär det med fetch (eller XMLHttpRequest).
- Glöm inte att även här kolla direkt på php-filerna i webbläsaren.

## Mappen biblo
Mappen biblo innehåller ett PHP-bibliotek, HTTPful, som innehåller funktioner för att hämta data.

## några bra PHP-kommandon
Det finns förstås mycket, men detta är några som kan hjälpa till vid felsökning. Kolla gärna i PHP-dokumentationen. https://www.php.net/manual/en/

- var_dump
- json_last_error()			// Lämpligt vid problem med t.ex. json_encode
- json_last_error_msg()	// Lämpligt vid problem med t.ex. json_encode

