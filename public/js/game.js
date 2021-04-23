'use strict';

const GET_RANDOM_PLAYERS_ENDPOINT = '/game/ajax-random-players';

//DOM components
let punctuationCounter;
let restPlayersCounter;
let currentPlayerText;
let teamSelector;
let validateGameButton;
let restartGameButton;

//Game control data
let punctuation;
let playersToDo;
let currentPlayerIndex;

//AJAX request to get players data
let playersLoadedPromise = getRandomPlayers();

async function getRandomPlayers() {
    const response = await fetch(GET_RANDOM_PLAYERS_ENDPOINT);
    playersToDo = await response.json();
}

//MAIN
window.addEventListener('DOMContentLoaded', () => {
    initComponents();
    playersLoadedPromise.then(() => initGame());


    validateGameButton.addEventListener('click', () => {
        if (isValidGame()) {
            successGame()
        } else {
            failGame();
        }
    });

});

//Helper functions
function initComponents() {
    punctuationCounter = document.getElementById('punctuation_counter');
    restPlayersCounter = document.getElementById('rest_players_counter');
    currentPlayerText = document.getElementById('game_currentPlayer');
    teamSelector = document.getElementById('game_team');
    validateGameButton = document.getElementById('validate_game');
    restartGameButton = document.getElementById('restart_game');
}

function initGame() {
    punctuation = 0;
    punctuationCounter.innerText = punctuation.toLocaleString();
    restPlayersCounter.innerText = playersToDo.length;
    nextPlayer();
}

function nextPlayer() {
    if (playersToDo.length <= 0) {
        endGame();
        return;
    }
    currentPlayerIndex = Math.floor(Math.random() * playersToDo.length);
    let currentPlayer = playersToDo[currentPlayerIndex];
    currentPlayerText.value = currentPlayer.name;
    restPlayersCounter.innerText = playersToDo.length;
}

function isValidGame() {
    let selectedTeamId = parseInt(teamSelector.value);
    let currentPlayer = playersToDo[currentPlayerIndex];

    /** @property currentPlayer.team.id **/
    let currentPlayerTeamId = currentPlayer.team.id;

    return selectedTeamId === currentPlayerTeamId;
}

function successGame() {
    playersToDo.splice(currentPlayerIndex, 1);
    punctuation++;
    refreshPunctuation();
    nextPlayer();

}

function failGame() {
    punctuation--;
    refreshPunctuation();
    nextPlayer();
}

function refreshPunctuation() {
    punctuationCounter.innerText = punctuation.toLocaleString();
}

function endGame() {
    punctuationCounter.style.fontSize = '50px';
    punctuationCounter.style.background = 'black';
    punctuationCounter.style.color = 'white';
    restPlayersCounter.innerText = '0';
    currentPlayerText.value = '...';
    teamSelector.value = null;
    teamSelector.disabled = true;
    validateGameButton.disabled = true;
    validateGameButton.innerText = 'End of the game';
    restartGameButton.style.display = 'inline-block'
}