BeeGame - Symfony 3
====================

    Just do composer insall to run the game.

Useful Commands
---------------

    $ php bin/console debug:router
    $ php bin/console debug:twig
    $ php bin/console debug:config
    $ php bin/console debug:container
    $ php bin/console debug:router
    $ php bin/console debug:translation
    
A technical test I had to do in 1 hour. It's a game about shooting bees in a swarm.

# The Bee Game

## Objective:

You have **one hour** to complete this PHP test.

The objective of this exercise is to create a PHP application in that performs the following tasks:

*   A web page must be produced as the interface to play the game. Styling is not expected nor necessary.

*   A button must be present to kick off the process of hitting a random bee.

*   All code must be submitted to work in a local environment. Hosted solutions will be rejected.

*   The game must adhere to the following rules and constraints.

*   Optional : an option to hit a specific bee.

## Specification:

1.Queen Bee

The Queen Bee has a lifespan of  100 Hit Points.
When the Queen Bee is hit,  8 Hit Points are deducted from her lifespan.

If/When the Queen Bee has run out of Hit Points,  All remaining alive Bees automatically run out of hit
points.

*   There is only 1 Queen Bee.

2.Worker Bee

*   Worker Bees have a lifespan of  75 Hit Points.

*   When a Worker Bee is hit,  10 Hit Points are deducted from his lifespan.

*   There are 5 Worker Bees.

3.Drone Bee

*   Drone Bees have a lifespan of  50 Hit Points.

*   When a Drone Bee is hit,  12 Hit Points are deducted from his lifespan.

*   There are 8 Drone Bees.

## Gameplay:

To play, there must be a button that enables a user to “hit” a random bee. The selection of a bee must be random.

When the bees are all dead, the game must be able to reset itself with full life bees for another round.

## Constraints:

*   The application must run through a browser
