## The main goal

The main goal of this project is to create a simple and easy to use tool for creating spotify library playlists based on your steam account. 

## How it works

**This is actually more a training project than a real project, so it's not really working yet. 
It may be a bit overkill sometimes, because it is for challenging myself**

The program will scan your steam account for games that have a soundtrack and then search spotify for the soundtrack. 
If it finds a soundtrack it will suggest it to you and you can choose to add it to your library or not.

## Explanation of the project structure
See ([config](CONFIG.md)) to see the doc of how run the project

Code structure is based on hexagonal/clean architecture, inspired by https://github.com/Grafikart/Grafikart.fr/
This is more of a long term goal, but it will help me to keep the code clean and organized.
It will also help me to keep the code testable and easy to maintain.
I admit this is a bit overkill for a small project like this, but it's a good opportunity to learn and practice this architecture.
- Domain will be the core of the application, it will contain the entities, events, subscribers, and services. 
  All of this need to be isolated, and it needs to communicate with the application layer only through services.
  For example, controllers don't need to call repositories directly, they need to call services that will call repositories.
- Http will be the application layer, it will contain the controllers, Forms, API related stuff, Admin related stuff, and so on.
- Command will be the command layer, it will contain the commands that can be run from the console.
- Infrastructure will be the infrastructure layer, it will contain the system related stuff, in opposite to the domain layer that will contain the business logic. 
  We will have stuffs like fixtures, ORM, Security...
  
## steps of development (not in order)
# 1 - Initial POC 
- [ ] Create an account on the app. 
- [ ] can get info from steam
   - inspired by https://github.com/knojector/SteamAuthenticationBundle/tree/bde0d51d2768857f78fa0372a85f2f2b0a933024
   - Create a button that redirects to the steam login page, with the callback url being the login page of the app
- [ ] can get the list of games from steam
- [ ] can get the list of soundtracks from steam

- [ ] can be logged into spotify
- [ ] can get the list of favorites albums/artists from spotify
- [ ] check if a soundtrack is already in the library
- [ ] can add a soundtrack to the library

- [ ] Dont forget to add tests

# 2 - Improvement 
- [ ] Use another API for the game part, like Epic, GOG, origin, PSN, Xbox, etc...
- [ ] Use another API for the music part, like Deezer, Apple Music, Youtube Music, etc...
- [ ] Use another API for the initial login part. Maybe keycloak,  Google, Facebook, Twitter, etc...
- [ ] Add social features, like sharing playlists, following other users, etc...
- [ ] Add a recommendation system, based on the games you play, the music you listen to, the games you own, etc...

# 3 - TODO
- [ ] Find and use a good library for front design (tailwind?)
- [ ] Use React for fragments

## Question
- What should be the main way to register into the app? Using steam, or using a custom account?


## Docs
https://steamcommunity.com/dev
https://developer.valvesoftware.com/wiki/Steam_Web_API#GetPlayerSummaries_.28v0001.29
TODO: Check this doc: https://partner.steamgames.com/doc/home  / https://partner.steamgames.com/doc/webapi/ISteamApps
