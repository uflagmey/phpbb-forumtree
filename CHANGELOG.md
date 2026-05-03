# Changelog

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
