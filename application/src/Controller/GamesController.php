<?php
namespace Main\Controller;

use E4u\Application\View;
use Main\Form;
use Main\Model\Game;
use E4u\Response;
use Main\Model\Player;

class GamesController extends AbstractController
{
    public function createAction()
    {
        $game = Game::create([]);
        return $this->redirectTo($game->showUrl(),
            sprintf('Rozgrywka <strong>%s</strong> została utworzona. Zaproś do niej graczy!', $game),
            View::FLASH_SUCCESS);
    }

    public function showAction()
    {
        $game = $this->getGameFromQuery();

        return [
            'title' => sprintf('Rozgrywka <strong>%s</strong>', $game),
            'game' => $game,
        ];
    }

    public function playAction()
    {
        $game = $this->getGameFromQuery();
        $player = $this->getPlayerFromSession($game);

        return [
            'title' => sprintf('Rozgrywka <strong>%s</strong>', $game),
            'game' => $game,
            'player' => $player,
        ];
    }

    public function connectAction()
    {
        $game = $this->getGameFromQuery();
        $player = $this->getPlayerFromParam($game);

        $_SESSION['player'] = $player->id();
        return $this->redirectTo($game->playUrl());
    }

    public function joinAction()
    {
        $game = $this->getGameFromQuery();
        $player = new Player();

        $form = new Form\CreatePlayer($this->getRequest(), [ 'game' => $game, 'player' => $player, ]);
        if ($form->isValid()) {
            $player->setGame($game)
                ->save();

            return $this->redirectTo($game->actionUrl('connect/' . $player->id()),
                sprintf('Dołączyłeś do rozgrywki <strong>%s</strong> jako <strong>%s</strong>.', $game, $player),
                View::FLASH_SUCCESS);
        }

        return [
            'title' => sprintf('Dołączanie do rozgrywki <strong>%s</strong> ...', $game),
            'game' => $game,
            'form' => $form,
        ];
    }

    /**
     * @param  Game $game
     * @return Response\Redirect|Player
     */
    private function getPlayerFromSession($game)
    {
        $id = $_SESSION['player'];
        if (empty($id)) {
            return $this->redirectTo($game->joinUrl());
        }

        $player = Player::find($id);
        if (empty($player) || !$player->belongsTo($game)) {
            return $this->redirectTo($game->joinUrl());
        }

        return $player;
    }

    /**
     * @param  Game $game
     * @return Response\Redirect|Player
     */
    private function getPlayerFromParam($game)
    {
        $id = $this->getParam('id');
        if (empty($id)) {
            return $this->redirectTo($game->joinUrl());
        }

        $player = Player::find($id);
        if (empty($player) || !$player->belongsTo($game)) {
            return $this->redirectTo($game->joinUrl());
        }

        return $player;
    }

    /**
     * @return Response\Redirect|Game
     */
    private function getGameFromQuery()
    {
        $name = $this->getRequest()->getQuery('game');
        if (empty($name)) {
            return $this->redirectTo('/');
        }

        $game = Game::findOneByName($name);
        if (empty($game)) {
            return $this->redirectTo('/');
        }

        return $game;
    }
}