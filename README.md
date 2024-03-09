Fuck Cancer - Návod rozběhání
=================
---

## Instalace aplikace
Před názvy adresářů je uváděna tečka, která značí root projektu

Nejprve je nutné nastavit proměnné k docker-compose zkopírováním souboru 
- `./docker/.env_example` do souboru `./docker/.env`.
- `./docker/php.env_example` do souboru `./docker/php.env`.

Dále pro nainstalování aplikace spustíme docker containery následujícím příkazem spuštěného z kořenového adresáře aplikace.

```
docker-compose up
```

Při startu je vykonán příkaz `composer install`, který nainstaluje potřebné balíčky, není tedy potřeba příkaz spouštět znovu.
Dále je potřeba aplikaci připojit na databázi s řádnou strukturou. Soubory pro vytvoření struktury v databázi se (dočasně) nachází v adresáři `./www`. 
- `cleanDatabase.sql` obsahuje SQL příkazy pro vytvoření struktury databáze. 
- `installDatabase.sql` obsahuje SQL příkazy pro vytvoření struktury databáze a naplní ji počátečními daty (testGarant, tsp123)
- `testDatabase.sql` obsahuje SQL příkazy pro vytvoření struktury databáze a naplní ji testovacími daty

Nastavení připojení databáze se nachází v souboru `./config/local.neon`, který je potřeba vytvořit zkopírováním z `./config/local.neon.example`.


Po nastartování je aplikace běží na adrese https://localhost, (tedy na portu 10000). Port lze přenastavit v souboru `./docker/.env`.

Databázové migrace
--------------------
**Při každé úpravě databáze je NUTNÉ vytvořit migraci!**

Nejprve je třeba říct, že databázové migrace uchovávají svůj stav v tabulce doctrine_migrations,
která se při prvním spuštění automaticky vytvoří

Vytvoření nové databázové migrace
- `./bin/console migrations:generate` nebo `make mc`

Migrace se vytvoří ve složce db/Migrations s názvem dnešního data

Poté je třeba vyplnit metody up() a down() v těle vygenerované migrace, kdy 
- UP mění databázi z aktuálního stavu do nového
- DOWN odstraňuje NOVÝ stav do stavu před migrací

Migrace se spouští několika způsoby
- Jedna migrace (nastavení nových změn DB) - poslední parametr je název třídy migrace
  - `./bin/console migrations:execute --up 'Database\Migrations\Version20230518081351'`
- Jedna migrace (odstranění nových změn DB)
    - `./bin/console migrations:execute --down 'Database\Migrations\Version20230518081351'`
- Všechny migrace
  - `./bin/console migrations:migrate`  nebo  `make m`



