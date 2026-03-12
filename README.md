# 🍄 E-commerce Super Mario

> Progetto universitario di un'applicazione e-commerce a tema Super Mario, sviluppata con HTML5, CSS3, JavaScript/jQuery, PHP e MySQL (stack XAMPP).

---

## 📋 Indice

- [Descrizione del Progetto](#descrizione-del-progetto)
- [Funzionalità](#funzionalità)
- [Stack Tecnologico](#stack-tecnologico)
- [Struttura del Progetto](#struttura-del-progetto)
- [Pagine e Navigazione](#pagine-e-navigazione)
- [Database](#database)
- [API Endpoints](#api-endpoints)
- [Installazione e Configurazione](#installazione-e-configurazione)
- [Account di Test](#account-di-test)
- [Note di Sicurezza](#note-di-sicurezza)

---

## Descrizione del Progetto

**E-commerce Super Mario** è un'applicazione web e-commerce tematica dedicata alla vendita di merchandising ispirato all'universo di Super Mario (statuette, poster e gadget). Il progetto è stato realizzato come elaborato per un esame universitario da 6 CFU nell'ambito delle Tecnologie Web (2022).

L'applicazione supporta due tipologie di utenti — **cliente** e **amministratore** — e implementa un flusso di acquisto completo: dalla navigazione del catalogo alla gestione del carrello fino al checkout. Tutte le interazioni con il database avvengono in modo asincrono tramite AJAX, consentendo un'esperienza di navigazione fluida senza ricaricare la pagina. L'interfaccia è **responsive** e ottimizzata per schermi da 360 px fino a ~2000 px.

---

## Funzionalità

### 👤 Utente Cliente

| Funzionalità | Descrizione |
|---|---|
| **Registrazione** | Creazione di un nuovo account con nome, cognome, email e password |
| **Login / Logout** | Accesso sicuro tramite sessione PHP; logout con distruzione della sessione |
| **Catalogo prodotti** | Visualizzazione di tutti i prodotti con filtro per categoria |
| **Dettaglio prodotto** | Pagina dedicata con immagine, descrizione, prezzo e quantità disponibile |
| **Carrello** | Aggiunta, rimozione (singola o totale) e aggiornamento delle quantità degli articoli |
| **Checkout** | Acquisto del contenuto del carrello con svuotamento automatico dopo la conferma |
| **Profilo** | Visualizzazione delle informazioni del proprio account |

### 🛠️ Utente Amministratore

| Funzionalità | Descrizione |
|---|---|
| **Login separato** | Accesso tramite un pannello amministrativo dedicato |
| **Aggiunta prodotti** | Inserimento di nuovi articoli nel catalogo (titolo, categoria, prezzo, immagine, descrizione) |
| **Modifica prodotti** | Aggiornamento delle informazioni di un prodotto esistente |
| **Rimozione prodotti** | Eliminazione di un prodotto dal catalogo |
| **Gestione amministratori** | Creazione di nuovi account amministratore |

### 🎠 Funzionalità Trasversali

- **Carosello prodotti** — slider con prodotti correlati nella pagina di dettaglio
- **Iniezione dinamica del contenuto** — i prodotti vengono caricati e inseriti nel DOM via AJAX senza refresh
- **Gestione sessione** — la sessione PHP mantiene lo stato dell'utente e il prodotto selezionato tra le pagine
- **Design responsive** — layout adattivo tramite media query CSS (360 px – ~2000 px)
- **Sezione "Chi siamo"** e **form di contatto** incluse nella homepage

---

## Stack Tecnologico

| Layer | Tecnologia |
|---|---|
| **Frontend** | HTML5, CSS3, JavaScript (ES5+), jQuery 3.6.0, jQuery UI 1.10.4 |
| **Backend** | PHP (procedurale, PDO) |
| **Database** | MySQL / MariaDB |
| **Server** | XAMPP (Apache + MySQL) |
| **Icone** | FontAwesome |
| **Comunicazione** | AJAX (JSON) |

---

## Struttura del Progetto

```
E-commerce-Super-Mario/
├── index.php                    # Entry point — reindirizza in base alla sessione
├── progetto_tweb.sql            # Schema e dati iniziali del database
│
├── assets/                      # Risorse statiche
│   ├── homepage/
│   │   ├── prodotti/            # Immagini dei prodotti
│   │   └── carousel/            # Immagini del carosello
│   └── navbar/                  # Logo e icone della barra di navigazione
│
├── css/                         # Fogli di stile
│   ├── top.css / bottom.css     # Header e footer
│   ├── homepage.css             # Pagina principale utente
│   ├── homepageAdmin.css        # Pannello amministratore
│   ├── product.css              # Pagina dettaglio prodotto
│   ├── carrello.css             # Carrello
│   ├── login.css / signin.css   # Login e registrazione
│   ├── carousel.css             # Carosello
│   └── contact-form.css         # Form di contatto
│
├── html/                        # Componenti HTML riutilizzabili
│   ├── top.html                 # Header comune (navbar, CSS, JS)
│   ├── bottom.html              # Footer comune
│   ├── about-us.html            # Sezione "Chi siamo"
│   └── contact-form.html        # Form di contatto
│
├── js/                          # Logica client-side
│   ├── homepage.js              # Caricamento prodotti e categorie via AJAX
│   ├── homepageAdmin.js         # Operazioni CRUD admin via AJAX
│   ├── login_signup.js          # Validazione e invio form login/registrazione
│   ├── product.js               # Dettaglio prodotto e carosello
│   └── carrello.js              # Gestione carrello (aggiunta, rimozione, checkout)
│
└── php/                         # Logica server-side
    ├── db.php                   # Connessione DB e funzioni di query
    ├── login.php                # Pagina di login
    ├── signup.php               # Pagina di registrazione
    ├── homepage.php             # Homepage utente
    ├── homepageAdmin.php        # Pannello amministratore
    ├── product.php              # Pagina dettaglio prodotto
    ├── carrello.php             # Pagina carrello
    ├── profilo.php              # Pagina profilo utente/admin
    ├── logout.php               # Logout e distruzione sessione
    ├── carousel/                # Componente carosello
    │   ├── carousel.php
    │   └── get_carousel_data_db.php
    └── [*_db.php]               # Endpoint AJAX (vedi sezione API)
```

---

## Pagine e Navigazione

| URL | File | Accesso | Descrizione |
|---|---|---|---|
| `/` | `index.php` | Tutti | Reindirizza al login o alla homepage in base alla sessione |
| `/php/login.php` | `login.php` | Non autenticato | Form di login (utente e admin) |
| `/php/signup.php` | `signup.php` | Non autenticato | Form di registrazione nuovo utente |
| `/php/homepage.php` | `homepage.php` | Cliente | Catalogo prodotti con filtro categorie e sezioni info |
| `/php/homepageAdmin.php` | `homepageAdmin.php` | Admin | Pannello di gestione con operazioni CRUD sui prodotti |
| `/php/product.php` | `product.php` | Cliente | Dettaglio prodotto, aggiunta al carrello, carosello correlati |
| `/php/carrello.php` | `carrello.php` | Cliente | Riepilogo carrello, gestione quantità, checkout |
| `/php/profilo.php` | `profilo.php` | Autenticato | Informazioni profilo (diverso per admin e cliente) |
| `/php/logout.php` | `logout.php` | Autenticato | Distrugge la sessione e reindirizza al login |

---

## Database

### Schema — `progetto_tweb`

#### `cliente` — Utenti clienti

| Campo | Tipo | Vincolo |
|---|---|---|
| `Nome` | VARCHAR(30) | |
| `Cognome` | VARCHAR(30) | |
| `Email` | VARCHAR(150) | **PRIMARY KEY** |
| `Password` | VARCHAR(255) | MD5 hash (⚠️ non sicuro) |

#### `dipendente` — Utenti amministratori

| Campo | Tipo | Vincolo |
|---|---|---|
| `Nome` | VARCHAR(255) | |
| `Cognome` | VARCHAR(255) | |
| `Email` | VARCHAR(150) | **PRIMARY KEY** |
| `Password` | VARCHAR(255) | MD5 hash (⚠️ non sicuro) |

#### `prodotti` — Catalogo prodotti

| Campo | Tipo | Vincolo |
|---|---|---|
| `Categoria` | VARCHAR(50) | |
| `Titolo` | VARCHAR(30) | **PRIMARY KEY** |
| `Url_foto` | VARCHAR(255) | |
| `Descrizione` | VARCHAR(144) | |
| `Prezzo` | INT | In euro (€) |

Categorie disponibili: Mario, Luigi, Yoshi, Bowser, Daisy, Peach, Toad, Toadette, Wario, Goomba, Donkey Kong, Poster. Fascia di prezzo: €20 – €250.

#### `carrello` — Carrello degli acquisti

| Campo | Tipo | Vincolo |
|---|---|---|
| `Cliente` | VARCHAR(150) | FK → `cliente.Email` |
| `Titolo` | VARCHAR(30) | FK → `prodotti.Titolo` |
| `Quantita` | INT | DEFAULT 1 |
| `Somma` | INT | Totale parziale (prezzo × quantità) |

La chiave primaria è composta da (`Cliente`, `Titolo`).

---

## API Endpoints

Tutti gli endpoint accettano/restituiscono JSON e sono richiamati via AJAX.

### Autenticazione

| Endpoint | Metodo | Input | Output | Descrizione |
|---|---|---|---|---|
| `/php/login_db.php` | POST | `email`, `password` | `{correctData: bool}` | Valida le credenziali cliente |
| `/php/login_admin_db.php` | POST | `email`, `password` | `{correctData: bool}` | Valida le credenziali admin |
| `/php/signup_db.php` | POST | `name`, `surname`, `email`, `password` | `{result: string}` | Registra un nuovo cliente |

### Prodotti

| Endpoint | Metodo | Input | Output | Descrizione |
|---|---|---|---|---|
| `/php/get_category_list.php` | GET | — | Array di categorie | Lista tutte le categorie |
| `/php/get_products_list_db.php` | GET | `?category=` (opz.) | Array di prodotti | Prodotti (tutti o per categoria) |
| `/php/set_product_data.php` | POST | `product_title` | `{correctData: bool}` | Salva il prodotto selezionato in sessione |
| `/php/get_product_data_db.php` | GET | — (sessione) | Dati prodotto | Recupera il prodotto dalla sessione |
| `/php/carousel/get_carousel_data_db.php` | GET | — (sessione) | Array di 6 prodotti | Prodotti correlati per il carosello |

### Carrello

| Endpoint | Metodo | Input | Output | Descrizione |
|---|---|---|---|---|
| `/php/add_to_cart_db.php` | POST | `quantity` (sessione) | Testo esito | Aggiunge o aggiorna un articolo nel carrello |
| `/php/get_cart_list_db.php` | GET | — (sessione) | Array articoli carrello | Lista articoli nel carrello dell'utente |
| `/php/get_data_from_cart.php` | GET | — (sessione) | `{qnt: int, sum: int}` | Totali del carrello |
| `/php/remove_all_items_from_cart_db.php` | POST | `checkout` (opz.) | Testo esito | Svuota l'intero carrello (o esegue checkout) |
| `/php/remove_all_this_item_from_cart.php` | POST | `title`, `mode` (`All`/`One`) | Testo esito | Rimuove o decrementa un articolo |

### Admin

| Endpoint | Metodo | Input | Output | Descrizione |
|---|---|---|---|---|
| `/php/adminHandler.php` | POST | `action`, dati prodotto/admin | JSON / bool | Gestisce tutte le operazioni CRUD admin |

---

## Installazione e Configurazione

### Prerequisiti

- **XAMPP** con Apache e MySQL attivi (PHP 8.0+, MariaDB 10.4+)
- Browser moderno con JavaScript abilitato

### Passaggi

1. **Clona il repository** nella cartella `htdocs` di XAMPP:
   ```bash
   cd /path/to/xampp/htdocs
   git clone https://github.com/MagicMike02/E-commerce-Super-Mario.git
   cd E-commerce-Super-Mario
   ```

2. **Crea il database** tramite phpMyAdmin o riga di comando:
   ```bash
   mysql -u root < progetto_tweb.sql
   ```
   Questo crea il database `progetto_tweb` con tabelle e dati di esempio.

3. **Configura la connessione al database** in `php/db.php`:
   ```php
   $dbconnstring = 'mysql:dbname=progetto_tweb;host=localhost:3306';
   $dbuser = 'root';
   $dbpasswd = '';  // Password vuota per XAMPP di default
   ```

4. **Avvia Apache e MySQL** dal pannello di controllo XAMPP.

5. **Apri il browser** e vai su:
   ```
   http://localhost/E-commerce-Super-Mario/
   ```
   L'applicazione reindirizzerà automaticamente al login se non è presente una sessione attiva.

---

## Account di Test

| Tipo | Email | Password |
|---|---|---|
| Cliente | `Micheleliquindoli@gmail.com` | `123456` |
| Admin | `Micheleliquindoli@gmail.com` | `123456` |

---

## Note di Sicurezza

> ⚠️ Questo progetto è a scopo **didattico**. Non è destinato ad un ambiente di produzione senza ulteriori interventi di sicurezza.

Vulnerabilità note:

- **Hashing password debole** — viene utilizzato MD5 al posto di algoritmi moderni come `bcrypt` o `argon2`
- **Possibile iniezione via URL** — alcuni file di backend non validano completamente i parametri in input
- **Assenza di HTTPS** — le sessioni non sono cifrate in transito
- **Nessuna protezione CSRF** — i form non utilizzano token anti-CSRF
