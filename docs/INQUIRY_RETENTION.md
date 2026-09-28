# Megkeresések 12 hónapos megőrzése

Az adatkezelési tájékoztató szerint a megrendeléshez nem vezető megkeresések 12 hónap után törlendők. A `php artisan inquiries:prune` parancs a lejárt űrlaprekordokat törli az adatbázisból. A Laravel ütemező naponta 03:00-kor futtatja, ha a tárhely cronja elindítja a `schedule:run` parancsot.

Hostinger hPanelben a SzoftLab webhely **Advanced → Cron Jobs** részén egy **Custom** cron szükséges percenkénti futással. A parancsban a tárhely tényleges PHP 8.3 vagy újabb binárisát és a telepítési útvonalat kell használni, például:

```text
/opt/alt/php83/usr/bin/php /home/u138558728/domains/szoftlab.hu/public_html/artisan schedule:run
```

A PHP és az útvonal helyességét a tárhelyen ellenőrizni kell. Az első futtatás előtt `php artisan schedule:list` és `php artisan inquiries:prune` kézi próbája javasolt.

Az értesítő e-mailek és az ezekre adott válaszok külön a levelezőfiókban vannak. A 12 hónapos határidő ezekre is vonatkozik, ha nincs megrendelés; a postafiókban külön törlési rendet kell alkalmazni. A szerződések és számlák megőrzése ettől eltérhet.
