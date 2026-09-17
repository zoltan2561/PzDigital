<?php

return [
    'contact_email' => env('PZDIGITAL_CONTACT_EMAIL', 'hello@pzdigital.hu'),
    'privacy_version' => env('PZDIGITAL_PRIVACY_VERSION', 'draft-2026-09'),
    'inquiry_rate_limit' => (int) env('PZDIGITAL_INQUIRY_RATE_LIMIT', 8),

    'products' => [
        'szervizpro' => [
            'slug' => 'szervizpro',
            'name' => 'SzervizPRO',
            'eyebrow' => 'Szervizeknek tervezett rendszer',
            'headline' => 'Kevesebb adminisztráció. Átláthatóbb szervizmunka.',
            'summary' => 'Digitális munkalap, ügyfélkövetés és műhelykommunikáció egy átlátható rendszerben — kis- és közepes autószervizeknek.',
            'audience' => 'Kis- és közepes szervizek',
            'lifecycle_status' => 'demo',
            'status_label' => 'Működő demó',
            'publication_status' => 'published',
            'content_approved' => true,
            'demo_mode' => 'gallery',
            'accent' => 'blue',
            'benefits' => [
                'Digitális munkalapok és gyors státuszváltás.',
                'Ügyféloldali követés rendszám és azonosító alapján.',
                'Üzenetek, visszahívási kérések és publikus fotók egy helyen.',
            ],
            'flow' => [
                ['title' => 'Munkafelvétel', 'text' => 'Az ügyfél, a jármű, a hiba és a vállalt munka egy rendezett munkalapra kerül.'],
                ['title' => 'Műhelymunka', 'text' => 'A csapat a napi munkaközpontból követi az állapotokat, teendőket és ügyfélkéréseket.'],
                ['title' => 'Ügyféltájékoztatás', 'text' => 'Az ügyfél saját kóddal látja a státuszt, az üzeneteket, a várható elkészülést és a publikus fotókat.'],
            ],
            'screenshots' => [
                ['src' => '/media/pzdigital/szervizpro/dashboard.png', 'alt' => 'A SzervizPRO napi műhelyközpontja munkalap- és kommunikációs áttekintéssel', 'label' => 'Műhelynézet', 'title' => 'A napi teendők egy képernyőn'],
                ['src' => '/media/pzdigital/szervizpro/customer-home.png', 'alt' => 'A SzervizPRO ügyféloldali kezdőképernyője állapot-előnézettel', 'label' => 'Ügyféloldal', 'title' => 'Kevesebb telefon, érthetőbb tájékoztatás'],
                ['src' => '/media/pzdigital/szervizpro/status-lookup.png', 'alt' => 'Javítási állapot lekérdezése rendszám és kapott azonosító alapján', 'label' => 'Biztonságos lekérdezés', 'title' => 'Rendszám és azonosító alapján'],
            ],
            'questions' => [
                ['question' => 'Mit láthatok a bemutatón?', 'answer' => 'A működő műhelynézetet, a digitális munkalapot és az ügyféloldali státuszkövetést mutatjuk meg, a saját folyamataidra koncentrálva.'],
                ['question' => 'Mennyi idő a bevezetés?', 'answer' => 'Az időigényt a szükséges beállítások és adat-előkészítés felmérése után lehet felelősen rögzíteni.'],
            ],
        ],
        'foodshop' => [
            'slug' => 'foodshop',
            'name' => 'FoodShop',
            'eyebrow' => 'Online rendelési megoldás',
            'headline' => 'Saját online rendelési felület, a vállalkozásodra szabva.',
            'summary' => 'A FoodShop termékirány egy saját arculatú kínálati és rendelési felületet mutat be. A végleges funkciók egyeztetés alatt állnak.',
            'audience' => 'Éttermek és vendéglátóhelyek',
            'lifecycle_status' => 'preview',
            'status_label' => 'Előzetes bemutató',
            'publication_status' => 'published',
            'content_approved' => true,
            'demo_mode' => 'gallery',
            'accent' => 'green',
            'benefits' => [
                'Saját márkához illeszthető felület terve.',
                'Egyszerű, mobilra tervezett rendelési út.',
                'A tényleges funkciók a bemutatón tisztázhatók.',
            ],
            'flow' => [
                ['title' => 'Kínálat', 'text' => 'A termékek és kategóriák jól áttekinthető, mobilbarát bemutatása.'],
                ['title' => 'Rendelési út', 'text' => 'A kosár és a rendelés lépéseinek tervezett, egyszerű folyamata.'],
                ['title' => 'Feldolgozás', 'text' => 'A beérkező rendelések kezelőoldali feldolgozásának koncepciója.'],
            ],
            'screenshots' => [],
            'questions' => [
                ['question' => 'Elérhető már élő kipróbálás?', 'answer' => 'Nyilvános, írható demót csak elkülönített és biztonságosan ellenőrzött környezetben nyitunk meg. Jelenleg bemutató kérhető.'],
                ['question' => 'Van bankkártyás fizetés?', 'answer' => 'Az elérhető fizetési és külső integrációkat a konkrét projekt és szolgáltatói feltételek alapján egyeztetjük.'],
            ],
        ],
    ],
];
