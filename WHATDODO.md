## The main goal

The main goal of this project is to create a simple and easy to use tool for creating spotify library playlists based on your steam account. 

## How it works

The program will scan your steam account for games that have a soundtrack and then search spotify for the soundtrack. 
If it finds a soundtrack it will suggest it to you and you can choose to add it to your library or not.

## steps of development

-  [ ] can get info from steam
   - inspired by https://github.com/knojector/SteamAuthenticationBundle/tree/bde0d51d2768857f78fa0372a85f2f2b0a933024
   - Create a button that redirects to the steam login page, with the callback url being the login page of the app
- [ ] can get the list of games from steam
- [ ] can get the list of soundtracks from steam

- [ ] can be logged into spotify
- [ ] can get the list of favorites albums/artists from spotify
- [ ] check if a soundtrack is already in the library
- [ ] can add a soundtrack to the library

## Docs
https://steamcommunity.com/dev
https://developer.valvesoftware.com/wiki/Steam_Web_API#GetPlayerSummaries_.28v0001.29
