# Basic CMS for Restaurant-Bar

Questo progetto GitHub, denominato "basicms-restaurant", è un Content Management System (CMS) di base per ristoranti e bar.
## Descrizione del Progetto

Tre siti distinti: Superadmin, Admin e Utente. Ogni sito ha la sua indipendenza e può essere ospitato su spazi di hosting diversi.

Per realizzare il progetto, ci siamo ispirati al sito web [https://www.qodeup.com/demo](https://www.qodeup.com/demo) che ci ha colpito positivamente.

## Funzionalità Principali

### Superadmin

- Creazione di account per Admin e Superadmin
- Modifica dei dati personali e di altri utenti registrati

### Admin

- Modifica del proprio profilo (dati personali)
- Gestione delle categorie: aggiunta, modifica, rimozione
- Gestione del cibo: aggiunta, modifica, rimozione
- Modifica delle impostazioni del sito (descrizione, dati principali)
- Gestione delle newsletter: visualizzazione e cancellazione degli iscritti
- Visualizzazione delle statistiche di accesso al sito pubblico

### Utente

- Visualizzazione delle categorie e dei piatti disponibili
- Iscrizione alla newsletter con possibilità di cancellazione
- Traduzione del sito per una visione completa

## Struttura del Database

Il database del progetto è stato progettato tenendo conto delle seguenti tabelle principali:

- `newsletter_table`: contiene le informazioni sugli iscritti alla newsletter
- `admin_table`: contiene i dati degli Admin registrati
- `access_table`: registra gli accessi al sito tramite indirizzo IP
- `category_table`: memorizza le informazioni sulle categorie
- `setting_table`: memorizza le impostazioni del sito
- `food_table`: contiene le informazioni sui piatti disponibili

## Sezione amministrazione

Attraverso un sistema di login semplice, l'Admin può accedere all'interfaccia intuitiva del CMS. Qui, è possibile gestire il proprio profilo, le categorie, il cibo, le impostazioni del sito e le newsletter.

## Sezione utenti

Gli Utenti possono accedere alla parte pubblica del sito, visualizzare le categorie e i piatti disponibili. Hanno anche la possibilità di iscriversi alla newsletter e di annullare l'iscrizione.

## Licenza

Questo progetto è distribuito sotto la Licenza MIT - vedi il file [LICENSE](LICENSE) per ulteriori dettagli.


## Autore

Questo progetto è stato creato da [alessandromasone](https://github.com/alessandromasone).
