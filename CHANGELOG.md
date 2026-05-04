# Changelog

## 1.0.2 – 2026-05-03

UI-Verbesserungen basierend auf Kirks Feedback:

- **ACP-Seite**: Wrapping mit `overall_header.html` / `overall_footer.html` direkt im Body-Template – behebt den weißen Hintergrund auf Installationen, bei denen `adm_page_header()` verschluckt wird
- **Frontend ASCII/BBCode**: Werden jetzt im phpBB-Style gerendert (über `controller.helper::render()`) statt als rohes `text/plain`. Damit erscheint der Baum auch auf der öffentlichen Seite mit Forum-Header/Footer und korrektem Theme – nicht mehr unstyled auf weißem/schwarzem Hintergrund
- **Format-Toggle**: HTML-Frontend hat jetzt – wie das ACP – eine durchgängige Format-Umschaltleiste (HTML | ASCII | BBCode), aktiver Modus wird hervorgehoben
- **Codebereinigung**: `Symfony\HttpFoundation\Response`-Import entfernt (wird nicht mehr benötigt)

## 1.0.1 – 2026-05-03

Bugfixes und Code-Qualität (basierend auf Feedback von Kirk und phpBB Ext Check):

- **Frontend-Link**: Neuer Event-Listener fügt einen Link „Forenbaum" in die Hauptnavigation ein (`overall_header_navigation_append`)
- **Coding Style**: Alle PHP-Dateien jetzt durchgängig im Allman-Brace-Stil (öffnende `{` auf eigener Zeile) – konform zu phpBB PHP Strict Standards
- **`license.txt`**: Wieder hinzugefügt – wird vom phpBB Extension Pre Validator zwingend erwartet
- **`ext.php`**: Enthält jetzt einen sinnvollen `is_enableable()`-Check für die phpBB-Mindestversion (3.3.0)
- **HTML-Templates**: Indentation auf Tabs umgestellt (Kirks Hinweis)
- **`acp/main_module.php`**: Unused-Parameter-Warnings unterdrückt durch explizites `unset($id, $mode)`

## 1.0.0 – 2026-05-02

- Initial public release
- Frontend route `/app.php/forumtree` mit ACL-Filterung (Nutzer sieht nur,
  was er ohnehin sehen darf)
- ACP-Modul unter *Foren → Forenbaum* (Admin sieht alle Foren inkl.
  versteckter)
- Drei Ausgabeformate: HTML (eingerückte Baumdarstellung), ASCII (mit
  `├──` / `└──`), BBCode (in `[code]`-Block, direkt postbar)
- Optional Themen-/Beitragsanzahl pro Forum (`?counts=1`)
- Sprachen: Deutsch, Englisch
