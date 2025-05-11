# Egzaminas

## Projekto aprašymas
Tai yra egzamino projektas, sukurtas naudojant **Laravel**, **Blade** ir **Breeze**. Projektas leidžia vartotojams peržiūrėti prekes, pridėti jas į krepšelį, registruotis ir prisijungti. Taip pat įdiegta **Mailtrap** sistema, skirta pašto siuntimui testavimo tikslams.

## Funkcijos
- **Prekių katalogas**: Peržiūrėti įvairias prekes pagal kategorijas
- **Prekių pridėjimas**: Galimybė pridėti naujas prekes, taip pat įkelti nuotraukas.
- **Prekių redagavimas ir šalinimas**: Galimybė redaguoti ir šalinti prekes iš katalogo.
- **Vartotojo paskyra**: Vartotojai gali registruotis, prisijungti, keisti slaptažodžius ir redaguoti savo paskyros informaciją.
- **Mailtrap konfigūracija**: Vartotojai gali gauti aktyvacijos el. laiškus naudojant Mailtrap testavimo platformą.

## Technologijos
- **Backend**: Laravel 12.12.0
- **PHP**: 8.46
- **Database**: MySQL/MariaDB
- **Frontend**: Blade, Breeze
- **Mailing System**: Mailtrap (naudojama pašto testavimui)
- **Server**: XAMPP

## Diegimas

1. **Klono projekto repozitoriją**:

    ```bash
    git clone https://github.com/lukas14312/Egzaminas.git
    ```

2. **Įdiekite priklausomybes**:
    Projekto kataloge paleiskite:

    ```bash
    cd Egzaminas
    composer install
    ```

3. **Sukurkite `.env` failą** ir užpildykite su savo duomenų bazės ir Mailtrap nustatymais:

    ```bash
    cp .env.example .env
    ```

4. **Sukurkite duomenų bazę** ir įvykdykite migracijas:

    ```bash
    php artisan migrate
    ```

5. **Mailtrap konfigūracija**:
    1. Prisijunkite prie **Mailtrap** (https://mailtrap.io/) ir sukurkite paskyrą.
    2. Sukurkite naują Mailtrap "Inbox".
    3. Gaukite Mailtrap SMTP nustatymus (Smtp serverį, vartotojo vardą, slaptažodį).
    4. Konfigūruokite **.env** failą:

       ```plaintext
       MAIL_MAILER=smtp
       MAIL_HOST=smtp.mailtrap.io
       MAIL_PORT=2525
       MAIL_USERNAME=your-mailtrap-username
       MAIL_PASSWORD=your-mailtrap-password
       MAIL_ENCRYPTION=tls
       MAIL_FROM_ADDRESS="no-reply@example.com"
       MAIL_FROM_NAME="${APP_NAME}"
       ```

6. **Sukurkite aplikaciją ir pasiekite ją per naršyklę**:
    Norėdami paleisti projektą, naudokite:

    ```bash
    php artisan serve
    ```

    Projekto adresas bus `http://localhost:8000`.

