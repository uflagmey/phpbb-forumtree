# Forum Tree – phpBB 3.3.x Extension

Stellt die Forenstruktur (Kategorien, Foren, Unterforen) als Baum dar – als
öffentliche Seite unter `/app.php/forumtree` und im ACP unter
*Foren → Forenbaum*. Ausgabe in **HTML**, **ASCII** oder **BBCode**.

## Features

- **Frontend-Seite** `/app.php/forumtree` – respektiert Forum-Berechtigungen
  des angemeldeten Nutzers
- **ACP-Modul** unter *Foren → Forenbaum → Baum anzeigen* – zeigt auch
  nicht-öffentliche Foren (Admin-Sicht)
- Drei Ausgabeformate:
  - **HTML** – eingerückte Baumdarstellung mit Kategorien fett
  - **ASCII** – `├──` / `└──`-Baum, kopierbar in Konsole oder Texteditor
  - **BBCode** – ASCII-Baum in `[code]`-Block, direkt in Forenbeitrag postbar
- Optional Themen-/Beitragsanzahl pro Forum (`?counts=1`)

## Installation

1. Inhalt des Verzeichnisses `ext/uflagmey/forumtree/` in dein phpBB unter
   `ext/uflagmey/forumtree/` kopieren.
2. Im ACP zu *Anpassen → Erweiterungen verwalten* gehen.
3. Bei "Forum Tree" auf **Aktivieren** klicken.

## Nutzung

- Frontend: `https://dein-forum.de/app.php/forumtree`
  - `?format=ascii` – ASCII-Ausgabe
  - `?format=bbcode` – BBCode-Ausgabe
  - `&counts=1` – mit Themen-/Beitragszahlen
- ACP: *Foren → Forenbaum → Baum anzeigen*

## Bekannte Einschränkung

Auf manchen phpBB-Installationen (insbesondere mit anderen Extensions, die
sich global in den Render-Lifecycle einklinken) wird die ACP-Seite **ohne
ACP-Rahmen** ausgeliefert – also nur der Body-Inhalt ohne Tabs, Sidebar und
Style. Funktional läuft die Seite trotzdem: alle Format-Umschaltungen und
die Themen-/Beitragsanzahl funktionieren. In dem Fall empfiehlt sich die
**Frontend-Seite** als Hauptzugang.

## Deinstallation

Im ACP unter *Erweiterungen verwalten* deaktivieren und anschließend löschen.
Die Migration registriert nur den ACP-Modul-Eintrag, der bei Deinstallation
automatisch entfernt wird. Es werden keine zusätzlichen Tabellen angelegt.

## Lizenz

[GPL-2.0](license.txt)
