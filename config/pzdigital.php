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
            'summary' => 'Ismerd meg a SzervizPRO-t, és nézzük meg, hogyan illeszkedhet a műhelyed működéséhez.',
            'audience' => 'Kis- és közepes szervizek',
            'lifecycle_status' => 'preview',
            'status_label' => 'Bemutató kérhető',
            'publication_status' => 'published',
            'content_approved' => true,
            'demo_mode' => 'gallery',
            'accent' => 'blue',
            'benefits' => [
                'A napi munka egy áttekinthető folyamatban követhető.',
                'A bemutató a saját működésedből indul ki.',
                'A bevezetés tartalmát közösen rögzítjük.',
            ],
            'flow' => [
                ['title' => 'Munkafelvétel', 'text' => 'A beérkező feladat és a szükséges adatok rögzítésének tervezett helye.'],
                ['title' => 'Munka követése', 'text' => 'A munkalapok és állapotok áttekinthető kezelésére tervezett folyamat.'],
                ['title' => 'Visszakeresés', 'text' => 'A lezárt munkák rendezett elérését bemutató koncepció.'],
            ],
            'questions' => [
                ['question' => 'Mit láthatok a bemutatón?', 'answer' => 'A jelenlegi, ellenőrzött felületet és a műhelyed szempontjából releváns folyamatot mutatjuk meg.'],
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
            'questions' => [
                ['question' => 'Elérhető már élő kipróbálás?', 'answer' => 'Nyilvános, írható demót csak elkülönített és biztonságosan ellenőrzött környezetben nyitunk meg. Jelenleg bemutató kérhető.'],
                ['question' => 'Van bankkártyás fizetés?', 'answer' => 'Az elérhető fizetési és külső integrációkat a konkrét projekt és szolgáltatói feltételek alapján egyeztetjük.'],
            ],
        ],
    ],
];
