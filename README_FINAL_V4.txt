GYANDAYINI GIRLS’ ACADEMY — FINAL V4

1. Extract this folder to C:\xampp\htdocs\Gyandayini_Girls_Academy_Dynamic
2. Start Apache and MySQL in XAMPP.
3. Fresh install: phpMyAdmin -> Import database/install.sql
4. Existing V2/V3 database: import database/update_v4.sql ONLY (do not import old update_v3.sql).
5. Open http://localhost/Gyandayini_Girls_Academy_Dynamic/
6. Admin: http://localhost/Gyandayini_Girls_Academy_Dynamic/admin/login.php
   Email: admin@gga.local
   Password: admin123

IMPORTANT: Do not open PHP files by double-clicking from Windows. Always open through http://localhost/... so Apache/PHP and CSS/JS load correctly.

New V4:
- Reliable menu freeze at top while scrolling (fixed on scroll + mobile menu).
- Correctly styled TC Verification page.
- Downloads page includes View/Verify TC search by Admission Number.
- TC View page supports image/PDF preview and Download TC.
- Safe update_v4.sql avoids duplicate-column errors from update_v3.sql.
- Existing Nursery, LKG, UKG and Class 1–8 result-ranker system retained.
- School Calendar and class-wise Syllabus remain Admin controlled.
