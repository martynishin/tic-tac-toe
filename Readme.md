# Tic-Tac-Toe game

* REST API for the [Tic-Tac-Toe](https://en.wikipedia.org/wiki/Tic-tac-toe) game.
* Implemented using PHP 7.4, Lumen 7, MySQL 5.7

## Requirements

* Docker
* Docker-compose

## Installing

* Clone this project into your local machine
* Go in docker directory
```
cd docker
```
* Create docker-compose.yml and .env files
```
cp docker-compose.example.yml docker-compose.yml
```
```
cp .env.example .env
```
* Run docker containers
```
docker-compose up -d
```
* Make sure that **api** and **mysql** containers are running
```
docker ps
``` 
* Go inside **api** container
```
docker-compose exec api bash
```
* Install Lumen micro-framework and dependencies
```
composer install
```
* Create Lumen .env file
```
cp .env.example .env
```
* Run Database migrations
```
php artisan migrate
```

#### Congrats, application ready to use.

## API Documentation

You can find REST API documentation in tictactoe.yaml file into root directory of this project.
Just open this file in this online [editor](https://editor.swagger.io/). 

## Game flow

* The client (player) starts a game, makes a request to server to initiate a TicTakToe board. ( Client (player) will always use cross )
* The backend responds with the started game.
* Client gets the board state from the response.
* Client makes a move; move is sent back to the server.
* Backend validates the move, makes it's own move and updates the game state. The updated game state is returned in the response.
* And so on. The game is over once the computer or the player gets 3 noughts or crosses, horizontally, vertically or diagonally or there are no moves to be made.
