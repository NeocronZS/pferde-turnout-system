# Pferde-Turnout-Verwaltungssystem

Ein modernes, Laravel-basiertes Verwaltungssystem für Pferdehöfe zur Organisation von Koppelzeiten, Dienstplänen und Pferdedaten.

## Features

### Dashboard
- **Übersichtliche Statistiken**: Anzahl Pferde, Einsteller, Koppeln
- **Live-Status**: Welche Pferde sind aktuell draußen/drinnen
- **Heutiger Dienst**: Anzeige der verantwortlichen Person
- **Schnellaktionen**: Pferde direkt raus-/reinbringen

### Pferde-Verwaltung
- Anlegen und Verwalten von Pferden
- Zuordnung zu Einstellern
- Geschlecht (Stute/Wallach) und Box-Nummer
- **Boxenruhe-Funktion**: Pferde können gesperrt werden

### Einsteller-Verwaltung
- Kontaktverwaltung (Name, Email, Telefon)
- Übersicht aller Pferde pro Einsteller

### Koppel-Verwaltung
- Verwaltung verfügbarer Koppeln
- Kapazitätsplanung

### Dienstplan
- Tägliche Dienst-Zuweisung
- Automatische Anzeige auf dem Dashboard
- Bearbeitung und Historie

### Turnout-Historie
- Vollständige Protokollierung aller Raus-/Reinbring-Aktionen
- Zeitstempel und Aufenthaltsdauer
- Filterung nach Datum
- Zuordnung zu Diensten

## 🛠️ Technologie-Stack

- **Framework**: Laravel 12
- **PHP**: 8.4
- **Datenbank**: MariaDB/MySQL
- **Frontend**: Tailwind CSS (via CDN)
- **Development Environment**: Laravel Herd

## 📦 Installation

### Voraussetzungen
- PHP 8.4+
- Composer
- MariaDB/MySQL
- Node.js & npm (optional, für Asset-Kompilierung)

### Setup

1. **Repository klonen**
```bash
   git clone https://github.com/NeocronZS/pferde-turnout-system.git
   cd pferde-turnout-system
```

2. **Dependencies installieren**
```bash
   composer install
```

3. **.env-Datei konfigurieren**
```bash
   cp .env.example .env
   php artisan key:generate
```

4. **Datenbank konfigurieren**
   
   In `.env` anpassen:
```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=pferde_turnout
   DB_USERNAME=root
   DB_PASSWORD=
```

5. **Datenbank erstellen und migrieren**
```bash
   php artisan migrate
```

6. **Development Server starten**
```bash
   php artisan serve
```

7. **Anwendung öffnen**
   
   Browser: `http://localhost:8000`

## 🗄️ Datenbank-Struktur

- **owners**: Einsteller-Daten
- **horses**: Pferde mit Zuordnung zu Einstellern
- **pastures**: Koppeln mit Kapazität
- **duties**: Dienstplan-Einträge
- **turnout_logs**: Historie aller Turnout-Aktionen

## 🎨 Design-Highlights

- Moderne, responsive UI mit Tailwind CSS
- Intuitive Bedienung
- Farbcodierung (Grün = draußen, Blau = drinnen, Rot = Boxenruhe)
- Hover-Effekte und Transitions
- Icons zur visuellen Orientierung

## 📝 Verwendung

### Pferd rausbringen
1. Dashboard öffnen
2. Pferd in der "Drinnen"-Liste finden
3. Koppel auswählen
4. "Rausbringen" klicken

### Pferd reinholen
1. Pferd in der "Draußen"-Liste finden
2. "Reinholen" klicken

### Boxenruhe aktivieren
1. Pferde → Pferd bearbeiten
2. Checkbox "Boxenruhe" aktivieren
3. Pferd wird automatisch für Rausbringen gesperrt

## 🔒 Sicherheitshinweise

- `.env`-Datei ist in `.gitignore` und wird **nicht** ins Repository hochgeladen
- Sensible Daten niemals committen
- Für Produktion: `APP_DEBUG=false` setzen

## 👨‍💻 Entwickelt als Bewerbungsprojekt

Dieses System wurde als praktische Demonstration im Rahmen einer Bewerbung entwickelt.

**Kontakt**: [J.Rowehl@googlemail.com]

## 📄 Lizenz

Dieses Projekt wurde für Bewerbungszwecke erstellt.