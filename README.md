Grupparbete RIA2 -  PUFF
--------------------------

Tekniska krav:
	Sidomladdningar (html-fokus), AJAX-baserat (data-fokus)
	Serverstack (LAMP, MEAN eller METEOR)
	Datastrukturer (blogginlägg, kommentar, författare)
	Klient (MVC, jquery, angular) - LESS? Bootstrap? Rich Text Editor (ckeditor), markdown
	REST/URL

Man FÅR sno delmängder på nätet! Yay!

Initial diskussion: Målgrupp/User stories/GUI

En blogg där man laddar upp bilder. En admin till en början (flera registrerade användare så småningom).
När man laddat upp bilden ska man kunna redigera den med färdiga filter.
Koppla facebook-like funktion till den och kanske dela (beroende på hur svårt det är).
Enkel, stilren design. Stort, bilden i fokus.
Admin-sida. Logga in med två fält (username, pass) och en login-knapp.
Admin-sidan har fler funktioner, man kan ladda upp bilder, beskriva innehållet, skriva rubrik, knapp för att ladda upp, ett inlägg räcker (allt detta inkluderas i blogginläggskravet). Man ska kunna tagga blogginlägg med egna ämnesord. Man ska kunna redigera och ta bort blogginlägg.
Besökare ska ha en översiktssida med blogginlägg (kanske som i CASES på manifestos) med rubrik och lite text. Man ska kunna filtrerar översiktligt utifrån ämnestaggar (månader).

Målgrupp: Främst designers, fotografer eller liknande som laddar upp bilder på bloggen och vill ha input på bilder/utbyte/bekräftelse av idéer. Man ska kunna redigera (filters).
User stories: Som admin vill jag kunna ha översikt över flödet, kunna radera/redigera. Som admin vill jag på ett smidigt sätt kunna ladda upp min bild, skriva lite text och enkelt redigera bilden. Som besökare vill jag snabbt kunna se blogginnehåll och likea (kanske dela) bilderna. 
GUI: Simpel, clean, fokuset ska vara vara bilder. Få färger, Logotyp.


Github: https://github.com/berthsjo/powerpuffs


Erikas anteckningar:

What to do? (minimum-krav för godkänt)

	Admin
		Admin - admin login
		Skriva blogginlägg o bilder
		Publicera blogginlägg - Ett inlägg räcker
		Tagga blogginlägg med egna ämnesord
		Redigera blogginlägg
		Ta bort blogginlägg

	Besökare
		Översiktssida med blogginlägg -> Rubrik o lite text
		Kunna filtrera översiktliga utifrån ämnestaggar (månad text)


Tips från Peter:

HTML - Databas (timefunktion - datum)
Tänk på att ändra i länkändelserna tex: www.puff.se/blog php… login.php …admin.php
MySQL - Databas
PHP - Databaskoppling, utvisning till webben
Admin-sida, inloggning, PHP-kod för inloggning - kopplat till database
Dubbelkolla om inloggningen existerar, skriv blogginlägg, logga ut