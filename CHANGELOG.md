# Changelog

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
