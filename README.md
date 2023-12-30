# Projekt zespołowy

## Wymagania przed instalacją
- Windows + WSL2 lub Linux
- Docker

## Pierwsze uruchomienie
### Windows + WSL2
1. Uruchomić aplikację Docker Desktop
1. Uruchomić WSL i przejść do katalogu ~/
![image](https://github.com/michaldabrowski98/GroupProject/assets/51337492/bc8e5b2d-ced0-4631-86ef-eedb719caeee)
2. Skopiować projekt
   ```
   git clone https://github.com/michaldabrowski98/GroupProject
   ```
3. Uruchomić projekt wykonujące komendy
   ```
   cd GroupProject
   make setup
   ```
   W rezultacie wykonania tego polecenia w aplikacji Dokcer Desktop powinny być widoczne dwa nowe kontenery:![image](https://github.com/michaldabrowski98/GroupProject/assets/51337492/4e5d6f20-9a25-425e-a948-2018732f002b)

## Kolejne uruchomienia
1. Do uruchomienia projektu należy w katalogu głównym projektu (GroupProject) wykonać polecenie
   ```
   make up
   ```
2. Aby wyłączyć projekt nalezy użyć polecenia
   ```
   make down
   ```
## URLe aplikacji
Zarówno aplikacja frontendowa jak i backendowa działają na localhoscie. 
1. Aplikacja backendowa
   ```
   http://localhost:80/
   ```
2. Aplikacja frontendowa
   ```
   http://localhost:8081/
   ```
