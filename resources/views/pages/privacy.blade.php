@extends('layouts.marketing')
@php($title = 'Adatkezelési tájékoztató — SzoftLab')
@php($description = 'Tudnivalók arról, hogyan kezeli a SzoftLab a kapcsolatfelvétel és a demóigénylés során megadott személyes adatokat.')
@section('content')
<section class="page-hero compact"><div class="container narrow"><span class="eyebrow eyebrow-light">Kapcsolatfelvétel és demóigénylés</span><h1>Adatkezelési tájékoztató</h1></div></section>
<section class="section">
    <article class="container prose">
        <p>Ez a tájékoztató a szoftlab.hu kapcsolatfelvételi és demóigénylő űrlapjára, valamint az ezekhez kapcsolódó levelezésre vonatkozik. Utoljára frissítve: 2026. szeptember 28.</p>

        <h2>Ki kezeli az adatokat?</h2>
        <p>Az adatkezelő {{ config('pzdigital.legal.provider_name') }} ({{ config('pzdigital.legal.trading_name') }}), székhelye: {{ config('pzdigital.legal.registered_address') }} Adatvédelmi kérést és egyéb megkeresést a <a href="mailto:{{ config('pzdigital.contact_email') }}">{{ config('pzdigital.contact_email') }}</a> címre küldhetsz.</p>

        <h2>Milyen adatokat kérünk, és miért?</h2>
        <p>Az űrlapokon a név és az e-mail-cím kötelező: ezek nélkül nem tudunk válaszolni. A cégnév, a telefonszám és az üzenet megadása opcionális, kivéve azokat az egyedi fejlesztési megkereséseket, amelyekhez rövid feladatleírás szükséges. Rögzítjük a kiválasztott terméket vagy érdeklődési területet, továbbá a megkeresés forrását és a hivatkozásban szereplő kampányparamétereket, ha vannak.</p>
        <p>Az adatokat kizárólag a kezdeményezett kapcsolatfelvétel megválaszolására, az ajánlat vagy a kért demóhozzáférés előkészítésére és az ezekhez szükséges egyeztetésre használjuk. A megadott e-mail-címet nem tesszük hírlevél-listára, és nem használjuk kéretlen reklámküldésre.</p>

        <h2>Mi az adatkezelés jogalapja?</h2>
        <p>Ha saját nevedben kérsz ajánlatot vagy demóhozzáférést, a szerződéskötést megelőző, általad kért lépésekhez szükséges adatkezelés a GDPR 6. cikk (1) bekezdés b) pontján alapul. Általános kérdés vagy egy vállalkozás képviselőjeként küldött megkeresés esetén a válaszadás és az üzleti kapcsolatfelvétel jogos érdeke a GDPR 6. cikk (1) bekezdés f) pontja szerinti jogalap. Ilyenkor a jogos érdekünk az, hogy a nekünk címzett megkeresést kezelni és megválaszolni tudjuk; ezzel szemben tiltakozhatsz.</p>

        <h2>Meddig őrizzük meg?</h2>
        <p>Ha a megkeresésből nem lesz megrendelés, az űrlapon megadott adatokat és a kapcsolódó levelezést a beküldéstől számított legfeljebb 12 hónapig őrizzük meg, majd töröljük. Szerződéskötés esetén az ahhoz és a számlázáshoz szükséges adatokat külön, a szerződéses és jogszabályi megőrzési szabályok szerint kezeljük. A tárhelyszolgáltató technikai naplóinak és biztonsági mentéseinek megőrzése a szolgáltató saját üzemeltetési rendjét is követi.</p>

        <h2>Ki férhet hozzá?</h2>
        <p>A megkeresést az adatkezelő kezeli. Az oldal működéséhez tárhely- és levelezési szolgáltatót veszünk igénybe; a weboldal a Hostinger tárhelyén fut. A szolgáltatók a működtetéshez szükséges körben férhetnek hozzá az adatokhoz. A megkeresés adatait nem adjuk el és nem továbbítjuk marketingcélra. A tárhelyszolgáltató alvállalkozói és esetleges EGT-n kívüli adatkezelése tekintetében a <a href="https://www.hostinger.com/legal/privacy-policy" target="_blank" rel="noopener noreferrer">Hostinger adatvédelmi tájékoztatója</a> ad további információt.</p>

        <h2>Technikai működés és sütik</h2>
        <p>Az űrlap működéséhez a weboldal munkamenet- és biztonsági sütiket használ. Az érdeklődő adatbázisrekordjában nem tárolunk teljes IP-címet vagy böngészőazonosítót. A webkiszolgáló és a tárhelyszolgáltató biztonsági naplói ettől függetlenül tartalmazhatnak technikai kapcsolatadatokat. A főoldalon megjelenő egyes technológiai logók külső képforrásból töltődnek be; az ilyen kérések során a képforrás a böngésző technikai adatait láthatja.</p>

        <h2>Milyen jogaid vannak?</h2>
        <p>Kérhetsz tájékoztatást és hozzáférést a kezelt adataidhoz, azok helyesbítését, törlését vagy kezelésük korlátozását. A szerződés előkészítésén alapuló, automatizáltan kezelt adatoknál az adathordozhatóság joga is megillethet. A jogos érdeken alapuló adatkezelés ellen tiltakozhatsz. Kérelmedet a <a href="mailto:{{ config('pzdigital.contact_email') }}">{{ config('pzdigital.contact_email') }}</a> címre küldheted; a GDPR szerinti határidőben válaszolunk. A megkeresésekről nem hozunk automatizált, joghatással járó döntést.</p>
        <p>Ha úgy véled, hogy az adatkezelés sérti a jogaidat, panaszt tehetsz a <a href="https://www.naih.hu/" target="_blank" rel="noopener noreferrer">Nemzeti Adatvédelmi és Információszabadság Hatóságnál</a> (1055 Budapest, Falk Miksa utca 9–11.; ugyfelszolgalat@naih.hu), vagy bírósághoz fordulhatsz.</p>
    </article>
</section>
@endsection
