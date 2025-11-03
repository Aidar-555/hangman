<?php
<<<<<<< HEAD

namespace aidar555\hangman\Controller;

use aidar555\hangman\Model\{Game, Dictionary, Database};
use aidar555\hangman\Repository\{GameRepository, AttemptRepository};

use function aidar555\hangman\View\{
=======

namespace Aidar555\hangman\Controller;

use Aidar555\hangman\Model\{Game, Dictionary};

use function Aidar555\hangman\View\{
>>>>>>> 671cd885c9c1e45054488e651978bbc09c65ffaf
    showHelp,
    showStartScreen,
    showMaskedWord,
    showHangman,
    showResult,
    showMessage,
    promptLetter
};

function startGame(): void
{
    $opts = parseArgs();

    if ($opts['help']) {
        showHelp();
        return;
    }

    switch ($opts['mode']) {
        case 'list':
<<<<<<< HEAD
            $db = new \aidar555\hangman\Model\Database(); // инициализация RedBean
            $gameRepo = new \aidar555\hangman\Repository\GameRepository();

            $games = $gameRepo->listGames();
            foreach ($games as $g) {
                echo "{$g['id']}) {$g['date']} | {$g['player_name']} | {$g['word']} | {$g['result']}\n";
            }
=======
            showMessage('Listing saved games is not implemented (DB not connected).');
>>>>>>> 671cd885c9c1e45054488e651978bbc09c65ffaf
            return;

        case 'replay':
            if ($opts['replay_id'] === null) {
                showMessage('Replay mode requires id: --replay <id>');
<<<<<<< HEAD
                return;
            }

            $db = new \aidar555\hangman\Model\Database(); // инициализация RedBean
            $gameRepo = new \aidar555\hangman\Repository\GameRepository();
            $attemptRepo = new \aidar555\hangman\Repository\AttemptRepository();

            $game = $gameRepo->getGameById($opts['replay_id']);
            if (!$game) {
                showMessage("Game id {$opts['replay_id']} not found.");
                return;
            }

            showMessage("Replay: {$game['player_name']} vs word '{$game['word']}' ({$game['result']})");

            $attempts = $attemptRepo->getAttempts($opts['replay_id']);
            foreach ($attempts as $a) {
                echo "Attempt {$a['attempt_number']}: '{$a['letter']}' — {$a['outcome']}\n";
=======
            } else {
                showMessage("Replay of game id {$opts['replay_id']} is not implemented (DB missing).");
>>>>>>> 671cd885c9c1e45054488e651978bbc09c65ffaf
            }
            return;

        case 'new':
        default:
            runNewGame($opts);
            return;
    }
}

function parseArgs(): array
{
    $argv = $_SERVER['argv'] ?? [];
    array_shift($argv);

    $opts = [
        'mode' => 'new',
        'help' => false,
        'player' => 'Player',
        'replay_id' => null,
    ];

    $i = 0;
    while (isset($argv[$i])) {
        $arg = $argv[$i];

        if ($arg === '--help' || $arg === '-h') {
            $opts['help'] = true;
            return $opts;
        }

        if ($arg === '--new' || $arg === '-n') {
            $opts['mode'] = 'new';
            $i++;
            continue;
        }

        if ($arg === '--list' || $arg === '-l') {
            $opts['mode'] = 'list';
            $i++;
            continue;
        }

        if ($arg === '--replay' || $arg === '-r') {
            $opts['mode'] = 'replay';
            $opts['replay_id'] = isset($argv[$i + 1]) ? (int)$argv[$i + 1] : null;
            $i += 2;
            continue;
        }

        if (str_starts_with($arg, '--player=')) {
            $opts['player'] = substr($arg, 9);
            $i++;
            continue;
        }

        if ($arg === '--player' || $arg === '-p') {
            $opts['player'] = $argv[$i + 1] ?? 'Player';
            $i += 2;
            continue;
        }

        $i++;
    }

    return $opts;
}

function runNewGame(array $opts): void
{
    $player = $opts['player'];

    $dict = new Dictionary();
    $word = $dict->getRandomWord();

    $game = new Game($word);

<<<<<<< HEAD
    $db = new Database();
    $gameRepo = new GameRepository();
    $attemptRepo = new AttemptRepository();

    $gameId = $gameRepo->createGame($player, $word);

=======
>>>>>>> 671cd885c9c1e45054488e651978bbc09c65ffaf
    showStartScreen($player);

    $attempts = 0;
    while (!$game->isWon() && !$game->isLost()) {
        showHangman($game->getWrongCount());
        showMaskedWord($game->getMaskedWord());

        $letter = promptLetter();
        if ($letter === '') {
            continue;
        }

        $attempts++;
        $result = $game->guess($letter);

        if ($result === 'ok') {
            showMessage("Good: '{$letter}' found");
        } elseif ($result === 'miss') {
            showMessage("Wrong: '{$letter}' not in word");
        } else {
            showMessage("Already tried '{$letter}'");
        }
<<<<<<< HEAD

        $outcome = $result === 'ok' ? 'correct' :
            ($result === 'miss' ? 'wrong' : 'repeat');
        $attemptRepo->addAttempt($gameId, $attempts, $letter, $outcome);
=======
>>>>>>> 671cd885c9c1e45054488e651978bbc09c65ffaf
    }

    $won = $game->isWon();
    showHangman($game->getWrongCount());
    showMaskedWord($game->getMaskedWord());
    showResult($won, $game->getWord());
<<<<<<< HEAD

    $gameRepo->updateResult($gameId, $won ? 'won' : 'lost');
    showMessage('Game saved to database.');
=======
    showMessage('Note: results are not saved — DB not implemented yet.');
>>>>>>> 671cd885c9c1e45054488e651978bbc09c65ffaf
}